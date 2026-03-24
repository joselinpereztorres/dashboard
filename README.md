# Sistema de Gestión de Muestras

## URL de acceso
https://laboratorio.wensnails.com

## Credenciales de prueba

### Admin
Correo: admin@laboratorio.com  
Contraseña: 12345678

### Analistas
Correo: ana@laboratorio.com
carlos@laboratorio.com
maria@laboratorio.com
andrea@laboratorio.com
gerardo@laboratorio.com
karla@laboratorio.com
Contraseña: 12345678

## Tecnologías utilizadas
- PHP
- JavaScript
- Bootstrap
- HTML
- CSS
- MySQL
- JWT

## Estructura de base de datos
Relación principal:
- Un cliente tiene muchos proyectos
- Un proyecto tiene muchas muestras

Tablas principales:
- usuarios
- clientes
- proyectos
- muestras

El script de base de datos se encuentra en:
`laboratorio.sql`

## Endpoints principales

### Autenticación
- `POST /api/login/login`

### Usuarios
- `GET /api/usuarios/mostrar`
- `POST /api/usuarios/crear`
- `PUT /api/usuarios/editar/{id}`
- `DELETE /api/usuarios/eliminar/{id}`
- `PUT /api/usuarios/status/{id}`

### Clientes
- `GET /api/clientes`
- `POST /api/clientes`
- `PUT /api/clientes/editar/{id}`
- `DELETE /api/clientes/eliminar/{id}`

### Proyectos
- `GET /api/proyectos/mostrar`
- `POST /api/proyectos/crear`
- `PUT /api/proyectos/editar/{id}`
- `DELETE /api/proyectos/eliminar/{id}`

### Muestras
- `GET /api/muestras/mostrar`
- `POST /api/muestras/crear`
- `PUT /api/muestras/editar/{id}`
- `DELETE /api/muestras/eliminar/{id}`
- `POST /api/muestras/agregarResultado
- `GET /api/muestras?fechaInicio=YYYY-MM-DD&fechaFin=YYYY-MM-DD&estatus=valor&cliente=id`

### Dashboard
- `GET /api/inicio/metricas`

## Instalación local opcional
1. Clonar repositorio
2. Importar `laboratorio.sql`
3. Crear un dominio virtual
4. Configurar conexión a base de datos
5. Ejecutar en servidor local

## Repositorio
https://github.com/joselinpereztorres/dashboard.git

## Diagrama base de datos 
El archivo `laboratorio.sql` contiene la estructura y datos de prueba necesarios para ejecutar el proyecto.
<img width="869" height="720" alt="Captura de pantalla 2026-03-21 203449" src="https://github.com/user-attachments/assets/9b56a6a6-25bf-4b73-aab0-f3d56e0343d4" />
