const subscribeForm = document.getElementById("form");
const erreurMDPLength = document.getElementById("erreurMDPLength");
const erreurLoginCP = document.getElementById("erreurLoginCP");
const erreurLoginLength = document.getElementById("erreurLoginLength");
const erreurprenom = document.getElementById("erreurprenom");
const erreurNom = document.getElementById("erreurNom");
const erreurMail = document.getElementById("erreurMail");
const erreurAdresse = document.getElementById("erreurAdresse");
const erreurCodePostal = document.getElementById("erreurCodePostal");
const erreurVille = document.getElementById("erreurVille");
const erreurTelephone = document.getElementById("erreurtéléphone");
const login = document.getElementById("login");
const mdp = document.getElementById("mdp");
const nom = document.getElementById("nom");
const prenom = document.getElementById("prénom");
const mail = document.getElementById("mail");
const adresse = document.getElementById("adresse");
const cp = document.getElementById("cp");
const ville = document.getElementById("ville");
const téléphone = document.getElementById("téléphone");
const birthday = document.getElementById("birthday");
const responseAnswer = document.getElementById("responseAnswer");

document.addEventListener("click",e=>{
    if(erreurMDPLength.style.display === 'block'){
        erreurMDPLength.style.display = 'none';
    }
    if(erreurLoginCP.style.display === 'block'){
        erreurLoginCP.style.display = 'none';
    }
    if(erreurLoginLength.style.display === 'block'){
        erreurLoginLength.style.display = 'none';
    }
    if(erreurNom.style.display==="block"){
        erreurNom.style.display="none";
    }
    if(erreurprenom.style.display === "block"){
        erreurprenom.style.display = "none";
    }
    if(erreurMail.style.display === "block"){
        erreurMail.style.display = 'none'
    }
    if(erreurAdresse.style.display === "block"){
        erreurMail.style.display = "none";
    }
    if(erreurVille.style.display === "block"){
        erreurMail.style.display = "none";
    }
    if(erreurTelephone.style.display === "block"){
        erreurMail.style.display = "none";
    }
    if(responseAnswer.style.display === "block"){
        responseAnswer.style.display = "none";

    }
})
subscribeForm.addEventListener('submit',e=>{
    e.preventDefault();
    
    let success = true;
    if(mdp.value.length<5){
        erreurMDPLength.style.display = 'block';
        success = false;
    }
    if(login.value.length<1){
        erreurLoginLength.style.display= 'block';
        success = false;
    }
    
    if(!/[a-zA-ZÀ-ú0-9]+/.test(login.value) && login.value.length>0){
        erreurLoginCP.style.display='block';
        success = false;
    }
    if(!/^[a-zA-ZÀ-ú]+$/.test(nom.value) &&nom.value.length!==0){
        erreurNom.style.display="block";
        success = false;
    }
    if(!/^[a-zA-ZÀ-ú]+$/.test(prenom.value) &&prenom.value.length!==0){
        erreurprenom.style.display="block";
        success = false;
    }
    var emailReg = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/i);
    if(!emailReg.test(mail.value)&& mail.value.length>0){
        erreurMail.style.display="block";
        success = false;
    }
    if(!/^[0-9]+[,][a-z\sA-Z]+$/.test(adresse.value) && adresse.value.length> 0){
        erreurAdresse.style.display="block";
        success = false;
    }
    
    if(!(/^[0-9]{5}$/.test(cp.value)) && cp.value.length>0){
        erreurCodePostal.style.display="block";
        success = false;
    }
    if(!(/^[a-zA-Z]+[-]?[a-zA-Z]+$/).test(ville.value)&& ville.value.length>0){
        erreurVille.style.display = "block";
        success = false;
    }
    console.log(téléphone.value)
    if(!/(0|\\+33|0033)[1-9][0-9]{8}/.test(téléphone.value) && téléphone.value.length>0){
        erreurTelephone.style.display = "block";
        success = false;
    }
    const sexe = document.querySelector("input[type=radio]:checked");
   const value = sexe===null?"":sexe.value;
    console.log(value);
    if(success){
        const options = {
            method: 'POST', // Utilisation de la méthode POST
            body: JSON.stringify({login:login.value,
                password:mdp.value,
                nom:nom.value,
                prenom:prenom.value,
                sexe:value,
                mail:mail.value,
                adresse:adresse.value,
                cp:cp.value,
                ville:ville.value,
                téléphone:téléphone.value,
                birthday:birthday.value}) // Convertir les données en JSON
        };
        fetch("insertSubscribe.php",options).then((res)=>res.json()).then(el=>{
            if(el.status === 'failed'){
                responseAnswer.innerText = el.message;
                responseAnswer.style.display = "block"
            }
            if(el.status === "success"){
                document.location.href="http://localhost"; 
            }
        });
    }
})
