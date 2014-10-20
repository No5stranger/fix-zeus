<?php
namespace Fixzeus\Model;

use Exception;
use Faker\Factory;
use Faker\Provider\Base;
use Faker\Provider\Lorem;

class TBase
{
    private static $tType = array(
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

    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function get(array $tspec)
    {
        $base = new Base($this->faker);
        $lorem = new Lorem($this->faker);
        if (!isset($tspec['var']) || !isset($tspec['type'])) {
            return new Exception('unvalid value');
        }

        if (in_array($tspec['type'], array(TType::BYTE, TType::I16, TType::I32, TType::I64))) {
            return array(
                $tspec['var'] => $base->numberBetween(
                    $min = self::$intRange['start'],
                    $max = self::$intRange[self::$tType[$tspec['type']]]
                )
            );
        }

        switch ($tspec['type']) {
            case TType::BOOL:
                return array($tspec['var'] => true);
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
