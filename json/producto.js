document.addEventListener('DOMContentLoaded', function() {
    const formProducto = document.querySelector('#formProducto');
    const contenedorFilas = document.querySelector('#contenedor-filas');
    let codigoCount = 1; // Inicializar contador para el código

    // Función para agregar una fila nueva a la tabla
    function agregarFila(codigo, nombre, descripcion, presentacion, precio, stock, categorias) {
        const fila = document.createElement('tr');
        fila.innerHTML = `
            <td>${codigo}</td>
            <td>${nombre}</td>
            <td>${descripcion}</td>
            <td>${presentacion}</td>
            <td>${precio}</td>
            <td>${stock}</td>
            <td>${categorias}</td>
            <td>
                <button type="button" class="modificar-btn">
                    <i class="fas fa-edit"></i>
                </button>
            </td>
            <td>   
                <button type="button" class="eliminar-btn">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        `;
        contenedorFilas.appendChild(fila);

        // Agregar evento para modificar
        const modificarBtn = fila.querySelector('.modificar-btn');
        modificarBtn.addEventListener('click', function() {
            abrirModalEditar(fila);
        });

        // Agregar evento para eliminar
        const eliminarBtn = fila.querySelector('.eliminar-btn');
        eliminarBtn.addEventListener('click', function() {
            fila.remove(); // Eliminar la fila
        });
    }

    // Evento submit del formulario principal para agregar productos
    formProducto.addEventListener('submit', function(e) {
        e.preventDefault();

        const nombre = formProducto.querySelector('#nombre').value;
        const descripcion = formProducto.querySelector('#Descripcion').value;
        const presentacion = formProducto.querySelector('#Presentacion').value;
        const precio = formProducto.querySelector('#Precio').value;
        const stock = formProducto.querySelector('#Stock').value;
        const categoriasElement = formProducto.querySelector('#categorias');
        const categorias = categoriasElement.options[categoriasElement.selectedIndex].textContent;

        // Validar que se haya seleccionado una categoría
        if (categorias === '-- Seleccione una categoría --') {
            alert('Por favor, seleccione una categoría válida.');
            return;
        }

        const primeraLetra = nombre.charAt(0).toUpperCase();
        const codigo = `${primeraLetra}${codigoCount}`;

        agregarFila(codigo, nombre, descripcion, presentacion, precio, stock, categorias);

        codigoCount++;
        formProducto.reset();
    });

    // Función para abrir el modal de edición y prellenar campos
    function abrirModalEditar(fila) {
        const modal = document.getElementById('modalEditarProducto');
        const closeBtn = modal.querySelector('.close');
        const editForm = modal.querySelector('#formEditarProducto');

        // Obtener datos de la fila actual
        const codigo = fila.cells[0].textContent;
        const nombre = fila.cells[1].textContent;
        const descripcion = fila.cells[2].textContent;
        const presentacion = fila.cells[3].textContent;
        const precio = fila.cells[4].textContent;
        const stock = fila.cells[5].textContent;
        const categorias = fila.cells[6].textContent;

        // Preenlazar campos del formulario de edición con los datos actuales
        editForm.querySelector('#editCodigo').value = codigo;
        editForm.querySelector('#editNombre').value = nombre;
        editForm.querySelector('#editDescripcion').value = descripcion;
        editForm.querySelector('#editPresentacion').value = presentacion;
        editForm.querySelector('#editPrecio').value = precio;
        editForm.querySelector('#editStock').value = stock;

        // Establecer la categoría seleccionada en el formulario de edición
        const editCategorias = editForm.querySelector('#editCategorias');
        for (let i = 0; i < editCategorias.options.length; i++) {
            if (editCategorias.options[i].textContent === categorias) {
                editCategorias.selectedIndex = i;
                break;
            }
        }

        // Mostrar el modal de edición
        modal.style.display = 'block';

        // Cerrar el modal al hacer clic en el botón de cerrar
        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        // Actualizar datos al enviar el formulario de edición
        editForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Obtener nuevos valores del formulario de edición
            const newNombre = editForm.querySelector('#editNombre').value;
            const newDescripcion = editForm.querySelector('#editDescripcion').value;
            const newPresentacion = editForm.querySelector('#editPresentacion').value;
            const newPrecio = editForm.querySelector('#editPrecio').value;
            const newStock = editForm.querySelector('#editStock').value;
            const newCategoriasElement = editForm.querySelector('#editCategorias');
            const newCategorias = newCategoriasElement.options[newCategoriasElement.selectedIndex].textContent;

            // Actualizar los valores en la fila original
            fila.cells[1].textContent = newNombre;
            fila.cells[2].textContent = newDescripcion;
            fila.cells[3].textContent = newPresentacion;
            fila.cells[4].textContent = newPrecio;
            fila.cells[5].textContent = newStock;
            fila.cells[6].textContent = newCategorias;

            // Cerrar el modal
            modal.style.display = 'none';
        });
    }

});
