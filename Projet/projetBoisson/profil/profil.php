<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../arbreStyle.css">
    <title>Document</title>
    <link rel="stylesheet" href="profil.css">
    <script defer src="profil.js"></script>
</head>
<body>
    <?php
    include("../tree.php");
    ?>
    <div class="container">
        <?php
        include("../../Identifiant/identifiantSQL.inc.php");
        $connection = new PDO("mysql:host=$servername;dbname=$dataBase",$username,$password); 
        $request = "select * from user where id =". $_SESSION['id'];
        $stmt = $connection->query($request);
        $data = $stmt->fetch();
        echo("<h1 class='Titre'>Bienvenue ".$data['login']."</h1>");
        ?>
        
        <form class='formProfil'>
            <div class='inputProfil'>
            <label for="mot de passe">Changer votre mot de passe</label>
            <input type=text name='mot de passe'>
            </div>
            
            <div class='inputProfil'>
            <label for="prenom">Prenom</label>
            <input type="text" name="prenom" value=<?php echo($data['prenom'])?>>
            </div>
            <div class='inputProfil'>
            <label for="nom">Nom</label>
            <input type="text" name="nom" value=<?php echo($data['nom'])?>>
            </div>
            <div class='inputProfil'>
            <label for="telephone">Tel</label>
            <input type="tel" name="telephone" value=<?php echo($data['telephone'])?>>
            </div>
       
            <div class='inputProfil'>
            <label for="mail">Mail</label>
            <input type="mail" name=mail value=<?php echo($data['mail'])?>>
            </div>
            <div class='inputProfil'>
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" value=<?php echo($data['Street'])?>>
            </div>
            <div class='inputProfil'>
            <label for="codePostal">CodePostal</label>
            <input type="text" name="codePostal" value=<?php echo($data['zipCode'])?>>
            </div>
            <div class='inputProfil'>
            <label for="ville">Ville</label>
            <input type="text" name="ville" value=<?php echo($data['city'])?>>
            </div>
            <input type="submit">
        </form>
    </div>
</body>
</html>