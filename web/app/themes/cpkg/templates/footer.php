<footer class="content-info" role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <?php

                $context = Timber::get_context();
                $context['services'] = Timber::get_posts([
                    'post_type' => 'legalservice',
                    'posts_per_page' => 6,
                    'orderby'   => 'meta_value_num',
                    'meta_key'  => 'priority',
                    'order' => 'DESC'
                ]);
                $offerPage = get_page_by_title('specjalizacje');
                $offerPageId = $offerPage->ID;
                $context['offer'] = Timber::get_post('page_id=' . $offerPageId);
                $context['pages'] = Timber::get_posts([
                    'post_type' => 'page',
                    'posts_per_page' => 7
                ]);

                if (is_active_sidebar('sidebar-footer-1')) {
                    dynamic_sidebar('sidebar-footer-1');
                } else {
                    Timber::render('footer-default-1.twig');
                }
                ?>
            </div>
            <div class="col-sm-4 hidden-xs">
                <?php
                if (is_active_sidebar('sidebar-footer-2')) {
                    dynamic_sidebar('sidebar-footer-2');
                } else {
                    Timber::render('footer-default-2.twig', $context);
                }
                ?>
            </div>    
            <div class="col-sm-4 hidden-xs">
                <?php
                if (is_active_sidebar('sidebar-footer-3')) {
                    dynamic_sidebar('sidebar-footer-3');
                } else {
                    Timber::render('footer-default-3.twig', $context);
                }
                ?>
            </div>
        </div>
    </div>
</footer>
