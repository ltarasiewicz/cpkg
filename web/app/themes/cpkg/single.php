<?php
get_template_part('templates/page', 'header');
$context['page'] = Timber::get_post();
Timber::render('generic.twig', $context);
