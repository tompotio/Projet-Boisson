const inputsParents = document.querySelectorAll(".inputSearch");
const createElement=(el,product,delay)=>{
    const divContainter = el.querySelector(":scope >div ");
    const input = el.querySelector("input");
    const div = document.createElement("div");
    div.style.animationDelay = `${delay}ms`;
    div.innerText=product;
    div.classList.add("propose");
    div.addEventListener("click",(e)=>{
       
        const productList = el.parentElement.querySelector(".searchProductContainer");
        const newDiv = document.createElement("div");
        newDiv.classList.add("choice");
        newDiv.innerText=div.innerText;
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


searchButton.addEventListener("click",(e)=>{
    const check = document.querySelector('input[name="mode"]:checked').value;
    const desire =document.querySelectorAll(".desiré")
    let desireArray=new Array();
    desire.forEach((desireProduct)=>{
        desireArray=[...desireArray,desireProduct.innerText]
    })
    const indesiré = document.querySelectorAll(".indesiré");
    let indesiréArray=new Array();
    indesiré.forEach((indesiréProduct)=>{
        indesiréArray=[...indesiréArray,indesiréProduct.innerText]
    })
   if(check==='Intersection'){
        
   }
   else{
    fetch("./union.php",{
        method:'post',
        body:JSON.stringify({
            desiré:desireArray[0],
            indesiré:indesiréArray[0]
        })
    }).then(res=>res.text()).then(data=>console.log(data))
   }
})