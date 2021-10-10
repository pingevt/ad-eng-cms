<?php

namespace Drupal\ae_core\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a AeDmgTypePlugin annotation object.
 *
 * @see \Drupal\ae_core\AeDmgTypePlugin
 * @see plugin_api
 *
 * @Annotation
 */
class AeDmgTypePlugin extends Plugin {

  /**
   * Label of plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

}
