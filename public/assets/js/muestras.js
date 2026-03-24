import { renderTabla,eliminarElemento } from './modules.js';
document.addEventListener('DOMContentLoaded', ()=>{
   
    renderTabla({
        url: "api/muestras/mostrar",
        contenedorSelector: ".contenedor_muestras",
        templateSelector: ".template_muestras",

        mapFn: (clone, muestra, index) => {
            clone.querySelector('.indice').textContent = index + 1;
            clone.querySelector('.codigo').textContent = muestra.codigo;
            clone.querySelector('.cliente').textContent = muestra.cliente;
            clone.querySelector('.proyecto').textContent = muestra.proyecto;
            clone.querySelector('.fecha_recibo').textContent = muestra.fecha_recibo;
            
            if(muestra.prioridad=='baja'){
                clone.querySelector('.prioridad').classList.add('text-bg-info')
                clone.querySelector('.prioridad').textContent = muestra.prioridad;
            }
            else if(muestra.prioridad=='normal'){
                clone.querySelector('.prioridad').classList.add('text-bg-success')
                clone.querySelector('.prioridad').textContent = muestra.status;
            }
            else if(muestra.prioridad=='alta'){
                clone.querySelector('.prioridad').classList.add('text-bg-warning')
                clone.querySelector('.prioridad').textContent = muestra.prioridad;
            }
            else if(muestra.prioridad=='urgente'){
                clone.querySelector('.prioridad').classList.add('text-bg-danger')
                clone.querySelector('.prioridad').textContent = muestra.prioridad;
            }
            clone.querySelector('.horas').textContent = muestra.horas_estimadas;

            if(muestra.status=='pendiente'){
                clone.querySelector('.status').classList.add('text-bg-info')
                clone.querySelector('.status').textContent = muestra.status;
            }
            else if(muestra.status=='en progreso'){
                clone.querySelector('.status').classList.add('text-bg-primary')
                clone.querySelector('.status').textContent = muestra.status;
            }
            else if(muestra.status=='completado'){
                clone.querySelector('.status').classList.add('text-bg-success')
                clone.querySelector('.status').textContent = muestra.status;
            }
            else if(muestra.status=='urgente'){
                clone.querySelector('.status').classList.add('text-bg-danger')
                clone.querySelector('.status').textContent = muestra.status;
            }
            clone.querySelector('.status').textContent = muestra.status;
            clone.querySelector('.resultado').textContent = muestra.resultado;

            clone.querySelector('.btn-editar').href = `/muestras/manage/${muestra.id_muestra}`;
            clone.querySelector('.btn-eliminar').dataset.id = muestra.id_muestra;
        }
    });

    document.addEventListener('click', (e) => {

        const btn = e.target.closest('.btn-eliminar');
        if (!btn) return;

        const id = btn.dataset.id;
        eliminarElemento(id, "muestras");
    });
 

    
})


