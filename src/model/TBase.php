<?php
namespace Fixzeus\Model;

use Exception;
use Fixzeus\Model\TType;
use Faker\Factory as fakerFactory;
use Faker\Provider\Base;
use Faker\Provider\Lorem;
use Faker\Provider\zh_CN\Address;
use Faker\Provider\DateTime;

class TBase
{
    public static $tType = array(
        TType::BOOL => 'bool',
        TType::BYTE => '8integer',
        TType::I16 => '16integer',
        TType::I32 => '32integer',
        TType::I64 => '64integer',
        TType::DOUBLE => 'float',
        TType::STRING => 'string',
    );

    private static $intRange = array(
        'start' => 0,
        '8integer' => 128,
        '16integer' => 32768,
        '32integer' => 2147483648,
        '64integer' => 2147483648
    );

    public static function get(array $tspec)
    {
        $faker = fakerFactory::create();
        $base = new Base($faker);
        $lorem = new Lorem($faker);
        if (!isset($tspec['var']) || !isset($tspec['type'])) {
            return new Exception('unvalid value');
        }

        if ($rData = self::reviseData($tspec['var'])) {
            return array($tspec['var'] => $rData);
        }

        if (in_array($tspec['type'], array(TType::BYTE, TType::I16, TType::I32, TType::I64))) {
            if (preg_match("/is_/i", $tspec['var'])) {
                return array($tspec['var'] => self::getBool(true));
            }
            return array(
                $tspec['var'] => $base->numberBetween(
                    $min = self::$intRange['start'],
                    $max = self::$intRange[self::$tType[$tspec['type']]]
                )
            );
        }

        switch ($tspec['type']) {
            case TType::BOOL:
                return array($tspec['var'] => self::getBool());
                break;
            case TType::DOUBLE:
                return array($tspec['var'] => $base->randomFloat());
                break;
            case TType::STRING:
                return array($tspec['var'] => $lorem->text($maxNbChars = 50));
                break;
            default:
                return new Exception('unvalid value');
        }
    }

    private static function reviseData($var)
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

    private static function getBool($int = false)
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
