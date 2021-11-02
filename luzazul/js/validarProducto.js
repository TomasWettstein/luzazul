//Validar producto
let nombre = document.getElementById('nombreproducto');
let pNombre = document.getElementById('errorNombre');

nombre.addEventListener('blur', function(event)
{
    event.preventDefault();
    if (this.value == "") 
    {
        pNombre.innerText = "Este campo es obligatorio"
    }else{
        pNombre.innerText = "";
    }
});
let portada = document.getElementById('portadaproducto');
let pPortada= document.getElementById('errorPortada');

portada.addEventListener('blur', function(event)
{
    event.preventDefault();
    if (portada.value == "") {
        pPortada.innerText = "El campo portada es obligatorio";
    }else
    {
        pPortada.innerText= "";
    }
});
let imagenes = document.getElementById('imagenesproducto');
let pImagenes= document.getElementById('errorImagenes');
imagenes.addEventListener('blur', function(event)
{
    event.preventDefault();
    if (imagenes.value == "") 
    {
        pImagenes.innerText = "Este campo es obligatorio";
    }
    else
    {
        let cantidadDeImagenes = imagenes.files;
        for (let i = 0; i < cantidadDeImagenes.length; i++) 
        {
            if (cantidadDeImagenes[i].type != "image/jpg" && cantidadDeImagenes[i].type != "image/jpeg" && cantidadDeImagenes[i].type != "image/png") 
            {
                pImagenes.innerText = "El tipo de archivo no es una imagen";
            }else
            {
                pImagenes.innerText = "";
            }
        }
    }
});
let categoria = document.getElementById('categoriaproducto');
let pCategoria = document.getElementById('errorCategoria');
categoria.addEventListener('blur', function(event){
    event.preventDefault();
    if (categoria.value == "") {
        pCategoria.innerText = "El campo categoria es obligatorio";
    }else
    {
        pCategoria.innerText = "";
    }
});




