<?if(!check_bitrix_sessid()) return;?>
<?
    echo CAdminMessage::ShowNote(GetMessage("INSTALL_UNINSTALLED"));
?>
<form action="<?echo $APPLICATION->GetCurPage()?>">
    <input type="hidden" name="lang" value="<?echo LANG?>">
    <input type="submit" name="" value="<?echo GetMessage("MOD_BACK")?>">
<form>
