<?php 
/**
 * Logout
 *
 * @return [void]
 */
function logout()
{
    session_destroy(); 

    unset($_SESSION['username']); 
    $_SESSION['role']=1;

    $url = new URL(); 
    $url->InternalRedirect('home'); // after logout user is redirected to homepage
}

?>