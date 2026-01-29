<?php
session_start();
if (!isset($_SESSION['ID_USUARIO'])) {
    header("Location: ../index.php");
    exit;
}
