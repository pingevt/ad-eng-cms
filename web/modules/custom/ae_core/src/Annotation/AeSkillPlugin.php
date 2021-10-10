<?php

namespace Drupal\ae_core\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a AeSkillPlugin annotation object.
 *
 * @see \Drupal\ae_core\AeSkillPlugin
 * @see plugin_api
 *
 * @Annotation
 */
class AeSkillPlugin extends Plugin {

  /**
   * Label of plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

}
