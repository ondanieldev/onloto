<?php
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if(
        !empty($data->token) && $data->token == ''
    )
    {
        require('./database/connection.php');
        
        $name = $data->customer->full_name;
        $email = $data->customer->email;
        $password = $data->customer->identification_number;
        
        try{
            $register = "INSERT INTO users (name, email, password) VALUES ('" . $name . "', '" . $email . "', '" . $password . "');";
            $registerResult = $conn->query($register);

            $subject = 'Cadastro Lotofácil Dominante';
            $message = '
                <html>
                    <head>
                        <title>Parabéns, você recebeu o seu acesso à plataforma da Lotofácil Dominante!</title>
                    </head>
                    <body>
                        <p>
                            Agora você nunca mais contará com a sorte para a transformação da sua vida financeira!<br>
                            Acesse a Lotofácil Dominante com o seu acesso abaixo:<br><br>
                            <b>E-mail: </b>' . $email . '<br>
                            <b>Senha: </b>' . $password . '<br>
                            <b>URL: </b><a href="http://">http://</a>
                        </p>
                    </body>
                </html>
            ';
            
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'To: ' . $name . ' <' . $email . '>' . "\r\n";
            $headers .= 'From: Lotofácil Dominante <email@gmail.com>' . "\r\n";
            $headers .= 'Cc: email@gmail.com' . "\r\n";
            $headers .= 'Bcc: email@gmail.com' . "\r\n";
            
            $sendMail = mail($email, $subject, $message, $headers);
        }catch(Exception $e){
            echo '';
        }
    
        $conn->close();
    }
?>
