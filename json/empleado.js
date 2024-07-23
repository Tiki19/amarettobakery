document.addEventListener('DOMContentLoaded', function () {
    const formCliente = document.getElementById('formCliente');
    const contenedorFilas = document.getElementById('contenedor-filas');
    const modal = document.getElementById('modalEditarCliente');
    const span = document.getElementsByClassName('close')[0];

    formCliente.addEventListener('submit', function (event) {
        event.preventDefault();
        
        const formData = new FormData(formCliente);
        const cliente = {};
        formData.forEach((value, key) => {
            cliente[key] = value;
        });

        const fila = document.createElement('tr');
        Object.keys(cliente).forEach(key => {
            const celda = document.createElement('td');
            celda.textContent = cliente[key];
            fila.appendChild(celda);
        });

        contenedorFilas.appendChild(fila);
        formCliente.reset();
    });

    span.onclick = function () {
        modal.style.display = 'none';
    };

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };

    const tabla = document.querySelector('.tabla tbody');
    tabla.addEventListener('click', function (event) {
        if (event.target.tagName === 'TD') {
            const fila = event.target.parentNode;
            const datos = Array.from(fila.children).map(td => td.textContent);

            document.getElementById('editDNI').value = datos[0];
            document.getElementById('editnombre').value = datos[1];
            document.getElementById('editApellido-Paterno').value = datos[2];
            document.getElementById('editApellido-Materno').value = datos[3];
            document.getElementById('editCelular').value = datos[4];
            document.getElementById('editDistrito').value = datos[5];
            document.getElementById('editFecha-Hora-Registro').value = datos[6];

            modal.style.display = 'block';
        }
    });

    const formEditarCliente = document.getElementById('formEditarCliente');
    formEditarCliente.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(formEditarCliente);
        const updatedCliente = {};
        formData.forEach((value, key) => {
            updatedCliente[key] = value;
        });

        const filas = Array.from(contenedorFilas.children);
        const fila = filas.find(row => row.children[0].textContent === updatedCliente.editDNI);

        if (fila) {
            Object.keys(updatedCliente).forEach((key, index) => {
                fila.children[index].textContent = updatedCliente[key];
            });
        }

        modal.style.display = 'none';
        formEditarCliente.reset();
    });
});
