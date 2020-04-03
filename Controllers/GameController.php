<?php


class GameController
{
    private $content;
    private $template = 'views/template/template.php';


    public function __construct()
    {

    }

    public function index()
    {
        $this->content = "<br><br>a<br>a<br>a<br>a<br>a<br>";
    }

    public function fattoria()
    {
        $this->content =  view('fattoria');
    }

    public function upgradeFattoria() {
        $buildingId = $_POST['building_id'];
        $user = getAuthUser();
        foreach($user->farmBuildings as $fb)
            if($buildingId == $fb->building_id)
                $building = $fb;
        if($user->risorse->soldi > $building->costo) {
            $user->risorse->soldi -= $building->costo;
            $user->risorse->save();
            UserFarmBuildings::upgrade($user->id, $buildingId);
        }
        redirect('fattoria');

    }
    public function display()
    {
        require $this->template;
    }


}