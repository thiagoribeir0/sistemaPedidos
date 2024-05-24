<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
    die("Acesso não autorizado!<p><a href=\"index.php\">Fazer login</a>.</p>");
}

?>
