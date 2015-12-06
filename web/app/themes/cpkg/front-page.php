<?php
/*
* Template Name: Homepage
*/
?>
<?php
    include('templates/advice-modal.php');
    $context['home_page'] = Timber::get_post('', $class = 'CpkgPost');
    $homepageServicesStr = types_render_field('service-name', array('separator' => '|'));
    $homepageServices = preg_split('/\|/', $homepageServicesStr);

    $pages = Timber::get_posts([
        'post_type' => 'page'
    ]);

    /** @var TimberPost $page */
    foreach($pages as $page) {
        $context['pages'][$page->title()] = $page;
    }


    foreach ($homepageServices as $homepageService) {
        $titleAndDesc = explode('?', $homepageService);
        $hpServicesWithDesc[] = $titleAndDesc;
    }

    $context['hp_services'] = $hpServicesWithDesc;
?>
    <?php get_template_part('templates/page', 'header'); ?>
    <?php Timber::render('content-frontpage.twig', $context);