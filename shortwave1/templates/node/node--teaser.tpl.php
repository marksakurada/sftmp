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

// Hide content - we'll render by hand.
hide($content);
?>
<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
<?php if (!empty($cover_image)): ?>
  <div class="content-listing-left">
    <div class="content-listing-left-inner">
      <?php print l($cover_image, $node_url, array('html' => TRUE)); ?>
    </div>
  </div>
<?php endif; ?>
  <div class="content-listing-right">
  <?php if (!empty($node_type_name)): ?>
    <div class="listing-item-type"><?php print $node_type_name; ?></div>
  <?php endif; ?>
    <h3><?php print l($node->title, $node_url); ?></h3>
    <p class="content-author">
    <?php if ($link_to_show): ?>
      <?php print $content['field_show_attribute'][0]['#markup']; ?>
    <?php endif; ?>
    <?php if ($link_to_show && !empty($byline)): ?>
    <span>|</span>
    <?php endif; ?>
    <?php if (!empty($byline)): ?>
      <?php print $byline; ?>
    <?php endif; ?>
    </p>
    <div class="content-listing-desc">
      <?php print isset($content['field_description']) ? render($content['field_description'][0]) : render($content['body'][0]); ?>
    </div>
    <a class="post-read-more" href="<?php print $node_url; ?>">Read More &gt;</a>
  </div>
  <div class="clear"></div>
</article>
