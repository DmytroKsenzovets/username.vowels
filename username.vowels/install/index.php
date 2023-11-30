<?

use \Bitrix\Main\EventManager;

Class username_vowels extends CModule {
    var $MODULE_ID = "username.vowels";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;

    function __construct() {
        $arModuleVersion = array();
        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path."/version.php");
        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
            $this->MODULE_VERSION 		= $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE 	= $arModuleVersion["VERSION_DATE"];
        }
        $this->MODULE_NAME          = GetMessage("INSTALL_MOD_NAME");
        $this->MODULE_DESCRIPTION   = GetMessage("INSTALL_MOD_DESC");
        $this->PARTNER_NAME         = GetMessage("INSTALL_SPER_PARTNER");
        $this->PARTNER_URI          = GetMessage("INSTALL_PARTNER_URI");
    }

    function InstallFiles() {
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/" . $this->MODULE_ID . "/install/.settings.php"
            , $_SERVER["DOCUMENT_ROOT"]."/local/modules/" . $this->MODULE_ID . "/.settings.php");
        return true;
    }

    function UnInstallFiles() {
        DeleteDirFilesEx("/local/modules/" . $this->MODULE_ID . "/.settings.php");
        return true;
    }

    function InstallEvents() {
        EventManager::getInstance()->registerEventHandler(
            'rest',
            'OnRestServiceBuildDescription',
            $this->MODULE_ID,
            '\Username\Vowels\Rest\UserNameVowels',
            'OnRestServiceBuildDescription'
        );
    }

    function DoInstall() {
        global $DOCUMENT_ROOT, $APPLICATION;
        $this->InstallFiles();
        $this->InstallEvents();
        RegisterModule($this->MODULE_ID);

        $APPLICATION->IncludeAdminFile(GetMessage("INSTALL_INSTALL_MOD") . $this->MODULE_ID, $DOCUMENT_ROOT . "/local/modules/" . $this->MODULE_ID . "/install/step.php");
    }

    function DoUninstall() {
        global $DOCUMENT_ROOT, $APPLICATION;
        $this->UnInstallFiles();
        UnRegisterModule($this->MODULE_ID);

        $APPLICATION->IncludeAdminFile(GetMessage("INSTALL_UNINSTALL_MOD") . $this->MODULE_ID, $DOCUMENT_ROOT."/local/modules/" . $this->MODULE_ID . "/install/unstep.php");
    }
}
