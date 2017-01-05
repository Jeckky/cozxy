<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\helpers;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

/**
 * Description of CozxyUnity
 *
 * @author it
 * 5/1/2017 by Taninut.Bm
 */
class CozxyUnity {

    //put your code here
    /*
     * Converting timestamp to time ago in PHP e.g 1 day ago, 2 days ago…
     * Use example :
      echo time_elapsed_string('2013-05-01 00:22:35');
      echo time_elapsed_string('@1367367755'); # timestamp input
      echo time_elapsed_string('2013-05-01 00:22:35', true);
     * Output :
      4 months ago
      4 months, 2 weeks, 3 days, 1 hour, 49 minutes, 15 seconds ago
     */
    public static function TimeElapsedString($datetime, $full = false) {
        $now = new \DateTime;
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full)
            $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

}
