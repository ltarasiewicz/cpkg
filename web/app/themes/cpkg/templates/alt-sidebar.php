<?php
$data['sidebar_widgets'] = Timber::get_widgets('sidebar-primary');
$data['services'] = Timber::get_posts('post_type=legalservice');
Timber::render('alt-sidebar.twig', $data);
