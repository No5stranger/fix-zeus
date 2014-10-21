<?php
namespace Fixzeus\Model;

use Exception;
use Fixzeus\Model\TType;
use Fixzeus\Model\TBase;
use Fixzeus\Model\TStruct;
use Fixzeus\Model\TMap;

class TLst
{
    public static function getLst(array $tspec)
    {
        if (!isset($tspec['var'])
            || !isset($tspec['type'])
            || !isset($tspec['etype'])
            || !isset($tspec['elem'])
            || $tspec['type'] != TType::LST
        ) {
            return new Exception('unvalid value');
        }

        if ($tspec['etype'] === TType::STRUCT) {
            return array(TStruct::getStruct($tspec['elem']));
        }

        if ($tspec['etype'] === TType::MAP) {
            return array(TMap::getMap($tspec['elem']));
        }

        if (in_array($tspec['etype'], array_keys(TBase::$tType))) {
            $tBaseData = TBase::get(array('var' => $tspec['var'], 'type' => $tspec['etype']));
            return array($tBaseData[$tspec['var']]);
        }
    }
}
