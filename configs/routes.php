<?php 
$routes['default_controller'] = 'home';
$routes['test'] = 'home/index';
$routes['test1/.+-(\d+).html'] = 'home/detail/$1'; ///test1/bai-1.html