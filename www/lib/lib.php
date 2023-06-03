<?php
define('ROOT', dirname(dirname(__FILE__)));

// require all libs
foreach (glob(ROOT . '/lib/*.php') as $filename) {
  if (basename($filename) == 'lib.php') {
    continue;
  }
  require_once($filename);
}
