<?php

function cpkgQueryVars( $qvars ) {
    $qvars[] = 'service_id';
    return $qvars;
}
add_filter( 'query_vars', 'cpkgQueryVars' , 10, 1 );