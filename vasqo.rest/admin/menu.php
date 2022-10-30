<?php
//подключаем класс и файлы локализации
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

Loc::loadMessages(__FILE__);

Asset::getInstance()->addCss("/bitrix/panel/main/vasqo_rest_menu.css");

//добавляем пункт меню для нашего модуля
$aMenu = [
    "parent_menu" => "global_menu_vasqo",
    "sort" => 1000,
    'text' => "REST API",
    'title' => "REST API",
    "icon"=>"vasqo_rest_icon",
    "page_icon" => "vasqo_rest_icon",
    "items_id" => "vasqo_rest",
    'section' => "vasqo_rest",
    'menu_id' => 'vasqo_rest',
    'url' => "vasqo_rest_docs.php?lang=" . LANGUAGE_ID,
    "module_id" => str_replace("_", ".", strtolower(Vasqo_Rest::class)),
];

return $aMenu;