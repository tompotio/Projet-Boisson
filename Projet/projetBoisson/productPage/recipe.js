const button = document.querySelector(".addToCart")
const search = document.querySelector(".search");
search.style.display='none'
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
                toast.innerText="ce produit à été ajouté à vos favoris"
                document.body.appendChild(toast); 
                button.innerText="retirer des favoris"
                setTimeout(()=>{
                    toast.remove();
                    canClick=true;
                },2300);
            }else{
                toast.innerText="ce produit à été retiré des favoris"
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