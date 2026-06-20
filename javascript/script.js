function validateForm() {
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();
    const error = document.getElementById("errorMessage");

    if (username === "" || password === "") {
        error.textContent = "Username dan Password wajib diisi!";
        return false;
    }
    return true;
}