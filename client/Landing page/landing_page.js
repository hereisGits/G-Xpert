// For login
const loginBtn = document.getElementById("login");
const signupBtn = document.getElementById("signup");

loginBtn.onclick = () => {
    window.location.href = '../Authorize/login.php';
};

signupBtn.onclick = () => {
    window.location.href = '../Authorize/sign_up.php';
};

// For community
const noCommunity = document.getElementById("community");
const notify = document.getElementById("notify");

noCommunity.addEventListener('mouseenter', () => {
    notify.style.display = 'block';
});

noCommunity.addEventListener('mouseleave', () => {
    notify.style.display = 'none';
});

// For dropdown
document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('ul li');

    items.forEach(item => {
        item.addEventListener('click', function (e) {
            e.stopPropagation();
            const submenu = item.querySelector('ul');
            if (submenu) submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
        });
    });

    document.addEventListener('click', () => {
        document.querySelectorAll('ul ul').forEach(menu => (menu.style.display = 'none'));
    });
});
