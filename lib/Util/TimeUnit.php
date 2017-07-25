<?php

namespace WonderPush\Util;

/**
 * Time units and conversion.
 */
class TimeUnit {

  // Constants are defined by the multiple of seconds they represent
  // or the negative power of ten they are expressed in.
  const NANOSECONDS = -9;  // 10⁻⁹ seconds
  const MICROSECONDS = -6; // 10⁻⁶ seconds
  const MILLISECONDS = -3; // 10⁻³ seconds
  const SECONDS = 1;       // 1 second exactly
  const MINUTES = 60;      // 60 seconds
  const HOURS = 3600;      // 60 minutes
  const DAYS = 86400;      // 24 hours
  const WEEKS = 604800;    // 7 days
  // other typical constants (month, year) don't convert to a constant number of seconds

  /**
   * Asserts the given unit is valid.
   * @param mixed $unit
   */
  public static function assertValidUnit($unit) {
    assert(is_int($unit));
  }

  private static $units = array(
      self::NANOSECONDS,
      self::MICROSECONDS,
      self::MILLISECONDS,
      self::SECONDS,
      self::MINUTES,
      self::HOURS,
      self::DAYS,
      self::WEEKS
  );

  private static $unitsLabels = array( // (prefered label first) (full label last)
      self::NANOSECONDS  => array('ns', 'nanos', 'nanosecond', 'nanoseconds'),
      self::MICROSECONDS => array('us', 'micros', 'microsecond', 'microseconds'),
      self::MILLISECONDS => array('ms', 'millis', 'millisecond', 'milliseconds'),
      self::SECONDS      => array('s', 'sec', 'secs', 'second', 'seconds'),
      self::MINUTES      => array('m', 'min', 'minute', 'minutes'),
      self::HOURS        => array('h', 'hr', 'hour', 'hours'),
      self::DAYS         => array('d', 'day', 'days'),
      self::WEEKS        => array('w', 'week', 'weeks')
  );

  private static $labelsToUnits = null; // lazily initialized

  /**
   * Returns a list of predefined units.
   * @return integer[]
   */
  public static function getUnits() {
    return self::$units;
  }

  /**
   * Returns the labels of a given unit, or of all units.
   * @param integer $unit
   * @return string|null
   */
  public static function getUnitLabels($unit = null) {
    if (null === $unit) {
      return self::$unitsLabels;
    } else {
      self::assertValidUnit($unit);
      return ArrayUtil::getIfSet(self::$unitsLabels, $unit);
    }
  }

  /**
   * Returns an mapping of labels to associated unit.
   * @return integer[]
   */
  public static function getLabelsToUnits() {
    if (null === self::$labelsToUnits) {
      $map = array();
      foreach (self::$unitsLabels as $unit => $labels) {
        foreach ($labels as $label) {
          assert(!isset($map[$label]));
          $map[$label] = $unit;
        }
      }
      self::$labelsToUnits = $map;
    }
    return self::$labelsToUnits;
  }

  /**
   * Returns the unit associated to the given label.
   * @param string $label
   * @return integer|null
   */
  public static function labelToUnit($label) {
    return ArrayUtil::getIfSet(self::getLabelsToUnits(), $label);
  }

  /**
   * Converts a value from a given unit to another.
   * @param integer|float $value
   * @param integer $fromUnit
   * @param integer $toUnit
   * @return integer|float
   */
  public static function convert($value, $fromUnit, $toUnit) {
    self::assertValidUnit($fromUnit);
    self::assertValidUnit($toUnit);
    assert(is_numeric($value));

    if ($fromUnit === $toUnit) {
      return $value;
    }

    // Normalize 1 second to 10⁰ seconds
    if ($fromUnit === 1) $fromUnit = 0;
    if ($toUnit === 1) $toUnit = 0;

    if ($fromUnit <= 0) {

      if ($toUnit <= 0) {

        return $value * pow(10, $fromUnit - $toUnit);

      } else {

        return $value * pow(10, $fromUnit) / $toUnit;

      }

    } else {

      if ($toUnit <= 0) {

        return $value * $fromUnit / pow(10, $toUnit);

      } else {

        return $value * ((float)$fromUnit / $toUnit);

      }

    }
  }

}
