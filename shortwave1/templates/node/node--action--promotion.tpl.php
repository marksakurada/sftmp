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
  // Hide content so we can render by hand.
  hide($content);

  if (!empty($content['field_cover_image'][0])) {
    $cover_image = image_style_url(
      $content['field_cover_image'][0]['#image_style'],
      $content['field_cover_image'][0]['#item']['uri']
    );
  }

  $cover_image_alt = '';
  if (!empty($content['field_cover_image'][0]['#item']['alt'])) {
    $cover_image_alt = $content['field_cover_image'][0]['#item']['alt'];
  }

  $cover_image = (!empty($cover_image)) ? '<img src="'.$cover_image.'" alt="' . $cover_image_alt . '" class="widget--c2aBox-image" />' : '';

  $cta_caption_title = '';
  if (!empty($variables['title'])) {
    $cta_caption_title = $variables['title'];
  }
  elseif (!empty($variables['node']->nid)) {
    $node = node_load($variables['node']->nid);
    $cta_caption_title = $node->title;
  }
  $cta_caption_subtitle = '';
  if (!empty($content['field_subtitle'][0]['#markup'])) {
    $cta_caption_subtitle = '<div class="widget--c2aBox-caption-subtitle">' . $content['field_subtitle'][0]['#markup'] . '</div>';
  }
  $cta_caption = '<div class="widget--c2aBox-caption">' . $cta_caption_title . $cta_caption_subtitle . '</div>';

  $cta_meta = '';
  if (!empty($variables['type'])) {
    $cta_meta = '<div class="widget--c2aBox-meta"><div class="widget--c2aBox-meta-type">' . $variables['type'] . '</div></div>';
  }

  $cta_link = '';
  if (!empty($content['field_promotion_link']['#items'][0]['url'])) {
    $cta_link = $content['field_promotion_link']['#items'][0]['url'];
  }
  $cta_link_attributes = NULL;
  if (!empty($content['field_promotion_link']['#items'][0]['attributes'])) {
    $cta_link_attributes = $content['field_promotion_link']['#items'][0]['attributes'];
  }


  $cta_link = l(
    $cover_image . $cta_caption,
    $cta_link,
    array(
      'html' => TRUE,
      'attributes' => $cta_link_attributes,
    )
  );
?>

<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="widget widget--fit widget--c2aBox">
    <?php print $cta_link; ?>
  </div>
</article>
