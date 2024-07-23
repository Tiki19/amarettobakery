document.addEventListener('DOMContentLoaded', function() {
    const formCliente = document.querySelector('#formCliente');
    const contenedorFilas = document.querySelector('#contenedor-filas');

    function agregarFila(DNI, nombre, apellidoPaterno, apellidoMaterno, celular, distrito, fechaHoraRegistro) {
        const fila = document.createElement('tr');
        fila.innerHTML = `
            <td>${DNI}</td>
            <td>${nombre}</td>
            <td>${apellidoPaterno}</td>
            <td>${apellidoMaterno}</td>
            <td>${celular}</td>
            <td>${distrito}</td>
            <td>${fechaHoraRegistro}</td>
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

        const modificarBtn = fila.querySelector('.modificar-btn');
        modificarBtn.addEventListener('click', function() {
            abrirModalEditar(fila);
        });

        const eliminarBtn = fila.querySelector('.eliminar-btn');
        eliminarBtn.addEventListener('click', function() {
            fila.remove();
        });
    }

    formCliente.addEventListener('submit', function(e) {
        e.preventDefault();

        const DNI = formCliente.querySelector('#DNI').value;
        const nombre = formCliente.querySelector('#nombre').value;
        const apellidoPaterno = formCliente.querySelector('#Apellido-Paterno').value;
        const apellidoMaterno = formCliente.querySelector('#Apellido-Materno').value;
        const celular = formCliente.querySelector('#Celular').value;
        const distrito = formCliente.querySelector('#Distrito').value;
        const fechaHoraRegistro = formCliente.querySelector('#Fecha-Hora-Registro').value;

        agregarFila(DNI, nombre, apellidoPaterno, apellidoMaterno, celular, distrito, fechaHoraRegistro);

        formCliente.reset();
    });

    function abrirModalEditar(fila) {
        const modal = document.getElementById('modalEditarCliente');
        const closeBtn = modal.querySelector('.close');
        const editForm = modal.querySelector('#formEditarCliente');

        const DNI = fila.cells[0].textContent;
        const nombre = fila.cells[1].textContent;
        const apellidoPaterno = fila.cells[2].textContent;
        const apellidoMaterno = fila.cells[3].textContent;
        const celular = fila.cells[4].textContent;
        const distrito = fila.cells[5].textContent;
        const fechaHoraRegistro = fila.cells[6].textContent;

        editForm.querySelector('#editDNI').value = DNI;
        editForm.querySelector('#editnombre').value = nombre;
        editForm.querySelector('#editApellido-Paterno').value = apellidoPaterno;
        editForm.querySelector('#editApellido-Materno').value = apellidoMaterno;
        editForm.querySelector('#editCelular').value = celular;
        editForm.querySelector('#editDistrito').value = distrito;
        editForm.querySelector('#editFecha-Hora-Registro').value = fechaHoraRegistro;

        modal.style.display = 'block';

        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        editForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const newDNI = editForm.querySelector('#editDNI').value; // Obtener el nuevo valor de DNI/RUC
            const newNombre = editForm.querySelector('#editnombre').value;
            const newApellidoPaterno = editForm.querySelector('#editApellido-Paterno').value;
            const newApellidoMaterno = editForm.querySelector('#editApellido-Materno').value;
            const newCelular = editForm.querySelector('#editCelular').value;
            const newDistrito = editForm.querySelector('#editDistrito').value;
            const newFechaHoraRegistro = editForm.querySelector('#editFecha-Hora-Registro').value;

            // Actualizar los valores en la fila original
            fila.cells[0].textContent = newDNI; // Actualizar el campo DNI/RUC
            fila.cells[1].textContent = newNombre;
            fila.cells[2].textContent = newApellidoPaterno;
            fila.cells[3].textContent = newApellidoMaterno;
            fila.cells[4].textContent = newCelular;
            fila.cells[5].textContent = newDistrito;
            fila.cells[6].textContent = newFechaHoraRegistro;

            modal.style.display = 'none';
        });
    }
});