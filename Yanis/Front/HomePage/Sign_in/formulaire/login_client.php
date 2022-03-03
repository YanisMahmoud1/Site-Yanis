<?php
session_start();
if(isset($_POST['name']) && isset($_POST['password'])){
   $username = $_POST['name'];
   $password = $_POST['password'];

    // connexion à la base de données
    $host = 'localhost';
    $name = 'client';//link de la bdd
    $user = 'root';
    $pass = '';
    $port = '3307';

    //Checker la connexion à la BDD
    try {
      	$bdd = new PDO("mysql:host=$host;port=$port;dbname=$name", $user, $pass);
      	$bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $eb){
      	echo "Can't open the Database" ;
    }

   
    if($username != "" && $password != ""){
      $sql = "SELECT * FROM data WHERE name = '$username' AND password = '$password'";
      //get the username and password from the DB
      
      $requete = $bdd->prepare($sql);
      //First try to execute
      if($requete->execute()){
         //Checking if the username exists, if yes, check the passwod
         if($requete->rowCount() == 1){
            if($row = $requete->fetch()){
            $username = $row['name'];
            $hashed_password = $row['password'];
            echo "Connexion établie";
            if(!isset($_SESSION)){
               session_start();
           }
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;                            
          // CHANGER LA MAP 
          header("Location: https://www.ain.fr/);
            } else {echo "Impossible de se connecter";}
         } else{
            echo "Nom ou mot de passe éronnés";
            header("Location: https://www.ain.fr/solutions/telecharger-dossier-mdph/");
         }
   } else {
      echo "Nom ou mot de passe vides";
   }
      }
   }
?>