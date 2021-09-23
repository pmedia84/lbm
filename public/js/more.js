const showmore = () =>{
    const more = document.querySelector('.more');
    const hidden = document.querySelector('.staff-text-hidden');
    
    //toggle more info
    more.addEventListener('click', ()=>{
        hidden.classList.toggle('showmore',);

         //animate the chevron when clicked
    more.classList.toggle('more-clicked',);
    })

    
   

}
showmore();