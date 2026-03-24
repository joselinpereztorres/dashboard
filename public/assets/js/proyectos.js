


import { renderTabla, eliminarElemento } from './modules.js';
document.addEventListener('DOMContentLoaded', ()=>{
   
    renderTabla({
        url: "api/proyectos/mostrar",
        contenedorSelector: ".contenedor_proyectos",
        templateSelector: ".template_proyectos",

        mapFn: (clone,proyecto, index) => {
            clone.querySelector('.indice').textContent = index+1;
            clone.querySelector('.proyecto').textContent =proyecto.nombre;
            clone.querySelector('.cliente').textContent =proyecto.cliente;
            clone.querySelector('.fecha_inicio').textContent = proyecto.fecha_inicio;
            clone.querySelector('.muestras').textContent = proyecto.total_muestras;
            clone.querySelector('.status').textContent = proyecto.status;

            
            clone.querySelector('.btn-editar').href= `/proyectos/manage/${proyecto.id_proyecto}`;
            clone.querySelector('.btn-eliminar').dataset.id = proyecto.id_proyecto;
               
        }
    });
 
    document.addEventListener('click', (e) => {
    
        const btn = e.target.closest('.btn-eliminar');
        if (!btn) return;

        const id = btn.dataset.id;
        eliminarElemento(id, "proyectos");
    });
    

    
})


