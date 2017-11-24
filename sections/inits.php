<?php
    /*
     * Argyros - Inits
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
	include( "database/data-user.php" );
    checkSession( '' );
?>