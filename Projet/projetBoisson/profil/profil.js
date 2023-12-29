const mdp = document.querySelector("input[name='mot de passe']");
const prenom = document.querySelector("input[name='prenom']");
console.log(prenom)
const nom = document.querySelector("input[name='nom']");
const téléphone = document.querySelector("input[name='telephone']");
const dateDeNaissance = document.querySelector("input[name='date de naissance']");
const mail = document.querySelector("input[name='mail']");
const adresse = document.querySelector("input[name='adresse']");
const codePostal = document.querySelector("input[name='codePostal']");
const ville = document.querySelector("input[name='ville']");
const form =document.querySelector(".formProfil");
const erreurMDP = document.createElement("p");
const erreurPrenom = document.createElement("p");
erreurPrenom.style.color='red'
erreurPrenom.innerText="Le prénom peut contenir uniquement des lettres"
erreurPrenom.style.visibility="hidden";
prenom.after(erreurPrenom)
const erreurNom = document.createElement("p");
erreurNom.style.color='red'
erreurNom.innerText="Le nom peut contenir uniquement des lettres"
erreurNom.style.visibility="hidden";
nom.after(erreurNom)
const erreurTelephone = document.createElement("p");
erreurTelephone.style.color='red';
erreurTelephone.innerText="Le format n'est pas bon le numero ne peut contenir que des chiffres et doit commmencer par zero"
erreurTelephone.style.visibility="hidden";
téléphone.after(erreurTelephone);
const erreurMail= document.createElement("p");
erreurMail.style.color='red';
erreurMail.innerText="Le format n'est pas bon le numero ne peut contenir que des chiffres et doit commmencer par zero"
erreurMail.style.visibility="hidden";
mail.after(erreurTelephone);
const erreurAdresse = document.createElement("p");
erreurTelephone.style.color='red';
erreurTelephone.innerText="Le format n'est pas bon le numero ne peut contenir que des chiffres et doit commmencer par zero"
erreurTelephone.style.visibility="hidden";
téléphone.after(erreurTelephone);
const erreurVille = document.createElement("p");
erreurTelephone.style.color='red';
erreurTelephone.innerText="Le format n'est pas bon le numero ne peut contenir que des chiffres et doit commmencer par zero"
erreurTelephone.style.visibility="hidden";
téléphone.after(erreurTelephone);
const erreurCodePostal = document.createElement("p");
form.addEventListener("submit",(e)=>{
    e.preventDefault();
    success = true;
    console.log(prenom.value)
    if(prenom.value.length!==0 && !/^[a-zA-ZÀ-ú]+$/.test(prenom.value)){
        erreurPrenom.style.visibility="visible";
        success = false;
    }
    else{
        erreurPrenom.style.visibility="hidden";
    }
    if(nom.value.length!==0 && !/^[a-zA-ZÀ-ú]+$/.test(nom.value)){
        erreurNom.style.visibility="visible";
        success = false;
    }
    else{
        erreurNom.style.visibility="hidden";
    }
    if(téléphone.value.length!==0 && !/(0|\\+33|0033)[1-9][0-9]{8}/.test(téléphone.value)){
        erreurTelephone.style.visibility="visible";
        success = false;
    }
    else{
        erreurTelephone.style.visibility="hidden";
    }
})

