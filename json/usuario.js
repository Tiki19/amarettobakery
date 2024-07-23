document.addEventListener('DOMContentLoaded', () => {
    const userForm = document.getElementById('userForm');

    userForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const formData = new FormData(userForm);
        const userData = {};
        
        formData.forEach((value, key) => {
            userData[key] = value;
        });

        console.log('Usuario agregado:', userData);
        alert('Usuario agregado con éxito');
        userForm.reset();
    });
});
