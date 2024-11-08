<?php
// includes/helpers.php

// Controleert of de gebruiker is ingelogd door te kijken of de sessievariabele 'user_id' is ingesteld
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}
