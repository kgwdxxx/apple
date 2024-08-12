document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.floating-input');

    inputs.forEach(input => {
        input.addEventListener('input', function() {
            const container = this.parentElement;
            if (this.value !== '') {
                container.classList.add('filled');
                input.style.borderColor = '';
            } else {
                container.classList.remove('filled');
            }
        });

        // Initial check to see if input is pre-filled
        const container = input.parentElement;
        if (input.value !== '') {
            container.classList.add('filled');
        }
    });

    document.getElementById('signupForm').addEventListener('submit', function(event) {
        event.preventDefault();
    
        const formData = new FormData(this);
        fetch('./php/signup.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                // Handle specific error cases
                if (data.error === "username_exists") {
                    document.getElementById('username').style.borderColor = 'red';
                    document.getElementById('errorMessages').innerText = 'Username already exists.';
                } else if (data.error === "email_exists") {
                    document.getElementById('email').style.borderColor = 'red';
                    document.getElementById('errorMessages').innerText = 'Email already exists.';
                } else {
                    document.getElementById('errorMessages').innerText = data.error;
                }
            } else if (data.success) {
                // Redirect to user_info.php after success
                document.getElementById('errorMessages').innerText = 'Registration successful! Redirecting...';
                setTimeout(() => {
                    window.location.href = './php/user_info.php'; // Adjust path as needed
                }, 2000); // Redirect after 2 seconds
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('errorMessages').innerText = 'An error occurred while submitting the form.';
        });
    });
});
