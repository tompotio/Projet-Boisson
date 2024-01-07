const search = document.querySelector(".search");
const grid =document.querySelector(".grid");
const createElement = (recipe)=>{
    const grida = document.createElement("a");
    grida.href=`http://localhost/projetBoisson/productPage/recipe.php?recipe=${recipe[1]}`
    grida.style.textDecoration='none';
    grida.innerHTML=`
    <div class='gridItem'>
    <img class ='photo' src ='${recipe[2]}'>
    <p style='z-index:10000;text-decoration:none;color:black;'>
     ${recipe[0]}</p>`
    grid.appendChild(grida);
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

