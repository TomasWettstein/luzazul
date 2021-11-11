let select = document.getElementById('select');
let form = document.getElementById('form');

select.addEventListener('change', function (e) {
     e.preventDefault();
     let cantidad = e.target.value
     let nombre = document.getElementById('nombre').value
     let precio = document.getElementById('precio').value
     let arrayProductos = [];
     for (let i = 0; i < cantidad; i++) {
          arrayProductos.push([nombre, cantidad, precio]);
     }
     let json = JSON.stringify(arrayProductos);
     console.log(json)
     //  form.submit();
     fetch('http://localhost:8080/proyectos/luzazul/luzazul/productos.php',
          {
               headers: {
                    'Content-Type': 'application/json; charset=utf-8'
               },
               dataType: 'json',
               method: 'POST',
               body: json
          })
          .then(function (response) {
               return response.json()
           })
           .then(function (result) {
               alert(result)
           })
           .catch (function (error) {
               console.log('Request failed', error)
           })
})