<?php

/**
 * Immocaster SDK
 * Beispiele für die Nutzung des Immocaster SDK.
 *
 * @package    Immocaster SDK
 * @author     Norman Braun (medienopfer98.de)
 * @link       http://www.immocaster.com
 */

/**
 * Immocaster SDK laden.
 */
require_once('Immocaster/Sdk.php');

/**
 * Verbindung zum Service von ImmobilienScout24 aufbauen.
 * Die Daten (Key und Secret) erhält man auf 
 * http://developer.immobilienscout24.de.
 */
$sImmobilienScout24Key    = 'Key fuer ImmobilienScout24';
$sImmobilienScout24Secret = 'Secret fuer ImmobilienScout24';
$oImmocaster              = Immocaster_Sdk::getInstance('is24',$sImmobilienScout24Key,$sImmobilienScout24Secret);

/**
 * Verbindung zur MySql-Datenbank (wird für einige Anfragen
 * an die API benötigt, wie z.B. nur Maklerobjekte anzeigen).
 */
// $oImmocaster->setDataStorage(array('mysql','DB-Host','DB-User','DB-Password','DB-Name'));

/**
 * cURL verwenden
 */
// $oImmocaster->setReadingType('curl');

/**
 * JSON verwenden
 */
// $oImmocaster->setContentResultType('json');

/**
 * Auf Live-System arbeiten.
 * Für die Arbeit mit Livedaten, muss man von
 * ImmobilienScout24 extra freigeschaltet werden.
 * Standardmäßig wird auf der Sandbox gearbeitet!
 */
// $oImmocaster->setRequestUrl('live');

?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Immocaster SDK</title>
	<style type="text/css">
        body { font-family: Verdana, Geneva, sans-serif; font-size: 11px; }
        h1 { font-family: Georgia, "Times New Roman", Times, serif; font-size: 16px; font-style: italic; }
        h2 { font-family: Georgia, "Times New Roman", Times, serif; font-size: 12px; font-style: italic; }
        p { width: 900px; display: inline-block; }
        textarea { width: 900px; height: 200px; margin: 10px 0; }
		#appVerifyButton { padding: 10px; background: #CCC; border: 1px solid #666; display: inline-block; }
		#appVerifyInfo { color:#F00; font-weight: bold; margin: 10px 0; }
    </style>
</head>
<body>
<h1>
	<a href="http://www.immocaster.com">Immocaster SDK - Beispiele</a>
</h1>
<p>
Das Immocaster SDK unterstützt Entwickler beim Erstellen von PHP-Applikationen mit der Schnittstelle von ImmobilienScout24. Eine
ausführliche Dokumentation befindet sich unter <a href="http://immocaster.com/sdk-dokumentation">http://immocaster.com/sdk-dokumentation</a>. Au&szlig;erdem wird es auf der Website <a href="http://www.immocaster.com">www.immocaster.com</a> in Kürze fertige Plugins für verschiedene CMS (z.B. Wordpress, Drupal, Joomla, usw.) geben, um Projekte noch schneller umsetzen zu k&ouml;nnen.
</p>
<p>
<strong>HINWEIS: Bei einigen Hostinganbietern wie z.B. 1und1, Strato, usw. kann es vorkommen, dass aus Sicherheitsgründen die Funktion file_get_contens nicht funktioniert. Diese wird aber vom SDK genutzt. Um das Problem zu beheben, öffnen Sie bitte die Datei "php.ini" im Ordner "Immocaster" und befolgen Sie die Anweisungen innerhalb der Datei.</strong>
</p>
<br />

<?php

/**
 * Regionen ermitteln.
 */
echo '<h2>Regionen ermitteln</h2>';
$aParameter = array('q'=>'Ber');
$res        = $oImmocaster->getRegions($aParameter);
echo '<div class="codebox"><textarea>'.$res.'</textarea></div>';

/**
 * Geodaten ermitteln.
 */
echo '<h2>GIS - Geo Service</h2>';
$aParameter = array('country-id'=>276,'region-id'=>2,'list'=>true);
$res        = $oImmocaster->geoService($aParameter);
echo '<div class="codebox"><textarea>'.$res.'</textarea></div>';

/**
 * Ergebnisliste abfragen per Radius.
 */
echo '<h2>Ergebnisliste abfragen per Radius</h2>';
$aParameter = array('geocoordinates'=>'52.52546480183439;13.369545936584473;2','realestatetype'=>'apartmentrent');
$res        = $oImmocaster->radiusSearch($aParameter);
echo '<div class="codebox"><textarea>'.$res.'</textarea></div>';

/**
 * Ergebnisliste abfragen per Region.
 */
echo '<h2>Ergebnisliste abfragen per Region</h2>';
$aParameter = array('geocodes'=>1276003001,'realestatetype'=>'apartmentrent');
$res        = $oImmocaster->regionSearch($aParameter);
echo '<div class="codebox"><textarea>'.$res.'</textarea></div>';

/**
 * Expose über die ID auslesen.
 */
echo '<h2>Expose per ID auslesen</h2><br/>Diese Funktion wurde auskommentiert, da dafür eine aktuelle ExposeID benötigt wird.<br/><br/>';
//$aParameter = array('exposeid'=>'ID'); // Expose-ID hinterlegen
//$res        = $oImmocaster->getExpose($aParameter);
//echo '<div class="codebox"><textarea>'.$res.'</textarea></div>';

/**
 * Attachment auslesen.
 */
echo '<h2>Attachment auslesen</h2><br/>Diese Funktion wurde auskommentiert, da dafür eine aktuelle ExposeID benötigt wird.<br/><br/>';
//$aParameter = array('exposeid'=>'ID'); // Expose-ID hinterlegen
//$res        = $oImmocaster->getAttachment($aParameter);
//echo '<div class="codebox"><textarea>'.$res.'</textarea></div>';

/**
 * Applikation zertifizieren.
 * Zum Beispiel für Applikationen, die nur Objekte des
 * Maklers anzeigen sollen.
 *
 * HINWEIS: Unter IE9 kann es zu Problemen mit der
 *          zertifizierung kommen. Darum sollte für
 *          die Zertifizierung möglichst ein anderer
 *          Browser (z.B. Firefox) genommen werden.
 *
 */
echo '<h2>Zertifizierung einer Applikation durch den Makler</h2><br/>Diese Funktion wurde auskommentiert!<br/><br/>';
//if(isset($_GET['main_registration'])||isset($_GET['state']))
//{
//	$aParameter = array('callback_url'=>'http://meine-immocaster-applikation.tld/','verifyApplication'=>true);
//	if($oImmocaster->getAccess($aParameter))
//	{
//		echo '<div id="appVerifyInfo">Registrierung war erfolgreich.</div>';
//	}
//}
//echo '<div id="appVerifyButton"><a href="'.$PHP_SELF.'?main_registration=1'.'">Applikation zertifizieren</a><br/>Hinweis: Unter IE9 kann es zu Problemen mit der Zertifizierung kommen.</div>';

/**
 * Ergebnisliste abfragen per Radius (eines einzelnen Kunden/Maklers).
 */
echo '<h2>Ergebnisliste eines einzelnen Maklers per Radius abfragen</h2><br/>Diese Funktion wurde auskommentiert, da dafür eine Zertifizierung nötig ist.<br/><br/>';
//$aParameter = array('geocoordinates'=>'52.52546480183439;13.369545936584473;1000','realestatetype'=>'apartmentrent','username'=>'Benutzername','channel'=>'is24 oder hp');
//$res        = $oImmocaster->radiusSearch($aParameter);
//echo '<div class="codebox"><textarea>'.$res.'</textarea></div>';

/**
 * Ergebnisliste abfragen per Region (eines einzelnen Kunden/Maklers).
 */
echo '<h2>Ergebnisliste eines einzelnen Maklers per Region abfragen</h2><br/>Diese Funktion wurde auskommentiert, da dafür eine Zertifizierung nötig ist.<br/><br/>';
//$aParameter = array('geocodes'=>1276003001017,'realestatetype'=>'apartmentrent','username'=>'Benutzername','channel'=>'is24 oder hp');
//$res        = $oImmocaster->regionSearch($aParameter);
//echo '<div class="codebox"><textarea>'.$res.'</textarea></div>';

/**
 * Kontakt an Anbieter versenden.
 */
echo '<h2>Anbieter kontaktieren</h2><br/>';
echo 'Es kann zu Problemen kommen, wenn die Objekte die kontaktiert werden sollen nicht auf IS24 veröffentlicht sind.<br/>D.h. wenn die Objekte lediglich Homepage-Veröffentlicht sind wird ein Fehler erzeugt.<br/><br />';
if($_POST['formActionSendContact'])
{
	$aParameter = array('exposeid'=>$_POST['contactObjectId']);
	$res = $oImmocaster->getExpose($aParameter);
	if(substr_count($res, 'ERROR_RESOURCE_NOT_FOUND')<1)
	{
		$sRequestBody = ''; // Infos zum Aufbau unter: http://developer.immobilienscout24.de/wiki/Contact/POST	
		$aContactParameter = array('exposeid'=>$_POST['contactObjectId'],'request_body'=>$sRequestBody);
		$resContact = $oImmocaster->sendContact($aContactParameter);
		echo '<strong>'.$resContact.'</strong><br /><br />';
	}
	else
	{
		echo '<strong>'.$res.'</strong><br /><br />';
	}
}
echo '<form action="'.$SELFPHP.'" method="post" name="sendcontact">';
echo 'Objekt-ID: <input type="text" name="contactObjectId"><br />';
echo 'Nachricht: <input type="text" name="contactMsg"><br />';
echo '<input type="hidden" name="formActionSendContact" value="do"><br />';
echo '<input type="submit" name="submit" value="Anbieter kontaktieren">';
echo '</form>';

/**
 * Objekt weiter empfehlen (an Emailadresse).
 */
echo '<h2>Objekt empfehlen:</h2><br/>';
echo 'Es kann zu Problemen kommen, wenn das Objekt nicht auf IS24 veröffentlicht ist.<br/><br/>';
if($_POST['formActionSendFriend'])
{
	$aParameter = array('exposeid'=>$_POST['friendObjectId']);
	$res = $oImmocaster->getExpose($aParameter);
	if(substr_count($res, 'ERROR_RESOURCE_NOT_FOUND')<1)
	{
		$sRequestBody = ''; // Infos zum Aufbau unter: http://developer.immobilienscout24.de/wiki/SendAFriendForm/POST
		$aFriendParameter = array('exposeid'=>$_POST['friendObjectId'],'request_body'=>$sRequestBody);
		$resFriend = $oImmocaster->sendAFriend($aFriendParameter);
		echo '<strong>'.$resFriend.'</strong><br /><br />';
	}
	else
	{
		echo '<strong>'.$res.'</strong><br /><br />';
	}
}
echo '<form action="'.$SELFPHP.'" method="post" name="sendafriend">';
echo 'Objekt-ID: <input type="text" name="friendObjectId"><br />';
echo 'Email-Adresse: <input type="text" name="friendEmail"><br />';
echo '<input type="hidden" name="formActionSendFriend" value="do"><br />';
echo '<input type="submit" name="submit" value="Objekt empfehlen">';
echo '</form>';
?>

</body>
</html>