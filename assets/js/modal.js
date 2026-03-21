const btnModal= document.querySelectorAll('.btnModal');

const insModal = document.querySelector('#modal');
const modal= new bootstrap.Modal(insModal);

btnModal.forEach(btn =>{
    btn.addEventListener('click', async (e)=>{
        const tabla= e.currentTarget.dataset.id;
        console.log(tabla);
       
        const form= document.querySelector('#dynamicForm')
   
        const formFields = document.querySelector("#modal-fields");
        const data= new FormData();
        data.append('tabla',tabla);

        try {

            const response = await fetch("/dynamic/agregarElementos", {
                method: "POST",
                body: data,
            });

            const result = await response.json();
            console.log(result);
            
            const labels = {
                id_proyecto: "Proyecto",
                fecha_inicio: "Fecha de recepcion",
                fecha_fin: "Fecha de entrega",

             

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

                        col.opciones.forEach(op => {
                            options += `<option class="text-capitalize" value="${op.id_categoria}">${op.nombre}</option>`;
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
                                <input type="date" class="form-control" name="${col.Field}" name="${col.Field}" required>
                            </div>
                        `);
                    }
                   
                });

                form.action=`/${tabla}/crear`
                modal.show();
    
            }
            else{
                console.log('no pas');
            }
            

        } catch (error) {
            console.error("❌ Error conexión:", error);
            fncToastr("error", "Error de conexión con el servidor");
        }



        
    })
})


