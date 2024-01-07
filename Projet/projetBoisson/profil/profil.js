const search = document.querySelector(".search")
search.style.display='none';

const loupe= document.querySelector(".loupe");
loupe.style.display='none';
const prenom = document.querySelector("input[name='prenom']");
const nom = document.querySelector("input[name='nom']");
const téléphone = document.querySelector("input[name='telephone']");
const mail = document.querySelector("input[name='mail']");
const adresse = document.querySelector("input[name='adresse']");
const codePostal = document.querySelector("input[name='codePostal']");
const ville = document.querySelector("input[name='ville']");
const form =document.querySelector("form");

const erreurPrenom = document.createElement("p");
erreurPrenom.style.color='red'
erreurPrenom.innerText="Le prénom peut contenir uniquement des lettres"
erreurPrenom.style.visibility="hidden";
erreurPrenom.style.width='max-content'
prenom.after(erreurPrenom)
const erreurNom = document.createElement("p");
erreurNom.style.color='red'
erreurNom.innerText="Le nom peut contenir uniquement des lettres"
erreurNom.style.visibility="hidden";
erreurNom.style.width='max-content'
nom.after(erreurNom)
const erreurTelephone = document.createElement("p");
erreurTelephone.style.color='red';
erreurTelephone.innerText="Le format n'est pas bon le numero ne peut contenir que des chiffres et doit commmencer par zero"
erreurTelephone.style.visibility="hidden";
erreurTelephone.style.width='max-content';
téléphone.after(erreurTelephone);
const erreurMail= document.createElement("p");
erreurMail.style.color='red';
erreurMail.innerText="votre mail n'est pas au bon format"
erreurMail.style.visibility="hidden";
erreurMail.style.width='max-content'
mail.after(erreurMail);
const erreurAdresse = document.createElement("p");
erreurAdresse.style.color='red';
erreurAdresse.innerText="Le format n'est pas bon votre adresse doit commencer par au moins suivi d'une virgule"
erreurAdresse.style.visibility="hidden";
erreurAdresse.style.width='max-content'
adresse.after(erreurAdresse);
const erreurVille = document.createElement("p");
erreurVille.style.color='red';
erreurVille.innerText="Le nom de votre ville n'est pas correcte"
erreurVille.style.visibility="hidden";
erreurVille.style.width='max-content';
ville.after(erreurVille);
const erreurCodePostal = document.createElement("p");
erreurCodePostal.style.color='red';
erreurCodePostal.innerText="Le code postal est invalide"
erreurCodePostal.style.visibility="hidden";
erreurCodePostal.style.width='max-content'
codePostal.after(erreurCodePostal);
form.addEventListener("submit",(e)=>{
    e.preventDefault();
    success = true;
    
    if(prenom.value.length!==0 && !/^[a-zA-ZÀ-ú\é\è\ê\-]+$/.test(prenom.value)){
        erreurPrenom.style.visibility="visible";
        success = false;
    }
    else{
        erreurPrenom.style.visibility="hidden";
    }
    if(nom.value.length!==0 && !/^[a-zA-ZÀ-ú\é\è\ê\-]+$/.test(nom.value)){
        erreurNom.style.visibility="visible";
        success = false;
    }
    else{
        erreurNom.style.visibility="hidden";
    }
    var emailReg = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/i);
    if(!emailReg.test(mail.value)&& mail.value.length>0){
        erreurMail.style.visibility="visible";
        success = false;
    }
    else{
        erreurMail.style.visibility="hidden";
    }
    if(!/^[0-9]+[,][a-z\sA-Z]+$/.test(adresse.value) && adresse.value.length> 0){
        erreurAdresse.style.visibility='visible'
        success = false;
    }
    else{
        erreurAdresse.style.visibility="hidden"
    }
    
    if(!(/^[0-9]{5}$/.test(codePostal.value)) && codePostal.value.length>0){
        erreurCodePostal.style.visibility='visible'
        success = false;
    }else{
        erreurCodePostal.style.visibility="hidden"
    }
    if(!(/^[a-zA-Z\u0080-\u024F\s\/\-\)\(\`\.\"\']+$/).test(ville.value)&& ville.value.length>0){
        erreurVille.style.visibility='visible'
        success = false;
    }
    else{
        erreurVille.style.visibility='hidden';
    }
    if(!/(0|\\+33|0033)[1-9][0-9]{8}/.test(téléphone.value) && téléphone.value.length>0){
        erreurTelephone.style.visibility='visible'
        success = false;
    }
    else{
        erreurTelephone.style.visibility='hidden';
    }
    if(success){
        const options = {
            method: 'POST', // Utilisation de la méthode POST
            body: JSON.stringify(
                {
                nom:nom.value,
                prenom:prenom.value,
                mail:mail.value,
                adresse:adresse.value,
                codepostal:codePostal.value,
                ville:ville.value,
                téléphone:téléphone.value
                }
            ) // Convertir les données en JSON
        };
        fetch("updateSubscribe.php",options).then((res)=>res.text()).then(el=>{
            document.location.href="http://localhost"; 
        });
    }
})

