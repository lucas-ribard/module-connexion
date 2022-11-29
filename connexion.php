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

                //recup les valeurs du formulaire
                $login=$_POST["login"];
                $password=$_POST["password"];

                // connexion
                $mysqli = new mysqli('localhost', 'root', '', 'moduleconnexion');
               
                $result = $mysqli->query("SELECT id FROM utilisateurs WHERE `login` = '$login'");
                var_dump($result);
                $mysqli->close();

                ?>
        </div>
    </div>

</section>    
</body>




</html>



