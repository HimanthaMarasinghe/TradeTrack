<?php

class DistributorNoMan extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home'], 'userType' => 'Distributor'],
        'styleSheet' => ['styleSheet'=>'distributor']
    ];

    public function __construct() {
        if(!isset($_SESSION['distributor']['phone'])){
            redirect('login');
            exit;
        }
        if($_SESSION['distributor']['man_phone']){
            redirect('Distributor');
            exit;
        }
    }

    public function index(){
        $this->data['tabs']['active'] = 'Home';
        $this->view('Distributor/viewManufacturers', $this->data);
    }

    public function RequestedManufacturers(){
        $this->data['tabs']['active'] = 'Home';
        $this->view('Distributor/requestedManufacturers', $this->data);
    }

    public function searchManufacturers(){
        $search = $_GET['searchTerm'];
        $mans = (new Manufacturers)->searchManufacturers($search,$_SESSION['distributor']['phone']) ?: [];
        header('Content-Type: application/json');
        echo json_encode($mans);
    }

    public function searchRequestedManufacturers(){
        $search = $_GET['searchTerm'];
        $mans = (new Manufacturers)->searchRequestedManufacturers($search,$_SESSION['distributor']['phone']) ?: [];
        header('Content-Type: application/json');
        echo json_encode($mans);
    }

    public function sendDisRequest(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            (new disReq)->insert(['man_phone' => $_POST['man_phonehidden'], 'dis_phone' => $_SESSION['distributor']['phone']]);
            redirect("Distributor/ViewManufacturers");
        }
    }

    public function removeDisRequest(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // (new disReq)->removeReq(['man_phone' => $_POST['man_phonehidden'], 'dis_phone' => $_SESSION['distributor']['phone']]);
            (new disReq)->delete(['man_phone' => $_POST['man_phonehidden'], 'dis_phone' => $_SESSION['distributor']['phone']]);
            redirect("Distributor/requestedManufacturers");
        }
    }

}