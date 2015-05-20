<?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/page', 'header'); ?>
    <?php

    $context = Timber::get_context();
    $defaultPageTemplate = get_template_part('templates/content', 'page');
    $templates = array($defaultPageTemplate);
    $args = null;
    $pageTitle = get_the_title();

    switch ($pageTitle) {
        case 'Oferta':
            $args = array(
                'post_type' => 'legalservice',
            );
            array_unshift($templates, 'offer.twig');
            break;
    }

    $context['services'] = Timber::get_posts($args);
    Timber::render($templates, $context);
    ?>

<?php endwhile; ?>
