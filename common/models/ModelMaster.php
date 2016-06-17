<?php

namespace common\models;

use Yii;

class ModelMaster extends \yii\db\ActiveRecord
{

    const DATE_THAI_TYPE_FULL = 1;
    const DATE_THAI_TYPE_SHORT = 2;
    const TAB_TYPE_PHOTO = 1;
    const TAB_TYPE_DETAIL = 2;
    const TAB_TYPE_AMENITY = 3;
    const TAB_TYPE_MAP = 4;
    const TAB_TYPE_STREET_VIEW = 5;
    const USER_ASSET_TYPE_OWNER = 1;
    const USER_ASSET_TYPE_AGENCY = 2;

    public $searchText;
    public $monthFull = [
        1 => 'มกราคม',
        'กุมภาพันธ์',
        'มีนาคม',
        'เมษายน',
        'พฤษภาคม',
        'มิถุนายน',
        'กรกฎาคม',
        'สิงหาคม',
        'กันยายน',
        'ตุลาคม',
        'พฤศจิกายน',
        'ธันวาคม',
    ];
    public $monthShort = [
        1 => 'ม.ค.',
        'ก.พ.',
        'มี.ค.',
        'เม.ย.',
        'พ.ค.',
        'มิ.ย.',
        'ก.ค.',
        'ส.ค.',
        'ก.ย.',
        'ต.ค.',
        'พ.ย.',
        'ธ.ค.',
    ];

    public function writeToFile($fileName, $text, $mode = 'w+')
    {
        $handle = fopen($fileName, $mode);
        fwrite($handle, $text);
        fclose($handle);
    }

    public function thaiDate($date, $type = self::DATE_THAI_TYPE_FULL)
    {
        $d = explode('-', $date);
        $year = $d[0] + 543;
        $month = ($type == self::DATE_THAI_TYPE_FULL) ? $this->monthFull[(int) $d[1]] : $this->monthShort[(int) $d[1]];
        $date = (int) $d[2];

        return $date . ' ' . $month . ' ' . $year;
    }

    public function getMonthText($month, $type = 1)
    {
        return ($type == 1) ? $this->monthFull[$month] : $this->monthShort[$month];
    }

    public static function getTabTypeArray()
    {
        return [
            self::TAB_TYPE_PHOTO => 'Photo',
            self::TAB_TYPE_DETAIL => 'Detail',
            self::TAB_TYPE_AMENITY => 'Amenity',
            self::TAB_TYPE_MAP => 'Map',
            self::TAB_TYPE_STREET_VIEW => 'Street View',
        ];
    }

    public function getTabTypeText($type)
    {
        $tabTypeArray = self::getTabTypeArray();
        return $tabTypeArray[$type];
    }

    public function getUserAssetTypeArray()
    {
        return [
            self::USER_ASSET_TYPE_OWNER => 'เจ้าของทรัพย์สิน',
            self::USER_ASSET_TYPE_AGENCY => 'นายหน้า',
        ];
    }

    public function userAssetTypeText($type)
    {
        $userAssetTypeArray = $this->userAssetTypeArray;
        return $userAssetTypeArray[$type];
    }

//    public function soapIcons()
//    {
//        $icons = [];
//
//        foreach (array_rand($this->soapIcons, 10) as $value) {
//            $icons[$value] = $value;
//        }
//        return $icons;
//    }

    public $soapIcons = [
        'soap-icon-beach' => 'soap-icon-beach',
        'soap-icon-juice' => 'soap-icon-juice',
        'soap-icon-food' => 'soap-icon-food',
        'soap-icon-fueltank' => 'soap-icon-fueltank',
        'soap-icon-breakfast' => 'soap-icon-breakfast',
        'soap-icon-fireplace' => 'soap-icon-fireplace',
        'soap-icon-television' => 'soap-icon-television',
        'soap-icon-fridge' => 'soap-icon-fridge',
        'soap-icon-aircon' => 'soap-icon-aircon',
        'soap-icon-fmstereo' => 'soap-icon-fmstereo',
        'soap-icon-coffee' => 'soap-icon-coffee',
        'soap-icon-party' => 'soap-icon-party',
        'soap-icon-savings' => 'soap-icon-savings',
        'soap-icon-address' => 'soap-icon-address',
        'soap-icon-support' => 'soap-icon-support',
        'soap-icon-tree' => 'soap-icon-tree',
        'soap-icon-horn' => 'soap-icon-horn',
        'soap-icon-winebar' => 'soap-icon-winebar',
        'soap-icon-conference' => 'soap-icon-conference',
        'soap-icon-friends' => 'soap-icon-friends',
        'soap-icon-locations' => 'soap-icon-locations',
        'soap-icon-couples' => 'soap-icon-couples',
        'soap-icon-fitnessfacility' => 'soap-icon-fitnessfacility',
        'soap-icon-plans' => 'soap-icon-plans',
        'soap-icon-card' => 'soap-icon-card',
        'soap-icon-key' => 'soap-icon-key',
        'soap-icon-fork' => 'soap-icon-fork',
        'soap-icon-guideline' => 'soap-icon-guideline',
        'soap-icon-binoculars' => 'soap-icon-binoculars',
        'soap-icon-wifi' => 'soap-icon-wifi',
        'soap-icon-anchor' => 'soap-icon-anchor',
        'soap-icon-joystick' => 'soap-icon-joystick',
        'soap-icon-flexible' => 'soap-icon-flexible',
        'soap-icon-phone' => 'soap-icon-phone',
        'soap-icon-lost-found' => 'soap-icon-lost-found',
        'soap-icon-securevault' => 'soap-icon-securevault',
        'soap-icon-cruise-1' => 'soap-icon-cruise-1',
        'soap-icon-cruise-2' => 'soap-icon-cruise-2',
        'soap-icon-cruise' => 'soap-icon-cruise',
        'soap-icon-cruise-3' => 'soap-icon-cruise-3',
        'soap-icon-plane' => 'soap-icon-plane',
        'soap-icon-plane-bottom' => 'soap-icon-plane-bottom',
        'soap-icon-plane-left' => 'soap-icon-plane-left',
        'soap-icon-plane-right' => 'soap-icon-plane-right',
        'soap-icon-car' => 'soap-icon-car',
        'soap-icon-pickanddrop' => 'soap-icon-pickanddrop',
        'soap-icon-car-1' => 'soap-icon-car-1',
        'soap-icon-car-2' => 'soap-icon-car-2',
        'soap-icon-hotel-1' => 'soap-icon-hotel-1',
        'soap-icon-hotel-2' => 'soap-icon-hotel-2',
        'soap-icon-hotel-3' => 'soap-icon-hotel-3',
        'soap-icon-hotel' => 'soap-icon-hotel',
        'soap-icon-trunk-1' => 'soap-icon-trunk-1',
        'soap-icon-trunk-2' => 'soap-icon-trunk-2',
        'soap-icon-trunk-3' => 'soap-icon-trunk-3',
        'soap-icon-carryon' => 'soap-icon-carryon',
        'soap-icon-suitcase' => 'soap-icon-suitcase',
        'soap-icon-baggage' => 'soap-icon-baggage',
        'soap-icon-bag' => 'soap-icon-bag',
        'soap-icon-businessbag' => 'soap-icon-businessbag',
        'soap-icon-magazine' => 'soap-icon-magazine',
        'soap-icon-slider-1' => 'soap-icon-slider-1',
        'soap-icon-magazine-1' => 'soap-icon-magazine-1',
        'soap-icon-slider' => 'soap-icon-slider',
        'soap-icon-baggage-status' => 'soap-icon-baggage-status',
        'soap-icon-baggage-1' => 'soap-icon-baggage-1',
        'soap-icon-baggage-2' => 'soap-icon-baggage-2',
        'soap-icon-baggage-3' => 'soap-icon-baggage-3',
        'soap-icon-damaged-baggage' => 'soap-icon-damaged-baggage',
        'soap-icon-delayed-baggage' => 'soap-icon-delayed-baggage',
        'soap-icon-baggage-4' => 'soap-icon-baggage-4',
        'soap-icon-baggage-5' => 'soap-icon-baggage-5',
        'soap-icon-shopping' => 'soap-icon-shopping',
        'soap-icon-shopping-1' => 'soap-icon-shopping-1',
        'soap-icon-shopping-2' => 'soap-icon-shopping-2',
        'soap-icon-shopping-3' => 'soap-icon-shopping-3',
        'soap-icon-camera-1' => 'soap-icon-camera-1',
        'soap-icon-camera-2' => 'soap-icon-camera-2',
        'soap-icon-photogallery' => 'soap-icon-photogallery',
        'soap-icon-camera-3' => 'soap-icon-camera-3',
        'soap-icon-balloon' => 'soap-icon-balloon',
        'soap-icon-globe' => 'soap-icon-globe',
        'soap-icon-places' => 'soap-icon-places',
        'soap-icon-clock-1' => 'soap-icon-clock-1',
        'soap-icon-clock' => 'soap-icon-clock',
        'soap-icon-settings' => 'soap-icon-settings',
        'soap-icon-settings-1' => 'soap-icon-settings-1',
        'soap-icon-bad' => 'soap-icon-bad',
        'soap-icon-recommend' => 'soap-icon-recommend',
        'soap-icon-entertainment' => 'soap-icon-entertainment',
        'soap-icon-departure' => 'soap-icon-departure',
        'soap-icon-letter' => 'soap-icon-letter',
        'soap-icon-message' => 'soap-icon-message',
        'soap-icon-search-plus' => 'soap-icon-search-plus',
        'soap-icon-search-minus' => 'soap-icon-search-minus',
        'soap-icon-search' => 'soap-icon-search',
        'soap-icon-automatic' => 'soap-icon-automatic',
        'soap-icon-parking' => 'soap-icon-parking',
        'soap-icon-status' => 'soap-icon-status',
        'soap-icon-restricted' => 'soap-icon-restricted',
        'soap-icon-insurance' => 'soap-icon-insurance',
        'soap-icon-doc-minus' => 'soap-icon-doc-minus',
        'soap-icon-doc-plus' => 'soap-icon-doc-plus',
        'soap-icon-liability' => 'soap-icon-liability',
        'soap-icon-stories' => 'soap-icon-stories',
        'soap-icon-calendar' => 'soap-icon-calendar',
        'soap-icon-availability' => 'soap-icon-availability',
        'soap-icon-calendar-1' => 'soap-icon-calendar-1',
        'soap-icon-calendar-check' => 'soap-icon-calendar-check',
        'soap-icon-list' => 'soap-icon-list',
        'soap-icon-grid' => 'soap-icon-grid',
        'soap-icon-block' => 'soap-icon-block',
        'soap-icon-letter-1' => 'soap-icon-letter-1',
        'soap-icon-heart' => 'soap-icon-heart',
        'soap-icon-star-1' => 'soap-icon-star-1',
        'soap-icon-wishlist' => 'soap-icon-wishlist',
        'soap-icon-star' => 'soap-icon-star',
        'soap-icon-left' => 'soap-icon-left',
        'soap-icon-right' => 'soap-icon-right',
        'soap-icon-top' => 'soap-icon-top',
        'soap-icon-bottom' => 'soap-icon-bottom',
        'soap-icon-arrow-bottom' => 'soap-icon-arrow-bottom',
        'soap-icon-arrow-top' => 'soap-icon-arrow-top',
        'soap-icon-arrow-right' => 'soap-icon-arrow-right',
        'soap-icon-arrow-left' => 'soap-icon-arrow-left',
        'soap-icon-roundtriangle-left' => 'soap-icon-roundtriangle-left',
        'soap-icon-roundtriangle-right' => 'soap-icon-roundtriangle-right',
        'soap-icon-roundtriangle-top' => 'soap-icon-roundtriangle-top',
        'soap-icon-roundtriangle-bottom' => 'soap-icon-roundtriangle-bottom',
        'soap-icon-chevron-left' => 'soap-icon-chevron-left',
        'soap-icon-chevron-right' => 'soap-icon-chevron-right',
        'soap-icon-chevron-top' => 'soap-icon-chevron-top',
        'soap-icon-chevron-down' => 'soap-icon-chevron-down',
        'soap-icon-longarrow-left' => 'soap-icon-longarrow-left',
        'soap-icon-longarrow-right' => 'soap-icon-longarrow-right',
        'soap-icon-longarrow-up' => 'soap-icon-longarrow-up',
        'soap-icon-longarrow-bottom' => 'soap-icon-longarrow-bottom',
        'soap-icon-triangle-left' => 'soap-icon-triangle-left',
        'soap-icon-triangle-right' => 'soap-icon-triangle-right',
        'soap-icon-triangle-top' => 'soap-icon-triangle-top',
        'soap-icon-triangle-bottom' => 'soap-icon-triangle-bottom',
        'soap-icon-check-1' => 'soap-icon-check-1',
        'soap-icon-close' => 'soap-icon-close',
        'soap-icon-plus' => 'soap-icon-plus',
        'soap-icon-minus' => 'soap-icon-minus',
        'soap-icon-features' => 'soap-icon-features',
        'soap-icon-passed' => 'soap-icon-passed',
        'soap-icon-passenger' => 'soap-icon-passenger',
        'soap-icon-ski' => 'soap-icon-ski',
        'soap-icon-handicapaccessiable' => 'soap-icon-handicapaccessiable',
        'soap-icon-swimming' => 'soap-icon-swimming',
        'soap-icon-man-1' => 'soap-icon-man-1',
        'soap-icon-man-2' => 'soap-icon-man-2',
        'soap-icon-man-3' => 'soap-icon-man-3',
        'soap-icon-dog' => 'soap-icon-dog',
        'soap-icon-adventure' => 'soap-icon-adventure',
        'soap-icon-comfort' => 'soap-icon-comfort',
        'soap-icon-playplace' => 'soap-icon-playplace',
        'soap-icon-smoking' => 'soap-icon-smoking',
        'soap-icon-doorman' => 'soap-icon-doorman',
        'soap-icon-elevator' => 'soap-icon-elevator',
        'soap-icon-tub' => 'soap-icon-tub',
        'soap-icon-apple' => 'soap-icon-apple',
        'soap-icon-googleplay' => 'soap-icon-googleplay',
        'soap-icon-twitter' => 'soap-icon-twitter',
        'soap-icon-facebook' => 'soap-icon-facebook',
        'soap-icon-googleplus' => 'soap-icon-googleplus',
        'soap-icon-pinterest' => 'soap-icon-pinterest',
        'soap-icon-vimeo' => 'soap-icon-vimeo',
        'soap-icon-flickr' => 'soap-icon-flickr',
        'soap-icon-soundcloud' => 'soap-icon-soundcloud',
        'soap-icon-stumbleupon' => 'soap-icon-stumbleupon',
        'soap-icon-linkedin' => 'soap-icon-linkedin',
        'soap-icon-dribble' => 'soap-icon-dribble',
        'soap-icon-behance' => 'soap-icon-behance',
        'soap-icon-deviantart' => 'soap-icon-deviantart',
        'soap-icon-myspace' => 'soap-icon-myspace',
        'soap-icon-youtube' => 'soap-icon-youtube',
        'soap-icon-tumblr' => 'soap-icon-tumblr',
        'soap-icon-instagram' => 'soap-icon-instagram',
        'soap-icon-skype' => 'soap-icon-skype',
        'soap-icon-envato' => 'soap-icon-envato',
        'soap-icon-user' => 'soap-icon-user',
        'soap-icon-pets' => 'soap-icon-pets',
        'soap-icon-family' => 'soap-icon-family',
        'soap-icon-check' => 'soap-icon-check',
        'soap-icon-generalmessage' => 'soap-icon-generalmessage',
        'soap-icon-notice' => 'soap-icon-notice',
        'soap-icon-error' => 'soap-icon-error'
    ];

}
