<?php

require_once __DIR__.'/../vendor/autoload.php';

Flight::set('flight.views.path'     , __DIR__.'/../app/views');
Flight::set('flight.log_errors'     , true);
Flight::set('flight.case_sensitive' , true);
Flight::set('flight.base_url'       , 'https://ivangabino.com/app/control-de-gastos');
//Flight::set('flight.base_url'       , 'http://localhost:8080');


require_once __DIR__.'/../routes/api.php';
require_once __DIR__.'/../routes/web.php';