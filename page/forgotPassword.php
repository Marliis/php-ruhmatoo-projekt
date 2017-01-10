<?php
    
    if(
        isset($_POST["sender"]) && isset($_POST["reciever"]) && isset($_POST["content"]) &&
        !empty($_POST["sender"]) && !empty($_POST["reciever"]) && !empty($_POST["content"])
    ){
        //var_dump($_POST);
    
        $to = $_POST["reciever"];
        $subject = "Uue parooli taotlus";
        
        $message = "
        <html>
        <head>
        <title>Uue parooli taotlus.</title>
        </head>
        <body>
        <table>       
        <tr>
        <td>Teie uue parooli taotlus on edastatud.</td>
        <br></br>
        <th>Uus parool saadetakse Teile e-kirjaga!</th>
        </tr>
        </table>
        <p>".$_POST["content"]."</p>
        </body>
        </html>
        ";
        
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        // More headers
        $headers .= 'From: Greeny Server <'.$_POST["sender"].'>' . "\r\n";
        //$headers .= 'Cc: myboss@example.com' . "\r\n";
        
        
        if(mail($to,$subject,$message,$headers)){
            echo "E-kiri on saadetud!";
        }else {
            echo "Palun kontrollige täidetud väljad uuesti üle!";
        }
        
        
}


?>
<form method="post">
	<label>PALUN TÄITKE VÄLJAD:</label><br>
    <label>Saatja e-post</label><input type="email" name="sender" placeholder="kasutaja@greeny.cs.tlu.ee"><br>
    <label>Saaja e-post</label><input type="email" name="reciever"><br>
    <label>Sisu</label><textarea name="content"></textarea><br>
    <input type="submit">
</form>