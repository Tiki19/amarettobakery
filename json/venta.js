document.addEventListener('DOMContentLoaded', function() {
    const productos = document.querySelectorAll('.producto');
    const boletaBody = document.getElementById('boleta-body');
    const totalElement = document.getElementById('total');
    const clienteForm = document.getElementById('cliente-form');
    const inputBuscar = document.getElementById('buscarProducto');

    inputBuscar.addEventListener('input', function() {
        const textoBusqueda = inputBuscar.value.trim().toLowerCase();

        productos.forEach(producto => {
            const nombreProducto = producto.querySelector('h2').textContent.toLowerCase();
            const precioProducto = producto.querySelector('p').textContent.toLowerCase();

            if (nombreProducto.includes(textoBusqueda) || precioProducto.includes(textoBusqueda)) {
                producto.style.display = 'block';
            } else {
                producto.style.display = 'none';
            }
        });
    });
    let total = 0;

    productos.forEach(producto => {
        const agregarBtn = producto.querySelector('.agregar-btn');
        const nombreProducto = producto.querySelector('h2').textContent;
        const precioProducto = parseFloat(producto.querySelector('p').textContent.replace('Precio: $', ''));

        agregarBtn.addEventListener('click', function() {
            agregarProducto(nombreProducto, precioProducto);
        });
    });

    function agregarProducto(nombre, precio) {
        const fila = document.createElement('tr');
        fila.innerHTML = `
            <td>${nombre}</td>
            <td>$${precio.toFixed(2)}</td>
            <td><button class="eliminar-btn">Eliminar</button></td>
        `;
        boletaBody.appendChild(fila);
        total += precio;
        totalElement.textContent = `$${total.toFixed(2)}`;

        const eliminarBtn = fila.querySelector('.eliminar-btn');
        eliminarBtn.addEventListener('click', function() {
            fila.remove();
            total -= precio;
            totalElement.textContent = `$${total.toFixed(2)}`;
        });
    }

    clienteForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const nombre = document.getElementById('nombre').value;
        const telefono = document.getElementById('telefono').value;
        const direccion = document.getElementById('direccion').value;

        if (boletaBody.children.length === 0) {
            alert('Agrega al menos un producto a la boleta antes de confirmar la compra.');
            return;
        }

        // Aquí puedes implementar la lógica para enviar los datos del cliente y la boleta a un servidor o realizar alguna acción adicional

        alert(`Compra confirmada por un total de $${total.toFixed(2)}. Datos del cliente: Nombre: ${nombre}, Teléfono: ${telefono}, Dirección: ${direccion}`);

        // Reiniciar la boleta y el formulario después de confirmar la compra
        boletaBody.innerHTML = '';
        total = 0;
        totalElement.textContent = `$${total.toFixed(2)}`;
        clienteForm.reset();
    });
    
});
