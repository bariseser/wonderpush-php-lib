<?php

namespace WonderPush\Obj;

/**
 * DTO part for `installation.device.configuration`.
 * @see InstallationDevice
 */
class InstallationDeviceConfiguration extends Object {

  /** @var string */
  private $timeZone;
  /** @var string */
  private $locale;
  /** @var string */
  private $country;
  /** @var string */
  private $currency;
  /** @var string */
  private $carrier;

  public function __construct($data = null) {
    parent::__construct($data);
  }

  /**
   * @return string
   */
  public function getTimeZone() {
    return $this->timeZone;
  }

  /**
   * @param string $timeZone
   * @return InstallationDeviceConfiguration
   */
  public function setTimeZone($timeZone) {
    $this->timeZone = $timeZone;
    return $this;
  }

  /**
   * @return string
   */
  public function getLocale() {
    return $this->locale;
  }

  /**
   * @param string $locale
   * @return InstallationDeviceConfiguration
   */
  public function setLocale($locale) {
    $this->locale = $locale;
    return $this;
  }

  /**
   * @return string
   */
  public function getCountry() {
    return $this->country;
  }

  /**
   * @param string $country
   * @return InstallationDeviceConfiguration
   */
  public function setCountry($country) {
    $this->country = $country;
    return $this;
  }

  /**
   * @return string
   */
  public function getCurrency() {
    return $this->currency;
  }

  /**
   * @param string $currency
   * @return InstallationDeviceConfiguration
   */
  public function setCurrency($currency) {
    $this->currency = $currency;
    return $this;
  }

  /**
   * @return string
   */
  public function getCarrier() {
    return $this->carrier;
  }

  /**
   * @param string $carrier
   * @return InstallationDeviceConfiguration
   */
  public function setCarrier($carrier) {
    $this->carrier = $carrier;
    return $this;
  }

}