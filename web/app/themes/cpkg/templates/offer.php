<?php
$context = Timber::get_context();

$args = array(
    'post_type' =>  'legalservice',
    
);
$context['services'] = Timber::get_posts($args);
Timber::render('offer.twig', $context); 