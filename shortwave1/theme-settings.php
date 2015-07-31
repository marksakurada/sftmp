<?php
/**
 * @file
 * Theme settings.
 */

/**
 * Implements theme_settings().
 *
 * See template.php for how some of these settings are included in a stylesheet.
 */
function shortwave_form_system_theme_settings_alter(&$form, &$form_state) {
  // Ensure this include file is loaded when the form is rebuilt from the cache.
  $form_state['build_info']['files']['form'] = drupal_get_path('theme', 'shortwave') . '/theme-settings.php';

  $form['shortwave_header'] = array(
    '#title' => t('Header Logo Settings'),
    '#type' => 'fieldset',
  );

  $form['shortwave_header']['logo_large'] = array(
    '#title' => t('Large Logo'),
    '#type' => 'managed_file',
    '#description' => t('Must be exactly 310px x 100px'),
    '#default_value' => theme_get_setting('logo_large'),
    '#upload_location' => file_default_scheme() . '://general/',
  );

  $form['shortwave_header']['logo_small'] = array(
    '#title' => t('Small Logo'),
    '#type' => 'managed_file',
    '#description' => t('Must be exactly 185px x 45px'),
    '#default_value' => theme_get_setting('logo_small'),
    '#upload_location' => file_default_scheme() . '://general/',
  );

  // Add theme settings here.
  $form['shortwave_theme_settings'] = array(
    '#title' => t('Theme Settings'),
    '#type' => 'fieldset',
  );

  // Copyright.
  $copyright = theme_get_setting('copyright');
  $form['shortwave_theme_settings']['copyright'] = array(
    '#title' => t('Copyright'),
    '#type' => 'text_format',
    '#format' => $copyright['format'],
    '#default_value' => $copyright['value'] ? $copyright['value'] : t('&copy; Entercom 2015'),
  );

  // Footer Text.
  $footer_text = theme_get_setting('footer_text');
  $form['shortwave_theme_settings']['footer_text'] = array(
    '#title' => t('Footer Text'),
    '#type' => 'text_format',
    '#description' => t('This text appears directly below the footer navigation'),
    '#format' => $footer_text['format'],
    '#default_value' => $footer_text['value'],
  );

  // Social Media Settings.
  $form['shortwave_social_media'] = array(
    '#title' => t('Social Media'),
    '#type' => 'fieldset',
    '#description' => t('The below items will display in the header and footer'),
  );

  $form['shortwave_social_media']['social_media_facebook'] = array(
    '#title' => t('Facebook URL'),
    '#description' => t('Enter the URL to the station Facebook page'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('social_media_facebook'),
  );

  $form['shortwave_social_media']['social_media_twitter'] = array(
    '#title' => t('Twitter URL'),
    '#description' => t('Enter the URL to the station Twitter page'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('social_media_twitter'),
  );

  // Mobile App Settings.
  $form['shortwave_mobile_apps'] = array(
    '#title' => t('Mobile Apps'),
    '#type' => 'fieldset',
    '#description' => t('The below items will display in the footer'),
  );

  $form['shortwave_mobile_apps']['mobile_app_android'] = array(
    '#title' => t('Android App'),
    '#description' => t('Enter the URL to the station Android App'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('mobile_app_android'),
  );

  $form['shortwave_mobile_apps']['mobile_app_iphone'] = array(
    '#title' => t('iPhone App'),
    '#description' => t('Enter the URL to the station iPhone App'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('mobile_app_iphone'),
  );

  // Theme customizations.
  $form['shortwave_theme_customizations_navigation'] = array(
    '#title' => t('Main Navigation'),
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['shortwave_theme_customizations_navigation']['navigation_font_url'] = array(
    '#title' => t('Navigation font URL'),
    '#description' => t('Enter the URL to the Google Font you would like to use. This will be inserted in the "@import url()" directive. Ex: http://fonts.googleapis.com/css?family=Roboto+Condensed'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('navigation_font_url'),
  );
  $form['shortwave_theme_customizations_navigation']['navigation_font_family'] = array(
    '#title' => t('Navigation font CSS name'),
    '#description' => t("Enter the corresponding CSS font-family property for the font chosen above. For this example, the declaration would be 'Roboto Condensed', sans-serif."),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('navigation_font_family'),
  );
  $form['shortwave_theme_customizations_navigation']['navigation_color'] = array(
    '#title' => t('Navigation text color'),
    '#description' => t('Enter the hex value of the color. Include the hash symbol (#).'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('navigation_color'),
  );
  $form['shortwave_theme_customizations_navigation']['navigation_background_color'] = array(
    '#title' => t('Navigation background color'),
    '#description' => t('Enter the hex value of the color. Include the hash symbol (#).'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('navigation_background_color'),
  );
  $form['shortwave_theme_customizations_navigation']['navigation_hover_color'] = array(
    '#title' => t('Navigation text hover color'),
    '#description' => t('Enter the hex value of the color. Include the hash symbol (#).'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('navigation_hover_color'),
  );
  $form['shortwave_theme_customizations_navigation']['navigation_background_hover_color'] = array(
    '#title' => t('Navigation background hover color'),
    '#description' => t('Enter the hex value of the color. Include the hash symbol (#).'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('navigation_background_hover_color'),
  );
  $form['shortwave_theme_customizations_navigation']['sub_navigation_background_hover_color'] = array(
    '#title' => t('Sub-navigation background hover color'),
    '#description' => t('Enter the hex value of the color. Include the hash symbol (#).'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('sub_navigation_background_hover_color'),
  );
  $form['shortwave_theme_customizations_navigation']['social_navigation_background_hover_color'] = array(
    '#title' => t('Navigation Social background hover color'),
    '#description' => t('Enter the hex value of the color. Include the hash symbol (#).'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('social_navigation_background_hover_color'),
  );
  $form['shortwave_theme_customizations_navigation']['secondary_navigation_color'] = array(
    '#title' => t('Secondary text navigation color'),
    '#description' => t('Enter the hex value of the color. Include the hash symbol (#).'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('secondary_navigation_color'),
  );

  $form['shortwave_theme_customizations_links'] = array(
    '#title' => t('Links'),
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['shortwave_theme_customizations_links']['link_color'] = array(
    '#title' => t('Link color'),
    '#description' => t('Enter the hex value of the color. Include the hash symbol (#).'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('link_color'),
  );
  $form['shortwave_theme_customizations_links']['link_hover_color'] = array(
    '#title' => t('Link hover color'),
    '#description' => t('Enter the hex value of the color. Include the hash symbol (#).'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('link_hover_color'),
  );

  $form['shortwave_theme_customizations_headings'] = array(
    '#title' => t('Headings'),
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['shortwave_theme_customizations_headings']['heading_color'] = array(
    '#title' => t('Heading color'),
    '#description' => t('Enter the hex value of the color. Include the hash symbol (#).'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('heading_color'),
  );
  $form['shortwave_theme_customizations_headings']['heading_font_url'] = array(
    '#title' => t('Heading font URL'),
    '#description' => t('Enter the URL to the Google Font you would like to use. This will be inserted in the "@import url()" directive. Ex: http://fonts.googleapis.com/css?family=Roboto+Condensed'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('heading_font_url'),
  );
  $form['shortwave_theme_customizations_headings']['heading_font_family'] = array(
    '#title' => t('Heading font CSS name'),
    '#description' => t("Enter the corresponding CSS font-family property for the font chosen above. For this example, the declaration would be 'Roboto Condensed', sans-serif."),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('heading_font_family'),
  );

  $form['shortwave_theme_customizations_body'] = array(
    '#title' => t('Theme Customizations'),
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['shortwave_theme_customizations_body']['body_color'] = array(
    '#title' => t('Body text color'),
    '#description' => t('Enter the hex value of the color. Include the hash symbol (#).'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('body_color'),
  );
  $form['shortwave_theme_customizations_body']['body_background_color'] = array(
    '#title' => t('Background color'),
    '#description' => t('Enter the hex value of the color. Include the hash symbol (#).'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('body_background_color'),
  );
  $form['shortwave_theme_customizations_body']['body_font_url'] = array(
    '#title' => t('Body font URL'),
    '#description' => t('Enter the URL to the Google Font you would like to use. This will be inserted in the "@import url()" directive. Ex: http://fonts.googleapis.com/css?family=Roboto+Condensed'),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('body_font_url'),
  );
  $form['shortwave_theme_customizations_body']['body_font_family'] = array(
    '#title' => t('Body font CSS name'),
    '#description' => t("Enter the corresponding CSS font-family property for the font chosen above. For this example, the declaration would be 'Roboto Condensed', sans-serif."),
    '#type' => 'textfield',
    '#default_value' => theme_get_setting('body_font_family'),
  );

  unset($form['logo']);
  unset($form['theme_settings']['toggle_logo']);

  // Add in a custom submit handler so we can permanently save the files
  // http://ghosty.co.uk/2014/03/managed-file-upload-in-drupal-theme-settings/
  $form['#submit'][] = 'shortwave_settings_form_submit';
  // Get all themes.
  $themes = list_themes();
  // Get the current theme.
  $active_theme = $GLOBALS['theme_key'];
  $form_state['build_info']['files'][] = str_replace("/$active_theme.info", '', $themes[$active_theme]->filename) . '/theme-settings.php';

  return $form;
}

/**
 * Implements hook_form_submit().
 *
 * Makes sure that files uploaded through the theme settings page
 * get set to be permanently saved.
 *
 * Follows the method described in
 * http://ghosty.co.uk/2014/03/managed-file-upload-in-drupal-theme-settings/
 */
function shortwave_settings_form_submit(&$form, $form_state) {
  $header_image_fields = array('logo_large', 'logo_small');

  foreach ($header_image_fields as $image_field) {
    $image_fid = $form_state['values'][$image_field];
    $image = file_load($image_fid);
    if (is_object($image)) {
      // Check to make sure that the file is set to be permanent.
      if ($image->status == 0) {
        // Update the status.
        $image->status = FILE_STATUS_PERMANENT;
        // Save the update.
        file_save($image);
        // Add a reference to prevent warnings.
        file_usage_add($image, 'shortwave', 'theme', 1);
      }
    }
  }
}
