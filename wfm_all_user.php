<?php
/** ----------------------------------------------------------------+
 * Die Usernamen und Passwoerter koennen beliebig erweitert werden. |
 * Ein Programm zur Kodierung von Username in Base64 und            |
 * Passwort in SHA-2 finden Sie im Toolbereich der Website-vdM.de:  |
 *    http://wfm.website-vdm.de/ =>                                 |
 *     Link: "Hilfe für die Erstellung der Zugangskennung im WFM"   |
 *                                                                  |
 * Wichtig: Sie koennen das Passwort auch ueber die Funktion        |
 * "Passwort aendern" in der Auswahlbox (oben links) aendern.       |
 *                                                                  |
 * Array-Reihenfolge: base64("USERNAME") => sha512("PASSWORT")     */
function all_users(){
  return array(
        'QWRtaW4=' => 'd0399e50b935fd94c0af363d9246f1a8e24002afd9e8ba2b3605aff40b95e8cdbae1bb5ce5059b1833f00856118e556be34d2827645b7fa0d9204de46949f469',
    );
}/* Last Update: 2019-06-21 from "QWRtaW4=" */
