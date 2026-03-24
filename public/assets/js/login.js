document.querySelector("#formLogin").addEventListener("submit", async (e) => {
    e.preventDefault();

    const email = document.querySelector("#email").value;
    const password = document.querySelector("#password").value;

    try {
        const response = await fetch("/api/login/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                email: email,
                password: password
            })
        });

        const data = await response.json();
        console.log(data);


        if (data.status == 200) {
            localStorage.setItem("token", data.token);

            const sesionResponse = await fetch("/login/setSession", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    id: data.usuario.id_usuario,
                    rol: data.usuario.rol,
                    nombre:data.usuario.nombre
                })
            });

            const sesionData = await sesionResponse.json();

            if (sesionData.status == 200) {
                window.location.href = "/inicio";
            } else {
             
                fncSweetAlert(
                    "error",
                    "Correo o contraseña incorrecta",
                    setTimeout(() => {
                        window.location.href = '/login';
                    }, 1000)
                );
            }
        }

    } catch (error) {
        fncToastr("error", "Error de conexión con el servidor");   
    }
});