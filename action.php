<?php 

if(isset($_POST["envoyer"])){
    require 'connexion.php';
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $type_partenaire = $_POST["type_partenaire"];
    $nature_partenariat = $_POST["nature_partenariat"];
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$nom)){
        header("Location:contact.html?error=invalidusername&email");
        exit();
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location:contact.html?error=invalidemail");
        exit();
    }else if(!preg_match("/^[a-zA-Z0-9]*$/",$nom)){
        header("Location:contact.html?error=invalidusername");
        exit();
    }else if(empty($_POST['nom']) || empty($_POST['email']) || empty($_POST['contact']) || empty($_POST['nature_partenariat']))	
	 {
       header("Location:signup2.msg.php?error=CHAMPS_VIDES");
                exit();
     }else {
        $sql = "SELECT email FROM contact WHERE email='".$email."';";
        $res = mysqli_query($conn,$sql);
        if(!$res){
            header("Location:contact.html?error=sqlerror");
            exit();
        }else{
            $resultCheck = mysqli_num_rows($res);
            if($resultCheck>0){
                header("Location:signup1.msg.php?error=EMAIL_DEJA_ENREGISTRE");
                exit();
            }else{
                $sql = "INSERT INTO contact(nom,email,contact,type_partenaire,nature_partenariat) VALUES('".$nom."','".$email."','".$contact."','".$type_partenaire."','".$nature_partenariat."');";
                $res = mysqli_query($conn,$sql);
                if(!$res){
                    header("Location:contact.html?error=sqlerror");
                    exit();
                }else {
                    header("Location:signup.msg.php?signup=SUCCESS");
                    exit();
                }
            }
        }
    }
    mysqli_close($conn);
    
}else {
    header("Location:contact.html");
    exit();
}