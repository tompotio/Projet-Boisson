<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
   <script src="./checkForm.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
        session_start();
        if(isset($_SESSION['id'])){
            header("location:http://localhost");
        }
        ?>
<div class="video-wrapper">
<a style='color:black;' href=http://localhost><img style='width:320px;object-fit:cover;position:absolute;top:0;left:10px' src='http://localhost/projetBoisson/ressources/logo.png'/></a>
    <div class="header" id="connectionForm">
        <div id="formScreen">
            <form>
                <div>
                 <p>Login</p>
                    <input type="text" placeholder="Login" id="login">
                </div>
                <div>
                    <p>Mot de passe</p>
                    <input type="password" placeholder="Mot de passe" id="mdp" >
                </div>
                <div>
                <input id="connection" type="submit" value="Se connecter">
                </div>
                <div class="register-button">
                    <button><a href="../subscribe/inscription.php">S'inscrire</a></button>
                </div>
            </form>
            <p style ="color:red; visibility:hidden;">Nom d'utilisateur ou mot de passe incorrect</p>
        </div>
    </div>  
</div>  
</body>
</html>
