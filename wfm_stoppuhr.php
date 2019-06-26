<?php
/**
 * Stellt eine Funktion/Methode zur Verfuegung, mit der man
 * den Seitenaufbau in Millisekunden ausgeben kann.
 * Das Add-on ist kompatibel ab WFM version 5.5.5, vom 22.05.2011
 *
 * @name       Datei: Stoppuhr.php (Add-On)
 * @abstract   siehe oben
 * @author     Ralf von der Mark (RvdM) <ralf@website-RvdM.de>, WebSite-vdM.de
 * @copyright  Copyright (c) 2011, Ralf von der Mark
 * @version    Version vom 22.05.2011
 *
 * @example
 *         Der erste Teil wird an den Anfang einer Seite gesetzt und der zweite an die
 *         Stelle in einer Seite, an der die Zeit nicht mehr gezaehlt werden soll.
 *
 * Zur Zeit muessen folgende Konstanten zu definieren:
 *     define('L_UNBEKANNT', 'Unbekannt');
 *     define('L_LAUFZT', 'Laufzeit: ');
 *     define('L_LAUFZT_IN_SEK', 'Laufzeit des PHP-Scripts in Sekunden');
 *     define('L_SEKUNDN_KZ', 'Sek.');
 *     define('L_SEKUNDN', 'Sekunden');
 *     define('CLR_HINTGR_ALLG', '#dfdfdf');//HintergrFarb
 *     define('CLR_HINWS', '#990000');//Farbe fuer Text
 *     define('CLR_HINTGR_HINW', '#EAF4FF');//Hintergrundfarbe fuer Hinweise
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        // START: 1. Teil der Aufruf der Stoppuhr-Funktion ~~~~~~~~~~~~~~
            require_once 'wfm_stoppuhr.php';
            $stoppuhr = new WFM_vdM_Stoppuhr();
        // ENDE: 1. Teil der Aufruf der Stoppuhr-Funktion ~~~~~~~~~~~~~~~

        // START: 2. und letzten Teil der Aufruf der Stoppuhr-Funktion ~~
             $stoppuhr = new WFM_vdM_Stoppuhr();//ggf. kann man das weglassen.
            echo $stoppuhr->zeigeVerbrauchteZeit(3, 1);
        // ENDE: 2. und letzten Teil der Aufruf der Stoppuhr-Funktion ~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Programmiert von Ralf von der Mark
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     entwickelt am Freitag, 14. Oktober 2005 als "function_stoppuhr.php",
     geaendert am 22.05.2011 / vdM / Umbau zur PHP-Klasse
     geaendert am / von / weil: ? / ? / ?
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
class  WFM_vdM_Stoppuhr
{

    /**
     * Damit bei Initialisierung der Klasse sofort die
     * Start-Zeit aus "setzeStartzeit()" gesetzt wird,
     * ruft der Konstruktor die Methode auf, die die Zeit
     * als Dezimalzahl in einer Konstante speichert.
     */
    public function __construct()
    {
        if (!defined('VDM_STOPPUHR_START_ZEIT')) {
            $this->setzeStartzeit();
        }
    }//ENDE: public function __construct()


    /**
     * Erster Teil der Stoppuhrfunktion setzt die
     * Start-Zeit mit der spaeter die Differenz
     * errechnet wird.
     *
     * @return NIX (Der Wert wird in eine Konstante geschrieben)
     */
    private function setzeStartzeit()
    {
        $aktuelle_mikrozeit_anzeigen = microtime();
        $zeitstempel_anzeigen_01 = substr($aktuelle_mikrozeit_anzeigen, 11, 10);
        $zeitstempel_anzeigen_02 = substr($aktuelle_mikrozeit_anzeigen, 2, 4);
        $startzeit = $zeitstempel_anzeigen_01.'.'.$zeitstempel_anzeigen_02;
        define('VDM_STOPPUHR_START_ZEIT', $startzeit);
        //echo '<h1>'.VDM_STOPPUHR_START_ZEIT.'</h1>'; // Zum Testen!
    }//ENDE: public public function setzeStartzeit()



    /**
     * Setzt die End-Zeit und errechnet mit der
     * Start-Zeit aus "setzeStartzeit()" die Differenz
     *
     * @param  integer $stellenHinterKomma
     * @param  bool    $standardAnzeige (0 oder 1)
     * @return float   (z.B.: 1305059447.0231)
     */
    private function setzeEndzeit($stellenHinterKomma,
                                  $standardAnzeige)
    {
        if (defined('VDM_STOPPUHR_START_ZEIT')) {
            //echo '<h1>'.VDM_STOPPUHR_START_ZEIT.'</h1>'; // Zum Testen!
            $aktuelle_mikrozeit_end = microtime();
            $zeitstempel_ende_01 = substr($aktuelle_mikrozeit_end, 11, 10);
            $zeitstempel_ende_02 = substr($aktuelle_mikrozeit_end, 2, 4);
            $ende1 = $zeitstempel_ende_01.'.'.$zeitstempel_ende_02;
            // echo $ende1.'='.$zeitstempel_ende_01.'.'.$zeitstempel_ende_02; // Zum Testen!
            $fertige_zeit_1 = ($ende1 - VDM_STOPPUHR_START_ZEIT);
            $fertige_zeit = round($fertige_zeit_1, $stellenHinterKomma);
            //echo '<h1>'.$fertige_zeit.'</h1>';
            $fertigeZeit = str_replace('.', ',', $fertige_zeit);

        } else {
            $fertigeZeit = L_UNBEKANNT;

        }//ENDE: else ==> if(defined('VDM_STOPPUHR_START_ZEIT'))

        return $fertigeZeit;
    }//ENDE: public function setzeEndzeit()


    /**
     * Zeigt den Wert an, den die beiden Methoden ermittelt
     * haben (Differenz aus End-Zeit und Start-Zeit)
     * Wenn $standardAnzeige nicht leer, wird eine spezielle
     * Anzeige-Style ausgegeben 'zeitDisplayAusgabe()'
     *
     * @param  integer $stellenHinterKomma (Standard: 3)
     * @param  bool    $standardAnzeige    (1 = Anzeige im DIV)
     * @return float   (z.B.: 1305059447.0231)
     */
    public function zeigeVerbrauchteZeit($stellenHinterKomma = 3,
                                         $standardAnzeige = NULL)
    {
        $fertigeZeit = $this->setzeEndzeit($stellenHinterKomma,
                                           $standardAnzeige);
        if (empty($standardAnzeige)) {
            return $fertigeZeit;
        } else {
            return $this->zeitDisplayAusgabe($fertigeZeit);
        }//ENDE: else ==> if()
    }//ENDE: public function ...(...)


    /**
     * Zeigt den Wert an, den die beiden Methoden ermittelt
     * haben (Differenz aus End-Zeit und Start-Zeit)
     *
     * @param  string $verbrauchteZeit (ermittelter Wert)
     * @return string (z.B.: "Verbrauchte Zeit: 0,003 Sekunden")
     */
    private function zeitDisplayAusgabe($verbrauchteZeit)
    {
        return '<div style="position: '.$_SESSION['wfm']['headPos'].'; top: 25px; left: 172px;
                            width: 10em; border: 1px dotted '.CLR_HINTGR_ALLG.';
                            margin: 0px; padding: 0px 3px 0px 3px;
                            min-height: 13px; font-size: 0.8em; text-align: center;
                            color:'.CLR_HINWS.'; background-color: '.CLR_HINTGR_HINW.';" '
                    .'title="'.L_LAUFZT_IN_SEK.'">'
                .L_LAUFZT.$verbrauchteZeit.'&nbsp;'.L_SEKUNDN_KZ.'</div>';

    }//ENDE: public function zeitDisplayAusgabe(...)
}//ENDE: class