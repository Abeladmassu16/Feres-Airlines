const password = document.getElementById('pass');
const btn = document.getElementById('btn');

btn.addEventListener("click",function change(){
    
       for(let i=0;i<=password.value.length;++i){
           if(password.value[i]!=="@"){
            btn.style.margin="10px 15px 0 0";
            btn.style.backgroundColor="red";
           }else{
          
            alert("HAVE WONDERFULL FLIGHT ");
            
           }
       }
})
