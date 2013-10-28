<?php

require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set('America/Los_Angeles');

ActiveRecord\Config::initialize(function($config) {
   $config->set_model_directory( __DIR__ . '/models');
   $config->set_connections(array('development' => 'sqlite://app.db'));
});

$hull = new Hull_Client(array(
  'hull' => array(
    'host' => 'https://hull-demos.hullapp.io',
    'appId' => '51bf3c5f3c923f805f0001ec',
    'appSecret' => 'APP_SECRET'
  )
));

$app = new Silex\Application();
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.path' => __DIR__.'/views'
));

$app['debug'] = true;

$app->before(function() use($hull, $app) {
  $hull_id = $hull->currentUserId();
  if ($hull_id) {
    $users = User::find_all_by_hull_id($hull_id);
    if (empty($users)) {
      $hull_user = $hull->get($hull_id);

      $user = User::create(array(
        'name' => $hull_user->name,
        'email' => $hull_user->email,
        'hull_id' => $hull_user->id
      ));
    } else {
      $user = $users[0];
    }

    $app['session']->set('user', $user);
  } else {
    $app['session']->clear();
  }
});

$app->get('/', function() use($app) {
  return $app['twig']->render('index.html', array(
    'user' => $app['session']->get('user')
  ));
});

$app->run();
