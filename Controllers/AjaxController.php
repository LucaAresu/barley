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

            $this->content = json_encode($resources);
        }

        public function display()
        {
            header('Content-type: application/json');
            echo $this->content;
        }
}