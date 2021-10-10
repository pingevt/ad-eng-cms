<?php

namespace Drupal\ae_core\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a AeToolPlugin annotation object.
 *
 * @see \Drupal\ae_core\AeToolPlugin
 * @see plugin_api
 *
 * @Annotation
 */
class AeToolPlugin extends Plugin {

  /**
   * Label of plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

}
