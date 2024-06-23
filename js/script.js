document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.querySelector('form[action="register.php"]');
    if (registerForm) {
        registerForm.addEventListener('submit', (event) => {
            const username = document.getElementById('Username').value;
            const password = document.getElementById('Password').value;
            const email = document.getElementById('Email').value;
            const phone = document.getElementById('Phone').value;
            const name = document.getElementById('Name').value;
            const usertype = document.getElementById('UserTypeID').value;

            if (!username || !password || !email || !phone || !name || !usertype) {
                event.preventDefault();
                alert('Please fill in all the fields.');
            }
        });
    }

    const loginForm = document.querySelector('form[action="login.php"]');
    if (loginForm) {
        loginForm.addEventListener('submit', (event) => {
            const username = document.getElementById('Username').value;
            const password = document.getElementById('Password').value;

            if (!username || !password) {
                event.preventDefault();
                alert('Please fill in all the fields.');
            }
        });
    }
});
