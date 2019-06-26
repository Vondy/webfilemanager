<?php
/** ------------------------------------------------------------------|
 *   Applikation: WebFileManager - WFM (Version 6.3.6 vom 22.06.2019) |
 * -------------------------------------------------------------------|
 *    Programmiert von Ralf von der Mark, (c) 2006 - 2019             |
 *     Ein Service des Teams der www.Website-vdM.de                   |
 * ___________________________________________________________________|
 *                                                                    |
 * @author     Ralf von der Mark <ralf@website-vdm.de>                |
 * @copyright  (c) 2019, Ralf von der Mark, Germany, WebSite-vdM.de   |
 *                                                                    |
 * This program is free software;                                     |
 * you can redistribute it and/or modify it under the terms of the GNU|
 * General Public License as published by the Free Software Foundation;
 * either version 3 of the License, or (at your option) any later version.
 *                                                                    |
 * This program is distributed in the hope that it will be useful, but|
 *   WITHOUT ANY WARRANTY;                                            |
 * without even the implied warranty of MERCHANTABILITY or            |
 *   FITNESS FOR A PARTICULAR PURPOSE.                                |
 * See the GNU General Public License for more details.               |
 *   You should have received a copy of the GNU General Public License|
 *   along with this program;                                         |
 * if not, see <http://www.gnu.org/licenses/>.                        |
 * __________________________________________________________________*/

/** WICHTIG: Wenn Sie die Datei inkludieren, müssen Sie den Namen der
 *          aufrufenden Datei in die Konstante "AUFRUF_VOM_WOANDERS"
 *          schreiben (ehem. "$eigen_aufruf")|
 *  Z. B.: define('AUFRUF_VOM_WOANDERS', 'aufrufende_seite.php'); */


/* ##################################################################
 * Ab hier besser nichts mehr veraendern! Seien Sie vorsichtig!  ####
 * ############################################################### */
define('WO_LIEGT_WFM', wo_liegt_wfm());
/** @var Beschreibbares Verzeichnis, in dem auch die Tools liegen müssen! */
define('SPEICHER_FUER_WFM', WO_LIEGT_WFM);
define('VERSION', '6.3.6');
define('VERS_DATE', '22.06.2019');
define('USER_DATEI', 'wfm_all_user.php');
define('SETTINGS_DATEI', 'wfm_settings.php');
/** Temp-Speicher der Window-Laufwerke */
define('WIN_TEMP_LW', 'wfm_win_lw_tmp.php');
require_once USER_DATEI;
require_once SETTINGS_DATEI;

/* START: Sprach-Konstanten (Sprachdatei laden...) */
require_once SPEICHER_FUER_WFM.'wfm_language.php';
define('SPRACH_NAME', base64_encode(AAA_SPRACHE));
/*ENDE: Sprach-Konstanten/Steuerung */

session_start();
if (!empty($_GET['dev'])) {
    $_SESSION['wfm']['devMode'] = ($_GET['dev'] == 1 ? 1 : NULL);
}
if (!empty($_SESSION['wfm']['devMode'])) {
    ini_set('display_errors', 'On'); ini_set('error_reporting', -1); error_reporting(-1);
    define('DEV_MODE', 1);
} else {
    ini_set('display_errors', 'Off'); ini_set('error_reporting', 0); error_reporting(0);
}
if (is_file(WO_LIEGT_WFM.'wfm_stoppuhr.php')) {
    include_once WO_LIEGT_WFM.'wfm_stoppuhr.php';
    $wfm_stoppuhr = new WFM_vdM_Stoppuhr();
}
/** START: das muss als erstes stehen! ########## */
function saeubereWerte(&$wert) {
    $wert = strip_tags(trim($wert));
}

if (!empty($_GET) && is_array($_GET)) {
    array_walk($_GET, 'saeubereWerte');
}/* saeubert alle GET-Werte! */

define('WFM_LOGO_120x20', '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');

define('KAFFEE_AUSGEBN_203x17',
       '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');

define('FAVICON_ICO_16x16',
       'R0lGODlhEAAQAPcAAAAAAP///7CvsLKytbGxs97e37m5ugA6twA5tgA3tQA2tAA4tAA4sxZKuRlMugA9uwA+uwA+ugA/ugA9uAA8tgA+tgA6tAFAuQtEt1h/zPf4+vb3+cnKzMTFxwBAugBBugBCugBDugBEugxJug5LuhJMuiJZuCNauSxhwypeuDRnxTdmuDlnuER1ylF+zEpxt0pyt01zt1qCzGOJz2SJz1l5s11+t118s2B/tmaDtoel2ZSq0K7B45iitObr9ABGugBHuh1Wtx9ZuCRcuSVcuSpfuElyt051t1+AtmGCtmODtm+QyGiFtoCf0Imn2ZWw3XqQtJq14H6Ss5+34JaqyrTH5rXI5pOiurrL6JSgtODn8uHo8+Pp8+jt9ZCkw6nA4+Lp8+zw9vn7/vj6/fHz9u/x9Onu9Oft9Pj7/vn7/fj6/Pf5+/b4+vX3+fP19/L09uzu8ODi5NTW2M/R0/f4+ePk5dDR0sjJysTFxru8ve7z9/D09/f6/PP2+O/y9Pr8/fX3+PDy8+Di4+ns7fj6+uvt7bGzs/r7++vs7L6/v7y9vbm6urKzs62urvv8+7O0s/v79////P///f7+/P///rq6ubOzsq+vrq6urePh27y4sMjEvMK+try5s7q3seDd1/Py8Lu3sLm1rry4scC7s7u2rru4s8S9s8a+s7u2r7q1rrm2s7e1s7q5uLa0tLKxsfv7+7W1tbOzs7KysrGxsbCwsP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAALYALAAAAAAQABAAAAj/AMNsibShzZo0YsSkWdOmTSQwXbA0+ELpTxlBcuTE8fOHkhUHPAjNWPDkUysBly4JqJQpigUZGg4BUpGghidWsmSx8nQDAYo9jhxSqSDhhatVq1jFkEBhB6U2aeq8MgFCwgoChlhEABFkQCE1au6UOuIBiIcURcp6MCLKDho3eTQpKQsEBAggZpOk6rDmzaJRSOjixetBLx6GiULB+CACxI8fIER8MKLqjpo0di4NeXCCSQgPNohAENKowEJQVy6MyIIqB45TPUhM8AKJDRtJLhRAISXLVKdHpKQwaDGJjqQqB5ZwukTL0qxamDY1UTBF0pkSGSgh4mCAUSxFcwJRFqKBQYsPHWZg8RlDZhCcPgsP6XHCJSAAOw==');

$zeichensatz_array = iconv_get_encoding();/*Zeichensatz-Konvertierung */
if (!empty($zeichensatz_array['internal_encoding'])) {
    $akt_charset = $zeichensatz_array['internal_encoding'];
} else {
    $akt_charset = 'UTF-8';/*laeuft meist problemlos, sonst ISO-8859-1 */
}
if (!empty($_GET['encode'])) {
    /* feste Kodierung des WFM steuern (Zukunftsmusik) */
    if ($_GET['encode'] == 'reset') {
        unset($_SESSION['wfm']['encode']);
    } else {
        $_SESSION['wfm']['encode'] = $_GET['encode'];
        define('CODIERG', $_GET['encode']);
    }
} elseif (!empty($_SESSION['wfm']['encode'])) {
    define('CODIERG', $_SESSION['wfm']['encode']);
}
if (empty($_SESSION['wfm']['encode'])) {
    define('CODIERG', $akt_charset);
}
if (!empty($_GET['imgFile'])) {
    define('IMGFILE_GET', $_GET['imgFile']);
}
if (!empty($_GET['attachment'])) {
    define('ATTACHMT', $_GET['attachment']);
}
if (!empty($regelung_download)) {
    if (!empty($_GET)) {
        $arr_variablen = $_GET;
    } else {
        $arr_variablen = all_users();
    }
    download_regel_anz(VERSION, $arr_variablen, $_POST); exit();
} elseif (!empty($_GET['version'])) {
    echo VERSION.'</body></html>'; exit();
} elseif (!empty($_GET['imgDisply']) && defined($_GET['imgFile'])) {
    /* Image-Header erzeugen fuer die Bilder aus BASE64 */
    header('Content-Type: image/'.strtolower(trim($_GET['imgFile'].'.'.$_GET['imgDisply'])));
    echo base64_decode(constant($_GET['imgFile'])); exit();
} elseif (!empty($_GET['imgDisply']) && defined('IMGFILE_GET')) {
    header_setzen($_GET);/* Image-Header erzeugen */
    readfile(IMGFILE_GET); exit();
} elseif (!empty($_GET['application'])) {
    /* Applikation-Header erzeugen */
    header_setzen($_GET);
    readfile($_GET['application']); exit();
} elseif (defined('ATTACHMT')) {
    /*/ Anhang-Header erzeugen */
    header_setzen($_GET);
    readfile(ATTACHMT); exit();
} elseif (!empty($_POST['code'])) {
    $code = trim($_POST['code']);
    if (!empty($code)) {
        header_setzen(array('attachment' => 'docode.wfm'));
        echo base64_decode($code); exit();
    }
}
header_setzen();
if (!function_exists('lcfirst')) {
    /** lcfirst gibt es erst ab PHP-5.3 */
    function lcfirst($f) {
        $f[0] = strtolower($f[0]); return $f;
    }
}
if (!empty($_GET['quick_submit'])) {
    /* Quick-Links sollen auch ohne JavaScript funktionieren: */
    $arr_quicklink = explode('?', $_GET['quick_links']);
    if (!empty($arr_quicklink[1])) {
        $arr_quickl_2 = explode('=', $arr_quicklink[1]);
        $_GET[$arr_quickl_2[0]] = $arr_quickl_2[1];
    }
}
if (!empty($_REQUEST['abbr'])) {
    /* immer wenn ein Array geleert werden soll, einfach Liste erweitern */
    $_SESSION['wfm']['search'] = array();
    $_SESSION['wfm']['such_res'] = array();
    $_SESSION['wfm']['rename'] = array();
    $_SESSION['wfm']['accss'] = NULL;
}
$GLOBALS['meldSlg'] = NULL;/* Sammelt die Meldg ueber Tabelle */
/** START: Grundliegende Einstellungen und Variablen */
define('NAME_ANWDG', 'WebFileManager');
define('NAME_ANWD_K', 'WFM');
define('CLR_HINTGR_SELBX_KOPF', '#FFFFDD');/*HintergrFarb der SelectBoxen im Kopf */
define('CLR_HINTGR_ALLG', '#dfdfdf');/*HintergrFarb auf Seite/Tabelle */
define('CLR_FONT_ALLG', '#151515');/*Schriftfarbe */
define('CLR_FONT_2', '#163f64');/*Zweiter Schriftfarbe */
define('CLR_FONT_DEAKTIV', '#b4b4b4');/*Farbe fuer deaktive Schriften */
define('CLR_ERFOLG', '#336600');/*Farbe fuer Erfolgsmeldungen */
define('CLR_FEHLER', '#ff0000');/*Farbe fuer Fehlermeldungen */
define('CLR_HINWS', '#990000');/*Farbe fuer Hinweise */
define('CLR_HINTGR_HINW', '#fafafa');/*Hintergrundfarbe fuer Hinweise */
define('DREI_LEER', '&nbsp;&nbsp;');
define('VIER_LEER_X_2', DREI_LEER.' '.DREI_LEER);
define('DREI_GROESSR', '&gt;&gt;&gt;');
define('DREI_KLEINR', '&lt;&lt;&lt;');
define('LEER', chr(32));/*Space */
define('SEL_OPT_LEER', '<option value="#"></option>'.PHP_EOL);
define('JAHR', date('Y'));
define('AUTR', 'UmFsZiB2b24gZGVyIE1hcms=');/*AUTR=Vm9uZHk= */
define('A_MAIL', 'cmFsZkB3ZWJzaXRlLXZkbS5kZQ===');
define('A_WEB', 'V2ViU2l0ZS12ZE0uZGU=');
define('A_SHOP_WFM', 'aHR0cHM6Ly93d3cuZ29vZ2xlLmNvbQ==');
define('A_W_WFM', 'd2ViZmlsZW1hbmFnZXIuV2ViU2l0ZS12ZE0uZGU==');
define('HELP_URL', 'https://'.base64_decode(A_W_WFM).'/webfilemanager/handbuch.php');
define('LINK_FACEBOOK', 'https://'.base64_decode(A_W_WFM).'/fb.php?a='.urlencode(base64_encode(VERSION)));

if (!defined('AUFRUF_VOM_WOANDERS')) {
    define('SELF_NAME', dateiNameFiltrn($_SERVER['PHP_SELF']));
} else {
    define('SELF_NAME', AUFRUF_VOM_WOANDERS);
    echo txtMarkg(L_ACHTG.HINWS_FEHLR_INKLUDR, 'hinweis2', null, 'h1').'<hr>';
}

if (!empty($_GET['create']) && $_GET['create'] == 'file') {
    $neuName = createFile();
    if (file_exists($neuName)) {
        header('location: '.SELF_NAME.'?rename='.urlencode($neuName));
    } else {
        $meldg = 'Datei konnte nicht erstellt werden!';
    }
}
if (defined('DEV_MODE')) {
    $devModeTxt = L_DEV_MODE_AUS;
} else {
    $devModeTxt = L_DEV_MODE_AN;
}
define('SCHREIBWEISE', NAME_ANWD_K);/*1.Zeile in Favo-Speicher */

if (!empty($_GET['umbenennen']) && $_GET['umbenennen'] == 'end') {
    $_SESSION['wfm']['rename'] = array();
} elseif (!empty($_GET['aus_arr'])) {
    unset($_SESSION['wfm']['rename']['files'][$_GET['aus_arr']]);
    $div_meldungen = DATEI_ENTF;
}/*wird zum Viele-Dateien-Umbenennen gebraucht */

$lw_box = '';
/*Windows, Mac o. Linux? */
if (strtoupper(substr(PHP_OS, 0, 3) == 'WIN')) {
    if (!empty($_GET['verzns'])) {
        if ($_GET['verzns'] != 'RELOAD') {
            if (strpos($_GET['verzns'], '\\')) {
                /*Windows-Verzeichnispfad replace backslashes */
                header('location: '.SELF_NAME.'?verzns='.urlencode(str_replace('\\', '/', $_GET['verzns'])));
            }
            if (substr($_GET['verzns'], 0, 1) == '/') {
                /*Bei Windows bringt der "/" vorm Laufwerksbuchstaben einen Fehler */
                $_GET['verzns'] = substr($_GET['verzns'], 1);
            }
            $reload = NULL;
        } else {
            define('LW_RELOAD', $_GET['verzns']);
            unset($_GET['verzns']);
        }
    }
    /** Laufwerks-Auswahlbox unter Windows */
    function lw_box($lw)
    {
        $lw_a = strtoupper(substr($lw, 0, 1));
        return '<optgroup label="'.L_LW_WECHSLN.'">'
            .win_lw($lw_a).'</optgroup>';
    }
} elseif (strtoupper(substr(PHP_OS, 0, 3) == 'MAC')) {
    function lw_box($lw) {}
} else {
    function lw_box($lw) {}
    define('OS_SYSTEM', 'unix');
    setSessionFromRequest('rechte', array(), array('anzeigen', 'ausblenden'));
    if (!empty($_SESSION['wfm']['rechte']) && $_SESSION['wfm']['rechte'] == 'anzeigen') {
        define('R_OWNER_SP', 1);/*RechteOwnerGroup-Spalte einblenden! */
        define('R_OWNER_WFM', '<span style="font-size:1em;color:'.CLR_HINTGR_HINW.';background-color:'.CLR_HINWS.';" title="PHP: get_current_user()">'
                            .DREI_GROESSR.' '.L_OWNER_WFM.': "'.get_current_user().'"</span>'.PHP_EOL);
    }
}/*Betriebssystem checken */
function win_lw($lw)
{
    if (!defined('LW_RELOAD') && file_exists(WIN_TEMP_LW) && empty($_SESSION['wfm']['lwerke'])) {
        include_once WIN_TEMP_LW;
        $samlg = $_SESSION['wfm']['lwerke'];
    } elseif ((defined('LW_RELOAD')) || empty($_SESSION['wfm']['lwerke'])) {
        $fuerTemp = phpDateiKopf(WIN_TEMP_LW, 'Temp-Speicher fuer die eingelesenen Laufwerke unter Windows')
            .'$_SESSION[\'wfm\'][\'lwerke\'] = array('.PHP_EOL;
        for($loop = 65; $loop <= 90; $loop++) {
            $lw = chr($loop); $a = '';
            if (is_readable($lw.':')) {
                $samlg[$loop] = chr($loop);
                $fuerTemp .= '    '.$loop.' => "'.chr($loop).'",'.PHP_EOL;
            }
        }
        $_SESSION['wfm']['lwerke'] = $samlg;
        datei_schreiben(WIN_TEMP_LW, $fuerTemp.PHP_EOL.');');
    } else {
        $samlg = $_SESSION['wfm']['lwerke'];
    }
    $opt = '';
    foreach ($samlg as $val) {
        $opt .= selBox_opt(($val != $lw ? $val.':/' : '#'), $val.':/ ...', 0).PHP_EOL;
    }
    $opt .= selBox_opt('RELOAD', L_LW_READ_NEW, 0, ' style="font-weight: bold;"').PHP_EOL.selBox_opt('#', NULL);
    return $opt;
}/*function win_lw() */
function verzLesOderBrowsbar($getName, $getWert)
{
    if (!is_dir($getWert)) {
        $meldg = txtMarkg(L_ORDNR_NOT_FOUND.': "'.text_kuerzen($getWert, 66, ' . . . ', 'vorne', 1).'"');
        $wert = $_SESSION['wfm']['v_pfad'];
    } else {
        if (!empty($_SESSION['wfm']['v_pfad']) && !is_readable($getWert)) {
            $meldg = txtMarkg(L_ORDNR_NOT_READBL.': "'.text_kuerzen($getWert, 66, ' . . . ', 'vorne', 1)
                              .'"<br>'.L_KEINE_RECHTE.'');
            $wert = (!empty($_SESSION['wfm']['v_pfad']) ? $_SESSION['wfm']['v_pfad'] : WO_LIEGT_WFM);
        } else {
            $meldg = NULL;
            $wert = $getWert;
            if (!defined('MELDG_AKTION')) {
                define('MELDG_AKTION', L_ORDNER.': *'.substr(strrchr($wert, '/'), 1).'*');
            }
        }
    }
    $_GET[$getName] = $wert;
    return array($meldg, $wert);
}/*function verzLesOderBrowsbar() */
if (!empty($_GET['verzns'])) {
    $rueckg = verzLesOderBrowsbar('verzns', $_GET['verzns']);
    $_GET['verzns'] = $rueckg[1]; $meldg = $rueckg[0];
} elseif (!empty($_GET['favos']) && substr($_GET['favos'], 0, 3) == 'wfm' && $vor = substr($_GET['favos'], 0, 4)) {
    $rueckg = verzLesOderBrowsbar('favos', substr($_GET['favos'], 4));
    $_GET['favos'] = $vor.$rueckg[1]; $meldg = $rueckg[0];
}
/*Falls das Favoriten-Tool gibt, dann setzen! */
if (!isset($_SESSION['wfm']['favo_tool'])) {
    $_SESSION['wfm']['favo_tool'] = (file_exists($favo_tool = SPEICHER_FUER_WFM.'wfm_favorits_tool.php') ? $favo_tool : FALSE);
}
/*Falls das htaccess-Tool gibt, dann setzen! */
if (!isset($_SESSION['wfm']['accss_tool'])) {
    $_SESSION['wfm']['accss_tool'] = (file_exists($accss_tool = SPEICHER_FUER_WFM.'wfm_htaccess_tool.php') ? $accss_tool : FALSE);
}
/** Array '$img' (Beispiel: $img['name']['src']) */
function getIcon($name = 'space'){
    $img = array(
        'anker' => array(
            /* ehem. '_vdM_wfm_favo_set.png' */ 'alt' => L_FAVO_SETZN,
            'unicode' => array('size' => '1.2', 'number' => '11088')/*gelber Stern*/
        ),
        'anker_vorh' => array(
            /* ehem. '_vdM_wfm_favo_ok.png' */ 'alt' => L_FAVO_AKTUELL,
            'unicode' => array('size' => '1.2', 'number' => '128150')/*Herz*/
        ),
        'copy' => array(
            /* ehem. '_vdM_wfm_copy.png' */ 'alt' => L_KOPIERN,
            'unicode' => array('size' => '1.4', 'number' => '128471')/*sw*/
        ),
        'cut' => array(
            /* ehem. '_vdM_wfm_cut.png' */ 'alt' => L_AUSSCHNDN,
            'unicode' => array('size' => '1.4', 'number' => '9984')/*sw (9986)*/
        ),
        'del_warning' => array(
            /* ehem. '_vdM_wfm_del_warning.png' */ 'alt' => LOESCH_VORSICHTG,
            'unicode' => array('size' => '1.1', 'number' => '11093')
        ),
        'delete' => array(
            /* ehem. '_vdM_wfm_delete.png' */ 'alt' => L_LOESCHN,
            'unicode' => array('size' => '1.1', 'number' => '10060')
        ),
        'entZippn' => array(
            /* ehem. '_vdM_wfm_entZippn.png' */ 'alt' => ZIP_ENTPCKN_HIER,
            'unicode' => array('size' => '1.2', 'number' => '128218')/*Buchstapel*/
        ),
        'vulcanSpock' => array(
            /* ehem. '_vdM_wfm_vulcanSpock.png' */ 'alt' => ZIP_ENTPCKN_HIER,
            'unicode' => array('size' => '1.3', 'number' => '128406')/*Hand Vulkanier-Gruß*/
        ),
        'download' => array(
            /* ehem. '_vdM_wfm_download.png' */ 'alt' => L_DOWNLD,
            'unicode' => array('size' => '1.3', 'number' => '128229')
        ),
        'edit' => array(
            /* ehem. '_vdM_wfm_edit_object.png' */ 'alt' => L_BEARBTN,
            'unicode' => array('size' => '1.1', 'number' => '128221')
        ),
        'home' => array(
            /* ehem. '_vdM_wfm_home.png' */ 'alt' => L_ORDNR_FAVO_HOME,
            'unicode' => array('size' => '1.3', 'number' => '127968')
        ),
        'home_now' => array(
            /* ehem. '_vdM_wfm_home_now.png' */ 'alt' => L_ORDNR_FAVO_HOME,
            'unicode' => array('size' => '1.4', 'number' => '127937')
        ),
        'folder_new' => array(
            /* ehem. '_vdM_wfm_newfolder.png' */ 'alt' => L_ORDNR_NEU,
            'unicode' => array('size' => '1.5', 'number' => '128193')
        ),
        'kopf_fest' => array(
            /* ehem. '_vdM_wfm_nadel_fest.png' */ 'alt' => L_KOPF_LOESN,
            'unicode' => array('size' => '1.5', 'number' => '128205')
        ),
        'kopf_los' => array(
            /* ehem. '_vdM_wfm_nadel_los.png' */ 'alt' => L_KOPF_FIX,
            'unicode' => array('size' => '1.4', 'number' => '128204')/*besseres suchen 128879*/
        ),
        'folder_open' => array(
            /* ehem. '_vdM_wfm_open_folder.png' */ 'alt' => L_ORDNR_OEFFN,
            'unicode' => array('size' => '1.4', 'number' => '128194')
        ),
        'help' => array(
            /* ehem. '_vdM_wfm_help.png' */ 'alt' => HILFE_BUCH,
            'unicode' => array('size' => '1.5', 'number' => '128366')/*sw*/
        ),
        'insert' => array(
            /* ehem. '_vdM_wfm_insert.png' */ 'alt' => L_EINFUEGN,
            'unicode' => array('size' => '1.5', 'number' => '128165')
        ),
        'on_top' => array(
            /* ehem. '_vdM_wfm_up.png' */ 'alt' => L_ORDNR_BACK,
            'unicode' => array('size' => '1.5', 'number' => '11181')/*11192, 9167, 11245*/
        ),
        'rename' => array(
            /* ehem. '_vdM_wfm_rename.png' */ 'alt' => L_UMBENENN,
            'unicode' => array('size' => '1.3', 'number' => '128278')/*128296*/
        ),
        'save' => array(
            /* ehem. '_vdM_wfm_save.png' */ 'alt' => HTACCESS_SCHUTZ,
            'unicode' => array('size' => '1.5', 'number' => '128272')/*sicherheitsschloss*/
        ),
        'sort_down_norm' => array(
            /* ehem. '_vdM_wfm_sort_down.png' */ 'alt' => L_SORT_ABWAERTS,
            'unicode' => array('size' => '1.1', 'number' => '11206')/*sw*/
        ),
        'sort_down_red' => array(
            /* ehem. '_vdM_wfm_sort_down_red.png' */ 'alt' => L_SORT_IS_ABWAERTS,
            'unicode' => array('size' => '1.1', 'number' => '128315')/*129155(sw)*/
        ),
        'sort_up_norm' => array(
            /* ehem. '_vdM_wfm_sort_up.png' */ 'alt' => L_SORT_AUFWAERTS,
            'unicode' => array('size' => '1.1', 'number' => '11205')/*sw*/
        ),
        'sort_up_red' => array(
            /* ehem. '_vdM_wfm_sort_up_red.png' */ 'alt' => L_SORT_IS_AUFWAERTS,
            'unicode' => array('size' => '1.1', 'number' => '128314')/*129145(sw)*/
        ),
        'space' => array(
            /* ehem. '_vdM_wfm_spacer.png' */ 'alt' => ' --- ',
            'unicode' => array('size' => '1.5', 'number' => '10276')/*128936*/
        )
    );
    return $img[$name];
}/*function getIcon() */
/* ENDE: Grundliegende Einstellungen und Variablen */
define('RAND', rand(11, 99));/*Zufaelliger Parameter um den BrowserCache zu umgehen. */
define('SELF_LINK', SELF_NAME.'?a='.RAND);/*Zufaelliger Parameter um den Cache zu umgehen. */
define('ABBR_BEGINN', '<a href="'.SELF_LINK.'" title="'.L_ABBRECHN.'">'.DREI_KLEINR.' '.L_ABBRECHN.'</a>');
define('ABBR_ZURUECKSETZEN', '<a href="'.SELF_LINK.'&abbr=1" title="'.L_BEGINN_NEU.'">'.DREI_KLEINR.' '.L_ABBRECHN.'</a>');
define('UPDATE_LINK_AUFRUF', 'https://'.base64_decode(A_W_WFM).'/webfilemanager/index.php?version='.urlencode(VERSION).'&amp;my_vers='.urlencode(VERSION).'&lang='.AAA_SPRACH_KUERZL.'');
if (!defined('AUFRUF_VOM_WOANDERS')) {
    //Das Logo aus der Konstante als base64-Codiertes Bild "WFM_LOGO_120x20" wiedergeben...
    define('VDM_WFM_LOGO',
           '<img src="'.SELF_LINK.'&amp;imgFile=WFM_LOGO_120x20&amp;imgDisply=PNG" border="0"'
           .' alt="'.NAME_ANWD_K.'-Logo (WFM v. '.VERSION.')" width="120" height="20">');
} else {
    //Wenn WFM inkludiert wird, kann der Image-Header nicht gesendet werden.
    define('VDM_WFM_LOGO',
           '<strong style="font-size: 1.3em">'.NAME_ANWD_K.' (v. '.VERSION.')</strong>');
}/* ENDE: else ==> if ($defined('AUFRUF_VOM_WOANDERS'))*/

/** RENAME -- Umbenennen einer Datei oder eines Verzeichnises */
function umbenennen() {
    if($_POST['old_name'] != $_POST['new_name']){
        $datei_benennen = @fopen($_SESSION['wfm']['v_pfad'].'/'.$_POST['old_name'], 'r');
        @fclose($datei_benennen);/*Ohne diese Zeile kommt: 'Permission Denied!' */
        if(@rename($_SESSION['wfm']['v_pfad'].'/'.$_POST['old_name'],
                   $_SESSION['wfm']['v_pfad'].'/'.$_POST['new_name'])
        ){
            return txtMarkg(L_UMBENENN_OK.': "'.$_POST['old_name'].'" '.DREI_GROESSR.' "'.$_POST['new_name'].'"', 'hinweis2');
        } else{
            return txtMarkg(ERR_ERROR.'"'.$_POST['old_name'].'" '.UMBENN_ERROR, 'fehler');
        }
    } else{
        return txtMarkg(L_HINWS.L_KEIN_NEU_NAME, 'hinweis2').'<hr>';
    }
}
if (!empty($_POST['rename']) && !empty($_POST['old_name']) && !empty($_POST['new_name'])) {
    $GLOBALS['meldSlg'] = umbenennen();
}/*END: RENAME -- Umbenennen einer Datei oder eines Verzeichnises */
if (!empty($_SESSION['wfm']['accss_tool']) && $_SESSION['wfm']['accss_tool'] != '0') {
    function acc_link($wie = 'gif', $verz = FALSE) {
        return '<a href="'.SELF_LINK.'&amp;accss='.urlencode($_SESSION['wfm']['v_pfad'].'/'.$verz).'" '
            .'title="'.HTACCESS_SCHUTZ.'" class="img_link">'.(!empty($wie) || $wie == 'gif' ? icon_anz('save') : $wie).'</a>';
    }
} else {
    function acc_link() { /* NIX */ }
}
/** function favo_datei() Name der Favoriten-Datei */
function favo_datei($user_wert=FALSE) {
    if (!empty($user_wert)) {
        return SPEICHER_FUER_WFM.'wfm_favorits_'.$user_wert.'.txt';
    } elseif (!empty($_SESSION['wfm']['user_key'])) {
        return SPEICHER_FUER_WFM.'wfm_favorits_'.$_SESSION['wfm']['user_key'].'.txt';
    } else {
        return SPEICHER_FUER_WFM.'wfm_favorits_USER_UNKNOW.txt';
    }
}/*function favo_datei() */

/** Universeller Formular-Kopf */
function form_kopf($formname=FALSE, $form_id=FALSE, $enctype=FALSE, $plus_action=FALSE, $method='post', $zusaetzl=NULL)
{
    $werte = '';
    if (!empty($formname)){ $werte .= ' name="'.$formname.'"'; }
    if (!empty($form_id)) { $werte .= ' id="'.$form_id.'"'; }
    if (!empty($enctype)) { $werte .= ' enctype="multipart/form-data"'; }
    return '<form action="'.SELF_NAME.$plus_action.'"'.$werte.' method="'.$method.'" accept-charset="'.CODIERG.'"'.$zusaetzl.'>';
}/*function form_kopf() */
function such_form()
{
    $chked = ' checked="checked" ';
    if (!empty($_POST['suchwert'])) {
        $val = $_POST;
        $_SESSION['wfm']['search'] = $val;
        $suchwert = $_SESSION['wfm']['search']['suchwert']; $default = '';
        suchFile($_SESSION['wfm']['v_pfad'], $_SESSION['wfm']['search']);
        $ergebn = suchResult();
    } elseif (!empty($_SESSION['wfm']['search']) && is_array($_SESSION['wfm']['search'])) {
        $val = $_SESSION['wfm']['search'];
        $suchwert = $_SESSION['wfm']['search']['suchwert']; $default = '';
        suchFile($_SESSION['wfm']['v_pfad'], $_SESSION['wfm']['search']);
        $ergebn = suchResult();
    } else {
        $suchwert = ''; $default = $chked;
        if (!empty($_SESSION['wfm']['such_res'])) {
            $ergebn = suchResult();
        } else {
            $ergebn = '';
        }
    }
    return form_kopf('suche').'<h3>'.SUCHE_DATEIN_U_ORDNR.'
        <br>"'.$_SESSION['wfm']['v_pfad'].'/"</h3>
        <input type="text" autofocus name="suchwert" value="'.$suchwert.'" placeholder="'.SUCHE_NACH.'..." required>
        <input type="submit" name="submit_search" value="'.L_SUCHN.'">
        <span class="bemerkg">'.DREI_LEER.'
        <input type="checkbox" id="l_datei" name="suchdatei" value="1"'
        .(!empty($val['suchdatei']) ? $chked : $default).'>
        <label for="l_datei">'.DATEI_NAMEN.'</label>'.VIER_LEER_X_2.'
        <input type="checkbox" id="l_verz" name="suchverz" value="1"'
        .(!empty($val['suchverz']) ? $chked : $default).'>
        <label for="l_verz">'.L_ORDNR_NAME.'</label>'.VIER_LEER_X_2.'
        <input type="checkbox" id="l_unterverz" name="unterverz" value="1"'
        .(!empty($val['unterverz']) ? $chked : '').'>
        <label for="l_unterverz">'.L_ORDNR_UNTER_MIT.'</label>'.VIER_LEER_X_2.'
        <input type="checkbox" id="l_case" name="case" value="1"'
        .(!empty($val['case']) ? $chked : '').'>
        <label for="l_case">'.CASE_SENSITIVE.'</label></span></form>'.$ergebn;
}/*function such_form() */
function suchFile($v_pfad = '.', $arr_val = array(), $strg = 0)
{
    if ($strg == 0) { $_SESSION['wfm']['such_res'] = array(); }/*Variable (neu)starten */
    $verzeichn = opendir($v_pfad);
    if ($verzeichn) {
        while (FALSE !== ($eineDatei = readdir($verzeichn))) {
            if ($eineDatei != '.' && $eineDatei != '..') {
                $fund = NULL;
                if (empty($arr_val['case'])) {
                    $fund = stristr($eineDatei, $arr_val['suchwert']);
                } else {
                    $fund = strstr($eineDatei, $arr_val['suchwert']);
                }
                $verz_name = $v_pfad.'/'.$eineDatei;
                if (is_dir($verz_name) && !empty($arr_val['suchverz']) && !empty($fund)) {
                    $_SESSION['wfm']['such_res']['a'.$verz_name] = $eineDatei;
                } elseif (is_file($verz_name) && !empty($arr_val['suchdatei']) && !empty($fund)) {
                    $_SESSION['wfm']['such_res']['b'.$verz_name] = $eineDatei;
                }
                if (is_dir($verz_name) && !empty($arr_val['unterverz'])) {
                    $_SESSION['wfm']['such_res'] = suchFile($verz_name, $arr_val, 1);
                }
            }/*if ($eineDatei != "." &... */
        }/*while (FALSE !== ($eine_date... */
    }/*if ($verzeichn) */
    closedir($verzeichn);
    if ($strg == 1) {
        return $_SESSION['wfm']['such_res'];
    }
}/*function suchFile() */
function suchResult()
{
    if (!empty($_SESSION['wfm']['such_res'])) {
        ksort($_SESSION['wfm']['such_res']);
        $verz_sammlg = ''; $typ_zV = 1; $typ_zD = 1;
        foreach ($_SESSION['wfm']['such_res'] as $schluessel => $fund) {
            $name = substr($schluessel, 1);
            if (substr($schluessel, 0, 1) == 'a') {
                $verz_sammlg .= '<li><strong style="color:'.CLR_ERFOLG.'">'.$typ_zV.'. '.L_ORDNER.':</strong>:
                   <a href="'.SELF_LINK.'&amp;verzns='.urlencode($name).'" title="'.WECHSL_HIERHIN.'">'.$name.'</a>
                   </li>'.PHP_EOL; $typ_zV++;
            } else {
                $verz_sammlg .= '<li><strong style="color:'.CLR_HINWS.'">'.$typ_zD.'. '.L_DATEI.': <a href="'.SELF_LINK
                    .'&amp;verzns='.urlencode(str_replace(dateiNameFiltrn($name), '', $name)).'" title="'.WECHSL_HIERHIN.'">'
                    .str_replace(dateiNameFiltrn($name), '', $name).'</a>'
                    .download_link($fund, $name.'"  style="color:'.CLR_HINWS, $fund)
                    .(is_binary(substr(strtolower(strrchr($name, '.')), 1)) == TRUE ?
                        '' : ' <a href="'.SELF_LINK.'&amp;text_file='.urlencode($name).'">('.L_OEFFN.')</a>')
                    .'</strong></li>'.PHP_EOL; $typ_zD++;
            }
        }/* foreach ($array as $schluessel => $$verz_groesse) */
        $verz_sammlg = txtMarkg(count($_SESSION['wfm']['such_res']).' '.L_TREFFR.' ('.($typ_zV-1)
                                .' '.L_ORDNER.' + '.($typ_zD-1).' '.L_DATEIN.') '.ABBR_ZURUECKSETZEN).$verz_sammlg;
    } else {
        $verz_sammlg = txtMarkg(L_TREFFR_NULL);
    }
    return $verz_sammlg.txtMarkg(ABBR_ZURUECKSETZEN);
}/*function suchResult() */
function suche(){
    echo such_form();
}
function rename_save()
{
    if (!empty($_SESSION['wfm']['user_key'])) {
        return SPEICHER_FUER_WFM.'wfm_rename_'.$_SESSION['wfm']['user_key'].'.php';
        /*Name der Rename-Sicherungs-Datei */
    } else {
        return FALSE;
    }
}/*function rename_save() */
if (!empty($_POST['select_action']) && $_POST['select_action'] == 'file_rename'
    && !empty($_POST['pfad']) && !empty($_POST['files'])) {
    foreach ($_POST['files'] as $oneFile) {
        if (!empty($oneFile)) {
            $_SESSION['wfm']['rename']['files'][$_POST['pfad'].'/'.$oneFile] = $_POST['pfad'].'/'.$oneFile;
        }
    }
}
function ren_vorschau()
{
    $arr_dateien = $_SESSION['wfm']['rename']['files'];
    $arr_dateien = renDateiSortg($arr_dateien);
    $loopZ = 1; $count_zaehler = 0; $x = '';
    foreach ($arr_dateien as $key => $one_file) {
        if (!empty($_POST['ren_na_cou_start']) && is_numeric($_POST['ren_na_cou_start'])) {
            $ren_na_cou_start = $_POST['ren_na_cou_start'];
        } else {
            $ren_na_cou_start = 1;
        }
        if (!empty($_POST['ren_na_cou_erhoe']) && is_numeric($_POST['ren_na_cou_erhoe'])) {
            $ren_na_cou_erhoe = $_POST['ren_na_cou_erhoe'];
        } else {
            $ren_na_cou_erhoe = 1;
        }
        $counter = $ren_na_cou_start + $count_zaehler;
        $count_zaehler += $ren_na_cou_erhoe;
        if (!empty($_SESSION['wfm']['rename']['wiederherst'])) {
            $new_name[1] = '==> ';
            $new_name[2] = $one_file;/*Array */
            $rename_save[$one_file] = $key;
            $rename_files[$key] = $one_file;
        } else {
            $new_name = ren_rules_glob($key, $counter);/*Array */
            $rename_save[$new_name[1].$new_name[2]] = $key;
            $rename_files[$key] = $new_name[1].$new_name[2];
        }
        if (!empty($new_name[3])) {
            $hinweis_text = '<strong style="color: #ff0000; background-color: #ffff99">'
                .$new_name[3].'</strong><br>'.PHP_EOL;
        } else {
            $hinweis_text = '';
        }
        $x .= '
        <tr>
          <td style="white-space: nowrap;" title="'.$key.'">'.($loopZ++).'</td>
          <td style="white-space: nowrap;">'.dateiNameFiltrn($key).'</td>
          <td style="white-space: nowrap;">'.$hinweis_text
            .'<small style="color: #5a5a5a">'.$new_name[1].'</small>'
            .'<strong style="color: #990000">'.$new_name[2].'</strong></td>
          <td style="white-space: nowrap;"><a href="'.SELF_LINK.'&amp;aus_arr='.urlencode($key).'">'.UMBENN_NICHT.'!</a></td>
        </tr>';
    }/* foreach () */
    $_SESSION['wfm']['rename']['files'] = $rename_files;
    return $x;
}/*function ren_vorschau() */
function ren_speicher_inhalt($settings = '', $dateisammlg = array())
{
    if (file_exists(rename_save())) {
        require rename_save();
    }
    $dateiName = rename_save();
    $head = phpDateiKopf($dateiName, 'Speicher fuer die Einstellungen des Umbenennens zum "Rueckgaengig-Machen"!');
    $sammler1 = '  ';
    if (is_array($settings)) {
        foreach ($settings as $schl => $eines) {
            if ($schl != 'ren_subm_view') {
                $sammler1 .= PHP_EOL
                    .'        base64_decode(\''.base64_encode($schl).'\') => base64_decode(\''.base64_encode($eines).'\'),';
            }
        }
        $sammler1 = substr($sammler1, 0, -1);
    } elseif (!empty($rename_einstellg) && is_array($rename_einstellg)) {
        foreach ($rename_einstellg as $schl => $eines) {
            if ($schl != 'ren_subm_view') {
                $sammler1 .= PHP_EOL
                    .'        base64_decode(\''.base64_encode($schl).'\') => base64_decode(\''.base64_encode($eines).'\'),';
            }
        }
        $sammler1 = substr($sammler1, 0, -1);
    }
    $sammler1 = PHP_EOL.'$rename_einstellg = array('.trim($sammler1).');'.PHP_EOL.PHP_EOL;
    $sammler2 = '  ';
    if (!empty($dateisammlg) && is_array($dateisammlg)) {
        foreach ($dateisammlg as $schl2 => $eine2) {
            if (!empty($schl2) && !empty($eine2)) {
                $sammler2 .= PHP_EOL
                    .'    base64_decode(\''.base64_encode($eine2).'\') => base64_decode(\''.base64_encode($schl2).'\'),';
            }
        }
        $sammler2 = substr($sammler2, 0, -1);
    }
    $sammler2 = PHP_EOL.'$rename_sicherg = array('.trim($sammler2).');'.PHP_EOL;
    datei_schreiben(rename_save(), $head.$sammler1.$sammler2.PHP_EOL);
}/*function ren_speicher_inhalt() */
function renDateiSortg($arr = array())
{
    if (!empty($arr) && !empty($_POST['ren_sortg'])) {
        if ($_POST['ren_sortg'] == 'Dateiname_n') {
            ksort($arr);
        } elseif ($_POST['ren_sortg'] == 'Dateiname_r') {
            krsort($arr);
        }
    }
    return $arr;
}/*function renDateiSortg() - Sortierung */
function ren_rules_glob($x, $counter)
{
    /*$x: Name mit Pfad */
    $file = dateiNameFiltrn($x);/*nur Name */
    $arr[1] = substr($x, 0, -strlen($file));/*nur Pfad */
    $pos_letzt_punkt = strrpos($file, '.');
    $file_ext = ren_rules_ext(substr($file, $pos_letzt_punkt+1));/*nur Extension */
    $file_name = ren_rules_name(substr($file, 0, $pos_letzt_punkt), $counter);/*nur  Name */
    /*In Dateinamen sind verboten: < > ? " : | \ / * */
    $verbot = array('<', '>', '?', '"', ':', '\\\\', '\/', '|', '*');
    $arr_verb = implode('|', $verbot);
    if (!preg_match('/^[^'.$arr_verb.']{1,}$/mi',  $file_name.$file_ext, $wert)) {
        $arr[2] = $file;
        $arr[3] = L_UNGUELTG_ZEICHN.' ('.str_replace('\\', '', implode(' ', $verbot)).')';
    } else {
        $arr[2] = $file_name.$file_ext;/*$arr[2] = Neuer Name mit Extension ohne Pfad */
    }
    return $arr;
}/*function ren_rules_glob() */
function ren_rules_name($y, $counter)
{
    if (!empty($_POST['ren_name'])) {
        if (isset($_POST['ren_na_del'])) {
            $y = ren_zustz_txt($y);/*bereinigen?? */
        }
        if (isset($_POST['ren_na_ers1']) && !empty($_POST['ren_na_ers2'])) {
            $y = ren_zustz_txt($y);/*bereinigen?? */
        }
        if (isset($_POST['ren_na_case'])) {
            $y = ren_grossklein($y, $_POST['ren_na_case']);
        }
        if (isset($_POST['ren_na_txt'])) {
            $zusatz_txt = ren_zustz_txt($_POST['ren_na_txt']);/*bereinigen?? */
            $y = ren_wohinschreib($y, $zusatz_txt, $_POST['ren_na_repl']);
        }
    }
    if (isset($_POST['ren_na_count'])) {
        $zaehler = ren_zaehler($counter);
        $y = ren_wohinschreib($y, $zaehler, $_POST['ren_na_cou_repl']);
    }/*if (!empty($_POST['ren_name'])) */
    return $y;
}/*function ren_rules() */
function ren_rules_ext($z)
{
    $punkt = '';
    if (!empty($_POST['ren_ext'])) {
        if (!empty($_POST['ren_ex_case'])) {
            $z = ren_grossklein($z, $_POST['ren_ex_case']);
        }
        if (isset($_POST['ren_ex_txt'])) {
            $zusatz_txt = ren_zustz_txt($_POST['ren_ex_txt']);/*bereinigen?? */
            $z = ren_wohinschreib($z, $zusatz_txt, $_POST['ren_ex_repl']);
        }
    }
    if (!empty($z) || $z == '0') $punkt = '.';/*Wenn leer, Punkt auch weg! */
    return $punkt.$z;
}/*function ren_rules_ext() */
function ren_grossklein($wert, $wie = '')
{
    return ($wie == 'klein' ? strtolower($wert) : ($wie == 'gross' ? strtoupper($wert) : $wert));
}/*function ren_grossklein() */
function ren_wohinschreib($wert, $zusatz, $wohin)
{
    if ($wohin == 'anfang') {
        $wert = $zusatz.$wert;
    } elseif ($wohin == 'ende') {
        $wert = $wert.$zusatz;
    } elseif ($wohin == 'replace') {
        $wert = $zusatz;
    } else {
        $wert = '';/*sollte nicht vorkommen */
    }
    return $wert;
}/*function ren_wohinschreib() */
function ren_zustz_txt($wert)
{
    if (isset($_POST['ren_na_del'])) {
        $wert = str_replace($_POST['ren_na_del'], '', $wert);
    }
    if (isset($_POST['ren_na_ers1']) && !empty($_POST['ren_na_ers2'])) {
        $wert = str_replace($_POST['ren_na_ers1'], $_POST['ren_na_ers2'], $wert);
    }
    return $wert;
}/*function ren_zustz_txt() */
function ren_zaehler($counter)
{
    return (empty($_POST['ren_na_cou_start']) || !is_numeric($_POST['ren_na_cou_start']) ?
        '' : ren_vorne_werte_zufg($counter, $_POST['ren_na_cou_stelln']));
}/*function ren_zaehler() */
function ren_vorne_werte_zufg($wert = 1, $stellen = 2, $wert_vorweg = '0')
{
    if (($anzahl_nullen = intval($stellen) - strlen($wert)) <= 0) {
        return $wert;
    } else {
        return str_pad($wert, $stellen, $wert_vorweg, STR_PAD_LEFT);
    }
}/*function vorne_Nullen_ergaenzen() */
function ren_umbn_loop($name_alt, $name_neu) {
    if($name_alt == $name_neu){
        $arr[0] = txtMarkg(L_HINWS.L_WERT_IDENTISCH
                           .'<br>('.$name_alt.')', 'hinweis2', '', 'p');
    } else {
        if (@rename($name_alt, $name_neu)) {
            $arr[0] = txtMarkg(L_UMBENENN_OK.':<br>'.L_NEU.': '.$name_neu
                               .'<br>'.L_ALT.': '.$name_alt, 'erfolge', '', 'p');
            $arr[1] = $name_neu;
            $arr[2] = $name_alt;
        } else {
            $arr[0] = txtMarkg(ERR_ERROR.UMBENN_ERROR
                               .'<br>'.L_ALT.': '.$name_alt, 'fehler', '', 'p');
        }
    }
    return $arr;
}/*function ren_umbn_loop() */
function icon_anz($imgName, $zusatz=FALSE)
{
    if (!empty($_SESSION['wfm']['icons'][$imgName])) {
        return $_SESSION['wfm']['icons'][$imgName];
    } else {
        /* Wenn es die ICON-Definition noch nicht gibt, zusammenbauen...*/
        $icon = getIcon($imgName);
        if (!empty($icon['unicode']['number'])) {
            return $_SESSION['wfm']['icons'][$imgName] = '<span title="'.$icon['alt']
                .'" style="font-size: '.$icon['unicode']['size'].'em; text-decoration: none;" '.$zusatz.'>&#'.$icon['unicode']['number'].';</span>';
        } else {
            return '['.$icon['alt'].']';
        }
    }
}/*function icon_anz() */
function helpLink($sprungmarke=FALSE, $linkTxt=FALSE, $linkTitel=FALSE, $mitIcon=FALSE, $zusaetzl=NULL)
{
    return '<a href="'.HELP_URL.'?lang='.AAA_SPRACH_KUERZL.'&amp;sprungmarke='
        .(!empty($sprungmarke) ? $sprungmarke.'#'.$sprungmarke : 'start_des_handbuchs#start_des_handbuchs')
        .'" target="_blank" title="'.(!empty($linkTitel) ? $linkTitel : NAME_ANWDG.'-'.HILFE_BUCH.'...').' ('.L_HINWS.L_NEU_FENSTER.')"'.$zusaetzl.'>'
        .(!empty($mitIcon) ? icon_anz('help').'&nbsp;' : '').(!empty($linkTxt) ? $linkTxt : L_HILFE.'...').'</a>';
}/*function helpLink() */
function selectbx_act()
{
    return '<select name="select_action" onchange="hinweisen()">'
        .selBox_opt('0', L_AKTION_WAEHLN.'...')
        .'<optgroup label="'.L_MARKIERTE_DATEI.'...">'
        .selBox_opt('file_copy', '... '.L_KOPIERN)
        .selBox_opt('file_move', '... '.L_VRSCHIEBN)
        .selBox_opt('0', ' - - - - - - - - - - - - - - - - - - - - - -')
        .selBox_opt('file_rename', '... '.L_UMBENENN)
        .(class_exists('ZipArchive') || (defined('OS_SYSTEM') && OS_SYSTEM == 'unix') ?
            selBox_opt('0', ' - - - - - - - - - - - - - - - - - - - - - -')
            .selBox_opt('file_zippen', '... '.L_ZIPPN) : '')
        .selBox_opt('0', ' - - - - - - - - - - - - - - - - - - - - - -')
        .selBox_opt('file_loeschen', '... '.L_LOESCHN.' ('.L_VORSICHT.')')
        .selBox_opt('0', ' - - - - - - - - - - - - - - - - - - - - - -')
        .'</optgroup></select>
    <input type="submit" name="los" value="go" onclick="return aktiontesten();">';
}/*function selectbx_act() */
function update_frame()
{
    return '<br><br>'.  txtMarkg(L_CHECK_UPDATES).'
       <br><strong>'.L_VERSION.' '.VERSION.'.</strong><br>
       <strong style="color: '.CLR_ERFOLG.'">'.L_NEUSTE_VERS.':</strong><br>
       <iframe src="'.UPDATE_LINK_AUFRUF.'" width="44" height="33" frameborder="1"
          name="Versionsabgleich" scrolling="no" marginheight="0" marginwidth="0">
      <p>'.L_BROWSR_FRAME.': <a href="'.UPDATE_LINK_AUFRUF.'" target="_blank">'.UPDATE_LINK_AUFRUF.'</a></p></iframe>'
        .'<br><br>'.DREI_GROESSR.'&nbsp;<strong>'.L_DOWNL_NEU_VERS.'</strong><br><br>'
        .DREI_GROESSR.'&nbsp;<a href="'.SELF_LINK.'">'
        .strong('Weiter Arbeiten mit meinem '.NAME_ANWDG.' (Version '.VERSION.')').'</a>
    <br>'.VDM_WFM_LOGO.'</a><br><br><hr>';
}/*function update_frame() */
/** Erzeugt eine 32-Zeichen-ID, die nur sehr schwer vorhersehbar ist. */
function uuid()
{
    return md5(uniqid(rand(), true));
}/*function uuid() */
/** START: Login-Regelung */
if (empty($_SESSION['kntrll']) || empty($_POST['kntrll'])) {
    $user_uuid = uuid();
    $_SESSION['kntrll'] = $user_uuid;
    $_POST['kntrll'] = $user_uuid;
} elseif ($_POST['kntrll'] == $_SESSION['kntrll']) {
    $kontrolleBestanden = 1;/*echo 'Kontrolle bestanden!'; */
} elseif(empty($_SESSION['wfm']['user_now'])) {
    echo '<!DOCTYPE html><html><head>
        <title>'.ERR_BEGINN_NEU.'</title><meta http-equiv="expires" content="0">
        </head><body><h1><a href="'.SELF_LINK.'&amp;">'.LOGIN_GO_TO.'...</a>
         '.L_DANK.'<h1></body></html>'; exit();
}
$log_ok_meldg = '';
if (!empty($_POST['password']) && !empty($_POST['username'])) {
    $login_arry = all_users();/*User-Array laden! */
    $eingegebUsernameVerschluesselt = base64_encode($_POST['username']);
    if (!empty($kontrolleBestanden)
        && array_key_exists($eingegebUsernameVerschluesselt, $login_arry) == TRUE
        && hash('sha512', $_POST['password'], false) == $login_arry[$eingegebUsernameVerschluesselt]) {
        unset($_SESSION['loginversuche']);/*leeren, wenn er das richtigen PW eingibt! */
        $_SESSION['kntrll'] = '';/*Kontrolle zuruecksezten (macht reload unmoeglich!) */
        $_SESSION['wfm']['user_key'] = substr(str_replace('=', '', strtoupper($eingegebUsernameVerschluesselt)), 0, 10);
        $_SESSION['wfm']['user_now'] = $_POST['username'];
        favo_selectbox();/* schreibt das Startverz. */
        $_SESSION['wfm']['v_pfad'] = STANDD_ORT;
        session_regenerate_id();/*erneuert die Session-ID (ausschliesslich) */
        $log_ok_meldg = txtMarkg(L_HALLO.' '.$_SESSION['wfm']['user_now'].', '.L_LOGIN_OK, 'hinweis2');
    } else {
        session_regenerate_id();/*erneuert Session-ID */
        $log_meldg = txtMarkg(L_LOGIN_FALSCH, 'fehler'); $login_falsch = 1;
    }
} elseif (!empty($_GET['logout'])) {
    $log_meldg = txtMarkg(L_LOGOUT_OK, 'hinweis2')
        .'<strong><a href="'.SELF_LINK.'">'.LOGIN_GO_TO.'</a></strong>';
    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', RAND-42000, '/');
    }
    session_destroy();/*gesamte Session sollte jetzt zurueckgesetzt sein! */
    $login_falsch = 1;
} else { $postFelderLeer = 1;
}/*if(empty($_SESSION['wfm']['akt_person'])) */
if (empty($_SESSION['wfm']['user_now'])) {
    if (empty($_SESSION['loginversuche'])) {
        $_SESSION['loginversuche'] = 1; $meldg_login_versuche = '';
    } elseif(empty($postFelderLeer)) {
        $meldg_login_versuche = $_SESSION['loginversuche'].L_LOGIN_F_VERSUCH.'<br>'
            .L_LOGIN_F_GESPERRT.'
           <br>('.L_LOGIN_F_VERS_ANZ.$anz_falsches_pw.')';
        $meldg_login_versuche = txtMarkg($meldg_login_versuche);
        $_SESSION['loginversuche'] += 1;
    }
    if (!empty($_SESSION['loginversuche']) && $_SESSION['loginversuche'] > $anz_falsches_pw+1) {
        /*Wenn X mal das PW falsch eingegeben, dann weg mit dir! */
        header('location: '.base64_decode(A_SHOP_WFM)); exit();
    }
    $form_fuer_login = '<br><br>
        '.form_kopf().'
        <input type="hidden" name="kntrll" value="'.$_POST['kntrll'].'">
        '.USR_NAME.':&nbsp;<input type="text" name="username" autofocus value="" style="width:22em;" class="bemerkg" placeholder="'.PW_USERN_IHR.'" required><br>
        &nbsp;'.PW_SELF.':&nbsp;<input type="password" name="password" value="" style="width:22em;" class="bemerkg" placeholder="'.PW_PW_IHR.'" required><br>
        <input type="submit" name="login" value="Login" style="width:11em;" class="bemerkg"></form><br><br>';
    if (!empty($log_meldg)) {
        $form_fuer_login .= $log_meldg.$meldg_login_versuche;
    }
}/*if(empty($_SESSION['wfm']['user_now'])) */
if (!empty($_SESSION['wfm']['user_now'])) {
    $log_ok_meldg .= '<a href="'.SELF_LINK.'&amp;logout=1" '
        .'onclick="javascript:return confirm(\''.L_LOGOUT_WIRKL.'\');">'
        .strong($_SESSION['wfm']['user_now'].' ausloggen').'QQQQQ</a>';
}/* END: Login-Regelung  */

/** setzen von Session-Werten */
function setSessionFromRequest($key, $default, $arrErlaubt=NULL)
{
    if (defined('DEV_MODE')) {/* sonst sind die Fehler-Meldungen hinter dem Kopf */
        $_SESSION['wfm'][$key] = 'absolute';
    } elseif (!empty($_REQUEST[$key])) {
        if (empty($arrErlaubt) || !is_array($arrErlaubt)) {
            $_SESSION['wfm'][$key] = $_REQUEST[$key];
        } else {
            if (in_array($_REQUEST[$key], $arrErlaubt)) {
                $_SESSION['wfm'][$key] = $_REQUEST[$key];
            } else {
                $_SESSION['wfm'][$key] = $default;
            }
        }
    } elseif (empty($_SESSION['wfm'][$key])) {
        $_SESSION['wfm'][$key] = $default;
    }
}/*ENDE: function setSession() */
setSessionFromRequest('sortg', 'name', array('typ', 'size', 'date'));
setSessionFromRequest('sortaufab', 'ASC', array('DESC'));

setSessionFromRequest('headPos', 'fixed', array('absolute'));
if ($_SESSION['wfm']['headPos'] == 'absolute') {
    define('HEAD_POS', ''); define('HEAD_TOP_PLUS', 'margin-top: 1em;');
    define('HEAD_P_LINK', '<a href="'.SELF_NAME.'?headPos=fixed" title="'.L_KOPF_SELF.' '.L_KOPF_FIX.'" class="img_link">'.icon_anz('kopf_los').'</a>');
} else {
    define('HEAD_POS', 'position:fixed;'); define('HEAD_TOP_PLUS', 'margin-top: 5em;');
    define('HEAD_P_LINK', '<a href="'.SELF_NAME.'?headPos=absolute" title="'.L_KOPF_SELF.' '.L_KOPF_LOESN.'" class="img_link">'.icon_anz('kopf_fest').'</a>');
}

/** ACHTUNG: Alle Werte muessen klein geschrieben werden!! */
function array_ASCII(){
    return array(
        'asa','asp','bas','cfm','cfml','cgi','conf','css','dat','dbm','eml','htaccess','htc','htm','html',
        'htpasswd','inc','ini','java','js','jsp','log','php','php3','php4','phtml','pl','shtm','shtml',
        'sql','src','txt','vb','vbs','vtm','vtml','wml','xml','xsd','xsl');
}/*function array_ASCII() */
function getDateityp($wert=FALSE)
{
    switch ($wert) {
        case 'dir': /*directory */
            $dateityp = L_ORDNER; break;
        case 'file': /*regular file */
            $dateityp = L_DATEI; break;
        case 'link': /*symbolic link */
            $dateityp = L_VERKNPFG; break;
        default: /*unknown file type */
            /* 'block': block special device
               'char': character special device
               'fifo': FIFO (named pipe) */
            $dateityp = L_UNBEKANNT;
    }
    return $dateityp;
}/*Funktion getDateityp($wert=FALSE) */
function is_binary($wert)
{
    /*wenn nicht ASCII, dann vermutl. Binaerdatei */
    $ascii_zeichen = array_ASCII();
    if (in_array(strtolower($wert), $ascii_zeichen)) {
        return FALSE;/*Wenn gefunden, dann kein BINARY! */
    } else {
        return TRUE;
    }
}/*function is_binary() */
function binary_anzeig_link($dateiName, $dateiNameUPhad, $linkTitel)
{
    return '<a href="'.SELF_LINK.'&amp;application='.urlencode($dateiNameUPhad).'"
               title="Display: '.$dateiName.'">'.$linkTitel.'</a>';
}/*function binary_anzeig_link() */
/** link-Erstellung */
function download_link($dateiName, $dateiNameUPhad, $linkTitel)
{
    return '<a href="'.SELF_LINK.'&amp;attachment='.urlencode($dateiNameUPhad).'"
               title="Download: *'.$dateiName.'*">'.$linkTitel.'</a>';
}/*function download_link() */
function umbenennen_link($verzeichnsInhalt, $link_label, $titelteil, $sprung=NULL)
{
    return '<a href="'.SELF_LINK.'&amp;rename='.urlencode($verzeichnsInhalt)
        .'#'.urlencode((!empty($sprung) ? $sprung : $verzeichnsInhalt)).'" '
        .'title="'.L_UMBENENN.': '.$titelteil.'" '
        .'class="img_link">'.$link_label.'</a>';
}/*function umbenennen_link() */
function dateiLoeschLink($datei)
{
    return '<a href="'.SELF_LINK.'&amp;del_dname='.urlencode($datei).'" onclick="javascript:return confirm(\'&#128266; - '.L_FRAG_LOESCHN.' - &#128239;\\n\\n'
        .L_DATEI.':\\n'.$datei.'\');" title="'.L_LOESCHN.'" class="img_link">'.icon_anz('delete', 'title="'.L_LOESCHN.'"').'</a>';
}/*ENDE: function dateiLoeschLink($datei) */
function dateiNameFiltrn($pfad, $trenner='/')
{
    return basename($pfad);
}/*function dateiNameFiltrn() */
/** wo_liegt_wfm() gibt Pfad mit letztem '/' zurueck und wird auf Konstante WO_LIEGT_WFM gelegt */
function wo_liegt_wfm()
{
    $dateiname_pfad = $_SERVER['SCRIPT_FILENAME'];
    $dateiname = dateiNameFiltrn($dateiname_pfad, '/');
    $dateiPfad = str_replace($dateiname, '', $dateiname_pfad);
    if (substr($dateiPfad, -1) != '/') {
        $dateiPfad .= '/';/*immer mit "/" am Ende ausgeben */
    }
    return $dateiPfad;
}/*function wo_liegt_wfm() */
function lesbare_dateigroesse($gr, $stellen)
{
    /*VORSICHT: intval() funktioniert auf 32Bit-Systeme nur bis 2.147.483.647 */
    if (!empty($gr) && $gr > 0) {
        $name = array('Bytes','KB','MB','GB','TB','PB','EB','ZB','YB');
        $gerundet = round($gr/pow(1024,($i = floor(log($gr, 1024)))), $stellen).' '.$name[$i];
        return '<span title="'.$gr.' Bytes">'.str_replace('.', ',', $gerundet).'</span>';
    } else {
        return '0 Bytes';
    }
}/*function lesbare_dateigroesse(...) */
function encode_base64($zucodierendes_img)
{
    if (file_exists($zucodierendes_img)) {
        $zeiger = fopen($zucodierendes_img, 'rb');
        $inhalt = fread($zeiger, filesize($zucodierendes_img));
        fclose($zeiger); $fertig_codiert = base64_encode($inhalt);
        $dateiName = dateiNameFiltrn($zucodierendes_img, '.');
        return  txtMarkg('<span title="'.$dateiName.'">'.ABBR_BEGINN.' | '.L_BILD_BASE64.': '.$dateiName.'</span>', 'hinweis2')
            .'<textarea rows="6" style="width:95%">'.$fertig_codiert.'</textarea>'
            .txtMarkg(L_CHUNK_SPLIT.' *chunk_split()*').'
          <textarea rows="30" style="width:66em;">'.chunk_split($fertig_codiert).'</textarea><br>data:image/'.$dateiName.';base64,...
          <br><br>'.dateiUeberschrft($zucodierendes_img)
            .img_anzeigen(SELF_LINK.'&amp;imgFile='.urlencode($zucodierendes_img).'&amp;imgDisply='.urlencode($dateiName),
                          L_ANZEIGN.': '.$dateiName,
                          L_MIT.' '.L_RAHMN.' (border=1)',
                          '1');
    } else {
        return txtMarkg(NICHT_GEFUNDN.' ('.$zucodierendes_img.')');
    }/*gibt das Image in base64-codiert zurueck */
}/*function encode_base64() */
function decodeBase64()
{
    return  txtMarkg(DECODE_BASE64, 'hinweis2').form_kopf().'<textarea rows="6" style="width:95%" name="code"></textarea>
    <br><input type="submit" name="deBase64" value="'.DECODE_BASE64.'"></form>';
}
/** Zeigt ein beliebiges Bild an */
function img_anzeigen($img_src, $img_alt, $img_title, $img_border)
{
    return '<img src="'.$img_src.'" alt="'.$img_alt.'" title="'.$img_title.'" border="'.$img_border.'">';
}
/** Uberschriftszeilen BILD */
function dateiUeberschrft($file)
{
    return txtMarkg('<span title="'.$file.'">'.ABBR_BEGINN.' | '.DATEI_NAME.': '.dateiNameFiltrn($file).'</span>', 'hinweis2');
}/*ENDE: function */
function versteck_anzeigen($verstLinkLabel, $verstSelber, $linkTitle=FALSE, $zusaetzl=NULL, $anker='#', $disply=NULL)
{
    return '<a href="'.$anker.'" onclick="if(window.AufUndZuKlappen)return AufUndZuKlappen(this)" '
        .'title="'.(!empty($linkTitle) ? $linkTitle : L_VERSTCK_DEFAULT)
        .'"'.$zusaetzl.'>'.$verstLinkLabel.'</a>'
        .'<div'.(!empty($disply) ? '' : ' style="display:none;"').'>'.$verstSelber.'</div>'.PHP_EOL;
}/*function versteck_anzeigen() */
function upload_link($anzahl, $anzeige=FALSE, $zusLink='')
{
    return SELF_LINK.'&amp;abbr=1&amp;filefelder='.$anzahl.$zusLink.'#anker_upload">'.(!empty($anzeige) ? $anzeige : $anzahl);
}/*function upload_link() */
/** Array mit Bildinformationen */
function bildchen_groesse($img)
{
    $info = getimagesize($img);
    switch ($info[2]) {
        case 1:  $info[2] = 'GIF'; break;
        case 2:  $info[2] = 'JPG'; break;
        case 3:  $info[2] = 'PNG'; break;
        case 4:  $info[2] = 'SWF'; break;
        default: $info[2] = L_UNBEKANNT;
    }
    return $info;
}/*function */
function dateiEndg($name) {
    $pos = strrpos($name, '.');
    if ($pos >= 1) { return substr($name, $pos + 1); }
    else { return false; }
}
function createFile($nam = L_NEU_DATEI, $inhalt = NULL, $wo = NULL) {
    if (empty($wo)) { $wo = $_SESSION['wfm']['v_pfad']; }
    $endg = trim(dateiEndg($nam));
    if (empty ($endg)) { $endg = '.txt'; $nam = strtolower($nam); }
    else {$endg = '.'.$endg; $nam = substr($nam, 0, -strlen($endg)); }
    $n = str_replace(' ', '_', $nam);
    for ($zaehlr = 1; $zaehlr < 222; $zaehlr++) {
        $name = $n.'_'.$zaehlr.$endg;
        if (!file_exists($wo.'/'.$name)) {
            if (empty ($inhalt)) { $inhalt = L_NEU_DATEI.' ('.date('Y-m-d H:i:s').')'; }
            datei_schreiben($wo.'/'.$name, $inhalt);
            return $name;
        }
    }
}
/** Universal-Kopf fuer PHP-Dateien */
function phpDateiKopf($fileName, $beschrbg)
{
    return '<?php '.PHP_EOL
        .'/**'.PHP_EOL.' * '.wordwrap($beschrbg, 50, PHP_EOL.' * ').PHP_EOL.' *'.PHP_EOL
        .' * @name       filename: '.$fileName.PHP_EOL.' * @abstract   read on top!'.PHP_EOL
        .' * @author     '.base64_decode(AUTR).' <'.base64_decode(A_MAIL).'>'.PHP_EOL
        .' * @copyright  Copyright (c)'.JAHR.', '.base64_decode(AUTR).', '.base64_decode(A_W_WFM).PHP_EOL
        .' * @version    file: save '.date('d.m.Y').', '.date('H:i').' h ('.NAME_ANWD_K.'-Version: '.VERSION.')'.PHP_EOL
        .' */'.PHP_EOL.PHP_EOL;
}
function datei_schreiben($name, $inhalt)
{
    $zeiger = fopen($name, 'w');
    fwrite($zeiger, $inhalt);
    fclose($zeiger);
}
function text_kuerzen($text, $stellen=50, $trenner='...', $wo='mitte', $kommentr=FALSE)
{
    if (strlen($text) > $stellen) {
        $zeichn = $stellen - strlen($trenner);
        if (!empty($wo) && $wo == 'vorne') {
            $laenge = strlen($text) - $zeichn;
            $text = $trenner.substr($text, $laenge);
        } elseif (!empty($wo) && $wo == 'hinten') {
            $text = substr($text, 0, $zeichn).$trenner;
        } else {
            /*Standard: Mitte kuerzen: */
            $haelfte = intval($zeichn / 2);
            $text = substr($text, 0, $haelfte).$trenner.substr($text, -$haelfte);
        }
        $text .= (!empty($kommentr) ? ' ['.L_GEKUERZT.']' : '');
    }
    return $text;
}
/** gibt den Schluessel des letzten Array-Wertes aus */
function endKey($array)
{
    end($array); return key($array);
}/*function endKey($array) */

/** Funktion Array-Inhalte anzeigen */
function array_anzeigen($arr_self, $arr_name=FALSE)
{
    $arrName = (!empty($arr_name) ? $arr_name : L_NAME.' '.L_UNBEKANNT);
    if (is_array($arr_self)) {
        $titel = L_INHALT.' *'.$arrName.'*';
        $summe = count($arr_self);
        $echos = '
          <table cellspacing="1" cellpadding="6" border="0">
             <tr>
                <th style="text-align: left; white-space: nowrap; color: '.CLR_HINWS
            .'; background-color: '.CLR_HINTGR_HINW.'" colspan="5">'
            .$titel.' ('.$summe.' '.L_ANZAHL.')</th>
             </tr>'.PHP_EOL; $loop_zaehler = 1;
        foreach($arr_self as $arr_key => $arr_inh)
        {
            if (is_int($arr_inh)) { $typ = 'integer';$zahl = strlen($arr_inh);
            } elseif (is_array($arr_inh)) { $typ = 'array'; $zahl = count($arr_inh);
            } else { $typ = 'string'; $zahl = strlen($arr_inh); }
            if (is_string($arr_inh)) { $arr_inh = htmlentities($arr_inh);
            } elseif (is_array($arr_inh)) { $arr_inh = array_anzeigen($arr_inh, $arr_key); }
            $echos .= '
                <tr>
                    <td style="vertical-align: top; white-space: nowrap;">'.$loop_zaehler.'./'.$summe.'</td>
                    <td style="vertical-align: top; white-space: nowrap;" title="'.L_TYP.': '.$typ.'">'
                .'<strong>'.$arrName.'[\''.$arr_key.'\']</strong></td>
                    <td style="vertical-align: top; white-space: nowrap;">'.$typ.' ('.$zahl.')</td>
                    <td style="text-align: left; vertical-align: top;" title="Typ: '.$typ.'">'.$arr_inh.'</td>
                </tr>'.PHP_EOL; $loop_zaehler++;
        }/*foreach() */
        $echos .= PHP_EOL.'</table>';
    } else {
        $echos = txtMarkg($arrName.' '.L_ARR_KEIN.' "'.$arr_self.'")');
    }/*else ===> if(is_array($arr_self)) */
    return $echos.'<hr>';
}/*function array_anzeigen() */
/** Setzen diverser Header-Informationen fuer den Browser */
function header_setzen($get_array=FALSE)
{
    if (empty($_SESSION['wfm']['user_key']) && !empty($get_array)) {
        /*Stoppt den Download-Link, wenn nicht angemeldet! */
        exit('LogIn?');
    }
    if (!empty($get_array)) {
        if (!empty($get_array['imgDisply']) && defined('IMGFILE_GET')) {
            $header = 'Content-Type: image/'.dateiNameFiltrn(IMGFILE_GET);
        } elseif (!empty($get_array['application'])) {
            /*z.B.: PDF Datei ausgeben */
            $header = 'Content-Type: application/'.dateiNameFiltrn($get_array['application'], '.');
        } elseif (!empty($get_array['attachment'])) {
            $header = 'Content-Disposition: attachment; filename="'
                .dateiNameFiltrn((defined('ATTACHMT') ? ATTACHMT : $get_array['attachment'])).'"';
        }
    }
    if (empty($header)) {/*default-Header! */
        $header = 'Content-type: text/html; charset='.CODIERG;
    }
    return header($header);
}/*function header_setzen() */
function bildLeiste($href, $linkzusatz, $bild, $bild_name, $bild_info)
{
    $samlg = '<ul><li>'.L_DIMENS_XY.': '.$bild_info[0].' x '.$bild_info[1].' Pixel, '.L_TYP.': '.$bild_info[2].'</li>
        <li>'.download_link($bild, $bild, strong('Download: '.dateiNameFiltrn($bild_name))).'</li>
        <li><a href="'.SELF_LINK.'&amp;code2base64='.urlencode($bild).'" '
        .' title="*'.dateiNameFiltrn($bild_name).'* '.DREI_GROESSR.' Base64...">'
        .strong(L_BILD_BASE64.'...').'</a></li><ul>';
    $samlg = txtMarkg($samlg, 'erfolge');
    return $samlg.PHP_EOL;
}/*function bildLeiste() */
function selBox_opt($value='#', $label='&nbsp;', $sel=FALSE, $style=FALSE)
{
    if (!empty($sel)) { $sel = ' selected="selected"'; }
    return '<option value="'.$value.'"'.$sel.$style.'>'.$label.'</option>
    ';
}/*function selBox_opt() */
/** Funktion zur Bildvorschau */
function bildVorschau($bildchen, $linkzusatz)
{
    if (defined('IMGFILE_GET')) {
        $bild_info = bildchen_groesse($bildchen);
        $bild_name = dateiNameFiltrn($bildchen);
        return bildLeiste(SELF_LINK.'&amp;imgFile='.urlencode(IMGFILE_GET).'&amp;imgDisply='.$bild_info[2],
                          $linkzusatz, $bildchen, $bildchen, $bild_info)
            .txtMarkg(L_HINWS.L_BILD_DARSTLLG)
            .img_anzeigen(SELF_LINK.'&amp;imgFile='.urlencode(IMGFILE_GET).'&amp;imgDisply='.$bild_info[2],
                          L_ANZEIGN.': '.$bild_name,
                          L_MIT.' '.L_RAHMN.' (border=1)',
                          '1').VIER_LEER_X_2
            .img_anzeigen(SELF_LINK.'&amp;imgFile='.urlencode($_REQUEST['imgFile']).'&amp;imgDisply='.$bild_info[2],
                          L_ANZEIGN.': '.$bild_name,
                          L_OHNE.' '.L_RAHMN.' (border=0)',
                          '0').PHP_EOL;
    }
}/*function */
if (!empty($_GET['favos']) && empty($meldg)) {
    $meldg = favo_steuerg($_GET['favos']);
}
function favo_selectbox()
{
    $favo_selectbox = '';
    if (file_exists(favo_datei())) {
        $arr_favoinhalt = file(favo_datei());
        $favo_selectbox = '<select name="favos" id="id_favos" size="1" style="align: right; vertical-align: top; width: 25em; background-color: '.CLR_HINTGR_SELBX_KOPF.';" onchange="this.form.submit();">
            '.selBox_opt('', L_FAVORTS.' - '.L_FUNKTN, 1).selBox_opt().'
        <optgroup label="'.L_FAVORIT.' '.  strtolower(L_AUSWAEHLN).' '.DREI_KLEINR.DREI_KLEINR.'">';
        foreach ($arr_favoinhalt as $einFavo) {
            $einFavo = trim($einFavo);
            if (!empty($einFavo) && substr($einFavo, 0, 7) != 'HINWEIS' && substr($einFavo, 0, strlen(SCHREIBWEISE)) != SCHREIBWEISE) {
                $getrennt = explode('###', $einFavo); $pfad = trim($getrennt[0]);
                $lable = (!empty($getrennt[1])? trim($getrennt[1]) : $pfad);
                $lable = (!empty($lable)? $lable : $pfad);
                if (!defined('STANDD_ORT') && substr($lable, 0, 4) == '[GO]') {
                    $verzMeldg = verzLesOderBrowsbar('verzns', $pfad);
                    if (empty($verzMeldg[0])) {
                        $lable = substr($lable, 4).' ['.L_HOME.']'; define('STANDD_ORT', $pfad);
                    } else {
                        $lable = substr($lable, 4).' ['.L_HOME.'] (defekt)'; define('STANDD_ORT', $verzMeldg[1]);
                    }
                }
                if ((!empty($_GET['verzns']) && $pfad == $_GET['verzns']) || (empty($_GET['verzns']) && !empty($_SESSION['wfm']['v_pfad'])
                        && $pfad == $_SESSION['wfm']['v_pfad'])) {
                    $value = '7" style="font-size:0.95em; color:'.CLR_FONT_DEAKTIV.';';
                    $beginn_label = DREI_GROESSR.' '; $ende = ' '.DREI_KLEINR.' ('.L_AKTUELL.')';  $laeng = 40;
                    if (!defined('FAVO_AKTIV')) {
                        define('FAVO_AKTIV', (text_kuerzen(trim($pfad), 36, ' . . . ')));
                    }
                } else {
                    $value = 'wfm1'.$pfad; $beginn_label = ''; $ende  = ''; $laeng = 50;
                }
                $favo_selectbox .= selBox_opt($value, $beginn_label.(text_kuerzen(trim($lable), $laeng, '... ')).$ende);
            }
        }/*foreach */
        $favo_selectbox .= selBox_opt().'</optgroup>
        <optgroup label="'.L_VERWALTG.' '.L_FAVORTS.' '.DREI_KLEINR.DREI_KLEINR.'">'
            .(!defined('FAVO_AKTIV') ?
                selBox_opt('1', L_FAVO_ERSTELLN) :
                selBox_opt('6', L_FAVO_ERSTELLN.' '.NICHT_MOEGL, '', ' style="font-size:0.95em;color:'.CLR_FONT_DEAKTIV.';"'))
            .selBox_opt('9', L_FAVORTS.' - '.L_VERWALTG)
            .selBox_opt('help', L_HANDBUCH).selBox_opt().'
        </optgroup>
    </select>';
    }/*if ((favo_datei())) */
    if (!defined('STANDD_ORT')) { define('STANDD_ORT', WO_LIEGT_WFM); }
    return $favo_selectbox;
}/*function */
function favo_speichern()
{
    if (file_exists(favo_datei())) { $arrInhlt = file(favo_datei()); }
    else { $arrInhlt = array(); }
    $arrInhlt[count($arrInhlt)] = trim($_SESSION['wfm']['v_pfad']);
    $arr_new = array();
    foreach ($arrInhlt as $einFavo) {
        $einFavo = trim($einFavo);
        $getrennt = explode('###', $einFavo);
        $feld1 = trim($getrennt[0]);
        $lable = (!empty($getrennt[1])? trim($getrennt[1]) : $feld1);
        $lable = (!empty($lable)? $lable : $feld1);
        if (!empty($feld1) && !array_key_exists($feld1, $arr_new)
            && substr($feld1, 0, 7) != 'HINWEIS' && substr($feld1, 0, strlen(SCHREIBWEISE)) != SCHREIBWEISE) {
            $arr_new[$feld1] = trim($feld1).'###'.text_kuerzen($lable, 50, '...').PHP_EOL;
        }
    }/*foreach */
    sort($arr_new);
    $start = SCHREIBWEISE.': '.L_FAVO_SCHREIBWSE;
    datei_schreiben(favo_datei(), $start.PHP_EOL.trim(implode('', $arr_new)));
}/*function favo_speichern() */
function favo_steuerg($wert_favos){
    $meldg = '';
    if (!empty($_SESSION['wfm']['v_pfad'])) {
        $link_handb = helpLink('lesezeichen', '', NAME_ANWD_K.'-'.HILFE_BUCH.': '.L_FAVORTS, 1);
        switch ($wert_favos) {
            case 1:
                favo_speichern(favo_datei());
                $meldg = txtMarkg(L_FAVORIT.' '.L_FAVO_HINZUGEF.'! '.VIER_LEER_X_2.$link_handb.'
          <br>('.text_kuerzen($_SESSION['wfm']['v_pfad'], 95, ' . . . ', 'vorne', 1).')',
                                  'erfolge', 'title="Add: '.$_SESSION['wfm']['v_pfad'].'"'); break;
            case 9:
                if (!empty($_SESSION['wfm']['favo_tool']) && $_SESSION['wfm']['favo_tool'] != '0') {
                    echo html_begin();
                    include_once $_SESSION['wfm']['favo_tool'];
                    echo htmlbodyende(); exit();
                } else {
                    $_GET['text_file'] = favo_datei(); $_REQUEST['editor'] = 'textarea';/*oder: 'input'; */
                    $meldg = txtMarkg(L_FAVORTS.' - '.L_VERWALTG.'! '.VIER_LEER_X_2.$link_handb, 'erfolge', 'title="'.L_VERWALTG.': '.L_FAVORTS.'"'); break;
                }
            case 6:
                $meldg = txtMarkg(L_FAVO_SCHON_DA.' "'.L_FAVORTS.'"!<br>'.$link_handb, 'hinweis2', ''); break;
            case 7:
                $meldg = txtMarkg(L_FAVO_SPRG_DA.'! '.VIER_LEER_X_2.$link_handb, 'hinweis2', ''); break;
            case 'help':
                $meldg = txtMarkg(helpLink('lesezeichen', NAME_ANWD_K.'-'.HILF_ZU_THEMA.': '.L_FAVORTS, '', 1), 'hinweis', 'title="'.L_VERWALTG.': '.L_FAVORTS.'"'); break;
            case 'del':
                if (@unlink(favo_datei())) {
                    $meldg = txtMarkg(L_FAVORTS.' - '.DATEI_GELOESCHT.'! '.VIER_LEER_X_2.$link_handb, 'hinweis2');
                } break;
            default:
                if (substr($wert_favos, 0, 3) == 'wfm') {
                    if (substr($wert_favos, 0, 4) == 'wfm1') {
                        $meldg = txtMarkg(L_HINWS.L_FAVO_SPRG_OK.' '.L_FAVORIT.' '.VIER_LEER_X_2.$link_handb);
                    } elseif (substr($wert_favos, 0, 4) == 'wfm9') {
                        $meldg = txtMarkg(L_HINWS.L_FAVO_SPRG_OK.' '.L_FAVO_HOME.' '.VIER_LEER_X_2.$link_handb);
                    } $_GET['verzns'] = substr($wert_favos, 4);
                } break;
        }
    }/*if (!empty($_SESSION['wfm']['... */
    return $meldg;
}/*Funktion "favo_steuerg($wert_favos)" */
if (empty($_SESSION['wfm']['v_pfad'])
    || (!empty($_GET['neu']) && $_GET['neu'] == 'laden')) {
    $_SESSION['wfm']['v_pfad'] = WO_LIEGT_WFM;
} elseif (!empty($_GET['verzns'])) {
    if (!empty($_ENV['OS']) && stristr($_ENV['OS'], 'WINDOWS')
        && substr($_GET['verzns'], 0, 1) == '/') {
        $_GET['verzns'] = ($_GET['verzns'] == '/' ? WO_LIEGT_WFM : substr($_GET['verzns'], 1));
    }
    $_SESSION['wfm']['v_pfad'] = $_GET['verzns'];
}/*if(empty($_SESSION['wfm']['v_pfad'])) */
/*START: Loeschen von Dateien */
if (!empty($_GET['del_dname']) ||
    !empty($_POST['select_action']) && $_POST['select_action'] == 'file_loeschen' && !empty($_POST['files'])) {
    if (!empty($_GET['del_dname'])) {
        $_POST['files'] = array($_GET['del_dname']);
    }
    $datei_del_ok = ''; $datei_del_not = '';
    foreach($_POST['files'] as $arr_inh){
        if (@unlink($_SESSION['wfm']['v_pfad'].'/'.$arr_inh)) {
            $datei_del_ok .= '<li>'.$arr_inh.'</li>';
        } else {
            $datei_del_not .= '<li>'.$arr_inh.'</li>';
        }
    }
    if(!empty($datei_del_ok)){
        $GLOBALS['meldSlg'] .= txtMarkg(L_ERFOLGRCH.DATEIN_GELOESCHT, 'erfolge')
            .'<ul>'.$datei_del_ok.'</ul>
            '.txtMarkg(L_ORDNR_IM.'"'.$_SESSION['wfm']['v_pfad'], 'erfolge').'<hr>'.PHP_EOL;
    }
    if(!empty($datei_del_not)){
        $GLOBALS['meldSlg'] .= txtMarkg(ERR_ERROR.DATEIN_GELOESCH_NOT, 'fehler').'
             <ul>'.$datei_del_not.'</ul>
             '.txtMarkg(L_ORDNR_IM.'"'.$_SESSION['wfm']['v_pfad'], 'fehler').'<hr>'.PHP_EOL;
    }
}/*END: Loeschen von Dateien */
/** START: Haendling der ZIP-Datei (erzeugen, anzeigen, download, loeschen */
if (!empty($_GET['del_zip'])) {
    unlink(SPEICHER_FUER_WFM.ZIP_NAME);
} elseif(!empty($_GET['entZippn'])) {
    $zipDateiName = dateiNameFiltrn($_GET['entZippn']);
    if (is_file($_GET['entZippn'])) {
        $zip = new ZipArchive;
        if ($zip->open($_GET['entZippn']) === TRUE) {
            $zip->extractTo($_SESSION['wfm']['v_pfad'].'/'.str_replace('.'.dateiEndg($zipDateiName), null, $zipDateiName));
            $zip->close();
            $GLOBALS['meldSlg'] .= txtMarkg(L_ERFOLGRCH.str_replace(':', ' "'.$zipDateiName.'"', ZIP_ENTPCKN_OK), 'erfolge');
        } else {
            $GLOBALS['meldSlg'] .= txtMarkg(ERR_ERROR.str_replace(':', ' "'.$zipDateiName.'"', ZIP_ENTPCKN_HIER), 'fehler');
        }
    } else {
        $GLOBALS['meldSlg'] .= txtMarkg(ERR_ERROR.'"'.$zipDateiName.'" - '.NICHT_GEFUNDN, 'fehler');
    }
    /*exit('<br>entZippn '.$_GET['entZippn']);*/
}
$datei_zip = NULL;
if (!empty($_POST['select_action']) && $_POST['select_action'] == 'file_zippen' && !empty($_POST['files'])) {
    if (class_exists('ZipArchive')) {/* funktioniert ab PHP-Vers 5.2 */
        $zip = new ZipArchive;
        $zip_holen = $zip->open(SPEICHER_FUER_WFM.ZIP_NAME, ZipArchive::CREATE);
        if ($zip_holen === true) {
            foreach($_POST['files'] as $arr_inh)
            {
                $zip->addFile($_SESSION['wfm']['v_pfad'].'/'.$arr_inh, $arr_inh);
            }
            $zip->close();
            $GLOBALS['meldSlg'] .= txtMarkg(ZIP_ARCHV.ZIP_HINZUGF, 'hinweis2');
        } else {
            $GLOBALS['meldSlg'] .= txtMarkg(ERR_ERROR.ZIP_HINZU_NOT, 'fehler');
        }
    } else {
        foreach($_POST['files'] as $arr_inh){
            $datei_zip .= ' '.$_SESSION['wfm']['v_pfad'].'/'.$arr_inh;
        }
        $generiere_zip = exec('zip '.SPEICHER_FUER_WFM.ZIP_NAME.' '.$datei_zip);
    }
}/*if() */
if (file_exists(SPEICHER_FUER_WFM.ZIP_NAME)) {
    $zip_meldg = ZIP_ARCHV
        .strong('<a href="'.SELF_LINK.'&amp;attachment='.urlencode(SPEICHER_FUER_WFM.ZIP_NAME).'" title="'.ZIP_DOWNL.'">'
                .L_DOWNLD.'</a>').' | '.strong('<a href="'.SELF_LINK.'&amp;verzns='.urlencode(SPEICHER_FUER_WFM).'"'
                                               .'onclick="return confirm(\''.WECHSL_ORDNR.'...\\n\\n'.SPEICHER_FUER_WFM
                                               .'\\n\\n'.ZIP_ARCHV.'*'.ZIP_NAME.'*\')" title="'.DATEI_PFAD.': '.SPEICHER_FUER_WFM.'">'.lcfirst(WECHSL_ORDNR).'</a>').' | '
        .strong('<a href="'.SELF_LINK.'&amp;del_zip=zip" '
                .'onclick="return confirm(\'&#128266; - '.L_FRAG_LOESCHN.' - &#128239;\\n\\n'.ZIP_ARCHV.' *'.ZIP_NAME.'* '
                .lcfirst(L_LOESCHN).'?\\n\\n'.DATEI_PFAD.':\\n '.SPEICHER_FUER_WFM.'*\')" title="'.ZIP_ARCHV.L_LOESCHN.'">'
                .lcfirst(L_LOESCHN).'</a>');
    $GLOBALS['meldSlg'] .= txtMarkg($zip_meldg, 'erfolge', 'title="ZipFile-Manager"').'<hr>';
}/* ENDE: Haendling der ZIP-Datei (erzeugen, anzeigen, download, loeschen */
/** Groesse des Verzeichnisses inkl. Unterverz. */
function verz_groesse_lesen($v_pfad='.')
{
    $zaehler = 0; $result[$v_pfad] = 0; $verzeichn = opendir($v_pfad);
    if ($verzeichn) {
        while (FALSE !== ($eineDatei = readdir($verzeichn))) {
            if ($eineDatei != '.' && $eineDatei != '..') {
                $verz_name = $v_pfad.'/'.$eineDatei;
                if (is_dir($verz_name)) {
                    $arr_verz = verz_groesse_lesen($verz_name);
                    while (list($key, $value) = each ($arr_verz)) {
                        $zaehler++; $result[$key] = $value;/*gefunden */
                    }
                } else {
                    $result[$v_pfad] += filesize($verz_name);
                }
            }/*if ($eineDatei != "." &... */
        }/*while (FALSE !== ($eine_date... */
    }/*if ($verzeichn) */
    closedir($verzeichn); return $result;
}/*function verz_groesse_lesen($v_pfad) */
function verz_groesse_anzeigen($verzeichn_name)
{
    $data = verz_groesse_lesen($verzeichn_name);
    $summensammlg = 0; $verz_sammlg = '';
    foreach ($data as $schluessel => $verz_groesse) {
        $summensammlg += $verz_groesse;
        $verz_sammlg .= '<li>'.str_replace($_SESSION['wfm']['v_pfad'], '...', $schluessel)
            .'/ '.DREI_GROESSR.' '.lesbare_dateigroesse($verz_groesse, 3).'</li>'.PHP_EOL;
    }
    return versteck_anzeigen('<span title="'.L_ORDNR_GROESSE.'" '
                             .'style="color: '.CLR_ERFOLG.'; background-color: '.CLR_HINTGR_HINW.'; font-weight: bold;">&nbsp;'
                             .lesbare_dateigroesse($summensammlg, 3).'&nbsp;</span>',
                             '<h3>'.L_ORDNR_GESA_GROESSE.$summensammlg.' byte</h3>
               <ol style="text-align: left;">'.$verz_sammlg.'</ol>');
}/** function verz_groesse_anzeigen($verzeichn_name) - ermittelt die groesse des Verzeichnisses inkl. Unterverz. */

/** Loeschen von Verzeichnisen (auch nicht-leeren!)  */
function verzeichnis_lauf($nicht_leeres_Verzeichnis){
    $das_verzeichnis = opendir($nicht_leeres_Verzeichnis);
    while($jeweiliger_name = readdir($das_verzeichnis)){
        $name = $nicht_leeres_Verzeichnis.'/'.$jeweiliger_name;
        switch (true) {
            case ($jeweiliger_name == '.')  : break;
            case ($jeweiliger_name == '..') : break;
            case (is_dir($name))            : verzeichnis_lauf($name); break;
            default                         : unlink ($name);
        }
    }
    closedir($das_verzeichnis);
    @chmod($nicht_leeres_Verzeichnis, 0777);
    @rmdir($nicht_leeres_Verzeichnis);
}
/** DELETE -- Loeschen von Verzeichnisen (auch nicht-leeren!) */
function Verz_loeschen_nicht_leer($arr)
{
    if ($arr['loesch_name_orig'] == $arr['loesch_name_bestaetigt']) {
        if (!is_dir($_SESSION['wfm']['v_pfad'].'/'.$arr['loesch_name_bestaetigt'])) {
            $meldung_verz_loeschen =  txtMarkg(ERR_ERROR.'"'.$arr['loesch_name_bestaetigt'].'" - '
                                               .L_ORDNR_NOT_FOUND, 'fehler').'<hr>';
        } else {
            $nicht_leeres_Verzeichnis = $_SESSION['wfm']['v_pfad'].'/'.$arr['loesch_name_bestaetigt'];
            verzeichnis_lauf($nicht_leeres_Verzeichnis);
            if (!is_dir($arr['loesch_name_bestaetigt'])) {
                $meldung_verz_loeschen =  txtMarkg(L_ERFOLGRCH.' "'.$arr['loesch_name_bestaetigt']
                                                   .'" '.L_GELOSCHT.'!', 'erfolge').'<hr>';
            } else{
                $meldung_verz_loeschen =  txtMarkg(ERR_ERROR.'"'.$arr['loesch_name_bestaetigt']
                                                   .'" '.GELOESCH_NOT.'!', 'erfolge').'<hr>';
            }
        }
    } else {
        $meldung_verz_loeschen = txtMarkg(L_HINWS.EINGABN_FALSCH, 'hinweis2').'<hr>';
    }
    return $meldung_verz_loeschen;
}/*function Verz_loeschen_nicht_leer() */
if (!empty($_POST['del_not_empty'])
    && !empty($_POST['loesch_name_orig'])
    && !empty($_POST['loesch_name_bestaetigt'])) {
    $GLOBALS['meldSlg'] .= Verz_loeschen_nicht_leer($_POST);
} elseif (!empty($_GET['del_verz'])) {
    $_POST['loesch_name_orig'] = $_GET['del_verz'];
    $_POST['loesch_name_bestaetigt'] = $_GET['del_verz'];
    $GLOBALS['meldSlg'] .= Verz_loeschen_nicht_leer($_POST);
}/*DELETE -- Loeschen von Verzeichnissen (auch nicht-leeren!) */

/** Sortier-Button u. -Link */
function sort_link($label, $title, $get)
{
    $link4all = 'a href="'.SELF_LINK.'&amp;sortg='.urlencode($get).'&amp;sortaufab=';
    $sortaufab = 'ASC'; $sort_label = SORT_AUFSTEIGND;
    if (!empty($_SESSION['wfm']['sortg']) && $_SESSION['wfm']['sortg'] == $get) {
        if (!empty($_SESSION['wfm']['sortaufab']) && $_SESSION['wfm']['sortaufab'] != 'DESC') {
            $sortaufab = 'DESC'; $sort_label = SORT_ABSTEIGND;
        }
    }
    if ($sortaufab == 'ASC' || $_SESSION['wfm']['sortg'] != $get) {
        $teil2 = '<'.$link4all.'ASC" class="img_link" title="'.SORT_AUFSTEIGND.' *'.$title.'*">'.icon_anz('sort_up_norm').'</a>';
    } else {
        $teil2 = icon_anz('sort_up_red');
    }
    if ($sortaufab == 'DESC' || $_SESSION['wfm']['sortg'] != $get) {
        $teil1 = '<'.$link4all.'DESC" class="img_link" title="'.SORT_ABSTEIGND.' *'.$title.'*">'.icon_anz('sort_down_norm').'</a>';
    } else {
        $teil1 = icon_anz('sort_down_red');
    }
    return '<'.$link4all.$sortaufab.'" title="'.$sort_label.' *'.$title.'*">'
        .$label.'</a><br>'.$teil2.$teil1;
}/*function sort_link() */

/*START: Aller Funktionen zur Rechte-Info / Owner / Group */
function rechte_owner($wert)
{
    if (function_exists('posix_getpwuid')) {
        $arr = posix_getpwuid(fileowner($wert));
        return $arr['name'];
    } else {
        return L_UNBEKANNT;
    }
}
function rechte_group($wert)
{
    if (function_exists('posix_getgrgid')) {
        $arr = @posix_getgrgid($wert);
    } else {
        $arr = array('name' => L_UNBEKANNT);
    }
    $wert = filegroup($wert);
    $mitgl = OWNR_MITGL;
    if (empty($arr['members'])) {
        $mitgl = OWNR_MITGL_UNBEK;
    } elseif (is_array($arr['members'])) {
        foreach ($arr['members'] as $einz) {
            $mitgl .= $einz.', ';
        }
        $mitgl = substr($mitgl, 0, -2);
    } else {
        $mitgl .= $arr['members'];
    }
    return '<span title="'.$mitgl.'">'.$arr['name'].'</span>';
}
function rechte_txt2num($wert)
{
    $zahl  = (substr($wert, 0, 1) == '-' ? 0 : 4);
    $zahl += (substr($wert, 1, 1) == '-' ? 0 : 2);
    $zahl += (substr($wert, 2, 1) == '-' ? 0 : 1);
    return $zahl;
}
function rechte_anz($datei) {
    $wert = fileperms($datei);
    $x_ow = (($wert & 0x0100)  ? 'r' : '-');
    $x_ow .= (($wert & 0x0080) ? 'w' : '-');
    $x_ow .= (($wert & 0x0040) ? (($wert & 0x0800) ? 's' : 'x' ) : (($wert & 0x0800) ? 'S' : '-'));
    $x_gr = (($wert & 0x0020)  ? 'r' : '-');
    $x_gr .= (($wert & 0x0010) ? 'w' : '-');
    $x_gr .= (($wert & 0x0008) ? (($wert & 0x0400) ? 's' : 'x' ) : (($wert & 0x0400) ? 'S' : '-'));
    $x_wd = (($wert & 0x0004)  ? 'r' : '-');
    $x_wd .= (($wert & 0x0002) ? 'w' : '-');
    $x_wd .= (($wert & 0x0001) ? (($wert & 0x0200) ? 't' : 'x' ) : (($wert & 0x0200) ? 'T' : '-'));
    $arr_recht['rwx'] = $x_ow.'&nbsp;'.$x_gr.'&nbsp;'.$x_wd;
    $arr_recht['oktal'] = '0'.rechte_txt2num($x_ow).rechte_txt2num($x_gr).rechte_txt2num($x_wd);
    $arr_recht['owner'] = rechte_owner($datei); $arr_recht['group'] = rechte_group($datei);
    return $arr_recht;
}
function rechte_rwx_zellen($wert)
{
    $arr_owner = rechte_anz($wert);
    return '
      <td title="'.OWNR_RECHT.'">'.$arr_owner['rwx'].'</td><td title="'.OWNR_OKTAL.'">'.$arr_owner['oktal'].'</td>
      <td title="'.OWNR_SELF.'">'.$arr_owner['owner'].'</td><td title="'.OWNR_GROUP.'">'.$arr_owner['group'].'</td>';
}/*function rechte_rwx_zellen() - Aller Funktionen zur Rechte-Info / Owner / Group */

/** Verzeichnis erstellen */
function verz_erstell($val_verz)
{
    if (@mkdir($_SESSION['wfm']['v_pfad'].'/'.$val_verz, 0755)) {
        return txtMarkg(L_ORDNR_OEFFN.' "<a href="'.SELF_LINK.'&amp;verzns='.urlencode($_SESSION['wfm']['v_pfad']).'/'
                        .$val_verz.'&filefelder=1" title="'.WECHSL_ORDNR.'...">.../'.$val_verz.'</a>"', 'erfolge').'<hr>'.PHP_EOL;
    } elseif (is_dir($_SESSION['wfm']['v_pfad'].'/'.$val_verz)) {
        /*schon vorhanden! */
    } else {
        return txtMarkg(ERR_ERROR.'"/'.$val_verz.'"... '.NICHT_ERSTLLT, 'fehler').'<hr>'.PHP_EOL;
    }/*else ==> if(... */
}/*function verz_erstell() */
function verz_vorbereit($val)
{
    $val = preg_replace('/(\/){2,}|(\\\){1,}/', '/', $val);/*nur Slash */
    $val = str_replace('/', ' ', $val); $val = str_replace('  ', ' ', $val);
    $val = trim($val); $val = str_replace(' ', '/', $val);
    if (strpos($val, '/') == true) {
        $arr = explode('/', $val);
        $meldg  = ''; $sammlg = null;
        foreach ($arr as $einz) {
            $einz = trim($einz);
            if (!empty($einz)) {
                $sammlg .= $einz.'/'; $meldg  .= verz_erstell($sammlg);
            }
        }
        return $meldg;
    } else {
        return verz_erstell($val);
    }
}/*function verz_vorbereit($val) */
if (!empty($_POST['subm_make_verz']) && !empty($_POST['make_verz'])) {
    $make_verz = trim($_POST['make_verz']);
    if (strpos($make_verz, ',')) {
        $arr_verze = explode(',', $make_verz);
        foreach ($arr_verze as $einzeln) {
            if (!empty($einzeln)) {
                $GLOBALS['meldSlg'] .= verz_vorbereit($einzeln);
            }
        }
    } else {
        $GLOBALS['meldSlg'] .= verz_vorbereit($make_verz);
    }
}/*Verzeichnis erstellen */

/** Regelung zum Dateidownload und Dateischreiben */
function saveDatei($wert_name, $wert_size, $wert_tmp_name, $speicher_pfad, $zaehlr)
{
    if ($wert_size > 0) {
        if (move_uploaded_file($wert_tmp_name, $speicher_pfad.'/'.$wert_name)) {
            chmod ($speicher_pfad.'/'.$wert_name, 0644);
            $meldg_roh = '<strong title="'.L_ORDNR_IM.' *'.$speicher_pfad.'*">'.$zaehlr.'.) "'.$wert_name.'" ('.lesbare_dateigroesse($wert_size, 3).')</strong>';
            $meldg = txtMarkg($meldg_roh, 'erfolge');
        } else {
            $meldg_roh = ERR_ERROR.'<strong title="'.L_ORDNR_IM.' *'.$speicher_pfad.'*">'.$zaehlr.'.) "'.$wert_tmp_name.'"</strong> '.L_SPEICHR_FEHLR;
            $meldg = txtMarkg($meldg_roh, 'fehler');
            $meldg .= '<h4>Inhalt des Arrays "$_FILES":</h4>'; print_r($_FILES);/* Debuging */
        }
    } else {
        $meldg = txtMarkg(ERR_ERROR.'<strong>"'.$wert_tmp_name.'"</strong> - '.NICHT_GEFUNDN, 'fehler');
    }
    return $meldg;
}/*function saveDatei() */
if(!empty($_FILES['uploadFiles']['name']) && !empty($_POST['dateiupload'])){
    $meldg_ok = ''; $meldg_FALSE = ''; $startMldg = ''; $endMldg = ''; $zaehlr = 1;
    if (is_array($_FILES['uploadFiles']['name'])) {
        $file_zaehler = 0;/*Array-Zaehler */
        $ignor_zaehler = 0;/*Fehler-Zaehler */
        foreach($_FILES['uploadFiles']['name'] as $dateiname) {
            if ($_FILES['uploadFiles']['error'][$file_zaehler] != 4) {
                $startMldg = txtMarkg(L_ERFOLGRCH.L_SPEICHR_EINGEF, 'erfolge');
                $endMldg = txtMarkg(L_ORDNR_AKTUELL.': '.$_SESSION['wfm']['v_pfad'], 'erfolge');
                $meldg_ok .= saveDatei($_FILES['uploadFiles']['name'][$file_zaehler],
                                       $_FILES['uploadFiles']['size'][$file_zaehler],
                                       $_FILES['uploadFiles']['tmp_name'][$file_zaehler],
                                       $_SESSION['wfm']['v_pfad'], $zaehlr++);
            } else {
                $ignor_zaehler++;
                $meldg_FALSE = txtMarkg(L_HINWS.$ignor_zaehler.' '.DOWNL_LEER);
            }
            $file_zaehler++;
        }/*foreach() */
    }/*else ==> if */
    $GLOBALS['meldSlg'] .= PHP_EOL.$startMldg.$meldg_ok.$endMldg.$meldg_FALSE.'<hr>'.PHP_EOL;
}/*if(!empty($_FILES['uploadFiles']['name'])) - Regelung zum Dateidownload und Dateischreiben */
/*START (Teil 1): Zwischenspeicher (Idee: Klemmbrett aus Typo3) */
if (!empty($_GET['status']) && !empty($_GET['temp_move_status'])) {
    if (!empty($_GET['status']) && $_GET['status'] == 1) {
        $_SESSION['wfm']['temp_memo'][$_GET['temp_move_status']]['move'] = 1;
    } else {
        $_SESSION['wfm']['temp_memo'][$_GET['temp_move_status']]['move'] = 9;
    }
}
if (!empty($_GET['del_temp_memo']) && $_GET['del_temp_memo'] == 1) {
    unset($_SESSION['wfm']['temp_memo']);
    $GLOBALS['meldSlg'] .= txtMarkg(L_SPEICHR_GELEERT, 'hinweis2')
        .'<br>'.PHP_EOL;
} elseif (!empty($_GET['del_temp_memo'])) {
    unset($_SESSION['wfm']['temp_memo'][$_GET['del_temp_memo']]);
    $GLOBALS['meldSlg'] .= txtMarkg(L_SPEICHR_EINE_WEG.' ('.$_GET['del_temp_memo'].')', 'hinweis2')
        .'<br>'.PHP_EOL;
}/*elseif(!empty($_GET['del_temp_memo'])) */
if (!empty($_SESSION['wfm']['temp_memo']) && is_array($_SESSION['wfm']['temp_memo'])
    && !empty($_GET['temp_m_einfg']) && $_GET['temp_m_einfg'] == 1) {
    foreach($_SESSION['wfm']['temp_memo'] as $mein_erster_inhalt)
    {
        if (!empty($mein_erster_inhalt['name'])) {
            if (copy($mein_erster_inhalt['pfad'].'/'.$mein_erster_inhalt['name'],
                     $_SESSION['wfm']['v_pfad'].'/'.$mein_erster_inhalt['name'])) {
                $meldg = L_SPEICHR_EINGEF;
                if (!empty($mein_erster_inhalt['move'])
                    && $mein_erster_inhalt['move'] == 1) {
                    unlink($mein_erster_inhalt['pfad'].'/'.$mein_erster_inhalt['name']);
                    $meldg .= '<br>'.L_SPEICHR_MOVE.' ('.$mein_erster_inhalt['pfad'].')!';
                }
                $meldg = txtMarkg($meldg, 'erfolge');
            } else {
                $meldg = txtMarkg(ERR_ERROR.L_SPEICHR_FEHLR.' ('.$mein_erster_inhalt['pfad'].'/'.$mein_erster_inhalt['name'].' u.f.)', 'fehler');
            }
        }/*if(!empty($mein_erster_inhalt['name'])) */
    }/*foreach($_SESSION['wfm']['temp_memo'] as $mein_erster_inhalt) */
    unset($_SESSION['wfm']['temp_memo']);
    $GLOBALS['meldSlg'] .= $meldg.'<hr>'.PHP_EOL; $meldg = NULL;
} elseif (!empty($_GET['temp_m_einfg']) && !empty($_SESSION['wfm']['temp_memo'])
    && is_array($_SESSION['wfm']['temp_memo'][$_GET['temp_m_einfg']])) {
    if (copy($_SESSION['wfm']['temp_memo'][$_GET['temp_m_einfg']]['pfad'].'/'.$_SESSION['wfm']['temp_memo'][$_GET['temp_m_einfg']]['name'],
             $_SESSION['wfm']['v_pfad'].'/'.$_SESSION['wfm']['temp_memo'][$_GET['temp_m_einfg']]['name'])){
        $meldg = L_SPEICHR_EINGEF.' ('.$_GET['temp_m_einfg'].')';
        if(!empty($_SESSION['wfm']['temp_memo'][$_GET['temp_m_einfg']]['move'])
            && $_SESSION['wfm']['temp_memo'][$_GET['temp_m_einfg']]['move'] == 1){
            unlink($_SESSION['wfm']['temp_memo'][$_GET['temp_m_einfg']]['pfad']
                   .'/'.$_SESSION['wfm']['temp_memo'][$_GET['temp_m_einfg']]['name']);
            $meldg .= '<br>'.L_SPEICHR_MOVE;
        }
        $meldg .= '!'; $meldg = txtMarkg($meldg, 'erfolge');
        unset($_SESSION['wfm']['temp_memo'][$_GET['temp_m_einfg']]);
    } else {
        $meldg = txtMarkg(ERR_ERROR.L_SPEICHR_FEHLR.' ('.$_GET['temp_m_einfg'].')', 'fehler');
    }/*if(copy(source ==> dest)) */
    $GLOBALS['meldSlg'] .= $meldg.'<hr>'.PHP_EOL; $meldg = NULL;
}/*elseif(!empty($_GET['del_temp_memo'])) */
/** aktuelles Verzeichnis in ein vorsortiertes Array mit Verzeichnis- u. Datei-Namen packen */
function verzeichn_auslesen()
{
    $anzahl_dir = 0; $anzahl_file = 0;/*zaehler starten */
    $lies_mal_verz  = opendir($_SESSION['wfm']['v_pfad']);
    $zahler = 1000;/*mehr als 9.999 Dateien wird keiner in einem Ordner haben, oder? */
    $dirSammlr = array();
    while (FALSE !== ($filename = readdir($lies_mal_verz))) {
        if ($filename != '.' && $filename != '..' && !empty($filename)) {
            if (is_dir($_SESSION['wfm']['v_pfad'].'/'.$filename)) {
                $dirSammlr[strtolower($filename).$zahler] = '<option style="background-color:'.CLR_HINTGR_ALLG.';" title="'.L_ORDNR_UNTER_MIT
                    .'" value="'.$_SESSION['wfm']['v_pfad'].'/'.$filename.'">@@@/'.$filename.'</option>';
                $anzahl_dir++; $startMarkg = 'D';
            } else {
                $anzahl_file++; $startMarkg = 'F';
            }
            $zahler++;
            if (!empty($_SESSION['wfm']['sortg']) && $_SESSION['wfm']['sortg'] == 'typ') {
                if (!$datei_ext = strrchr($filename, '.')) {$datei_ext = 'zzz'; }
                $sortierg = $startMarkg.$datei_ext.strtolower($filename).$zahler;
            } elseif (!empty($_SESSION['wfm']['sortg']) && $_SESSION['wfm']['sortg'] == 'date') {
                $sortierg = $startMarkg.@filemtime($_SESSION['wfm']['v_pfad'].'/'.$filename).strtolower($filename).$zahler;
            } elseif (!empty($_SESSION['wfm']['sortg']) && $_SESSION['wfm']['sortg'] == 'size') {
                $sortierg = $startMarkg.@filesize($_SESSION['wfm']['v_pfad'].'/'.$filename).strtolower($filename).$zahler;
            } else {
                $sortierg = $startMarkg.strtolower($filename).$zahler;
            }
            $files[$sortierg] = $filename;
        }/*if($filename != '.' || $filename != '..') */
    }/*while (FALSE !== ($filename = readdir($lies_mal_verz))) */
    closedir($lies_mal_verz);/*nach Verzeichnis-Auslesen wieder schliessen! */
    $tr = ''; $zahl = '';
    if ($anzahl_dir != 0)  {
        $zahl .= $anzahl_dir.' '.L_ORDNER; $tr = ' / ';
        ksort($dirSammlr);
        define('SELEBX_UNTER_ORDNER',  '<optgroup label="'.L_ORDNR_UNTER_MIT.'">'
                                    .implode('', $dirSammlr).SEL_OPT_LEER.'</optgroup>');
    }
    if ($anzahl_file != 0) { $zahl .= $tr.$anzahl_file.' '.L_DATEIN; }
    if ($anzahl_dir == 0 && $anzahl_file == 0) { $zahl .= L_ORDNR_LEER; }
    $files[$zahl] = '..';
    if (!empty($_SESSION['wfm']['sortaufab']) && $_SESSION['wfm']['sortaufab'] == 'DESC') {
        krsort($files);
    } else {
        ksort($files);
    }
    return $files;
}/*function verzeichn_auslesen() => aktuelles Verzeichnis im Array! */
function discInfo()
{
    $a1 = disk_total_space($_SESSION['wfm']['v_pfad']);/*Gesamt-Bytes */
    $a = lesbare_dateigroesse($a1, 3);
    $a2 = disk_free_space($_SESSION['wfm']['v_pfad']);/*freier Speicherplatz */
    return strong(LW_1_GROESSE.$a.LW_3_FREI.lesbare_dateigroesse($a2, 3).LW_2_BELEGT.lesbare_dateigroesse(($a1 - $a2), 3), 'Partition-Info!');
}/*ENDE: function discInfo() */

/** Zusammensetzen der Options fuer die Selectbox zum Verzeichniswechseln */
function aktVerzPfad()
{
    $pfadRootVerz = ' / ROOT';
    if(strlen($_SESSION['wfm']['v_pfad']) < 2){
        $opSelbx = '<option value="0" title="'.L_ORDNR_ROOT.'">'.$pfadRootVerz.'</option>';
        $navig_link_2 = '<strong title="'.L_ORDNR_ROOT.'"> ROOT /</strong>';
        $lw = $pfadRootVerz;
    } else {
        $lw = '';
        if(substr($_SESSION['wfm']['v_pfad'], strlen($_SESSION['wfm']['v_pfad']) - 1) == '/'){
            $_SESSION['wfm']['v_pfad'] = substr($_SESSION['wfm']['v_pfad'], 0, strlen($_SESSION['wfm']['v_pfad']) - 1);
        }
        $pfad_in_link = explode('/', $_SESSION['wfm']['v_pfad']);
        $loppzaehler = 0;
        $navig_link_1 = ''; $navig_link_2 = '';
        $opSelbx = '';
        $anzahl_pfad_in_link = count($pfad_in_link) - 1;
        $vorzeichen = ' . ';

        foreach($pfad_in_link as $arr_inh) {
            if (!empty($arr_inh)) {

                if ($loppzaehler > 0) {
                    /*Nur der erste Loop faellt hier nicht rein. */
                    $navig_link_1 .= '/'.$arr_inh;

                    $vorzeichenRoh = str_pad('', $loppzaehler, '/', STR_PAD_LEFT);
                    $vorzchnFertig = str_replace('/', $vorzeichen, $vorzeichenRoh);
                    $txt = $vorzchnFertig
                        .'/'.htmlentities($arr_inh);
                } else {
                    /*Nur der erste Loop faellt hier rein: */
                    $navig_link_1 .= $arr_inh;
                    $lw = $arr_inh;
                    $txt = htmlentities($arr_inh);
                }

                if ($loppzaehler < $anzahl_pfad_in_link) {
                    $verzLetzes = WECHSL_ORDNR.': *'.$arr_inh.'*';
                    $opSelbx .= '<option value="'.($navig_link_1).'">'.$txt.'</option>';
                    $navig_link_2 .= '<a href="'.SELF_LINK.'&amp;abbr=1&amp;verzns='.urlencode($navig_link_1).'" title="'.$verzLetzes.'">'.htmlentities($arr_inh).'</a>/';
                    $navig_link_0 = $navig_link_1;
                } else {
                    $opSelbx .= '<option value="#" selected="selected" title="you are here!" '
                        .'style="font-weight: bold; color:'.CLR_HINWS.'; background-color:'.CLR_HINTGR_HINW.';">'
                        .$txt.VIER_LEER_X_2.' ('.L_AKTUELL.')</option>';
                    $navig_link_2 .= '<strong title="'.L_ORDNR_AKTUELL.'">'.htmlentities($arr_inh).'/</strong>';
                }
            }
            $loppzaehler++;
        }/*foreach() */
        if (!empty($vorzchnFertig)) {
            $vorznSubfolder = $vorzchnFertig.$vorzeichen;
        } else {
            $vorznSubfolder = $vorzeichen;
        }
        if (empty($navig_link_0)) { $navig_link_0 = '/'; }
        $opSelbx = '<optgroup label="'.L_ORDNR_AKTUELL.'">'
            .(defined('OS_SYSTEM') && OS_SYSTEM == 'unix' ?
                '<option value="/" title="'.L_ORDNR_GO_ROOT.'">'.$pfadRootVerz.'</option>'
                : '')
            .$opSelbx.'</optgroup>';
        $navig_link_2 = (defined('OS_SYSTEM') && OS_SYSTEM == 'unix' ?
                '<a href="'.SELF_LINK.'&amp;abbr=1&amp;verzns=/" title="'.L_ORDNR_GO_ROOT.'"><strong>/</strong></a>' : '')
            .$navig_link_2.(!empty($verzLetzes) ? VIER_LEER_X_2.'<a href="'.SELF_LINK.'&amp;abbr=1&amp;verzns='.urlencode($navig_link_0)
                .'" title="'.L_ORDNR_BACK.' ('.$verzLetzes.')" class="img_link">'.icon_anz('on_top').'</a>' : '');

        $verzNachOben = (!empty($verzLetzes) ? VIER_LEER_X_2.'<a href="'.SELF_LINK.'&amp;abbr=1&amp;verzns='.urlencode($navig_link_0)
            .'" title="'.L_ORDNR_BACK.' ('.$verzLetzes.')" class="img_link">'.icon_anz('on_top').'</a>' : '');
    }/*else ==> if() */
    define('ZUSAETZL_PFAD_ZUR_NAVI', $navig_link_2);
    return array($opSelbx, $lw, $verzNachOben, $vorznSubfolder);
}/*function */
if (empty($_GET['no_list'])) {
    $arr_files = verzeichn_auslesen();
}
/** Leiste Verzeichnisse und Icons */
function verzLeiste()
{
    define('ICON_LEISTE_VERZ', VIER_LEER_X_2.'<a href="'.SELF_LINK.'&amp;ordner=neu&amp;no_list=1&amp;abbr=1" title="'.L_ORDNR_NEU.'..." class="img_link">'
                             .icon_anz('folder_new').'</a>'.(acc_link() != FALSE ? VIER_LEER_X_2.acc_link() : '').VIER_LEER_X_2.'<a class="img_link" '
                             .(!defined('FAVO_AKTIV') ? 'title="'.L_FAVO_ERSTELLN.'" href="'.SELF_NAME.'?favos=1&amp;abbr=1" onclick="return confirm(\''.L_FAVO_ERSTELLN.'\n\n'.$_SESSION['wfm']['v_pfad'].'\n\n'.L_FRAG_ALLG.'\')">'.icon_anz('anker')
                                 : 'title="'.L_FAVO_FERTIG.'" href="javascript:alert(\''.L_FAVO_FERTIG.'\\n\\n'.$_SESSION['wfm']['v_pfad'].'\');">'.icon_anz('anker_vorh')).'</a>');

    $selbx = aktVerzPfad();
    return form_kopf('laufwerkauswahl', '', '', '', 'get', ' style="width: 100%"')
        .$selbx[2].VIER_LEER_X_2
        .'<noscript><input type="submit" name="lw_submit" value="'.L_LW_WECHSLN.'"></noscript>'
        .'<select name="verzns" id="id_lw" size="1" style="width: 44%; vertical-align: top; background-color: '.CLR_HINTGR_SELBX_KOPF.';" onchange="changeFoldr();">'
        .$selbx[0]
        .(defined('SELEBX_UNTER_ORDNER') ? str_replace('@@@', $selbx[3], SELEBX_UNTER_ORDNER) : '')
        .lw_box($selbx[1]).'
       </select>'
        .VIER_LEER_X_2.ICON_LEISTE_VERZ.'</form>';
}/*ENDE: function */

/** Aendern des Passwortes in dieser Datei */
function passwort_aendern()
{
    $txt_fertig = '';
    if (defined('AUFRUF_VOM_WOANDERS')) {
        $txt = L_HINWS.L_NOT_INCLUDE.' '.helpLink('wfm_pw_aendern');
        $txt_fertig = txtMarkg($txt, 'hinweis2', '');
        return $txt_fertig.txtMarkg(PW_AENDRN, 'hinweis2', '', 'h1');
    }
    return $txt_fertig.form_kopf().txtMarkg(PW_AENDRN.':').'
<fieldset>
  <legend>'.PW_AENDRN.'
  '.VIER_LEER_X_2.helpLink('wfm_pw_aendern').'</legend>
  <label for="label_oldpw">'.PW_ALTES.':</label>'.DREI_LEER.'
  <input type="text" name="oldpw" value="" id="label_oldpw" style="width:20em;" maxlength="25" placeholder="'.PW_AKTUELLS.'" autofocus required>
  <br><label for="label_newpw01">'.PW_NEUES.':</label>
  <input type="text" name="newpw01" value="" id="label_newpw01" style="width:20em;" maxlength="25" placeholder="'.PW_NEUES.'" required>
  ('.PW_HINWEIS.')<br><label for="label_newpw02">'.PW_NEUES.':</label>
  <input type="text" name="newpw02" value="" id="label_newpw02" style="width:20em;" maxlength="25" placeholder="'.L_WIEDRHLG.': '.PW_NEUES.'" required>
  ('.L_BESTAETIGG.' / '.L_WIEDRHLG.')<br>'.ABBR_ZURUECKSETZEN.'
  <input type="submit" name="pw_speichern" id="pw_speichern" value="'.L_SAVE.' - '.PW_AENDRN.'" style="width:22em;">
  '.txtMarkg(L_HINWS.PW_HINWEIS).'
</fieldset>
</form>';
}/*function passwort_aendern() */
if (!empty($_POST['newpw01']) && !empty($_POST['newpw02'])
    && !empty($_POST['oldpw']) && $_POST['oldpw'] != $_POST['newpw01']) {
    $login_arry = all_users(); $userNow = base64_encode($_SESSION['wfm']['user_now']);
    $passwd_user = $login_arry[$userNow];
    if (hash('sha512', $_POST['oldpw'], false) == $passwd_user) {
        if ($_POST['newpw01'] == $_POST['newpw02']) {
            if (strlen($_POST['newpw01']) > 5) {
                if (is_file(USER_DATEI)) {
                    $userDaten = NULL;
                    foreach ($login_arry as $login_key => $login_wert) {
                        $userDaten .= '\''.$login_key.'\' => \''.(base64_encode($_SESSION['wfm']['user_now']) != $login_key ?
                                $login_wert :  hash('sha512', $_POST['newpw01'], false)).'\','.PHP_EOL;
                    }/*ENDE: foreach */
                    datei_schreiben(USER_DATEI, savePassw($userDaten, $userNow));
                    $meldg = txtMarkg(PW_MELDG_SAVE, 'erfolge');
                } else {
                    $_GET['pw_aendern'] = 1; $meldg = txtMarkg(ERR_ERROR.PW_MELDG_NOT_SAVE, 'fehler');
                }
            } else {
                $_GET['pw_aendern'] = 1; $meldg = txtMarkg(ERR_ERROR.PW_HINWEIS, 'fehler');
            }/*else ==> if (strlen($_POST['newpw01']) > 7) */
        } else {
            $_GET['pw_aendern'] = 1; $meldg = txtMarkg(ERR_ERROR.PW_KONTROLLE, 'fehler');
        }/*else ==> if() */
    } else {
        $_GET['pw_aendern'] = 1; $meldg = txtMarkg(ERR_ERROR.PW_KONTR_ALT, 'fehler');
    }/*else ==> if (!empty($_POST['label_ol... */
}/*if(!empty($_POST['pw_speichern']) && !em... */
function savePassw($userDaten,$user='???'){
    return '<?php'.PHP_EOL
        .'/** ----------------------------------------------------------------+'.PHP_EOL
        .' * Die Usernamen und Passwoerter koennen beliebig erweitert werden. |'.PHP_EOL
        .' * Ein Programm zur Kodierung von Username in Base64 und            |'.PHP_EOL
        .' * Passwort in SHA-2 finden Sie im Toolbereich der Website-vdM.de:  |'.PHP_EOL
        .' *    https://wfm.website-vdm.de/ =>                                |'.PHP_EOL
        .' *     Link: "Hilfe für die Erstellung der Zugangskennung im WFM"   |'.PHP_EOL
        .' *                                                                  |'.PHP_EOL
        .' * Wichtig: Sie koennen das Passwort auch ueber die Funktion        |'.PHP_EOL
        .' * "Passwort aendern" in der Auswahlbox (oben links) aendern.       |'.PHP_EOL
        .' *                                                                  |'.PHP_EOL
        .' * Array-Reihenfolge: base64("USERNAME") => sha512("PASSWORT")     */'.PHP_EOL
        .'function all_users(){'.PHP_EOL.'  return array('.PHP_EOL.$userDaten.');'.PHP_EOL
        .'}/* Last Update: '.date('d.m.Y').', '.date('H:i').' h from "'.$user.'" */'.PHP_EOL;
}/*Funktionen "passwort_aendern()" zum Aende... */
/*START: Funktionen zum Umbenennen der WFM-Datei selbst */
function wfm_umbenenn_form()
{
    if (defined('AUFRUF_VOM_WOANDERS')) {
        $txt = L_HINWS.L_NOT_INCLUDE.' '.helpLink('wfm_selbst_umbenennen');
        $txt_fertig = txtMarkg($txt, 'hinweis2', '');
        return $txt_fertig.txtMarkg(L_UMBENENN.': '.NAME_ANWDG.'-'.L_DATEI.' '.L_SELF, 'hinweis2', '', 'h1');
    }
    return form_kopf().txtMarkg(L_UMBENENN.': '.NAME_ANWDG.'-'.L_DATEI.' '.L_SELF).'
    <fieldset>
      <legend>'.L_UMBENENN.': '.NAME_ANWDG.'-'.L_DATEI.' ('.SELF_NAME.')'
        .VIER_LEER_X_2.helpLink('wfm_selbst_umbenennen').'</legend>
      <br><br><label for="label_new_name">'.L_NEU_NAME.':&nbsp;</label>
      <input type="text" name="new_name" value="'.SELF_NAME.'" id="label_new_name" style="width:20em;" maxlength="255" placeholder="'.L_AKTUELL.': '.SELF_NAME.'" required>
      <br><br>'.ABBR_ZURUECKSETZEN.'<input type="submit" name="wfm_umbennen" value="'.NAME_ANWDG.' '.  strtolower(L_UMBENENN).'" style="width:20em;">
    </fieldset>
  </form>';
}/*function wfm_umbenenn_form() */
if (!empty($_POST['wfm_umbennen']) && !empty($_POST['new_name'])) {
    $neue_name = trim($_POST['new_name']);
    if (empty($neue_name) || $neue_name != SELF_NAME) {
        /*Fuer Dateinamen sind folgende Zeichen nicht erlaubt: < > ? " : | \ / * LEER */
        if (preg_match('/^[a-zA-Z0-9-_+]*\.[a-zA-Z0-9]{3,5}+$/', $neue_name)) {
            rename(WO_LIEGT_WFM.SELF_NAME, WO_LIEGT_WFM.$neue_name);
            if (@header('location: '.$neue_name.'?neuer=name') == FALSE) {
                $meldg = txtMarkg('<a href="'.$neue_name.'">'.L_ERFOLGRCH.' '.L_DATEI.' "'.htmlentities($neue_name).'" '.L_UMBENN_GO.'</a>');
            }
        } else {
            $meldg = txtMarkg(ERR_ERROR.L_UNGUELTG_ZEICHN.' ('.$neue_name.')', 'fehler');
        }/*else ==> if (preg_match('^[0-9a-zA-Z]([-_.]?[0... */
    }
}
if (!empty($_GET['neuer']) && $_GET['neuer'] == 'name') {
    $meldg = txtMarkg(L_UMBENENN_OK, 'hinweis2');
}/*ENDE: Umbenennen des WFM-Datei */

/** Markiernung von Hinweis-Texten */
function txtMarkg($txt, $farbschema = FALSE, $weiteres = FALSE, $typ_h = 'h2')
{
    switch ($farbschema) {
        case 'erfolge':
            $style = 'style="color : '.CLR_ERFOLG.';" '; break;
        case 'fehler':
            $style = 'style="color : '.CLR_FEHLER.'; background-color: '.CLR_HINTGR_HINW.';" '; break;
        case 'hinweis2':
            $style = 'style="color : '.CLR_HINWS.'; background-color: '.CLR_HINTGR_HINW.';" '; break;
        default: /*ehem. 'hinweise' jetzt als Standart */
            $style = 'style="color : '.CLR_HINWS.';" ';
    }
    return PHP_EOL.'<'.$typ_h.' '.$style.$weiteres.'>'.$txt.'</'.$typ_h.'>'.PHP_EOL;
}/*function txtMarkg() */
function strong($val, $title=NULL) {
    return '<strong'.(!empty($title) ? ' title="'.$title.'"' : '').'>&raquo;&nbsp;'.$val.'&nbsp;&laquo;</strong>';
}

/** HTML-Kopf fuer fast jede Seite */
function html_begin($log_ok_meldg = '', $kopf_ausblenden = FALSE)
{
    global $meldg;
    $wert_html_begin = '<!DOCTYPE html>
<html lang="'.AAA_SPRACH_KUERZL.'">
<!-- (c)2000-'.JAHR.', '.base64_decode(AUTR).', '.base64_decode(A_W_WFM).' -->
<head><meta http-equiv="expires" content="0">
<meta http-equiv="content-type" content="text/html; charset='.CODIERG.'">
<title>'.NAME_ANWD_K.'-v'.VERSION.' '
        .(defined('MELDG_AKTION') ? '['.MELDG_AKTION.']' : ',')
        .' &copy; '.JAHR.', '.base64_decode(AUTR).'</title>
<meta name="description" content="Der *'.NAME_ANWDG.'* (PHP-Tool), wird bereitgestelt durch '.base64_decode(AUTR).' ('.base64_decode(A_WEB).')">
<meta name="keywords" lang="de" content="WebSite-vdM, '.base64_decode(AUTR).', Marcel vdM, PHP-Tool *'.NAME_ANWDG.'* ('.NAME_ANWD_K.')">
<meta name="copyright" content="'.base64_decode(AUTR).' - '.base64_decode(A_W_WFM).'">
<meta name="author" content="'.base64_decode(AUTR).' ('.base64_decode(A_WEB).', 2000-'.JAHR.'">
<meta name="author" content="Marcel vdM ('.base64_decode(A_WEB).', 2000-'.JAHR.'">
<link rev="made" href="mailto:webfilemanager@'.base64_decode(A_WEB).'">
<meta http-equiv="content-language" content="'.AAA_SPRACH_KUERZL.'">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta name="robots" content="nofollow">
<meta name="revisit-after" content="never">
<link rev="start" href="./" title="Home Page">
<link rel="icon" type="image/ico" href="'.SELF_LINK.'&amp;imgFile=FAVICON_ICO_16x16&amp;imgDisply=ICO"><!-- favicon.ico -->
<link rel="shortcut icon" type="image/x-icon" href="'.SELF_LINK.'&amp;imgFile=FAVICON_ICO_16x16&amp;imgDisply=ICO"><!-- favicon.ico -->
<style type="text/css" media="all">
html, body, table, a{ margin: 0; padding: 0; }
html,body{ color: '.CLR_FONT_ALLG.';
    background-color:'.CLR_HINTGR_ALLG.';
    font-family: Arial, Helvetica, sans-serif;
    font-size:0.9em; }
a{ color: '.CLR_FONT_ALLG.'; background-color:'.CLR_HINTGR_ALLG.'; }
a:hover{ color:'.CLR_HINTGR_ALLG.'; background-color: '.CLR_FONT_ALLG.'; }
a.img_link, a.img_link:hover{ color:#000; verical-align: bottom; background:none; }
a.headlink{ background-color: '.CLR_HINTGR_HINW.'; }
h1{ font-size:1.6em; font-weight:bold;
    margin: 0px; padding: 10px 0px 0px 0px; }
h2{ font-size:1.4em; font-weight:bold; }
h3{ font-size:1.2em; font-weight:bold; }
h4{ font-size:1.1em; font-weight:bold; }
h5{ font-size:0.95em; font-weight:bold; }
p{ font-size:1em; }
li{ font-size:1em; font-weight:bold; }
b, strong, label{ font-weight:bold; }
table{ font-size:1em;
    background-color: '.CLR_HINTGR_HINW.'; }
th,td{ color:'.CLR_FONT_ALLG.';
    background-color: '.CLR_HINTGR_ALLG.'; }
th.head{ color:'.CLR_HINWS.';
    background-color: '.CLR_HINTGR_HINW.'; }
hr {background-color: '.CLR_FONT_2.';/* Mozilla 1.4 */
    color: '.CLR_FONT_2.';          /* IE 6        */
    border: '.CLR_FONT_2.';        /* Opera 7.11  */
    height: 1px; }
fieldset { border: 2px inset '.CLR_HINWS.'; }
legend { background-color: '.CLR_HINTGR_HINW.';
    color:'.CLR_HINWS.'; border: '.CLR_FONT_2.';
    font-weight: bold; }
form { display: table; margin: 0px; padding-top: 0px; }
input, select, textarea{ color: '.CLR_FONT_2.'; }
  :-moz-placeholder {color:#ddd;}
  ::-webkit-input-placeholder {color:#ddd;}
textarea{ font-size:1.2em; }
.bemerkg{ font-size:0.8em; color: '.CLR_FONT_ALLG.';}
</style>
<script type="text/javascript">
function CheckAll(){
    if(document.uebergabeform.checker){
        var c = document.uebergabeform.checker.checked;
    }
    for (var i=0;i<document.uebergabeform.elements.length;i++){
        var e = document.uebergabeform.elements[i];
        if(e.name == \'files[]\') e.checked = c;
    }
}
function NoCheck(){
    document.uebergabeform.checker.checked = 0;
    alert(\''.str_replace('\'', '\\\'', L_DELETE_NOT_FOUND).'\');
}
function AufUndZuKlappen(el){
    if(!el)return false;
    var orgEl = el;
    while(el && (el=el.nextSibling) ) if( el.nodeType==1 ) break;
    if(!el||!el.style)return false;
    var bActive = el.style.display!="block";
    el.style.display = bActive ? "block" : "none";
    orgEl.className = bActive ? "active" : "";
    return false
}
function GoToUrl(x) {
  if(x == "#") {
    document.forms[0].reset(); document.forms[0].elements[0].blur();
    return;
  } else {
    parent.location.href = x;
    document.forms[0].reset(); document.forms[0].elements[0].blur();
  }
}
function hinweisen() {
    var fund = 0;
    if (document.uebergabeform.select_action.options[document.uebergabeform.select_action.selectedIndex].value == "0") {
        document.uebergabeform.select_action.selectedIndex = 0;
    } else {
        for (var i = 0; i < document.uebergabeform.elements.length; i++){
            var e = document.uebergabeform.elements[i];
            if(e.name == \'files[]\' && document.uebergabeform.elements[i].checked == 1) fund++;
        }
        if (fund == 0)  alert("'.str_replace('\'', '\\\'', L_KEIN_DATEI_GEWAEHLT).'");
    }
    return fund;
}
function aktiontesten() {
    x = hinweisen();
    if (x != 0) {
        check = confirm("'.str_replace('\'', '\\\'', L_WOLLEN_SIE_WIRKL).'\n\n '.str_replace('\'', '\\\'', L_HINWS).'" + x + " '.L_AUSGEW_DATEI.'!");
        if (check == false) { return false; } else { return true; }
    } else { return false; }
}
function changeFoldr() {
    y = document.laufwerkauswahl.verzns.value;
    if (y == \'#\' || y == \'0\') {
        document.laufwerkauswahl.reset(); document.laufwerkauswahl.verzns.blur(); return false;
    } else {
        document.laufwerkauswahl.submit();
    }
}
</script></head>
<body><a id="top" style="position:absolute; top:0em;"></a>';
    if (!empty($_SESSION['wfm']['user_now']) && empty($kopf_ausblenden)) {
        $selectb_favos = (!empty($_SESSION['wfm']['user_now']) ? favo_selectbox() : '');
        $homeUrl = (defined('STANDD_ORT')? STANDD_ORT : WO_LIEGT_WFM);
        $wert_html_begin .= '
<table style="'.HEAD_POS.'top:0em; width:100%;" cellspacing="1" cellpadding="1">
<!-- Start Zeile 1 -->
    <tr>
      <td style="white-space: nowrap; width: 25%; text-align: left; background-color:'.CLR_HINTGR_HINW.';">'
            .'<form action="'.SELF_NAME.'?" method="get"><input type="hidden" name="abbr" value="1">'
            .'<noscript><input type="submit" name="quick_submit" value="ok"></noscript>'
            .'<select name="quick_links" id="id_quick_links" size="1"  style="vertical-align: top; background-color: '.CLR_HINTGR_SELBX_KOPF.';" '
            .'onchange="GoToUrl(this.form.quick_links.options[this.form.quick_links.options.selectedIndex].value);">
    '.selBox_opt('#', L_FUNKTN.' / '.L_AKTION_WAEHLN.'...').'
    <optgroup label="'.L_SICHERHT.'">'
            .selBox_opt(SELF_NAME.'?logout=1', L_AUSLOGGN.': *'.$_SESSION['wfm']['user_now'].'*')
            .selBox_opt('#', '- - - - - - - - - - - - - - - - - - - - - ')
            .selBox_opt(SELF_NAME.'?pw_aendern=1', PW_AENDRN)
            .selBox_opt(SELF_NAME.'?self_umbenennen=1', NAME_ANWD_K.'-'.L_DATEI.' '.  lcfirst(L_UMBENENN))
            .selBox_opt(SELF_NAME.'?update=1', L_CHECK_UPDATES).'
  '.selBox_opt().'</optgroup>'
            .(empty($_SESSION['wfm']['rename']['files']) ? '
    <optgroup label="'.L_DATEI.' - '.L_FUNKTN.':">
        <option value="'.upload_link(1, ' ', '&amp;no_list=1').DATEI_UPLOAD_MEHRERE.'</option>
        <option value="'.upload_link(12,' ', '&amp;no_list=1').DATEI_UPLOAD_MEHR_EINZL.'</option>
        '.selBox_opt(SELF_NAME.'?create=file', L_NEU_DAT_ERSTELLN.'...').'
        '.selBox_opt(SELF_NAME.'?deBase64=1', DECODE_BASE64).selBox_opt().'
      </optgroup>'.PHP_EOL.'<optgroup label="'.L_ORDNER.' - '.L_FUNKTN.':">'
                .selBox_opt(SELF_NAME.'?ordner=neu&amp;no_list=1', L_ORDNR_NEU)
                .(empty($selectb_favos) ? selBox_opt(SELF_NAME.'?favos=1', L_FAVO_ERSTELLN) : '')
                .(acc_link() != FALSE ? selBox_opt(SELF_NAME.'?accss='.urlencode($_SESSION['wfm']['v_pfad']), HTACCESS_SCHUTZ) : '')
                .selBox_opt(SELF_NAME.'?direktVerz=1&amp;no_list=1', L_VERZ_DIRKT.' . . .')
                .selBox_opt().'</optgroup>'.PHP_EOL.'<optgroup label="'.L_VERSCHDNES.':">'
                .(defined('OS_SYSTEM') && OS_SYSTEM == 'unix' ?
                    (!empty($_SESSION['wfm']['rechte']) && $_SESSION['wfm']['rechte'] == 'anzeigen' ?
                        selBox_opt(SELF_NAME.'?rechte=ausblenden', RECHTE_OWNR_GROUP.' '.lcfirst(L_AUSBLENDN))
                        : selBox_opt(SELF_NAME.'?rechte=anzeigen', RECHTE_OWNR_GROUP.' '.lcfirst(L_ANZEIGN))
                    ) : '')
                .selBox_opt(SELF_NAME.'?groesse_verz=WFM_SIZE_ALL_FOLDR', L_ORDNR_GROESS_ERM)
                .selBox_opt(SELF_NAME.'?suche=1', L_SUCH_DATEI_U_ORDNR)
                .(!empty($_SESSION['wfm']['such_res']) ? selBox_opt(SELF_NAME.'?abbr=1', L_SUCH_ENDE) : '')
                .selBox_opt().'</optgroup>' : '')
            .'<optgroup label="'.L_ENTW_INFO.':">'
            .selBox_opt(SELF_NAME.'?otherparams=1', L_SERVER_INFO)
            .selBox_opt(SELF_NAME.'?constans=1', L_KONSTA_INFO)
            .selBox_opt(SELF_NAME.'?phparams=1', L_PHP_INFO.' ('.L_PHP_EINST.')').selBox_opt()
            .'</optgroup>'.PHP_EOL.'<optgroup label="'.L_WFM_SYSTEM.'">'
            .selBox_opt(SELF_NAME.'?abbr=1', L_ZURKSETZN.' / '.L_ABBRECHN.'!')
            .(defined('DEV_MODE') ? selBox_opt(SELF_NAME.'?dev=9', L_DEV_MODE_AUS) : selBox_opt(SELF_NAME.'?dev=1', L_DEV_MODE_AN))
            .selBox_opt()
            .'</optgroup>'.PHP_EOL.'<optgroup label="'.L_WFM_INTERN.'">'
            .selBox_opt('https://www.'.base64_decode(A_WEB).'/index.php?navi=kontakt&amp;email_betreff=Direkt-Link%20aus%20dem%20'.NAME_ANWDG, L_WFM_INT_MAIL)
            .selBox_opt('https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=1024160', L_WFM_INT_SPEND)
            .selBox_opt(LINK_FACEBOOK, L_WFM_INT_FACEB).selBox_opt()
            .'</optgroup>
  </select><input type="hidden" name="a" value="'.RAND.'">  
  <noscript><input type="submit" name="submitter" value="ok"></noscript></form></td>

    <td style="white-space: nowrap; width: 10%; text-align: center; background-color:'.CLR_HINTGR_HINW.';"><a href="#ganz_unten" title="'.L_SEITE_UNTN.'">'.strong(NACH_UNTEN).'</a>'
            .VIER_LEER_X_2.'<a href="#top" title="'.L_SEITE_OBN.'">'.strong(NACH_OBN).'</a></td>

   <td style="white-space: nowrap; width: 60%; text-align: center; background-color:'.CLR_HINTGR_HINW.';">
    <form action="'.SELF_NAME.'?" method="get"><input type="hidden" name="abbr" value="1"><input type="hidden" name="a" value="'.RAND.'">
    '
            .(!empty($selectb_favos) && empty($_SESSION['wfm']['rename']['files']) ?
                '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$selectb_favos.'<noscript><input type="submit" name="quick_submit" value="ok"></noscript>' : '')
            .'</form></td>

    <td style="white-space: nowrap; width: 5%; text-align: center; background-color:'.CLR_HINTGR_HINW.';">'.HEAD_P_LINK.'</td>

  </tr>
<!-- Start Zeile 2 -->
  <tr>
      <td style="white-space: nowrap; text-align: left; background-color:'.CLR_HINTGR_HINW.';">
      <a href="'.SELF_LINK.'" title="RELOAD - '.NAME_ANWDG.' ('.NAME_ANWD_K.' '.VERSION.') '.  lcfirst(L_RELOAD).'" class="headlink" style="margin-left: 1em;">'.VDM_WFM_LOGO.'</a>
  '.(defined('DEV_MODE') ? VIER_LEER_X_2.'<a href="'.SELF_LINK.'&amp;dev=9" style="font-weight:bold; color:'.CLR_FEHLER.';">'.L_DEV_MODE_OFF_KRZ.'</a>' : '').'</td>

    <td style="white-space: nowrap; text-align: center; background-color:'.CLR_HINTGR_HINW.';">'
            .helpLink('', strong(HILFE_BUCH), '', 1, ' class="headlink"').'</td>

   <td style="white-space: nowrap; text-align: center; background-color:'.CLR_HINTGR_HINW.';">'
            .verzLeiste()
            .'</td>

   <td style="white-space: nowrap; text-align: center; background-color:'.CLR_HINTGR_HINW.';">'
            .($_SESSION['wfm']['v_pfad'].'/' == STANDD_ORT ?
                icon_anz('home_now') : '<a href="'.SELF_LINK.'&amp;abbr=1&amp;favos=wfm9'.$homeUrl.'" title="'.L_ORDNR_FAVO_HOME.'... ('.$homeUrl
                .')" class="img_link">'.icon_anz('home').'</a>').'</td>
  </tr>
<!-- Ende Zeile 2 -->
</table>';
    } else {
        $wert_html_begin .= '<br><br><br><div style="text-align: center;"><a href="'.SELF_LINK.'" class="headlink">'
            .VDM_WFM_LOGO.'</a></div>';
        $meldg = null;/* Nicht angemeldet, keine Meldungen ausgeben! */
    }/*ENDE: else ==> if(empty($kopf_ausblenden) || !empty($_SESSION['wfm']['user_now'])) */
    return $wert_html_begin.'
    <div align="center" '.(empty($kopf_ausblenden) ? 'style="'.HEAD_TOP_PLUS.'"' : '').'><noscript>'
        .txtMarkg(L_HINWS.L_JAVASCR_EIN, 'hinweis2').'</noscript>'
        .(!empty($meldg) ? $meldg : '').PHP_EOL;
}/*function html_begin(...) (HTML-Head (Kopf) in fast jeder Seite) */
/** HTML-foot (Seiten-Ende) in fast jeder Seite */
function htmlbodyende()
{
    /* define('L_WFM_WIKIPEDIA', '<a href="https://de.wikipedia.org/wiki/Webfilemanager" title="Infos: wikipedia.org ('.L_NEU_FENSTER.')" target="_blank" style="color: '.CLR_HINWS.'; background-color: '.CLR_HINTGR_HINW.';">'.NAME_ANWDG.'</a>');*/
    define('L_WFM_WIKIPEDIA', '<a href="https://webfilemanager.website-vdm.de" title="Infos ('.L_NEU_FENSTER.')" target="_blank" style="color: '.CLR_HINWS.'; background-color: '.CLR_HINTGR_HINW.';">'.NAME_ANWDG.'</a>');
    if (defined('VDM_STOPPUHR_START_ZEIT')) { $wfm_stoppuhr = new WFM_vdM_Stoppuhr(); }
    return '</div><!-- ENDE: div align="center" -->
    <br>'.(!empty($_SESSION['wfm']['user_now']) ? '<br style="clear:both;">'
            .(defined('VERZ_ELEM_ANZ') && VERZ_ELEM_ANZ > TREFFER_ANZ_NACHOBEN ?
                '<div style="position:fixed;bottom: 0px; left: 0px;"><a href="#top" style="display:block; text-align:center; padding: 2px 7px 2px 7px; text-decoration:none; color: '
                .CLR_HINWS.' ;background-color: '.CLR_HINTGR_HINW.'; font-weight: bold;">'.strong(NACH_OBN).'</a></div>' : '').'
<table align="center" width="100%" cellspacing="1" cellpadding="5" border="0" style=" text-align: center;">
  <tr valign="top">
    <td style="white-space: nowrap; text-align: left;"><a href="#top" id="ganz_unten">'.strong(NACH_OBN).'</a></td>
    <td style="white-space: nowrap;">'.helpLink('', strong(NAME_ANWD_K.'-'.HILFE_BUCH), '', 1).'</td>
    <td style="white-space: nowrap;"><a href="'.SELF_LINK
            .'&amp;phparams=1" target="_blank" title="'.L_PHPINFO_LG.' ('.L_NEU_FENSTER.')">'
            .strong(L_PHP_INFO).'</a></td>
    <td style="white-space: nowrap;"><a href="'
            .SELF_LINK.'&amp;otherparams=1">'.strong(L_SERVER_INFO).'</a></td>
    <td style="white-space: nowrap; text-align: right;"><a href="'.SELF_LINK.'&amp;logout=1">'
            .strong(L_AUSLOGGN.' *'.$_SESSION['wfm']['user_now'].'*').'</a></td>
   </tr>
  </table>'.(defined('ZUM_SCHLUSS_HINW_SPRACHE') ? '<div style="background-color: '.CLR_HINTGR_HINW.'; float: left; padding: 4px 1px 1px 7px;"><strong>'.ZUM_SCHLUSS_HINW_SPRACHE.'</strong></div>' : '')
            .'<div style="background-color: '.CLR_HINTGR_HINW.'; float: right; padding: 4px 7px 1px 1px;">
  <a style="background-color: '.CLR_HINTGR_HINW.'; color: '.CLR_HINWS.'; text-decoration:none; font-size:0.9em;" href="https://www.'.base64_decode(A_WEB).'/index.php?navi=kontakt&amp;email_betreff='.urlencode('Direkt-Link aus dem '.NAME_ANWDG.' v'.VERSION.' vom '.VERS_DATE)
            .'">&copy; '.JAHR.', '.base64_decode(AUTR).' ('.NAME_ANWD_K.' v'.VERSION.')</a></div>'
            .(defined('VDM_STOPPUHR_START_ZEIT') ? $wfm_stoppuhr->zeigeVerbrauchteZeit(3, 1) : '') : '').'
  <div style="text-align:center; color: '.CLR_HINWS.'; background-color: '.CLR_HINTGR_HINW.'; vertical-align: middle; padding: 1px 1px 15px 2px;">'
        .txtMarkg(str_replace('###WFM###', L_WFM_WIKIPEDIA, SCHLUSS_SATZ_1).' <a href="'.LINK_FACEBOOK.'" target="_blank" title="zu facebook.com '.DREI_GROESSR.' Facebook-Fan-Site (like it / gef&auml;llt mir ;-) ) ('.L_NEU_FENSTER.')">(facebook)</a>, '
                  .SCHLUSS_SATZ_2.'<br><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=1024160" title="PayPal ('.L_NEU_FENSTER.')" target="_blank" style="color: '.CLR_HINWS.'; background-color: '.CLR_HINTGR_HINW.';">'
                  .SCHLUSS_SATZ_4.'<img src="'.SELF_LINK.'&amp;imgFile=KAFFEE_AUSGEBN_203x17&amp;imgDisply=PNG" border="0" hspace="1" alt="DONATE" align="absbottom"></a> - '.L_DANK, NULL, NULL, 'h5').'</div></body></html>';
}/*function htmlbodyende() - HTML-Seiten-Ende in fast jeder Seite */
if (!empty($_GET['logout'])) {
    echo html_begin($log_ok_meldg).$log_meldg.htmlbodyende(); exit();
} elseif (!empty($form_fuer_login)) {/*Ausgabe fuer das Login-Feld */
    echo html_begin($log_ok_meldg).$form_fuer_login.htmlbodyende(); exit();
} elseif (!strpos($log_ok_meldg, '<iframe') === FALSE) {
    echo html_begin($log_ok_meldg, 'NO')
        .'<br><br><br><br><br>'.$log_ok_meldg
        .'<br><br><br><br><br><br><br><br><br>'
        .htmlbodyende(); exit();
    /*Nur beim erfolgreichen Login: Versionshinweise */
} elseif (!empty($_GET['update'])) {
    echo html_begin($log_ok_meldg).update_frame().htmlbodyende(); exit();
} elseif (!empty($_GET['pw_aendern'])) {
    echo html_begin($log_ok_meldg).passwort_aendern().htmlbodyende(); exit();
} elseif (!empty($_GET['self_umbenennen'])) {
    echo html_begin($log_ok_meldg).wfm_umbenenn_form().htmlbodyende(); exit();
} elseif (acc_link() != FALSE && (!empty($_GET['accss']) || !empty($_SESSION['wfm']['accss']))) {
    echo html_begin($log_ok_meldg).'<h2>'.ABBR_ZURUECKSETZEN.' | '.helpLink('htaccess', HILF_ZU_THEMA.' "'.HTACCESS_SCHUTZ.'"').'</h2>';
    include_once $_SESSION['wfm']['accss_tool'];
    echo txtMarkg(ABBR_ZURUECKSETZEN).htmlbodyende(); exit();
} elseif (!empty($_GET['code2base64'])) {
    echo html_begin($log_ok_meldg).encode_base64($_GET['code2base64']).PHP_EOL.htmlbodyende(); exit();
} elseif (!empty($_REQUEST['deBase64'])) {
    echo html_begin($log_ok_meldg).decodeBase64($_REQUEST['deBase64']).PHP_EOL.htmlbodyende(); exit();
} elseif (!empty($_GET['phparams'])) {
    phpinfo(); exit();
} elseif (!empty($_GET['constans'])) {
    define('VERZ_ELEM_ANZ', 66); echo html_begin($log_ok_meldg).txtMarkg(ABBR_BEGINN.VIER_LEER_X_2.strong(L_KONSTA_INFO.' (Constants)'))
        .strong('PHP: get_defined_constants(true)').'<br><br>'.array_anzeigen(get_defined_constants(true), 'CONSTANTS')
        .txtMarkg(ABBR_BEGINN).htmlbodyende(); exit();
} elseif (!empty($_GET['otherparams'])) {
    define('VERZ_ELEM_ANZ', 66); echo html_begin($log_ok_meldg)
        .txtMarkg(ABBR_BEGINN.VIER_LEER_X_2.strong(L_SERVER_INFO).'<hr>'.discInfo())
        .array_anzeigen($_SERVER, '$_SERVER').array_anzeigen($_REQUEST, '$_REQUEST')
        .array_anzeigen($_COOKIE, '$_COOKIE').array_anzeigen($_ENV, '$_ENV').array_anzeigen($_GET, '$_GET')
        .array_anzeigen($_SESSION, '$_SESSION').txtMarkg(ABBR_BEGINN).htmlbodyende(); exit();
} elseif (!empty($_SESSION['wfm']['rename']['files'])) {
    define('VERZ_ELEM_ANZ', 66); echo html_begin($log_ok_meldg)
        .'<h2>'.ABBR_ZURUECKSETZEN.' | '.helpLink('datei_umbenennen2', HILF_ZU_THEMA.' "'.UMBENN_VIELE_DATEIN.'"').'</h2>';
    if (!empty($_GET['wieder']) && $_GET['wieder'] == 'herstellen') {
        $_SESSION['wfm']['rename']['wiederherst'] = 'NEIN';
        $_SESSION['wfm']['rename']['files_Pause'] = $_SESSION['wfm']['rename']['files'];
        require_once rename_save();
        $_SESSION['wfm']['rename']['files'] = $rename_sicherg;
        $inhalt_dateien = ren_vorschau();
        $_POST['ren_subm_view'] = UMBENN_WIEDERHERST;
        /*echo 'alles klar'; */
    } elseif (!empty($_GET['wiederherst']) && $_GET['wiederherst'] == 'ende'
        && !empty($_SESSION['wfm']['rename']['files_Pause'])) {
        $_SESSION['wfm']['rename']['wiederherst'] = NULL;
        $_SESSION['wfm']['rename']['files'] = $_SESSION['wfm']['rename']['files_Pause'];
        $_SESSION['wfm']['rename']['files_Pause'] = NULL;
        $_POST['select_action'] = 'file_rename';
        $inhalt_dateien = ren_vorschau();
    } elseif (!empty($_SESSION['wfm']['rename']['files']) && empty($_POST['ren_subm_done'])) {
        $inhalt_dateien = ren_vorschau();
    } else {
        $inhalt_dateien = '';/*$inhalt_dateien = ren_vorschau(); */
    }
    if (!empty($_POST['ren_subm_view']) && $_POST['ren_subm_view'] == SAVE_EINSTELL) {
        ren_speicher_inhalt($_POST, NULL);/*Wiederherstellungsdateien ueberschreiben! */
        echo txtMarkg(L_ERFOLGRCH.SAVE_EINST_OK, 'hinweis2');
    }
    if (!empty($_POST['select_action']) && $_POST['select_action'] == 'file_rename' && file_exists(rename_save())) {
        /*Wenn Einstellungen-Sicherungs-Datei vorhanden, dann diese laden! */
        require rename_save();
        $_POST['ren_subm_view'] = L_VRSCHAU;/*oder 'Umbenennen' */
        $_POST['ren_name'] = @$rename_einstellg['ren_name'];
        $_POST['ren_na_case'] = @$rename_einstellg['ren_na_case'];
        $_POST['ren_na_txt'] = @$rename_einstellg['ren_na_txt'];
        $_POST['ren_na_repl'] = @$rename_einstellg['ren_na_repl'];
        $_POST['ren_na_del'] = @$rename_einstellg['ren_na_del'];
        $_POST['ren_na_ers1'] = @$rename_einstellg['ren_na_ers1'];
        $_POST['ren_na_ers2'] = @$rename_einstellg['ren_na_ers2'];
        $_POST['ren_na_count'] = @$rename_einstellg['ren_na_count'];
        $_POST['ren_na_cou_repl'] = @$rename_einstellg['ren_na_cou_repl'];
        $_POST['ren_na_cou_start'] = @$rename_einstellg['ren_na_cou_start'];
        $_POST['ren_na_cou_erhoe'] = @$rename_einstellg['ren_na_cou_erhoe'];
        $_POST['ren_na_cou_stelln'] = @$rename_einstellg['ren_na_cou_stelln'];
        $_POST['ren_ext'] = @$rename_einstellg['ren_ext'];
        $_POST['ren_ex_case'] = @$rename_einstellg['ren_ex_case'];
        $_POST['ren_ex_txt'] = @$rename_einstellg['ren_ex_txt'];
        $_POST['ren_ex_repl'] = @$rename_einstellg['ren_ex_repl'];
        $_POST['ren_sortg'] = @$rename_einstellg['ren_sortg'];
        if (!empty($rename_sicherg) && is_array($rename_sicherg) && empty($_SESSION['wfm']['rename']['wiederherst'])) {
            echo '<hr>'.txtMarkg(AKTION_RUECKGG.'
              <br>"<a href="'.SELF_LINK.'&amp;wieder=herstellen">'.UMBENN_WIEDERHERST.'...</a>".');
        }
    } elseif (!empty($_POST['select_action']) && $_POST['select_action'] == 'file_rename') {
        $_POST['ren_subm_view'] = L_VRSCHAU;
        $_POST['ren_name'] = '1';/*Grundsaetzliche Behandlung */
        $_POST['ren_na_case'] = '';
        $_POST['ren_na_txt'] = 'neu';
        $_POST['ren_na_repl'] = 'ende';
        $_POST['ren_na_del'] = 'loesch_nix';
        $_POST['ren_na_ers1'] = 'ersetze_mich';
        $_POST['ren_na_ers2'] = 'durch_nichts';
        $_POST['ren_na_count'] = '0';/*Grundsaetzliche Behandlung */
        $_POST['ren_na_cou_repl'] = 'anfang';
        $_POST['ren_na_cou_start'] = '1';
        $_POST['ren_na_cou_erhoe'] = '1';
        $_POST['ren_na_cou_stelln'] = '3';
        $_POST['ren_ext'] = '0';/*Grundsaetzliche Behandlung */
        $_POST['ren_ex_case'] = 'klein';
        $_POST['ren_ex_txt'] = 'txt';
        $_POST['ren_ex_repl'] = 'replace';
        $_POST['ren_sortg'] = 'no';
    } else {
        if (empty($_POST['ren_subm_view'])) {
            foreach($_SESSION['wfm']['rename']['post'] as $mein_schluessel => $wert) {
                $_POST[$mein_schluessel] = $_SESSION['wfm']['rename']['post'][$mein_schluessel];
            }
        }/*im Gegenstueck (am Ende) wird das Post-Array gefuellt in $_SESSION['wfm']['rename']['post'] */
    }

    echo (!empty($div_meldungen) ? txtMarkg($div_meldungen, 'hinweis2') : '');

    if (empty($_POST['ren_subm_done'])
        && (!empty($_POST['ren_subm_view']) || $_SESSION['wfm']['rename'])) {
        if (!empty($_SESSION['wfm']['rename']['wiederherst'])) {
            echo '<hr>'.txtMarkg(UMBENN_WIEDERHERST.'!<br>
              <a href="'.SELF_LINK.'&amp;wiederherst=ende">'.L_ABBRECHN.'</a>');
        } else {
            $checken = ' checked="checked"'; $selecten = ' selected="selected"';
            echo txtMarkg(UMBENN_KRITER.':').'
        '.form_kopf().'
        <table cellspacing="2" cellpadding="2" border="0">
            <tr>
              <th style="text-align: left;" colspan="2">'.txtMarkg('
                <input type="checkbox" name="ren_name" id="la_ren_name" value="1" '
                                                                                                                                      .(empty($_POST['ren_name']) ? '' : $checken).'>
                <label for="la_ren_name">'.DREI_LEER.DREI_KLEINR.DREI_LEER.UMBENN_DATEINAMN.'</label>',
                                                                   'hinweis2', '', 'div').'</th>
            </tr><tr>
              <th style="white-space: nowrap; text-align: right;">'
                .'<label for="la_ren_na_case">'.KLEIN_GROSS_SCHRBG.':</label></th>
              <td style="white-space: nowrap;">'
                .'<select name="ren_na_case" id="la_ren_na_case" style="width:20em;">
                    <option value="">'.L_VRAENDG_KEINE.'</option>
                    <optgroup label="'.KLEIN_GROSS_SCHRBG.'">
                        <option value="klein"'.(!empty($_POST['ren_na_case']) && $_POST['ren_na_case'] == 'klein' ?
                    $selecten : '').'>'.KLEIN_SCHREIBN.'</option>
                        <option value="gross"'.(!empty($_POST['ren_na_case']) && $_POST['ren_na_case'] == 'gross' ?
                    $selecten : '').'>'.GROSS_SCHREIBN.'</option>
                    </optgroup>
                </select></td>
            </tr></tr>
              <th style="white-space: nowrap; text-align: right;">'
                .'<label for="la_ren_na_txt">'.UMBENN_NAME_NEU.':</label></th>
              <td style="white-space: nowrap;">'
                .'<input type="text" name="ren_na_txt" value="'.$_POST['ren_na_txt'].'" '
                .'id="la_ren_na_txt" style="width:20em" placeholder="'.UMBENN_NAME_NEU.'?"></td>
            </tr></tr>
              <td style="white-space: nowrap; text-align: right;" colspan="2">'
                .'<label for="la2_ren_na_repl">'.UMBENN_NEU_ANFNG.':</label>
                <input type="radio" name="ren_na_repl" id="la2_ren_na_repl" value="anfang" '
                .(empty($_POST['ren_na_repl']) || $_POST['ren_na_repl'] == 'anfang' ? $checken : '').' >
                '.VIER_LEER_X_2.'
                <label for="la3_ren_na_repl">'.UMBENN_NEU_ENDE.':</label>
                <input type="radio" name="ren_na_repl" id="la3_ren_na_repl" value="ende" '
                .(!empty($_POST['ren_na_repl']) && $_POST['ren_na_repl'] == 'ende' ? $checken : '').' >
                '.VIER_LEER_X_2.'
                <label for="la1_ren_na_repl">'.UMBENN_NEU_ERSETZ.':</label>
                <input type="radio" name="ren_na_repl" id="la1_ren_na_repl" value="replace" '
                .(!empty($_POST['ren_na_repl']) && $_POST['ren_na_repl'] == 'replace' ? $checken : '').'></td>
            </tr></tr>
              <th style="white-space: nowrap; text-align: right;">'
                .'<label for="la_ren_na_del">'.UMBENN_ZEICH_LOESCH.':</label></th>
              <td style="white-space: nowrap;">'
                .'<input type="text" name="ren_na_del" value="'.$_POST['ren_na_del'].'" '
                .'id="la_ren_na_del" style="width:20em" placeholder="'.L_LOESCHN.'?"></td>
            </tr></tr>
              <th style="white-space: nowrap; text-align: right;">'
                .'<label for="la_ren_na_ers1">'.UMBENN_ZEICH_ERSTZ.':</label></th>
              <td style="white-space: nowrap;">'
                .'<input type="text" name="ren_na_ers1" value="'.$_POST['ren_na_ers1'].'" '
                .'id="la_ren_na_ers1" style="width:8em" placeholder="'.Z_BSPL.' 1">'
                .' <label for="la_ren_na_ers2">'.UMBENN_ZEICH_DURCH.'</label> '
                .'<input type="text" name="ren_na_ers2" value="'.$_POST['ren_na_ers2'].'" '
                .'id="la_ren_na_ers2" style="width:8em" placeholder="'.Z_BSPL.' 2"></td>
            </tr></tr><td colspan="2">&nbsp;</td></tr></tr>
              <th style="white-space: nowrap; text-align: left;" colspan="2">'.txtMarkg('
                <input type="checkbox" name="ren_na_count" id="la_ren_na_count" value="1" '
                                                                                                                                                                      .(empty($_POST['ren_na_count']) ? '' : $checken).'>
                <label for="la_ren_na_count">'.DREI_LEER.DREI_KLEINR.DREI_LEER.UMBENN_ZAEHLR_EINF.'</label>',
                                                                                        'hinweis2', '', 'div').'</th>
            </tr></tr>
              <td style="white-space: nowrap; text-align: right;" colspan="2">'
                .'<label for="la2_ren_na_cou_repl">'.UMBENN_NEU_ANFNG.':</label>
                <input type="radio" name="ren_na_cou_repl" id="la2_ren_na_cou_repl" value="anfang" '
                .(empty($_POST['ren_na_cou_repl']) || $_POST['ren_na_cou_repl'] == 'anfang' ? $checken : '').' >
                '.VIER_LEER_X_2.'
                <label for="la3_ren_na_cou_repl">'.UMBENN_NEU_ENDE.':</label>
                <input type="radio" name="ren_na_cou_repl" id="la3_ren_na_cou_repl" value="ende" '
                .(!empty($_POST['ren_na_cou_repl']) && $_POST['ren_na_cou_repl'] == 'ende' ? $checken : '').' >
                '.VIER_LEER_X_2.'
                <label for="la1_ren_na_cou_repl">'.UMBENN_NEU_ERSETZ.':</label>
                <input type="radio" name="ren_na_cou_repl" id="la1_ren_na_cou_repl" value="replace" '
                .(!empty($_POST['ren_na_cou_repl']) && $_POST['ren_na_cou_repl'] == 'replace' ? $checken : '').'></td>
            </tr></tr>
              <td style="white-space: nowrap; text-align: left;" colspan="2">'
                .'<label for="la_ren_na_cou_start">'.UMBENN_ZAEHLR_START.'</label>
                <input type="text" name="ren_na_cou_start" value="'.$_POST['ren_na_cou_start'].'" id="la_ren_na_cou_start" '
                .'id="la_ren_na_cou_start" style="width:2em" placeholder="1?">,&nbsp;
                <label for="la_ren_na_cou_erhoe">'.UMBENN_ZAEHLR_ERHOEH.'</label>
                <input type="text" name="ren_na_cou_erhoe" value="'.$_POST['ren_na_cou_erhoe'].'" id="la_ren_na_cou_start" '
                .'id="la_ren_na_cou_start" style="width:2em" placeholder="1?">,&nbsp;
                <label for="la_ren_na_cou_stelln">'.UMBENN_ZAEHLR_STELLN.':</label>
                <select name="ren_na_cou_stelln" id="la_ren_na_cou_stelln" style="width:3em;">
                        ';
            for ($zaehlr2 = 1; $zaehlr2 <= 6; $zaehlr2++) {
                echo '<option value="'.$zaehlr2.'"'.
                    (!empty($_POST['ren_na_cou_stelln']) && $_POST['ren_na_cou_stelln'] == $zaehlr2 ? $selecten : '').'>'.$zaehlr2.'</option>'.PHP_EOL;
            }
            echo '</select></td>
            </tr></tr><td colspan="2">&nbsp;</td></tr></tr>
              <th style="white-space: nowrap; text-align: left;" colspan="2">'.txtMarkg('
                <input type="checkbox" name="ren_ext" id="la_ren_ext" value="1" '
                                                                                                         .(empty($_POST['ren_ext']) ? '' : $checken).'>
                <label for="la_ren_ext">'.DREI_LEER.DREI_KLEINR.DREI_LEER.UMBENN_EXT_UMB.'</label>',
                                                                                        'hinweis2', '', 'div').'</th>
            </tr></tr>
              <th style="white-space: nowrap; text-align: right;">'
                .'<label for="la_ren_ex_case">'.KLEIN_GROSS_SCHRBG.':</label></th>
              <td style="white-space: nowrap;">'
                .'<select name="ren_ex_case" id="la_ren_ex_case" style="width:20em;">
                    <option value="">'.L_VRAENDG_KEINE.'</option>
                    <optgroup label="'.KLEIN_GROSS_SCHRBG.'">
                        <option value="klein"'.(!empty($_POST['ren_ex_case'])
                && $_POST['ren_ex_case'] == 'klein' ? $selecten : '').'>'.KLEIN_SCHREIBN.'</option>
                            <option value="gross"'.(!empty($_POST['ren_ex_case'])
                && $_POST['ren_ex_case'] == 'gross' ? $selecten : '').'>'.GROSS_SCHREIBN.'</option>
                    </optgroup>
                </select></td>
            </tr></tr>
              <th style="white-space: nowrap; text-align: right;">'
                .'<label for="la_ren_ex_txt">'.UMBENN_EXT_NAME.':</label></th>
              <td style="white-space: nowrap;">'
                .'<input type="text" name="ren_ex_txt" value="'.$_POST['ren_ex_txt'].'" '
                .'id="la_ren_ex_txt" style="width:20em" placeholder="'.UMBENN_EXT_LABL.'"></td>
            </tr></tr>
              <td style="white-space: nowrap; text-align: right;" colspan="2">'
                .'<label for="la2_ren_ex_repl">'.UMBENN_NEU_ANFNG.':</label>
                <input type="radio" name="ren_ex_repl" id="la2_ren_ex_repl" value="anfang" '
                .(empty($_POST['ren_ex_repl']) || $_POST['ren_ex_repl'] == 'anfang' ? $checken : '').' >
                '.VIER_LEER_X_2.'
                <label for="la3_ren_ex_repl">'.UMBENN_NEU_ENDE.':</label>
                <input type="radio" name="ren_ex_repl" id="la3_ren_ex_repl" value="ende" '
                .(!empty($_POST['ren_ex_repl']) && $_POST['ren_ex_repl'] == 'ende' ? $checken : '').' >
                '.VIER_LEER_X_2.'
                <label for="la1_ren_ex_repl">'.UMBENN_EXT_ERSTZ.':</label>
                <input type="radio" name="ren_ex_repl" id="la1_ren_ex_repl" value="replace" '
                .(!empty($_POST['ren_ex_repl']) && $_POST['ren_ex_repl'] == 'replace' ? $checken : '').'></td>
            </tr></tr><td colspan="2">&nbsp;</td></tr></tr>
                <th style="white-space: nowrap; text-align: right;">'.txtMarkg(
                    '<label for="la_ren_sortgt">'.UMBENN_SORTG.':</label>', 'hinweis2', '', 'div').'</th>
                <td style="white-space: nowrap;">'
                .'<select name="ren_sortg" id="la_ren_sortg" style="width:20em;">
                            <option value="no">'.UMBENN_SORT_KEIN.'</option>
                            <option value="Dateiname_n"'.(!empty($_POST['ren_sortg'])
                && $_POST['ren_sortg'] == 'Dateiname_n' ? $selecten : '').'>'.DATEI_NAME.'</option>
                            <option value="Dateiname_r"'.(!empty($_POST['ren_sortg'])
                && $_POST['ren_sortg'] == 'Dateiname_r' ? $selecten : '').'>'.DATEI_NAME.' ('.SORT_RUECKW.')</option>
                        </select></td>
            </tr></tr><td colspan="2">&nbsp;</td></tr></tr>
                <th class="head" colspan="2">'
                .'<input type="submit" name="ren_subm_view" value="'.L_VRSCHAU.'" style="width:30em; font-weight: bold;"></th>
            </tr></tr><td colspan="2">&nbsp;</td></tr></tr>
                <th class="head" colspan="2">'
                .'<input type="submit" name="ren_subm_view" value="'.SAVE_EINSTELL.'" '
                .' style="width:30em; background-color: #ff9900; font-weight: bold;"></th>
            </tr></table>';
        }/*else ==> if(!empty($_SESSION['wfm']['rename']['wiederherst'])) */
        echo '</form>'.form_kopf().'
        <table cellspacing="1" cellpadding="6" border="0">
          <tr>
            <th style="white-space: nowrap;">'.UMBENN_ZAEHLER.':</th><th style="white-space: nowrap;">'.UMBENN_NAME_ALT.':</th>
            <th style="white-space: nowrap;">'.UMBENN_NAME_NEU.':</th><th style="white-space: nowrap;">'.L_AKTON.':</th>
          </tr>'.$inhalt_dateien.'<tr>
            <th class="head"  colspan="3">'
            .'<input type="submit" name="ren_subm_done" value="'.UMBENN_START.'" '
            .' style="padding: 6px 11px 6px 11px; color: #ffff99; background-color: #990000; font-size: 1.2em; font-weight: bold;"></th>
            <th><h2>'.helpLink('datei_umbenennen2').'</h2></th>
          </tr></table></form>';
    } elseif (!empty($_POST['ren_subm_done'])) {
        if (!empty($_SESSION['wfm']['rename']['wiederherst'])) {
            echo '<hr><h2>'.UMBENN_WIEDERHERST.'!(<a href="'.SELF_LINK.'&amp;wiederherst=ende">'.L_ABBRECHN.'!</a>)
                  </h2><hr>';
        }
        $samlg = ''; $zaehl_ren = 0;
        foreach ($_SESSION['wfm']['rename']['files'] as $name_alt => $name_neu) {
            $rueckg = ren_umbn_loop($name_alt, $name_neu);
            echo $rueckg[0];
            if (!empty($rueckg[1]) && !empty($rueckg[2])) {
                $samlg[$rueckg[2]] = $rueckg[1];
                $zaehl_ren++;
            }
        }/*foreach () */
        ren_speicher_inhalt(NULL, $samlg);
        echo txtMarkg(L_UMBENENN_OK.' ('.$zaehl_ren.' '.L_DATEIN.')!
             ('.ABBR_ZURUECKSETZEN.')');
    }/*else ==> if() */
    if (!empty($_GET['wieder']) && $_GET['wieder'] == 'herstellen') {
        /*NIX */
    } elseif (!empty($_POST['ren_subm_view'])) {
        $_SESSION['wfm']['rename']['post'] = array();
        foreach($_POST as $mein_schluessel => $wert) {
            $_SESSION['wfm']['rename']['post'][$mein_schluessel] = $_POST[$mein_schluessel];
        }
    }
    echo htmlbodyende(); exit();/* ENDE: Viele umbennenn */
} elseif (!empty($_GET['suche'])| !empty($_POST['suchwert'])) {
    echo html_begin($log_ok_meldg); suche();
    echo htmlbodyende(); exit();/*STOPP! */
} else {
    echo html_begin($log_ok_meldg);/*...sonst immer normalen HTML-Header schreiben */
    if (!empty($_SESSION['wfm']['such_res'])) {
        echo suchResult();
    } elseif (!empty($_GET['direktVerz'])) {
        echo '<br><br>'.form_kopf('direktVerz', false, false, false, 'get').'<input type="hidden" name="abbr" value="1">
       <strong>'.L_VERZ_DIRKT.': </strong><input type="submit" name="go" value="go">
       <br><input type="text" name="verzns" value="'
            .$_SESSION['wfm']['v_pfad'].'" style="width:77%;" placeholder="path..." autofocus required'
            .' onfocus="document.direktVerz.verzns.select();"></form><hr>';
        $verz_anlegen_nicht_anzeigen = 1;
        $dateidownload_nicht_anzeigen = 1;
    }
}/*if () (diverse Sonderseiten) */

/*START: Darstellung und Bearbeitung der Text-Datei */
if (!empty($_REQUEST['editor'])) {
    $_SESSION['wfm']['editor'] = $_REQUEST['editor'];
}
if (empty($_SESSION['wfm']['editor'])) {
    $_SESSION['wfm']['editor'] = 'text_input';/*default */
}
if (!empty($_POST['textspeichern'])
    && isset($_POST['teil_2']) && !empty($_POST['txt_zeil_nr'])) {
    $post_teil_2_kontr = (!empty($_POST['teil_2_kontr']) ? base64_decode($_POST['teil_2_kontr']) : '');
    $_GET['text_file'] = $_POST['text_file'];
    if ($_POST['teil_2'] != $post_teil_2_kontr) {
        $txt_zeil_nr = $_POST['txt_zeil_nr'];
        $post_teil_1 = (!empty($_POST['teil_1']) ? base64_decode($_POST['teil_1']).PHP_EOL : '');
        $post_teil_3 = (!empty($_POST['teil_3']) ? PHP_EOL.base64_decode($_POST['teil_3']) : '');
        $new_txt_inh = $post_teil_1.stripcslashes($_POST['teil_2']).$post_teil_3;
        /*START: Alle Leerzeichen am Ende werden entfernt */
        if (!empty($_POST['trim_end_zeile'])) {
            $zusatzInfo = '<br>('.LEER_ENTFERNT.')</strong>';
            $arrayInhalt = explode(PHP_EOL, $new_txt_inh);
            $array_new_txt_inh = NULL;
            foreach ($arrayInhalt as $eineZeile) {
                $array_new_txt_inh .= rtrim($eineZeile).PHP_EOL;
            }
            $new2_txt_inh = rtrim($array_new_txt_inh);
            /*Alle Leerzeichen am Zeilenende entfernt */
        } else {
            $zusatzInfo = NULL;
            $new2_txt_inh = rtrim($new_txt_inh);
        }
        if ($_POST['textspeichern'] == L_SAVE_AS) {
            $neuName = createFile(dateiNameFiltrn($_GET['text_file']), $new2_txt_inh); $_POST['save_close'] = 1;
            $zusatzInfo .= '<br><br>'.L_HINWS.' '.L_SAV_AS_HINW.'<br>'.DATEI_NAME.': <a href="'.SELF_NAME.'?rename='.urlencode($neuName).'">'.strong($neuName.' '.L_UMBENENN.'...').'</a>';
        }  else {
            datei_schreiben($_GET['text_file'], $new2_txt_inh);
        }
        $GLOBALS['meldSlg'] .= txtMarkg(' '.SAVE_EINST_OK.' '.$zusatzInfo, 'hinweis2');
        if($txt_zeil_nr != 999999 && empty($_POST['save_close'])){
            $GLOBALS['meldSlg'] .= ' <a href="#wotextedit" title="Jump to...">'.EDIT_IN_ZEILE.$txt_zeil_nr.'!</a>'.PHP_EOL;
        }
    } else {
        $GLOBALS['meldSlg'] .= txtMarkg(' '.NICHTS_VERAENDRT.' ! ', 'hinweis2');
    }
} elseif (!empty($_POST['speichernAbbr']) && !empty($_POST['text_file'])) {
    $_GET['text_file'] = $_POST['text_file'];
    $GLOBALS['meldSlg'] .= txtMarkg(' '.L_ABBRUCH.': '.EDIT_NOT_IN_ZEILE.$txt_zeil_nr.'! ', 'hinweis2');
}
function operations($check_editor=FALSE, $abbr=FALSE, $zahl=1, $minim=NULL)
{
    return '<input type="submit" name="textspeichern" value="'.L_SAVE.'" style="width: 7em;">
    <span class="bemerkg">'.DREI_LEER.'<label for="l'.$zahl.'save_close">'.L_SAVE.' &amp; '.SCHLIESSN.'</label>
    <input type="checkbox" id="l'.$zahl.'save_close" name="save_close" value="1"></span>
    <span class="bemerkg">'.VIER_LEER_X_2.'
    <label for="l'.$zahl.'zeige_textarea">'.EDIT_TEXTAREA.'</label>
    <input type="checkbox" id="l'.$zahl.'zeige_textarea" name="editor" value="textarea" '.
        (!empty($check_editor) ? ' checked="checked"' : '').'>'.VIER_LEER_X_2.'
    <label for="l'.$zahl.'trim_end_zeile">'.EDIT_BLANKS_WEG.'</label>
    <input type="checkbox" id="l'.$zahl.'trim_end_zeile" name="trim_end_zeile" value="1"></span>'
        .VIER_LEER_X_2.(!empty($abbr) ? '<input type="submit" name="speichernAbbr" value="'.L_ABBRECHN.'">' : '<input type="submit" name="textspeichern" value="'.L_SAVE_AS.'">');
}/*function operations() */
/*ISO-8859-1; ISO-8859-15 */
function codeNew($inhlt) {
    $encode = substr(strtolower(CODIERG), 0, 3);
    if ($encode == 'utf') {
        return utf8_encode($inhlt);
    } elseif ($encode == 'iso') {
        return utf8_decode($inhlt);
    } else {
        return ($inhlt);
    }
}
function displCharset()/** Zukunftsmusik ;-) */
{
    echo 'QQQ'.$encode = substr(strtolower(CODIERG), 0, 3);
    if ($encode == 'iso') {
        $nextEncode = 'utf-8';
    } elseif ($encode == 'uft') {
        $nextEncode = 'reset';
    } else {
        $nextEncode = 'ISO-8859-1';
    }
    return ' <a href="'.SELF_LINK.'&amp;encode='.urlencode($nextEncode).'" title="Charset '.L_AENDRN.' in '.$nextEncode.'">['.(defined('CODIERG') ? CODIERG :$akt_charset).']</a>';
}
if (!empty($_GET['text_file']) && empty($_POST['save_close'])) {
    $last_inputfeld = '';
    echo (!is_writable($_GET['text_file']) ? txtMarkg(L_ACHTG.DATEI_SCHREIBSCHTZ.'!', 'hinweis2') : NULL);
    $dat_inhalt = @file($_GET['text_file']);
    $uebrschft = ABBR_BEGINN.VIER_LEER_X_2.L_DATEI.' '.strtolower(L_BEARBTN);
    if ($_SESSION['wfm']['editor'] != 'textarea') {
        $uebrschft .= ' <a href="'.SELF_LINK.'&amp;text_file='.urlencode($_GET['text_file']).'&amp;editor=textarea">... '.IN_TEXTAREA.',</a> '.PHP_EOL;
    }
    if ($_SESSION['wfm']['editor'] != 'input') {
        $uebrschft .= ''.DREI_LEER.'<a href="'.SELF_LINK.'&amp;text_file='.urlencode($_GET['text_file']).'&amp;editor=input">... '.IN_ZEILENWEISE.',</a> '.PHP_EOL;
        $anz_text_feld = 1;/*Einblenden verschiedener Seitenelemente */
    }
    $titelAnz = txtMarkg(L_DATEI.': \''.text_kuerzen($_GET['text_file'], 55, '...', 'vorne', 1)
        /*.displCharset() */
        , 'hinweis2');
    echo txtMarkg($uebrschft).$titelAnz;
    if (empty($anz_text_feld)) {
        echo form_kopf('textform', '', 1).'
           <input type="hidden" name="MAX_FILE_SIZE" value="99999999999">
           <table cellspacing="1" cellpadding="2" style="text-align: left;">'.PHP_EOL;
        $dateisammlg = ''; $txt_sammlg = ''; $zaehl_zeil = 1;
        foreach($dat_inhalt as  $eine_zeile) {
            $eine_zeile = str_replace(Chr(9), LEER.LEER.LEER.LEER, $eine_zeile);/*Tab gegen 4 LeerZ; */
            $bearb_link = '<a href="'.SELF_LINK.'&amp;text_file='.urlencode($_GET['text_file'])
                .'&amp;textedit='.$zaehl_zeil.'#wotextedit" title="'.L_ZEILE_BEARB.'...">';
            echo '<tr>
                 <th class="head" style="text-align: right; vertical-align: top;">'
                .$bearb_link.$zaehl_zeil.'</a></th>
                 <td style="vertical-align: top; background-color: '
                .((!empty($txt_zeil_nr) && $txt_zeil_nr == $zaehl_zeil) || (!empty($_GET['textedit'])
                    && $_GET['textedit'] == $zaehl_zeil) ? CLR_HINTGR_HINW.'; padding-top: 5em;" id="wotextedit"' : CLR_HINTGR_ALLG.';"' ).'>';
            if (!empty($_GET['textedit'])) {
                if (!empty($_GET['textedit']) && $_GET['textedit'] != $zaehl_zeil) {
                    $txt_sammlg .= codeNew($eine_zeile);
                }
                if (!empty($_GET['textedit']) && $_GET['textedit'] == $zaehl_zeil && empty($_GET['textadd'])) {
                    echo '<input type="hidden" name="text_file" value="'.$_GET['text_file'].'">
                              <input type="hidden" name="txt_zeil_nr" value="'.$zaehl_zeil.'">
                              <input type="hidden" name="teil_1" value="'.base64_encode(rtrim($txt_sammlg)).'">
                              <input type="hidden" name="teil_2_kontr" value="'.base64_encode($eine_zeile).'">
                              <textarea name="teil_2" autofocus style="color: '.CLR_HINWS.'; background-color: '.CLR_HINTGR_HINW.'; width: 99%;"'
                        .'>'.rtrim(str_replace('&nbsp;', LEER, htmlentities(codeNew($eine_zeile)))).'</textarea>
                             <br>'.operations('', 1, 2, 1).PHP_EOL;
                    $txt_sammlg = '';/*Variable leeren, um sie mit restl. Teil zu fuellen! */
                } else {
                    echo str_replace(LEER.LEER, '&nbsp; ', htmlentities(codeNew($eine_zeile)));
                }
                $last_inputfeld = '<input type="hidden" name="teil_3" value="'.base64_encode($txt_sammlg).'">';
            } else {
                echo str_replace(LEER.LEER, '&nbsp; ', htmlentities(codeNew($eine_zeile)));
            }/*else ==> if(!empty($_GET['textedit']) */
            echo '</td>
                 <td style="text-align: right; vertical-align: top;">'
                .$bearb_link.icon_anz('edit').'</a></td>
               </tr>'.PHP_EOL;
            $zaehl_zeil++;
        }/*foreach($dat_inhalt as  $eine_zeile) */
        define('VERZ_ELEM_ANZ', $zaehl_zeil);
        echo '</table>'.PHP_EOL.$last_inputfeld.'</form>'.PHP_EOL.$titelAnz;
    } else {
        $zeile_textarea = 33;/*Hoehe */
        echo form_kopf('datei_editor', '', 1).'
        <input type="hidden" name="MAX_FILE_SIZE" value="99999999999">
        <input type="hidden" name="text_file" value="'.$_GET['text_file'].'">
        <input type="hidden" name="txt_zeil_nr" value="999999">
        <input type="hidden" name="teil_1" value="">
        '.operations(1, '', 3).PHP_EOL;
        echo '<textarea autofocus name="teil_2" cols="300" rows="'.$zeile_textarea.'"
        style="width:99%; background-color: #ededed;">'.htmlentities(codeNew(@file_get_contents($_GET['text_file']))).'</textarea>
        '.PHP_EOL.'<input type="hidden" name="teil_3" value="">'.operations(1, '', 4)
            .'</form>'.PHP_EOL.$titelAnz;
    }
    echo htmlbodyende(); exit();
}/*if(!empty($_GET['wert_file'])) -Darstellung und Bearbeitung der Text-Datei */
/*START: Darstellung des Images */
if (defined('IMGFILE_GET')) {
    echo dateiUeberschrft(IMGFILE_GET).bildVorschau(IMGFILE_GET, '').PHP_EOL.htmlbodyende(); exit();
}
/*START: Zwischenspeicher (Idee: Klemmbrett aus Typo3) */
if (!empty($_POST['select_action']) && $_POST['select_action'] == 'file_copy' && !empty($_POST['files'])) {
    foreach ($_POST['files'] as $eineDatei) {
        $_SESSION['wfm']['temp_memo'][$eineDatei] =
            array('name' => $eineDatei, 'pfad' => $_SESSION['wfm']['v_pfad'], 'move' => 0);
    }
} elseif (!empty($_POST['select_action']) && $_POST['select_action'] == 'file_move' && !empty($_POST['files'])) {
    foreach ($_POST['files'] as $eineDatei) {
        $_SESSION['wfm']['temp_memo'][$eineDatei] =
            array('name' => $eineDatei, 'pfad' => $_SESSION['wfm']['v_pfad'], 'move' => 1);
    }} elseif (!empty($_GET['filecopy']) || !empty($_GET['filemove'])) {
    if(!empty($_GET['filecopy'])){
        $dateiname = $_GET['filecopy']; $dateimove = 0;
    } else {
        $dateiname = $_GET['filemove']; $dateimove = 1;
    }
    $_SESSION['wfm']['temp_memo'][$dateiname] =
        array('name' => $dateiname, 'pfad' => $_SESSION['wfm']['v_pfad'], 'move' => $dateimove);
}
if (!empty($_SESSION['wfm']['temp_memo']) && is_array($_SESSION['wfm']['temp_memo'])) {
    $temp_memo = '<br><table cellspacing="1" cellpadding="3" border="0">
        <tr><th class="head">&nbsp;</th>
            <th class="head">'.L_DATEIN.':</th>
            <th class="head">'.L_KOPIERN.'/'.L_AUSSCHNDN.'</th>
            <th class="head">'.QUELL_ORDNR.':</th>
            <th class="head">'.L_SPEICHR_AKTION.':</th>
        </tr>'.PHP_EOL; $memo_zahl = 0;
    foreach($_SESSION['wfm']['temp_memo'] as $arr_inhalt)
    {
        if (!empty($arr_inhalt['name'])) {
            $memo_zahl++;
            $linkStart = '<a class="img_link" href="'.SELF_LINK.'&amp;open=1&amp;temp_move_status='
                .urlencode($arr_inhalt['name']).'&amp;status=';
            if ($arr_inhalt['move'] == 1) {
                $linkSt2 = $linkStart.'9" title="';
                $wert_copy = $linkSt2.L_VRSCHIEBN.'/'.L_AUSSCHNDN.'">'.icon_anz('cut');
                $wert_move = $linkSt2.WECHSL_AKTION.L_VRSCHIEBN.'/'.L_AUSSCHNDN.' '.DREI_GROESSR.' '.L_KOPIERN.'">(&#990;)';
                $wertHinws = '<strong title="'.L_SPEICHR_HINW.'" style="color: '.CLR_HINWS.'">'.strtolower(L_AUSSCHNDN).'</strong>';
            } else {
                $linkSt2 = $linkStart.'1" title="';
                $wert_copy = $linkSt2.L_KOPIERN.'">'.icon_anz('copy');
                $wert_move = $linkSt2.WECHSL_AKTION.L_KOPIERN.' '.DREI_GROESSR.' '.L_VRSCHIEBN.'/'.L_AUSSCHNDN.'">(&#991;)';
                $wertHinws = strtolower(L_KOPIERN);
            }
            $temp_memo .= '<tr><th class="head">'.$memo_zahl.'</th>
                <th style="text-align: left;">'.htmlentities($arr_inhalt['name']).'</th>
                <td>'.$wertHinws.'
                    : '.$wert_copy.'</a>
                    '.$wert_move.'</a></td>
                <td><a href="'.SELF_LINK.'&amp;verzns='.urlencode($arr_inhalt['pfad']).'"'
                .' title="'.WECHSL_ORDNR.'...">'
                .htmlentities($arr_inhalt['pfad']).'</a></td>
                <td><a href="'.SELF_LINK.'&amp;del_temp_memo='.urlencode($arr_inhalt['name']).'&amp;open=1"
                       onclick="javascript:return confirm(\''.L_SPEICHR_EINE_WG_FRAGE.'\\n'
                .htmlentities($arr_inhalt['pfad']).'/'.htmlentities($arr_inhalt['name']).'\');" class="img_link">'
                .icon_anz('delete', 'title="'.L_SPEICHR_EINE_ENTF.'"').'</a>'.VIER_LEER_X_2
                .'<a href="'.SELF_LINK.'&amp;temp_m_einfg='.urlencode($arr_inhalt['name']).'&amp;open=1"
                    onclick="javascript:return confirm(\''.L_SPEICHR_EINFG_FRAGE.'\\n '
                .htmlentities($arr_inhalt['pfad']).'/'
                .htmlentities($arr_inhalt['name'])
                .'\');"
                    title="'.L_SPEICHR_ALLE_EINFUEGN.'" class="img_link">'
                .icon_anz('insert', 'title="'.L_SPEICHR_EINFUEGN.'"').'</a></td>
            </tr>'.PHP_EOL;
        }/*if(!empty($arr_inhalt['name'])) */
    }/*foreach($_SESSION['wfm']['temp_memo'] as $arr_inhalt) */
    $temp_memo .= '<tr><th class="head">&raquo;</th>
        <th colspan="5"><a href="'.SELF_LINK.'&amp;del_temp_memo=1" onclick="javascript:return confirm(\''
        .L_SPEICHR_LEERN_FRAG.'\');">'.strong(L_SPEICHR_LEEREN).' '
        .icon_anz('delete', 'title="'.L_SPEICHR_LEERN_ALL.'"').'</a>'.VIER_LEER_X_2
        .'<a href="'.SELF_LINK.'&amp;temp_m_einfg=1" onclick="javascript:return confirm(\''
        .L_SPEICHR_EINFGN_FRAG.'\');" title="'.L_SPEICHR_EINFUEGN.'">'
        .icon_anz('insert', 'title="'.L_SPEICHR_ALLE_EINFUEGN.'"')
        .' '.strong(L_SPEICHR_EINFGN_ALL).' </a>'
        .'</th>
       </tr>
     </table>';
    echo versteck_anzeigen(txtMarkg(L_SPEICHR_NAME.': '.$memo_zahl.' '.L_DATEIN.' ('.L_ANZEIGN.')', 'hinweis2', '', 'strong'),
                           $temp_memo, NULL, NULL, NULL, (!empty($_GET['open'])? 1 : NULL)).'
          <br><br>'.PHP_EOL;
}/*if(!empty($_SESSION['wfm']['temp_memo']) && is_array($_SESSION['wfm']['temp_memo'])) */
/*END: Zwischenspeicher (Idee: Klemmbrett aus Typo3) */
/** Universal-Ausgabe von Meldungen */
if (!empty($GLOBALS['meldSlg'])) {
    echo $GLOBALS['meldSlg'];
}
/*START: Hier beginnt die Ausgabe der Tabelle "Verzeichnisinhalt" */
echo PHP_EOL.ZUSAETZL_PFAD_ZUR_NAVI.form_kopf('uebergabeform').'
 <input type="hidden" name="pfad" id="id_pfad" value="'.$_SESSION['wfm']['v_pfad'].'">'.PHP_EOL;
/*Verzeichnisinhalt nur anzeigen, wenn $_GET['no_list'] leer! */
if (empty($_GET['no_list'])) {
    define('VERZ_ELEM_ANZ', count($arr_files) - 1);
    echo '<p><strong>'.L_INHALT.array_search('..', $arr_files).(defined('R_OWNER_WFM') ? ' '.R_OWNER_WFM : '').'</strong></p>'
        .'<table border="0" cellpadding="6" cellspacing="1" align="center">
        <tr><th class="head">'.(empty($_GET['rename']) ? selectbx_act()
            .'<hr><input type="checkbox" name="checker" id="checker" value="CHECK ALL"
                       onClick="javascript:CheckAll();"><label for="checker">'.DATEIN_MARKIER.'</label>'
            : ABBR_BEGINN).'</th>
            <th>'.sort_link(L_NAME, L_NAME, 'name').'</th>
            <th>'.sort_link(L_TYP, L_TYP, 'typ').'</th>
            <th style="white-space: nowrap;">'.sort_link(L_GROESS, L_GROESS, 'size')
        .(!empty($_GET['groesse_verz']) && $_GET['groesse_verz'] == 'WFM_SIZE_ALL_FOLDR' ?
            '<hr>'.verz_groesse_anzeigen($_SESSION['wfm']['v_pfad']) : '').'</th>
            <th>'.sort_link(LETZT_BEARBTG, LETZT_BEARBTG, 'date').'</th>'
        .(defined('R_OWNER_SP') ?
            '<th>'.OWNR_RECHT.'</th> <th>'.OWNR_OKTAL.'</th> <th>'.OWNR_SELF.'</th> <th>'.OWNR_GROUP.'</th>'
            : '').'
            <th title="'.L_PIXL.'-'.L_DIMENSN.': '.L_DIMENS_XY.'">'.L_PIXL.'<br>('.L_DIMENS_XY_KZ.')</th>
            <th title="'.L_AKTION_WAEHLN.'">'.L_SPEICHR_AKTION.'</th></tr>'.PHP_EOL;
    $bild_groesse_in_byte = 0; $zeile_verzeichn = ''; $zeile_dateien = ''; $zaehl = 0;
    foreach($arr_files as $verzeichnsInhalt)
    {
        $dateiName = $_SESSION['wfm']['v_pfad'].'/'.$verzeichnsInhalt;
        $dateityp_roh = (@filetype($dateiName) ? filetype($dateiName) : L_UNBEKANNT);
        $last_edit = (@filemtime($dateiName) ? date('d.m.Y H:i', filemtime($dateiName)) : L_UNBEKANNT);
        if ($verzeichnsInhalt != '' && $verzeichnsInhalt != '.' && $verzeichnsInhalt != '..') {
            if (!empty($_GET['rename']) && $_GET['rename'] == $verzeichnsInhalt) {
                $formUmbnennen = '
                    <input type="hidden" name="old_name" value="'.$_GET['rename'].'">
                    <input type="text" name="new_name" value="'.$_GET['rename'].'" autofocus style="width:60%" required>
                    <input type="submit" name="rename" value="OK" id="'.$_GET['rename'].'">'
                    .txtMarkg('<a href="'.SELF_LINK.'" title="'.L_ABBRECHN.'">'.strong(UMBENN_NICHT.'...').'</a>');
            } else {
                $formUmbnennen = 0;/*damit die Variable beim naechsten Loop leer ist! */
            }
            $sprung = $zaehl++.'spr'.substr(md5(dateiNameFiltrn($verzeichnsInhalt)), 0, 11);
            $sprgLink = (!empty($sp5) ? $sp5 : 'top');
            $sp5 = (!empty($sp4) ? $sp4 : NULL); $sp4 = (!empty($sp3) ? $sp3 : NULL);
            $sp3 = (!empty($sp2) ? $sp2 : NULL); $sp2 = (!empty($sp1) ? $sp1 : NULL);
            $sp1 = $sprung;
            if ($dateityp_roh == 'dir') {
                $zeile_verzeichn .= '<tr id="'.$sprung.'">
                        <th style="text-align:left;white-space: nowrap;" colspan="2">';
                $link_ordner_wechseln = '<a href="'.SELF_LINK.'&amp;verzns='.urlencode($dateiName).'"
                                            style="color: '.CLR_FONT_2.';" class="img_link" title="'.WECHSL_ORDNR.'...">';
                if(!empty($formUmbnennen)){
                    $zeile_verzeichn .= ''.$formUmbnennen.'</th>';
                } else {
                    $zeile_verzeichn .= '&nbsp;&laquo;&raquo;'.DREI_LEER.$link_ordner_wechseln.$verzeichnsInhalt.'</a></th>';
                }
                $zeile_verzeichn .= '<td align="center" style="color: '.CLR_FONT_2.'; white-space: nowrap;">'.getDateityp($dateityp_roh).'</td>
                   <td align="center" style="color: '.CLR_FONT_2.'; white-space: nowrap;">'
                    .(!empty($_GET['groesse_verz']) && ($_GET['groesse_verz'] == $dateiName || $_GET['groesse_verz'] == 'WFM_SIZE_ALL_FOLDR') ? verz_groesse_anzeigen($dateiName) :
                        '<a href="'.SELF_LINK.'&amp;groesse_verz='.urlencode($dateiName).'#'.$sprgLink.'" style="color: '.CLR_FONT_2.';" '
                        .'title="'.L_ORDNER.'-'.L_DIMENSN.' '.L_ERMITTLN.'..." class="img_link">'.L_ERMITTLN.'</a>'
                    ).'</td>
                   <td align="center" style="color: '.CLR_FONT_2.'; white-space: nowrap;">'.$last_edit.'</td>';
                if (defined('R_OWNER_SP')) {
                    $zeile_verzeichn .= rechte_rwx_zellen($dateiName);
                }
                $zeile_verzeichn .= '<td align="center"> - - - </td>
                   <td align="center" style="white-space: nowrap;">'
                    .$link_ordner_wechseln.icon_anz('folder_open').'</a>'
                    .'&nbsp;|&nbsp;'.icon_anz('space')
                    .'&nbsp;|&nbsp;'.(acc_link() != FALSE ? acc_link('gif', $verzeichnsInhalt) : icon_anz('space'))
                    .'&nbsp;|&nbsp;'.icon_anz('space')
                    .'&nbsp;|&nbsp;'.umbenennen_link($verzeichnsInhalt, icon_anz('rename'), L_ORDNER, $sprgLink)
                    .'&nbsp;|&nbsp;'.(count(glob($dateiName.'/*')) > 0 ?
                        (!empty($_GET['del_voll_verz']) && $_GET['del_voll_verz'] == $verzeichnsInhalt ?
                            '<input type="hidden" name="loesch_name_orig" value="'.$verzeichnsInhalt.'"><hr>
                             <div align="left">'.strong(L_ACHTG).'<br>'.strong(L_ORDNR_NOT_LEER).'<br>'.strong(L_FRAG_LOESCHN).'<br><br>
                             <input autofocus type="text" name="loesch_name_bestaetigt" value="" style="width:111px" placeholder="'.L_PFLICHTFLD.'" required>
                             <input type="submit" name="del_not_empty" value="'.L_LOESCHN.'" '
                            .'onclick="javascript:return confirm(\'&#128266; - '.L_FRAG_LOESCHN.' - &#128239;\n\n'.EINGABN_IHR.'\n&#128073; \''
                            .'+document.uebergabeform.loesch_name_bestaetigt.value+\' &#128072;\');">
                             <br>'.LOESCH_FRAG
                            .txtMarkg(helpLink('verzeichnis_vorsichtig_loeschen', HILF_ZU_THEMA.'...', HILF_ZU_THEMA.' *'.L_ORDNER.' '
                                                                                .lcfirst(L_LOESCHN).'* ('.L_ORDNR_NOT_LEER.')', 1), '', '', 'h3')
                            .txtMarkg(ABBR_BEGINN, '', '', 'h3')
                            .'</div>'.PHP_EOL
                            : '<a href="'.SELF_LINK.'&amp;del_voll_verz='.urlencode($verzeichnsInhalt).'" '
                            .'title="'.L_ORDNER.' '.lcfirst(L_LOESCHN).'... ('.L_ORDNR_NOT_LEER.')" class="img_link">'
                            .icon_anz('del_warning').'</a>')
                        : '<a href="'.SELF_LINK.'&amp;del_verz='.urlencode($verzeichnsInhalt).'" '
                        .'onclick="javascript:return confirm(\'&#128266; - '.L_FRAG_LOESCHN.' - &#128239;\n\n'.L_ORDNER.': '.$verzeichnsInhalt.'\');"'
                        .'title="'.L_ORDNER.' '.lcfirst(L_LOESCHN).'..." class="img_link">'.icon_anz('delete').'</a>');
                $zeile_verzeichn .= '</td>'.PHP_EOL.'</tr>'.PHP_EOL;
            } else {
                $datei_groesse_in_byte = (@filesize($dateiName) ? filesize($dateiName) : L_UNBEKANNT);
                $ansicht_o_a = '<div align="center">- - -</div>';/*Var starten */
                $link_bearbeit_01 = ''; $link_bearbeit_02 = ''; $link_bearbeit_03 = ''; $datei_ext = '';
                if ($dateityp_roh == 'link') {/*link bedeutet Verknuepfung (kein Download moeglich) */
                    $dateitypchen = getDateityp($dateityp_roh);
                    $linkErstelln = $verzeichnsInhalt;
                } elseif (is_array($image_info = @getimagesize($dateiName))) {
                    $bild_groesse_in_byte = $bild_groesse_in_byte + $datei_groesse_in_byte;
                    $bild_info = bildchen_groesse($dateiName);/*erzeugt Array mit Bildinfos */
                    $dateitypchen = 'Image ('.$bild_info[2].')<br>';
                    $linkErstelln = '<a href="'.SELF_LINK.'&amp;imgFile='.urlencode($dateiName).'" '
                        .'title="'.L_ANZEIGN.': *'.$verzeichnsInhalt.'*">'
                        .$verzeichnsInhalt.'</a> ('
                        .'<a href="'.SELF_LINK.'&amp;code2base64='.urlencode($dateiName).'" '
                        .'title="'.L_BAS64_CODE.': *'.$verzeichnsInhalt.'*">'.L_BINAER.'</a>'
                        .')';
                    if (empty($bild_groesse_in_byte) || $bild_groesse_in_byte <= IMG_BYTE_ON_SITE) {
                        $img_verstecken = img_anzeigen(SELF_LINK.'&amp;imgFile='.urlencode($dateiName).'&amp;imgDisply='.$bild_info[2],
                                                       L_VRSCHAU, L_VRSCHAU.' '.L_MIT.' '.L_RAHMN.' (border=1)', '1');
                    } else {
                        $img_verstecken = strong(L_IMG_EINB_ABBR).'<br>'
                            .L_IMG_EINB_ERKL.' '.'<br><br>'.L_IMG_EINB_GROESS.lesbare_dateigroesse(IMG_BYTE_ON_SITE, 3).'.
                             <br>'.L_IMG_EINB_STELL.lesbare_dateigroesse($bild_groesse_in_byte, 3).'.'
                            .'<br><br>'.L_ANZEIGN.': <a href="'.SELF_LINK.'&amp;imgFile='.urlencode($dateiName).'" '
                            .'title="'.$bild_info[2].'-'.L_ANZEIGN.': '.$verzeichnsInhalt.')">'
                            .strong($verzeichnsInhalt).'</a>... '
                            .txtMarkg(helpLink('img_einb_abgebr', L_HANDBUCH, NULL, 1), '', '', 'h4');
                    }
                    $ansicht_o_a = versteck_anzeigen('<span title="'.L_PIXL.'-'.L_DIMENSN.': '.L_DIMENS_XY.'">'
                                                     .$bild_info[0].' x '.$bild_info[1].'</span>', $img_verstecken, '', '', '#'.$sprgLink);
                } else {
                    if (!$datei_ext = strrchr($dateiName, '.')) {
                        $datei_ext = '??';
                    }
                    $datei_ext = substr(strtoupper($datei_ext), 1);
                    $dateitypchen = getDateityp($dateityp_roh).' ('.$datei_ext.')';
                    if (is_binary(strtolower($datei_ext)) === TRUE) {
                        $linkErstelln = binary_anzeig_link($verzeichnsInhalt, $dateiName, $verzeichnsInhalt)
                            .' <a href="'.SELF_LINK.'&amp;text_file='.urlencode($dateiName).'" title="'.L_BIN_BEARB.'" onclick="javascript: return confirm(\''.L_BIN_BEARB.'\');">('.L_BINAER.')</a>';
                    } else {
                        $link_bearbeit_01 = '<a href="'.SELF_LINK.'&amp;text_file='.urlencode($dateiName).'" title="'.L_BEARBTN.'..."';
                        $link_bearbeit_02 = ' class="img_link"'; $link_bearbeit_03 = '>'; $link_bearbeit_end = '</a>';
                        $linkErstelln = $link_bearbeit_01.$link_bearbeit_03.$verzeichnsInhalt.$link_bearbeit_end;
                    }
                }/*else ==> if($dateityp_roh == 'link') */
                $zeile_dateien .= '<tr id="'.$sprung.'">
                        <th style="text-align:left;white-space: nowrap;" colspan="2">
                            <input type="checkbox" name="files[]" value="'.$verzeichnsInhalt.'">';
                if (!empty($formUmbnennen)) {
                    $zeile_dateien .= '&nbsp;'.$formUmbnennen.'</th>';
                } else {
                    $zeile_dateien .= DREI_LEER.$linkErstelln.'</th>';
                }
                $zeile_dateien .= '<td align="center" style="white-space: nowrap;">';
                if ($dateityp_roh == 'link') {
                    /*link bedeutet Verknuepfung (kein Download moeglich) */
                    $zeile_dateien .= $dateitypchen;
                } else {
                    $zeile_dateien .= download_link($verzeichnsInhalt, $dateiName, $dateitypchen);
                }
                $zeile_dateien .= '</td>
                    <td align="center" style="white-space: nowrap;">
                         <span style="color: '.CLR_FONT_ALLG.';" title="'.L_DATEI.'-'.L_DIMENSN.': '.$datei_groesse_in_byte.' Byte">'
                    .lesbare_dateigroesse($datei_groesse_in_byte, 3).'</span></td>
                    <td align="center" style="white-space: nowrap;">'.$last_edit.'</td>';
                if (defined('R_OWNER_SP')) {
                    $zeile_dateien .= rechte_rwx_zellen($dateiName);
                }
                $zeile_dateien .= '
                    <td style="text-align: left; vertical-align: top;">'.$ansicht_o_a.'</td>
                    <td align="center" style="white-space: nowrap;">';
                /*Bearbeiten: */
                if (!empty($link_bearbeit_01)) {
                    $zeile_dateien .= $link_bearbeit_01.$link_bearbeit_02.$link_bearbeit_03.icon_anz('edit').$link_bearbeit_end;
                } elseif (!empty($datei_ext) && $datei_ext == 'ZIP') {
                    $zeile_dateien .= '<a href="'.SELF_LINK.'&amp;entZippn='.urlencode($dateiName).'" title="'.ZIP_ENTPCKN_HIER
                        .'..." class="img_link" onclick="javascript:return confirm(\'&#128218; - '.str_replace(':', ' *'.$verzeichnsInhalt.'*', ZIP_ENTPCKN_HIER)
                        .'\\n\\n&#128266; - '.L_FRAG_ALLG.' - &#128239;\');">'.icon_anz('entZippn').'</a>';
                } else {
                    $zeile_dateien .= icon_anz('space');
                }
                $zeile_dateien .= '&nbsp;|&nbsp;'
                    .'<a href="'.SELF_LINK.'&amp;filecopy='.urlencode($verzeichnsInhalt).'" '
                    .'title="'.L_SPEICHR_NAME.': '.L_KOPIERN.'" class="img_link">'.icon_anz('copy').'</a>';
                $zeile_dateien .= '&nbsp;|&nbsp;'
                    .'<a href="'.SELF_LINK.'&amp;filemove='.urlencode($verzeichnsInhalt).'" title="'.L_SPEICHR_NAME.': '
                    .L_VRSCHIEBN.'/'.L_AUSSCHNDN.' ('.L_ACHTG.L_SPEICHR_HINW.')" class="img_link">'.icon_anz('cut').'</a>';
                $zeile_dateien .= '&nbsp;|&nbsp;'.download_link($verzeichnsInhalt, $dateiName, icon_anz('download'));
                $zeile_dateien .= '&nbsp;|&nbsp;'.umbenennen_link($verzeichnsInhalt, icon_anz('rename'), 'Datei', $sprgLink);
                $zeile_dateien .= '&nbsp;|&nbsp;'.dateiLoeschLink($verzeichnsInhalt);
                $zeile_dateien .= '</td>'.PHP_EOL.'</tr>'.PHP_EOL;
            }/*if(is_dir($verzeichnsInhalt)) */
        }/*if($verzeichnsInhalt !== "" && $verzeichnsI... */
    }/*foreach($arr_files as $verzeichnsInhalt) */
    echo $zeile_verzeichn.$zeile_dateien.'</table><br>'
        .(count($arr_files) > 15 ? ZUSAETZL_PFAD_ZUR_NAVI.'<hr>' : '');
} else {
    echo '<br>'.txtMarkg(ABBR_BEGINN);
}/*else => if(!empty($verz_inhalt_ausblenden)) */
echo '</form>';
if (empty($_GET['ordner']) && empty($dateidownload_nicht_anzeigen)) {
    if (!empty($_GET['filefelder']) && $_GET['filefelder'] > 0) {
        $filefelder = intval($_GET['filefelder']); $verz_anlegen_nicht_anzeigen = 1;
        echo '<fieldset><legend>'.DATEI_UPLOAD_TITEL.' ('.$_SESSION['wfm']['v_pfad'].'):</legend>';
        $fieldset_ende = '</fieldset>';
    }
    echo form_kopf('', 'anker_upload', 1).'
  <input type="hidden" name="MAX_FILE_SIZE" value="99999999999">
  <label for="linkUpload">'.DATEI_UPLOAD_FLDR.':</label> '
        .'<a title="'.DATEI_UPLOAD_MEHRERE.'" href="'.upload_link(1).'</a>,&nbsp;<a href="'.upload_link(5).'</a>,&nbsp;'
        .'<a href="'.upload_link(10).'</a>,&nbsp;'.'<a href="'.upload_link(15, '', '&amp;no_list=1').'</a>,&nbsp;'
        .'<a href="'.upload_link(20, '', '&amp;no_list=1').'</a>'.VIER_LEER_X_2.helpLink('fileupload', NULL, NULL, 1);
    $upload_button = '<input type="submit" name="dateiupload" value="'.DATEI_UPLOAD_SAVE.'" style="color: '.CLR_HINWS.'; background-color: '.CLR_HINTGR_HINW.';">';
    if (!empty($filefelder) && ($filefelder > 1 && $filefelder < 30)) {
        echo '<br>'.PHP_EOL;
        for($luepchen = 1; $luepchen <= $filefelder; $luepchen++){
            echo '<br><input type="file" name="uploadFiles[]"'.($luepchen == 1 ? ' autofocus' : '').' title="'.DATEI_UPLOAD_EINZL.'">';
        }/*for() */
        echo '<br><br>'.$upload_button.'</form>'.PHP_EOL.$fieldset_ende;
    } else {
        $hinwDatei = L_HINWS.DATEI_UPLOAD_HINW;
        echo '<br>'.PHP_EOL.'<input type="file" multiple name="uploadFiles[]" id="linkUpload"'.(!empty($fieldset_ende) ? ' autofocus' : '')
            .' title="'.DATEI_UPLOAD_MEHRERE.'" required>&nbsp;'.$upload_button.'</form>'.PHP_EOL.(!empty($fieldset_ende) ?
                txtMarkg($hinwDatei, '', '', 'h3').$fieldset_ende : strong($hinwDatei));
    }
}/*if(!empty($_GET['ordner']) && $_GET['ordner'] == 'neu') */
if (empty($verz_anlegen_nicht_anzeigen)) {
    $hilfe = helpLink('newfolder', NULL, NULL, 1); $hinw_ver = L_ORDNR_NEW_LABL.' '.Z_BSPL.'"'.BSP_ORDNR.'"';
    echo (empty($_GET['ordner']) ? '<hr><br>' : '')
        .'<script type="text/javascript"> function ordnerAnlegen() {
            x = document.verz_erstellen.make_verz.value;
            if (x != "") {
                check = confirm(\''.L_ORDNR_NEW_F_SET.'\n\n'.L_FRAG_ALLG.'\');
                if (check == false) { return false; } else { return true; }
            } else { alert(\''.L_HINWS.' ???\'); return false; }
        }
        </script>'
        .form_kopf('verz_erstellen', false, 1, false, 'post', 'onsubmit="return ordnerAnlegen()"').'
       '.(!empty($_GET['ordner']) && $_GET['ordner'] == 'neu' ?
            '<fieldset>
           <legend>'.L_ORDNR_NEW_F_SET.'</legend>' : '')
        .'<label for="label_make_verz">'.L_ORDNR_NEUE.':</label>&nbsp;'
        .'<input type="text" name="make_verz" id="label_make_verz" style="width:22em;" placeholder="'.L_ORDNR_NAME.' ('.Z_BSPL.BSP_ORDNR.')" title="'.L_ORDNR_NEW_LABL.'" required>
        <input type="submit" name="subm_make_verz" value="'.L_ORDNR_NEU.'">'
        .DREI_LEER.$hilfe
        .(!empty($_GET['ordner']) && $_GET['ordner'] == 'neu' ? txtMarkg($hinw_ver, '', '', 'h3').'</fieldset>'
            : '<br>'.$hinw_ver.' '.strong(helpLink('newfolder', HILFE_BUCH.'...')))
        .'</form>'.PHP_EOL;
}/*if(empty($verz_anlegen_nicht_anzeigen)) */
echo htmlbodyende();
PHP_EOL;/*END of file */