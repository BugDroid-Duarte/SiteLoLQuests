<?php

$name = $_REQUEST['name'];
$email  = $_REQUEST['email'];
$subject  = $_REQUEST['subject'];
$message  = $_REQUEST['message'];

$to = 'duarte.mrandrade@gmail.com';
$subject = 'New message from lol quests';

$body = "Foi recebida uma nova mensagem a partir do site (lolquests), aqui estão os detalhes:
\n From: $name , com o seguinte E-Mail: $email , diz: \n \n Messagem :\n \n $subject \n $message";

// Verificar o nome
$success = mail($to, $subject, $body, "From:" . $email);

// redirect to success page
if ($success){
  echo "Thank you for contacting us!";
  print "<meta http-equiv=\"refresh\" content=\"0;URL=index.html\">";
}
else{
  echo "error";
}

?>
