<?php

namespace App\Framework;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendMail

{
    private $token;

    public function sendMail(Method $postMethod, $token)
    {
        
            $mail = new PHPMailer();
                              
            $mail->isSMTP();                                   // Enable SMTP authentication
            $mail->SMTPDebug = 1;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;                                  
            $mail->Username   = ADMIN_EMAIL_ADRESS;                     // SMTP username      
            $mail->Password = PASSWORD;                                  
            $mail->setFrom (ADMIN_EMAIL_ADRESS , 'Philippe Jaming');  //expediteur
            $mail->Subject = 'Finalisez votre inscription'.$_POST['pseudo'];
            $mail->addAddress($_POST['email'], $_POST['pseudo']); //destinataire
            $mail->Subject = 'Lien de confirmation';
            //Keep it simple - don't use HTML
            $mail->isHTML(true);
            
            $link = '<a href="blog/public/index.php?route=emailConfirm&pseudo='.$_POST['pseudo'].'&token='.$token.'" target="_blank">ClIQUER ICI</a>';
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