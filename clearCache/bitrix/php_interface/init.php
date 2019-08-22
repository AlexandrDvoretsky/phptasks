<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

define('NEWS_IBLOCK_ID', 1);

AddEventHandler('iblock', 'OnAfterIBlockElementAdd', array('CIBlockHandler', 'OnAfterIBlockElementAddHandler'));
AddEventHandler('iblock', 'OnAfterIBlockElementUpdate', array('CIBlockHandler', 'OnAfterIBlockElementUpdateHandler'));
AddEventHandler('iblock', 'OnAfterIBlockElementDelete', array('CIBlockHandler', 'OnAfterIBlockElementDeleteHandler'));

class CIBlockHandler
{
    function OnAfterIBlockElementAddHandler(&$arFields)
    {
        CModule::IncludeModule("iblock");

        if ($arFields["ID"] > 0) {
            createAgent($arFields);
        }

    }

    function OnAfterIBlockElementUpdateHandler(&$arFields)
    {
        CIBlockHandler::OnAfterIBlockElementAddHandler($arFields);
    }


    function OnAfterIBlockElementDeleteHandler($arFields)
    {
        $rsElements = getElements();
        while ($arElement = $rsElements->Fetch()) {
            createAgent($arElement);
        }

    }
}


function clearCacheAgent()
{
    $GLOBALS['CACHE_MANAGER']->ClearByTag("iblock_id_" . NEWS_IBLOCK_ID);
}

function createAgent($arElement)
{
    $res = CAgent::GetList(Array("ID" => "DESC"), array("NAME" => "clearCacheAgent(" . ($arElement['ID']) . ");"));
    if (!$agent = $res->fetch()) {
        CAgent::AddAgent("clearCacheAgent(" . ($arElement['ID']) . ");", "", "Y", '3600', "", "Y", $arElement['ACTIVE_TO'], $arElement['ID']);
    } else {
        CAgent::Update($agent['ID'], array("NEXT_EXEC" => $arElement['ACTIVE_TO']));
    }
}

function getElements()
{

    $arFilter = array("IBLOCK_ID" => NEWS_IBLOCK_ID, "ACTIVE" => "Y");
    $arSelect = array('ID', 'IBLOCK_ID', 'NAME', 'ACTIVE_TO');
    $rsElements = CIBlockElement::GetList(Array('ACTIVE_TO' => 'ASC'), $arFilter, false, Array("nPageSize" => 50), $arSelect);

    return $rsElements;
}

?>