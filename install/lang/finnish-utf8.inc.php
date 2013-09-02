<?php
/**
 * MODx language File
 *
 * @author        Anssi Rajakallio
 * @package       MODx
 * @version       1.0
 * 
 * Filename:      /install/lang/finnish/finnish.inc.php
 * Language:      Finnish
 * Encoding:      UTF-8
 */
$_lang["agree_to_terms"] = 'Hyväksy lisenssi ehdot ja asenna';
$_lang["alert_database_test_connection"] = 'Sinun täytyy luoda tietokanta tai testata tietokantasi valintaa!';
$_lang["alert_database_test_connection_failed"] = 'Tietokannan valinnan testi epäonnistui!';
$_lang["alert_enter_adminconfirm"] = 'Pääkäyttäjän salasana ja varmistus ei täsmää';
$_lang["alert_enter_adminlogin"] = 'Sinun täytyy syöttää käyttäjänimi järjestelmän pääkäyttäjä tilille!';
$_lang["alert_enter_adminpassword"] = 'Sinun täytyy syöttää salasana järjestelmän pääkäyttäjä tilille!';
$_lang["alert_enter_database_name"] = 'Sinun täytyy syöttää arvo tietokanna nimeen!';
$_lang["alert_enter_host"] = 'Sinun täytyy syöttää arvo tietokannan osoitteeseen!';
$_lang["alert_enter_login"] = 'Sinun täytyy syöttää tietokannan käyttäjänimi!';
$_lang["alert_server_test_connection"] = 'Sinun täytyy testata palvelimen yhteysasetuksia!';
$_lang["alert_server_test_connection_failed"] = 'Yhteysasetuksien testi epäonnistu!';
$_lang["alert_table_prefixes"] = 'Tietokannan taulujen etuliite pitää alkaa kirjaimella!';
$_lang["all"] = 'Kaikki';
$_lang["and_try_again"] = ', ja yritä uudelleen. Jos tarvitset apua ongelman ratkaisemiseksi';
$_lang["and_try_again_plural"] = ', ja yritä uudelleen. Jos tarvitset apua ongelmien ratkaisemiseksi';
$_lang["begin"] = 'Aloita';
$_lang["btnback_value"] = 'Takaisin';
$_lang["btnclose_value"] = 'Sulje';
$_lang["btnnext_value"] = 'Seuraava';
$_lang["cant_write_config_file"] = 'MODx ei voinut kirjoittaa asetukset tiedostoa. Ole hyvä ja kopioi seuraava asetustiedostoon ';
$_lang["cant_write_config_file_note"] = 'Kun tämä on tehty, voit kirjautua MODx hallintaan osoitteessa sinunosoite.fi/[+MGR_DIR+]/.';
$_lang["checkbox_select_options"] = 'Valitse valintaruuduista:';
$_lang["checking_if_cache_exist"] = 'Tarkistetaan onko kansiot <span class="mono">/assets/cache</span> ja <span class="mono">/assets/cache/rss</span> olemassa: ';
$_lang["checking_if_cache_file_writable"] = 'Tarkistetaan voiko tiedostoon <span class="mono">/assets/cache/siteCache.idx.php</span> kirjoittaa: ';
$_lang["checking_if_cache_file2_writable"] = 'Tarkistetaan voiko tiedostoon <span class="mono">/assets/cache/sitePublishing.idx.php</span> kirjoittaa: ';
$_lang["checking_if_cache_writable"] = 'Tarkistetaan voiko kansioihin <span class="mono">/assets/cache</span> ja <span class="mono">/assets/cache/rss</span> luoda uusia tiedostoja: ';
$_lang["checking_if_config_exist_and_writable"] = 'Tarkistetaan onko asetustiedosto <span class="mono">[+MGR_DIR+]/includes/config.inc.php</span> olemassa ja voiko siihen kirjoittaa: ';
$_lang["checking_if_export_exists"] = 'Tarkistetaan onko kansio <span class="mono">/assets/export</span> olemassa: ';
$_lang["checking_if_export_writable"] = 'Tarkistetaan voiko kansioon <span class="mono">/assets/export</span> luoda uusia tiedostoja: ';
$_lang["checking_if_images_exist"] = 'Tarkistetaan onko kansiot <span class="mono">/assets/images</span>, <span class="mono">/assets/files</span>, <span class="mono">/assets/flash</span>, <span class="mono">/assets/media</span>, <span class="mono">/assets/backup</span> ja <span class="mono">/assets/.thumbs</span> olemassa: ';
$_lang["checking_if_images_writable"] = 'Tarkistetaan voidaanko kansioihin <span class="mono">/assets/images</span>, <span class="mono">/assets/files</span>, <span class="mono">/assets/flash</span>, <span class="mono">/assets/media</span>, <span class="mono">/assets/backup</span> ja <span class="mono">/assets/.thumbs</span> luoda uusia tiedostoja: ';
$_lang["checking_mysql_strict_mode"] = 'Tarkistetaan MySQL palvelimen "strict sql_mode" asetus: ';
$_lang["checking_mysql_version"] = 'Tarkistetaan MySQL pavelimen versio: ';
$_lang["checking_php_version"] = 'Tarkistetaan PHP:n versio: ';
$_lang["checking_registerglobals"] = 'Tarkistetaan onko PHP:n Register_Globals asetus pois: ';
$_lang["checking_registerglobals_note"] = 'Tämä asetus tekee sivustostasi alttiimman XSS hyökkäyksille (Cross Site Scripting). Sinun tulisi kehottaa palveluntarjoajaasi kytkemään tämä asetus pois käytöstä. Useimmiten tämän asetuksen voi kytkeä pois muokkaamalla palvelimen php.ini tiedostoa. Jos se ei ole mahdollista, voit koittaa kytkeä sen pois .htaccess tiedostossa, joka sijaitsee MODx asennuksen juuri kansiossa. Jos tämäkään ei ole mahdollista, voit viimeisenä vaihtoehtona koittaa asettaa jokaiseen MODx asennuksen sisällä olevaan kansioon muokatun php.ini tiedoston, joka yliajaa asetukset palvelimen jaetusta php.ini tiedostosta, mutta kansioita MODx asennuksessa on tosin huomattava määrä. Voit kuitenkin asentaa MODx järjestelmän tästä asetuksesta huolimatta, mutta sinua on varoitettu.'; //Look at changing this to provide a solution.
$_lang["checking_sessions"] = 'Tarkistetaan onko palvelinistunnot asetettu toimimaan oikein: ';
$_lang["checking_table_prefix"] = 'Tarkistetaan tietokannan taulujen etuliite `';
$_lang["chunks"] = 'HTML-palaset';
$_lang["config_permissions_note"] = 'Jos olet asentamassa järjestelmää Linux / Unix palvelimeen, luo kansioon <span class=\"mono\">[+MGR_DIR+]/includes/</span> tyhjä tiedosto nimeltä <span class=\"mono\">config.inc.php</span> ja aseta tiedostoon 0666 oikeudet.';
$_lang["connection_screen_collation"] = 'Merkistö:';
$_lang["connection_screen_connection_method"] = 'Yhteystyyppi:';
$_lang["connection_screen_database_connection_information"] = 'Tietokannan yhteysasetukset';
$_lang["connection_screen_database_connection_note"] = 'Ole hyvä ja syötä tietokannan nimi, jota MODx:n tulee käyttää. Jos tietokantaa ei ole vielä luotu, asennusohjelma yrittää luodan sen. Tämä voi epäonnistua riippuen MySQL asetuksista ja/tai tietokannan käyttäjän käyttöoikeuksista.';
$_lang["connection_screen_database_host"] = 'Tietokantapalvelimen osoite:';
$_lang["connection_screen_database_info"] = 'Tietokannan tiedot';
$_lang["connection_screen_database_login"] = 'Käyttäjänimi:';
$_lang["connection_screen_database_name"] = 'Tietokannan nimi:';
$_lang["connection_screen_database_pass"] = 'Salasana:';
$_lang["connection_screen_database_test_connection"] = 'Napsauta tähän luodaksesi tietokanta tai testataksesi jo luodun tietokannan valintaa';
$_lang["connection_screen_default_admin_email"] = 'Pääkäyttäjän sähköpostiosoite:';
$_lang["connection_screen_default_admin_login"] = 'Pääkäyttäjän käyttäjänimi:';
$_lang["connection_screen_default_admin_note"] = 'Nyt on aika syöttää pääkäyttäjän tunnuksen tiedot. Voit luoda tunnukset omalla käyttäjänimellä. Suojaa tunnus salasanalla, joka on tietoturvallisesti vahva, mutta jonka muistat itse hyvin. Tarvitset nämä tunnukset kirjautumaan järjestelmään asennuksen jälkeen.';
$_lang["connection_screen_default_admin_password"] = 'Pääkäyttäjän salasana:';
$_lang["connection_screen_default_admin_password_confirm"] = 'Salasanan varmistus:';
$_lang["connection_screen_default_admin_user"] = 'Oletuspääkäyttäjä';
$_lang["connection_screen_defaults"] = 'Ylläpidon asetukset';
$_lang["connection_screen_server_connection_information"] = 'Palvelinyhteyden tiedot sekä kirjautumistiedot';
$_lang["connection_screen_server_connection_note"] = 'Ole hyvä ja syötä palvelimen osoite sekä kirjautumistiedot ja testaa yhteysasetuksia.';
$_lang["connection_screen_server_test_connection"] = 'Napsauta tähän testataksesi palvelimen yhteysasetuksia ja nähdäksesi käytössä olevat merkistöt';
$_lang["connection_screen_table_prefix"] = 'Tietokannan taulujen etuliite:';
$_lang["creating_database_connection"] = 'Luodaan yhteys tietokantaan: ';
$_lang["database_alerts"] = 'Tietokanta varoitukset!';
$_lang["database_connection_failed"] = 'Yhteys tietokantaan epäonnistui!';
$_lang["database_connection_failed_note"] = 'Ole hyvä ja tarkista tietokannan yhteys-, sekä kirjautumistiedot ja yritä uudelleen.';
$_lang["database_use_failed"] = 'Tietokantaa ei voitu valita!';
$_lang["database_use_failed_note"] = 'Ole hyvä ja tarkista tietokannan käyttöoikeudet määritetylle käyttäjälle ja yritä uudelleen.';
$_lang["default_language"] = 'Kieli';
$_lang["default_language_description"] = 'Tämä asetetaan MODx ylläpidon oletus kieleksi.';
$_lang["during_execution_of_sql"] = ' SQL lauseen suorituksen aikana ';
$_lang["encoding"] = 'UTF-8';	//charset encoding for html header
$_lang["error"] = 'virhe';
$_lang["errors"] = 'virheet';
$_lang["failed"] = 'EPÄONNISTUI!';
$_lang["help"] = 'Tuki';
$_lang["help_link"] = 'http://forums.modx.com/';
$_lang["help_title"] = 'Asennustukea MODx keskustelufoorumilla';
$_lang["iagree_box"] = 'Hyväksyn <a href="../assets/docs/license.txt" target="_blank">MODx lisenssin</a> ehdot. GPL lisenssin versio 2:en käännökset löytyvät <a href="http://www.gnu.org/licenses/old-licenses/gpl-2.0-translations.html" target="_blank">GNU Operating System internetsivuilta</a>.';
$_lang["install"] = 'Asenna';
$_lang["install_overwrite"] = 'Asenna/Ylikirjoita';
$_lang["install_results"] = 'Asennuksen tulos';
$_lang["install_update"] = 'Asenna/Päivitä';
$_lang["installation_error_occured"] = 'Asennuksen aikana tapahtui seuraavat virheet';
$_lang["installation_install_new_copy"] = 'Asenna uusi ';
$_lang["installation_install_new_note"] = 'Ota huomioon että tämä vaihtoehto voi ylikirjoittaa tietokannan olemassaolevia tietoja.';
$_lang["installation_mode"] = 'Asennuksen valinta';
$_lang["installation_new_installation"] = 'Uusi asennus';
$_lang["installation_note"] = '<strong>HUOMIO:</strong> Sinun tulisi tarkistaa ja tallentaa järjestelmän asetukset heti ensimmäisen kirjautumisen yhteydessä valikosta <strong>Työkalut</strong> -> <strong>Järjestelmän asetukset</strong>.';
$_lang["installation_successful"] = 'Asennus suoritettiin onnistuneesti!';
$_lang["installation_upgrade_advanced"] = 'Edistynyt päivitys<br /><small>(muokkaa tietokannan asetuksia)</small>';
$_lang["installation_upgrade_advanced_note"] = 'Edistyneille käyttäjille tai vaihdettaessa järjestelmää toiselle palvelimelle, jonka tietokantayhteys käyttää eri merkistöasetuksia. <b>Sinun tulee tietää tietokannan koko nimi, käyttäjä ja salasana, sekä yhteys- ja merkistöasetukset.</b>';
$_lang["installation_upgrade_existing"] = 'Päivitä asennus';
$_lang["installation_upgrade_existing_note"] = 'Päivitä nykyiset tiedostosi, sekä tietokannan tiedot.';
$_lang["installed"] = 'Asennettu';
$_lang["installing_demo_site"] = 'Asennetaan demo sivustoa: ';
$_lang["language_code"] = 'fi';	// for html element e.g. <html xml:lang="en" lang="en">
$_lang["loading"] = 'Ladataan...';
$_lang["modules"] = 'Moduulit';
$_lang["modx_footer1"] = '&copy; 2005-2011 <a href="http://www.modxcms.com/" target="_blank" style="color: green; text-decoration:underline">MODx</a> Content Mangement Framework (CMF). Kaikki oikeudet pidätetään. MODx on lisensoitu GNU GPL lisenssillä.';
$_lang["modx_footer2"] = 'MODx on ilmainen ohjelmisto. Kehoitamme sinua olemaan luova ja käyttämään MODx järjestelmää siten, miten sinä sen parhaaksi näet. Jos teet muutoksia järjestelmään ja päätät jakaa muokattua MODx järjestelmää eteenpäin, muista pitää muokattu lähdekoodi vapaasti saatavilla!';
$_lang["modx_install"] = 'MODx &raquo; Asennus';
$_lang["modx_requires_php"] = ', ja MODx vaatii PHP:stä version 4.2.0 tai uudemman';
$_lang["mysql_5051"] = ' MySQL palvelimen versio on 5.0.51!';
$_lang["mysql_5051_warning"] = 'MySQL 5.0.51 versiolla on havaittu järjestelmän toiminnassa ongelmia. On suositeltavaa, että päivität MySQL version uudempaan ennen asennuksen jatkamista.';
$_lang["mysql_version_is"] = ' Sinun MySQL palvelimen versio on: ';
$_lang["none"] = 'Ei mitään';
$_lang["not_found"] = 'Ei löytynyt';
$_lang["ok"] = 'OK!';
$_lang["optional_items"] = 'Valinnaiset kohdat';
$_lang["optional_items_note"] = 'Ole hyvä ja valitse asennuksesi lisäasetukset ja napsauta "Asenna" painiketta:';
$_lang["php_security_notice"] = '<legend>Tietoturva huomio</legend><p> Vaikka MODx toimiikin tällä PHP versiolla, sen käyttöä ei kuitenkaan suositella. PHP versiosi on altis useille tietoturva aukoille. On suositeltavaa sivustosi tietoturvallisuuden kannalta, että päivität PHP versiosi. Ole hyvä ja päivitä PHP versioon 4.3.8 tai uudempaan, joka korjaa kyseiset tietoturva aukot.';
$_lang["please_correct_error"] = '. Ole hyvä ja korjaa seuraava virhe';
$_lang["please_correct_errors"] = '. Ole hyvä ja korjaa seuraavat virheet';
$_lang["plugins"] = 'Liitännäiset';
$_lang["preinstall_validation"] = 'Ennen asennusta suoritettava tarkastus';
$_lang["remove_install_folder_auto"] = 'Poista asennuskansio, sekä asennustiedostot sivutilastani<br />&nbsp;(Tämä toiminto vaatii, että kansioon /install on tiedostojen sekä ko. kansion poisto-oikeudet).';
$_lang["remove_install_folder_manual"] = 'Muista poistaa &quot;<b>install</b>&quot; kansio ennen kuin kirjaudut järjestelmään.';
$_lang["retry"] = 'Yritä uudelleen';
$_lang["running_database_updates"] = 'Suoritetaan tietokannan päivityksiä: ';
$_lang["sample_web_site"] = 'Demo sivusto';
$_lang["sample_web_site_note"] = 'Ota huomioon, että tämä <b style=\"color:#CC0000\">ylikirjoittaa</b> olemassaolevat sivut ja resurssit.';
$_lang["session_problem"] = 'Palvelinistuntojen hallinnassa havaittu ongelmia. Ole hyvä ja ota yhteyttä palvelun ylläpitäjään ongelman korjaamiseksi.';
$_lang["session_problem_try_again"] = 'Yritä uudelleen?'; 
$_lang["setup_cannot_continue"] = 'Valitettavasti asennusta ei voi jatkaa ylläolevista syistä ';
$_lang["setup_couldnt_install"] = 'MODx asennus ei voinut asentaa/muokata joitain tietokannan tauluja.';
$_lang["setup_database"] = 'Asennus yrittää luoda tietokantaa:<br />';
$_lang["setup_database_create_connection"] = 'Luodaan yhteys tietokantaan: ';
$_lang["setup_database_create_connection_failed"] = 'Tietokantayhteys epäonnistui!';
$_lang["setup_database_create_connection_failed_note"] = 'Ole hyvä ja tarkista tietokannan yhteystiedot ja yritä uudelleen.';
$_lang["setup_database_creating_tables"] = 'Luodaan tietokannan tauluja: ';
$_lang["setup_database_creation"] = 'Luodaan tietokanta `';
$_lang["setup_database_creation_failed"] = 'Tietokannan luonti epäonnistui!';
$_lang["setup_database_creation_failed_note"] = ' - Asennus ei voinut luoda tietokantaa!';
$_lang["setup_database_creation_failed_note2"] = 'Asennus ei voinut luoda tietokantaa ja olemassa olevaa tietokantaa annetulla nimellä ei löytynyt. On todennäköistä että palveluntarjoajasi tietoturva-asetukset ei salli ulkoisten ohjelmien luoda tietokantoja. Ole hyvä ja luo tietokanta palveluntarjoajasi vaatimien menetelmien mukaan ja suorita asennus uudelleen.';
$_lang["setup_database_selection"] = 'Valitaan tietokanta `';
$_lang["setup_database_selection_failed"] = 'Tietokannan valinta epäonnistui...';
$_lang["setup_database_selection_failed_note"] = 'Tietokantaa ei ole olemassa. Asennus yrittää luoda tietokannan.';
$_lang["snippets"] = 'PHP-palaset';
$_lang["some_tables_not_updated"] = 'Joitain tauluja ei päivitetty. Tämä voi johtua aiemmista muokkauksista.';
$_lang["status_checking_database"] = 'Tarkistetaan tietokantaa: ';
$_lang["status_connecting"] = ' Yhdistetään palvelimeen: ';
$_lang["status_failed"] = 'epäonnistui!';
$_lang["status_failed_could_not_create_database"] = 'epäonnistui - tietokantaa ei voitu luoda';
$_lang["status_failed_database_collation_does_not_match"] = 'epäonnistui - tietokannan merkistön yhteensopivuus ongelma. Käytä "SET NAMES" tai valitse %s';
$_lang["status_failed_table_prefix_already_in_use"] = 'epäonnistui - tietokannan taulujen etuliite on jo käytössä!';
$_lang["status_passed"] = 'onnistui - tietokanta valittu';
$_lang["status_passed_database_created"] = 'onnistui - tietokanta luotu';
$_lang["status_passed_server"] = 'onnistui - merkistöt ovat nyt käytettävissä';
$_lang["strict_mode"] = ' MySQL palvelimen "strict sql_mode" asetus on päällä!';
$_lang["strict_mode_error"] = 'Tietyt MODx:n toiminnot ei toimi oikein jos "STRICT_TRANS_TABLES sql_mode" ei kytketä pois käytöstä. Voit asettaa kyseisen MySQL asetuksen muokkaamalla my.cnf tiedostoa tai ottamalla yhteyttä palveluntarjoajaasi.';
$_lang["summary_setup_check"] = 'Asennus on tarkistanut erinäiset tiedot tarkastaakseen, että kaikki on kunnossa asennusta varten.';
$_lang["table_prefix_already_inuse"] = ' - Tietokannan taulujen etuliite on jo käytössä tässä tietokannassa!';
$_lang["table_prefix_already_inuse_note"] = 'Asennusohjelma ei voinut asentaa valittuun tietokantaan, koska se sisältää jo tauluja asetetulla etuliitteellä. Ole hyvä ja valitse uusi etuliite ja yritä uudelleen.';
$_lang["table_prefix_not_exist"] = ' - Tietokannan taulujen etuliitettä ei löydetty tästä tietokannasta!';
$_lang["table_prefix_not_exist_note"] = 'Asennusohjelma ei voinut asentaa valittuun tietokantaan, koska se ei sisällä tauluja asetetulla etuliitteellä, jotka asetit päivitystietoihin. Ole hyvä ja valitse uusi etuliite ja yritä uudelleen.';
$_lang["templates"] = 'Sivupohjat';
$_lang["to_log_into_content_manager"] = 'Kirjautuaksesi sisällönhallintajärjestelmään ([+MGR_DIR+]/index.php) napsauta `Sulje` painiketta.';
$_lang["toggle"] = 'Vastakkaiset';
$_lang["unable_install_chunk"] = 'HTML-palasta ei voitu asentaa.  Tiedosto';
$_lang["unable_install_module"] = 'Moduulia ei voitu asentaa.  Tiedosto';
$_lang["unable_install_plugin"] = 'Liitännäistä ei voitu asentaa.  Tiedosto';
$_lang["unable_install_snippet"] = 'PHP-palasta ei voitu asentaa.  Tiedosto';
$_lang["unable_install_template"] = 'Sivupohjaa ei voitu asentaa.  Tiedosto';
$_lang["upgrade_note"] = '<strong>HUOMIO:</strong> Ennen sivustojen käyttöä, sinun tulisi kirjautua järjestelmän hallintaan pääkäyttäjätunnuksella ja tarkistaa, sekä tallentaa järjestelmän asetukset.';
$_lang["upgraded"] = 'Päivitetty';
$_lang["visit_forum"] = ', vieraile <a href="http://www.modxcms.com/forums/" target="_blank">MODx keskustelufoorumilla</a>.';
$_lang["warning"] = 'VAROITUS!';
$_lang["welcome_message_start"] = 'Valitse aluksi suoritettavan asennuksen tyyppi:';
$_lang["welcome_message_text"] = 'Tämä ohjelma ohjaa sinut suorittamaan järjestelmän asennuksen.';
$_lang["welcome_message_welcome"] = 'Tervetuloa MODx asennusohjelmaan.';
$_lang["writing_config_file"] = 'Kirjoitetaan asetuksia tiedostoon: ';
$_lang["you_running_php"] = ' - Käytössä on PHP versio ';
?>