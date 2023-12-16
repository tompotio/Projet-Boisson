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
    <div id="connectionForm">
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
             <div style="display:flex; gap:10px">
             <input id="connection" type="submit" value="Se connecter">
             <button><a href="subscribe/inscription.php">S'inscrire</a></button>
             </div>
            </form>
            <p style ="color:red; visibility:hidden;">Nom d'utilisateur ou mot de passe incorrect</p>
        </div>
        
    </div>
    
</body>
</html>
