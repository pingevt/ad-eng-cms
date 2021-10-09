<?php

namespace Drupal\ae_core\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a AeWeaponPlugin annotation object.
 *
 * @see \Drupal\ae_core\AeWeaponPlugin
 * @see plugin_api
 *
 * @Annotation
 */
class AeWeaponPlugin extends Plugin {

  /**
   * Label of plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

}
