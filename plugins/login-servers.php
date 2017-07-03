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
<?php
		return true;
	}
	
}
