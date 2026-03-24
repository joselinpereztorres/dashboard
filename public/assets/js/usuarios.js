

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


    

})

