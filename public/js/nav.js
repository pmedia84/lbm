const navslide = () =>{
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');
    const navlinksfade = document.querySelectorAll('.nav-links li');
    //toggle nav
    burger.addEventListener('click', ()=>{
        nav.classList.toggle('nav-active',);
        

        //animate links
        navlinksfade.forEach((link,index) => {
            link.style.animation = `navlinksfade 0.5s ease forwards ${index / 7 }s`;

        })
        //burger animation
        burger.classList.toggle('toggle');
    })


}
navslide();