const btnEliminar= document.querySelectorAll('.btn-eliminar');


btnEliminar.forEach(btn =>{
    btn.addEventListener('click', async(e) =>{
       const id = e.currentTarget.dataset.id;

        const resp = await fncSweetAlert(
            "confirm",
            "¿Está seguro de eliminar este archivo?",
            ""
        );

        // si cancela o cierra la alerta
        if (!resp) return;

        const data = new FormData();
        data.append("id_cliente", id);

        const response = await fetch("/clientes/eliminar", {
            method: "POST",
            body: data
        });

        const result = await response.json();
      
        if (result.status === "200") {

       
            fncSweetAlert(
                "success",
                "El registro ha sido eliminado con éxito",
                setTimeout(() => {
                    window.location.href = "/clientes";
                }, 1000)
            );
        }

         
         
    })
})

