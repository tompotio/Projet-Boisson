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
<div class="video-wrapper">
        <video playsinline autoplay muted loop poster="">
        <source src="../ressources/field.mp4" type="video/mp4">
        Your browser does not support the video tag.
        </video>

    <div id="connectionForm">
        <div id="formScreen">
            <form id="form">
                <div>
                 <label for="login">Login</label>
                    <input for="login"  type="text" placeholder="Login" id="login">
                    <p id="erreurLoginCP" style="color:red;display:none">votre login ne peut pas contenir de caractères spéciaux</p>
                    <p id="erreurLoginLength" style="color:red;display:none">votre login doit avoir au moins 1 caractères</p>
                </div>
                <div>
                    <label for="mdp">Mot de passe</label>
                    <input type="password"  placeholder="Mot de passe" id="mdp" >
                    <p id="erreurMDPLength"style="color:red;display:none">Votre mot de passe doit contenir doit au moins avoir 6 caractères</p>
                </div>
                <div>
                    <label for="nom">nom</label>
                    <input id="nom" type="text" placeholder=nom>
                    <p id="erreurNom"style="color:red;display:none">votre nom ne doit pas contenir autre chose que des lettres</p>
                </div>
                <div>
                    <label for="prénom">prénom</label>
                    <input id="prénom"type="text" placeholder = prénom>
                    <p id="erreurprenom"style="color:red;display:none">votre nom ne doit pas contenir autre chose que des lettres</p>
                </div>
                
                <div>
                    <label for="mail">email</label>
                    <input id="mail" type="text" placeholder=email>
                    <p id="erreurMail" style="color:red;display:none"> votre mail n'est pas valide</p>
                </div>
                <div>
                    <label for="adresse">adresse</label>
                    <input type="text" placeholder="adresse" id="adresse">
                    <p id="erreurAdresse" style="color:red;display:none"> votre adresse n'est pas valide</p>
                </div>
                <div>
                    <label for="cp">code postal</label>
                    <input type="text" id="cp" placeholder="codePostal">
                    <p id="erreurCodePostal" style="color:red;display:none"> le code n'est pas valide</p>
                </div>
                <div>
                    <label for="ville">ville</label>
                    <input type="text" placeholder=ville id="ville">
                    <p id="erreurVille" style="color:red;display:none"> la ville n'est pas valide</p>

                </div>
                <div>
                    <label for="téléphone">numéro de téléphone</label>
                    <input type="tel"placeholder=numéro id="téléphone">
                    <p id="erreurtéléphone" style="color:red;display:none"> le téléphone n'est pas valide</p>
                </div>
                <div>
                    <label for="birthday">date de naissance</label>
                    <input type="date" id=birthday>
                </div>
             <div>
             <input id="inscription" type="submit" value="s'inscrire">
            <p>vous avez déjà un compte ? <a href="http://localhost/projetBoisson/connexion.php">Connectez-vous</a></p>
             </div>
            </form>
            <p id='responseAnswer' style ="color:red; display:none;">Nom d'utilisateur ou mot de passe incorrect</p>
        </div>
    </div>
</div>
</body>
</html>