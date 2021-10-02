<?php

namespace Drupal\ae_character;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a character entity type.
 */
interface CharacterInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the character title.
   *
   * @return string
   *   Title of the character.
   */
  public function getTitle();

  /**
   * Sets the character title.
   *
   * @param string $title
   *   The character title.
   *
   * @return \Drupal\ae_character\CharacterInterface
   *   The called character entity.
   */
  public function setTitle($title);

  /**
   * Gets the character creation timestamp.
   *
   * @return int
   *   Creation timestamp of the character.
   */
  public function getCreatedTime();

  /**
   * Sets the character creation timestamp.
   *
   * @param int $timestamp
   *   The character creation timestamp.
   *
   * @return \Drupal\ae_character\CharacterInterface
   *   The called character entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the character status.
   *
   * @return bool
   *   TRUE if the character is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets the character status.
   *
   * @param bool $status
   *   TRUE to enable this character, FALSE to disable.
   *
   * @return \Drupal\ae_character\CharacterInterface
   *   The called character entity.
   */
  public function setStatus($status);

}
