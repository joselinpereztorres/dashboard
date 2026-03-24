const btnModal= document.querySelectorAll('.btnModal');

const insModal = document.querySelector('#dynamicModal');
const modal= new bootstrap.Modal(insModal);
const form = document.querySelector('#dynamicForm');
btnModal.forEach(btn =>{
    btn.addEventListener('click', async (e)=>{
        const tabla= e.currentTarget.dataset.id;
   
        const formFields = document.querySelector("#modal-fields");
        const token = localStorage.getItem("token");

        if (!token) {
            fncToastr("error", "No hay token disponible");
            return;
        }


        try {

            const response = await fetch("api/dynamic/agregarElementos", {
                method: "POST",
                headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${token}`
                },
                body: JSON.stringify({
                    tabla: tabla
                })
            });

            const result = await response.json();
            const labels = {
                id_proyecto: "Proyecto",
                fecha_inicio: "Fecha de recepcion",
                fecha_fin: "Fecha de entrega",
                horas_estimadas: "Horas estimadas",
                id_cliente: "Cliente"

            };


            if (result.status == 200) {
               
                formFields.innerHTML = "";
                result.col.forEach(col => {

                    const label = labels[col.Field] || col.Field;

                    const tipo= col.Type;

                    if(tipo== 'varchar'){
                        formFields.insertAdjacentHTML("beforeend", `
                            <div class="col-md-6">
                                <label for="${col.Field}" class="form-label text-capitalize">${label}</label>
                                <input type="text" class="form-control" name="${col.Field}">
                            </div>
                        `);
                    }
                    else if(tipo== 'int'){

                        let options = `<option selected>Escoge una opcion</option>`;


                        const campoId = col.Field; 

                        col.opciones.forEach(op => {
                            options += `
                                <option class="text-capitalize" value="${op[campoId]}">
                                    ${op.nombre}
                                </option>
                            `;
                        });

                        
                        formFields.insertAdjacentHTML("beforeend", `
                            <div class="col-md-6">
                                <label class="form-label">${label}</label>
                                <select class="form-select" name="${col.Field}">
                                    ${options}
                                </select>
                            </div>
                        `);
                    }
                    else if(tipo== 'decimal'){
                        formFields.insertAdjacentHTML("beforeend", `
                            <div class="col-md-6">
                                <label class="form-label for="${col.Field}">${label}</label>
                                <input type="number" class="form-control" name="${col.Field}" min="0"step="0.01">
                            </div>
                        `);
                    }
                    else if(tipo== 'date'){
                        formFields.insertAdjacentHTML("beforeend", `
                            <div class="col-md-6">
                                <label for="${col.Field}" class="form-label">${label}</label>
                                <input type="date" class="form-control" name="${col.Field}" " required>
                            </div>
                        `);
                    }

                    else if(tipo== 'text'){
                        formFields.insertAdjacentHTML("beforeend", `
                            <div class="col-md-6">
                            
                                <label for="${col.Field}" class="text-capitalize">${label}</label>
                                <textarea class="form-control" name="${col.Field}" style="height: 70px""></textarea>
                            </div> 
                        `);
                    }


                    if (col.Field === 'prioridad') {
                        let options = `<option selected disabled>Escoge una opción</option>`;

                        result.prioridades.forEach(op => {
                            options += `<option class="text-capitalize" value="${op}">${op}</option>`;
                        });

                        formFields.insertAdjacentHTML("beforeend", `
                            <div class="col-md-6">
                                <label for="${col.Field}" class="form-label text-capitalize">${label}</label>
                                <select class="form-select" name="${col.Field}">
                                    ${options}
                                </select>
                            </div>
                        `);
                    }
                    else if (col.Field === 'estado') {
                        let options = `<option selected disabled>Escoge una opción</option>`;

                        result.estados.forEach(op => {
                            options += `<option class="text-capitalize" value="${op}">${op}</option>`;
                        });

                        formFields.insertAdjacentHTML("beforeend", `
                            <div class="col-md-6">
                                <label for="${col.Field}" class="form-label  text-capitalize">${label}</label>
                                <select class="form-select text-capitalize" name="${col.Field}">
                                    ${options}
                                </select>
                            </div>
                        `);
                    }
                   
                });

                form.dataset.id= tabla
                modal.show();
    
            }
            else  if (result.status == 400 ||result.status == 404){
                fncToastr("error", "No se registro, intenta de nuev");
            }
            

        } catch (error) {
            console.error("❌ Error conexión:", error);
            fncToastr("error", "Error de conexión con el servidor");
        }



        
    })
})



const btnGuardar=document.querySelector('.guardarRegistro');

form.addEventListener('submit', async (e) => {
    e.preventDefault();
  
    const tabla= e.currentTarget.dataset.id;
 
    const formData = new FormData(form);

    const data = Object.fromEntries(formData.entries());
    const token = localStorage.getItem("token");
    console.log(token);

    if (!token) {
        fncToastr("error", "No hay token disponible");
        return;
    }
    try {

        const response = await fetch(`api/${tabla}/crear`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                 "Authorization": `Bearer ${token}`
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();
    

        if (result.status == 200) {
            fncSweetAlert(
                "success",
                "Registro creado correctamente",
                setTimeout(() => {
                    window.location.href = `/${tabla}`;
                }, 1000)
            );
        }
        else if (result.status == 400) {
            fncSweetAlert(
                "error",
                "Todos los campos son obligatorios",
                setTimeout(() => {
                    window.location.href = `/${tabla}`;
                }, 1000)
            );
        }
        else if (result.status == 500) {
            fncSweetAlert(
                "error",
                "No se pudo registrar",
                setTimeout(() => {
                    window.location.href = `/${tabla}`;
                }, 1000)
            );
        }

    } catch (error) {
        console.error(error);
        fncToastr("error", "Error de conexión");
    }
});