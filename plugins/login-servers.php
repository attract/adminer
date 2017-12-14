<?php

/** Display constant list of servers in login form
* @link https://www.adminer.org/plugins/#use
* @author Jakub Vrana, http://www.vrana.cz/
* @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/

function prn($value) {
    print('<div style="align:center; font-size:30px; width: 100%; margin-left: 30%; margin-top:70px;">'
    .$value.
    '</div>');
}

class AdminerLoginServers {
	/** @access protected */
	var $servers;
	var $scripts = array("plugins/js/adminer_login_server.js");
	var $all_connections = array();
	var $server_list_file = 'server_list.json';
	/** Set supported servers
	* @param array array($domain) or array($domain => $description) or array($category => array())
	* @param string
	*/

	function __construct() {
        // Todo:
		$this->servers = $this->init_file_connections();
	}

	function init_file_connections(){
        if(!is_file($this->server_list_file)){
            $this->save_connections_to_file();
        }
        $json = file_get_contents($this->server_list_file);
        $jsonIterator = new RecursiveIteratorIterator(
           new RecursiveArrayIterator(json_decode($json, TRUE)),
            RecursiveIteratorIterator::SELF_FIRST);

        $this->all_connections = array();
        foreach ($jsonIterator as $key => $val) {
            if(is_array($val)) {
                array_push($this->all_connections, $val);
            }
        }
        //$this->add_connect();

        return $this->all_connections;

        return array(array('name'=>"Fiveldb", 'host'=>"148.251.99.194", "env"=>'loc', "driver"=>"pgsql", "port"=>"15432", "user"=>"root",
            "password"=>"123123"),
            array('name'=>"Fiveldb", 'host'=>"127.0.0.1", "env"=>'dev', "driver"=>"mysql", "port"=>"3601", "user"=>"root",
                "password"=>"123123"));
    }

    function add_connect(){

        //$new_connect = array('name'=>'Fiveldb',
        //                     'host'=>'127.0.0.1',
        //                    'env'=>'dev',
        //                     'driver'=>'mysql',
        //                     'port'=>'3601',
        //                     'user'=>'root',
        //                    'password'=>'123123');

        $new_connect = array('name'=>$_POST["name"], //$_GET['name'],
                             'host'=>$_POST["host"],
                             'env'=>$_POST["env"],
                             'driver'=>$_POST["driver"],
                             'port'=>$_POST["port"],
                             'user'=>$_POST["user"],
                             'password'=>$_POST["password"]);
        //prn($new_connect['name']);
        $is_added = false;
        foreach ($this->all_connections as $key => $val) {
            if ($val['name'] == $_GET['name']) {
                $is_added = true;
            }
        }
        if($is_added === false){
            array_push($this->all_connections, $new_connect);
            $this->save_connections_to_file();
            return 1;
        }
        else{
            return 0;
        }
    }

    function delete_connect(){

        array_push($this->all_connections, $new_connect);
        $this->save_connections_to_file();
    }

    function save_connections_to_file() {
        $fp = fopen($this->server_list_file, 'w');
        fwrite($fp, json_encode($this->all_connections));
        fclose($fp);
    }

	function head() {
		foreach ($this->scripts as $script) {
			echo "<script type='text/javascript' src='" . h($script) . "'></script>\n";
		}
	}

	function login($login, $password) {
		return;
	}
	
	function loginForm() {
		?>
<div >
    <div style="margin-bottom: 20px;">
        <table style="border: 1px dotted darkblue; padding: 5px;">
            <tr>
                <th style="padding: 5px; font-style: italic;" colspan="5" >Быстрое подключение</th>
            </tr>
            <?
                foreach ($this->servers as $server) {
                    ?>
                    <tr>
                        <td><input type="button" class="connect_to_db" value="<?=$server['name'] ?>"
                                   style="background: yellowgreen; width: 100%"></td>
                        <td class="env"><?=$server['env'] ?></td>
                        <td class="driver"><?=$server['driver'] ?></td>
                        <td class="host"><?=$server['host'] ?></td>
                        <td class="port"><?=$server['port'] ?></td>
                        <td class="user"><?=$server['user'] ?></td>
                        <td class="password" style="color: white"><?=$server['password'] ?></td>
                    </tr>
                    <?
                }
            ?>
            <tr>
                <td><input type="text" value="" name="host" placeholder="Host"></td>
                <td>
                    <select name="env">
                        <option value="local" selected="">Local</option>
                        <option value="dev">Dev</option>
                        <option value="prod">Prod</option>
                    </select>
                </td>
                <td>
                    <select name="driver">
                        <option value="server" selected="">MySQL</option>
                        <option value="sqlite">SQLite 3</option>
                        <option value="sqlite2">SQLite 2</option>
                        <option value="pgsql">PostgreSQL</option>
                        <option value="oracle">Oracle</option>
                        <option value="mssql">MS SQL</option>
                        <option value="firebird">Firebird (alpha)</option>
                        <option value="simpledb">SimpleDB</option>
                        <option value="mongo">MongoDB (beta)</option>
                        <option value="elastic">Elasticsearch (beta)</option>
                    </select>
                </td>
                <td><input type="text" value="" name="port" placeholder="Port"></td>
                <td><input type="text" value="" name="user" placeholder="User"></td>
                <td><input type="text" value="" name="password" placeholder="Password"></td>
                <td><input type="submit" class="connect_to_db" value="Добавить" ></td>
            </tr>
        </table>
    </div>

	<div >
		<table cellspacing="0">

			<tr><th><?php echo lang('Server'); ?><td>
                    <input name="auth[server]" value="" title="hostname[:port]" placeholder="localhost" autocapitalize="off">

			<tr><th><?php echo lang('Driver'); ?><td>
                    <select name="auth[driver]"><option value="server" selected="">MySQL</option><option value="sqlite">SQLite 3</option><option value="sqlite2">SQLite 2</option><option value="pgsql">PostgreSQL</option><option value="oracle">Oracle</option><option value="mssql">MS SQL</option><option value="firebird">Firebird (alpha)</option><option value="simpledb">SimpleDB</option><option value="mongo">MongoDB (beta)</option><option value="elastic">Elasticsearch (beta)</option>
                    </select>

			<tr><th><?php echo lang('Username'); ?><td><input id="username" name="auth[username]" value="<?php echo h($_GET["username"]);  ?>">
			<tr><th><?php echo lang('Password'); ?><td><input type="password" name="auth[password]">
		</table>
		<p>
				<div><? echo checkbox("auth[permanent]", 1, $_COOKIE["adminer_permanent"], lang('Permanent login')) . "\n"; ?></div>
				<br>
				<input type="submit" style="width: 300px;height: 30px;" value="<?php echo lang('Login'); ?>">
		</p>
	</div>

</div>
<?php
		return true;
	}
	
}
