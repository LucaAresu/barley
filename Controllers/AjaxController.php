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
            $ret->soldi = number_format($resources->soldi);
            $ret->caffe = number_format($resources->caffe);
            $ret->carote = number_format($resources->carote);
            $ret->clienti = number_format($resources->clienti);
            $ret->torte = number_format($resources->torte);
            $this->content = json_encode($ret);
        }

        public function display()
        {
            header('Content-type: application/json');
            echo $this->content;
        }
}