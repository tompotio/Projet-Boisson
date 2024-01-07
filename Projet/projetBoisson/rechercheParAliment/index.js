const inputsParents = document.querySelectorAll(".inputSearch");
const loupe = document.querySelector(".loupe");
loupe.style.display='none';
const createElement=(el,product,delay)=>{
    const divContainter = el.querySelector(":scope >div ");
    const productList = el.parentElement.querySelector(".searchProductContainer");
    for (c of productList.children){
        if(c.innerText.slice(0,-2)===product){
            return
        }
    }
    
    const input = el.querySelector("input");
    const div = document.createElement("div");
    div.style.animationDelay = `${delay}ms`;
    div.innerText=product;
    div.classList.add("propose");
    div.addEventListener("click",(e)=>{
       
        const productList = el.parentElement.querySelector(".searchProductContainer");
        const newDiv = document.createElement("div");
        newDiv.classList.add("choice");
        newDiv.innerText=div.innerText+" X";
        newDiv.addEventListener('click',(e)=>{
            e.target.remove();   
        })
        productList.appendChild(newDiv);
        divContainter.innerHTML=''
        input.value=''
    })
    divContainter.appendChild(div)
}

inputsParents.forEach((el)=>{
  const input = el.querySelector("input");
  input.addEventListener("input",(e)=>{
    const divContainter = el.querySelector("div");
    divContainter.innerHTML='';
    if(input.value!==""){   
    fetch("./proposition.php",{
        method:'post',
        body:JSON.stringify({search:input.value})
    }).then(res=>res.json()).then(products=>{
        let i =0;
        products.forEach((product)=>{
            createElement(el,product[0],i*10);
            i++
        })
    });
    }
  })
})


const searchButton = document.querySelector(".addToCart");

const showRecipe =(data)=>{
    const grid = document.querySelector(".grid");
    grid.innerHTML='';
    data.forEach((recipe)=>{
        const divProduct = document.createElement("div");
        divProduct.classList.add("gridItem");
        divProduct.innerHTML=`<img style='width:100px;height:100px;object-fit:cover;' class ='photo' src=${recipe.path}>
        <p><a href=http://localhost/projetBoisson/productPage/recipe.php?recipe=${recipe.id}>${recipe.recipe}</a></p></div>`
        grid.appendChild(divProduct);
    })
}
searchButton.addEventListener("click",(e)=>{
    const check = document.querySelector('input[name="mode"]:checked').value;
    const desire =document.querySelectorAll(".desiré .choice")
    let desireArray=new Array();
    let i =0;
    desire.forEach((desireProduct)=>{
        desireArray[i]=desireProduct.innerText.slice(0, -2);
        i++
    })
    const indesiré = document.querySelectorAll(".indesiré>.choice");
    let indesiréArray=new Array();
    i=0
    indesiré.forEach((indesiréProduct)=>{
        indesiréArray[i]=indesiréProduct.innerText.slice(0, -2);
        i++
    })
    
    if(check==='Intersection'){
        fetch("./intersection.php",{
            method:'post',
            body:JSON.stringify({
                desiré:desireArray,
                indesiré:indesiréArray
            })
        }).then(res=>res.json()).then(data=>showRecipe(data));
       }
       else{
        fetch("./union.php",{
            method:'post',
            body:JSON.stringify({
                desiré:desireArray,
                indesiré:indesiréArray
            })
        }).then(res=>res.json()).then(data=>showRecipe(data))
}})

const search = document.querySelector(".search");
search.style.display='none'