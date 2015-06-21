<?php
function cpkgRewriteRules() {

    add_rewrite_rule(
        'oferta/usluga([^/]*)/?$', 'index.php?pagename=oferta&service_id=$matches[1]', 'top'
    );

}
add_action('init', 'cpkgRewriteRules');