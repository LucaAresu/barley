<?php


class GameController
{
    private $content;
    private $template = 'views/template/template.php';


    public function __construct()
    {
        requiredLogin();
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
            if((int)$buildingId ===  $fb->building_id)
                $building = $fb;

        if($user->risorse->soldi >= $building->costo) {
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

    public function bar()
    {
        $this->content = view('bar');
    }

    public function upgradeBar()
    {
        $buildingId = $_POST['building_id'];
        $user = getAuthUser();
        foreach($user->shopBuildings as $sb)
            if((int)$buildingId ===  $sb->building_id)
                $building = $sb;

        if($user->risorse->soldi >= $building->costo) {
            $user->risorse->soldi -= $building->costo;
            $user->risorse->save();
            UserShopBuildings::upgrade($user->id, $buildingId);
        }
        redirect('bar');

    }

    public function pubblicita()
    {
        $this->content = view('pubblicita');
    }

    public function pubblicitaComprata()
    {
        $user = getAuthUser();
        $modo = $_POST['modo'];
        $tipi = [];
        $tipi[] = ['costo' => 5000, 'clienti' => 1];
        $tipi[] = ['costo' => 15000, 'clienti' => 5];
        $tipi[] = ['costo' => 50000, 'clienti' => 20];
        $tipi[] = ['costo' => 10000000];

        if($user->risorse->soldi >= $tipi[$modo]['costo']) {
            if ((int)$modo === 3) {
                $user->risorse->clienti *= 2;
            }
            else
                $user->risorse->clienti += $tipi[$modo]['clienti'];
            $user->risorse->soldi -= $tipi[$modo]['costo'];
            $user->risorse->save();
        }

        redirect('pubblicita');


    }


}