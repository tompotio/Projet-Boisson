const createProduct = (container,recipe)=>{
    const divProduct = document.createElement("div")
    divProduct.classList.add("product");
    divProduct.innerHTML=`<img class='photo' src=${recipe[2]}>
                           
                           <h1><a style=text-decoration:none;color:black;font-weight:bold;' href="http://localhost/projetBoisson/productPage/recipe.php?recipe=${recipe[1]}">${recipe[0]}</h1></a>
                           
                           <div>
                           <button data-id=${recipe[1]} class='addToCart'>retirer des favoris</button>
                           </div>`
    container.appendChild(divProduct);
}
const addButtonlistener = ()=>{
    const deleteButton = document.querySelectorAll(".addToCart");
    deleteButton.forEach((el)=>{
    
    el.addEventListener("click",(e)=>{
        
            recipe = el.dataset.id
            fetch("../connection/addToCart.php",{
                method:'post',
                body:JSON.stringify({id:recipe})
            }).then((res)=>res.json()).then(data=>{
                const toast = document.createElement("div");
                toast.classList.add("ToastShow");
                toast.innerText="ce produit à été retiré des favoris"
                document.body.appendChild(toast); 
                setTimeout(()=>{
                    toast.remove();
                    canClick=true;
                    },2300);
                })
                e.target.parentElement.parentElement.remove()
            });
        
    })
}
addButtonlistener();
const searchBar = document.querySelector(".search input");
searchBar.addEventListener('input',(el)=>{
    
    fetch("./search.php",{
        method:'POST',
        body:JSON.stringify({search:el.target.value})
    }).then((data)=>data.json()).then(res=>{
        console.log(res);
        const productList = document.querySelector(".productList")
        productList.innerHTML ='';
        res.forEach((recipe)=>{
        createProduct(productList,recipe)
       })
       addButtonlistener()
        
    })});
