<?
if (session_status() != PHP_SESSION_ACTIVE)
{
    session_start();
    session_unset();
}

date_default_timezone_set('America/Bahia');
include "index.php";
?>
