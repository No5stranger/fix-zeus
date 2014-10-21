<?php
namespace Fixzeus\Model;

use Exception;
use Fixzeus\Model\TType;
use Fixzeus\Model\TBase;

class TMap
{
    public static function getMap(array $tspec)
    {
        if (!isset($tspec['type'])
            || !isset($tspec['ktype'])
            || !isset($tspec['vtype'])
            || !isset($tspec['key'])
            || !isset($tspec['val'])
            || $tspec['type'] != TType::MAP
        ) {
            return new Exception('unvalid value');
        }

        $kData = TBase::get(array('var' => 'key', 'type' => $tspec['ktype']));
        $vData = TBase::get(array('var' => 'val', 'type' => $tspec['vtype']));
        return array($kData['key'], $vData['val']);
    }
}
