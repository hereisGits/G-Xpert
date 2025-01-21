

    const backgrounds = [
        "linear-gradient(to right, #ff7e5f, #feb47b)", 
        "linear-gradient(to right, #6a11cb, #2575fc)", 
        "url('https://th.bing.com/th/id/OIP.am20lreLs--bbOUcnY2KeQAAAA?w=306&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7')", 
        "url(https://th.bing.com/th/id/OIP.RhW-4A8p_RtODcWWefgtMwHaEK?pid=ImgDet&w=174&h=98&c=7&dpr=1.3')", 
        "#229ed9"
    ];
    let index = 0;

    function changeBackground() {
        const hero = document.querySelector(".hero");
        hero.style.background = backgrounds[index];
        hero.style.backgroundSize = "cover";
        hero.style.backgroundPosition = "center";
        index = (index + 1) % backgrounds.length;
    }

    setInterval(changeBackground, 30000);
    window.onload = changeBackground;
