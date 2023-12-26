

document.addEventListener("DOMContentLoaded",()=>{
    const ConnectionForm = document.querySelector("#formScreen form");
    const errorLog = document.querySelector("#formScreen > p ");
    ConnectionForm.addEventListener("submit",e=>{
        e.preventDefault();
        const login = document.getElementById("login");
        let loginValue = login.value
        const password = document.getElementById("mdp");
        let passwordValue = password.value;
        let LoginObject = {'login':loginValue,'password':password,'typeConnection':'connection'};
        const options = {
            method: 'POST', // Utilisation de la méthode POST
            body: JSON.stringify({login:loginValue,password:passwordValue}), // Convertir les données en JSON
          };
          
          // Utilisation de l'API Fetch pour envoyer la requête avec des données
          fetch("./connection/checkConnection.php", options)
            .then(response => {
              // Gérer la réponse ici
              if (!response.ok) {
                throw new Error(`Erreur HTTP! Statut: ${response.status}`);
              }
              return response.json(); // Ou response.text() selon le type de données que vous attendez
            })
               .then(data => {
                
             // Traiter les données renvoyées par le serveur PHP
              if(data.status=== "failed"){
                errorLog.style='visibility:visible;color:red';
            }else{
                window.location.replace("http://localhost"); 
             }
            })
            .catch(error => {
              // Gérer les erreurs
              console.error('Erreur lors de la requête Fetch:', error);
            });
       
})
})

