<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var string $componentPath
 * @var string $componentName
 */

use Bitrix\Main\Loader,
	Bitrix\Main\Web\Json,
	Bitrix\Iblock,
	Bitrix\Catalog,
	Bitrix\Currency;

if (!Loader::includeModule('iblock'))
	return;

$arComponentParameters = array(
    'PARAMETERS' => array(
        'IBLOCK_ID_CATALOG' => array(
            'PARENT' => 'BASE',
            'NAME' => GetMessage('IBLOCK_IBLOCK_CATALOG'),
            'TYPE' => 'STRING',
            'VALUES' => '',
        ),
        'IBLOCK_ID_NEWS' => array(
            'PARENT' => 'BASE',
            'NAME' => GetMessage('IBLOCK_IBLOCK_NEWS'),
            'TYPE' => 'STRING',
            'VALUES' => '',
        ),
        'USER_PROPERTY_CODE' => array(
            'PARENT' => 'BASE',
            'NAME' => GetMessage('USER_PROPERTY_CODE'),
            'TYPE' => 'STRING',
            'VALUES' => '',
        ),
        'CACHE_TIME'  =>  Array('DEFAULT'=>36000000),
        'CACHE_GROUPS' => array(
            'PARENT' => 'CACHE_SETTINGS',
            'NAME' => GetMessage('CP_BCT_CACHE_GROUPS'),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'Y',
        ),
    )
);