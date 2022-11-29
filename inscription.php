<!DOCTYPE html>
<html lang="fr">
<meta charset="utf-8">

<head>
    <title>Insciption</title>
    <link href="CSS/connexion.css" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
 
</head>


<script>
//fonction en javascript (https://www.w3schools.com/howto/howto_js_toggle_password.asp)
function myFunction() {
    var x1 = document.getElementById("password1");
    var x2 = document.getElementById("password2");
    if (x1.type === "password") {
    x1.type = "text";
    x2.type = "text";
    } else {
    x1.type = "password";
    x2.type = "password";
    }
} 
</script>




<body>
  <!-- menu nav -->
  <ul id="nav">
        <li><a href="/module-connexion/index.php">Home</a></li>
        <li><a class="active" href="/module-connexion/inscription.php">S'inscrire</a></li>
        <li><a href="/module-connexion/connexion.php">Se Connecter</a></li>
    </ul>
<section id="main">
    <div id="form"> 
    <br>
        <h1>S'inscrire</h1><br>
        <hr>
        <div id="box">
           
            <form action="connexion.php" method="post">
                <label for="login">Login :</label><br>
                <input type="text"  id="login" size="30" required>  <br>
                <br>
                <label for="nom">Nom :</label><br>
                <input type="text"  id="nom" size="30" required> <br>
                <br>
                <label for="prenom">Prenom :</label><br>
                <input type="text"  id="prenom" size="30" required><br>  
                <br>
                <label for="password1">Mot de passe :</label><br>
                <input type="password"  id="password1" size="30" required> <br> 
                <br>
                <label for="password2">Répéter votre Mot de passe :</label><br>
                <input type="password"  id="password2" size="30" required>  <br>
                <br>
                <input type="checkbox" onclick="myFunction()">Afficher le mot de passe <br>
                <br>
                <input type="submit" value="envoyer"><br>
            </form>
            <?php 
                //recup les valeurs du formulaire
                $login=$_POST["login"];
                $nom=$_POST["nom"];
                $prenom=$_POST["prenom"];
                $password1=$_POST["password1"];
                $password2=$_POST["password2"];

                /*verifie que les deux mots de passes sont identiques*/
                if(isset($login)and isset($nom) and isset($prenom) and isset($password1)){
                    if($password1===$password2){
                        // connexion
                        $mysqli = new mysqli('localhost', 'root', '', 'moduleconnexion');
                        //la requete sql
                        $sql = "INSERT INTO `utilisateurs`(`login`, `prenom`, `nom`, `password`) VALUES ('$login','$nom','$prenom','$password1')";

                        //si requete réussit
                        if ($mysqli->query($sql) === TRUE) {
                            //echo "\ \ \ test \ \ \  inscription réussit";

                        //si requete echoué
                        } else {
                            echo "Erreur: " . $sql . "
                        " . $mysqli->error;
                        }
                        //ferme la connection
                        $mysqli->close();
                    }
                    //les deux mots de passe ne sont pas identiques
                    else{
                        echo "<br><error>Les deux Mots De Passes ne sont pas identiques</error><br>";
                    }
                }
                ?>
        </div>
    </div>

</section>    
</body>




</html>



