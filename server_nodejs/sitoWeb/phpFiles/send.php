<?php
   //Mi serve l'IP del server. Questo lo leggo solo nel nodejs all'inizio e non riesco a passarlo
   // a tutte le pagine... lo scrivo su un file e quando ne ho bisogno lo leggo
   $IP = file("../../indirizzo_server.txt")[0];

   $to = 'crazygoose.help@gmail.com';

   // Oggetto della mail
   $subject = 'INFO';
   
   $nome = $_POST['nome']; 
   $cognome = $_POST['cognome'];
   $domanda = $_POST['testo'];
   // Messaggio
   $message = '
    <html>
    <head>
        <title>Domanda da: '.$nome.' '.$cognome.'</title>
    </head>
    <body>
        <p>'.$domanda.'</p>
    </body>
    </html>
';
   
   // Per inviare una mail HTML, deve essere opportunamente settato il Content-type dell'header
   $headers[] = 'MIME-Version: 1.0';
   $headers[] = 'Content-type: text/html; charset=iso-8859-1';

   $emailUser = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
   $headers[] = 'To: Crazy Goose team <'.$to.'>';
   $headers[] = 'From: '.$cognome.' <'.$emailUser.'>';
    
   mail($to, $subject, $message, implode("\r\n", $headers));

   $changePage = "Location: http://$IP:80/progetti/CrazyGoose/server_nodejs/sitoWeb/phpPages/contattaci.php?flag=1";
   header($changePage);
?>
