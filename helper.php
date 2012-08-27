<?php

/**
 * @Copyright Copyright (C) 2010 Alfred Bösch
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * */
defined('_JEXEC') or die('Restricted access');

class Chileatiende {

    function getFichas(&$params) {

        $lasFichas = '';

        $access_token = htmlspecialchars($params->get('access_token'));
        $servicio = htmlspecialchars($params->get('servicio', 0));
        $fichas = htmlspecialchars($params->get('fichas', ''));
        $nroFichas = htmlspecialchars($params->get('nro_fichas', 0));

        if ($access_token && $servicio) {

            $alasFichas = ($fichas) ? explode(',', $fichas) : array();

            $aFichasServicio = file_get_contents('https://www.chileatiende.cl/api/servicios/' . $servicio . '/fichas' . '?access_token=' . $access_token);
            $aFichasServicio = json_decode($aFichasServicio);

            foreach ($aFichasServicio->fichas->items as $key => $ficha) {
                //mostramos las fichas específicas de un servicio
                if (count($alasFichas)) {
                    $aData = explode('/', $ficha->permalink);
                    $idFicha = $aData[5]; //corresponde 
                    if (in_array($idFicha, $alasFichas)) {
                        $lasFichas .= '<li><a href="' . $ficha->permalink . '" target="_blank">' . $ficha->titulo . '</a></li>';
                    }
                } else {
                    //mostramos todas las fichas
                    if ($nroFichas == 0) {
                        $lasFichas .= '<li><a href="' . $ficha->permalink . '" target="_blank">' . $ficha->titulo . '</a></li>';
                    }
                    //se muestra un nro determinado de fichas
                    if ($key < $nroFichas) {
                        $lasFichas .= '<li><a href="' . $ficha->permalink . '" target="_blank">' . $ficha->titulo . '</a></li>';
                    }
                }
            }
        }

        return $lasFichas;
    }

}