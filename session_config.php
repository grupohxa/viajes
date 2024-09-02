<?php
// Verificar si la sesión estA iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_lifetime' => 7200, // 2 horas de duración
        'gc_maxlifetime' => 7200,
        'cookie_secure' => true,
        'cookie_httponly' => true,
        'cookie_samesite' => 'Strict'
    ]);
}

// Regenerar el ID de la sesión 
if (!isset($_SESSION['regenerated'])) {
    session_regenerate_id(true);
    $_SESSION['regenerated'] = true;
}

// medidas para evitar expiración prematura de la sesión
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();   
}

$_SESSION['LAST_ACTIVITY'] = time();
?>



