<?php
$context['sidebar_widgets'] = Timber::get_widgets('sidebar-primary');
$context['services'] = Timber::get_posts('post_type=legalservice');
$context['entrepreneurs_page'] = Timber::get_post(['post_type' => 'page', 'name' => 'przedsiebiorcy']);
$context['enterprise_page'] = Timber::get_post(['post_type' => 'page', 'name' => 'spolki']);
$context['consumers_page'] = Timber::get_post(['post_type' => 'page', 'name' => 'konsumenci']);
Timber::render('sidebar.twig', $context);
