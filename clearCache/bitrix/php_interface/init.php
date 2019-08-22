<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

AddEventHandler('iblock', 'OnAfterIBlockElementAdd', array('CIBlockHandler', 'OnAfterIBlockElementAddHandler'));
AddEventHandler('iblock', 'OnAfterIBlockElementUpdate', array('CIBlockHandler', 'OnAfterIBlockElementUpdateHandler'));
AddEventHandler('iblock', 'OnBeforeIBlockElementDelete', array('CIBlockHandler', 'OnBeforeIBlockElementDeleteHandler'));

class CIBlockHandler
{
    function OnAfterIBlockElementAddHandler(&$arFields)
    {
        if ($arFields["ID"] > 0) {
            CIBlockHandler::createAgent($arFields);
        }
    }

    function OnAfterIBlockElementUpdateHandler(&$arFields)
    {
        CIBlockHandler::OnAfterIBlockElementAddHandler($arFields);
    }

    function OnBeforeIBlockElementDeleteHandler($id)
    {
        $iblock = CIBlockElement::GetIBlockByID($id);
        CAgent::RemoveAgent("CIBlockHandler::clearCacheAgent(" . ($id) . "," . ($iblock) . ");", "iblock");
    }

    function clearCacheAgent($id, $iblock_id)
    {
        $GLOBALS['CACHE_MANAGER']->ClearByTag("iblock_id_" . $iblock_id);
    }

    function createAgent($arElement)
    {
        $res = CAgent::GetList(Array("ID" => "DESC"), array("NAME" => "CIBlockHandler::clearCacheAgent(" . ($arElement['ID']) . "," . ($arElement['IBLOCK_ID']) .");"));
        if (!$agent = $res->fetch()) {
            if(!empty( $arElement['ACTIVE_TO'])){
                CAgent::AddAgent("CIBlockHandler::clearCacheAgent(" . ($arElement['ID']) . "," . ($arElement['IBLOCK_ID']) . ");", "iblock", "Y", '3600', "", "Y", $arElement['ACTIVE_TO'], $arElement['ID']);
            }
        } else {
            if(!empty( $arElement['ACTIVE_TO'])) {
                CAgent::Update($agent['ID'], array("NEXT_EXEC" => $arElement['ACTIVE_TO']));
            }else{
                CAgent::RemoveAgent("CIBlockHandler::clearCacheAgent(" . ($arElement['ID']) . "," . ($arElement['IBLOCK_ID']) . ");", "iblock");
            }
        }
    }
}
?>