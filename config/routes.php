<?php
return [
  'GET' => [
      '' => 'GameController@index',


      'login' => 'LoginController@loginPage',
      'register' => 'LoginController@registerPage',
      'logout' => 'LoginController@logout',

  ],
    'POST' => [
        'ajax/risorse' => 'AjaxController@risorse',
        'login' => 'LoginController@login',
        'register' => 'LoginController@register',
    ],
];