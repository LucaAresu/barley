<?php
return [
  'GET' => [
      '' => 'GameController@index',
      'fattoria' => 'GameController@fattoria',


      'login' => 'LoginController@loginPage',
      'register' => 'LoginController@registerPage',
      'logout' => 'LoginController@logout',

  ],
    'POST' => [
        'fattoria' => 'GameController@upgradeFattoria',

        'ajax/risorse' => 'AjaxController@risorse',
        'login' => 'LoginController@login',
        'register' => 'LoginController@register',
    ],
];