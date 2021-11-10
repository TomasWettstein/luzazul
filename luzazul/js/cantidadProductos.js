let select = document.getElementById('select');
let form = document.getElementById('form');

select.addEventListener('change', function(e) {
     e.preventDefault();
     let cantidad = e.target.value
     let nombre = document.getElementById('nombre').value
     let precio = document.getElementById('precio').value
     let arrayProductos = [];
     for (let i = 0; i < cantidad; i++) {
          arrayProductos.push([`${nombre}`, `${cantidad}`,`${precio}`]);
     }
     console.log(JSON.stringify({arrayProductos}));
    //  form.submit();
     fetch("http://localhost:8080/proyectos/luzazul/luzazul/productos.php",
    {
         method: "POST",
         body: JSON.stringify({arrayProductos}),
         headers: {
          "Content-Type": "application/json"
        }
     })
     .then(response => response.text())
     .then(data => console.log(data))
     .catch(err => console.log(err))
     console.log('Se envio el form')
})
