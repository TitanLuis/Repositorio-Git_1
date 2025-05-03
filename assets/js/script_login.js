document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const togglePasswordIcon = document.getElementById('togglePassword');
    const eyeIcon = togglePasswordIcon.querySelector('i');

    togglePasswordIcon.addEventListener('click', function() {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        eyeIcon.classList.toggle('fa-eye', isPassword);
        eyeIcon.classList.toggle('fa-eye-slash', !isPassword);
    });
});