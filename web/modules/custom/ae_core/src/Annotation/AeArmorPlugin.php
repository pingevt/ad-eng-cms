<?php

namespace Drupal\ae_core\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a AeArmorPlugin annotation object.
 *
 * @see \Drupal\ae_core\AeArmorPlugin
 * @see plugin_api
 *
 * @Annotation
 */
class AeArmorPlugin extends Plugin {

  /**
   * Label of plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

}
