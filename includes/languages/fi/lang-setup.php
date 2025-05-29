<?php
return [
    "welcome" => "Tervetuloa käyttämään FMGet:ia. Ennen kuin aloitat, tarvitset seuraavat asiat.",

    "req_ssl" => "Sivusto, jossa on SSL otettu käyttöön [https://]", 
    "req_php" => "PHP-versio 7.3 tai uudempi",
    "req_fms" => "FileMaker-palvelimen versio 18 tai uudempi (SSL on oltava käytössä)",
    "req_api" => "FM-palvelimen asetukset > Data API:n on oltava käytössä",
    "req_acc" => "[Koko pääsy] -tietokantakäyttäjä ja fmrest-laajennettu käyttöoikeus on oltava käytössä",

    "back1" => "Valitse toinen kieli",

    "button_install" => "Asenna FMGet",

    "intro1" => "Tarvitsetko lisää apua sivustosi ja FileMaker-palvelimen konfiguroinnissa?",
    "intro2" => "Lue ohjeartikkeli asennukseen liittyen.",

    "error_ssl" => "SSL-varmennetta ei havaittu, yleensä sen tarjoaa verkkotilin ylläpitäjä. Jos sitä ei ole käytössä, sinun tulee ottaa yhteyttä heihin ennen kuin voit jatkaa.",
    "back2" => "Yritä uudelleen",

    "error_curl1" => "cURL ei ole käytössä tällä palvelimella. Yleensä sen tarjoaa verkkotilin ylläpitäjä. Jos sitä ei ole käytössä, sinun tulee ottaa yhteyttä heihin ennen kuin voit jatkaa.",
    "error_curl2" => "cURL-toiminnot eivät toimi oikein tällä palvelimella. Yleensä sen tarjoaa verkkotilin ylläpitäjä. Sinun tulee ottaa yhteyttä heihin ennen kuin voit jatkaa.",

    "config_details1" => "Sivustosi on valmis! Olet suorittanut tämän osan asennuksesta. FMGet on nyt valmis yhdistämään FileMaker-palvelimesi kanssa.",

    "config_important" => "Tärkeää",
    "config_warning1" => "Älä jaa käyttäjätunnusta ja salasanaa kenellekään, sillä ne antavat käyttäjälle täyden hallinnan FMGet-sovellukseen ja mahdollistavat yhdistettyjen tietokantojen käytön.",

    "error_config" => "Virhe: fmg-config.php-tiedostoa ei voitu luoda, tarkista verkkopalvelimen asetukset ennen kuin voit jatkaa.",

    "config_title" => "FMGet-asetukset",
    "example" => "Esimerkki",
    "try_again" => "Yritä uudelleen",
    "continue" => "Jatka",
    "config_fmserver_hint" => "Verkko-osoite FileMaker-palvelimellesi, ilman www- tai https://-etuliitettä  tai kauttaviivoja lopussa, IP-osoitteet eivät ole sallittuja, osoitteen on oltava julkinen verkkotunnus.",
    "config_fmserver_label" => "FileMaker-palvelimen osoite",
    "config_timezone_label"=> "Aikavyöhyke",
    "config_dateformat_label"=> "Päivämäärämuoto",
    "config_username_label"=> "FMGet-järjestelmänvalvojan käyttäjätunnus",
    "config_username_hint" => "Käyttäjätunnuksessa voi olla vain kirjaimia ja numeroita, alaviivoja, välilyöntejä, pisteitä ja viivoja.",
    "config_password_label"=> "FMGet-järjestelmänvalvojan salasana",
    "config_password_hint"=> "Tarvitset tätä salasanaa hallitaksesi FMGet:iä, tallenna se turvapaikkaan.",
    "config_email_label"=> "FMGet-järjestelmänvalvojan sähköpostiosoite",
    "config_email_hint"=> "Tarkista sähköpostiosoitteesi huolellisesti ennen jatkamista.",

    "error_title" => "Virhe",
    "error_fmserver_error" => "Tämä FM-palvelin-osoite ei ole kelvollinen, tarkista se uudelleen.",
    "error_fmserver_required" => "FM-palvelin-osoite on pakollinen asennettaessa FMGet:iä.",
    "config_title2" => "Tietokanta-asetukset",
    "config_details2" => "Valitse tietokanta ja syötä FMGet-käyttäjätunnuksesi ja salasana. Älä huolehdi, voit aina muuttaa näitä asetuksia myöhemmin.",

    "config_sitename_label"=> "Sivuston nimi",
    "config_fmusername_label"=> "Tietokannan käyttäjätunnus",
    "config_fmpassword_label"=> "Tietokannan salasana",

    "config_selectdb"=> "Käytettävissä olevat tietokannat palvelimellasi:",
    "config_dbaccess"=> "Alla sinun tulee syöttää tiedot käyttäjätilistä, jolla saat pääsyn tietokantaan.",

    "error_sitename_required" => "Sivuston nimi on pakollinen asennettaessa FMGet:iä.",
    "error_timezone_required" => "Aikavyöhyke on pakollinen asennettaessa FMGet:iä.",
    "error_fmusername_required" => "Tietokannan käyttäjätunnus on pakollinen asennettaessa FMGet:iä.",
    "error_fmpassword_required" => "Tietokannan salasana on pakollinen asennettaessa FMGet:iä.",

    "error_dateformat_required" => "Päivämäärämuoto on pakollinen asennettaessa FMGet:iä.",
    "error_fmgusername_required" => "Järjestelmänvalvojan käyttäjätunnus on pakollinen asennettaessa FMGet:iä.",
    "error_fmgpassword_required" => "Järjestelmänvalvojan salasana on pakollinen asennettaessa FMGet:iä.",
    "error_email_required" => "Sähköpostiosoite on pakollinen asennettaessa FMGet:iä.",
    "error_fmdatabase_required" => "Yhtään tietokantaa ei valittu.",

    "error_dateformat_error" => "Tämä päivämäärämuoto ei ole kelvollinen, tarkista se uudelleen.",
    "error_timezone_error" => "Tämä aikavyöhyke ei ole kelvollinen, tarkista se uudelleen.",
    "error_email_error" => "Tämä sähköpostiosoite ei ole kelvollinen, tarkista se uudelleen.",

    "error_fmserver_invalid" => "FMGet ei löytänyt tätä FM-palvelinta, tarkista palvelimen osoite uudelleen.",
    "error_fmserver_nodatabase" => "FM-palvelin tunnistettiin, mutta tietokantaa ei löytynyt annetulla käyttäjätunnuksella/salasanan.",

    "fmserver_otherdatabase" => "Jos et löydä tietokantaasi listasta ylhäältä, se saattaa olla piilotettu tai data API ei ole käytössä siinä, voit yrittää muodostaa yhteyttä siihen kirjoittamalla sen nimen alla olevaan kenttään.",
    "config_named_fmdatabase_label" => "Tietokannan nimi",
    "config_named_fmdatabase_hint" => "Erikoiskirjainten erottelua (iso-/pieni) käytetään - Tietokannan nimi ilman .fmp12-päätettä.",

    "error_database_noaccess" => "FMGet ei pääse käsiksi tietokantaan tällä käyttäjätunnuksella / salasanalla.",
    "fmcloud_notice" => "FileMaker Cloudin kautta isännöityjen tietokantojen kohdalla tämä versio ei tue Claris ID -käyttäjätilien käyttöä tietokantaan liittymiseen, tämä vaihtoehto tulee pian käyttöön.",


    "welcome_title" => "Tervetuloa",
    "welcome_details" => "FMGet on asennettu. Kirjaudu sisään järjestelmänvalvojan hallintapaneeliin luomaan ja hallinnoimaan sivujasi ja lomakkeitasi.",
    "button_login" => "Kirjaudu sisään",

    "alert_username_colon" => "Tietokannan käyttäjätunnus ei voi sisältää kaksoispistettä ( : ), koska se aiheuttaa ristiriidan data API:n todennuksen kanssa.",
    "error_fmusername_colon" => "Tietokannan käyttäjätunnuksessa ei saa olla kaksoispistettä.",

    "error_sqlite3" => "SQLite3-laajennus ei ole käytössä tällä palvelimella.",
    "fail_sqlite3" => "Taulun luonti FMGetin sisäiseen tietokantaan epäonnistui",
];