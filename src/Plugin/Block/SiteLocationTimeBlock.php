<?php

namespace Drupal\site_location_time\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;


/**
 * Provides a 'Site Location Time' Block.
 *
 * @Block(
 *   id = "site_location_time_block",
 *   admin_label = @Translation("Site Location Time Block"),
 *   category = @Translation("Site Location Time"),
 * )
 */
class SiteLocationTimeBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
            $configuration, $plugin_id, $plugin_definition
    );
  }

    /**
   * {@inheritdoc}
   */
  public function build() {

      $timezone = $city = $country = $timeontimezone ='';
      $tag = $contexts = [];
      $config = \Drupal::config('site_location_time.settings');
      $timezone = $config->get('site_location_time_timezone');
      $city = $config->get('site_location_time_city');
      $country = $config->get('site_location_time_country');

      $timezone = \Drupal::service('site_location_time.timezone');
      $timeontimezone = $timezone->timezonedetector();

    $build = [
      '#theme' => 'site_location_time_block',
      '#city' => $city,
      '#country' => $country,
      '#timezone' => $timeontimezone,
      '#markup' => 'Gundrel',
    ];
    return $build;
  }

  public function getCacheMaxAge() {
    return 0;
  }

}
