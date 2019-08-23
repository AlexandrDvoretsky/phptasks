<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

AddEventHandler('iblock', 'OnAfterIBlockElementAdd', 'OnAfterIBlockElementAddHandler');
AddEventHandler('iblock', 'OnAfterIBlockElementUpdate', 'OnAfterIBlockElementAddHandler');
AddEventHandler('iblock', 'OnBeforeIBlockElementDelete', 'OnBeforeIBlockElementDeleteHandler');

CModule::AddAutoloadClasses(
    '',
    array(
        'cclearcache' => '/bitrix/custom/cclearcache.php',
    )
);

function OnAfterIBlockElementAddHandler($arFields)
{
    CClearCache::checkAgent($arFields);
}

function OnBeforeIBlockElementDeleteHandler($id)
{
    $iblock = CIBlockElement::GetIBlockByID($id);
    CClearCache::removeAgent($id, $iblock);
}
?>