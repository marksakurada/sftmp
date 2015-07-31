<?php

/**
 * @file brightcove-field-player.tpl.php
 * Default template for embeding brightcove players.
 *
 * Available variables:
 * - $id
 * - $width
 * - $height
 * - $classes_array
 * - $bgcolor
 * - $flashvars
 *
 * @see template_preprocess_brightcove_field_embed().
 */
global $is_https;
?>
<?php if ($responsive): ?>
<div class="BCLcontainingBlock">
  <div class="BCLvideoWrapper">
    <?php endif; ?>
    <video
      data-video-id="<?php print $brightcove_id; ?>"
      data-player="<?php print $player_id ? $player_id : 'default'; ?>"
      data-account="<?php print $account_id; ?>"
      data-embed="default"
      class="video-js" controls></video>
    <script
      src="//players.brightcove.net/<?php print $account_id; ?>/<?php print $player_id ? $player_id : 'default'; ?>_default/index.min.js"></script>
    <?php if ($responsive): ?>
  </div>
</div>
<?php endif; ?>
