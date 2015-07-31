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
 */
?>
<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php
  // Hide content so we can render by hand.
  hide($content);

  if (!empty($content['field_cover_image'][0])) {
    $cover_image = image_style_url(
      $content['field_cover_image'][0]['#image_style'],
      $content['field_cover_image'][0]['#item']['uri']
    );
  }

  $cover_image = (!empty($cover_image)) ? '<img src="'.$cover_image.'" alt="" />' : '';

  print l($cover_image . '<span>' . $title . '</span>', $node_url, array(
    'html' => TRUE,
  ));
  ?>
</article>
