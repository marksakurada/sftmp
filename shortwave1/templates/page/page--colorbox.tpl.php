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

<?php if ($page['content']): ?>
<section id="content" role="main">
  <?php print render($page['content']); ?>
</section>
<?php endif; ?>
