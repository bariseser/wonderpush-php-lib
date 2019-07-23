<?php

namespace WonderPush\Params;

use WonderPush\Obj\BaseObject;

class DeliveriesCreateParams extends BaseObject {

  /**
   * The endpoint of this API.
   */
  const PATH = '/deliveries';

  private $viewId;
  private $campaignId;
  private $targetType;
  private $targetValues;
  private $segmentParams;
  private $notification;
  private $notificationOverride;
  private $notificationParams;
  private $notificationId;

  protected function buildDataFromFields() {
    return (object) \WonderPush\Util\ArrayUtil::filterNulls(array(
      'viewId' => $this->viewId,
      'campaignId' => $this->campaignId,
      $this->targetType => $this->targetValues,
      'segmentParams' => $this->segmentParams,
      // With PHP 5.3.x, json_encode strips protected and private properties
      // Transforming to array to avoid this
      'notification' => $this->notification ? (object)$this->notification->toArray() : null,
      'notificationOverride' => $this->notificationOverride ? (is_array($this->notificationOverride) ? $this->notificationOverride : (object)$this->notificationOverride->toArray()) : null,
      'notificationParams' => $this->notificationParams,
      'notificationId' => $this->notificationId,
    ));
  }

  /**
   * @param string $viewId
   * @return $this
   */
  public function setViewId($viewId) {
    $this->viewId = $viewId;
    return $this;
  }

  /**
   * @param string $campaignId
   * @return $this
   */
  public function setCampaignId($campaignId) {
    $this->campaignId = $campaignId;
    return $this;
  }

  /**
   * @param string|string[] $segmentId A single id, an array of ids, or multiple id parameters.
   * @return $this
   */
  public function setTargetSegmentIds($segmentId) {
    $this->targetType = 'targetSegmentIds';
    $this->targetValues = \WonderPush\Util\ArrayUtil::flatten(func_get_args());
    return $this;
  }

  /**
   * @param array $segment A segment definition
   * @return $this
   */
  public function setTargetSegmentBody($segment) {
    $this->targetType = 'targetSegmentBody';
    $this->targetValues = $segment;
    return $this;
  }

  /**
   * @param string|string[] $userId A single id, an array of ids, or multiple id parameters.
   * @return $this
   */
  public function setTargetUserIds($userId) {
    $this->targetType = 'targetUserIds';
    $this->targetValues = \WonderPush\Util\ArrayUtil::flatten(func_get_args());
    return $this;
  }

  /**
   * @param string|string[] $installationId A single id, an array of ids, or multiple id parameters.
   * @return $this
   */
  public function setTargetInstallationIds($installationId) {
    $this->targetType = 'targetInstallationIds';
    $this->targetValues = \WonderPush\Util\ArrayUtil::flatten(func_get_args());
    return $this;
  }

  /**
   * @param string|string[] $deviceIds A single id, an array of ids, or multiple id parameters.
   * @return $this
   */
  public function setTargetDeviceIds($deviceIds) {
    $this->targetType = 'targetDeviceIds';
    $this->targetValues = \WonderPush\Util\ArrayUtil::flatten(func_get_args());
    return $this;
  }

  /**
   * @param string|string[] $pushTokens A single token, an array of tokens, or multiple token parameters.
   * @return $this
   */
  public function setTargetPushTokens($pushTokens) {
    $this->targetType = 'targetPushTokens';
    $this->targetValues = \WonderPush\Util\ArrayUtil::flatten(func_get_args());
    return $this;
  }

  /**
   * @param string|string[] $accessTokens A single token, an array of tokens, or multiple token parameters.
   * @return $this
   */
  public function setTargetAccessTokens($accessTokens) {
    $this->targetType = 'targetAccessTokens';
    $this->targetValues = \WonderPush\Util\ArrayUtil::flatten(func_get_args());
    return $this;
  }

  /**
   * @param array $segmentParams Segment parameters, or an array of those, one per targeted segment, in the same order.
   * @return $this
   */
  public function setSegmentParams($segmentParams) {
    $this->segmentParams = $segmentParams;
    return $this;
  }

  /**
   * @param string $notificationId
   * @return $this
   */
  public function setNotificationId($notificationId) {
    $this->notificationId = $notificationId;
    return $this;
  }

  /**
   * @param \WonderPush\Obj\Notification|array $notification
   * @return $this
   */
  public function setNotification($notification) {
    $this->notification = $notification;
    return $this;
  }

  /**
   * @param \WonderPush\Obj\Notification|array $notificationOverride
   * @return $this
   */
  public function setNotificationOverride($notificationOverride) {
    $this->notificationOverride = $notificationOverride;
    return $this;
  }

  /**
   * @param array $notificationParams Notification parameters.
   * @return $this
   */
  public function setNotificationParams($notificationParams) {
    $this->notificationParams = $notificationParams;
    return $this;
  }
}