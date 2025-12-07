function fun(){
    document.getElementById("para").innerHTML = "Hello Everyone";
    document.getElementById("para").style.color = "green";

    console.log("Hello from log");

    alert("Don't worry!!!");
    let x = prompt("Don't worry!!!");

    console.log("You have entered: " + x);

    document.write("Now you see me!");
}

function test(){
    let x = document.getElementById("uname").value;

    for(let i =0 ; i < x.length; i++){
        if(x[i]>= 'A' && x[i]<='Z'){
            continue;
        } else if(x[i]>= 'a' && x[i]<='z'){
            continue;
        } else if(x[i]>= '0' && x[i]<='9'){
            continue;
        } else{
            alert("Invalid username!!!");
            return;
        }
    }

    alert("Username valid");
}