<?php

namespace Drupal\ae_character\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Character type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "character_type",
 *   label = @Translation("Character type"),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\ae_character\Form\CharacterTypeForm",
 *       "edit" = "Drupal\ae_character\Form\CharacterTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\ae_character\CharacterTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   admin_permission = "administer character types",
 *   bundle_of = "character",
 *   config_prefix = "character_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/character_types/add",
 *     "edit-form" = "/admin/structure/character_types/manage/{character_type}",
 *     "delete-form" = "/admin/structure/character_types/manage/{character_type}/delete",
 *     "collection" = "/admin/structure/character_types"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *   }
 * )
 */
class CharacterType extends ConfigEntityBundleBase {

  /**
   * The machine name of this character type.
   *
   * @var string
   */
  protected $id;

  /**
   * The human-readable name of the character type.
   *
   * @var string
   */
  protected $label;

}
