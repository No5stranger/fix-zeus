<?php
namespace Fixzeus\Model;

use Exception;
use Fixzeus\Model\TType;
use Fixzeus\Model\TBase;

class TStruct
{
    public static function getStruct(array $tspec)
    {
        if (!isset($tspec['type']) || !isset($tspec['class']) || $tspec['type'] != TType::STRUCT) {
            return new Exception('unvalid value');
        }

        $class = new $tspec['class'];
        $_TSPEC = $class::$_TSPEC;
        $_TSPECLength = count($_TSPEC);
        $struct = array();
        for ($i = 1; $i <= $_TSPECLength; $i++) {
            $struct = array_merge($struct, TBase::get($_TSPEC[$i]));
        }
        return new $tspec['class']($struct);
    }
}
