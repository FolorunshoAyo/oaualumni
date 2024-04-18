<?php

$errors = '';
$myemail = 'abc@gmail.com';//<-----Put Your email address here.
if(empty($-POST['firstname'])  ||
   empty($-POST['email']) ||
   empty($-POST['subject']) || 
   empty($-POST['message']))
{
    $errors .= "\n Error: all fields are required";
}

$first = $-POST['firstname'];
$email-address = $-POST['email'];
$subject = $-POST['subject']; 
$message = $-POST['message']; 

if (!preg-match(
"/^[-a-z0-9-]+(\.[-a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
$email-address))
{
    $errors .= "\n Error: Invalid email address";
}

if( empty($errors))
{
	$to = $myemail;
	$email-subject = "$subject";
	$email-body = "You have received a new message from: $first". 
	" Here are the details:\n $message"; 
	
	$headers = "From: Homex <hotel@vilema.com>\n";  // Type here where the message has came from
	$headers .= "Reply-To: $email-address";
	
	$send = mail($to,$email-subject,$email-body,$headers);
	if($send)
	{
		echo "success";
	}
	else{
		echo "error";
	}

} 

?>