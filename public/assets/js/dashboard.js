const menu= document.querySelector('.sidebar__button');

menu.addEventListener('click', ()=>{
    const sidebar= document.querySelector('.sidebar');
    const title= document.querySelector('.sidebar__menu h1');
    const categories= document.querySelectorAll('.sidebar__modulos span');
    const btn= document.querySelector('.sidebar__btn');

    sidebar.classList.toggle('sidebar--hide');
    title.classList.toggle('dash--hide');
    categories.forEach(category=>{
        category.classList.toggle('dash--hide')
    });
    btn.classList.toggle('dash--hide');
})  
