<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../arbreStyle.css">
    <title>Profil</title>
    <link rel="stylesheet" href="profil.css">
    <script defer src="profil.js"></script>
</head>
<body>
    <?php
    
    session_start();
    if(!isset($_SESSION['id'])){
        header("location:http://".$_SERVER['SERVER_NAME']);
    }else{
        session_abort();
        include("../tree.php");
    }
    
    
    ?>
    <div class="container">
        <?php
        include("../../Identifiant/identifiantSQL.inc.php");
        $connection = new PDO("mysql:host=$servername;dbname=$dataBase;charset=utf8mb4",$username,$password); 
        $request = "select * from USER where id =". $_SESSION['id'];
        $stmt = $connection->query($request);
        $data = $stmt->fetch();
        echo("<h1 class='Titre'>Bienvenue ".$data['login']."</h1>");
        $connection=null;
        ?>
        
        <form>
       
           <div class='formProfil'>
            <div class='inputProfil'>
            <label for="prenom">Prenom</label>
            <input type="text" name="prenom" placeholder=' ' value=<?php echo($data['prenom'])?>>
            </div>
            <div class='inputProfil'>
            <label for="nom">Nom</label>
            <input type="text" name="nom" placeholder=' ' value=<?php echo($data['nom'])?>>
            </div>
            <div class='inputProfil'>
            <label for="telephone">Tel</label>
            <input type="tel" name="telephone" placeholder=' ' value=<?php echo($data['telephone'])?>>
            </div>
            <div class='inputProfil'>
            <label for="mail">Mail</label>
            <input type="mail" name="mail" placeholder=' ' value=<?php echo($data['mail'])?>>
            </div>
            <div class='inputProfil'>
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" placeholder=' ' value=<?php echo($data['Street'])?>>
            </div>
            <div class='inputProfil'>
            <label for="codePostal">CodePostal</label>
            <input type="text" name="codePostal" placeholder=' ' value=<?php echo($data['zipCode'])?>>
            </div>
            <div class='inputProfil'>
            <label for="ville">Ville</label>
            <input type="text" name="ville" placeholder=' ' value=<?php echo($data['city'])?>>
            </div>
            <input type="submit" value="enregistrer les modification">
            </div>
            
        </form>
    </div>
</body>
</html>