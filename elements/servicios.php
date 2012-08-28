<?php

/**
 * @copyright    Copyright (C) 2009 Open Source Matters. All rights reserved.
 * @license      GNU/GPL
 */
// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

JFormHelper::loadFieldClass('list');

/**
 * Obtiene listado de Servicios
 *
 */
class JFormFieldServicios extends JFormFieldList {

    protected $type = "Servicios";

    public function getOptions() {
        // Build the query.
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('m.' . $db->quoteName('params') . ' AS params');
        $query->from($db->quoteName('#__modules') . ' AS m');
        $query->where('m.' . $db->quoteName('title') . ' LIKE \'ChileAtiende\'');
        $db->setQuery($query);
        $options = $db->loadObjectList();

        $params = new JParameter($options[0]->params);
        $access_token = $params->get('access_token');

        if ($access_token) {
            $jsonServicios = file_get_contents('https://www.chileatiende.cl/api/servicios?access_token=' . $access_token);
            $aServicios = json_decode($jsonServicios);

            $aData = array();
            $aData[0] = JText::sprintf('MOD_CHILEATIENDE_SERVICIO_DEFAULT');
            foreach ($aServicios->servicios->items->servicio as $servicio) {
                $aData[$servicio->id] = $servicio->nombre;
            }

            return $aData;
        }

        return array(0 => JText::sprintf('MOD_CHILEATIENDE_ACCESS_TOKEN_NEED'));
    }

}
