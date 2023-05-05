<?php

function resuelve($path = ''){ 
    $url = '';  
    $app = Aplicacion::getInstance();
    $url = $app->resuelve($path);
    return $url;
}
