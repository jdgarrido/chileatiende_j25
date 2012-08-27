<?php
/**
 * @package		Chileatiende
 * @subpackage	mod_chileatiende
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$access_token = htmlspecialchars($params->get('access_token'));
$servicio = htmlspecialchars($params->get('servicio', 0));

if ($access_token && $servicio) {
    ?>
    <div class="cha_fichas<?= $moduleclass_sfx ?>">
        <ul>
            <?php
            echo $lasFichas;
            ?>
        </ul>
    </div>
    <?php
} else {
    ?>
    <p><?php echo JText::sprintf('MOD_CHILEATIENDE_ERROR'); ?></p>
    <?php
}
?>
