document.addEventListener("DOMContentLoaded", function () {
    const logoutBtn = document.getElementById("logoutBtn");

    logoutBtn.addEventListener("click", function () {
        // Perform logout action here, e.g., redirect to logout endpoint.
        // In this simplified example, we'll just redirect back to the login page.
        window.location.href = "login.html";
    });
});
