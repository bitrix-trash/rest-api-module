<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;

Loc::loadMessages(__DIR__);

class Vasqo_Rest extends CModule
{
    public function __construct()
    {
        $arModuleVersion = [];

        include_once __DIR__ . "/version.php";

        $this->MODULE_ID = self::getModuleName();
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_NAME = "Vasqo REST API";
        $this->MODULE_DESCRIPTION = "Creating REST API in Bitrix";
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->PARTNER_NAME = "Vasqo";
        $this->PARTNER_URI = "";
    }

    public function DoInstall()
    {
        global $APPLICATION;

        if (CheckVersion(ModuleManager::getVersion("main"), "14.00.00")) {

            $this->InstallFiles();
            $this->InstallDB();

            ModuleManager::registerModule($this->MODULE_ID);

            $this->InstallEvents();
        } else {

            $APPLICATION->ThrowException(
                "Error to install module"
            );
        }

        $APPLICATION->IncludeAdminFile(
            Loc::getMessage('INSATLL_INSATLL') . " \"" . Loc::getMessage("INSATLL_NAME") . "\"",
            __DIR__ . "/step.php"
        );

        return false;
    }

    public function InstallFiles()
    {

        CopyDirFiles(
            __DIR__ . "/assets/scripts",
            Application::getDocumentRoot() . "/bitrix/js/" . $this->MODULE_ID . "/",
            true,
            true
        );

        CopyDirFiles(
            __DIR__ . "/assets/styles",
            Application::getDocumentRoot() . "/bitrix/css/" . $this->MODULE_ID . "/",
            true,
            true
        );
        CopyDirFiles(
            __DIR__ . "/assets/styles",
            Application::getDocumentRoot() . "/bitrix/panel/main/",
            true,
            true
        );

        CopyDirFiles(
            __DIR__ . "/assets/images",
            Application::getDocumentRoot() . "/bitrix/images/" . $this->MODULE_ID . "/",
            true,
            true
        );

        CopyDirFiles(
            __DIR__ . "/admin",
            Application::getDocumentRoot() . "/bitrix/admin/",
            true,
            true
        );

        CopyDirFiles(
            __DIR__ . "/components",
            Application::getDocumentRoot() . "/bitrix/components/",
            true,
            true
        );

        CopyDirFiles(
            __DIR__ . "/../admin",
            Application::getDocumentRoot() . "/bitrix/modules/" . $this->MODULE_ID . "/admin/",
            true,
            true
        );

        CopyDirFiles(
            __DIR__ . "/local",
            Application::getDocumentRoot() . "/local",
            true,
            true
        );

        /*CUrlRewriter::Add([
            "SITE_ID" => SITE_ID,
            "CONDITION" => "#^/local/api/(.+)/#",
            "ID" => null,
            "PATH" => "/local/api/index.php",
            "RULE" => "route=$1"
        ]);*/

        return false;
    }

    public function InstallDB()
    {

        return false;
    }


    public function InstallEvents()
    {
        $eventManager = EventManager::getInstance();

        foreach ($this->getEventsList() as $event) {
            $eventManager->registerEventHandler(
                $event['module'],
                $event['event'],
                $this->MODULE_ID,
                $event['class'],
                $event['method']
            );
        }
        return true;
    }

    private function getEventsList()
    {
        return [
            [
                'module' => "main",
                'event' => "OnBeforeEndBufferContent",
                'class' => '\Vasqo\Rest\Assets\Assets',
                'method' => "appendAssetsToPage"
            ],
            [
                'module' => "main",
                'event' => "OnBuildGlobalMenu",
                'class' => '\Vasqo\Rest\Assets\Assets',
                'method' => "OnBuildGlobalMenuHandler"
            ],
        ];
    }

    public function DoUninstall()
    {

        global $APPLICATION;

        $this->UnInstallFiles();
        $this->UnInstallDB();
        $this->UnInstallEvents();

        ModuleManager::unRegisterModule($this->MODULE_ID);

        $APPLICATION->IncludeAdminFile(
            Loc::getMessage('INSTALL_UNINSTALL') . " \"" . Loc::getMessage("INSATLL_NAME") . "\"",
            __DIR__ . "/unstep.php"
        );

        return false;
    }

    public function UnInstallFiles()
    {

        Directory::deleteDirectory(
            Application::getDocumentRoot() . "/bitrix/js/" . $this->MODULE_ID
        );

        Directory::deleteDirectory(
            Application::getDocumentRoot() . "/bitrix/css/" . $this->MODULE_ID
        );

        Directory::deleteDirectory(
            Application::getDocumentRoot() . "/bitrix/images/" . $this->MODULE_ID
        );

        Directory::deleteDirectory(
            Application::getDocumentRoot() . "/local/api/"
        );


        return false;
    }

    public function UnInstallDB()
    {

        Option::delete($this->MODULE_ID);

        return false;
    }

    public function UnInstallEvents()
    {

        $eventManager = EventManager::getInstance();

        foreach ($this->getEventsList() as $event) {

            $eventManager->unRegisterEventHandler(
                $event['module'],
                $event['event'],
                $this->MODULE_ID,
                $event['class'],
                $event['method']
            );
        }
        return true;
    }


    public static function getModuleName()
    {
        return str_replace("_", ".", strtolower(self::class));
    }
}