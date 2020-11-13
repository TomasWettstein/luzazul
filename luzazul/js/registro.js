let user = document.getElementById('nombre');
let pUsuario = document.getElementById('pUsuario');
user.onblur = function()
{
    if(this.value == "")
    {
        pUsuario.innerHTML = '<p class = "text-danger">Este campo es obligatorio</p>'
    }else
    {
        pUsuario.innerHTML = "";
    }
}

let userEmail = document.getElementById('email');
let pEmail = document.getElementById('pEmail');
let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
userEmail.onblur = function(){
    if(this.value == "")
    {
        pEmail.innerHTML = '<p class = "text-danger">Ingrese su email por favor</p>'
    }else if(regexEmail.test(userEmail.value) == false)
    {
        pEmail.innerHTML = '<p class = "text-danger">Ingrese un email valido por favor</p>'
    }else
    {
        pEmail.innerHTML = "";
    } 
}
let userPass = document.getElementById('contraseña');
let pPass = document.getElementById('pPass');
userPass.onblur = function()
{
    if(this.value == "")
    {
        pPass.innerHTML = '<p class = "text-danger" >Ingrese una contraseña por favor</p>';
    }else
    {
        pPass.innerHTML = "";
    }
}
