<footer class="content-info" role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-6">
                <?php

                $context = Timber::get_context();
                $context['services'] = Timber::get_posts('post_type=legalservice');
                $offerPage = get_page_by_title('oferta');
                $offerPageId = $offerPage->ID;
                $context['offer'] = Timber::get_post('page_id=' . $offerPageId);
                $context['pages'] = Timber::get_posts('post_type=page');

                if (is_active_sidebar('sidebar-footer-1')) {
                    dynamic_sidebar('sidebar-footer-1');
                } else {
                    Timber::render('footer-default-1.twig');
                }
                ?>
            </div>
            <div class="col-sm-4 col-xs-6">
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
