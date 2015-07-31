<div class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php if (!$label_hidden): ?>
    <div
      class="field-label"<?php print $title_attributes; ?>><?php print $label ?>
      :&nbsp;</div>
  <?php endif; ?>
  <div class="field-items"<?php print $content_attributes; ?>>
    <?php foreach ($items as $delta => $item): ?>
      <div
        class="field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>>

        <?php
        $rendered = render($item);
        if (
          strpos($rendered, '<img') !== FALSE &&
          isset($item['#item']['field_file_image_attribution']) &&
          !empty($item['#item']['field_file_image_attribution'])
        ) {
          $attrib = $item['#item']['field_file_image_attribution']['und'][0];
          $str = check_markup($attrib['value'], $attrib['format']);
          print "<figure>$rendered<figcaption>$str</figcaption></figure>";
        }
        else {
          print $rendered;
        }
        ?>

      </div>
    <?php endforeach; ?>
  </div>
</div>

