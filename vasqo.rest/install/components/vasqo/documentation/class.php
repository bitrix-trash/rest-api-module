<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class VasqoRestDocumtation extends \CBitrixComponent
{
    public function onPrepareComponentParams($params)
    {
        return $params;
    }

    public function executeComponent()
    {
        if ($this->request->isAdminSection()) {
            $this->includeComponentTemplate();
        }
    }
}