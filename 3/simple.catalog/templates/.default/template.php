<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

foreach ($arResult['NEWS'] as $key => $value) {
    ?>
    <ul>
        <li>
            <?= $value['NAME'] . ' - ' . $value['ACTIVE_FROM'] . ' (' ?>
            <?
            foreach ($value['SECTIONS'] as $section) {
                echo $section['NAME'] . ' ';
            }
            echo ')';
            foreach ($value['SECTIONS'] as $key => $value) {
                foreach ($arResult['ELEMENTS'][$key] as $key_element => $value_element) {
                    ?>
                    <ul>
                        <li>
                            <?
                            echo $arResult['ELEMENTS'][$key][$key_element]['NAME']
                                . ' - ' . $arResult['ELEMENTS'][$key][$key_element]['PROPERTY_PRICE_VALUE']
                                . ' - ' . $arResult['ELEMENTS'][$key][$key_element]['PROPERTY_MATERIAL_VALUE']
                                . ' - ' . $arResult['ELEMENTS'][$key][$key_element]['PROPERTY_ARTNUMBER_VALUE']; ?>
                        </li>
                    </ul>
                    <?
                }
            } ?>
        </li>
    </ul>
    <?
}
?>
