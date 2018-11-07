<nav class="navbar navbar-expand-sm navbar-light bg-light custom-nav">
    <div class="container">
        <a href="#" class="navbar-brand">My TransBook</a>
        <?php if (isset($_SESSION['userId'])): ?>
            <img src="../assets/images/icono.png" alt="logo" class="icon_logo" />
        <?php else: ?>
            <img src="assets/images/icono.png" alt="logo" class="icon_logo" />
        <?php endif; ?>
        <button type="button" class="navbar-toggler" data-target="#mynav" data-toggle="collapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php if (isset($_SESSION['userId'])): ?>
                    <a href="logout.php" class="nav-link logout-btn">Logout</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>