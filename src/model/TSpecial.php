<?php
namespace Fixzeus\Model;

use Faker\Factory as fakerFactory;
use Faker\Provider\Base;
use Faker\Provider\zh_CN\Address;
use Faker\Provider\DateTime;
use Faker\Provider\UserAgent;

class TSpecial
{
    public static function defineValue($path, $var)
    {
        if ($v = self::customize($path, $var)) {
            return $v;
        } else {
            return self::rangeValue($path, $var);
        }
    }

    public static function customize($path, $var)
    {
        if (!$specialData = self::getFileContent($path)) {
            return false;
        }
        $define_value = $specialData->define_value;
        foreach ($define_value as $k => $v) {
            if ($k === $var) {
                return $v;
            }
        }
        return false;
    }

    public static function rangeValue($path, $var)
    {
        if (!$specialData = self::getFileContent($path)) {
            return false;
        }
        $range_value = $specialData->range_value;
        foreach ($range_value as $k => $v) {
            if ($k === $var) {
                return self::getRangeValue($range_value->$k);
            }
        }
        return false;
    }

    public static function reviseData($var)
    {
        $faker = fakerFactory::create();
        $base = new Base($faker);
        $address = new Address($faker);
        $dateTime = new DateTime($faker);
        if (preg_match("/latitude/i", $var)) {
            return 180 + $address->latitude();
        }
        if (preg_match("/longitude/i", $var)) {
            return (float)$address->longitude();
        }
        if (preg_match("/address/i", $var)) {
            return $address->address();
        }
        if (preg_match("/city/i", $var)) {
            return $address->city();
        }
        if (preg_match("/name/i", $var)) {
            return $faker->name;
        }
        if (preg_match("/(created_at|time)/i", $var)) {
            return (string)$dateTime->unixTime($max = 'now');
        }
        if (preg_match("/pguid/i", $var)) {
            return strtoupper($base->bothify($stirng = '#?##??###?#'));
        }
        if (preg_match("/(mobile|phone)/i", $var)) {
            return '138' . $base->numerify($string = '########');
        }
        return false;
    }

    public static function getBool($int = false)
    {
        $faker = fakerFactory::create();
        $base = new Base($faker);
        if ($int) {
            return $base->numberBetween($min = 0, $max = 1);
        } else {
            return 1 === $base->numberBetween($min = 0, $max = 1);
        }
    }

    private function getFileContent($path)
    {
        if (!file_exists($path) || !$jsonData = file_get_contents($path)) {
            return false;
        }
        return json_decode($jsonData);
    }

    private function getRangeValue($jsonValue)
    {
        $faker = fakerFactory::create();
        $base = new Base($faker);
        $dateTime = new DateTime($faker);
        $userAgent = new UserAgent($faker);
        switch ($jsonValue->type) {
            case 'integer':
                return $base->numberBetween($jsonValue->min, $jsonValue->max);
                break;
            case 'date':
                return $dateTime->date($jsonValue->format, $jsonValue->max);
                break;
            case 'time':
                return $dateTime->time($jsonValue->format, $jsonValue->max);
                break;
            case 'datetime':
                $dateTimeArray = $dateTime->dateTimeBetween($jsonValue->min, $jsonValue->max);
                foreach ($dateTimeArray as $k => $v) {
                    if ($k === 'date') {
                        return $v;
                    }
                }
                return false;
                break;
            case 'unixtime':
                return $dateTime->unixTime($jsonValue->max);
                break;
            case 'userAgent':
                return call_user_func(array($userAgent, $jsonValue->value)) ;
                break;
            default:
                return false;
        }
    }
}
