

import { renderTabla , eliminarElemento} from './modules.js';
document.addEventListener('DOMContentLoaded', ()=>{
   
    renderTabla({
        url: "api/usuarios/mostrar",
        contenedorSelector: ".contenedor_usuarios",
        templateSelector: ".template_usuarios",

        mapFn: (clone, usuario, index) => {
            clone.querySelector('.indice').textContent = index+1;
            clone.querySelector('.nombre').textContent =`${usuario.nombre} ${usuario.apellidos}`;
            clone.querySelector('.correo').textContent = usuario.correo;
            clone.querySelector('.rol').textContent = usuario.rol;
            const inputSwitch = clone.querySelector('.status input');
            inputSwitch.dataset.id = usuario.id_usuario;

            if(usuario.status==1){
                inputSwitch.checked = true; 
            }

            
            clone.querySelector('.btn-editar').href= `/usuarios/manage/${usuario.id_usuario}`;
            clone.querySelector('.btn-eliminar').dataset.id = usuario.id_usuario;
            

        }
    });



    document.addEventListener('click', (e) => {

        const btn = e.target.closest('.btn-eliminar');
        if (!btn) return;

        const id = btn.dataset.id;
        eliminarElemento(id, "usuarios");
    });


    document.addEventListener('change', async (e) => {

        const input = e.target.closest('.status input');

        if (!input) return;

        const id_usuario = input.dataset.id;
        const status = input.checked ? 1 : 0;

        const token = localStorage.getItem("token");

        try {
            const response = await fetch(`/api/usuarios/status/${id_usuario}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": `Bearer ${token}`
                },
                body: JSON.stringify({ status })
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
                 
        }

         catch (error) {
            console.error("Error:", error);
            fncSweetAlert("error", "Error de conexión con el servidor");
        }
    });

    

})

