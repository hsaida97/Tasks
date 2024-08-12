document.getElementById('fullname').addEventListener('input', () => {
    const fullname = document.getElementById('fullname');
    fullname.value = fullname.value.charAt(0).toUpperCase() + fullname.value.slice(1);
});

document.getElementById('myForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const fullname = document.getElementById('fullname').value;
    const email = document.getElementById('email').value;
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    let isValid = true;


    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        document.getElementById('email').classList.add('is-invalid');
        isValid = false;
    } else {
        document.getElementById('email').classList.remove('is-invalid');
    }

    const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*\W).{8,}$/;
    if (!passwordPattern.test(passwordInput.value)) {
        passwordInput.classList.add('is-invalid');
        isValid = false;
    } else {
        passwordInput.classList.remove('is-invalid');
    }
    
    if (confirmPasswordInput.value !== passwordInput.value) {
        confirmPasswordInput.classList.add('is-invalid');
        isValid = false;
    } else {
        confirmPasswordInput.classList.remove('is-invalid');
    }

    if (isValid) {
        $.ajax({
            url: 'check-email.php',
            type: 'GET',
            data: { email: email },
            success: function(response) {
                if (response.trim() === 'exists') {
                    alert('The email is already registered.');
                } else if (response.trim() === 'available') {
                    const table = document.getElementById('table').getElementsByTagName('tbody')[0];
                    const row = table.insertRow();
                    row.insertCell(0).innerText = fullname;
                    row.insertCell(1).innerText = email;
                    row.insertCell(2).innerText = passwordInput.value;
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    }
});
