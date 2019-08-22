<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

define('NEWS_IBLOCK_ID', 1);

AddEventHandler('iblock', 'OnAfterIBlockElementAdd', array('CIBlockHandler', 'OnAfterIBlockElementAddHandler'));
AddEventHandler('iblock', 'OnAfterIBlockElementUpdate', array('CIBlockHandler', 'OnAfterIBlockElementUpdateHandler'));
AddEventHandler('iblock', 'OnBeforeIBlockElementDelete', array('CIBlockHandler', 'OnBeforeIBlockElementDeleteHandler'));

class CIBlockHandler
{
    function OnAfterIBlockElementAddHandler(&$arFields)
    {
        \Bitrix\Main\Loader::includeModule('iblock');

        if ($arFields["ID"] > 0) {
            CIBlockHandler::createAgent($arFields);
        }

    }

    function OnAfterIBlockElementUpdateHandler(&$arFields)
    {
        CIBlockHandler::OnAfterIBlockElementAddHandler($arFields);
    }


    function OnBeforeIBlockElementDeleteHandler($ID)
    {
        CAgent::RemoveAgent("CIBlockHandler::clearCacheAgent(" . ($ID) . ");");
    }

    function clearCacheAgent($id)
    {
        \Bitrix\Main\Loader::includeModule('iblock');
        $iblock = CIBlockElement::GetIBlockByID($id);

        $GLOBALS['CACHE_MANAGER']->ClearByTag("iblock_id_" . $iblock);
    }

    function createAgent($arElement)
    {
        $res = CAgent::GetList(Array("ID" => "DESC"), array("NAME" => "CIBlockHandler::clearCacheAgent(" . ($arElement['ID']) . ");"));
        if (!$agent = $res->fetch()) {
            if(!empty( $arElement['ACTIVE_TO'])){
                CAgent::AddAgent("CIBlockHandler::clearCacheAgent(" . ($arElement['ID']) . ");", "", "Y", '3600', "", "Y", $arElement['ACTIVE_TO'], $arElement['ID']);
            }
        } else {
            if(!empty( $arElement['ACTIVE_TO'])) {
                CAgent::Update($agent['ID'], array("NEXT_EXEC" => $arElement['ACTIVE_TO']));
            }else{
                CAgent::RemoveAgent("CIBlockHandler::clearCacheAgent(" . ($arElement['ID']) . ");");
            }
        }
    }
}

?>