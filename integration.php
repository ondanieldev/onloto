<?php
    $upnidToken = 'valid upnid token';

    if(
        !empty($_POST['hottok']) &&
        $_POST['hottok'] == $upnidToken &&
        $_POST['status'] == 'approved'
    )
    {
        require('./database/connection.php');
        
        $onlotoName = '';
        $onlotoEmail = '';
        $onlotoURL = '';

        $clientName = $_POST['name'];
        $clientEmail = $_POST['email'];
        $clientPassword = $_POST['doc'];
        
        try{
            $register = "INSERT INTO users (name, email, password) VALUES ('" . $clientName . "', '" . $clientEmail . "', '" . $clientPassword . "');";
            $registerResult = $conn->query($register);

            $subject = 'Cadastro Onloto';
            $message = '
                <html>
                    <head>
                        <title>Parabéns, você recebeu o seu acesso à plataforma da Onloto!</title>
                    </head>
                    <body>
                        <p>
                            Agora você nunca mais contará com a sorte para a transformação da sua vida financeira!<br>
                            Acesse à Onloto com o seu acesso abaixo:<br><br>
                            <b>E-mail: </b>' . $clientEmail . '<br>
                            <b>Senha: </b>' . $clientPassword . '<br>
                            <b>URL: </b><a href="' . $onlotoURL . '">' . $onlotoURL . '</a>
                        </p>
                    </body>
                </html>
            ';
            
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'To: ' . $clientName . ' <' . $clientEmail . '>' . "\r\n";
            $headers .= 'From: ' . $onlotoName . ' <' . $onlotoEmail . '>' . "\r\n";
            $headers .= 'Cc: ' . $onlotoEmail . "\r\n";
            $headers .= 'Bcc: ' . $onlotoEmail . "\r\n";
            
            $sendMail = mail($clientEmail, $subject, $message, $headers);
        }catch(Exception $e){
            echo '';
        }
    
        $conn->close();
    }
?>
