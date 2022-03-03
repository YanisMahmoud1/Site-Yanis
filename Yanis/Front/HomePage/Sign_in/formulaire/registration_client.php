<?php
    $host = 'localhost';
    $name = 'client';//link of the DB
    $user = 'root';
    $pass = '';
    $port = '3307 ';

    //Checking the connexion to the DB
    try {
        $bdd = new PDO("mysql:host=$host;port=$port;dbname=$name", $user, $pass);
        $bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $eb){
      	echo "Can't open the Database" ;
    }
    //checking if we have all the values

        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $re_pass = $_POST['re_pass'];

        //INSERT INTO `register` (`name`, `email`, `password`, `re_pass`) VALUES ('qdsf', 'sfds', 'sfds', 'sfds');

		$sql = "INSERT INTO `register` (`name`, `email`, `pass`, `re_pass`) VALUES ('$name', '$email', '$pass', '$re_pass')";
        

        //insert the values into the DB 
        try {
          $requete = $bdd->prepare($sql);
          $requete->execute();
          header("Location: attente.html");
        } catch (Exception $e){
          print_r($bdd->errorInfo(),TRUE);
          var_dump($e->getMessage());
        }
        // $rs = $requete->fetchAll();
        //var_dump($rs);

    //close the DB
    $bdd -> connexion = null;
 ?>