const searchBar = document.querySelector(".search input");
const gridContainer =document.querySelector(".grid");
const createGridItem = (recipe)=>{
    const gridDiv = document.createElement("div");
    gridDiv.classList.add("gridItem")
    gridDiv.innerHTML=`<img style='width:50px;height:50px;object-fit:cover;' class ='photo' src=${recipe[2]} onError="this.src='Photos/unknown.jpg'">
    <p><a href=htt://localhost/projetBoisson/productPage/recipe.php?recipe="${recipe[1]}">
    ${recipe[0]} </a></p></div>`
    gridContainer.appendChild(gridDiv);
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

   