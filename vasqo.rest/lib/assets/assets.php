<?php

namespace Vasqo\Rest\Assets;

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Page\Asset;
use Vasqo\Rest\Module;

class Assets extends Module
{
    /**
     * @return false
     */
    public function appendAssetsToPage()
    {
        try {
            $test = Asset::getInstance()->addCss("/bitrix/css/" . self::MODULE_ID . "/style.css");
            Asset::getInstance()->addJs("/bitrix/js/" . self::MODULE_ID . "/script.js");

        } catch (\Exception $ex) {
        }

        return false;
    }

    /**
     * @param $arGlobalMenu
     * @param $arModuleMenu
     */
    public function OnBuildGlobalMenuHandler(&$arGlobalMenu, &$arModuleMenu)
    {
        $iModuleID = self::MODULE_ID;
        global $APPLICATION;

        if (!isset($arGlobalMenu['global_menu_vasqo'])) {
            $arGlobalMenu['global_menu_vasqo'] = [
                'menu_id' => 'vasqo',
                'text' => "Vasqo",
                'title' => "Vasqo",
                'sort' => 1000,
                'items_id' => 'global_menu_vasqo_items',
                "icon" => "main-vasqo-icon",
                "page_icon" => "main-vasqo-icon",
            ];
        }
    }

}