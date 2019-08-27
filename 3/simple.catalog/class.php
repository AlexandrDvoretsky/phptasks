<?
use \Bitrix\Iblock\Component\ElementList;
use \Bitrix\Main;
use \Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

Loc::loadMessages(__FILE__);

if (!\Bitrix\Main\Loader::includeModule('iblock'))
{
	ShowError(Loc::getMessage('IBLOCK_MODULE_NOT_INSTALLED'));
	return;
}

class SimpleCatalogComponent extends CBitrixComponent{
    protected $errors;

    protected function initParams()
    {
        $this->arParams['CACHE_GROUPS'] = isset($this->arParams['CACHE_GROUPS']) ? $this->arParams['CACHE_GROUPS'] : '';
        $this->arParams['CACHE_TIME'] = isset($this->arParams['CACHE_TIME']) ? $this->arParams['CACHE_TIME'] : '3600';
        $this->arParams['CACHE_TYPE'] = isset($this->arParams['CACHE_TYPE']) ? $this->arParams['CACHE_TYPE'] : 'A';
        $this->arParams['IBLOCK_ID_CATALOG'] = isset($this->arParams['IBLOCK_ID_CATALOG']) ? $this->arParams['IBLOCK_ID_CATALOG'] : '';
        $this->arParams['IBLOCK_ID_NEWS'] = isset($this->arParams['IBLOCK_ID_NEWS']) ? $this->arParams['IBLOCK_ID_NEWS'] : '';
        $this->arParams['USER_PROPERTY_CODE'] = isset($this->arParams['USER_PROPERTY_CODE']) ? $this->arParams['USER_PROPERTY_CODE'] : '';
    }

    protected function getIblockSection(){
        $sectionList = array();
        $arSectionId = array();
        $arNewsId = array();

        $sectionList = CIBlockSection::GetList(
            array('SORT' => 'ASC'),
            array('IBLOCK_ID' => $this->arParams['IBLOCK_ID_CATALOG'], 'ACTIVE' => 'Y'),
            false,
            array('ID', 'IBLOCK_ID', 'NAME', 'UF_NEWS_LINK'),
            array()
        );

        while ($section = $sectionList->Fetch()) {
            $arSectionId[]=$section['ID'];
            foreach ($section[$this->arParams['USER_PROPERTY_CODE']] as $key=>$val){
                $this->arResult['NEWS'][$val]['SECTIONS'][$section['ID']]['NAME']=$section['NAME'];
                $arNewsId[$val]=$val;
            }
        }

        $this->arNewsId = $arNewsId;
        $this->arSectionId = $arSectionId;
    }

    protected function getNews(){
        $arNews = CIBlockElement::GetList(
            array("SORT"=>"ASC"),
            array('IBLOCK_ID'=>$this->arParams['IBLOCK_ID_NEWS'], 'ID'=>$this->arNewsId, 'ACTIVE'=>'Y'),
            false,
            false,
            array('ID', 'IBLOCK_ID', 'NAME', 'ACTIVE_FROM')
        );

        while ($news = $arNews->Fetch()) {
            $this->arResult['NEWS'][$news['ID']]['NAME'] =$news['NAME'];
            $this->arResult['NEWS'][$news['ID']]['ACTIVE_FROM'] =$news['ACTIVE_FROM'];
        }
    }

    protected function getProducts(){
        $arCatalogElements =  CIBlockElement::GetList(
            array("SORT"=>"ASC"),
            array('IBLOCK_ID'=> $this->arParams['IBLOCK_ID_CATALOG'], 'IBLOCK_SECTION_ID'=>$this->arSectionId, 'ACTIVE'=>'Y'),
            false,
            false,
            array('ID', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'NAME', 'PROPERTY_MATERIAL', 'PROPERTY_ARTNUMBER', 'PROPERTY_PRICE')
        );

        while ($catalogElement = $arCatalogElements->Fetch()) {
            $this->cnt++;
            $this->arResult['ELEMENTS'][$catalogElement['IBLOCK_SECTION_ID']][] = $catalogElement;
        }
    }

    protected function prepareResult()
    {
        $this->initParams();
        $this->cnt = 0;

        $this->getIblockSection();
        $this->getNews();
        $this->getProducts();

        if($this->StartResultCache())
            $this->setResultCacheKeys($this->arResult);

        return $this->arResult;
    }

    protected function printErrors()
    {
        foreach ($this->errors as $error) {
            ShowError($error);
        }
    }

    public function executeComponent()
    {
        $this->errors = new \Bitrix\Main\ErrorCollection();

        if (!$this->prepareResult()) {
            $this->printErrors();
            return;
        }
        global $APPLICATION;
        $APPLICATION->SetPageProperty('title', "В каталоге товаров представлено товаров: ".$this->cnt);
        $this->includeComponentTemplate();
    }
}
