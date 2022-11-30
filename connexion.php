<!DOCTYPE html>
<html lang="fr">
<meta charset="utf-8">

<head>
    <title>Connexion</title>
    <link href="CSS/connexion.css" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
 
</head>


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




<body>
  <!-- menu nav -->
  <ul id="nav">
        <li><a href="/module-connexion/index.php">Home</a></li>
        <li><a href="/module-connexion/inscription.php">S'inscrire</a></li>
        <li><a class="active" href="/module-connexion/connexion.php">Se Connecter</a></li>
    </ul>
<section id="main">
    <div id="form"> 
    <br>
        <h1>Se Connecter</h1><br>
        <hr>
        <div id="box">
            <!-- ajouter la redirection apres que l'inscription soit finie -->
            <form action="" method="post">
                <label for="login">Login :</label><br>
                <input type="text" name="login" id="login" size="30" required>  <br>
                <br>
                <label for="password2">Répéter votre Mot de passe :</label><br>
                <input type="password" name="password" id="password" size="30" required>  <br>
                <br>
                <input type="checkbox" onclick="myFunction()">Afficher le mot de passe <br>
                <br>
                <input type="submit" value="envoyer"><br>
            </form>


            <?php 
             
                session_start();
                    
                    // connexion
                    $mysqli = new mysqli('localhost', 'root', '', 'moduleconnexion');

                        /* on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
                            pour éliminer toute attaque de type injection SQL et XSS
                                source : https://www.codeurjava.com/2016/12/formulaire-de-login-avec-html-css-php-et-mysql.html  */

                    $username = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['login'])); 
                    $password = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['password']));

                    //echo "\'criptage\' data<br>";   // / / /test/ / /
                    
                    if(isset($username) AND isset($password) ){
                     
                        $requete = "SELECT count(*) FROM `utilisateurs` where `login` = '$username' AND `password` = '$password' ";
                        
                        //echo "requete formulé<br>"; // / / /test/ / /

                        $exec_requete = mysqli_query($mysqli,$requete);

                        //echo "exec requette<br>"; // / / /test/ / /

                        $reponse = mysqli_fetch_array($exec_requete);

                        //echo "reponse = "; // / / /test/ / /

                        $count = $reponse['count(*)'];
                        
                        //echo $count,"<br>"; // / / /test/ / /
                        
                        if($count!=0){ // nom d'utilisateur et mot de passe correctes
                            $_SESSION['login'] = $username; //
                            header('Location:http://localhost/module-connexion/profil.php'); //redirigé vers la page profil.php
                        }
                        elseif($count==0){
                            echo "<br><error>utilisateur ou mot de passe incorrect</error>";
                        }
                    }
                    else{
                       echo "<br><error>utilisateur ou mot de passe vide</error>";
                    }
                    mysqli_close($mysqli); // fermer la connexion
                ?>

        </div>
    </div>

</section>    
</body>




</html>



