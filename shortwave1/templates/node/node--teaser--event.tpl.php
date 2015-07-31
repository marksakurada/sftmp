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

$event_location = (!empty($content['field_venue_name'][0]['#markup'])) ? $content['field_venue_name'][0]['#markup'] : '';
$event_date_field = (!empty($content['field_event_date'][0]['value'])) ? $content['field_event_date'][0] : '';
$timestamp = ent_core_get_date_field_local_timestamp($event_date_field);


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
    <p class="content-listing-information">
    <?php if (!empty($timestamp)): ?>
      <span class="event-date"><?php print date('l, F j, Y - g:i A', $timestamp); ?></span>
    <?php endif; ?>
    <?php if (!empty($event_location) && !empty($timestamp)): ?>
    <span>|</span>
    <?php endif; ?>
    <?php if (!empty($event_location)): ?>
      <?php print $event_location; ?>
    <?php endif; ?>
    </p>
    <div class="content-listing-desc">
      <?php print isset($content['field_description']) ? render($content['field_description'][0]) : render($content['body'][0]); ?>
    </div>
    <a class="post-read-more" href="<?php print $node_url; ?>">Read More &gt;</a>
  </div>
  <div class="clear"></div>
</article>
