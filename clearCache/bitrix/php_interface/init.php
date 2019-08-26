<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

AddEventHandler('iblock', 'OnAfterIBlockElementAdd', array('CClearCache', 'checkAgent'));
AddEventHandler('iblock', 'OnAfterIBlockElementUpdate', array('CClearCache', 'checkAgent'));
AddEventHandler('iblock', 'OnBeforeIBlockElementDelete', array('CClearCache', 'removeAgentFromAgentList'));

CModule::AddAutoloadClasses(
    '',
    array(
        'cclearcache' => '/bitrix/custom/cclearcache.php',
    )
);

?>