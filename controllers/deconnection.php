<?php
sessionStart();
$_SESSION['messageRequest'] = "";
if(isset($_SESSION['idJoueur'])){
    unset($_SESSION['idJoueur']);
}
redirect('/');