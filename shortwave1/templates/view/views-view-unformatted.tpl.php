<?php
/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 *
 * Changes the grouping markup to be h4 instead of the default h3.
 */
?>
<div class="grouping-section">
<?php if (!empty($title)): ?>
  <h4><?php print $title; ?></h4>
<?php endif; ?>
  <?php foreach ($rows as $id => $row): ?>
    <div<?php if ($classes_array[$id]) { print ' class="grouping-section-item ' . $classes_array[$id] . '"'; } ?>>
      <?php print $row; ?>
    </div>
  <?php endforeach; ?>
</div>
