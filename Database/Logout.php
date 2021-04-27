<?php
session_start();
session_destroy();
header('Location: ../../DrugStore-main/login.html');
?>