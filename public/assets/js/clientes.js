
import { renderTabla, eliminarElemento} from './modules.js';
document.addEventListener('DOMContentLoaded', ()=>{
   
    renderTabla({
        url: "api/clientes/mostrar",
        contenedorSelector: ".contenedor_clientes",
        templateSelector: ".template_clientes",

        mapFn: (clone, cliente, index) => {
            clone.querySelector('.indice').textContent = index+1;
            clone.querySelector('.cliente').textContent =cliente.nombre;
            clone.querySelector('.correo').textContent = cliente.correo;
            clone.querySelector('.telefono').textContent = cliente.telefono;
            clone.querySelector('.ubicacion').textContent = cliente.ubicacion;
            clone.querySelector('.proyectos').textContent = cliente.total_proyectos;
            clone.querySelector('.muestras').textContent = cliente.total_muestras;
            
            clone.querySelector('.btn-editar').href= `/clientes/manage/${cliente.id_cliente}`;
            clone.querySelector('.btn-eliminar').dataset.id = cliente.id_cliente;
               


        }
    });
 
    document.addEventListener('click', (e) => {
    
        const btn = e.target.closest('.btn-eliminar');
        if (!btn) return;

        const id = btn.dataset.id;
        eliminarElemento(id, "clientes");
    });
     

    
})


