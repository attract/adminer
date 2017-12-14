<?php
include_once "./plugins/login-servers.php";

if ($_GET["method"] == 'add_connect'){
    $adminer_plugin = new AdminerLoginServers();
    $adminer_plugin->add_connect();
}
else{
    prn('Method not found');
}
?>