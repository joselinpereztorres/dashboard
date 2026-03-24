document.addEventListener('DOMContentLoaded', async () => {

    await cargarMetricas();

});

async function cargarMetricas(){

    try{
        const response = await fetch('/api/inicio/metricas');
        const result = await response.json();

        if(result.status === 200){
            document.querySelector('#pendientes').textContent = result.data.pendientes;
            document.querySelector('#urgentes').textContent = result.data.urgentes;
            document.querySelector('#total').textContent = result.data.total;
            document.querySelector('#recientes').textContent = result.data.recientes;
        }

    }catch(error){
        console.error("Error métricas:", error);
    }
}