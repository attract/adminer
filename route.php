<?php
include_once "./plugins/login-servers.php";

$method_found = false;
if ($_GET["method"] == 'add_connect'){
    $adminer_plugin = new AdminerLoginServers();
    $adminer_plugin->add_connect();
    $method_found = true;
}
if ($_GET["method"] == 'delete_connect'){
    $adminer_plugin = new AdminerLoginServers();
    $adminer_plugin->delete_connect();
    $method_found = true;
}
if($method_found == false){
    prn('Method not found');
}
?>