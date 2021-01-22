<?php
	
	if(isset($_POST['submit'])){
	$name=$_POST['name'];
	$mailFrom=$_POST['email'];
	$message=$_POST['message'];
	$subject=$_POST['subject'];

	
	if(isset($_POST['options'])){
    $options = $_POST['options'];
    switch ($options) {
        case 'iv':
            $mailTo="ptadic123@gmail.com";
            break;
        case 'et':
            $mailTo="ptadic00@fesb.hr";
            break;
        default:
            echo 'Error';
            break;
    }
}
	

	$headers = 'From: '.$mailFrom . "\r\n" .
    'Reply-To: '.$mailFrom . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    $txt="Poruku poslala: " .$name.".\n\r".$message;



	mail($mailTo, $subject, $txt, $headers) or die("Error!");
    header('Location: https://ordinacijaivet.000webhostapp.com/contactform.html');
	}
?>