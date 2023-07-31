document.addEventListener("DOMContentLoaded", function () {
    const loginTab = document.getElementById("login-tab");
    const registerTab = document.getElementById("register-tab");
    const loginForm = document.getElementById("login-form");
    const registerForm = document.getElementById("register-form");

    loginTab.addEventListener("click", function () {
        loginForm.classList.add("active");
        registerForm.classList.remove("active");
    });

    registerTab.addEventListener("click", function () {
        registerForm.classList.add("active");
        loginForm.classList.remove("active");
    });
});
