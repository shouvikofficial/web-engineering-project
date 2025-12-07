// validation using function
function fun(){
    let x = document.getElementById("uname").value;
    let flag = 0;

    for(let i = 0; i < x.length ; i++){
        if(x[i]>= 'A' && x[i]<='Z'){
            continue;
        } else if(x[i]>= 'a' && x[i]<='z'){
            continue;
        } else if(x[i]>= '0' && x[i]<='9'){
            continue;
        } else{
            flag = 1;
            break;
        }
    }

    if(flag == 1){
        document.getElementById("euname").innerHTML = "you can't use special characters";
        document.getElementById("euname").style.color = "red";
        event.preventDefault();
    }
}

// live validation

document.getElementById("uname").addEventListener("input", ()=>{
    let x = document.getElementById("uname").value;
    let flag = 0;

    for(let i = 0; i < x.length ; i++){
        if(x[i]>= 'A' && x[i]<='Z'){
            continue;
        } else if(x[i]>= 'a' && x[i]<='z'){
            continue;
        } else if(x[i]>= '0' && x[i]<='9'){
            continue;
        } else{
            flag = 1;
            break;
        }
    }

    if(flag == 1){
        document.getElementById("euname").innerHTML = "<br>you can't use special characters";
        document.getElementById("euname").style.color = "red";
    } else{
        document.getElementById("euname").innerHTML = "";
    }
})


// live validation for multiple conditions
document.getElementById("pass").addEventListener("input", ()=>{
    let x = document.getElementById("pass").value;

    let c= 0, l = 0, d = 0, s = 0;

    for(let i = 0; i < x.length; i++){
        if(x[i]>= 'A' && x[i]<='Z'){
            c = 1;
        } else if(x[i]>= 'a' && x[i]<='z'){
            l = 1;
        } else if(x[i]>= '0' && x[i]<='9'){
            d = 1;
        } else if(x[i] == " "){
            continue;
        } else{
            s = 1;
        }
    }

    if(c == 0){
        document.getElementById("ec").innerHTML = "<br>❌ one capital alphabet required";
    } else{
        document.getElementById("ec").innerHTML = "<br>✅ capital alphabet";
    }

    if(l == 0){
        document.getElementById("el").innerHTML = "<br>❌ one lower alphabet required";
    } else{
        document.getElementById("el").innerHTML = "<br>✅ lower alphabet";
    }

    if(d == 0){
        document.getElementById("ed").innerHTML = "<br>❌ one digit alphabet required";
    } else{
        document.getElementById("ed").innerHTML = "<br>✅ digit";
    }

    if(s == 0){
        document.getElementById("es").innerHTML = "<br>❌ one special character required";
    } else{
        document.getElementById("es").innerHTML = "<br>✅ special character";
    }
})


// live validation using regular expression
document.getElementById("pass").addEventListener("input", ()=>{
    let x = document.getElementById("pass").value;

    if(x.match([/A-Z/])){
        document.getElementById("ec").innerHTML = "<br>❌ one capital alphabet required";
    } else{
        document.getElementById("ec").innerHTML = "<br>✅ capital alphabet";
    }

    if(x.match([/a-z/])){
        document.getElementById("el").innerHTML = "<br>❌ one lower alphabet required";
    } else{
        document.getElementById("el").innerHTML = "<br>✅ lower alphabet";
    }

    if(x.match([/0-9/])){
        document.getElementById("ed").innerHTML = "<br>❌ one digit alphabet required";
    } else{
        document.getElementById("ed").innerHTML = "<br>✅ digit";
    }

})

// block handling
function register(){
    document.getElementById("form1").style.display = "none";
    document.getElementById("form2").style.display = "block";
}

function login(){
    document.getElementById("form1").style.display = "block";
    document.getElementById("form2").style.display = "none";
}