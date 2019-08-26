<?

class CClearCache
{
    public $arIblockId = array(1);

    function clearCacheAgent($id, $iblock_id)
    {
        $obj = new CClearCache();
        if (in_array($iblock_id, $obj->arIblockId))
            $GLOBALS['CACHE_MANAGER']->ClearByTag("iblock_id_" . $iblock_id);
    }

    function checkAgent($arElement)
    {
        $obj = new CClearCache();
        if (in_array($arElement['IBLOCK_ID'], $obj->arIblockId)) {

            $res = CAgent::GetList(Array("ID" => "DESC"), array(
                "NAME" => $obj->getAgentTitle($arElement['ID'], $arElement['IBLOCK_ID'])
            ));

            if ($agent = $res->fetch()) {

                if (empty($arElement['ACTIVE_TO']))
                    $obj->removeAgent($arElement['ID'], $arElement['IBLOCK_ID']);

                if ($arElement['ACTIVE_TO'] && $agent['NEXT_EXEC'] != $arElement['ACTIVE_TO'])
                    CAgent::Update($agent['ID'], array("NEXT_EXEC" => $arElement['ACTIVE_TO']));

            } else {

                if ($arElement['ACTIVE_TO'])
                    $obj->createAgent($arElement['ID'], $arElement['IBLOCK_ID'], $arElement['ACTIVE_TO'], $arElement['ID']);

            }
        }
    }

    function createAgent($id, $iblock_id, $next_exec, $sort)
    {
        CAgent::AddAgent($this->getAgentTitle($id, $iblock_id), "", "Y", '3600',
            "", "Y", $next_exec, $sort);
    }

    function removeAgent($id, $iblock_id)
    {
        CAgent::RemoveAgent($this->getAgentTitle($id, $iblock_id), "");
    }

    public function getAgentTitle($id, $iblock_id)
    {
        return "CClearCache::clearCacheAgent(" . $id . "," . $iblock_id . ");";
    }

    function removeAgentFromAgentList($id)
    {
        $obj = new CClearCache();
        $iblock = CIBlockElement::GetIBlockByID($id);
        $obj->removeAgent($id, $iblock);
    }
}

?>

