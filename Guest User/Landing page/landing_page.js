// For login
const loginBtn = document.getElementById("login");
const signupBtn = document.getElementById("signup");


loginBtn.onclick = () => {
    window.location.href = '../Authorize/login.php';
};

signupBtn.onclick = () => {
    window.location.href = '../Authorize/sign_up.php';
};

