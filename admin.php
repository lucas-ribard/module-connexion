<?php
    //recup infos de session
    session_start();
    $login=$_SESSION['login'];
    $password=$_SESSION['password'];
    // connexion
    $mysqli = new mysqli('localhost', 'root', '', 'moduleconnexion');
    // requete
    $request = $mysqli -> query("SELECT * FROM utilisateurs");  
    //verifie qu'on est connecté en admin
    if ($login==="admin" and $password==="admin"){

?>

<!DOCTYPE html>
<html lang="fr">
<meta charset="utf-8">

<head>
    <title>Profil</title>
    <link href="CSS/admin.css" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

</head>

<body>
     <!-- menu nav -->
  <ul id="nav">
        <li><a href="/module-connexion/index.php">Home</a></li>
        <li><a href="/module-connexion/inscription.php">S'inscrire</a></li>
        <li><a href="/module-connexion/connexion.php">Se Déconnecter</a></li>
    </ul>
   <br><br><br>
   <section id="main">
    <div id="box">
        <table>
            <thead>
                <tr>
                    <td><strong>login</strong></td>
                    <td><strong>prenom</strong></td>
                    <td><strong>nom</strong></td>
                    <td><strong>password</strong></td>
                
                </tr>
            </thead>
            <tbody>
                <?php
                    while(($result = $request -> fetch_array()) != null)
                    {
                        echo "<tr>";
                        echo "<td>".$result['login']."</td>";
                        echo "<td>".$result['prenom']."</td>";
                        echo "<td>".$result['nom']."</td>";
                        echo "<td>".$result['password']."</td>";
                        echo "</tr>";
                    }
                ?>
        </table>
        </div>
    </section>
    <?php
}
else{
    echo "Vous n'avez pas le droit d'etre ici";
    header('Location:http://localhost/module-connexion/profil.php'); //redirigé vers la page profil.php
}
?>
</body>
</html>