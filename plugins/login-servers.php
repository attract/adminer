<?php

/** Display constant list of servers in login form
* @link https://www.adminer.org/plugins/#use
* @author Jakub Vrana, http://www.vrana.cz/
* @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerLoginServers {
	/** @access protected */
	var $servers;
	var $scripts = array("plugins/js/adminer_login_server.js");
	/** Set supported servers
	* @param array array($domain) or array($domain => $description) or array($category => array())
	* @param string
	*/

	function __construct() {
        // Todo:
		$this->servers = $this->read_from_file();
	}

	function read_from_file(){

	    return array(array('name'=>"Fiveldb", 'host'=>"127.0.0.1", "env"=>'loc', "driver"=>"mysql", "port"=>"3601", "user"=>"root",
            "password"=>"123123"),
            array('name'=>"Fiveldb", 'host'=>"127.0.0.1", "env"=>'dev', "driver"=>"mysql", "port"=>"3601", "user"=>"root",
                "password"=>"123123"));
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
