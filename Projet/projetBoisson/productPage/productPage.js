const search = document.querySelector(".search");
const grid =document.querySelector(".grid");
const createElement = (recipe)=>{
    const divProduct = document.createElement("div");
    divProduct.classList.add("gridItem");
    divProduct.innerHTML=`<img style='width:100px;height:100px;object-fit:cover;' class ='photo' src=${recipe[2]}>
    <p><a href=http://localhost/projetBoisson/productPage/recipe.php?recipe=${recipe[1]}>${recipe[0]}</a></p></div>`
    grid.appendChild(divProduct);
}
search.addEventListener("input",(el)=>{
    searchParam = new URL(document.location).searchParams;
    const product = searchParam.get("produit");
    fetch("./search.php",{
        method:'POST',
        body:JSON.stringify({search:el.target.value,id:product})
    }).then((data)=>data.json()).then(res=>{
        grid.innerHTML='';
        res.forEach(element => {
            createElement(element);
        });
       

    })}
)

