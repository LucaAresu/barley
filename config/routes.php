<?php
return [
  'GET' => [
      '' => 'GameController@index',
      'fattoria' => 'GameController@fattoria',
      'bar' => 'GameController@bar',
      'eventi' => 'GameController@pubblicita',


      'login' => 'LoginController@loginPage',
      'register' => 'LoginController@registerPage',
      'logout' => 'LoginController@logout',

  ],
    'POST' => [
        '' => 'GameController@cheat',
        'fattoria' => 'GameController@upgradeFattoria',
        'bar' => 'GameController@upgradeBar',
        'eventi' => 'GameController@pubblicitaComprata',

        'ajax/risorse' => 'AjaxController@risorse',
        'login' => 'LoginController@login',
        'register' => 'LoginController@register',
    ],
];