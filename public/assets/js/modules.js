export async function renderTabla({url,contenedorSelector,templateSelector,mapFn}) {
    const contenedor = document.querySelector(contenedorSelector);
    const template = document.querySelector(templateSelector);

    try {
        const response = await fetch(url);
        const result = await response.json();

        if (result.status === 200) {

            result.data.forEach((item, index) => {

                let clone = template.content.cloneNode(true);

                mapFn(clone, item, index); // 🔥 aquí personalizas

                contenedor.appendChild(clone);
            });

        } else {
            console.log('error en response');
        }

    } catch (error) {
        console.error("❌ Error conexión:", error);
    }
}

export async function eliminarElemento(id,tabla) {
    const token = localStorage.getItem("token");

    if (!token) {
        fncToastr("error", "No hay token disponible");
        return;
    }


    const resp = await fncSweetAlert(
            "confirm",
            "¿Está seguro de eliminar este archivo?",
            ""
        );

        // si cancela o cierra la alerta
        if (!resp) return;

        const response = await fetch(`api/${tabla}/eliminar`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${token}`
            },
            body: JSON.stringify({
                id: id,
              
            })
        });

        const result = await response.json();
      
        if (result.status === "200") {

       
            fncSweetAlert(
                "success",
                "El registro ha sido eliminado con éxito",
                setTimeout(() => {
                    window.location.href = `/${tabla}`;
                }, 1000)
            );
        }

        if (result.status === "500") {

       
            fncSweetAlert(
                "error",
                "El registro no se ha sido eliminado con éxito",
                setTimeout(() => {
                    window.location.href = `/${tabla}`;
                }, 1000)
            );
        }
}