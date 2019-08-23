<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("iblockproperty");
?>

<?
\Bitrix\Main\Loader::includeModule('iblock');

$iblockId = '1';
$propertyCode = 'AUTHOR';
$arElementsId = array();

$arSelect = array('ID', 'IBLOCK_ID', 'NAME');
$arFilter = array('IBLOCK_ID' => $iblockId);

$dbItems = \Bitrix\Iblock\ElementTable::getList(array(
    'select' => $arSelect,
    'filter' => $arFilter,
));

while ($arItem = $dbItems->fetch()) {
    $dbProperty = \CIBlockElement::getProperty(
        $arItem['IBLOCK_ID'],
        $arItem['ID']
    );
    while ($arProperty = $dbProperty->Fetch()) {
        $arItem['PROPERTIES'][$arProperty['ID']] = $arProperty;
        if (empty($arItem['PROPERTIES'][$arProperty['ID']]['VALUE'])) {
            $arElementsId[] = $arItem['ID'];
            CIBlockElement::SetPropertyValuesEx($arItem['ID'], $arItem['IBLOCK_ID'], array($propertyCode => $arItem['NAME']));
        }
    }
}
if(empty($arElementsId)){
    echo "У всех элементов установлено свойство с кодом PROPERTY_".$propertyCode;
}else{
    echo "ID элементов которые были обновлены: \n ";
    foreach ($arElementsId as $key=>$val){

        if(end($arElementsId)==$val)
            echo $val.".";
        else
            echo $val.", ";
    }
}

?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>