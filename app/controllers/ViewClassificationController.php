<?php

class ViewClassificationController 
{
    private $urlApi, $urlBase, $base_url, $home;
    public function __construct()
    {
        $this->urlBase  = Flight::get('flight.base_url');
        $this->base_url = 'https://ivangabino.com';
        $this->urlApi   = $this->base_url . '/apis/Lumen-Api-REST-ControlDeGastos/api';
        $this->home     = $this->urlBase  . '/classification';
    }

    public function index()
    {
        $dataLayout = [
            'title'      => 'Classifications',
            'styles'     => [
                            'assets/custom/classification/index',
                         ],
            'scripts'   => [
                            'assets/custom/classification/index',
                        ],
        ];
        $data = [];
        Flight::render('classification/index'   , $data, 'content');
        Flight::render('layouts/master'         , $dataLayout);
    }

    public function store($id)
    {
        $id = $id == null ? -999 : $id;
        
        if($id == -999)
        {
            $this->viewAdd();
            return;
        }
        if(!is_numeric($id))
        {
            Flight::redirect($this->home);
            return;
        }
        if($id <= 2 )
        {
            Flight::redirect($this->home);
            return;
        }
        if($id > 2 )
        {
            $this->viewEdit($id);
            return;
        }
        Flight::redirect($this->home);
    }

    private function viewAdd ()
    {
        $dataLayout = [
            'title'   => 'Add classification',
            'styles'  => [
                            'assets/custom/classification/store',
                         ],
            'scripts' => [
                            'assets/custom/classification/store',
                         ],
        ];
        $data = [
            'id'    => -999,
            'title' => '<span class="icon-text">
                            <span class="icon mr-4">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                            <span class="has-text-weight-normal">
                                Add classification
                            </span>
                        </span>',
            'data' => [],
        ];
        Flight::render('classification/store'   , $data, 'content');
        Flight::render('layouts/master'         , $dataLayout);
    }

    private function viewEdit(int $id)
    {
        $response = $this->getClassification($id);
        $code = $response['status'];
        $dto  = $response['data'];
        if($code != 200)
        {
            Flight::redirect($this->home);
        }
        $dataLayout = [
            'title'   => 'Edit classification',
            'styles'  => [
                            'assets/custom/classification/store',
                         ],
            'scripts' => [
                            'assets/custom/classification/store',
                         ],
        ];
        $data = [
            'id'    => $id,
            'title' => '<span class="icon-text">
                            <span class="icon mr-4">
                                <i class="fa-solid fa-pen-nib"></i>
                            </span>
                            <span class="has-text-weight-normal">
                                Edit classification
                            </span>
                        </span>',
            'data'  =>  $dto,
        ];
        Flight::render('classification/store'   , $data, 'content');
        Flight::render('layouts/master'         , $dataLayout);
    }

    private function getClassification(int $id)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER, 0); 
        curl_setopt($curl, CURLOPT_URL, $this->urlApi . '/classification/'. $id);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);;
        curl_close($curl);
        return [
            'status' => $status,
            'data'   => $data,
        ];
    }
}