let select = document.getElementById('select');
let form = document.getElementById('form');

select.addEventListener('change', function (e) {
     e.preventDefault();
     let cantidad = e.target.value
     let nombre = document.getElementById('nombre').value
     let precio = document.getElementById('precio').value
     let arrayProductos = []
     for (let i = 0; i < cantidad; i++) {
         let producto = {"nombre" : `${nombre}`, "cantidad": `${cantidad}`, "precio":  `${precio}`}
         arrayProductos.push(producto)
     }
     // let json = JSON.stringify(arrayProductos);
     console.log(JSON.stringify(arrayProductos))
     
     //  form.submit();
     fetch('http://localhost:8080/proyectos/luzazul/luzazul/productos.php',
          {
               method: 'POST',
               body: JSON.stringify(arrayProductos),
               headers: {
                    'Content-Type': 'application/json; charset=utf-8'
               }
          })
          .then(res => res.json())
          .catch(error => console.error('Error:', error))
          .then(response => console.log('Success:', response));
})