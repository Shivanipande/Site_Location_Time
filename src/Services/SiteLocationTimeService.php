<?php

namespace Drupal\site_location_time\Services;

use Drupal\Plugin\Block;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Class SiteLocationTimeService.
 */
class SiteLocationTimeService {
  /**
   * Config Factory Interface.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $config;
  /**
   * Returns Date and Time as selected timezone throught SiteLocationTimeConfigForm.
   */
  public function timezonedetector() {
    $config = \Drupal::config('site_location_time.settings');
    $timezone = $config->get('site_location_time_timezone');
    date_default_timezone_set($timezone);
    $datetime = date("jS M Y - h:i A");// 25th Oct 2019 - 10:30 PM
    return $datetime;
  }
}