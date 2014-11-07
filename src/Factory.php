<?php
namespace Fixzeus;

use Exception;
use Fixzeus\Model\TType;
use Fixzeus\Model\Service;
use Fixzeus\Model\TBase;
use Fixzeus\Model\TMap;
use Fixzeus\Model\TStruct;
use Fixzeus\Model\TLst;

class Factory
{
    private static $_prefix = '\\';
    private static $_result = '_result';

    private $service = array();

    public function __construct($service, $path = null)
    {
        if (!$service || !is_array($service)) {
            throw new Exception('unvalid parameter: service must be array');
        }
        $this->service = $service;

        if($path && !defined('PATH')) {
            define('PATH', $path);
        }

    }
    public function fix($service, $method)
    {
        $class = self::$_prefix.
            strtoupper($service).
            self::$_prefix.
            $this->service[$service].
            $method.
            self::$_result;
        $obj = new $class;
        $_TSPEC = $obj::$_TSPEC;

        if (self::getValueType($_TSPEC) === null) {
            return null;
        }

        if (in_array(self::getValueType($_TSPEC), array_keys(TBase::$tType))) {
            return TBase::get($_TSPEC[0]);
        }

        switch (self::getValueType($_TSPEC)) {
            case TType::MAP:
                return TMap::getMap($_TSPEC[0]);
                break;
            case TType::STRUCT:
                return TStruct::getStruct($_TSPEC[0]);
                break;
            case TType::LST:
                return TLst::getLst($_TSPEC[0]);
                break;
            default:
                return new Exception('unvalid type');
        }
    }

    public static function getValueType($_TSPEC)
    {
        if (!isset($_TSPEC[0])) {
            return null;
        }
        return $_TSPEC[0]['type'];
    }
}
