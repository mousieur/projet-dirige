<?php
sessionStart();
if(isset($_SESSION['idJoueur'])){
    unset($_SESSION['idJoueur']);
}
redirect('/');