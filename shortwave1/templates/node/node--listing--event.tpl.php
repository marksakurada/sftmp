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

  $event_location = (!empty($content['field_venue_name'][0]['#markup'])) ? $content['field_venue_name'][0]['#markup'] : '';
  $event_date_field = (!empty($content['field_event_date'][0]['value'])) ? $content['field_event_date'][0] : '';
  $timestamp = ent_core_get_date_field_local_timestamp($event_date_field);
?>
  <a href="<?php print $node_url ?>">
  <?php if ($timestamp): ?>
    <div class="event-date"><span><?php print date('d', $timestamp); ?></span><?php print strtoupper(date('M', $timestamp)); ?></div>
  <?php endif; ?>
    <div class="event-details">
      <h4><?php print $title ?></h4>
      <div class="event-location"><?php if ($event_location) { print '- ' . $event_location; } ?></div>
    </div>
    <div class="clear"></div>
  </a>
</article>
