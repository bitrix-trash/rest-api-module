<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_before.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/prolog.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_after.php';

$APPLICATION->SetTitle("VASQO REST API DOCS");

$APPLICATION->IncludeComponent("vasqo:documentation", ".default", []);

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_admin.php';