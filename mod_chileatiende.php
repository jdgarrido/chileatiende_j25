<?php
defined('_JEXEC') or die('Restricted Access');

jimport('joomla.filesystem.file');

require_once (dirname(__FILE__).DS.'helper.php');

$lasFichas = Chileatiende::getFichas($params);

require(JModuleHelper::getLayoutPath('mod_chileatiende', 'default'));
?>

