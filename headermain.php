<?
    if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
    date_default_timezone_set('America/Bahia');
    if (!headers_sent()) 
        header("Content-type: text/html; charset=iso-8859-1");
?>