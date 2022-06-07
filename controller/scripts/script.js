function hideFormCreateUser(params){
    const form = document.getElementById("outer");
    if(params == "show"){
        form.style.transform = "translateY(0px)";    
    } else if(params == "hide"){
        form.style.transform = "translateY(-5000px)";
    }
}