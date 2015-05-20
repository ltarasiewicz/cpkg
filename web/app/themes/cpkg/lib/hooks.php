<?php

add_filter('timber_context', 'addPrimaryMenu');
add_filter('metaslider_flex_slider_parameters', 'metasliderFlexParams', 10, 3);

/**
 * Add the ptimary menu to the TimberSite() object
 * @param array $data
 * @return \TimberMenu
 */
function addPrimaryMenu($data){
    // Add a Timber menu and send it along to the context.
    $data['primary_menu'] = new TimberMenu('primary_navigation'); // Send a Wordpress menu slug or ID
    $data['site_logo'] = get_header_image();
    return $data;
}


/**
 *  Add/overwrite setting of the featured slider
 * 
 * @param array $options Slide options to add to/overwrite
 * @param int $slider_id Current slider ID
 * @param array $settings Settins chosen by in the admin dashboard
 * @return array
 */
function metasliderFlexParams($options, $slider_id, $settings) {
    if ($slider_id == 5) {
        $options['sync'] = "'#metaslider_8'";
    } 
    return $options;
} 