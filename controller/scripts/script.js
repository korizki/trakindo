let passwordStatus = 0;

function hideFormCreateUser(params){
    const form = document.getElementById("outer");
    if(params == "show"){
        form.style.transform = "translateY(0px)";    
    } else if(params == "hide"){
        form.style.transform = "translateY(-5000px)";
    }
}

function showPassword(params){
    const inputPW = document.getElementById(params);
    if(passwordStatus === 0){
        inputPW.type = "text";
        passwordStatus = 1;
    } else {
        inputPW.type= "password";
        passwordStatus = 0;
    }
}