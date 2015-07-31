<?php

/**
 * @file
 * Radix theme implementation to display a node.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 *
 * This template is used for all node types and node view modes that do not have
 * custom templates. Content is rendered using the render($content) function.
 *
 * If a custom template is used, you can use "granular rendering". You "hide"
 * a part of the rendered content and render it separately. Ex:
 *
 * hide($content['field_cover_image']);
 * print render($content['field_cover_image']);
 *
 * See https://www.drupal.org/node/1059636.
 */
?>
<article class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php
  // We hide the comments and links now so that we can render them later.
  hide($content['comments']);
  hide($content['links']);
  print render($content);
  ?>
</article>
