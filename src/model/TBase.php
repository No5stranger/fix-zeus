<?php
namespace Fixzeus\Model;

use Exception;
use Fixzeus\Model\TType;
use Fixzeus\Model\TSpecial;
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

        if (defined('PATH')
            && $sData = TSpecial::defineValue(PATH, $tspec['var'])
        ) {
            return array($tspec['var'] => $sData);
        }

        if ($rData = TSpecial::reviseData($tspec['var'])) {
            return array($tspec['var'] => $rData);
        }

        if (in_array($tspec['type'], array(TType::BYTE, TType::I16, TType::I32, TType::I64))) {
            if (preg_match("/is_/i", $tspec['var'])) {
                return array($tspec['var'] => TSpecial::getBool(true));
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
                return TSpecial::getBool();
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
}
