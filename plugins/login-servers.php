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

	function __construct($servers) {
		$this->servers = $servers;
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
<div style="width: 1500px">
	<div style="float: left">
		<table cellspacing="0">

			<tr><th><?php echo lang('Server'); ?><td>
			<select name="auth[server]" style="float: left;margin-right: 15px;">
				<?php
				foreach ($this->servers as $name=>$server){
					?>
					<option value="<?=$server['ip'] ?>" data-driver="<?=$server['driver']?>" ><?=$name ?></option>
					<?
				}
				?>
			</select>
			<input name="local-mysql" type="button" value="Local Mysql" style="margin-right: 10px;">
			<input name="local-pgsql" type="button" value="Local Pgsql">

			<tr><th><?php echo lang('Driver'); ?><td>
			<input name="auth[driver]" value="server" style="display: none;" >
			<h4 id="selected_driver">MySQL</h4>

			<tr><th><?php echo lang('Username'); ?><td><input id="username" name="auth[username]" value="<?php echo h($_GET["username"]);  ?>">
			<tr><th><?php echo lang('Password'); ?><td><input type="password" name="auth[password]">
		</table>
		<p>
				<div><? echo checkbox("auth[permanent]", 1, $_COOKIE["adminer_permanent"], lang('Permanent login')) . "\n"; ?></div>
				<br>
				<input type="submit" style="width: 300px;height: 30px;" value="<?php echo lang('Login'); ?>">
		</p>
	</div>

	<div style="margin-left: 10px; float: left">
		<table>
			<tr>
				<th style="padding: 5px" colspan="5">Быстрое подключение</th>
			</tr>
			<tr>
				<td><input type="submit" class="connect_to_db" value="Fivel db" style="background: yellowgreen; width: 100%"></td>
				<td>Driver</td>
				<td>3601</td>
				<td colspan="2">user</td>
				<td></td>
			</tr>
			<tr>
				<td><input type="text" value="" name="host" placeholder="Host"></td>
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
</div>
<?php
		return true;
	}
	
}
