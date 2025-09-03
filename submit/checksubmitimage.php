<?php
session_start();
 
   include("../templateoben.php");  

   

   function removeExifData($file) {
    // Überprüfen, ob die Datei existiert und ein Bild ist
    if (isset($file) && $file['error'] == 0) {
    // Ermitteln des Dateityps
    $imageType = exif_imagetype($file['tmp_name']);
    
    // Bild je nach Typ laden
    switch ($imageType) {
    case IMAGETYPE_JPEG:
    $image = imagecreatefromjpeg($file['tmp_name']);
    break;
    case IMAGETYPE_PNG:
    $image = imagecreatefrompng($file['tmp_name']);
    break;
    case IMAGETYPE_GIF:
    $image = imagecreatefromgif($file['tmp_name']);
    break;
    default:
    return "Unsupported image type.";
    }

    $exif = exif_read_data($file['tmp_name']); # Get Orienation from temp file!
    if (!empty($exif['Orientation'])) {
	# Rotate generated image if file is rotated
        switch ($exif['Orientation']) {
            case 3:
                $image = imagerotate($image, 180, 0);
                break;
            
            case 6:
                $image = imagerotate($image, -90, 0);
                break;
            
            case 8:
                $image = imagerotate($image, 90, 0);
                break;
        }
    }

    // Neues Bild ohne EXIF-Daten speichern
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newFilePath = '../uploads/' . uniqid() . '.' . $ext;
    //$newFilePath = '../uploads/' . basename($file['name']);
    switch ($imageType) {
    case IMAGETYPE_JPEG:
    imagejpeg($image, $newFilePath);
    break;
    case IMAGETYPE_PNG:
    imagepng($image, $newFilePath);
    break;
    case IMAGETYPE_GIF:
    imagegif($image, $newFilePath);
    break;
    }
    
    // Speicher freigeben
    imagedestroy($image);
    
    return basename($newFilePath);
    } else {
    return false;
    }
    }
    
   
    function gps($coordinate, $hemisphere) {
         
        if (is_string($coordinate)) {
        
          $coordinate = array_map("trim", explode(",", $coordinate));
                
        }
        
        for ($i = 0; $i < 3; $i++) {
          $part = explode('/', $coordinate[$i]);
          if (count($part) == 1) {
            $coordinate[$i] = $part[0];
          } else if (count($part) == 2) {
            $coordinate[$i] = floatval($part[0])/floatval($part[1]);
          } else {
            $coordinate[$i] = 0;
          }
        }
        list($degrees, $minutes, $seconds) = $coordinate;
        $sign = ($hemisphere == 'W' || $hemisphere == 'S') ? -1 : 1;
        return $sign * ($degrees + $minutes/60 + $seconds/3600);
      }


      function triphoto_getGPS($fileName, $assoc = false)
      {
          //get the EXIF
          //echo $fileName;
          $exif = exif_read_data($fileName);
     //print_r($exif);
          //get the Hemisphere multiplier
          $LatM = 1; $LongM = 1;

	if (!isset($exif["GPSLatitudeRef"])) {
		return false;
	}          
          
          if($exif["GPSLatitudeRef"] == 'S')
          {
          $LatM = -1;
          }
          if($exif["GPSLongitudeRef"] == 'W')
          {
          $LongM = -1;
          }
      
          
          //get the GPS data



          $gps['LatDegree']=$exif["GPSLatitude"][0];
          $gps['LatMinute']=$exif["GPSLatitude"][1];
          $gps['LatgSeconds']=$exif["GPSLatitude"][2];
          $gps['LongDegree']=$exif["GPSLongitude"][0];
          $gps['LongMinute']=$exif["GPSLongitude"][1];
          $gps['LongSeconds']=$exif["GPSLongitude"][2];
      
          //convert strings to numbers
          foreach($gps as $key => $value)
          {
          $pos = strpos($value, '/');
          if($pos !== false)
          {
              $temp = explode('/',$value);
            
              if ($temp[1]>0){
              $gps[$key] = $temp[0] / $temp[1];
              }else {
                $gps[$key] =0;
              }
          }
          }
      
          //calculate the decimal degree
          $result['latitude'] = $LatM * ($gps['LatDegree'] + ($gps['LatMinute'] / 60) + ($gps['LatgSeconds'] / 3600));
          $result['longitude'] = $LongM * ($gps['LongDegree'] + ($gps['LongMinute'] / 60) + ($gps['LongSeconds'] / 3600));
      
          if($assoc)
          {
          return $result;
          }
      
          return json_encode($result);
      }


      //$target_dir ="../uploads/";
      
      //echo basename($_FILES["uploadedimage"]["name"]);
      //$target_file = $target_dir . basename($_FILES["uploadedimage"]["name"]);
      
      //$uploadOk = 1;
      //$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      // Check if image file is a actual image or fake image
      
        //$check = getimagesize($_FILES["uploadedimage"]["tmp_name"]);
        //if($check !== false) {
          //echo "File is an image - " . $check["mime"] . ".";
        //  $uploadOk = 1;
        //} else {
          //echo "File is not an image.";
        //  $uploadOk = 0;
        //}
	if (!$_FILES) {
		// Wenn wird post_max_size oder wie es heisst überschrieten, landen wir hier.
		echo'<span style="color:red;">Something went terribly wrong!<br></span>';
		exit(1);
	}

	$a_ulerror = array(
        	0=>"There is no error, the file uploaded with success", 
	        1=>"The uploaded file exceeds the upload_max_filesize directive in php.ini", 
        	2=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
	        3=>"The uploaded file was only partially uploaded",
        	4=>"No file was uploaded",
	        6=>"Missing a temporary folder" 
	);


        //print_r ($_FILES);

	if ($_FILES["uploadedimage"]["error"]) {
		echo "ERROR: " . $a_ulerror[$_FILES["uploadedimage"]["error"]];
		exit(1);
	}

        //echo 'name: '.$_FILES["uploadedimage"]["name"].'<br>';
        //echo 'tmp_name: '.$_FILES["uploadedimage"]["tmp_name"].'<br>';
        $json=triphoto_getGPS($_FILES["uploadedimage"]["tmp_name"]);
        
	if ($json === false)  {
		$lat = 0;
		$lon = 0;
	} else {
	        $koordinaten = json_decode($json);
        
        	$lat=$koordinaten->latitude;
	        $lon=$koordinaten->longitude;
	}

        //TODO: GPSdaten aus uploadedimage entfernen und zu blob konvertieren
        

         echo'<br>';     
        
        
//echo $target_file;
          //Bild speichern
          //if (move_uploaded_file($_FILES["uploadedimage"]["tmp_name"], $target_file)) {
            if ($fname = removeExifData($_FILES["uploadedimage"])){

               $stmt = $conn->prepare("INSERT INTO image (eventid,filename,userid,lat,lon) VALUES (?, ?, ?, ?, ?)");
               $stmt->bind_param("isidd", $_SESSION['eventid'], $fname, $_SESSION['userid'], $lat, $lon);
               $stmt->execute();
          } else {
            echo'Fehler';
          }

//und kontext merken in session dann weiter zum Bild editieren

$_SESSION['imageid'] = $conn->insert_id;
$_SESSION['lat'] = $lat;
$_SESSION['lon'] = $lon;
//check if coordinates are present
if (!$lat==0) {
  echo "<script>window.location.href='editimage.php';</script>";  
  //header("location: editimage.php");
  exit(1);
   
        }else{
          //Wenn keine Koordinaten, dann locationpicker
        echo "<script>window.location.href='map.php';</script>";    
        //header("location: map.php");
        exit(1);
        }
        
       

    //$exif = exif_read_data($_FILES["uploadedimage"]["tmp_name"]);
    //print_r($exif);
    
    //$latitude = gps($exif["GPSLatitude"], $exif['GPSLatitudeRef']);
    //$longitude = gps($exif["GPSLongitude"], $exif['GPSLongitudeRef']);
   
?>
