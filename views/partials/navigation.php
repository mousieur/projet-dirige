<?php
    sessionStart();
    $db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
    $pdo = $db->getPDO();
    $playerModel = new playerModel($pdo);
    $itemCount = 0;
    $connected = false;
    if(isset($_SESSION['idJoueur'])){
        $connected = true;
        $itemsForCount = $playerModel->getPanierById($_SESSION['idJoueur']);
        if($itemsForCount !== null){
            foreach ($itemsForCount as $iteme) {
                $itemCount += $iteme['quantite'];
            }
        }

        $player = $playerModel->getPlayerById($_SESSION['idJoueur']);
        $alias = $player->alias;
        $caps = $player->caps;
        $isAdmin = $player->isAdmin;
    }
    sessionStart();
?>

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
                        <span class="position-absolute top-0 start-80 translate-middle badge rounded-pill bg-light text-dark"><?=$itemCount?></span>
                    </a>
                    <?php
                    if($connected):
                    ?>
                    <div class="fs-3">
                        <?=$alias?> | <?=$caps?>$
                    </div>
                    <?php
                    endif?>
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Menu">
                            <i class="fa fa-fw fa-user text-dark fs-4"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-end">
                            <?php if(!empty($alias)){?>
                            <li><a class="dropdown-item" href="/inventory">Inventaire</a></li>
                            <li><a class="dropdown-item" href="/enigma">Enigma</a></li>
                            <li><a class="dropdown-item" href="/playerDetails">Paramètre du compte</a></li>
                            <?php if($isAdmin){?>
                                <li><a class="dropdown-item" href="/adminDemandesCaps">Demandes de Caps</a></li>
                            <?php }?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./deconnection">Déconnexion</a></li>
                            <?php } else {?>
                            <li><a class="dropdown-item" href="./connection">Connexion</a></li>
                            <li><a class="dropdown-item" href="./create">Création de compte</a></li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>