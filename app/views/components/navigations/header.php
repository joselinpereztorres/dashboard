<nav class="dash__nav nav">
    <div class="nav__principal">
        <h1>lkm</h1>
    </div>
    <div class="nav__usuario">
        <div class="nav__datos">
            <p class="text-capitalize"><?php  echo $_SESSION['nombre'] ?></p>
            <p><?php echo $_SESSION["rol"]?></p>
        </div>

        <div class="nav__img">
            <i class="bi bi-person-circle"></i>
        </div>

        <div class="nav__logout">
            <a href="/logout"><i class="bi bi-box-arrow-right"></i></a>
            
        </div>

    </div>

</nav>