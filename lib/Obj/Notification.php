<?php

namespace WonderPush\Obj;

/**
 * DTO for notifications.
 *
 * See {@link https://www.wonderpush.com/docs/concepts/notifications}
 */
class Notification extends Object {

  /** @var string */
  private $id;
  /** @var string */
  private $applicationId;
  /** @var long */
  private $creationDate;
  /** @var long */
  private $updateDate;
  /** @var string */
  private $name;
  /** @var NotificationAlert */
  private $alert;
  /** @var NotificationInApp */
  private $inApp;
  /** @var NotificationPush */
  private $push;

  public function __construct($data = null) {
    parent::__construct($data);
  }

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   * @return Notification
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * @return string
   */
  public function getApplicationId() {
    return $this->applicationId;
  }

  /**
   * @param string $applicationId
   * @return Notification
   */
  public function setApplicationId($applicationId) {
    $this->applicationId = $applicationId;
    return $this;
  }

  /**
   * @return long
   */
  public function getCreationDate() {
    return $this->creationDate;
  }

  /**
   * @param long $creationDate
   * @return Notification
   */
  public function setCreationDate($creationDate) {
    $this->creationDate = $creationDate;
    return $this;
  }

  /**
   * @return long
   */
  public function getUpdateDate() {
    return $this->updateDate;
  }

  /**
   * @param long $updateDate
   * @return Notification
   */
  public function setUpdateDate($updateDate) {
    $this->updateDate = $updateDate;
    return $this;
  }

  /**
   * @return $string
   */
  public function getName() {
   return $this->name;
  }

  /**
   * @param string $name
   * @return Notification
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * @return NotificationAlert
   */
  public function getAlert() {
    return $this->alert;
  }

  /**
   * @param NotificationAlert|array $alert
   * @return Notification
   */
  public function setAlert($alert) {
    $this->alert = Object::instantiateForSetter('\WonderPush\Obj\NotificationAlert', $alert);
    return $this;
  }

  /**
   * @return NotificationInApp
   */
  public function getInApp() {
    return $this->inApp;
  }

  /**
   * @param NotificationInApp|array $inApp
   * @return Notification
   */
  public function setInApp($inApp) {
    $this->inApp = Object::instantiateForSetter('\WonderPush\Obj\NotificationInApp', $inApp);
    return $this;
  }

  /**
   * @return NotificationPush
   */
  public function getPush() {
    return $this->push;
  }

  /**
   * @param NotificationPush|array $push
   * @return Notification
   */
  public function setPush($push) {
    $this->push = Object::instantiateForSetter('\WonderPush\Obj\NotificationPush', $push);
    return $this;
  }

}

/**
 * DTO part base for notification button reusability.
 * @see NotificationButton
 */
class NotificationButton extends Object {

  /** @var string */
  protected $label;
  /** @var string */
  protected $targetUrl;
  /** @var NotificationButtonAction[] */
  protected $actions;

  /**
   * @return string
   */
  public function getLabel() {
    return $this->label;
  }

  /**
   * @param string $label
   * @return NotificationButton
   */
  public function setLabel($label) {
    $this->label = $label;
    return $this;
  }

  /**
   * @return string
   */
  public function getTargetUrl() {
    return $this->targetUrl;
  }

  /**
   * @param string $targetUrl
   * @return NotificationButton
   */
  public function setTargetUrl($targetUrl) {
    $this->targetUrl = $targetUrl;
    return $this;
  }

  /**
   * @return NotificationButtonAction[]
   */
  public function getActions() {
    return $this->actions;
  }

  /**
   * @param NotificationButtonAction[]|array[] $actions
   * @return NotificationButton
   */
  public function setActions($actions) {
    $this->actions = Object::instantiateForSetter('\WonderPush\Obj\NotificationButtonAction[]', $actions);
    return $this;
  }

}

/**
 * DTO part base for notification button action reusability.
 * @see NotificationButton
 */
class NotificationButtonAction extends Object {

  const TYPE_CLOSE = 'close';
  const TYPE_METHOD = 'method';
  const TYPE_TRACKEVENT = 'trackEvent';
  const TYPE_UPDATE_INSTALLATION = 'updateInstallation';
  const TYPE_RESYNC_INSTALLATION = 'resyncInstallation';
  const TYPE__DUMP_STATE = '_dumpState';
  const TYPE__OVERRIDE_SET_LOGGING = '_overrideSetLogging';
  const TYPE__OVERRIDE_NOTIFICATION_RECEIPT = '_overrideNotificationReceipt';
  const TYPE_LINK = 'link';
  const TYPE_RATING = 'rating';
  const TYPE_MAP_OPEN = 'mapOpen';

  public static function listTypes() {
    return array(
        self::TYPE_CLOSE,
        self::TYPE_METHOD,
        self::TYPE_TRACKEVENT,
        self::TYPE_UPDATE_INSTALLATION,
        self::TYPE_LINK,
        self::TYPE_RATING,
        self::TYPE_MAP_OPEN,
    );
  }

  /** @var string A TYPE_* constant */
  protected $type;
  /** @var string */
  protected $method; // for TYPE_METHOD
  /** @var string */
  protected $methodArg; // for TYPE_METHOD
  /** @var string */
  protected $url; // for TYPE_LINK
  /** @var NotificationButtonActionEvent */
  protected $event; // for TYPE_TRACKEVENT
  /** @var array */
  protected $custom; // for TYPE_UPDATE_INSTALLATION (deprecated in favor of $installation)
  /** @var Installation */
  protected $installation; // for TYPE_UPDATE_INSTALLATION and TYPE_RESYNC_INSTALLATION
  /** @var boolean */
  protected $appliedServerSide; // for TYPE_UPDATE_INSTALLATION
  /** @var boolean */
  protected $reset; // for TYPE_RESYNC_INSTALLATION
  /** @var boolean */
  protected $force; // for TYPE_RESYNC_INSTALLATION, TYPE__OVERRIDE_SET_LOGGING and TYPE__OVERRIDE_NOTIFICATION_RECEIPT

  /**
   * @return string A TYPE_* constant
   */
  public function getType() {
    return $this->type;
  }

  /**
   * @param string $type A TYPE_* constant
   * @return NotificationButtonAction
   */
  public function setType($type) {
    $this->type = $type;
    return $this;
  }

  /**
   * @return string
   */
  public function getMethod() {
    return $this->method;
  }

  /**
   * @param string $method
   * @return NotificationButtonAction
   */
  public function setMethod($method) {
    $this->method = $method;
    return $this;
  }

  /**
   * @return string
   */
  public function getMethodArg() {
    return $this->methodArg;
  }

  /**
   * @param string $methodArg
   * @return NotificationButtonAction
   */
  public function setMethodArg($methodArg) {
    $this->methodArg = $methodArg;
    return $this;
  }

  /**
   * @return string
   */
  public function getUrl() {
    return $this->url;
  }

  /**
   * @param string $url
   * @return NotificationButtonAction
   */
  public function setUrl($url) {
    $this->url = $url;
    return $this;
  }

  /**
   * @return NotificationButtonActionEvent
   */
  public function getEvent() {
    return $this->event;
  }

  /**
   * @param NotificationButtonActionEvent|array $event
   * @return NotificationButtonAction
   */
  public function setEvent($event) {
    $this->event = Object::instantiateForSetter('\WonderPush\Obj\NotificationButtonActionEvent', $event);
    return $this;
  }

  /**
   * @return array
   */
  public function getCustom() {
    return $this->custom;
  }

  /**
   * @param array $custom
   * @return NotificationButtonAction
   */
  public function setCustom($custom) {
    $this->custom = $custom;
    return $this;
  }

  /**
   * @return Installation
   */
  public function getInstallation() {
    return $this->installation;
  }

  /**
   * @param Installation|array $installation
   * @return NotificationButtonAction
   */
  public function setInstallation($installation) {
    $this->installation = Object::instantiateForSetter('\WonderPush\Obj\Installation', $installation);
    return $this;
  }

  /**
   * @return boolean
   */
  public function getAppliedServerSide() {
    return $this->appliedServerSide;
  }

  /**
   * @param boolean $appliedServerSide
   * @return NotificationButtonAction
   */
  public function setAppliedServerSide($appliedServerSide) {
    $this->appliedServerSide = $appliedServerSide;
    return $this;
  }

  /**
   * @return boolean
   */
  public function getReset() {
    return $this->reset;
  }

  /**
   * @param boolean $reset
   * @return NotificationButtonAction
   */
  public function setReset($reset) {
    $this->reset = $reset;
    return $this;
  }

  /**
   * @return boolean
   */
  public function getForce() {
    return $this->force;
  }

  /**
   * @param boolean $force
   * @return NotificationButtonAction
   */
  public function setForce($force) {
    $this->force = $force;
    return $this;
  }

}

/**
 * DTO part for notification button action `event` field.
 * @see NotificationButtonAction
 */
class NotificationButtonActionEvent extends Object {

  /** @var string */
  protected $type;
  /** @var array */
  protected $custom;

  /**
   * @return string
   */
  public function getType() {
    return $this->type;
  }

  /**
   * @param string $type
   * @return NotificationButtonActionEvent
   */
  public function setType($type) {
    $this->type = $type;
    return $this;
  }

  /**
   * @return array
   */
  public function getCustom() {
    return $this->custom;
  }

  /**
   * @param array $custom
   * @return NotificationButtonActionEvent
   */
  public function setCustom($custom) {
    $this->custom = $custom;
    return $this;
  }

}

/**
 * DTO part for `notification.alert`.
 * @see Notification
 */
class NotificationAlert extends Object {

  /** @var string */
  protected $text;
  /** @var string */
  protected $title;
  /** @var string */
  protected $targetUrl;
  /** @var NotificationButtonAction[] */
  protected $actions; // at open
  /** @var NotificationButtonAction[] */
  protected $receiveActions; // at reception
  /** @var NotificationAlertIos */
  protected $ios;
  /** @var NotificationAlertAndroid */
  protected $android;
  /** @var NotificationAlertWeb */
  protected $web;

  /**
   * @return string
   */
  public function getText() {
    return $this->text;
  }

  /**
   * @param string $text
   * @return NotificationAlert
   */
  public function setText($text) {
    $this->text = $text;
    return $this;
  }

  /**
   * @return string
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * @param string $title
   * @return NotificationAlert
   */
  public function setTitle($title) {
    $this->title = $title;
    return $this;
  }

  /**
   * @return string
   */
  public function getTargetUrl() {
    return $this->targetUrl;
  }

  /**
   * @param string $targetUrl
   * @return NotificationAlert
   */
  public function setTargetUrl($targetUrl) {
    $this->targetUrl = $targetUrl;
    return $this;
  }

  /**
   * @return NotificationButtonAction[]
   */
  public function getActions() {
    return $this->actions;
  }

  /**
   * @param NotificationButtonAction[]|array[] $actions
   * @return NotificationAlert
   */
  public function setActions($actions) {
    $this->actions = Object::instantiateForSetter('\WonderPush\Obj\NotificationButtonAction[]', $actions);
    return $this;
  }

  /**
   * @return NotificationButtonAction[]
   */
  public function getReceiveActions() {
    return $this->receiveActions;
  }

  /**
   * @param NotificationButtonAction[]|array[] $receiveActions
   * @return NotificationAlert
   */
  public function setReceiveActions($receiveActions) {
    $this->receiveActions = Object::instantiateForSetter('\WonderPush\Obj\NotificationButtonAction[]', $receiveActions);
    return $this;
  }

  /**
   * @return NotificationAlertIos
   */
  public function getIos() {
    return $this->ios;
  }

  /**
   * @param NotificationAlertIos|array $ios
   * @return NotificationAlert
   */
  public function setIos($ios) {
    $this->ios = Object::instantiateForSetter('\WonderPush\Obj\NotificationAlertIos', $ios);
    return $this;
  }

  /**
   * @return NotificationAlertAndroid
   */
  public function getAndroid() {
    return $this->android;
  }

  /**
   * @param NotificationAlertAndroid|array $android
   * @return NotificationAlert
   */
  public function setAndroid($android) {
    $this->android = Object::instantiateForSetter('\WonderPush\Obj\NotificationAlertAndroid', $android);
    return $this;
  }

  /**
   * @return NotificationAlertWeb
   */
  public function getWeb() {
    return $this->web;
  }

  /**
   * @param NotificationAlertWeb|array $web
   * @return NotificationAlert
   */
  public function setWeb($web) {
    $this->web = Object::instantiateForSetter('\WonderPush\Obj\NotificationAlertWeb', $web);
    return $this;
  }

}

/**
 * DTO part for `notification.alert.ios`.
 * @see NotificationAlert
 */
class NotificationAlertIos extends NotificationAlert {

  // title is already taken in the platform-independent parent object
  /** @var string */
  private $titleLocKey;
  /** @var string[] */
  private $titleLocArgs;
  /** @var string */
  private $body;
  /** @var string */
  private $locKey;
  /** @var string[] */
  private $locArgs;
  /** @var string */
  private $actionLocKey;
  /** @var string */
  private $launchImage;
  /** @var integer */
  private $badge;
  /** @var string */
  private $sound;
  /** @var string */
  private $category;
  /** @var integer */
  private $contentAvailable;
  /** @var integer */
  private $mutableContent;
  /** @var NotificationAlertIosForeground */
  private $foreground;
  /** @var NotificationAlertIosAttachment[] */
  private $attachments;

  /**
   * @return string
   */
  public function getTitleLocKey() {
    return $this->titleLocKey;
  }

  /**
   * @param string $titleLocKey
   * @return NotificationAlertIos
   */
  public function setTitleLocKey($titleLocKey) {
    $this->titleLocKey = $titleLocKey;
    return $this;
  }

  /**
   * @return string
   */
  public function getTitleLocArgs() {
    return $this->titleLocArgs;
  }

  /**
   * @param string $titleLocArgs
   * @return NotificationAlertIos
   */
  public function setTitleLocArgs($titleLocArgs) {
    $this->titleLocArgs = $titleLocArgs;
    return $this;
  }

  /**
   * @return string
   */
  public function getBody() {
    return $this->body;
  }

  /**
   * @param string $body
   * @return NotificationAlertIos
   */
  public function setBody($body) {
    $this->body = $body;
    return $this;
  }

  /**
   * @return string
   */
  public function getLocKey() {
    return $this->locKey;
  }

  /**
   * @param string $locKey
   * @return NotificationAlertIos
   */
  public function setLocKey($locKey) {
    $this->locKey = $locKey;
    return $this;
  }

  /**
   * @return string[]
   */
  public function getLocArgs() {
    return $this->locArgs;
  }

  /**
   * @param string[] $locArgs
   * @return NotificationAlertIos
   */
  public function setLocArgs($locArgs) {
    $this->locArgs = $locArgs;
    return $this;
  }

  /**
   * @return string
   */
  public function getActionLocKey() {
    return $this->actionLocKey;
  }

  /**
   * @param string $actionLocKey
   * @return NotificationAlertIos
   */
  public function setActionLocKey($actionLocKey) {
    $this->actionLocKey = $actionLocKey;
    return $this;
  }

  /**
   * @return string
   */
  public function getLaunchImage() {
    return $this->launchImage;
  }

  /**
   * @param string $launchImage
   * @return NotificationAlertIos
   */
  public function setLaunchImage($launchImage) {
    $this->launchImage = $launchImage;
    return $this;
  }

  /**
   * @return integer
   */
  public function getBadge() {
    return $this->badge;
  }

  /**
   * @param integer $badge
   * @return NotificationAlertIos
   */
  public function setBadge($badge) {
    $this->badge = $badge;
    return $this;
  }

  /**
   * @return string
   */
  public function getSound() {
    return $this->sound;
  }

  /**
   * @param string $sound
   * @return NotificationAlertIos
   */
  public function setSound($sound) {
    $this->sound = $sound;
    return $this;
  }

  /**
   * @return string
   */
  public function getCategory() {
    return $this->category;
  }

  /**
   * @param string $category
   * @return NotificationAlertIos
   */
  public function setCategory($category) {
    $this->category = $category;
    return $this;
  }

  /**
   * @return integer
   */
  public function getContentAvailable() {
    return $this->contentAvailable;
  }

  /**
   * @param integer $contentAvailable
   * @return NotificationAlertIos
   */
  public function setContentAvailable($contentAvailable) {
    $this->contentAvailable = $contentAvailable;
    return $this;
  }

  /**
   * @return integer
   */
  public function getMutableContent() {
    return $this->mutableContent;
  }

  /**
   * @param integer $mutableContent
   * @return NotificationAlertIos
   */
  public function setMutableContent($mutableContent) {
    $this->mutableContent = $mutableContent;
    return $this;
  }

  /**
   * @return NotificationAlertIosForeground
   */
  public function getForeground() {
    return $this->foreground;
  }

  /**
   * @param NotificationAlertIosForeground|array $foreground
   * @return NotificationAlertIos
   */
  public function setForeground($foreground) {
    $this->foreground = Object::instantiateForSetter('\WonderPush\Obj\NotificationAlertIosForeground', $foreground);
    return $this;
  }

  /**
   * @return NotificationAlertIosAttachment[]
   */
  public function getAttachments() {
    return $this->attachments;
  }

  /**
   * @param NotificationAlertIosAttachment[]|array[] $attachments
   * @return NotificationAlertIos
   */
  public function setAttachments($attachments) {
    $this->attachments = Object::instantiateForSetter('\WonderPush\Obj\NotificationAlertIosAttachment[]', $attachments);
    return $this;
  }

}

/**
 * DTO part for `notification.alert.ios.foreground`.
 * @see NotificationAlertIos
 */
class NotificationAlertIosForeground extends Object {

  /** @var boolean */
  protected $autoOpen;
  /** @var boolean */
  protected $autoDrop;

  /**
   * @return boolean
   */
  public function getAutoOpen() {
    return $this->autoOpen;
  }

  /**
   * @param boolean $autoOpen
   * @return NotificationAlertIosForeground
   */
  public function setAutoOpen($autoOpen) {
    $this->autoOpen = $autoOpen;
    return $this;
  }

  /**
   * @return boolean
   */
  public function getAutoDrop() {
    return $this->autoDrop;
  }

  /**
   * @param boolean $autoDrop
   * @return NotificationAlertIosForeground
   */
  public function setAutoDrop($autoDrop) {
    $this->autoDrop = $autoDrop;
    return $this;
  }

}

/**
 * DTO part for `notification.alert.ios.attachments` items.
 * @see NotificationAlertIos
 */
class NotificationAlertIosAttachment extends Object {

  /** @var string */
  protected $id;
  /**
   * @var string
   * Audio files should not be over 5 MB.
   * Image files should not be over 10 MB.
   * Video files should not be over 50 MB.
   */
  protected $url;
  /**
   * @var string
   * Derived from the url file-extension by iOS itself if not given.
   * The SDK understands the following shortcuts, and raw values, described in `options`.
   * Images:
   *   png,jpg,jpeg,gif,
   *   image/png,image/x-png,image/jpeg,image/gif,
   * Audio:
   *   wav,wave,aiff,mp3,m4a,mp4a,
   *   audio/wav,audio/x-wav,audio/aiff,audio/x-aiff,audio/mpeg,audio/mp3,audio/mpeg3,audio/mp4,
   * Video:
   *   mpg,mpeg,mp2,m2v,mp4,avi,
   *   video/mpeg,video/x-mpeg1,video/mpeg2,video/x-mpeg2,video/mp4,video/mpeg4,video/avi
   */
  protected $type;
  /**
   * @var array
   * https://trello.com/c/QERhnU9Y/987-ios-10-rich-notifications-memento
   * https://developer.apple.com/reference/usernotifications/unnotificationattachment/attachment_attributes
   * typeHint: "a UNNotificationAttachmentOptionsTypeHintKey value constant",
   *   kUTTypeAudioInterchangeFileFormat = "public.aiff-audio"
   *   kUTTypeWaveformAudio = "com.microsoft.waveform-audio"
   *   kUTTypeMP3 = "public.mp3"
   *   kUTTypeMPEG4Audio = "public.mpeg-4-audio"
   *   kUTTypeJPEG = "public.jpeg"
   *   kUTTypeGIF = "com.compuserve.gif"
   *   kUTTypePNG = "public.png"
   *   kUTTypeMPEG = "public.mpeg"
   *   kUTTypeMPEG2Video = "public.mpeg-2-video"
   *   kUTTypeMPEG4 = "public.mpeg-4"
   *   kUTTypeAVIMovie = "public.avi"
   * thumbnailHidden: false,
   * thumbnailClippingRect: {"X":0.0, "Y":0.0, "Width":1.0, "Height":1.0},
   * thumbnailTime: a UNNotificationAttachmentOptionsThumbnailTimeKey value
   *   Frame number [0;N-1], don't go outside the range
   *   Time in seconds for movies (not for gifs)
   *   {value,timescale,epoch:0,flags=1} (not for gifs) (eg: value=241, timescale=24 is 10 seconds plus one frame)
   */
  protected $options;

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param string $id
   * @return NotificationAlertIosAttachment
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * @return string
   */
  public function getUrl() {
    return $this->url;
  }

  /**
   * @param string $url
   * @return NotificationAlertIosAttachment
   */
  public function setUrl($url) {
    $this->url = $url;
    return $this;
  }

  /**
   * @return string
   */
  public function getType() {
    return $this->type;
  }

  /**
   * @param string $type
   * @return NotificationAlertIosAttachment
   */
  public function setType($type) {
    $this->type = $type;
    return $this;
  }

  /**
   * @return array
   */
  public function getOptions() {
    return $this->options;
  }

  /**
   * @param array $options
   * @return NotificationAlertIosAttachment
   */
  public function setOptions($options) {
    $this->options = $options;
    return $this;
  }

}

/**
 * DTO part for `notification.alert.android`.
 * @see NotificationAlert
 */
class NotificationAlertAndroid extends NotificationAlert {

  /** @var string */
  protected $type;
  /** @var string */
  protected $channel;
  /** @var boolean */
  protected $html;
  /** @var string */
  protected $title;
  /** @var string */
  protected $text;
  /** @var string */
  protected $subText;
  /** @var string */
  protected $info;
  /** @var string */
  protected $ticker;
  /** @var string|NullObject|null */
  protected $tag;
  /** @var integer */
  protected $priority;
  /** @var boolean */
  protected $autoOpen;
  /** @var boolean */
  protected $autoDrop;
  /** @var string[] */
  protected $persons;
  /** @var string */
  protected $category;
  /** @var string */
  protected $color;
  /** @var string */
  protected $group;
  /** @var string */
  protected $sortKey;
  /** @var boolean */
  protected $localOnly;
  /** @var integer */
  protected $number;
  /** @var boolean */
  protected $onlyAlertOnce;
  /** @var timestampMS */
  protected $when;
  /** @var boolean */
  protected $showWhen;
  /** @var boolean */
  protected $usesChronometer;
  /** @var string */
  protected $visibility;
  /** @var boolean|object {color: string, on: integer, off: integer} */
  protected $lights;
  /** @var boolean|integer[] */
  protected $vibrate;
  /** @var boolean|string */
  protected $sound;
  /** @var boolean */
  protected $ongoing;
  /** @var boolean|integer */
  protected $progress;
  /** @var string */
  protected $smallIcon;
  /** @var string */
  protected $largeIcon;
  /** @var NotificationAlertAndroidButton[] */
  protected $buttons;

  /** @var NotificationAlertAndroid */
  protected $foreground;

  /** @var string */ // types: bigText, bigPicture, inbox
  protected $bigTitle;
  /** @var string */ // types: bigText
  protected $bigText;
  /** @var string */ // types: bigText, bigPicture, inbox
  protected $summaryText;
  /** @var string */ // types: bigPicture
  protected $bigLargeIcon;
  /** @var string */ // types: bigPicture
  protected $bigPicture;
  /** @var string[] */ // types: inbox
  protected $lines;

  /**
   * @return string
   */
  public function getType() {
    return $this->type;
  }

  /**
   * @param string $type
   * @return $this
   */
  public function setType($type) {
    $this->type = $type;
    return $this;
  }

  /**
   * @return string
   */
  public function getChannel() {
    return $this->channel;
  }

  /**
   * @param string $channel
   * @return $this
   */
  public function setChannel($channel) {
    $this->channel = $channel;
    return $this;
  }

  /**
   * @return boolean
   */
  public function getHtml() {
    return $this->html;
  }

  /**
   * @param boolean $html
   * @return $this
   */
  public function setHtml($html) {
    $this->html = $html;
    return $this;
  }

  /**
   * @return string
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * @param string $title
   * @return $this
   */
  public function setTitle($title) {
    $this->title = $title;
    return $this;
  }

  /**
   * @return string
   */
  public function getText() {
    return $this->text;
  }

  /**
   * @param string $text
   * @return $this
   */
  public function setText($text) {
    $this->text = $text;
    return $this;
  }

  /**
   * @return string
   */
  public function getSubText() {
    return $this->subText;
  }

  /**
   * @param string $subText
   * @return $this
   */
  public function setSubText($subText) {
    $this->subText = $subText;
    return $this;
  }

  /**
   * @return string
   */
  public function getInfo() {
    return $this->info;
  }

  /**
   * @param string $info
   * @return $this
   */
  public function setInfo($info) {
    $this->info = $info;
    return $this;
  }

  /**
   * @return string
   */
  public function getTicker() {
    return $this->ticker;
  }

  /**
   * @param string $ticker
   * @return $this
   */
  public function setTicker($ticker) {
    $this->ticker = $ticker;
    return $this;
  }

  /**
   * @return string|NullObject|null
   */
  public function getTag() {
    return $this->tag;
  }

  /**
   * @param string|NullObject|null $tag
   * @return $this
   */
  public function setTag($tag) {
    $this->tag = $tag;
    return $this;
  }

  /**
   * @return integer
   */
  public function getPriority() {
    return $this->priority;
  }

  /**
   * @param integer $priority
   * @return $this
   */
  public function setPriority($priority) {
    $this->priority = $priority;
    return $this;
  }

  /**
   * @return boolean
   */
  public function getAutoOpen() {
    return $this->autoOpen;
  }

  /**
   * @param boolean $autoOpen
   * @return $this
   */
  public function setAutoOpen($autoOpen) {
    $this->autoOpen = $autoOpen;
    return $this;
  }

  /**
   * @return boolean
   */
  public function getAutoDrop() {
    return $this->autoDrop;
  }

  /**
   * @param boolean $autoDrop
   * @return $this
   */
  public function setAutoDrop($autoDrop) {
    $this->autoDrop = $autoDrop;
    return $this;
  }

  /**
   * @return string[]
   */
  public function getPersons() {
    return $this->persons;
  }

  /**
   * @param string[] $persons
   * @return $this
   */
  public function setPersons($persons) {
    $this->persons = $persons;
    return $this;
  }

  /**
   * @return string
   */
  public function getCategory() {
    return $this->category;
  }

  /**
   * @param string $category
   * @return $this
   */
  public function setCategory($category) {
    $this->category = $category;
    return $this;
  }

  /**
   * @return string
   */
  public function getColor() {
    return $this->color;
  }

  /**
   * @param string $color
   * @return $this
   */
  public function setColor($color) {
    $this->color = $color;
    return $this;
  }

  /**
   * @return string
   */
  public function getGroup() {
    return $this->group;
  }

  /**
   * @param string $group
   * @return $this
   */
  public function setGroup($group) {
    $this->group = $group;
    return $this;
  }

  /**
   * @return string
   */
  public function getSortKey() {
    return $this->sortKey;
  }

  /**
   * @param string $sortKey
   * @return $this
   */
  public function setSortKey($sortKey) {
    $this->sortKey = $sortKey;
    return $this;
  }

  /**
   * @return boolean
   */
  public function getLocalOnly() {
    return $this->localOnly;
  }

  /**
   * @param boolean $localOnly
   * @return $this
   */
  public function setLocalOnly($localOnly) {
    $this->localOnly = $localOnly;
    return $this;
  }

  /**
   * @return integer
   */
  public function getNumber() {
    return $this->number;
  }

  /**
   * @param integer $number
   * @return $this
   */
  public function setNumber($number) {
    $this->number = $number;
    return $this;
  }

  /**
   * @return boolean
   */
  public function getOnlyAlertOnce() {
    return $this->onlyAlertOnce;
  }

  /**
   * @param boolean $onlyAlertOnce
   * @return $this
   */
  public function setOnlyAlertOnce($onlyAlertOnce) {
    $this->onlyAlertOnce = $onlyAlertOnce;
    return $this;
  }

  /**
   * @return long Timestamp in milliseconds
   */
  public function getWhen() {
    return $this->when;
  }

  /**
   * @param long $when Timestamp in milliseconds
   * @return $this
   */
  public function setWhen($when) {
    $this->when = $when;
    return $this;
  }

  /**
   * @return boolean
   */
  public function getShowWhen() {
    return $this->showWhen;
  }

  /**
   * @param boolean $showWhen
   * @return $this
   */
  public function setShowWhen($showWhen) {
    $this->showWhen = $showWhen;
    return $this;
  }

  /**
   * @return boolean
   */
  public function getUsesChronometer() {
    return $this->usesChronometer;
  }

  /**
   * @param boolean $usesChronometer
   * @return $this
   */
  public function setUsesChronometer($usesChronometer) {
    $this->usesChronometer = $usesChronometer;
    return $this;
  }

  /**
   * @return string
   */
  public function getVisibility() {
    return $this->visibility;
  }

  /**
   * @param string $visibility
   * @return $this
   */
  public function setVisibility($visibility) {
    $this->visibility = $visibility;
    return $this;
  }

  /**
   * @return boolean|array `{color: string, on: integer, off: integer}`
   */
  public function getLights() {
    return $this->lights;
  }

  /**
   *
   * @param boolean|array $lights `{color: string, on: integer, off: integer}`
   * @return $this
   */
  public function setLights($lights) {
    $this->lights = $lights;
    return $this;
  }

  /**
   * @return boolean|integer[]
   */
  public function getVibrate() {
    return $this->vibrate;
  }

  /**
   * @param boolean|integer[] $vibrate
   * @return $this
   */
  public function setVibrate($vibrate) {
    $this->vibrate = $vibrate;
    return $this;
  }

  /**
   * @return boolean|string
   */
  public function getSound() {
    return $this->sound;
  }

  /**
   * @param boolean|string $sound
   * @return $this
   */
  public function setSound($sound) {
    $this->sound = $sound;
    return $this;
  }

  /**
   * @return boolean
   */
  public function getOngoing() {
    return $this->ongoing;
  }

  /**
   * @param boolean $ongoing
   * @return $this
   */
  public function setOngoing($ongoing) {
    $this->ongoing = $ongoing;
    return $this;
  }

  /**
   * @return boolean|integer
   */
  public function getProgress() {
    return $this->progress;
  }

  /**
   * @param boolean|integer $progress
   * @return $this
   */
  public function setProgress($progress) {
    $this->progress = $progress;
    return $this;
  }

  /**
   * @return string
   */
  public function getSmallIcon() {
    return $this->smallIcon;
  }

  /**
   * @param string $smallIcon
   * @return $this
   */
  public function setSmallIcon($smallIcon) {
    $this->smallIcon = $smallIcon;
    return $this;
  }

  /**
   * @return string
   */
  public function getLargeIcon() {
    return $this->largeIcon;
  }

  /**
   * @param string $largeIcon
   * @return $this
   */
  public function setLargeIcon($largeIcon) {
    $this->largeIcon = $largeIcon;
    return $this;
  }

  /**
   * @return NotificationAlertAndroidButton[]
   */
  public function getButtons() {
    return $this->buttons;
  }

  /**
   * @param NotificationAlertAndroidButton[] $buttons
   * @return $this
   */
  public function setButtons($buttons) {
    $this->buttons = Object::instantiateForSetter('\WonderPush\Obj\NotificationAlertAndroidButton[]', $buttons);
    return $this;
  }

  /**
   * @return NotificationAlertAndroid
   */
  public function getForeground() {
    return $this->foreground;
  }

  /**
   * @param NotificationAlertAndroid $foreground
   * @return NotificationAlertAndroid
   */
  public function setForeground($foreground) {
    $this->foreground = Object::instantiateForSetter('\WonderPush\Obj\NotificationAlertAndroid', $foreground);
    if ($this->foreground instanceof NotificationAlertAndroid) {
      $this->foreground->setForeground(null);
    }
    return $this;
  }

  /**
   * Valid for types: `bigText`, `bigPicture`, `inbox`.
   * @return string
   */
  public function getBigTitle() {
    return $this->bigTitle;
  }

  /**
   * Valid for types: `bigText`, `bigPicture`, `inbox`.
   * @param string $bigTitle
   * @return $this
   */
  public function setBigTitle($bigTitle) {
    $this->bigTitle = $bigTitle;
    return $this;
  }

  /**
   * Valid for types: `bigText`.
   * @return string
   */
  public function getBigText() {
    return $this->bigText;
  }

  /**
   * Valid for types: `bigText`.
   * @param string $bigText
   * @return $this
   */
  public function setBigText($bigText) {
    $this->bigText = $bigText;
    return $this;
  }

  /**
   * Valid for types: `bigText`, `bigPicture`, `inbox`.
   * @return string
   */
  public function getSummaryText() {
    return $this->summaryText;
  }

  /**
   * Valid for types: `bigText`, `bigPicture`, `inbox`.
   * @param string $summaryText
   * @return $this
   */
  public function setSummaryText($summaryText) {
    $this->summaryText = $summaryText;
    return $this;
  }

  /**
   * Valid for types: `bigPicture`.
   * @return string
   */
  public function getBigLargeIcon() {
    return $this->bigLargeIcon;
  }

  /**
   * Valid for types: `bigPicture`.
   * @param string $bigLargeIcon
   * @return $this
   */
  public function setBigLargeIcon($bigLargeIcon) {
    $this->bigLargeIcon = $bigLargeIcon;
    return $this;
  }

  /**
   * Valid for types: `bigPicture`.
   * @return string
   */
  public function getBigPicture() {
    return $this->bigPicture;
  }

  /**
   * Valid for types: `bigPicture`.
   * @param string $bigPicture
   * @return $this
   */
  public function setBigPicture($bigPicture) {
    $this->bigPicture = $bigPicture;
    return $this;
  }

  /**
   * Valid for types: `inbox`.
   * @return string[]
   */
  public function getLines() {
    return $this->lines;
  }

  /**
   * Valid for types: `inbox`.
   * @param string[] $lines
   * @return $this
   */
  public function setLines($lines) {
    $this->lines = $lines;
    return $this;
  }

}

/**
 * DTO part for `notification.alert.android.buttons` items.
 * @see NotificationAlertAndroid
 */
class NotificationAlertAndroidButton extends NotificationButton {

  /** @var string */
  private $icon;

  /**
   * @return string
   */
  public function getIcon() {
    return $this->icon;
  }

  /**
   * @param string $icon
   * @return $this
   */
  public function setIcon($icon) {
    $this->icon = $icon;
    return $this;
  }

}

/**
 * DTO part for `notification.alert.web`.
 * @see NotificationAlert
 */
class NotificationAlertWeb extends NotificationAlert {

  // title is already present in the platform-independent parent object
  /** @var string */
  private $dir;
  /** @var string */
  private $lang;
  /** @var string */
  private $body;
  /** @var string */
  private $tag;
  /** @var string */
  private $icon;
  /** @var string */
  private $badge;
  /** @var string */
  private $image;
  /** @var string */
  private $sound;
  /** @var integer[] */
  private $vibrate;
  /** @var long */
  private $timestamp;
  /** @var boolean */
  private $renotify;
  /** @var boolean */
  private $silent;
  /** @var boolean */
  private $noscreen;
  /** @var boolean */
  private $requireInteraction;
  /** @var boolean */
  private $sticky;
  /** @var NotificationAlertWebButton[] */
  private $buttons; // actual name is `actions`, but it clashes with "on click background actions"

  /**
   * @return string
   */
  public function getDir() {
    return $this->dir;
  }

  /**
   * @param string $dir
   * @return $this
   */
  public function setDir($dir) {
    $this->dir = $dir;
    return $this;
  }

  /**
   * @return string
   */
  public function getLang() {
    return $this->lang;
  }

  /**
   * @param string $lang
   * @return $this
   */
  public function setLang($lang) {
    $this->lang = $lang;
    return $this;
  }

  /**
   * @return string
   */
  public function getBody() {
    return $this->body;
  }

  /**
   * @param string $body
   * @return $this
   */
  public function setBody($body) {
    $this->body = $body;
    return $this;
  }

  /**
   * @return string
   */
  public function getTag() {
    return $this->tag;
  }

  /**
   * @param string $tag
   * @return $this
   */
  public function setTag($tag) {
    $this->tag = $tag;
    return $this;
  }

  /**
   * @return string
   */
  public function getIcon() {
    return $this->icon;
  }

  /**
   * @param string $icon
   * @return $this
   */
  public function setIcon($icon) {
    $this->icon = $icon;
    return $this;
  }

  /**
   * @return string
   */
  public function getBadge() {
    return $this->badge;
  }

  /**
   * @param string $badge
   * @return $this
   */
  public function setBadge($badge) {
    $this->badge = $badge;
    return $this;
  }

  /**
   * @return string
   */
  public function getImage() {
    return $this->image;
  }

  /**
   * @param string $image
   * @return $this
   */
  public function setImage($image) {
    $this->image = $image;
    return $this;
  }

  /**
   * @return string
   */
  public function getSound() {
    return $this->sound;
  }

  /**
   * @param string $sound
   * @return $this
   */
  public function setSound($sound) {
    $this->sound = $sound;
    return $this;
  }

  /**
   * @return integer[]
   */
  public function getVibrate() {
    return $this->vibrate;
  }

  /**
   * @param integer[] $vibrate
   * @return $this
   */
  public function setVibrate($vibrate) {
    $this->vibrate = $vibrate;
    return $this;
  }

  /**
   * @return long Timestamp in milliseconds
   */
  public function getTimestamp() {
    return $this->timestamp;
  }

  /**
   * @param long $timestamp Timestamp in milliseconds
   * @return $this
   */
  public function setTimestamp($timestamp) {
    $this->timestamp = $timestamp;
    return $this;
  }

  /**
   * @return boolean
   */
  public function getRenotify() {
    return $this->renotify;
  }

  /**
   * @param boolean $renotify
   * @return $this
   */
  public function setRenotify($renotify) {
    $this->renotify = $renotify;
    return $this;
  }

  /**
   * @return boolean
   */
  public function getSilent() {
    return $this->silent;
  }

  /**
   * @param boolean $silent
   * @return $this
   */
  public function setSilent($silent) {
    $this->silent = $silent;
    return $this;
  }

  /**
   * @return boolean
   */
  public function getNoscreen() {
    return $this->noscreen;
  }

  /**
   * @param boolean $noscreen
   * @return $this
   */
  public function setNoscreen($noscreen) {
    $this->noscreen = $noscreen;
    return $this;
  }

  /**
   * @return boolean
   */
  public function getRequireInteraction() {
    return $this->requireInteraction;
  }

  /**
   * @param boolean $requireInteraction
   * @return $this
   */
  public function setRequireInteraction($requireInteraction) {
    $this->requireInteraction = $requireInteraction;
    return $this;
  }

  /**
   * @return boolean
   */
  public function getSticky() {
    return $this->sticky;
  }

  /**
   * @param boolean $sticky
   * @return $this
   */
  public function setSticky($sticky) {
    $this->sticky = $sticky;
    return $this;
  }

  /**
   * @return NotificationAlertWebButton[]
   */
  public function getButtons() {
    return $this->buttons;
  }

  /**
   * @param NotificationAlertWebButton[] $buttons
   * @return $this
   */
  public function setButtons($buttons) {
    $this->buttons = Object::instantiateForSetter('\WonderPush\Obj\NotificationAlertWebButton[]', $buttons);
    return $this;
  }

}

/**
 * DTO part for `notification.alert.web.buttons` items.
 * @see NotificationAlertWeb
 */
class NotificationAlertWebButton extends NotificationButton {

  /** @var string */
  private $action;
  /** @var string */
  private $icon;

  /**
   * @return string
   */
  public function getAction() {
    return $this->action;
  }

  /**
   * @param string $action
   * @return NotificationAlertWebButton
   */
  public function setAction($action) {
    $this->action = $action;
    return $this;
  }

  /**
   * @return string
   */
  public function getIcon() {
    return $this->icon;
  }

  /**
   * @param string $icon
   * @return NotificationAlertWebButton
   */
  public function setIcon($icon) {
    $this->icon = $icon;
    return $this;
  }

}

/**
 * DTO part for `notification.inApp`.
 * @see Notification
 */
class NotificationInApp extends Object {

  const TYPE_TEXT = 'text';
  const TYPE_HTML = 'html';
  const TYPE_URL = 'url';
  const TYPE_MAP = 'map';

  public static function listTypes() {
    return array(
        self::TYPE_TEXT,
        self::TYPE_HTML,
        self::TYPE_URL,
        self::TYPE_MAP,
    );
  }

  /** @var string A NotificationType constant */
  private $type;
  /** @var string */
  private $title;
  /** @var string */
  private $message;
  /** @var NotificationInAppMap */
  private $map;
  /** @var string */
  private $url;
  /** @var NotificationInAppButton[] */
  private $buttons;

  /**
   * @return string A NotificationType constant
   */
  public function getType() {
    return $this->type;
  }

  /**
   * @param string $type A NotificationType constant
   * @return NotificationInApp
   */
  public function setType($type) {
    $this->type = $type;
    return $this;
  }

  /**
   * @return string
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * @param string $title
   * @return NotificationInApp
   */
  public function setTitle($title) {
    $this->title = $title;
    return $this;
  }

  /**
   * @return string
   */
  public function getMessage() {
    return $this->message;
  }

  /**
   * @param string $message
   * @return NotificationInApp
   */
  public function setMessage($message) {
    $this->message = $message;
    return $this;
  }

  /**
   * @return NotificationInAppMap
   */
  public function getMap() {
    return $this->map;
  }

  /**
   * @param NotificationInAppMap|array $map
   * @return NotificationInApp
   */
  public function setMap($map) {
    $this->map = Object::instantiateForSetter('\WonderPush\Obj\NotificationInAppMap', $map);
    return $this;
  }

  /**
   * @return string
   */
  public function getUrl() {
    return $this->url;
  }

  /**
   * @param string $url
   * @return NotificationInApp
   */
  public function setUrl($url) {
    $this->url = $url;
    return $this;
  }

  /**
   * @return NotificationInAppButton[]
   */
  public function getButtons() {
    return $this->buttons;
  }

  /**
   * @param NotificationInAppButton[]|array[] $buttons
   * @return NotificationInApp
   */
  public function setButtons($buttons) {
    $this->buttons = Object::instantiateForSetter('\WonderPush\Obj\NotificationInAppButton[]', $buttons);
    return $this;
  }

}

/**
 * DTO part for `notification.inApp.buttons` items.
 * @see NotificationInApp
 */
class NotificationInAppButton extends NotificationButton {

  // Nothing to add

}

/**
 * DTO part for `notification.inApp.map`.
 * @see NotificationInApp
 */
class NotificationInAppMap extends Object {

  /** @var NotificationInAppMapPlace */
  private $place;

  /**
   * @return NotificationInAppMapPlace
   */
  public function getPlace() {
    return $this->place;
  }

  /**
   * @param NotificationInAppMapPlace|array $place
   * @return NotificationInAppMap
   */
  public function setPlace($place) {
    $this->place = Object::instantiateForSetter('\WonderPush\Obj\NotificationInAppMapPlace', $place);
    return $this;
  }

}

/**
 * DTO part for `notification.inApp.map.place`.
 * @see NotificationInAppMap
 */
class NotificationInAppMapPlace extends Object {

  /** @var GeoLocation */
  private $point;
  /** @var integer */
  private $zoom;
  /** @var string */
  private $name;

  /**
   * @return GeoLocation
   */
  public function getPoint() {
    return $this->point;
  }

  /**
   * @param GeoLocation $point
   * @return NotificationInAppMapPlace
   */
  public function setPoint($point) {
    $this->point = Object::instantiateForSetter('\WonderPush\Obj\GeoLocation', $point);
    return $this;
  }

  /**
   * @return integer
   */
  public function getZoom() {
    return $this->zoom;
  }

  /**
   * @param integer $zoom
   * @return NotificationInAppMapPlace
   */
  public function setZoom($zoom) {
    $this->zoom = $zoom;
    return $this;
  }

  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param string $name
   * @return NotificationInAppMapPlace
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

}

/**
 * DTO part for `notification.push`.
 * @see Notification
 */
class NotificationPush extends Object {

  const PRIORITY_NORMAL = 'normal';
  const PRIORITY_HIGH   = 'high';

  /** @var array **/
  protected $custom;
  /** @var array **/
  protected $payload;
  /** @var long */
  protected $expirationDate;
  /** @var long */
  protected $expirationTime;
  /** @var string */
  protected $priority;
  /** @var NotificationPushAndroid */
  protected $android;
  /** @var NotificationPushIos */
  protected $ios;
  /** @var NotificationPushWeb */
  protected $web;

  /**
   * @return array
   */
  public function getCustom() {
    return $this->custom;
  }

  /**
   * @param array $custom
   * @return NotificationPush
   */
  public function setCustom($custom) {
    $this->custom = $custom;
    return $this;
  }

  /**
   * @return array
   */
  public function getPayload() {
    return $this->payload;
  }

  /**
   * @param array $payload
   * @return NotificationPush
   */
  public function setPayload($payload) {
    $this->payload = $payload;
    return $this;
  }

  /**
   * @return long
   */
  public function getExpirationDate() {
    return $this->expirationDate;
  }

  /**
   * @param long|string|\DateTime $expirationDate
   * @return NotificationPush
   */
  public function setExpirationDate($expirationDate) {
    if ($expirationDate === null) {
      $this->expirationDate = null;
    } else if (is_long($expirationDate)) {
      $this->expirationDate = $expirationDate;
    } else if (is_string($expirationDate)) {
      $this->expirationDate = \WonderPush\Util\TimeUtil::getMillisecondTimestampFromDateTime(
          \WonderPush\Util\TimeUtil::parseISO8601DateOptionalTime($expirationDate)
      );
    } else if ($expirationDate instanceof \DateTime) {
      $this->expirationDate = \WonderPush\Util\TimeUtil::getMillisecondTimestampFromDateTime($expirationDate);
    } else {
      $this->expirationDate = null;
    }
    return $this;
  }

  /**
   * @return long
   */
  public function getExpirationTime() {
    return $this->expirationTime;
  }

  /**
   * @param long|string $expirationTime
   * @return NotificationPush
   */
  public function setExpirationTime($expirationTime) {
    $this->expirationTime = \WonderPush\Util\TimeValue::parse($expirationTime);
    if ($this->expirationTime instanceof \WonderPush\Util\TimeValue) {
      $this->expirationTime = $this->expirationTime->toMilliseconds();
    }
    return $this;
  }

  /**
   * @return string
   */
  public function getPriority() {
    return $this->priority;
  }

  /**
   * @param string $priority
   * @return NotificationPush
   */
  public function setPriority($priority) {
    $this->priority = $priority;
    return $this;
  }

  /**
   * @return NotificationPushAndroid
   */
  public function getAndroid() {
    return $this->android;
  }

  /**
   * @param NotificationPushAndroid|array $android
   * @return NotificationPush
   */
  public function setAndroid($android) {
    $this->android = Object::instantiateForSetter('\WonderPush\Obj\NotificationPushAndroid', $android);
    return $this;
  }

  /**
   * @return NotificationPushIos
   */
  public function getIos() {
    return $this->ios;
  }

  /**
   * @param NotificationPushIos|array $ios
   * @return NotificationPush
   */
  public function setIos($ios) {
    $this->ios = Object::instantiateForSetter('\WonderPush\Obj\NotificationPushIos', $ios);
    return $this;
  }

  /**
   * @return NotificationPushWeb
   */
  public function getWeb() {
    return $this->web;
  }

  /**
   * @param NotificationPushWeb|array $web
   * @return NotificationPush
   */
  public function setWeb($web) {
    $this->web = Object::instantiateForSetter('\WonderPush\Obj\NotificationPushWeb', $web);
    return $this;
  }

}

/**
 * DTO part for `notification.push.ios`.
 * @see NotificationPush
 */
class NotificationPushIos extends NotificationPush {

  // Nothing special, only let overriding common values

}

/**
 * DTO part for `notification.push.web`.
 * @see NotificationPush
 */
class NotificationPushWeb extends NotificationPush {

  // Nothing special, only let overriding common values

}

/**
 * DTO part for `notification.push.android`.
 * @see NotificationPush
 */
class NotificationPushAndroid extends NotificationPush {

  /** @var boolean */
  private $delayWhileIdle;
  /** @var string */
  private $collapseKey;
  /** @var string */
  private $restrictedPackageName;

  /**
   * @return boolean
   */
  public function getDelayWhileIdle() {
    return $this->delayWhileIdle;
  }

  /**
   * @param boolean $delayWhileIdle
   * @return $this
   */
  public function setDelayWhileIdle($delayWhileIdle) {
    $this->delayWhileIdle = $delayWhileIdle;
    return $this;
  }

  /**
   * @return string
   */
  public function getCollapseKey() {
    return $this->collapseKey;
  }

  /**
   * @param string $collapseKey
   * @return $this
   */
  public function setCollapseKey($collapseKey) {
    $this->collapseKey = $collapseKey;
    return $this;
  }

  /**
   * @return string
   */
  public function getRestrictedPackageName() {
    return $this->restrictedPackageName;
  }

  /**
   * @param string $restrictedPackageName
   * @return $this
   */
  public function setRestrictedPackageName($restrictedPackageName) {
    $this->restrictedPackageName = $restrictedPackageName;
    return $this;
  }

}
