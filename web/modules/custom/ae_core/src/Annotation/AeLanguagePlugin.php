<?php

namespace Drupal\ae_core\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a AeLanguagePlugin annotation object.
 *
 * @see \Drupal\ae_core\AeLanguagePlugin
 * @see plugin_api
 *
 * @Annotation
 */
class AeLanguagePlugin extends Plugin {

  /**
   * Label of plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

}
