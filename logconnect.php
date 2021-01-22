<?php

    $kor_ime=$_POST['kor_ime'];
    $ime_clana=$_POST['ime'];
    $prezime_clana=$_POST['prezime'];
    $email_clana=$_POST['email'];
    $lozinka_clana=$_POST['lozinka'];

  
      $host="localhost";
      $dbUsername="id12833376_ordinacijavt";
      $dbPassword="=!S?3HAXKQ+00o";
      $dbName="id12833376_ordinacija";

        $conn=mysqli_connect($host, $dbUsername, $dbPassword, $dbName);

        if (mysqli_connect_error()){

              die('Connect Error('.mysqli_connect_errno().')'. mysqli_connect_error());
            }

        else{
            /*$SELECT= "SELECT email FROM prijava WHERE email=? limit 1";*/
            $sql="INSERT INTO korisnici (kor_ime, ime, prezime, email, lozinka)
            values ('$kor_ime','$ime_clana','$prezime_clana','$email_clana','$lozinka_clana')";

            $result = $conn->query($sql); //vraca rez ako je spajanje na bazu bilo uspjesno

            if($result)
            {
              header('Location: http://www.projektpt.ml/index.php');
            }
            else
            {
              header('Location: http://www.projektpt.ml/login.php');
            }
          }
?>