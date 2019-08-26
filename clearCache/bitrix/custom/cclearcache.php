<?
class CClearCache
    {
        function clearCacheAgent($id, $iblock_id)
        {
            $GLOBALS['CACHE_MANAGER']->ClearByTag("iblock_id_" . $iblock_id);
        }

        function checkAgent($arElement)
        {
            $res = CAgent::GetList(Array("ID" => "DESC"), array("NAME" => CClearCache::getAgentTitle($arElement['ID'], $arElement['IBLOCK_ID'])));
            if (!$agent = $res->fetch()) {
                if (!empty($arElement['ACTIVE_TO'])) {
                    CClearCache::createAgent($arElement['ID'], $arElement['IBLOCK_ID'], $arElement['ACTIVE_TO'], $arElement['ID']);
                }
            } else {
                if (!empty($arElement['ACTIVE_TO'])) {
                    if($agent['NEXT_EXEC']!=$arElement['ACTIVE_TO']){
                        CAgent::Update($agent['ID'], array("NEXT_EXEC" => $arElement['ACTIVE_TO']));
                    }
                } else {
                    CClearCache::removeAgent($arElement['ID'], $arElement['IBLOCK_ID']);
                }
            }
        }

        function createAgent($id, $iblock_id, $next_exec, $sort)
        {
            CAgent::AddAgent(CClearCache::getAgentTitle($id, $iblock_id), "", "Y", '3600', "", "Y", $next_exec, $sort);
        }

        function removeAgent($id, $iblock_id)
        {
            CAgent::RemoveAgent(CClearCache::getAgentTitle($id, $iblock_id), "");
        }

        function getAgentTitle($id, $iblock_id)
        {
            return "CClearCache::clearCacheAgent(" . $id . "," . $iblock_id . ");";
        }

        function removeAgentFromAgentList($id){
            $iblock = CIBlockElement::GetIBlockByID($id);
            CClearCache::removeAgent($id, $iblock);
        }
    }
?>