<?php

namespace Drupal\ae_game;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a game entity type.
 */
interface GameInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the game title.
   *
   * @return string
   *   Title of the game.
   */
  public function getTitle();

  /**
   * Sets the game title.
   *
   * @param string $title
   *   The game title.
   *
   * @return \Drupal\ae_game\GameInterface
   *   The called game entity.
   */
  public function setTitle($title);

  /**
   * Gets the game creation timestamp.
   *
   * @return int
   *   Creation timestamp of the game.
   */
  public function getCreatedTime();

  /**
   * Sets the game creation timestamp.
   *
   * @param int $timestamp
   *   The game creation timestamp.
   *
   * @return \Drupal\ae_game\GameInterface
   *   The called game entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the game status.
   *
   * @return bool
   *   TRUE if the game is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets the game status.
   *
   * @param bool $status
   *   TRUE to enable this game, FALSE to disable.
   *
   * @return \Drupal\ae_game\GameInterface
   *   The called game entity.
   */
  public function setStatus($status);

}
