<?php

namespace WonderPush;

class Object implements Util\JsonSerializable {

  public function __construct($data = null) {
    if ($data !== null) {
      $this->updateFieldsFromData($data);
    }
  }

  /**
   * Factory style constructor.
   * Compensates PHP 5.3's lack of (new Class())-> syntax support.
   * @param array $data
   * @return \static
   */
  public static function _new($data = null) {
    return new static($data);
  }

  public function clearAllFields() {
    $class = new \ReflectionClass($this);
    $methods = $class->getMethods(\ReflectionMethod::IS_PUBLIC);
    foreach ($methods as $method) {
      if ($method->getDeclaringClass()->getName() === 'Object') {
        continue;
      }
      /* @var $method \ReflectionMethod */
      if (!Util\StringUtil::beginsWith($method->getName(), 'set')) {
        continue; // not a setter
      }
      if (Util\StringUtil::endsWith($method->getName(), 'FromData')) {
        continue; // avoid using the FromData variant, we need to set real nulls and avoid Object::$NULL
      }
      try {
        $this->{$method->getName()}(null);
      } catch (Exception $ex) {
        error_log('[' . __METHOD__ . '()] Exception caught while invoking ' . $method->getName() . "(null)\n" . $ex->getTraceAsString());
      }
    }
  }

  /**
   * Updates the fields present in $data.
   * @param array $data
   */
  protected function updateFieldsFromData($data) {
    if (!is_array($data) && !is_object($data)) {
      $ex = new Exception();
      error_log('[' . __METHOD__ . '] Not an array or object: ' . json_encode($data) . "\n" . $ex->getTraceAsString());
    }
    foreach ($data as $key => $value) {
      $methodName = 'set' . ucfirst($key) . 'FromData';
      if (method_exists($this, $methodName)) {
        $this->{$methodName}($value);
      } else {
        $methodName = 'set' . ucfirst($key);
        if (method_exists($this, $methodName)) {
          if ($value === null) $value = NullObject::getInstance();
          $this->{$methodName}($value);
        }
      }
    }
  }

  protected function buildDataFromField($value) {
    if ($value instanceof Object) {
      return $value->buildDataFromFields();
    } else if ($value instanceof JsonSerializable) {
      return $value->jsonSerialize();
    } else if (is_array($value)) {
      $newValues = array();
      foreach ($value as $k => $v) {
	$newValues[$k] = $this->buildDataFromField($v);
      }
      return $newValues;
    } else {
      return $value;
    }
  }

  protected function buildDataFromFields() {
    $data = new \stdClass();

    $x = new \ReflectionClass(get_class($this));
    $methods = $x->getMethods(\ReflectionMethod::IS_PUBLIC);
    foreach ($methods as $method) {
      if (!$method->isStatic()) {
        if (Util\StringUtil::beginsWith($method->name, 'get')) {
          $field = substr($method->name, 3);
          $field{0} = strtolower($field{0});
          $value = $method->invoke($this);
          if ($value !== null) {
            $data->{$field} = $this->buildDataFromField($value);
          }
        }
      }
    }

    return $data;
  }

  protected static function instantiateForSetter($type, $data) {
    if (Util\StringUtil::endsWith($type, '[]')) {
      $type = substr($type, 0, -2);
      return array_map(function($item) use ($type) {
        return self::instantiateForSetter($type, $item);
      }, $data);
    } else if (is_array($data) || $data instanceof \stdClass) {
      return new $type($data);
    } else {
      return $data;
    }
  }

  /**
   * Implements JsonSerializable
   * @return array
   */
  public function jsonSerialize() {
    return $this->toData();
  }

  public function __toString() {
    if (defined('JSON_UNESCAPED_SLASHES')) {
      return '<' . get_class($this) . '>' . json_encode($this, JSON_UNESCAPED_SLASHES);
    } else {
      return '<' . get_class($this) . '>' . json_encode($this);
    }
  }

  /**
   * Returns an object representation of this instance.
   *
   * Note that empty() returns null for an object with no properties, unlike for an empty array.
   *
   * @return \stdClass
   */
  public function toData() {
    return $this->buildDataFromFields();
  }

  /**
   * Returns an array representation of this instance.
   *
   * Note that when serializing an empty instance to JSON you will get `[]` instead of `{}`.
   *
   * @return array
   */
  public function toArray() {
    return (array)$this->buildDataFromFields();
  }

  public function deepClone() {
    return unserialize(serialize($this));
  }

}

/**
 * This class creates
 */
class NullObject extends Object {

  private static $_instance = null;

  /**
   * DO NOT CALL.
   * @throws \LogicException
   * @see \WonderPush\NullObject::getInstance()
   */
  public function __construct() {
    if (self::$_instance !== null) {
      throw new \LogicException('You should not instantiate \WonderPush\NullObject, use \WonderPush\NullObject::getInstance() instead.');
    }
    parent::__construct(null);
  }

  public static function getInstance() {
    if (self::$_instance === null) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  protected function buildDataFromFields() {
    return null;
  }

}

NullObject::getInstance(); // ensure creation and that calling the constructor throws
