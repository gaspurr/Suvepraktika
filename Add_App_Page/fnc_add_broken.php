
<?php
//POST submittimise funktsioon String ja Int väärtustele
//require ("config.php");
$database = 'if20_gaspar_l_1u';
$serverhost = 'localhost';
$serverusername = 'if20';
$serverpassword = 'if20';
//$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);

//$conn = new mysqli($GLOBALS["serverhost"], $serverusername, $serverpassword, $database); //connection to mySql

function addApplication($appName, $platform , $contact, $client, $url,  $version, $serverAddress, $serverPlace, $commentInput){
    $notice = null;
    $database = 'if20_gaspar_l_1u';
    $serverhost = 'localhost';
    $serverusername = 'if20';
    $serverpassword = 'if20';
    $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);

    if ($conn->connection_error){
        die("Connection failed to database:" . $conn->connection_error);
    }
	$stmt = $conn->prepare("INSERT INTO App (name, platform, url, server_address, server_place, contact, version, comments, client) VALUES(?,?,?,?,?,?,?,?,?)");
	echo $conn->error;
	$stmt->bind_param("sssssssss", $appName, $platform, $url, $serverAddress, $serverPlace, $contact, $version, $commentInput, $client);
	$stmt->execute();
    if($stmt->execute()){
		$notice = "kõik on ok";
	} else {
		$notice = $stmt->error;
	}

	$stmt->close();
	$conn->close();
    return $notice;
  }//addApplication lõppeb


//lisa rakendus
/*function addApplication($appName, $platform , $contact, $client, $url,  $version, $serverAddress, $serverPlace, $commentInput){


    $date = date('Y-m-d H:i:s'); // timestamp
    if(isset($_POST["submitApp"])){
        $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
        $stmt = $conn->prepare("INSERT INTO App(Name, Platform, URL, Server_address, Server_place, Contact, Version, Comments, Client) VALUES(?,?,?,?,?,?,?,?)");
        echo $conn->error;

        $stmt->bind_param("ssssssss",$appName, $platform, $url, $serverAddress, $serverPlace, $contact, $version, $commentInput, $client);
        $stmt->execute();
        $stmt->close();
        $conn->close();

    }
}*/

//kommentaari kuvamise funktsioon
function readComment(){
     //Esitleb rakendusega seotud kommentaari
	  $notice = null;
      $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
      //kas rakendusega on seotud mingi kommentaar, mida saab kuvada
      $stmt = $conn->prepare("SELECT comments FROM App WHERE id = ?");
      echo $conn->error;
      $stmt->bind_param("s", $_SESSION["comments"]);
      $stmt->bind_result($descriptionfromdb);
      $stmt->execute();
      if($stmt->fetch()){
          $notice = $descriptionfromdb;
      }
      $stmt->close();
      $conn->close();
      return $notice;

}



// function postStringData($input, $where){ // global funktsioon, et submittida ükskõik mida
//     $notice = null; //teade
    
//     if (isset($_POST[$input])){
//         $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
//         // valmistan ete sql käsu
//         $stmt = $conn->prepare("INSERT INTO $where($input) VALUES (?)");
//         echo $conn->error;

//         $stmt->bind_param("ss", $where, $input);

//         if($stmt->execute()){
//             $notice = "data submitted";
//         } else{
//             $notice = $stmt->error;
//         }

//         $stmt->close();
//         $conn->close();
//         return $notice;
//     }


?>