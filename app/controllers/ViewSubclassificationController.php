<?php

class ViewSubclassificationController 
{
    private $urlApi, $urlBase, $base_url, $home;
    public function __construct()
    {
        $this->urlBase  = Flight::get('flight.base_url');
        $this->base_url = 'https://ivangabino.com';
        $this->urlApi   = $this->base_url . '/data/apis/Lumen-Api-REST-ControlDeGastos/api';
        $this->home     = $this->urlBase  . '/subclassification';
    }
    //* -----------------------------------------------------------------------
    //* Methods Http
    //* -----------------------------------------------------------------------
    public function index()
    {
        $dataLayout = [
            'title'      => 'subclassifications',
            'styles'     => [
                            'assets/custom/subclassification/index',
                         ],
            'scripts'   => [
                            'assets/custom/subclassification/index',
                        ],
        ];
        $data = [];
        Flight::render('subclassification/index' , $data, 'content');
        Flight::render('layouts/master'           , $dataLayout);
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
    //* -----------------------------------------------------------------------
    //* End Methods Http
    //* -----------------------------------------------------------------------
    //* Load View
    //* -----------------------------------------------------------------------
    private function viewAdd ()
    {
        $dataLayout = [
            'title'   => 'Add subclassification',
            'styles'  => [
                            'assets/custom/subclassification/store',
                         ],
            'scripts' => [
                            'assets/custom/subclassification/store',
                         ],
        ];
        $data = [
            'id'    => -999,
            'title' => '<span class="icon-text">
                            <span class="icon mr-4">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                            <span class="has-text-weight-normal">
                                Add subclassification
                            </span>
                        </span>',
            'data' => [
                'classifications' => json_decode($this->getClassification(), true),
            ],
        ];
        Flight::render('subclassification/store' , $data, 'content');
        Flight::render('layouts/master'          , $dataLayout);
    }
    private function viewEdit(int $id)
    {
        $response = $this->getSubclassification($id);
        $code = $response['status'];
        $dto  = $response['data'];
        $classifications = $this->getClassification();
        if($code != 200)
        {
            Flight::redirect($this->home);
            return;
        }
        $dataLayout = [
            'title'   => 'Edit subclassification',
            'styles'  => [
                            'assets/custom/subclassification/store',
                         ],
            'scripts' => [
                            'assets/custom/subclassification/store',
                         ],
        ];
        $data = [
            'id'    => $id,
            'title' => '<span class="icon-text">
                            <span class="icon mr-4">
                                <i class="fa-solid fa-pen-nib"></i>
                            </span>
                            <span class="has-text-weight-normal">
                                Edit subclassification
                            </span>
                        </span>',
            'data'  => [
                'subclassification' => $dto,
                'classifications'   => $classifications,
            ],
        ];
        Flight::render('subclassification/store' , $data, 'content');
        Flight::render('layouts/master'          , $dataLayout);
    }
    //* -----------------------------------------------------------------------
    //* End Load View
    //* -----------------------------------------------------------------------
    //* Method GET Curl
    //* -----------------------------------------------------------------------
    private function getClassification()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER, 0); 
        curl_setopt($curl, CURLOPT_URL, $this->urlApi . '/classification?pagination=0');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }
    private function getSubclassification(int $id)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER, 0); 
        curl_setopt($curl, CURLOPT_URL, $this->urlApi . '/subclassification/'. $id);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);;
        curl_close($curl);
        return [
            'status' => $status,
            'data'   => $data,
        ];
    }
    //* -----------------------------------------------------------------------
    //* End Method GET Curl
    //* -----------------------------------------------------------------------
}