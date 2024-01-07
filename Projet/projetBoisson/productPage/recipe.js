const button = document.querySelector(".addToCart")
const search = document.querySelector(".search");
search.style.display='none'
const loupe = document.querySelector(".loupe"); 
loupe.style.display='none'
let canClick = true;
button.addEventListener("click",()=>{
    
   
   searchParam = new URL(document.location).searchParams;
    if(canClick){
        recipe = searchParam.get("recipe")
        fetch("../connection/addToCart.php",{
            method:'post',
            body:JSON.stringify({id:recipe})
        }).then((res)=>res.json()).then(data=>{
            console.log(data["status"]);
            const toast = document.createElement("div");
            toast.classList.add("ToastShow");
            if(data.status==='add'){
                toast.innerHTML="<p style='text-align:center;font-weight:bold;'>Ajout</p><p>✅ Ce produit a été ajouté à vos favoris</p>"
                document.body.appendChild(toast); 
                button.innerText="retirer des favoris"
                setTimeout(()=>{
                    toast.remove();
                    canClick=true;
                },2300);
            }else{
                toast.innerHTML="<p style='text-align:center;font-weight:bold;'>Suppression</p><p>❌ Ce produit a été retiré de vos favoris</p>"
                document.body.appendChild(toast); 
                button.innerText="ajouter aux favoris"
                setTimeout(()=>{
                    toast.remove();
                    canClick=true;
                },2300);
            }
            canClick=false;
        });
    }
});