<?php

class  ViewDashboardController
{
    private $urlApi, $urlBase, $base_url, $home;
    public function __construct()
    {
        $this->urlBase  = Flight::get('flight.base_url');
        $this->base_url = 'https://ivangabino.com';
        $this->urlApi   = $this->base_url . '/data/apis/Lumen-Api-REST-ControlDeGastos/api';
        $this->home     = $this->urlBase  . '/';
    }
    //* -----------------------------------------------------------------------
    //* Methods Http
    //* -----------------------------------------------------------------------
    public function index()
    {
        $dataLayout = [
            'title'      => 'Dashboard',
            'styles'     => [
                            'assets/custom/dashboard/index',
                     ],
            'scripts'   => [
                            'assets/custom/dashboard/index',
                        ],
        ];
        $data = [];
        Flight::render('dashboard/index' , $data, 'content');
        Flight::render('layouts/master'  , $dataLayout);
    }
    public function store($id)
    {
        $id = $id == null ? -999 : $id;
        if($id < 0)
        {
            $type = Flight::request()->query['type'] ?: null;
            $income = $type == 'income' ? true : false;
            if(is_null($type))
            {
                Flight::redirect($this->home);
                return;
            }
            if($type != 'income' && $type != 'outcome')
            {
                Flight::redirect($this->home);
                return;
            }
            $this->viewAdd($type, $income);
            return;
        }
        $this->viewEdit($id);
    }
    //* -----------------------------------------------------------------------
    //* End Methods Http
    //* -----------------------------------------------------------------------
    //* Load View
    //* -----------------------------------------------------------------------
    private function viewAdd ($title, $income = true)
    {
        $subclassifications = '';
        if(!$income)
        {
            $subclassifications = $this->getSubclassification()['data']  ?: '';
        }
        $dataLayout = [
            'title'   => 'Add '. $title,
            'styles'  => [
                            'assets/custom/dashboard/store',
                         ],
            'scripts' => [
                            'assets/custom/dashboard/store',
                         ],
        ];
        $data = [
            'id'    => -999,
            'title' => '<span class="icon-text">
                            <span class="icon mr-4">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                            <span class="has-text-weight-normal">
                                Add '. $title .'
                            </span>
                        </span>',
            'income'=> $income ? 1 : 0,
            'data'  => [
                'subclassifications' => $subclassifications,
                'row'                => '',
            ],
        ];
        Flight::render('dashboard/store' , $data, 'content');
        Flight::render('layouts/master'  , $dataLayout);
    }
    private function viewEdit(int $id)
    {
        $operation = $this->getOperation($id);
        $status = $operation['status'];
        if($status != 200)
        {
            Flight::redirect($this->home);
            return;
        }
        $dashboard  = json_decode($operation['data']);
        $income  = $dashboard->type ==  'income' ? true: false;
        $title   = $dashboard->type;
        $subclassifications = '';
        if(!$income)
        {
            $subclassifications = $this->getSubclassification()['data']  ?: '';
        }

        $dataLayout = [
            'title'   => 'Add '. $title,
            'styles'  => [
                            'assets/custom/dashboard/store',
                         ],
            'scripts' => [
                            'assets/custom/dashboard/store',
                         ],
        ];
        $data = [
            'id'    => $id,
            'title' => '<span class="icon-text">
                            <span class="icon mr-4">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                            <span class="has-text-weight-normal">
                                Add '. $title .'
                            </span>
                        </span>',
            'income'=> $income ? 1 : 0,
            'data'  => [
                'subclassifications' => $subclassifications,
                'row'                => $dashboard,
            ],
        ];
        Flight::render('dashboard/store' , $data, 'content');
        Flight::render('layouts/master'  , $dataLayout);
    }
    //* -----------------------------------------------------------------------
    //* End Load View
    //* -----------------------------------------------------------------------
    //* Methods GET Curl
    //* -----------------------------------------------------------------------
    private function getSubclassification()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER, 0); 
        curl_setopt($curl, CURLOPT_URL, $this->urlApi . '/subclassification?pagination=0');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);;
        curl_close($curl);
        return [
            'status' => $status,
            'data'   => $data,
        ];
    }
    private function getOperation(int $id)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER, 0); 
        curl_setopt($curl, CURLOPT_URL, $this->urlApi . '/operation/'. $id);
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
    //* End Methods GET Curl
    //* -----------------------------------------------------------------------
}