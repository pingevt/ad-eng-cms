<?php

namespace Drupal\ae_character;

/**
 * Class to define Character Sizes.
 */
class CharacterSize {

  public const SMALL = 0;
  public const MEDIUM = 1;
  public const LARGE = 2;

  private const LABELS = [
    self::SMALL => "Small",
    self::MEDIUM => "Medium",
    self::LARGE => "Large",
  ];

  /**
   * Get label.
   */
  public static function getLabel(int $id):string {

    if (self::LABELS[$id]) {
      return self::LABELS[$id];
    }

    return "";
  }

  /**
   * Get array of options.
   */
  public static function getOptions() {
    return self::LABELS;
  }

}
