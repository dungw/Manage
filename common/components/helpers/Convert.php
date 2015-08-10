<?php
namespace common\components\helpers;

use Faker\Provider\DateTime;

class Convert {

    public static function currentTimePoints() {
        $dtNow = new \DateTime();
        $timestamp = time();

        // Set a non-default timezone if needed
        $dtNow->setTimestamp($timestamp);

        $beginOfDay = clone $dtNow;

        // Go to midnight.  ->modify('midnight') does not do this for some reason
        $beginOfDay->setTime(0, 0, 0);

        $endOfDay = clone $beginOfDay;
        $endOfDay->modify('tomorrow');

        // adjust from the next day to the end of the day, per original question
        $endOfDay->modify('1 second ago');

        return [
            'time' => $timestamp,
            'start' => strtotime($beginOfDay->format('m/d/Y H:i:s e')),
            'end' => strtotime($endOfDay->format('m/d/Y H:i:s e')),
        ];
    }

    public static function currentWeekTimePoints() {
        $now = time();
        $beginning = strtotime('last Monday', $now);
        $end = strtotime('next Sunday', $now) + 86399;
        return [
            'start' => $beginning,
            'end' => $end,
        ];
    }

    public static function currentMonthTimePoints() {
        $beginning = strtotime(date('m/01/Y'));
        $end = strtotime(date('m/t/Y')) + 86399;
        return [
            'start' => $beginning,
            'end' => $end,
        ];
    }

    public static function powOf2($number) {
        $bits = array_reverse(str_split(decbin($number)));
        $output = array();
        foreach($bits as $key => $bit) {
            if($bit == 1) {
                $output[] = $key;
            }
        }
        return $output;
    }

    public static function date2Time($dateString, $format, $fromTime = 'begin') {
        if ($dateString != '') {
            $date = date_create_from_format($format, $dateString);
            $time = strtotime($date->format('m/d/Y'));
            if ($fromTime == 'end') $time += 86399;
            return $time;
        }
        return null;
    }

    public static function date2date($dateString, $from, $to) {
        if ($dateString != '') {
            $dateObj = date_create_from_format($from, $dateString);
            return $dateObj->format($to);
        }
        return null;
    }

    public static function dec2Bin($decimal, $length) {
        $binary = decbin($decimal);
        $curLength = strlen($binary);
        if ($curLength < $length) {
            for ($i=0; $i<($length-$curLength); $i++) {
                $binary = '0' . $binary;
            }
        }
        return $binary;
    }

    public static function getInfoByUrl($url) {
        $data = [];
        if ($url != '') {
            if (strpos('F'.$url, 'http')) $protocol = 'http';
            if (strpos('F'.$url, 'https')) $protocol = 'https';
            $url = trim($url, $protocol.'://');
            $a = explode('/', $url);
            if (!empty($a)) {
                $b = explode(':', $a[0]);
                if (!empty($b)) {
                    $data['url'] = $protocol . '://' . trim($b[0]) . '/snapshot.cgi';
                    $data['port'] = trim($b[1]);
                }

                $c = explode('?', $a[1]);
                if (!empty($c)) {
                    $d = explode('&', $c[1]);
                    if (!empty($d)) {
                        foreach ($d as $e) {
                            $f = explode('=', $e);
                            if (strpos('F'.$e, 'user')) {
                                $data['username'] = $f[1];
                            }
                            if (strpos('F'.$e, 'pwd')) {
                                $data['password'] = $f[1];
                            }
                        }
                    }
                }
            }
        }
        return $data;
    }
}