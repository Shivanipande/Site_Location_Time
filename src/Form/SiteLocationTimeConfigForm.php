<?php

namespace Drupal\site_location_time\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactory;

/**
 * Implements the SimpleForm form controller.
 *
 * This example demonstrates a simple form with a single text input element. We
 * extend FormBase which is the simplest form base class used in Drupal.
 *
 * @see \Drupal\Core\Form\FormBase
 */
class SiteLocationTimeConfigForm extends ConfigFormBase {
  /**
   * Config Factory.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * Class constructor.
   */
  public function __construct(ConfigFactory $configFactory) {
    $this->configFactory = $configFactory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
    );
  }

  /** 
   * Implements \Drupal\Core\Form\FormInterface::getFormID()
   */
  public function getFormId() {
    return 'site_location_time_settings';
  }

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'site_location_time.settings',
    ];
  }
  /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('site_location_time.settings');  
    $settings = $config->get();

 
    $country='';
    $city='';
    $timezone='';

    if (isset($settings['site_location_time_country']) && trim($settings['site_location_time_country']) != '') {
      $country = $settings['site_location_time_country'];
    }
    if (isset($settings['site_location_time_city']) && trim($settings['site_location_time_city']) != '') {
      $city = $settings['site_location_time_city'];
    }
    if (isset($settings['site_location_timezone']) && trim($settings['site_location_time_zone']) != '') {
      $timezone = $settings['site_location_zone'];
    }
      $form['site_location_time_city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#required' => TRUE,
      '#description' => $this->t('Entry the City Name'),
      '#default_value' => $config->get('site_location_time_city'),
      ];
      $form['site_location_time_country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#required' => TRUE,
      '#description' => $this->t('Entry the Country Name'),
      '#default_value' => $config->get('site_location_time_country'),
      ]; 
      $form['site_location_time_timezone'] = [
      '#type' => 'select',
      '#title' => $this->t('Timezone'),
      '#required' => TRUE,
      '#autocomplete'=>"off",
      '#description' => $this->t('Select your timezone from the list.'),
      '#default_value' => $config->get("site_location_time_timezone"),
      "#options" => array(
      "America/Chicago" => t("America/Chicago"), 
      "America/New_York" => t("America/New_York"),
      "Asia/Tokyo" => t("Asia/Tokyo"),
      "Asia/Dubai" => t("Asia/Dubai"), 
      "Asia/Kolkata" => t("Asia/Kolkata"),
      "Europe/Amsterdam" => t("Europe/Amsterdam"),
      "Europe/Oslo" => t("Europe/Oslo"), 
      "Europe/London" => t("Europe/London"),
      ),
      ];
      
    return parent::buildForm($form, $form_state);
  }

  /** 
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration.
    $values = $form_state->getValues();
    $config = $this->configFactory->getEditable('site_location_time.settings');
    $config
      ->set('site_location_time_country', ($values['site_location_time_country']))
      ->set('site_location_time_city', ($values['site_location_time_city']))
      ->set('site_location_time_timezone', ($values['site_location_time_timezone']))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
