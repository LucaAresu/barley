<?php
return [
  'GET' => [
      '' => 'GameController@index',
      'fattoria' => 'GameController@fattoria',
      'bar' => 'GameController@bar',
      'pubblicita' => 'GameController@pubblicita',


      'login' => 'LoginController@loginPage',
      'register' => 'LoginController@registerPage',
      'logout' => 'LoginController@logout',

  ],
    'POST' => [
        'fattoria' => 'GameController@upgradeFattoria',
        'bar' => 'GameController@upgradeBar',
        'pubblicita' => 'GameController@pubblicitaComprata',

        'ajax/risorse' => 'AjaxController@risorse',
        'login' => 'LoginController@login',
        'register' => 'LoginController@register',
    ],
];