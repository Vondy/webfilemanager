<?php
/**
 * Diverse Steuerparameter für den WebFileManager
 *
 * PHP version 5
 *
 * @name       Datei: wfm_settings.php
 * @author     Ralf von der Mark <ralf@website-vdm.de>, www.WebSite-vdM.de
 * @copyright  2017, Ralf von der Mark
 * @version    08.04.2017
 */

/** Ab dieser Groesse werden die Bilder nicht mehr in die Seite geladen.
 * Bei Volumen-Tarifen sollten Sie diesen Wert kleiner einstellen, lokal größer. */
define('IMG_BYTE_ON_SITE', 1048576);/* 1048576 = 1MB */

/** ab ??? Zeilen "nach Oben"-Button einblenden! */
define('TREFFER_ANZ_NACHOBEN', 20);

/** Anzahl der erlaubten Login-Fehlversuche */
$anz_falsches_pw = 3;

/** Name der generierten ZIP-Datei: */
define('ZIP_NAME', '_wfm.zip');