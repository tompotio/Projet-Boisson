<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
    <script src="subscribe.js"defer></script>
</head>
<body>
<div id="connectionForm">
        <div id="formScreen">
            <form id="form">
                <div>
                 <label for="login">Login</label>
                    <input for="login"  type="text" placeholder="Login" id="login">
                    <p id=erreurLoginCP style="color:red">votre login ne peut pas contenir de caractères spéciaux</p>
                </div>
                <div>
                    <label for="mdp">Mot de passe</label>
                    <input type="password"  placeholder="Mot de passe" id="mdp" >
                    <p style="color:red">Votre mot de passe doit contenir doit au moins avoir 6 caractères</p>
                </div>
                <div>
                    <label for="nom">nom</label>
                    <input id="nom" type="text" placeholder=nom>
                </div>
                <div>
                    <label for="prénom">prénom</label>
                    <input id="prénom"type="text" placeholder = prénom>
                </div>
                <div>
                    <label for="mail">email</label>
                    <input id="mail" type="email" placeholder=email>
                </div>
                <div>
                    <label for="adresse">adresse</label>
                    <input type="text" placeholder="adresse" id="adresse">
                </div>
                <div>
                    <label for="cp">code postal</label>
                    <input type="text" id="cp" placeholder="codePostal">
                </div>
                <div>
                    <label for="ville">ville</label>
                    <input type="text" placeholder=ville id="ville">
                </div>
                <div>
                    <label for="téléphone">numéro de téléphone</label>
                    <input type="tel"placeholder=numéro id="téléphone">
                </div>
             <div style="display:flex; gap:10px;flex-direction:column;">
             <input id="inscription" type="submit" value="s'inscrire">
            <p>vous avez déjà un compte ? <a href="../index.php">Connectez-vous</a></p>
             </div>
            </form>
            <p style ="color:red; visibility:hidden;">Nom d'utilisateur ou mot de passe incorrect</p>
        </div>
        
    </div>
</body>
</html>