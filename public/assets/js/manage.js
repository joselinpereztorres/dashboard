document.addEventListener('DOMContentLoaded', async () => {
    const form = document.querySelector('.manageForm');

    const divBotones = document.querySelector('.manageBotones');
    
    const segments = window.location.pathname.split('/').filter(Boolean);

    const tabla = segments[0];
    const id = segments[2];

    if (!form || !divBotones) {
        console.error('No se encontró el formulario o el contenedor de botones');
        return;
    }

    try {
        
        const response = await fetch(`/api/${tabla}/mostrarId/${id}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        const result = await response.json();

        if (result.status !== 200) {
            console.log('No pasó');
            return;
        }

        const campos = result.campos;
        const registro = Array.isArray(result.lista) ? result.lista[0] : result.lista;
       
        Object.keys(campos).forEach(key => {
            const campo = campos[key];

            const nuevoDiv = document.createElement('div');
            nuevoDiv.className = 'col-md-4';

            const label = document.createElement('label');
            label.className = 'form-label';
            label.setAttribute('for', key);
            label.textContent = campo.label;

            let input = document.createElement('input');
            input.type = campo.type || 'text';
            input.className = 'form-control text-capitalize';
            input.id = key;
            input.name = key;

            if (campo.type === 'password') {
                input.value = '';
                input.placeholder = 'Nueva contraseña';
            } else {
                input.value = registro[key] ?? '';
            }

            nuevoDiv.appendChild(label);
            nuevoDiv.appendChild(input);
            form.insertBefore(nuevoDiv, divBotones);
        });
        divBotones.querySelector('.regresar').href=`/${tabla}`

    } catch (error) {
        console.error('❌ Error conexión:', error);
        if (typeof fncToastr === 'function') {
            fncToastr('error', 'Error de conexión con el servidor');
        }
    }




    //editar
    // form.addEventListener('submit',  async(e) => {
    //         e.preventDefault();

    //         console.log('submit detectado');

    //         const token = localStorage.getItem("token");

    //         if (!token) {
    //             fncToastr("error", "No hay token disponible");
    //             return;
    //         }

    //         const formData = new FormData(form);

    //         const data = Object.fromEntries(formData.entries());

    //         try {

    //             const response = await fetch(`/api/${tabla}/editar/${id}`, {
    //                 method: "PUT",
    //                 headers: {
    //                 "Content-Type": "application/json",
    //                 "Authorization": `Bearer ${token}`
    //                 },
    //                 body: JSON.stringify({
    //                     data
    //                 })
    //             });

    //             const result = await response.text();
            

    //             if (result.status === "200") {
       
    //                 fncSweetAlert(
    //                     "success",
    //                     "El registro se ha editado con éxito",
    //                     setTimeout(() => {
    //                         window.location.href = `/${tabla}`;
    //                     }, 1000)
    //                 );
    //             }

    //             if (result.status === "500") {

            
    //                 fncSweetAlert(
    //                     "error",
    //                     "El registro no se ha editado",
    //                     setTimeout(() => {
    //                         window.location.href = `/${tabla}`;
    //                     }, 1000)
    //                 );
    //             }
                        

    //         } catch (error) {
    //             console.error("❌ Error conexión:", error);
    //             fncToastr("error", "Error de conexión con el servidor");
    //         }

    //     });

    form.addEventListener('submit', async (e) => {
    e.preventDefault();

    console.log('submit detectado');

    const token = localStorage.getItem("token");

    if (!token) {
        fncToastr("error", "No hay token disponible");
        return;
    }

    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    try {
        const response = await fetch(`/api/${tabla}/editar/${id}`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${token}`
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.status === 200) {
            fncSweetAlert(
                "success",
                "El registro se ha editado con éxito",
                setTimeout(() => {
                    window.location.href = `/${tabla}`;
                }, 1000)
            );
        }

        else if (result.status === 500) {
            fncSweetAlert(
                "error",
                "El registro no se ha editado",
               
            );
        }

        else if (result.status === 400) {
            fncSweetAlert(
                "error",
                "Completa todos los campos",
               
            );
        }

    } catch (error) {
        console.error("❌ Error conexión:", error);
        fncToastr("error", "Error de conexión con el servidor");
    }
});

});

 

    