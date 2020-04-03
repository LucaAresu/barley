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
            $ret->soldi = $resources->soldi;
            $ret->caffe = $resources->caffe;
            $ret->carote = $resources->carote;
            $ret->clienti = $resources->clienti;
            $this->content = json_encode($ret);
        }

        public function display()
        {
            header('Content-type: application/json');
            echo $this->content;
        }
}