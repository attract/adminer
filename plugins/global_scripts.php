<?php

class AdminerScripts {

    function __construct($scripts = array()) {
        $this->scripts = $scripts;
    }

    function head() {
        foreach ($this->scripts as $script) {
            echo "<script type='text/javascript' src='" . h($script) . "'></script>\n";
        }
    }
}