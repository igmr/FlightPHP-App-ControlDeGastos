<?php

require_once __DIR__.'/../app/controllers/ViewClassificationController.php';
require_once __DIR__.'/../app/controllers/ViewSubclassificationController.php';
require_once __DIR__.'/../app/controllers/ViewDashboardController.php';

$classification    = new ViewClassificationController();
$subclassification = new ViewSubclassificationController();
$dashboard         = new ViewDashboardController();


Flight::route('GET /'                              , array($dashboard    , 'index'));
Flight::route('GET /dashboard/store(/@id)'         , array($dashboard    , 'store'));

Flight::route('GET /classification'                , array($classification    , 'index'));
Flight::route('GET /classification/store(/@id)'    , array($classification    , 'store'));

Flight::route('GET /subclassification'             , array($subclassification , 'index'));
Flight::route('GET /subclassification/store(/@id)' , array($subclassification , 'store'));

