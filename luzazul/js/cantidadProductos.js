let select = document.getElementById('select');
let form = document.getElementById('form');

select.addEventListener('change', function(e) {
     e.preventDefault();
    //  form.submit();
     console.log('Se envio el form')
     fetch("http://localhost:8080/luzazul/luzazul/productos.php",
    {
         method: "POST",
         body: new FormData(form)
     })
     .then(response => response.text())
     .then(data => console.log(data))
     .catch(err => console.log(err))
})
