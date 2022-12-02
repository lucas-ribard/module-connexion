<script>
    //fonction en javascript qui affiche le mot de passe si demandé (https://www.w3schools.com/howto/howto_js_toggle_password.asp)
    function affichPass() {
        var x1 = document.getElementById("password1");  //! important pointe les mots de passe par id (si le mot de passe n'a pas d'id ca ne marchera pas)
        var x2 = document.getElementById("password2");  //ne marche pas avec deux mots de passe qui ont la meme id (qu'un seul sera affiché  (d'apres mes test je connais pas trop javascript))
        //change l'input de 'texte' a  'password' et inversement
        if (x1.type === "password") {
        x1.type = "text";
        x2.type = "text";
        } else {
        x1.type = "password";
        x2.type = "password";
        }
    } 
</script>

<?php
    //on ouvre et récupere les variables sessions
    session_start();
    $loginSession=$_SESSION['login'];
    $passwordSession=$_SESSION['password'];

    //verifie qu'un utilisateur est bien connecté
    if(isset($loginSession) AND isset($passwordSession) ){
        
        if($loginSession==="admin" and $passwordSession==="admin"){   //si admin
            header('Location:http://localhost/module-connexion/admin.php'); //redirigé vers la page admin
        }

        // connexion
        $mysqli = new mysqli('localhost', 'root', '', 'moduleconnexion');
        $request = $mysqli -> query("SELECT * FROM `utilisateurs` where `login` = '$loginSession' AND `password` = '$passwordSession'"); // recupere les infos de l'utilisateur
        $result = $request -> fetch_array() ;//recupere les infos dans l'array result


        if (isset($_POST['ValidChange'])) {//si on appuie sur le bouton
            //recupere tout les users
            $sql = "SELECT * FROM `utilisateurs`";
            $query = $mysqli->query($sql);
            $users=$query->fetch_all();
           
            //recup les valeurs du formulaire
            $login=$_POST["login"];
            $nom=$_POST["nom"];
            $prenom=$_POST["prenom"];
            $password1=$_POST["password1"];
            $password2=$_POST["password2"];
            //récup l'id de la session
            $id=$result['id'];

            if($password1===$password2 and $password1===$result['password']){   //verif que les mots de passe est correct

                $loginDispo=false;
                //parcours les utilisateur pour verifier qu'il n'existe pas déja (merci Aurélie)
                foreach($users as $user){
                    if($_POST['login'] == $user[1]){
                        $message="<br><error>Cet Utilisateur existe déja</error><br>"; //login existe deja
                        break;  //sort de la boucle (sinon il crée quand meme l'utilisateur)
                    }
                    else{
                        //si l'utilisateur n'existe pas 
                        $loginDispo = true;
                    }
                }
                //si l'user est dispo
                if($loginDispo === true){
                    //écrit dans la base de donné (id )les valeurs du form
                    $requestChange = $mysqli -> query(" UPDATE `utilisateurs` SET `login`='$login',`prenom`='$prenom',`nom`='$nom' WHERE id = '$id' "); // recupere les infos de l'utilisateur
                    $_SESSION['login'] = $username; //enregistre le nouvel utilisateur dans la session
                    $_SESSION['password'] = $password; //enregistre le nouveau mot de passe dans la session
                }
            }
            else {
                $message="<br><error>Mots de passe incorrect</error><br>";
            }

        }
    }
    
    //si l'utilisateur n'est pas connecté
    else{
        header('Location:http://localhost/module-connexion/connexion.php'); //redirigé vers la page connexion.php
    }
        
?>

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
<!-- menu nav -->
<ul id="nav">
<li><a href="/module-connexion/index.php">Home</a></li>
<li><a href="/module-connexion/inscription.php">S'inscrire</a></li>
<!-- cette partie de menu nav change si l'utilisateur est connecté-->
<?php 
 //si l'utilisateur est connecté
 if (!empty($loginSession) ){
    echo "<li><a href=",'/module-connexion/profil.php',">Bienvenue ",$loginSession,"</a></li>"; //affiche bienvenu $Utilisateur
    echo "<li><a href=",'/module-connexion/connexion.php',">Se déconnecter</a></li>";      //affiche se déconnecter (envoie a la page de login car il déco automatiquement)
    } 
    //si l'utilisateur n'est pas connecté
    else{
        echo "<li><a href=",'/module-connexion/connexion.php',">Se Connecter</a></li>";//affiche se conecter
    }
?>
<!--  fin menu nav -->

</ul>
    <div id="form"> 
        <div id="box">
            <form action="" method="post">
                <label for="login">Login :</label><br>  
                <input type="text"  name="login" value="<?php echo $result['login']; ?>" size="30" required><br>
                <br>
                <label for="nom">Nom :</label><br>
                <input type="text"  name="nom" value="<?php echo $result['nom']; ?>" size="30" required> <br>
                <br>
                <label for="prenom">Prenom :</label><br>
                <input type="text"  name="prenom" value="<?php echo $result['prenom']; ?>" size="30" required><br>  
                <br>
                <label for="password1">Mot de passe :</label><br>
                <input type="password"  id="password1" name="password1" placeholder="Mot de passe" size="30" required> <br> 
                <br>
                <label for="password2">Répéter votre Mot de passe :</label><br>
                <input type="password"  id="password2" name="password2" placeholder="Mot de passe" size="30" required>  <br>
                <br>
                <input type="checkbox" onclick="affichPass()">Afficher le mot de passe <br>
                <br>
                <input type="submit" name="ValidChange" value="Valider les changements"><br>
            </form>
            <?php 
                if (isset($message)){
                    echo $message;  //affiche un message d'erreur si probleme
                }   
            ?>
        </div>
    </div>



</body>


</html>
