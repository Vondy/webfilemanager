<?php
/** ------------------------------------------------------------------+
 * Diese Datei ist ein Add-On bzw. add-on zum WebFileManager - WFM    |
 *                                                                    |
 * Das Programm wird bei bedarf inkludiert und ist in der Lage das    |
 * gewuenschte Verzeichnis mit den beiden Dateien                     |
 * .htaccess und .htpasswd zu versehen (oder zu befreien).            |
 *                                                                    |
 * @name       wfm_htaccess_tool.php (Add-On zum WebFileManager - WFM |
 * @abstract   siehe oben                                             |
 * @author     Ralf von der Mark <ralf@website-vdm.de>, Germany       |
 * @copyright  Copyright (c) 2011, Ralf von der Mark, www.WebSite-vdM.de
 * @version    siehe 'PWD_TOOL_VERS' und 'PWD_TOOL_DATE'!
 *                                                                    |
 * -------------------------------------------------------------------|
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
 * ------------------------------------------------------------------*/

define('PWD_TOOL_VERS', '1.3.6');
define('PWD_TOOL_DATE', 'Nov. 2011');

if (!empty($_GET['accss'])) {
    $accssPfadArr = explode('/', trim($_GET['accss']));
    $accssPfad = '/';
    foreach ($accssPfadArr as $wert) {
        $wert = trim($wert);
        $accssPfad .= (!empty($wert) ? $wert.'/' : '');
    }//ENDE:  foreach
    if (strtoupper(substr(PHP_OS, 0, 3) == 'WIN')) {
        //Betriebssystem Windows
        if (substr($accssPfad, 0, 1) == '/') {
            //Bei Windows bringt der "/" vorm Laufwerksbuchstaben einen Fehler
            $accssPfad = substr($accssPfad, 1);
        }//Jetzt ist er weg ;-)
    }
    $_SESSION['wfm']['accss'] = $accssPfad;
}//ENDE: if (!empty($_GET['accss'])) {


if (!empty($_SESSION['wfm']['accss'])) {

    echo txtMarkg(NAME_ANWDG.' - <a href="'.SELF_NAME.'?accss='.trim($_SESSION['wfm']['accss']).'" title="RELOAD">'
        .L_PWD_TOOL_NAME.'</a>:', 'hinweise', '', 'h1')
        .'<br><br>';

    $verz_pfad_disply = str_replace('//', '/', trim($_SESSION['wfm']['accss']).'/');
    $verz_pfad_disply = str_replace('/', '<strong style="color: #900;">/</strong>', $verz_pfad_disply);
    echo txtMarkg(L_PWD_HINW1.':
                    <br>
                    "'.$verz_pfad_disply.'"', 'erfolge');
    define('NAME_PASSW_DATEI', '.htpasswd');
    define('NAME_PASSWORT_DATEI', $_SESSION['wfm']['accss'].NAME_PASSW_DATEI);
    define('NAME_ACCESS_DATEI', '.htaccess');

    function benutzer_form($benutzerNummer = 1, $titel = PWD_NEW_ADMN)
    {
        if ($benutzerNummer == 1) {
            $label_extension = '';
            $sichern = 'yes';
            $umlauf = '1';
        } else {
            $sichern = 'no';
            $umlauf = (!empty($_POST['umlauf']) ? $_POST['umlauf'] + 1 : 1);
            $label_extension = $umlauf.'. ';
        }//ENDE: else ==> if()
        return '
            <form method="post" action="'.SELF_NAME.'" name="send">
                <input type="hidden" name="umlauf" value="'.$umlauf.'">
                <input type="hidden" name="sichern" value="'.$sichern.'">
                <input type="hidden" name="benutzer" value="'.$benutzerNummer.'">
                <input type="hidden" name="auswahl" value="neu">
                <h2>'.$titel.'</h2>
                <table border="0" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                            <td style="text-align: right;">'.PWD_AREA_NAME.':</td>
                            <td style="width: 33em;"><input type="text" name="BereichsName" maxsize="30" autofocus required>(max. 30 '.L_ZEICHN.')</td>
                    </tr>
                    <tr>
                            <td style="text-align: right;">'.$label_extension.'Username:</td>
                            <td><input type="text" name="UserName" required></td>
                    </tr>
                    <tr>
                            <td style="text-align: right;">'.$label_extension.PW_SELF.':</td>
                            <td><input type="password" name="passw1" required></td>
                    </tr>
                    <tr>
                            <td style="text-align: right;">'.$label_extension.PW_SELF.':</td>
                            <td><input type="password" name="passw2" required>('.L_WIEDRHLG.')</td>
                    </tr>
                    <tr>
                            <td style="text-align: right;">&nbsp;</td>
                            <td><input type="submit" name="aktion" value="'.L_SAVE.'"></td>
                    </tr>
                </table>
             </form>';
    }//ENDE: function benutzer_form(...)

    function crypt_md5($passwort) {
        if (defined('PHP_OS') && PHP_OS == 'Linux') {
            return crypt($passwort);//funktioniert unter Linux
        } else {
            // das ist eine Kruecke, die ich unter folgender Adresse gefunden habe:
            // http://de2.php.net/manual/de/function.crypt.php, funktionert aber gut!
            $salt = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 8);
            $len = strlen($passwort);
            $text = $passwort.'$apr1$'.$salt;
            $bin = pack('H32', md5($passwort.$salt.$passwort));
            $tmp = NULL;
            for ($i = $len; $i > 0; $i -= 16) {
                $text .= substr($bin, 0, min(16, $i));
            }
            for ($i = $len; $i > 0; $i >>= 1) {
                $text .= ($i & 1) ? chr(0) : $passwort{0};
            }
            $bin = pack('H32', md5($text));
            for ($i = 0; $i < 1000; $i++) {
                $new = ($i & 1) ? $passwort : $bin;
                if ($i % 3) $new .= $salt;
                if ($i % 7) $new .= $passwort;
                $new .= ($i & 1) ? $bin : $passwort;
                $bin = pack('H32', md5($new));
            }
            for ($i = 0; $i < 5; $i++) {
                $k = $i + 6;
                $j = $i + 12;
                if ($j == 16) $j = 5;
                $tmp = $bin[$i].$bin[$k].$bin[$j].$tmp;
            }
            $tmp = chr(0).chr(0).$bin[11].$tmp;
            $tmp = strtr(strrev(substr(base64_encode($tmp), 2)),
            'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/',
            './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz');
            return '$'.'apr1'.'$'.$salt.'$'.$tmp;
        }//ENDE: else ==> if (defined('PHP_OS') && PHP_OS == 'Linux') {
    }//ENDE: function crypt_md5($passwort)

    /** Schreibt die beiden Dateien ins Verzeichnis */
    function dateien_schreiben($inhaltPasswortDatei)
    {
        $meldg = NULL;
        $wf = fopen (NAME_PASSWORT_DATEI, 'w+');
        if (!fwrite ($wf, $inhaltPasswortDatei)) {
            $meldg .= txtMarkg(NAME_PASSWORT_DATEI.' - '.L_FILE_SAVE_FEHLR.'
                   <br>
                   '.L_SCHR_RECHT.' ('.L_BEISPL.': chmod 644)!', 'fehler');
        }
        fclose ($wf);
        $htaccessinhalt = 'AuthType Basic'.PHP_EOL
                         .'AuthName "'.$_POST['BereichsName'].'"'.PHP_EOL
                         .'AuthUserFile '.NAME_PASSWORT_DATEI.PHP_EOL
                         .'require valid-user';
        $wf = fopen ($_SESSION['wfm']['accss'].NAME_ACCESS_DATEI, 'w+');
        if (!fwrite ($wf, $htaccessinhalt)) {
         $meldg .= txtMarkg(NAME_ACCESS_DATEI.' - '.L_FILE_SAVE_FEHLR.'
                   <br>
                   '.L_SCHR_RECHT.' ('.L_BEISPL.': chmod 644)!', 'fehler');
        }
        fclose ($wf);
        $meldg .= ' <h2>'.NAME_PASSW_DATEI.' - '.PWD_GESPEICHRT.':</h2>
            <p>'.$inhaltPasswortDatei.'</p>
            <hr>
            <h2>'.NAME_ACCESS_DATEI.' - '.PWD_GESPEICHRT.':</h2>
            <p><pre>'.$htaccessinhalt.'</pre></p>';
        return $meldg;
    }//ENDE: function dateien_schreiben(...)

    function array_reinigen($array)
    {
        foreach($array as $mein_schluessel => $mein_inhalt)
        {
            if (!is_array($array[$mein_schluessel])) {
                $arr_schluessel = $array[$mein_schluessel];//Variable zur Bearbeitung uebergeben!
                $arr_schluessel = trim($arr_schluessel);//Entfernt Whitespaces am Anfang + Ende
                //$arr_schluessel = utf8_decode($arr_schluessel);//Converts a string with
                                 //... ISO-8859-1 characters encoded with UTF-8 to single-byte ISO-8859-1

                //Ausserdem werden noch alle Schraegstriche entfernt:
                $arr_schluessel = stripcslashes($arr_schluessel);
                //... und schliesslich werden noch alle Doppelten Anfuehrungsstriche
                // in einfach umgewandelt:
                $arr_schluessel = str_replace('"', '\'', $arr_schluessel);
                $array[$mein_schluessel] = $arr_schluessel;//Variable wieder zurueckuebergeben!
            }//ENDE: if(!is_array($array[$mein_schluessel])
        }//ENDE: foreach($array as $mein_schluessel => $mein_inhalt)
        return $array;
    }//ENDE: function get_reinigen();//hier werden alle GET-Variablen bereinigt!
    if (!empty($_POST)) {
        $_POST = array_reinigen($_POST);
    }
    if (!empty($_GET)) {
        $_GET = array_reinigen($_GET);
    }

    if (!empty($_GET['auswahl'])) {
        $auswahl = $_GET['auswahl'];
    } elseif (!empty($_POST['auswahl'])) {
        $auswahl = $_POST['auswahl'];
    }
    if (!empty($_GET['benutzer'])) {
        $benutzer = $_GET['benutzer'];
    } elseif (!empty($_POST['benutzer'])) {
        $benutzer = $_POST['benutzer'];
    }
    if (!empty($_GET['sichern'])) {
        $sichern = $_GET['sichern'];
    } elseif (!empty($_POST['sichern'])) {
        $sichern = $_POST['sichern'];
    }
    if (!empty($_GET['ereignis'])) {
        $ereignis = $_GET['ereignis'];
    } elseif (!empty($_POST['ereignis'])) {
        $ereignis = $_POST['ereignis'];
    } else {
        $ereignis = '';//Standardwert!
    }
    if (!empty($_GET['aktion'])) {
        $aktion = $_GET['aktion'];
    } elseif (!empty($_POST['aktion'])) {
        $aktion = $_POST['aktion'];
    }

    echo '
    <table border="1" cellspacing="0" cellpadding="6" align="center" bgcolor="#FFFFFF">
        <tr>
            <th><h1>&nbsp;&nbsp;&nbsp;'.icon_anz('save').'&nbsp;&nbsp;&nbsp;'.L_PWD_TOOL_NAME.' im '.NAME_ANWDG.' ('.NAME_ANWD_K.')&nbsp;&nbsp;&nbsp;&nbsp;'.icon_anz('save').'&nbsp;&nbsp;&nbsp;</h1>
                <br></th>
        </tr><tr>
            <td>';

    if (!isset($auswahl)):
        echo '<ul>
                <li><a href="'.SELF_NAME.'?auswahl=neu&amp;benutzer=1" title="'.PWD_VORS_HINW.'">'.PWD_NEW_LOGN.' ...&raquo;</a></li>
                <li><a href="'.SELF_NAME.'?ereignis=erweitern&auswahl=auswechseln">'.PWD_EDIT.'</a></li>
                <li><a href="'.SELF_NAME.'?auswahl=open" title="'.PWD_DEL_HINW.'">'.PWD_DEL.' ...&raquo;</a></li>
            </ul>';

    elseif ($auswahl == 'neu'):
        if (!isset($benutzer)):
            echo txtMarkg('Neuen Bereich anlegen').'<ul>
                <li><a href="'.SELF_NAME.'?auswahl=neu&benutzer=1">'.PWD_NEW_AREA_1.' ...&raquo;</a></li>
                <li><a href="'.SELF_NAME.'?auswahl=neu&benutzer=2">'.PWD_NEW_AREA_N.' ...&raquo;</a></li>
            </ul>';
        elseif ($benutzer == '1'):

            if (empty($sichern)):
                echo benutzer_form();

            elseif ($sichern == 'yes'):
                if (empty($_POST['UserName']) || empty($_POST['UserName'])
                 || empty($_POST['passw1']) || empty($_POST['passw2'])) {
                     echo txtMarkg(EINGABN_FALSCH, 'fehler');
                } else {
                    if ($_POST['passw1'] == $_POST['passw2']) {
                        $passwd = crypt_md5($_POST['passw2']);
                        echo dateien_schreiben($_POST['UserName'].':'.$passwd);
                    } else {
                        echo txtMarkg(PW_KONTROLLE, 'fehler');
                    }
                }
            endif;

        elseif ($benutzer == '2'):
            if (!isset($sichern)):
                echo benutzer_form('2');

        elseif ($sichern == 'no'):
            if ($aktion == 'speichern' || $aktion == 'weitere User'):
                if (empty($_POST['UserName']) || empty($_POST['passw1']) || empty($_POST['passw2']))
                {
                    echo txtMarkg(EINGABN_FALSCH, 'fehler');
                } else {
                    if ($_POST['passw1'] == $_POST['passw2']) {
                        if (empty($_POST['inhalt1'])) { $_POST['inhalt1'] = NULL; }
                        $passwd = crypt_md5($_POST['passw2']);
                        $_POST['inhalt1'] .= $_POST['UserName'].':'.$passwd.'PHP_EOL';
                        echo '
                            <form method="post" action="'.SELF_NAME.'" name="send">
                                <input type="hidden" name="sichern" value="no">
                                <input type="hidden" name="benutzer" value="2">
                                <input type="hidden" name="auswahl" value="neu">
                                <input type="hidden" name="inhalt1" value="'.$_POST['inhalt1'].'">
                                <input type="hidden" name="BereichsName" value="'.$_POST['BereichsName'].'">
                                <div align="center"><br>'.PWD_MORE_USR.'</div>
                                <div align="center"><br>
                                    <br>
                                    '.PWD_USR_NAME_MORE.':<br>
                                    <input type="text" name="UserName" autofocus required>
                                    <br>
                                    <br>
                                    '.PW_SELF.':<br>
                                    <input type="password" name="passw1" required>
                                    <br>
                                    '.PW_SELF.' ('.L_BESTAETIGG.'):<br>
                                    <input type="password" name="passw2" required>
                                <br>
                                <br>
                                <input type="submit" name="aktion" value="'.PWD_MORE_USR.'">&nbsp;&nbsp;
                                <input type="submit" name="aktion" value="'.SAVE_EINSTELL.'">
                                </div>
                            </form>';

                            } else {
                                echo txtMarkg(PW_KONTROLLE, 'fehler');
                            }
                 } elseif ($aktion == SAVE_EINSTELL):
                if (empty($_POST['UserName']) || empty($_POST['passw1']) || empty($_POST['passw2'])) {
                     echo txtMarkg(EINGABN_FALSCH, 'fehler');
                } else {
                    if ($_POST['passw1'] == $_POST['passw2']) {
                         $passwd = crypt_md5($_POST['passw2']);
                         $inhaltPasswortDatei = str_replace('PHP_EOL', PHP_EOL, $_POST['inhalt1'])
                                               .$_POST['UserName'].':'.$passwd.PHP_EOL;
                         echo dateien_schreiben($inhaltPasswortDatei);
                     } else {
                         echo txtMarkg(PW_KONTROLLE, 'fehler');
                     }
                 }
                endif;
            endif;
        endif;
    elseif ($auswahl == 'auswechseln'):
        if ($ereignis == 'erweitern'):
            if (!isset($_GET['wieder_freigeben'])):
                if (file_exists($_SESSION['wfm']['accss'].NAME_ACCESS_DATEI)) {
                    $content = file($_SESSION['wfm']['accss'].NAME_ACCESS_DATEI);
                    $passwdfile = explode (' ', $content[2]);
                    $passwdfile = trim($passwdfile[1]);
                    unset($content);
                    if (file_exists($passwdfile)) {
                        if (!empty($_POST['thisnewcontent'])) {
                            $thisnewcontent = $_POST['thisnewcontent'];
                        } else {
                            $thisnewcontent = NULL;
                        }
                        if (isset($action) AND $action == 'add') {
                            $thisnew_content = $thisnewcontent.PHP_EOL
                                                   .$_POST['newbenutzer'].':'.crypt_md5($_POST['newpasswd']);
                            $fp = fopen($passwdfile, 'w+');
                            fwrite($fp, $thisnew_content);
                            fclose($fp);
                        }
                        $content = file($passwdfile);
                        echo '<table width="100%" align="center" border="0" cellspacing="0" cellpadding="3">
                                <tr>
                                    <td colspan="2">'.txtMarkg(PWD_DEL_HINW1.':', 'hinweis2').'</td>
                                </tr>';
                        $thisnewcontent = '';
                        for ($a=0; $a < count($content); $a++ )
                        {
                            $benutzer1 = explode(':', $content[$a]);
                            $benutzer = $benutzer1[0];
                            unset($benutzer1);
                            $b = $a + 1;
                            echo '
                                <tr>
                                    <td style="text-align: right;">'.$b.'.)</td>
                                    <td style="width:88%;"><a href="'.SELF_NAME.'?ereignis=erweitern&amp;auswahl=auswechseln&amp;wieder_freigeben='.urlencode($benutzer).'">'
                                        .'<strong>'.$benutzer.'</strong></a></td>
                                </tr>';
                            $thisnewcontent .= $content[$a];
                        }
                        echo '<tr>
                                <td colspan="2">'.txtMarkg(L_LOESCHN_HINW).'</td>
                            </tr>
                            <tr>
                                <td colspan="2"><hr></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>'.PWD_USR_HINZUF.'</strong>
                                  <form action="'.SELF_NAME.'" method="post">
                                    <input type="hidden" name="ereignis" value="erweitern">
                                    <input type="hidden" name="auswahl" value="auswechseln">
                                    <input type="hidden" name="action" value="add">
                                    <input type="hidden" name="thisnewcontent" value="'.$thisnewcontent.'"></td>
                            </tr>
                            <tr>
                                <td style="text-align: right;"><strong>Username:</strong></td>
                                <td><input type="text" name="newbenutzer" autofocus required></td>
                            </tr>
                            <tr>
                                <td style="text-align: right;"><strong>'.PW_SELF.':</strong></td>
                                <td><input type="password" name="newpasswd" required></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="submit" name="aktion" value="'.L_SAVE.'">
                                </form></td>
                            </tr>
                        </table>';
                        } else {
                            echo txtMarkg(NAME_PASSWORT_DATEI.' - '.NICHT_GEFUNDN, 'fehler');
                        }
                    } else {
                        echo txtMarkg(NAME_ACCESS_DATEI.' - '.NICHT_GEFUNDN, 'fehler');
                    }
            elseif (trim($_GET['wieder_freigeben']) != ''):

                if (file_exists($_SESSION['wfm']['accss'].NAME_ACCESS_DATEI))
                    {
                    $content = file($_SESSION['wfm']['accss'].NAME_ACCESS_DATEI);
                    $passwdfile = explode (' ', $content[2]);
                    $passwdfile = trim($passwdfile[1]);
                    unset($content);
                    if (file_exists($passwdfile)) {
                        $content = file($passwdfile);
                        $new_content = '';
                        for ( $a=0; $a < count($content); $a++ )
                            {
                            $benutzer1 = explode(':', $content[$a]);
                            $benutzer = $benutzer1[0];
                            unset($benutzer1);
                            if ($benutzer != $_GET['wieder_freigeben'])
                                {
                                $new_content .= $content[$a];
                                }
                            }
                        $fp = fopen($passwdfile, 'w+');
                        fwrite($fp, $new_content);
                        fclose($fp);
                        echo '<ul>
                              <li><strong>'.L_ERFOLGRCH.' '.USR_GELOESCHT.' .&quot;'.$_GET['wieder_freigeben'].'&quot;</strong></li>
                              <li><a href="'.SELF_NAME.'?ereignis=erweitern&auswahl=auswechseln"><strong>'.PWD_EDIT.' ...</strong></a></li>
                          </ul>';
                    } else {
                        echo txtMarkg(NAME_PASSWORT_DATEI.' - '.NICHT_GEFUNDN, 'fehler');
                    }
                } else {
                    echo txtMarkg(NAME_ACCESS_DATEI.' - '.NICHT_GEFUNDN, 'fehler');
                }
            endif;
        endif;
    elseif ($auswahl == 'open'):
        echo '<br>
                <div align="center">
                    <h3>'.PWD_AREA_DEL.':</h3>
                    <hr>';

                    if (!isset($_GET['wieder_freigeben'])):
                        echo PWD_ARE_DEL_HINW.'
                              <br>
                              ('.NAME_ACCESS_DATEI.' + '.NAME_PASSW_DATEI.' - '.L_FRAG_LOESCHN.')<br><br>';
                        echo '[ - <a href="'.SELF_NAME.'?auswahl=open&amp;wieder_freigeben=JA">'.L_JA.'!</a> - <a href="'.SELF_NAME.'">'.L_NEIN.'!</a> - ]';
                    elseif ($_GET['wieder_freigeben'] == 'JA'):
                        if (file_exists($_SESSION['wfm']['accss'].NAME_ACCESS_DATEI)) {
                            echo $_SESSION['wfm']['accss'].NAME_ACCESS_DATEI;
                            if (!unlink($_SESSION['wfm']['accss'].NAME_ACCESS_DATEI)) {
                                echo txtMarkg(NAME_ACCESS_DATEI.' - '.GELOESCH_NOT.'! <br>'.L_KEINE_RECHTE, 'fehler');
                            } else {
                                echo '<br>
                                     '.NAME_ACCESS_DATEI.' - '.DATEI_GELOESCHT;
                            }
                        } else {
                            echo txtMarkg(NAME_ACCESS_DATEI.' - '.GELOESCH_NOT.'!', 'fehler');
                        }
                    endif;
    endif;

    echo '<tr>
            <th class="head">'
            .(!empty($_POST) || !empty($_GET) ? '<a href="'.SELF_NAME.'" style="text-decoration: none; background-color: '.CLR_HINTGR_HINW.'">' : '')
            .icon_anz('save').VIER_LEER_X_2
            .L_PWD_TOOL_NAME.' - '.L_BEGINN_NEU
            .VIER_LEER_X_2.icon_anz('save')
            .(!empty($_POST) || !empty($_GET) ? '</a>' : '')
            .'</th>
            </tr>
        </table>
        <br><br><br><br>';

} else {

    echo '<h2><a href="http://shop.website-vdm.de">'.ERR_ERROR.ERR_BEGINN_NEU.'</a></h2>';

}//ENDE: else ==> if (!empty($_SESSION['wfm']['accss'])) {

echo '<br>
    '.txtMarkg(NAME_ANWDG.'-'.L_ADDON.':  '.L_PWD_TOOL_NAME.', '.L_VERS.' '.PWD_TOOL_VERS.' ('.PWD_TOOL_DATE.')', 'hinweise', '', 'h3').'
    <br>';