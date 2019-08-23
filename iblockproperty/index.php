<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("iblockproperty");
?>

<?
CModule::IncludeModule("iblock");

$iblockId = array(1);
$propertyCode = 'AUTHOR';
$arElementsId = array();
$arOrder = array("SORT"=>"ASC");
$arFilter = array('IBLOCK_ID' => $iblockId, 'PROPERTY_'.$propertyCode=>false);
$arGroupBy  = false;
$arNavStartParams = false;
$arSelect = array('ID', 'IBLOCK_ID', 'NAME');

$res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelect);
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arElementsId[] = $arFields['ID'];
    CIBlockElement::SetPropertyValuesEx($arFields['ID'], $arFields['IBLOCK_ID'], array($propertyCode => $arFields['NAME']));
}

if(empty($arElementsId)){
    echo "У всех элементов установлено свойство с кодом PROPERTY_".$propertyCode;
}else{
    echo "ID элементов которые были обновлены: ";
    foreach ($arElementsId as $key=>$val){

        if(end($arElementsId)==$val)
            echo $val.".";
        else
            echo $val.", ";
    }
}

?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
