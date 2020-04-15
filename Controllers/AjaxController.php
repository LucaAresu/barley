<?php


class AjaxController
{
        private $content;
        public function __construct()
        {

        }

        public function risorse()
        {
            $input = file_get_contents('php://input');
            $input = json_decode($input);

            if(!checkToken($input->token))
                throw new Error('accesso negato');

            $resources = Resource::get($input->userId);
            $ret = new stdClass();
            $ret->soldi = is_numeric($resources->soldi) ? number_format($resources->soldi) : $resources->soldi;
            $ret->caffe = is_numeric($resources->caffe) ? number_format($resources->soldi) : $resources->caffe;
            $ret->carote = is_numeric($resources->carote) ? number_format($resources->soldi) : $resources->carote;
            $ret->clienti = is_numeric($resources->clienti) ? number_format($resources->soldi) : $resources->clienti;
            $ret->torte = is_numeric($resources->torte) ? number_format($resources->soldi) : $resources->torte;
            $this->content = json_encode($ret);
        }

        public function display()
        {
            header('Content-type: application/json');
            echo $this->content;
        }
}