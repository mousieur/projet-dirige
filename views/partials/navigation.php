<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow w-100 px-4">
        <div class="container-fluid d-flex justify-content-between align-items-center m-1">
            <a class="navbar-brand text-success logo h1" href="/">
                G.A.R.S
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="templatemo_main_nav">
                <div class="d-flex align-items-center">
                    <a class="nav-icon position-relative text-decoration-none fs-3 px-3" href="/cart">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light text-dark"><?=$itemCount?></span>
                    </a>
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-fw fa-user text-dark fs-4"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-end">
                            <li><a class="dropdown-item" href="#">Inventaire</a></li>
                            <li><a class="dropdown-item" href="#">Enigma</a></li>
                            <li><a class="dropdown-item" href="#">Paramètre du compte</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Déconnexion</a></li>
                            <li><a class="dropdown-item" href="./connection">connexion</a></li>
                            <li><a class="dropdown-item" href="./createAccount">Création de compte</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>