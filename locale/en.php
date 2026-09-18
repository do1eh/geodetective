<?php
declare(strict_types=1);
#landing page
define("landingtitle", "All information about JOTA-JOTI - the world's biggest scout event!");

#Allgemein
define("generalinfo", "What is JOTA-JOTI?");
define("generalinfotext", "Jamboree on the Air, or Jamboree on the Internet, is a virtual scouting meeting that takes place annually on the third weekend in October.
Scouts try to contact other scouts worldwide either via amateur radio or over the internet. There are many different ways to do this, such as chatting via messenger, playing online games, or talking over amateur radio frequencies.
<br>
What do you have to do to participate?
<ul>
<li>Each group organizes its own JOTA-JOTI event on site.</li>
<li>You need internet access and preferably as many devices as possible so that several scouts can work on it at the same time.</li> 
<li>If you want to use amateur radio, you need a licensed radio amateur and a radio station. It's best to ask your local amateur radio club if they are interested in supporting you.</li>
<li>You should also prepare a few offline activities so the scouts can take a break from the screen.</li>
</ul>
What can I do at JOTA-JOTI?
<ul>
<li>Visit the <a href='https://www.jotajoti.info/' target='_blank'>JOTA-JOTI website</a></li>
<li>Chat on <a href='https://www.scoutlink.net/' target='_blank'>Scoutlink</a></li>
<li>Think of a craft project</li>
<li>Listen to the DMR sked (see below)</li>
<li>Play our online games like GeoDetective and Nethunt (see below)</li>
<li>Play Minecraft on minecraft.scoutwired.org</li>
</ul>  ");  
#nethunt
define("nethuntbutton", "To the Nethunt game (from 16.10.2026)");
define("nethunttitle", "Scouting the internet");
define("nethunttext", "New this year is the Nethunt game. It is a scavenger hunt played over the internet. Players must solve various tasks and find clues to reach the goal. In the process, you will get to know the depths of the internet, far from the WWW and social media. The game starts at JOTA-JOTI.");

#midi

define("midititle", "Workshop 2026: MIDI-Controller");
define("miditext", "This year we will build a MIDI-Controller. Most people think 
that MIDI is only for musicians, but that is not the case. With a MIDI-Controller you can also
control games, lights or robots. There are many possibilities.
Here are a few examples of what you can do with the self-built MIDI-Controller:");
define("miditext2", "You can also program your own small games that you can control with your MIDI-Controller.
Just use AI for this. For example: 'Create a small browser game in HTML and Javascript that can be controlled with a MIDI-Controller.'
Then formulate your game idea and try it out.");
define("midibutton", "Building Instructions:");
define("midilink", "workshop/midi26EN.html");

define("geotitle", "GeoDetective Game");
define("geotext", "Take part in the GeoDetective game and find the locations of photos submitted by other scouts.
        Test your knowledge of geography and scouting skills! Use the internet and your deduction skills to find the solutions.
        The actual game starts at JOTA-JOTI, but you can already register and upload your own photos now. See the videos below for more information.");

define("geobutton", "Play GeoDetective now");

define("liveradiotitle", "Listen to the radioscouts live");
define("liveradiotext", "Here you can listen to the live broadcast of the radioscouts on digital amateur radio DMR.
        Click on PLAYER to start the DMR live stream.
        Check the calendar below to see when activities are taking place.");
define("liveradiobutton", "To the DMR Livestream");
        
define("calendartitle", "Calendar of Radioscouts activities:");

#Discord
define("discordtitle", "Discord Server");
define("discordtext", "Join our Discord server to chat with other scouts and exchange information such as JIDs.<br>
There is a voice chat as well as a text chat in both German and English.");

define("discordbutton", "Join Discord Server");

#GeoDetective Spielregeln
define("georulestitle", "GeoDetective Game Rules");
define("georulestext", "The rules for the GeoDetective game are simple: Find the location of the image and submit your guess!<br><br>
<ul>
<li>The game starts at JOTA-JOTI on October 16, 2026 at 8:00 pm and ends on Sunday.</li>
<li>From 11:00 pm to 09:00 am is quiet time, no guesses can be submitted.</li>
<li>Every 4 hours new images are unlocked.</li>
<li>Each player can submit only one guess per image. This can be changed as long as the current game round is active and new images have not yet been unlocked.</li>
<li>After the deadline, the solution and the highscore list for this image will be published.<br>
The winner is the player whose guess is closest to the actual location.</li>
<li>If the JID code is guessed correctly, you get an extra point!</li>
<li>Below the highscore list, players can leave comments about the image and the solutions.<br>
Comments are reviewed and approved by moderators.</li>
");        

define("videotitle", "Videos");

#Buttons
define("buttonok", "OK");
define("buttoncancel", "Cancel");
define("buttonsave", "Save");
define("buttonback", "Back");
define("buttondelete", "Löschen");
define("buttonupload", "Upload");
define("buttoneditdata", "Save changes");
define("buttoneditscoutgroup", "Edit scoutgroup");
define("buttonguesslocation", "Guess location");
define("buttonguessjid", "Guess Jid");
define("buttonreset", "Center Image");

#common
define("reallydelete", "Do you really want to delete this record?");
define("username", "Username");
define("password", "Password");
define("repeatpassword", "Repeat password");
define("next", "Next");


#errormessages
define("errorgroupname", "This groupname is already registered, please choose one from the list.");
define("errorjid", "The JID-Code must be six characters long.");
define("errorusername", "This username is already taken");
define("errorpasswordidentity", "The passwords do not match");
define("errorwrongpassword", "The password is wrong");
define("errorpasswordlength", "The password must at least be 6 characters long");
define("errormissingdescription", "The description of the image is missing");

#Mainmenu
define("menutitle", "Main menu");
define("menuadmin", "Admin");
define("menuplay", "Play");
define("menumyimages", "My images");
define("menusolution", "Solution");
define("menuoptions", "Options");
define("menulogout", "Log out");
define("menunewimages", "new images!");
define("menunewimage", "One new image!");
define("menunonewimages", "No new images!");
#Adminmenu
define("adminmenuuser", "Manage users ");
define("adminmenugroup", "Manage groups");
define("adminmenuevent", "Manage events");
define("adminmenuimages", "Manage images");
define("adminsort", "Sort images");
define("adminmenuback", "Main menu");
define("menuacceptcomments", "new comments!");
define("menuacceptcomment", "One new comment!");
define("menunoacceptcomments", "No new comments!");

#chooseguessimage
define("guessmaintitle", "Guess");
define("guesssubmittedby", "Submitted by:");
define("guesscontact", "Contact:");
define("guessnoimages", "There are no images at the moment");
define("guessexplain", "Geodetective is a game where you try to located the exact location of the photographer
    of the given image. Choose an image by clicking on it to start guessing the location:");
define("guessuntil", "Guessing is possible until:");
define("gamestart", "The game begins: ");
define("uploaduntilstart", "Until then you can upload your images for the game.");
define("buttonuploaduntilstart", "Upload images");
define("buttoneditimages", "Edit my guesses");

#choosesolutionimage
define("solutiontitle", "Solution"); 
define("solutionimagdescription", "Image description");
define("solutionnoresults", "There are no results yet.");
define("solutionresults", "For the following images guessing is not possible anymore.<br>
Click the button below the image to view the results.<br>
Click on an image to enlargen it:<br><br>");
    
#guess
define("guesstitle", "Examine the image closely for clues");

#guessmap
define("guessmaptitle", "Geodetective Location Picker");

#solution
define("solutionmarkertitle", "Mapmarkers with distances");
define("solutionheadline", "Solution");
define("solutionlist", "List of submissions");
define("solutionjidcorrect", "Jid guessed correctly!!");
define("solution", "Solution");
define("solutionguesses", "Guesses");
define("solutionmyguess", "My guess");
#editimage

define("editimageeditcoord", "Edit coordinates");
define("editimageedescrition", "<br>General image description and clues:<br>
        (visible for players before guessing)<br>");
define("editimagesolutiontext", "<br>Solution:<br>
        Short description of what can be seen on the image.<br>
        (is visible for players after the deadline)<br>");
define("editimagesavebutton", "Save");

#editmyimages
define("editmyimagesnomimages", "You did not upload an image yet.");
define("editmyimagesclickimage", "Click oń the image to edit<br>");
define("editmyimagesaccept", "Accept");
define("editmyimagesdecline", "Decline");
define("editmyimagesturn", "Turn image");
define("editmyimage", "Edit");

#map
define("mapcoordtitle", "Click on the map to define coordinates.");

#mypictures
define("mypicturestitle", "My images");
define("mypicturesnew", "Submit new image");
define("mypicturesedit", "Edit my images");

#submitimage
define("submitimagetitle", "Submit image");
define("submitimageexplain", "Click in the button to upload an image.
Note that the image must show be something that has to do with scouting and
must contain enough clues to make it possible to guess the location.");
define("submitdiabled", "At the moment no images can be uploaded");

#configure

define("configuretitle", "Edit account");
define("configureexplain", "Please fill in the form to edit yout data:");

#register
define("registertitle", "New user");
define("registerexplain", "You are not registered yet. Please fill in the form to register.");
define("registerbutton", "Register new user");

#registerscoutgroup

define("registergroupchoose", "Choose your scoutgroup:");
define("registergroupor", "or");
define("registergroupnew", "If your group ist not registered yet, fill in the following fields:");
define("registergroupname", "Name of your scoutgroup");
define("registergroupassociation", "Name of your scoutassociation");
define("registergroupcity", "City of your scoutgroup:");
define("registergroupcountry", "Country");
define("registergroupjid", "What's your JID-Code?");
define("registergroupcontact", "How can your group be contacted during JOTA-JOTI?");
define("registergroupbutton", "Register new scoutgroup");
define("changegroup", "Change scoutgroup");

#comments
define("commenttitle", "Commentse");
define("comment", "Comment");
define("commentbutton", "Send commend");  
define("commentplaceholder", "Type your comment here:");
define("commentsaved", "Your comment has been send successfully, but must be aproved by a moderator."); 
define("acceptedby", "Accepted by:");
define("declinededby", "Declined by:");
define("pleaseaccept", "New! Please accept or decline!");     
define("alreadyingame", "Already shown in game, changes will reset the image");
