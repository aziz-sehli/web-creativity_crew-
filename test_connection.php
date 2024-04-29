<?php

require_once 'config.php';

$config = new Config();

$pdo = $config->getConnexion();

if ($pdo) {
    echo "Connection successful!";
} else {
    echo "Connection failed!";
}

?>
