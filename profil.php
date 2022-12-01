<!DOCTYPE html>
<html lang="fr">
<meta charset="utf-8">

<head>
    <title>Profil</title>
    <link href="CSS/profil.css" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
 
</head>

<body>


<script>
//fonction en javascript (https://www.w3schools.com/howto/howto_js_toggle_password.asp)
function myFunction() {
    var x1 = document.getElementById("password");
    if (x1.type === "password") {
    x1.type = "text";
    } else {
    x1.type = "password";
    }
} 
</script>

<?php

    session_start();
    $login=$_SESSION['login'];
    $password=$_SESSION['password'];
    
    if(isset($login) AND isset($password) ){

        if($login==="admin" and $password==="admin"){
            header('Location:http://localhost/module-connexion/admin.php'); //redirigé vers la page admin
        }

        // connexion
        $mysqli = new mysqli('localhost', 'root', '', 'moduleconnexion');
        // requete
        $request = $mysqli -> query("SELECT * FROM `utilisateurs` where `login` = '$login' AND `password` = '$password'"); 
        //affiche les infos
        while(($result = $request -> fetch_array()) != null){
            ?>
                <div id="box">
                        <form action="" method="post">
                            <label for="login">Login :</label><br>  
                            <input type="text"  name="login" value="<?php echo $result['login'] ?>" size="30" required><br>
                            <br>
                            <label for="nom">Nom :</label><br>
                            <input type="text"  name="nom" value="<?php echo $result['nom'] ?>" size="30" required> <br>
                            <br>
                            <label for="prenom">Prenom :</label><br>
                            <input type="text"  name="prenom" value="<?php echo $result['prenom'] ?>" size="30" required><br>  
                            <br>
                            <label for="password1">Mot de passe :</label><br>
                            <input type="password"  name="password1" placeholder="Mot de passe" size="30" required> <br> 
                            <br>
                            <label for="password2">Répéter votre Mot de passe :</label><br>
                            <input type="password"  name="password2" placeholder="Mot de passe" size="30" required>  <br>
                            <br>
                            <input type="checkbox" onclick="myFunction()">Afficher le mot de passe <br>
                            <br>
                            <input type="submit" value="Valider les changements"><br>
                        </form>
                </div>
                <?php
    }
    }
        
    ?>



</body>


</html>
