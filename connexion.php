<script>
//fonction en javascript qui affiche le mot de passe si demandé (https://www.w3schools.com/howto/howto_js_toggle_password.asp)
function affichPass() {
    var x = document.getElementById("password"); //! important pointe les mots de passe par id (si le mot de passe n'a pas d'id ca ne marchera pas)
      //change l'input de 'texte' a  'password' et inversement
    if (x.type === "password") {
    x.type = "text";
    } else {
    x.type = "password";
    }
} 
</script>
            
<?php 


//ouvre une session
session_start();
//on vide les variables session pour etre sur qu'il n'y ait pas de probleme
$_SESSION['login']=NULL;
$_SESSION['password']=NULL;
// connexion
$mysqli = new mysqli('localhost', 'root', '', 'moduleconnexion');

/* on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    pour éliminer toute attaque de type injection SQL et XSS
        source : https://www.codeurjava.com/2016/12/formulaire-de-login-avec-html-css-php-et-mysql.html  */
$username = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['login'])); 
$password = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['password']));      

if(!empty($username) AND !empty($password) ){   
    //requete qui compte le nombre d'entré de la base de donnée ou le login et le mot de passe sont identique a celui rentré             
    $requete = "SELECT count(*) FROM `utilisateurs` where `login` = '$username' AND `password` = '$password' ";
    $exec_requete = mysqli_query($mysqli,$requete);
    $reponse = mysqli_fetch_array($exec_requete);
    $count = $reponse['count(*)'];

    if($count!=0){ // nom d'utilisateur et mot de passe correctes
        $_SESSION['login'] = $username; //enregistre l'utilisateur dans la session
        $_SESSION['password'] = $password; //enregistre le mot de passe dans la session
        header('Location:http://localhost/module-connexion/profil.php'); //redirigé vers la page profil.php
    }
    else{
        $message="<br><error>utilisateur ou mot de passe incorrect</error>";
    }
}
    mysqli_close($mysqli); // ferme la connexion
?>

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
            <!-- formulaire -->
            <form action="" method="post">
                <label for="login">Login :</label><br>
                <input type="text" name="login" id="login" size="30" required>  <br>
                <br>
                <label for="password2">Mot de passe :</label><br>
                <input type="password" name="password" id="password" size="30" required>  <br>
                <br>
                <input type="checkbox" onclick="affichPass()">Afficher le mot de passe <br>
                <br>
                <input type="submit" value="envoyer"><br>
            </form>

            <?php 
                    if (isset($message)){
                        echo $message;  //affiche un message d'erreur si probleme
                    }
                    
                ?>

        </div>
    </div>

</section>    
</body>




</html>



