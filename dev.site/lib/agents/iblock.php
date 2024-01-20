<?php

namespace Dev\Site\Agents;


class Iblock
{
    public static function clearOldLogs()
    {
        $logIBlockElements = \CIBlockElement::GetList(
            [],
            ["IBLOCK_CODE" => "LOG"],
            false,
            false,
            ["ID"]
        );

        $logIBlockIdArr = [];
        while (($logIBlockElement = $logIBlockElements->GetNext()) !== false) {
            $logIBlockIdArr[] = $logIBlockElement["ID"];
        }
        rsort($logIBlockIdArr);
        $logIBlockIdArr = array_slice($logIBlockIdArr, 10);

        foreach ($logIBlockIdArr as $logIBlockId) {
            \CIBlockElement::Delete((int)$logIBlockId);
        }

        return '\\' . __CLASS__ . '::' . __FUNCTION__ . '();';
    }

    public static function example()
    {
        global $DB;
        if (\Bitrix\Main\Loader::includeModule('iblock')) {
            $iblockId = \Only\Site\Helpers\IBlock::getIblockID('QUARRIES_SEARCH', 'SYSTEM');
            $format = $DB->DateFormatToPHP(\CLang::GetDateFormat('SHORT'));
            $rsLogs = \CIBlockElement::GetList(['TIMESTAMP_X' => 'ASC'], [
                'IBLOCK_ID' => $iblockId,
                '<TIMESTAMP_X' => date($format, strtotime('-1 months')),
            ], false, false, ['ID', 'IBLOCK_ID']);
            while ($arLog = $rsLogs->Fetch()) {
                \CIBlockElement::Delete($arLog['ID']);
            }
        }
        return '\\' . __CLASS__ . '::' . __FUNCTION__ . '();';
    }
}
