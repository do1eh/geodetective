<?php
declare(strict_types=1);

#Buttons
define("buttonok", "OK");
define("buttoncancel", "Abbrechen");
define("buttonsave", "Speichern");
define("buttonback", "zurück");
define("buttondelete", "löschen");
define("buttonupload", "Upload");
define("buttoneditdata", "Änderungen speichern");
define("buttoneditscoutgroup", "Pfadfindergruppe ändern");
define("buttonguesslocation", "Standort raten");
define("buttonguessjid", "Jid raten");
define("buttonreset", "Bild zentrieren");

#common
define("reallydelete", "Soll der Datensatz wirklich unwiderruflich gelöscht werden?");
define("username", "Benutzername");
define("password", "Passwort");
define("repeatpassword", "Passwort wiederholen");
define("next", "weiter");


#errormessages
define("errorgroupname", "Der Gruppenname ist bereits angelegt, bitte aus der Liste auswählen.");
define("errorjid", "Der JID-Code muss sechstellig sein.");
define("errorusername", "Der Nutzername ist bereits vergeben");
define("errorpasswordidentity", "Die Passwörter stimmen nicht überein");
define("errorwrongpassword", "Das Passwort ist falsch");
define("errorpasswordlength", "Das Passwort muss mindestens 6 Zeichen lang sein");
define("errormissingdescription", "Bitte eine Bildbeschreibung eingeben");

#Mainmenu
define("menutitle", "Hauptmenü");
define("menuadmin", "Admin");
define("menuplay", "Spielen");
define("menumyimages", "Meine Bilder");
define("menusolution", "Auflösung");
define("menuoptions", "Einstellungen");
define("menulogout", "Abmelden");
define("menunewimages", "neue Bilder!");
define("menunewimage", "Ein neues Bild!");
define("menunonewimages", "Keine neuen Bilder!");
#Adminmenu
define("adminmenuuser", "Userverwaltung");
define("adminmenugroup", "Gruppenverwaltung");
define("adminmenuevent", "Eventverwaltung");
define("adminmenuimages", "Bilderverwaltung");
define("adminmenuback", "Hauptmenü");
define("menuacceptcomments", "neue Kommentare!");
define("menuacceptcomment", "Ein neuer Kommentar!");
define("menunoacceptcomments", "Keine neuen Kommentare!");



#chooseguessimage
define("guessmaintitle", "Tippabgabe");
define("guesscontact", "Kontakt:");
define("guesssubmittedby", "Eingereicht von:");
define("guessnoimages", "Im Moment gibt es keine Bilder");
define("guessexplain", "Bei Geodetectives  geht es darum möglichst genau den Standort des Fotografen von Bildern zu
   bestimmen. Suche dir zuerst ein Bild aus für das du den Standort erraten möchtest:
   Klicke auf ein Bild um einen Tipp abzugeben.");
define("guessuntil", "Raten möglich bis:");
define("gamestart", "Das Spiel beginnt: ");
define("uploaduntilstart", "Bis dahin kannst du Bilder hochladen, die dann im Spiel verwendet werden.");
define("buttonuploaduntilstart", "Bilder einreichen");
define("buttoneditimages", "Meine Tipps ändern");

#choosesolutionimage
define("solutionimagdescription", "Bildbeschreibung");
define("solutiontitle", "Auflösung"); 
define("solutionnoresults", "Es gibt noch keine Ergebnisse");
define("solutionresults", "Für folgende Bilder ist keine Tippabgabe mehr möglich.<br>
   Klicke auf den Button unter dem Bild um die Ergebnisliste anzusehen.<br>
   Klicke auf ein Bild um es zu vergößern:<br><br>");

#guess
define("guesstitle", "Untersuche das Bild genau nach Hinweisen");

#guessmap
define("guessmaptitle", "Geodetective Location Picker");

#solution
define("solutionmarkertitle", "Kartenmarker mit Entfernungen");
define("solutionheadline", "Auflösung");
define("solutionlist", "Liste der Einsendungen");
define("solutionjidcorrect", "Jid richtig geraten!!");
define("solution", "Lösung");
define("solutionguesses", "Tipps");
define("solutionmyguess", "mein Tipp");

#editimage

define("editimageeditcoord", "Koordinaten anpassen");
define("editimageedescrition", "<br>Allgemeine Bildbeschreibung und evt. Tipps:<br>
        (kann bei der Tippabgabe von Spielern gelesen werden)<br>");
define("editimagesolutiontext", "<br>Auflösung:<br>
        Kurze Beschreibung was hier wo zu sehen ist.<br>
        (Wird nach Ablauf der Deadline angezeigt)<br>");
define("editimagesavebutton", "Bildbeschreibung speichern");

#editmyimages
define("editmyimagesnomimages", "Du hast bisher keine Bilder eingereicht.");
define("editmyimagesclickimage", "Klicke auf ein Bild um es zu bearbeiten<br>");
define("editmyimagesaccept", "freigeben");
define("editmyimagesdecline", "sperren");

#map
define("mapcoordtitle", "Klicke auf die Karte um die Koordinaten festzulegen.");

#mypictures
define("mypicturestitle", "Meine Bilder");
define("mypicturesnew", "Neues Bild einreichen");
define("mypicturesedit", "Meine Bilder bearbeiten");

#submitimage
define("submitimagetitle", "Bild einreichen");
define("submitimageexplain", "Klicke auf den Button um ein Bild hochzuladen.
Beachte dass auf dem Bild etwas Pfadfinderisches zu sehen sein muss und auch genug
Hinweise enthalten muss um den Aufnahmeort erraten zu können.");
define("submitdiabled", "Zur Zeit können keine neuen Bilder eingereicht werden");

#configure

define("configuretitle", "Account ändern");
define("configureexplain", "Bitte fülle das Formular aus um deine Daten zu Ändern:");

#register
define("registertitle", "Neuer Benutzer");
define("registerexplain", "Du bist noch nicht registriert. Bitte fülle das Formular aus um dich zu registrieren");
define("registerbutton", "Neuen Benutzer registrieren");

#registerscoutgroup

define("registergroupchoose", "Wähle bitte dein Pfadigruppe sie hier aus:");
define("registergroupor", "oder");
define("registergroupnew", "Sollte deine Gruppe nicht aufgeführt sein, fülle bitte folgende Felder aus:");
define("registergroupname", "Name deiner Pfadigruppe");
define("registergroupassociation", "Name deines Pfadfinderverbands");
define("registergroupcity", "Aus welchem Ort kommt ihr?");
define("registergroupcountry", "Land");
define("registergroupjid", "Wie lautet euer JID-Code?");
define("registergroupcontact", "Wie seid Ihr beim JOTA/JOTI erreichbar?");
define("registergroupbutton", "Neue Pfadfindergruppe registrieren");
define("changegroup", "Gruppe ändern");

#comments
define("commenttitle", "Kommentare");
define("comment", "Kommentieren");
define("commentbutton", "Kommentar absenden");  
define("commentplaceholder", "Schreibe hier deinen Kommentar:");
define("commentsaved", "Dein Kommentar wurde gespeichert, muss aber noch von einem Moderator freigegeben werden.");      
define("acceptedby", "Freigegeben von:");
define("declinedby", "Gesperrt von:");
define("pleaseaccept", "Neu! Bitte freigeben oder Sperren!");
define("alreadyingame", "Bereits im Spiel, Änderung führt zu reset der Deadline");
