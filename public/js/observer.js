const nav = document.querySelector(".nav-container");
const hero = document.querySelector(".hero");

const heroobserveroptions = {
    rootMargin: "-100px 0px 0px 0px",
};

const heroobserver = new IntersectionObserver(function(entries, 
    heroobserver) {

entries.forEach(entry => {
    
    if(!entry.isIntersecting)
    nav.classList.add("scrolled");
    else {
        nav.classList.remove("scrolled");
        
    }
    });
   
    
    

} ,heroobserveroptions);

heroobserver.observe(hero);
