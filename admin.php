<?php
    // connexion
    $mysqli = new mysqli('localhost', 'root', '', 'moduleconnexion');
    // requete
    $request = $mysqli -> query("SELECT * FROM utilisateurs");    
?>
        <style>
        table,th,td {
            padding: 10px;
            border: 2px solid black;
            border-collapse: collapse;
        }
        </style>
</head>

<body>

    <table>
        <thead>
            <tr>
                <td>login</td>
                <td>prenom</td>
                <td>nom</td>
                <td>password</td>
            
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
</body>
</html>