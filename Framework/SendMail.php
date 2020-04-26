<?php

namespace App\Framework;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendMail extends Request

{
    private $token;

    public function sendMail(Method $postMethod, $token) 
    {   
        $pseudo = $this->postMethod->getParameter('pseudo');
        $email = $this->postMethod->getParameter('email');

        $mail = new PHPMailer();                            
        $mail->isSMTP();                                  
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;                                  
        $mail->Username   = ADMIN_EMAIL_ADRESS;              
        $mail->Password = PASSWORD;                                  
        $mail->setFrom (ADMIN_EMAIL_ADRESS , 'Philippe Jaming');
        $mail->Subject = 'Finalisez votre inscription   '.$pseudo;
        $mail->addAddress($email, $pseudo);
        $mail->isHTML(true);
        
        $link = '<a href="blog/public/index.php?route=emailConfirm&pseudo='.$pseudo.'&token='.$token.'" target="_blank">CLIQUER ICI</a>';
        $mail->Body ='
        <html>
        <body>
            <div>
            Bonjour '.$_POST['pseudo'].'! <br><br>
            Pour finaliser votre inscription, merci de <br>'
            .$link.'<br>
            pour vérifier votre adresse email. <br><br>
            A Bientôt
        </div>
        </body>
        </html> ';
        
        $mail->send();   
            
}

public function createToken()
{
    return $this->token = bin2hex(openssl_random_pseudo_bytes(16)); 
}


    
}