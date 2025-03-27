<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bex\D7dull\ExampleTable;
use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Bitrix\Main\Entity\Base;
use \Bitrix\Main\Config\Option;


Loc::loadMessages(__FILE__);

class CV_Settings extends CModule
{
    public function __construct()
    {
        $arModuleVersion = [];

        include(__DIR__ . '/version.php');

        $this->exclusionAdminFiles = [
            "..",
            ".",
            "menu.php",
            "operation_description.php",
            "task_description.php",
        ];

        $this->MODULE_ID = 'cv.settings';
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = Loc::getMessage('CV_SETTINGS_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('CV_SETTINGS_MODULE_DESCRIPTION');

        $this->PARTNER_NAME = Loc::getMessage('CV_SETTINGS_PARTNER_NAME');
        $this->PARTNER_URI = Loc::getMessage('CV_SETTINGS_PARTNER_URI');

        $this->MODULE_SORT = 1;
        $this->SHOW_SUPER_ADMIN_GROUP_RIGHTS = "Y";
        $this->MODULE_GROUP_RIGHTS = "Y";

        $this->MODULE_DIR = dirname(__DIR__);
    }


    public function InstallFiles()
    {
        if (\Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->MODULE_DIR . "/admin/")) {
            CopyDirFiles($this->MODULE_DIR . "/install/admin/", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin");
        }

        // Icons
        CopyDirFiles(
            $this->MODULE_DIR . "/install/themes/.default/icons/" . $this->MODULE_ID,
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/themes/.default/icons/" . $this->MODULE_ID,
        );

        // Styles
        CopyDirFiles(
            $this->MODULE_DIR . "/install/themes/.default",
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/themes/.default",
        );

        return true;
    }

    public function UnInstallFiles()
    {
        if (\Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->MODULE_DIR . "/admin/")) {
            DeleteDirFiles($this->MODULE_DIR . "/install/admin/", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin");
        }

        // Icons
        DeleteDirFiles(
            $this->MODULE_DIR . "/install/themes/.default/icons/" . $this->MODULE_ID,
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/themes/.default/icons/" . $this->MODULE_ID,
        );

        // Styles
        DeleteDirFiles(
            $this->MODULE_DIR . "/install/themes/.default",
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/themes/.default",
        );

        return true;
    }

    public function InstallDB()
    {
        Loader::includeModule($this->MODULE_ID);

        if (!Application::getConnection(\Cv\Settings\SettingsTable::getConnectionName())->IsTableExists(
            \Cv\Settings\SettingsTable::getTableName()
        )) {
            Base::getInstance("\Cv\Settings\SettingsTable")->createDbTable();
        }

        if (!Application::getConnection(\Cv\Settings\ValueTable::getConnectionName())->IsTableExists(
            \Cv\Settings\ValueTable::getTableName()
        )) {
            Base::getInstance("\Cv\Settings\ValueTable")->createDbTable();
        }
    }



    public function UnInstallDB()
    {
        Loader::includeModule($this->MODULE_ID);

        Application::getConnection(\Cv\Settings\SettingsTable::getConnectionName())->queryExecute(
            "DROP TABLE IF EXISTS " . \Cv\Settings\SettingsTable::getTableName()
        );

        Application::getConnection(\Cv\Settings\ValueTable::getConnectionName())->queryExecute(
            "DROP TABLE IF EXISTS " . \Cv\Settings\ValueTable::getTableName()
        );

        Option::delete($this->MODULE_ID);
    }

    public function doInstall()
    {
        global $APPLICATION;
        ModuleManager::registerModule($this->MODULE_ID);

        $this->InstallDB();
        $this->InstallEvents();
        $this->InstallFiles();
        $APPLICATION->IncludeAdminFile(Loc::getMessage("CV_SETTINGS_INSTALL_TITLE"), $this->MODULE_DIR . "/install/step.php");
    }

    function UnInstallEvents()
    {
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler("main", 'OnPageStart', $this->MODULE_ID, '\Cv\Settings\EventHandler', 'OnPageStart');
    }

    function InstallEvents()
    {
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler("main", 'OnPageStart', $this->MODULE_ID, 'Cv\Settings\EventHandler', 'OnPageStart');
    }

    public function doUninstall()
    {
        global $APPLICATION;

        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();

        if ($request["step"] < 2) {
            $APPLICATION->IncludeAdminFile(Loc::getMessage("CV_SETTINGS_UNINSTALL_TITLE"), $this->MODULE_DIR . "/install/unstep1.php");
        } elseif ($request["step"] == 2) {
            $this->UnInstallFiles();
            $this->UnInstallEvents();

            if ($request["savedata"] != "Y")
                $this->UnInstallDB();

            \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);
            $APPLICATION->IncludeAdminFile(Loc::getMessage("CV_SETTINGS_UNINSTALL_TITLE"), $this->MODULE_DIR . "/install/unstep2.php");
        }
    }
}