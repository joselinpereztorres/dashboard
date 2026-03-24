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
                clone.querySelector('.prioridad').textContent = muestra.prioridad;
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
           

            if(muestra.resultado== "Sin resultado"){
                clone.querySelector('.resultado').innerHTML = `<i class="bi bi-envelope-plus fs-4 text-primary text-center fw-semibold btn-resultado"  data-muestra="${muestra.id_muestra}"></i>`
            }
            else{
               clone.querySelector('.resultado').textContent = muestra.resultado; 
            }
            

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

    
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('.btn-resultado');

        if (btn) {
            const id_muestra = btn.dataset.muestra;

            document.querySelector('#id_muestra').value = id_muestra;

            const modal = new bootstrap.Modal(document.querySelector('#modalResultado'));
            modal.show();
        }
    });


    document.querySelector('#guardarResultado').addEventListener('click', async () => {
        const form = document.querySelector('#resultadosForm');
        const id_muestra = document.querySelector('#id_muestra').value;
        
        const formData = new FormData(form);

        const data = Object.fromEntries(formData.entries());
        data.id_muestra = id_muestra;
        const token = localStorage.getItem("token");
        console.log(token);

        if (!token) {
            fncToastr("error", "No hay token disponible");
            return;
        }

        try {
            const response = await fetch(`/api/muestras/agregarResultado`, {
                method: "POST", // cambia a PUT si así lo tienes en tu API
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": `Bearer ${token}`
                },
                body: JSON.stringify( data )
            });

            const result = await response.text();

           if (result.status == 200) {
            fncSweetAlert(
                "success",
                "Registro creado correctamente",
                setTimeout(() => {
                    window.location.href = `/usuarios`;
                }, 1000)
            );
        }
        else if (result.status == 400) {
            fncSweetAlert(
                "error",
                "Todos los campos son obligatorios",
                setTimeout(() => {
                    window.location.href = `/usuarios`;
                }, 1000)
            );
        }
        else if (result.status == 500) {
            fncSweetAlert(
                "error",
                "No se pudo registrar",
                setTimeout(() => {
                    window.location.href = `/usuarios`;
                }, 1000)
            );
        }

        } catch (error) {
            console.error("Error:", error);
            fncSweetAlert("error", "Error de conexión con el servidor");
        }
    });
 

    // const contenedor = document.querySelector('.contenedor_muestras');
    // const template = document.querySelector('.template_muestras');
    // const paginacion = document.querySelector('#paginacionMuestras');

    // let currentPage = 1;
    // let totalPages = 1;
    // const limit = 5;

    // async function cargarMuestras(page = 1) {
    //     try {
    //         const response = await fetch(`/api/muestras/mostrarPaginacion/${page}/${limit}`);
    //         const result = await response.text();

    //         if (result.status === 200) {
    //             contenedor.innerHTML = '';

    //             result.data.forEach((muestra, index) => {
    //                 let clone = template.content.cloneNode(true);

    //                 clone.querySelector('.indice').textContent = ((page - 1) * limit) + index + 1;
    //                 clone.querySelector('.codigo').textContent = muestra.codigo;
    //                 clone.querySelector('.cliente').textContent = muestra.cliente;
    //                 clone.querySelector('.proyecto').textContent = muestra.proyecto;
    //                 clone.querySelector('.fecha_recibo').textContent = muestra.fecha_recibo;
    //                 clone.querySelector('.horas').textContent = muestra.horas_estimadas;

    //                 if (muestra.prioridad == 'baja') {
    //                     clone.querySelector('.prioridad').classList.add('text-bg-info');
    //                     clone.querySelector('.prioridad').textContent = muestra.prioridad;
    //                 } else if (muestra.prioridad == 'normal') {
    //                     clone.querySelector('.prioridad').classList.add('text-bg-success');
    //                     clone.querySelector('.prioridad').textContent = muestra.prioridad;
    //                 } else if (muestra.prioridad == 'alta') {
    //                     clone.querySelector('.prioridad').classList.add('text-bg-warning');
    //                     clone.querySelector('.prioridad').textContent = muestra.prioridad;
    //                 } else if (muestra.prioridad == 'urgente') {
    //                     clone.querySelector('.prioridad').classList.add('text-bg-danger');
    //                     clone.querySelector('.prioridad').textContent = muestra.prioridad;
    //                 }

    //                 if (muestra.status == 'pendiente') {
    //                     clone.querySelector('.status').classList.add('text-bg-info');
    //                     clone.querySelector('.status').textContent = muestra.status;
    //                 } else if (muestra.status == 'en progreso') {
    //                     clone.querySelector('.status').classList.add('text-bg-primary');
    //                     clone.querySelector('.status').textContent = muestra.status;
    //                 } else if (muestra.status == 'completado') {
    //                     clone.querySelector('.status').classList.add('text-bg-success');
    //                     clone.querySelector('.status').textContent = muestra.status;
    //                 } else if (muestra.status == 'urgente') {
    //                     clone.querySelector('.status').classList.add('text-bg-danger');
    //                     clone.querySelector('.status').textContent = muestra.status;
    //                 }

    //                 if (muestra.resultado == "Sin resultado") {
    //                     clone.querySelector('.resultado').innerHTML = `
    //                         <i class="bi bi-envelope-plus fs-4 text-primary btn-resultado"
    //                         data-muestra="${muestra.id_muestra}">
    //                         </i>
    //                     `;
    //                 } else {
    //                     clone.querySelector('.resultado').textContent = muestra.resultado;
    //                 }

    //                 clone.querySelector('.btn-editar').href = `/muestras/manage/${muestra.id_muestra}`;
    //                 clone.querySelector('.btn-eliminar').dataset.id = muestra.id_muestra;

    //                 contenedor.appendChild(clone);
    //             });

    //             currentPage = result.pagination.current_page;
    //             totalPages = result.pagination.total_pages;

    //             renderPaginacion();
    //         }

    //     } catch (error) {
    //         console.error("Error cargando muestras:", error);
    //     }
    // }

    // function renderPaginacion() {
    //     let html = '';

    //     html += `
    //         <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
    //             <a class="page-link" href="#" data-page="${currentPage - 1}">&laquo;</a>
    //         </li>
    //     `;

    //     for (let i = 1; i <= totalPages; i++) {
    //         html += `
    //             <li class="page-item ${i === currentPage ? 'active' : ''}">
    //                 <a class="page-link" href="#" data-page="${i}">${i}</a>
    //             </li>
    //         `;
    //     }

    //     html += `
    //         <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
    //             <a class="page-link" href="#" data-page="${currentPage + 1}">&raquo;</a>
    //         </li>
    //     `;

    //     paginacion.innerHTML = html;
    // }

    // paginacion.addEventListener('click', (e) => {
    //     e.preventDefault();

    //     const link = e.target.closest('.page-link');
    //     if (!link) return;

    //     const page = parseInt(link.dataset.page);
    //     if (page >= 1 && page <= totalPages) {
    //         cargarMuestras(page);
    //     }
    // });

    // cargarMuestras(1);

    
})


