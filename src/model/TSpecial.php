<?php
namespace Fixzeus\Model;

use Faker\Factory as fakerFactory;
use Faker\Provider\Base;
use Faker\Provider\zh_CN\Address;
use Faker\Provider\DateTime;

class TSpecial
{
    public static function customize($path, $var)
    {
        if (!file_exists($path) || !$jsonData = file_get_contents($path)) {
            return false;
        }
        $specialData = json_decode($jsonData);
        $define_value = $specialData->define_value;
        for ($i = 0; $i < count($define_value); $i++) {
            foreach ($define_value[$i] as $k => $v) {
                if ($k === $var) {
                    return $v;
                }
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
}
