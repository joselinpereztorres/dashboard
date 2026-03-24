<?php
$permisos = require __DIR__ . '/../../../core/permisos.php';
$rol = $_SESSION['rol'] ?? null;
$modulos = $permisos[$rol] ?? [];
?>

<aside class="dash__sidebar sidebar">
    <div class="sidebar__menu">
        <h1>Dashboard</h1>
        <button class="sidebar__button">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <nav class="sidebar__modulos">


        <?php if(in_array('inicio', $modulos)): ?>
        <a href="/inicio"><i class="bi bi-grid-1x2-fill"></i><span>Inicio</span></a>
        <?php endif; ?>

        <?php if(in_array('usuarios', $modulos)): ?>
        <a href="/usuarios"><i class="bi bi-person-lines-fill"></i> <span>Usuarios</span></a>
        <?php endif; ?>

        <?php if(in_array('clientes', $modulos)): ?>
        <a href="/clientes"><i class="bi bi-people-fill"></i> <span>Clientes</span></a>
        <?php endif; ?>

        <?php if(in_array('proyectos', $modulos)): ?>
        <a href="/proyectos"><i class="bi bi-folder-fill"></i><span>Proyectos</span></a>
        <?php endif; ?>

        <?php if(in_array('muestras', $modulos)): ?>
        <a href="/muestras"><i class="bi bi-droplet-fill"></i><span>Muestras</span></a>
        <?php endif; ?>
        
       
    </nav>
</aside>