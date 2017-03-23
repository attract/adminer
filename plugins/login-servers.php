<?php

/** Display constant list of servers in login form
* @link https://www.adminer.org/plugins/#use
* @author Jakub Vrana, http://www.vrana.cz/
* @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerLoginServers {
	/** @access protected */
	var $servers, $driver;
	
	/** Set supported servers
	* @param array array($domain) or array($domain => $description) or array($category => array())
	* @param string
	*/
	function __construct($servers, $driver = "server", $scripts = array("http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js")) {
		$this->servers = $servers;
		$this->driver = $driver;

		$this->scripts = $scripts;
	}

	function head() {
		foreach ($this->scripts as $script) {
			echo "<script type='text/javascript' src='" . h($script) . "'></script>\n";
		}
	}

	function login($login, $password) {
		// check if server is allowed
		foreach ($this->servers as $key => $val) {
			$servers = $val;
			if (!is_array($val)) {
				$servers = array($key => $val);
			}
			foreach ($servers as $k => $v) {
				if ((is_string($k) ? $k : $v) == SERVER) {
					return;
				}
			}
		}
		return false;
	}
	
	function loginForm() {
		?>
<table cellspacing="0">

	<tr><th><?php echo lang('Driver'); ?><td>

	<select name="auth[driver]"><option value="server" selected="">MySQL</option><option value="sqlite">SQLite 3</option><option value="sqlite2">SQLite 2</option><option value="pgsql">PostgreSQL</option><option value="oracle">Oracle</option><option value="mssql">MS SQL</option><option value="firebird">Firebird (alpha)</option><option value="simpledb">SimpleDB</option><option value="mongo">MongoDB (beta)</option><option value="elastic">Elasticsearch (beta)</option></select>



	<tr><th><?php echo lang('Server'); ?><td>
			<select name="auth[server]"><?php echo optionlist($this->servers, SERVER); ?></select>
	<tr><th><?php echo lang('Username'); ?><td><input id="username" name="auth[username]" value="<?php echo h($_GET["username"]);  ?>">
	<tr><th><?php echo lang('Password'); ?><td><input type="password" name="auth[password]">
</table>

	<p><input type="submit" value="<?php echo lang('Login'); ?>">
	<?=checkbox("auth[permanent]", 1, $_COOKIE["adminer_permanent"], lang('Permanent login')) . "\n"; ?>

<?php
		return true;
	}
	
}
