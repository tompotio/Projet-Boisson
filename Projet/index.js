const searchBar = document.querySelector(".search input");
const gridContainer =document.querySelector(".grid");
const createGridItem = (recipe)=>{
    const grida = document.createElement("a");
    grida.href=`http://localhost/projetBoisson/productPage/recipe.php?recipe=${recipe[1]}`
    grida.style.textDecoration='none';
    grida.innerHTML=`
    <div class='gridItem'>
    <img class ='photo' src ='${recipe[2]}'>
    <p style='z-index:10000;color:black;' >${recipe[0]} </p>`
    gridContainer.appendChild(grida);
}


searchBar.addEventListener('input',(el)=>{
    fetch("./search.php",{
        method:'POST',
        body:JSON.stringify({search:el.target.value})
    }).then((data)=>data.json()).then(res=>{
        gridContainer.innerHTML='';
        res.forEach((recipe)=>{
            createGridItem(recipe)
           })
    })});

   