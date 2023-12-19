<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <script src="./connection/checkForm.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
        session_start();
        if(isset($_SESSION['id'])){
            header("location:http://localhost/projetBoisson/tree.php");
        }
        ?>
<div class="video-wrapper">
        <video playsinline autoplay muted loop poster="">
        <source src="ressources/field.mp4" type="video/mp4">
        Your browser does not support the video tag.
        </video>

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
                    <button><a href="subscribe/inscription.php">S'inscrire</a></button>
                </div>
            </form>
            <p style ="color:red; visibility:hidden;">Nom d'utilisateur ou mot de passe incorrect</p>
        </div>
    </div>  
</div>  
</body>
</html>
