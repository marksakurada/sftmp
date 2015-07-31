<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 */
?>
<div id="page">
  <header class="site-header-top-large" data-fixed="false" role="banner">
    <div class="site-header-top-large-inner">
      <div class="inner-header-top">
        <div class="container">
          <div class="region-header">
            <div class="region-branding">
              <div class="branding-left">
                <?php if (theme_get_setting('logo_large')) :
                  $fid = theme_get_setting('logo_large');
                  $src = file_create_url(file_load($fid)->uri); ?>
                  <a href="/" class="logo logo--large"><img
                      src="<?php print $src; ?>"/></a>
                <?php endif; ?>
              </div>
              <?php if ($page['branding_right']): ?>
                <?php print render($page['branding_right']); ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="inner-header-bottom">
        <div class="container">
          <ul class="nav-mobile js-mobile-menu-trigger">
            <li class="mobile"><i class="fa fa-bars mobile-menu"></i></li>
          </ul>
          <?php if (theme_get_setting('logo_small')) :
            $fid = theme_get_setting('logo_small');
            $src = file_create_url(file_load($fid)->uri); ?>
            <a href="/" class="logo logo--small"><img
                src="<?php print $src; ?>"/></a>
          <?php endif; ?>
          <?php if ($page['navigation']): ?>
            <nav class="top-nav" role="navigation">
              <?php print render($page['navigation']); ?>
            </nav>
          <?php endif; ?>

          <?php if (theme_get_setting('social_media_facebook') || theme_get_setting('social_media_twitter')): ?>
            <div class="header-social">
              <?php if (theme_get_setting('social_media_twitter')): ?>
                <a
                  href="<?php print theme_get_setting('social_media_twitter'); ?>"
                  target="_blank">
                  <i class="fa fa-twitter"></i>
                </a>
              <?php endif; ?>
              <?php if (theme_get_setting('social_media_facebook')): ?>
                <a
                  href="<?php print theme_get_setting('social_media_facebook'); ?>"
                  target="_blank">
                  <i class="fa fa-facebook"></i>
                </a>
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <ul class="nav-search-mobile">
            <li class="search"><a href="<?php print url('search'); ?>"><i
                  class="fa fa-search click-search"></i></a></li>
          </ul>

          <?php if ($page['navigation_right']): ?>
            <?php print render($page['navigation_right']); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header>

  <?php if ($page['alert']): ?>
    <div class="alert-full-width">
      <?php print render($page['alert']); ?>
    </div>
  <?php endif; ?>

  <div id="globalWrapper">
    <div class="mobile-tune-genie"></div>
    <?php if ($page['top_ads']): ?>
      <div class="topAds">
        <?php print render($page['top_ads']); ?>
      </div>
    <?php endif; ?>

    <div id="container" class="container">
      <div id="container-inner">

        <?php if ($page['content']): ?>
          <section id="content" class="row" role="main">
            <div class="content-inner">
              <?php print render($page['content']); ?>
            </div>
          </section>
        <?php endif; ?>

      </div>
      <!-- /#container-inner -->
    </div>
    <!-- /#container -->
    <?php if ($page['bottom_ads']): ?>
      <div class="bottomAds">
        <?php print render($page['bottom_ads']); ?>
      </div>
    <?php endif; ?>

    <footer id="footer-global" role="contentinfo">
      <div class="footer-inner container">
        <?php if ($page['content']): ?>
          <div class="row">
            <div class="footer-inner-left col-xs-12 col-sm-9 col-md-10">
              <?php print render($page['footer_first']); ?>
            </div>
            <div class="footer-inner-right col-xs-12 col-sm-3 col-md-2">
              <?php print render($page['footer_second']); ?>
              <?php if (theme_get_setting('social_media_facebook') || theme_get_setting('social_media_twitter')): ?>
                <div class="footer-social">
                  <?php if (theme_get_setting('social_media_twitter')): ?>
                    <a
                      href="<?php print theme_get_setting('social_media_twitter'); ?>"
                      target="_blank">
                      <i class="fa fa-twitter"></i>
                    </a>
                  <?php endif; ?>
                  <?php if (theme_get_setting('social_media_facebook')): ?>
                    <a
                      href="<?php print theme_get_setting('social_media_facebook'); ?>"
                      target="_blank">
                      <i class="fa fa-facebook"></i>
                    </a>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
              <?php if (theme_get_setting('mobile_app_android') || theme_get_setting('mobile_app_iphone')): ?>
                <div class="download-app-buttons">
                  <?php if (theme_get_setting('mobile_app_iphone')): ?>
                    <a
                      href="<?php print theme_get_setting('mobile_app_iphone'); ?>"
                      target="_blank">
                      <img
                        src="<?php print file_create_url(drupal_get_path('theme', 'shortwave') . '/assets/images/iphone-download-icon.png'); ?>"
                        alt=""/>
                    </a>
                  <?php endif; ?>
                  <?php if (theme_get_setting('mobile_app_android')): ?>
                    <a
                      href="<?php print theme_get_setting('mobile_app_android'); ?>"
                      target="_blank">
                      <img
                        src="<?php print file_create_url(drupal_get_path('theme', 'shortwave') . '/assets/images/android-download-icon.png'); ?>"
                        alt=""/>
                    </a>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if (theme_get_setting('copyright')) :
          $copyright = theme_get_setting('copyright'); ?>
          <div class="copyright-footer">
            <?php print $copyright['value']; ?>
          </div>
        <?php endif; ?>

        <?php if (theme_get_setting('footer_text')) :
          $footer_text = theme_get_setting('footer_text'); ?>
          <div class="footer-text-message-info">
            <?php print $footer_text['value']; ?>
          </div>
        <?php endif; ?>
      </div>
      <!-- /.footer-inner -->
    </footer>
  </div>
  <!-- /#global-wrapper -->
</div>