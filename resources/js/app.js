import './bootstrap';
        document.getElementsByClassName("eye-icon").addEventListener("click", function() {
            var passwordInput = document.getElementById("password-input");
            var eyeIcon = document.getElementById("eye-icon");
            if (passwordInput.type === "password") {
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
                passwordInput.type = "text"; // Show password
                
            } else {
                passwordInput.type = "password"; // Hide password
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        });