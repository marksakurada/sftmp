<?php
/**
 * @file
 * Template for Radix Moscone Flipped.
 *
 * Variables:
 * - $css_id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 * panel of the layout. This layout supports the following sections:
 */
?>

<div class="panel-display moscone-flipped clearfix <?php if (!empty($classes)) { print $classes; } ?><?php if (!empty($class)) { print $class; } ?>" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>

  <div class="col-md-12 radix-layouts-header panel-panel">
    <div class="panel-panel-inner">
      <?php print $content['header']; ?>
    </div>
  </div>

  <div class="content contentLeft col-xs-12 col-sm-7 col-md-8">
    <div class="content-inner">
      <?php print $content['contentmain']; ?>
    </div>
  </div>
  <div class="sidebar sidebarRight col-xs-12 col-sm-5 col-md-4">
    <div class="sidebar-inner">
      <?php print $content['sidebar']; ?>
    </div>
  </div>

  <div class="col-md-12 radix-layouts-footer panel-panel">
    <div class="panel-panel-inner">
      <?php print $content['footer']; ?>
    </div>
  </div>

</div><!-- /.moscone-flipped -->
