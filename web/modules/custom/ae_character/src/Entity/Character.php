<?php

namespace Drupal\ae_character\Entity;

use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\RevisionableContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\ae_character\CharacterInterface;
use Drupal\user\UserInterface;

/**
 * Defines the character entity class.
 *
 * @ContentEntityType(
 *   id = "character",
 *   label = @Translation("Character"),
 *   label_collection = @Translation("Characters"),
 *   bundle_label = @Translation("Character type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\ae_character\CharacterListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\ae_character\CharacterAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\ae_character\Form\CharacterForm",
 *       "edit" = "Drupal\ae_character\Form\CharacterForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "character",
 *   data_table = "character_field_data",
 *   revision_table = "character_revision",
 *   revision_data_table = "character_field_revision",
 *   show_revision_ui = TRUE,
 *   translatable = TRUE,
 *   admin_permission = "administer character types",
 *   entity_keys = {
 *     "id" = "id",
 *     "revision" = "revision_id",
 *     "langcode" = "langcode",
 *     "bundle" = "bundle",
 *     "label" = "name",
 *     "uuid" = "uuid"
 *   },
 *   revision_metadata_keys = {
 *     "revision_user" = "revision_uid",
 *     "revision_created" = "revision_timestamp",
 *     "revision_log_message" = "revision_log"
 *   },
 *   links = {
 *     "add-form" = "/admin/content/character/add/{character_type}",
 *     "add-page" = "/admin/content/character/add",
 *     "canonical" = "/character/{character}",
 *     "edit-form" = "/admin/content/character/{character}/edit",
 *     "delete-form" = "/admin/content/character/{character}/delete",
 *     "collection" = "/admin/content/character"
 *   },
 *   bundle_entity_type = "character_type",
 *   field_ui_base_route = "entity.character_type.edit_form"
 * )
 */
class Character extends RevisionableContentEntityBase implements CharacterInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   *
   * When a new character entity is created, set the uid entity reference to
   * the current user as the creator of the entity.
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += ['uid' => \Drupal::currentUser()->id()];
  }

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return $this->get('title')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setTitle($title) {
    $this->set('title', $title);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isEnabled() {
    return (bool) $this->get('status')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setStatus($status) {
    $this->set('status', $status);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('uid')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('uid')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('uid', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('uid', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the character.'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('view', TRUE);

    // Base Stats.
    $fields['str'] = BaseFieldDefinition::create('integer')
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setLabel(t('Strength'))
      ->setDescription(t('The base strength of the character.'))
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'type' => 'number_decimal',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('view', TRUE);
    $fields['dex'] = BaseFieldDefinition::create('integer')
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setLabel(t('Dexterity'))
      ->setDescription(t('The base dexterity of the character.'))
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'type' => 'number_decimal',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('view', TRUE);
    $fields['con'] = BaseFieldDefinition::create('integer')
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setLabel(t('Constitution'))
      ->setDescription(t('The base constitution of the character.'))
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'type' => 'number_decimal',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('view', TRUE);
    $fields['int'] = BaseFieldDefinition::create('integer')
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setLabel(t('Intelligence'))
      ->setDescription(t('The base intelligence of the character.'))
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'type' => 'number_decimal',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('view', TRUE);
    $fields['wis'] = BaseFieldDefinition::create('integer')
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setLabel(t('Wisdom'))
      ->setDescription(t('The base wisdom of the character.'))
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'type' => 'number_decimal',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('view', TRUE);
    $fields['cha'] = BaseFieldDefinition::create('integer')
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setLabel(t('Charisma'))
      ->setDescription(t('The base charisma of the character.'))
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'type' => 'number_decimal',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('view', TRUE);

    // Entity Basics.
    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setRevisionable(TRUE)
      ->setLabel(t('Status'))
      ->setDescription(t('A boolean indicating whether the character is enabled.'))
      ->setDefaultValue(TRUE)
      ->setSetting('on_label', 'Enabled')
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => FALSE,
        ],
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'boolean',
        'label' => 'above',
        'weight' => 0,
        'settings' => [
          'format' => 'enabled-disabled',
        ],
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['uid'] = BaseFieldDefinition::create('entity_reference')
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE)
      ->setLabel(t('Author'))
      ->setDescription(t('The user ID of the character author.'))
      ->setSetting('target_type', 'user')
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'placeholder' => '',
        ],
        'weight' => 15,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'author',
        'weight' => 15,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Authored on'))
      ->setTranslatable(TRUE)
      ->setDescription(t('The time that the character was created.'))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'timestamp',
        'weight' => 20,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('form', [
        'type' => 'datetime_timestamp',
        'weight' => 20,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setTranslatable(TRUE)
      ->setDescription(t('The time that the character was last edited.'));

    return $fields;
  }

  /**
   * Get the base Stats of the character.
   *
   * @return array
   *   Array of base ststa.
   */
  public function getBaseStats() {
    return [
      'str' => (int) $this->str->value,
      'dex' => (int) $this->dex->value,
      'con' => (int) $this->con->value,
      'int' => (int) $this->int->value,
      'wis' => (int) $this->wis->value,
      'cha' => (int) $this->cha->value,
    ];
  }

}
