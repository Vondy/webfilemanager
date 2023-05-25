<?php
/**
 * Diese Datei soll die Bearbeitung der Favoriten-Datein vereinfachen.
 *
 * HINWEIS: Das Add-on funktioniert mit dem WebFileManager ab Version 5.2.5
 *
 * @name       datei: wfm_favorits_tool.php
 * @abstract   siehe oben
 * @author     Ralf von der Mark <ralf@website-vdm.de>
 * @copyright  2023, Ralf von der Mark, www.WebSite-vdM.de
 * @version    siehe 'FAVO_TOOL_VERS' und 'FAVO_TOOL_DATE'!
 */
define('FAVO_TOOL_VERS', '1.8');
define('FAVO_TOOL_DATE', '01.03.2023');
define('FAVO_TOOL_LABEL_MAX_LEN', 50);
define('FAVO_TOOL_LABEL_MITTL_TXT', ' . . . ');

echo '<br><br>'
    .txtMarkg(NAME_ANWDG.' - <a href="'.SELF_NAME.'?favos=9" title="Daten neu Laden">'
        .L_FAVO_TOOL_NAME.'</a>:', 'hinweise', '', 'h1')
    .'<br><br>';

function input_text($name, $value, $size='20')
{
    return '<td><input type="text" name="'.$name.'" value="'
                    .feld_inh_veraendern($value)
            .'" style="width:'.$size.'em;"></td>';
}//ENDE: function input_text(...)

function pfad_ausgabe($name, $value)
{
    return '<td style="text-align: left;"><a href="'.SELF_NAME.'?verzns='.$value
                .'" title="Original: '.trim($value).'" onclick="return confirm(\''
                                                        .WECHSL_HIERHIN.'?\')">'
                .text_kuerzen(trim($value),
                                     80,
                                     FAVO_TOOL_LABEL_MITTL_TXT)
                .'</a><input type="hidden" name="'.$name.'" value="'.$value.'">
           </td>';
}//ENDE: function ...(...)

function input_radio($name, $value, $checken=FALSE)
{
    $hintergr = '';
    if (!empty($checken)) {
        $checken = ' checked="checked"';
        $hintergr = ' background-color: #ffffcc;';
    }
    return '<td style="text-align: center;'.$hintergr.'" title="'.L_ORDNR_FAVO_HOME.'"><input type="radio" name="'.$name
            .'" value="'.$value.'" '.$checken.'></td>';
}//ENDE: function ...(...)

function favo_aktiv($name, $nummer)
{
    return '<th style="text-align: center; background-color: #d8d8d8; white-space: nowrap;" title="'.L_AKTIV.': '.L_F_AKTIV_HINW
                .'">'.$nummer.'.) <input type="checkbox" name="'.$name.'" value="1" checked="checked"></th>';
}//ENDE: function ...(...)

function feld_inh_veraendern($wert)
{
    return ($wert);//htmlentities
}//ENDE: function ...(...)

function feld_inh_veraendern_alt($wert)
{
    if (defined('CODIERG')) {
        if (CODIERG == 'uft-8') {
            $wert = ($wert);//utf8_encode nicht noetig!
        } else {
            $wert = utf8_encode($wert);
        }//ENDE: else ==> if;
    }
    return ($wert);//htmlentities
}//ENDE: function ...(...)


function favo_auslesen($sortierg = 'pfad')
{
    $zeilenSammler = NULL;
    if (file_exists(favo_datei())) {
        $arr_favoinh = file(favo_datei());
        $loop_zaehler = 1;
        foreach ($arr_favoinh as $einFavo) {
            $einFavo = trim($einFavo);
            if (!empty($einFavo)
             && (substr($einFavo, 0, 7) != 'HINWEIS'
              && substr($einFavo, 0, strlen(SCHREIBWEISE)) != SCHREIBWEISE)) {
                $zeilenSammler = '<tr>';
                $getrennt = explode('###', $einFavo);
                $pfad = trim($getrennt[0]);
                $lable = (!empty($getrennt[1])? trim($getrennt[1]) : $pfad);
                $lable = (!empty($lable)? $lable : $pfad);
                if (substr($lable, 0, 4) == '[GO]') {
                    $lable = substr($lable, 4);
                    $radio_check = 1;
                } else {
                    $radio_check = '';
                }
                $lable = trim($lable);
                $zeilenSammler .= favo_aktiv('aktiv['.$loop_zaehler.']', $loop_zaehler);
                $zeilenSammler .= pfad_ausgabe('pfad['.$loop_zaehler.']', $pfad);
                $zeilenSammler .= input_radio('stdd', $loop_zaehler, $radio_check);
                $zeilenSammler .= input_text('titel['.$loop_zaehler.']',
                                             text_kuerzen($lable,
                                                          FAVO_TOOL_LABEL_MAX_LEN,
                                                          FAVO_TOOL_LABEL_MITTL_TXT),
                                             '28');
                $zeilenSammler .= '</tr>';
                if ($sortierg == 'titel') {
                    $sortiergArray['titel_'.strtolower($lable).'_'.$loop_zaehler] = $zeilenSammler;
                } else {
                    //Standard-Sortierung ist der Pfad
                    $sortiergArray['pfad_'.strtolower($pfad)] = $zeilenSammler;
                }//ENDE: else ==> if

                $loop_zaehler++;

            }//ENDE: if()
        }//ENDE: foreach ($array as $wert)
        if (is_array($sortiergArray)) {
            ksort($sortiergArray);
        }
        $zeilenSammler = NULL;
        foreach ($sortiergArray as $eineZeile) {
            $zeilenSammler .= $eineZeile;
        }//ENDE:  foreach
    }//ENDE: else =>if (file_exists(favo_datei()))
    return $zeilenSammler;
}//ENDE: function favo_auslesen()

function favo_sichern()
{
    $wert_sammlg = '';
    $loop_zaehler = 1;
    foreach ($_POST['aktiv'] as $ein_key => $ein_postie) {
        $wert_sammlg .= trim($_POST['pfad'][$ein_key]);
        $wert_sammlg .= '###';
        if (!empty($_POST['stdd']) && $_POST['stdd'] == $ein_key) {
            $wert_sammlg .= '[GO]';
        }//ENDE: if()
        $titel = trim(stripcslashes($_POST['titel'][$ein_key]));
        $titel = feld_inh_veraendern($titel);
        $wert_sammlg .= text_kuerzen($titel,
                                     FAVO_TOOL_LABEL_MAX_LEN,
                                     FAVO_TOOL_LABEL_MITTL_TXT);
        $wert_sammlg .= PHP_EOL;
        $loop_zaehler++;
    }//ENDE: foreach ($array as $wert)
    $start = SCHREIBWEISE.': '.L_FAVO_SCHREIBWSE;
    //echo $start.PHP_EOL.trim($wert_sammlg);
    datei_schreiben(favo_datei(), $start.PHP_EOL.trim($wert_sammlg));
}//ENDE: function favo_speichern()

$speicher_meldg = '';//Variable definieren
if (!empty($_POST['speichern'])) {
    favo_sichern();
    $speicher_meldg = '
         <tr>
              <td style="text-align: center;" colspan="4">'
                   .txtMarkg(L_ERFOLGRCH.SAVE_EINST_OK, 'hinweis2').'</td>
        </tr>';
}//ENDE: if()

if (!empty($_GET['sortBy'])) {
    $sortBy = $_GET['sortBy'];
} else {
    $sortBy = 'pfad';
}//ENDE: else ==> if
$favo_inhalt = favo_auslesen($sortBy);


echo form_kopf('favoform', '', '', '?favos=9&amp;sortBy='.$sortBy)
    .'<table border="0" cellpadding="3" cellspacing="1" align="center"
             summary="Inhalt der Datei *'.L_FAVORTS.'*">
        <tr>
            <th style="background-color: #d8d8d8; text-align: center;" title="'.L_AKTIV.': '.L_F_AKTIV_HINW.'">'.L_AKTIV.'</th>
            <th style="background-color: #d8d8d8; text-align: left;"><a href="'
                .SELF_NAME.'?favos=9&amp;sortBy=pfad" title="'.SORT_AUFSTEIGND.' *'.L_F_PFAD.'*'
                    .'">'.L_F_PFAD.'</a></th>
            <th style="background-color: #d8d8d8; text-align: center;" title="'.L_ORDNR_FAVO_HOME.'">'.L_HOME.'</th>
            <th style="background-color: #d8d8d8; text-align: left;"><a href="'
                .SELF_NAME.'?favos=9&amp;sortBy=titel" title="'.SORT_AUFSTEIGND.' *'.L_TITEL.'*'
                    .'">'.L_TITEL.' ('.L_F_TITL_HINW.')</a></th>
        </tr>'
    .$favo_inhalt
    .$speicher_meldg
    .'  <tr>
            <td style="text-align: center; background-color: #d8d8d8;" colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <th style="text-align: center; background-color: #d8d8d8;" colspan="4"><input type="submit" name="speichern" '
                    .'value="'.SAVE_EINSTELL.' ..." '
                    .'style="width:60em; font-weight: bold; color: #990000; background-color: #ffff00;"></th>
        </tr>
        <tr>
            <td style="text-align: center; background-color: #d8d8d8;" colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align: left; background-color: #d8d8d8;" colspan="4">'
                .txtMarkg(L_FAVO_TOOL_NAME.' - '.L_BEDIEN_HINW.':', 'hinweise', '', 'h3').'
                 <ul>
                     <li>'.L_AKTIV.': '.L_F_AKTIV_HINW.'</li>
                     <li><a href="'.SELF_NAME.'?text_file='.favo_datei().'">'.L_F_PFAD_HINW.'</a></li>
                     <li>'.L_HOME.': '.L_F_HOME_HINW.' ('.L_HOME.')</li>
                     <li>'.L_HINWS.L_F_SAVE_HINW.'</li>
                 </ul>'
                .txtMarkg(helpLink('lesezeichen', L_FAVORTS.' - '.L_HANDBUCH, '', 1),
                          'hinweise',
                          '',
                          'h4').'</td>
        </tr>

     </table>'
    .'</form>
    <br>
    '.txtMarkg(NAME_ANWDG.'-'.L_ADDON.':  '.L_FAVO_TOOL_NAME.', '.L_VERS.' '.FAVO_TOOL_VERS.' ('.FAVO_TOOL_DATE.')', 'hinweise', '', 'h3').'
    <br>';
