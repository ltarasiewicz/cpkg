<?php get_template_part('templates/page', 'header'); ?>
<?php

$context = Timber::get_context();
$defaultPageTemplate = get_template_part('templates/content', 'page');
$templates = array($defaultPageTemplate);
$args = null;
$pageTitle = get_the_title();

switch ($pageTitle) {
    case 'Specjalizacje':
        $args = array(
            'post_type' => 'legalservice',
            'posts_per_page' => -1
        );
        array_unshift($templates, 'offer.twig');
        break;
    case 'Zespół':
        $args = array(
            'post_type' =>  'member',
        );
        array_unshift($templates, 'team.twig');
        break;
    case 'Kontakt':
        $args = array(
            'post_type' =>  'member',
        );
        array_unshift($templates, 'contact.twig');
        break;
    case 'Przedsiębiorcy':
        $args = array(
            'post_type' => 'entrepreneur'
        );
        array_unshift($templates, 'targets.html.twig');
        break;
    case 'Spółki':
        $args = array(
            'post_type' => 'enterprise'
        );
        array_unshift($templates, 'targets.html.twig');
        break;
    case 'Konsumenci':
        $args = array(
            'post_type' => 'consumer'
        );
        array_unshift($templates, 'targets.html.twig');
        break;
    default:
        array_unshift($templates, 'generic.twig');
}

global $query_string;
parse_str($query_string, $vars);
$context['query_vars'] = $vars;
$context['entries'] = Timber::get_posts($args, $class = 'CpkgPost');
$context['page'] = Timber::get_post();
Timber::render($templates, $context);
?>
