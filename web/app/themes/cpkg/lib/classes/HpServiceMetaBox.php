<?php

function instantiateHpServiceMetaBox() {
    new HpServiceMeta();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'instantiateHpServiceMetaBox' );
    add_action( 'load-post-new.php', 'instantiateHpServiceMetaBox' );
}

class HpServiceMeta {

    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post', array( $this, 'save' ) );
    }

    public function add_meta_box( $post_type ) {
        if ( $post_type == 'page' ) {
            add_meta_box(
                'hp-service-description',
                'Homepage Service Description',
                array( $this, 'render_meta_box_content' ),
                $post_type,
                'advanced',
                'high'
            );
        }
    }

    public function save( $post_id ) {

        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */

        // Check if our nonce is set.
        if ( ! isset( $_POST['myplugin_inner_custom_box_nonce'] ) )
            return $post_id;

        $nonce = $_POST['myplugin_inner_custom_box_nonce'];

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'myplugin_inner_custom_box' ) )
            return $post_id;

        // If this is an autosave, our form has not been submitted,
        //     so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return $post_id;

        // Check the user's permissions.
        if ( 'page' == $_POST['post_type'] ) {

            if ( ! current_user_can( 'edit_page', $post_id ) )
                return $post_id;

        } else {

            if ( ! current_user_can( 'edit_post', $post_id ) )
                return $post_id;
        }

        /* OK, its safe for us to save the data now. */

        // Sanitize the user input.
        $mydata = sanitize_text_field( $_POST['myplugin_new_field'] );

        // Update the meta field.
        update_post_meta( $post_id, '_my_meta_value_key', $mydata );
    }


    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_content( $post ) {

        wp_nonce_field( 'cpkg-hp-meta-box', 'cpkg-hp-meta-box-nonce' );

        $value = get_post_meta( $post->ID, '_cpkg_hp_meta_box', true );

        echo '<label for="hp-service-title">';
        echo 'Legal service title';
        echo '</label> ';
        echo '<input type="text" id="hp-service-title" name="hp-service-title"';
        echo ' value="' . esc_attr( $value ) . '" size="25" />';
        echo '<label for="hp-service-description">';
        echo 'Legal service description';
        echo '</label> ';
        echo '<input type="text" id="hp-service-description" name="hp-service-description"';
        echo ' value="' . esc_attr( $value ) . '" size="125" />';
    }
}