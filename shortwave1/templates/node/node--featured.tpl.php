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
<article
  class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <a href="<?php print $node_url; ?>" <?php print $link_target; ?>>
    <?php if ($cover_image) : ?>
      <figure>
        <?php
        print $cover_image; ?>
        <?php if ($attribution) : ?>
          <figcaption>
            <?php print $attribution; ?>
          </figcaption>
        <?php endif; ?>
      </figure>
    <?php endif; ?>
    <div class="slide-hgroup">
      <h2><?php print $featured_title; ?></h2>
      <?php if ($subtitle) {
        print '<h3>' . $subtitle . '</h3>';
      } ?>
    </div>
  </a>
</article>