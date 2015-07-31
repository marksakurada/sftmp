<?php
/**
 * @file
 * Theme functions
 */

require_once dirname(__FILE__) . '/includes/structure.inc';
require_once dirname(__FILE__) . '/includes/comment.inc';
require_once dirname(__FILE__) . '/includes/form.inc';
require_once dirname(__FILE__) . '/includes/menu.inc';
require_once dirname(__FILE__) . '/includes/node.inc';
require_once dirname(__FILE__) . '/includes/panel.inc';
require_once dirname(__FILE__) . '/includes/user.inc';
require_once dirname(__FILE__) . '/includes/view.inc';

/**
 * Implements hook_css_alter().
 */
function shortwave_css_alter(&$css) {
  $radix_path = drupal_get_path('theme', 'radix');

  // Radix now includes compiled stylesheets for demo purposes.
  // We remove these from our subtheme since they are already included
  // in compass_radix.
  unset($css[$radix_path . '/assets/stylesheets/radix-style.css']);
  unset($css[$radix_path . '/assets/stylesheets/radix-print.css']);
}

/**
 * Implements template_preprocess_page().
 */
function shortwave_preprocess_page(&$variables) {
  // Add copyright to theme.
  if ($copyright = theme_get_setting('copyright')) {
    $variables['copyright'] = check_markup($copyright['value'], $copyright['format']);
  }
  if (isset($variables['node']) && $variables['node']->type == 'splash_page') {
    // Give colorbox its own page template.
    $variables['theme_hook_suggestions'][] = 'page__colorbox';
  }
}

/**
 * Implements template_preprocess_html().
 */
function shortwave_preprocess_html(&$variables) {
  // Give colorbox its own html template.
  if ($node = menu_get_object()) {
    if ($node->type == 'splash_page') {
      $variables['theme_hook_suggestions'][] = 'html__colorbox';
    }
  }
  // Add a global class to all panel pages.
  if (module_exists('page_manager') && count(page_manager_get_current_page())) {
    $variables['classes_array'][] = 'panel-page';
  }

  // Add inline styles before the page is rendered to override the defaults.
  // Use the convention [[variable_name]] for token replacement.
  $css = _generate_css_overrides();

  drupal_add_css($css, array('group' => CSS_THEME, 'type' => 'inline'));
}

/**
 * Implements template_preprocess_node().
 */
function shortwave_preprocess_node(&$vars) {

  $view_mode = $vars['view_mode'];
  $node_type = $vars['type'];
  // For each type of node, and each view mode, specify template suggestions.
  // Nodes use "node--{view_mode}.tpl.php by default.
  // Override the default for specific types by using
  // node--{view-mode}--{content_type_name}.tpl.php.
  // Templates are placed in the shortwave/templates/node directory.
  // The default view mode for most all nodes is taken over by Panelizer and
  // this preprocess function is not even called.
  $vars['theme_hook_suggestions'][] = 'node__' . $view_mode;
  $vars['theme_hook_suggestions'][] = 'node__' . $view_mode . '__' . $node_type;
  $vars['classes_array'][] = 'node--' . $view_mode;
  $vars['classes_array'][] = 'node--' . $view_mode . '--' . $node_type;

  // Set one theme hook suggestion for all Call to Action view modes.
  $check_array = array(
    'action',
    'action_1_3_tall',
    'action_2_3',
    'action_2_3_tall',
  );
  if (in_array($view_mode, $check_array)) {
    $vars['theme_hook_suggestions'][] = 'node__action';
    $vars['theme_hook_suggestions'][] = 'node__action__' . $node_type;
  }

  // Customize the teaser view mode.
  if ($view_mode == 'teaser') {
    $node = $vars['node'];
    $content = $vars['content'];

    $vars['link_to_show'] = TRUE;
    $vars['node_type_name'] = '';
    if (isset($vars['view']) && $vars['view']->name == 'recent_content') {
      $vars['link_to_show'] = FALSE;
      $vars['node_type_name'] = node_type_get_name($node);
    }

    if (empty($content['field_show_attribute'][0]['#markup'])) {
      $vars['link_to_show'] = FALSE;
    }

    $vars['byline'] = $vars['cover_image'] = '';
    $cover_image_alt = $node->title;
    if (!empty($content['field_cover_image'][0]['#item']['alt'])) {
      $cover_image_alt = $content['field_cover_image'][0]['#item']['alt'];
    }
    if (!empty($content['field_cover_image'][0])) {
      $args = array(
        'path' => $content['field_cover_image'][0]['#item']['uri'],
        'style_name' => $content['field_cover_image'][0]['#image_style'],
        'alt' => $cover_image_alt,
      );
      // Make the image larger if we're showing the first row of a view.
      if (!empty($vars['view']) && $vars['view']->row_index == 0) {
        $args['style_name'] = 'delta__775x515';
      }
      $vars['cover_image'] = theme('image_style', $args);
    }

    if (!empty($content['field_byline'][0]['#markup'])) {
      $vars['byline'] = render($content['field_byline'][0]['#markup']);
    }
  }
  // Customize the featured view mode.
  if ($view_mode == 'featured') {
    $node = $vars['node'];
    $content = $vars['content'];

    // Get the fields from the Featured Showcase Field Collection
    $wrapper = entity_metadata_wrapper('node', $node);
    $wrapper_showcase = $wrapper->field_featured_showcase;

    $show_case_title = $wrapper_showcase->field_show_case_title->value();
    $show_case_subtitle = $wrapper_showcase->field_show_case_subtext->value();
    $show_case_cover_image = $wrapper_showcase->field_showcase_cover->value();

    $vars['cover_image'] = '';
    $cover_image_alt = $node->title;
    $vars['link_target'] = '';

    // If a Featured Image is provided we need to use it.
    if (empty($show_case_cover_image) || !isset($show_case_cover_image)) {
      if (!empty($content['field_cover_image'][0]['#item']['alt'])) {
        $cover_image_alt = $content['field_cover_image'][0]['#item']['alt'];
      }
      if (!empty($content['field_cover_image'][0])) {
        $args = array(
          'path' => $content['field_cover_image'][0]['#item']['uri'],
          'style_name' => $content['field_cover_image'][0]['#image_style'],
          'alt' => $cover_image_alt,
        );
        $vars['cover_image'] = theme('image_style', $args);
      }
    }
    else {
      if (!empty($show_case_cover_image['alt'])) {
        $cover_image_alt = $show_case_cover_image['alt'];
      }
      $args = array(
        'path' => $show_case_cover_image['uri'],
        'style_name' => 'delta__775x515',
        'alt' => $cover_image_alt,
      );
      $vars['cover_image'] = theme('image_style', $args);
    }

    // Change node_url to point to what promotion is promoting.
    if ($node->type == 'promotion') {
      $vars['node_url'] = $node->field_promotion_link[$node->language][0]['url'];
      $vars['link_target'] = !empty($node->field_promotion_link[$node->language][0]['attributes']['target']) ? 'target="' . $node->field_promotion_link[$node->language][0]['attributes']['target'] . '"' : '';
    }

    if (isset($show_case_subtitle)) {
      $vars['subtitle'] = $show_case_subtitle;
    }
    elseif ($content['field_subtitle'][0]['#markup']) {
      $vars['subtitle'] = render($content['field_subtitle'][0]['#markup']);
    }
    else {
      $vars['subtitle'] = '';
    }

    $vars['featured_title'] = isset($show_case_title) ? $show_case_title : $node->title;

    if ($node->nid == 22) {

    }

    if (isset($node->field_featured_showcase) && !empty($node->field_featured_showcase)) {
      $items = field_get_items('node', $node, 'field_featured_showcase');
      foreach ($items as $item) {
        $collection = field_collection_field_get_entity($item);
        if (isset($collection->field_showcase_cover) && !empty($collection->field_showcase_cover)) {
          $file = $collection->field_showcase_cover[LANGUAGE_NONE]['0'];
          if (isset($file['field_file_image_attribution']) && !empty($file['field_file_image_attribution'])) {
            $vars['attribution'] = $file['field_file_image_attribution'][LANGUAGE_NONE][0]['value'];
          }
        }
      }
    }
  }
}

/**
 * Implements theme_menu_link().
 */
function shortwave_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);

  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Helper function to generate css overrides.
 *
 * Use the convention [[variable_name]] in the template file that is loaded.
 *
 * @return string
 *   CSS with theme settings.
 */
function _generate_css_overrides() {
  $variables = array(
    'navigation_font_url' => theme_get_setting('navigation_font_url'),
    'navigation_font_family' => theme_get_setting('navigation_font_family') ? theme_get_setting('navigation_font_family') : "'Francois One', sans-serif",
    'navigation_color' => theme_get_setting('navigation_color') ? theme_get_setting('navigation_color') : '#FFF',
    'navigation_background_color' => theme_get_setting('navigation_background_color') ? theme_get_setting('navigation_background_color') : '#000',
    'navigation_hover_color' => theme_get_setting('navigation_hover_color') ? theme_get_setting('navigation_hover_color') : '#FFF',
    'navigation_background_hover_color' => theme_get_setting('navigation_background_hover_color') ? theme_get_setting('navigation_background_hover_color') : '#2C8EC6',
    'sub_navigation_background_hover_color' => theme_get_setting('sub_navigation_background_hover_color') ? theme_get_setting('sub_navigation_background_hover_color') : '#006B92',
    'social_navigation_background_hover_color' => theme_get_setting('social_navigation_background_hover_color') ? theme_get_setting('social_navigation_background_hover_color') : '#8CC540',
    'secondary_navigation_color' => theme_get_setting('secondary_navigation_color') ? theme_get_setting('secondary_navigation_color') : '#B2F94E',
    'link_color' => theme_get_setting('link_color') ? theme_get_setting('link_color') : '#595959',
    'link_hover_color' => theme_get_setting('link_hover_color') ? theme_get_setting('link_hover_color') : '#006B92',
    'heading_color' => theme_get_setting('heading_color') ? theme_get_setting('heading_color') : '#000',
    'heading_font_url' => theme_get_setting('heading_font_url'),
    'heading_font_family' => theme_get_setting('heading_font_family') ? theme_get_setting('heading_font_family') : "'Francois One', sans-serif",
    'body_color' => theme_get_setting('body_color') ? theme_get_setting('body_color') : '#333',
    'body_background_color' => theme_get_setting('body_background_color') ? theme_get_setting('body_background_color') : '#F8FAFA',
    'body_font_url' => theme_get_setting('body_font_url'),
    'body_font_family' => theme_get_setting('body_font_family') ? theme_get_setting('body_font_family') : "'Roboto Condensed', sans-serif",
  );
  $path = drupal_get_path('theme', 'shortwave');
  $css = file_get_contents($path . '/assets/stylesheets/theme-customizations.css');
  foreach ($variables as $name => $value) {
    $css = str_replace("[[$name]]", $value, $css);
  }

  return $css;
}
