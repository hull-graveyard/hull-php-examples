<?php

require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set('America/Los_Angeles');

$hull = new Hull_Client(array(
  'hull' => array(
    'host' => 'https://hull-demos.hullapp.io',
    'appId' => '51bf3c5f3c923f805f0001ec',
    'appSecret' => '68889ea92eb685b92d9ee08e1d483365'
  )
));

$app = new Silex\Application();
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.path' => __DIR__.'/views'
));

$app['debug'] = true;

$user = array('id' => 1, 'email' => 'user@example.com');
$app->get('/', function() use($app, $hull) {
  $user = $app['session']->get('user');

  if ($user) {
    return $app['twig']->render('admin.html', array(
      'user' => $user,
      'userHash' => $hull->userHash($user)
    ));
  } else {
    return $app['twig']->render('index.html');
  }
});

use Symfony\Component\HttpFoundation\Request;
$app->post('sign_in', function(Request $request) use($app, $user) {
  $email = $request->get('email');
  $password = $request->get('password');

  if ($email == $user['email'] && $password == 'password') {
    $app['session']->set('user', $user);
    return $app->redirect('/');
  } else {
    return $app['twig']->render('index.html');
  }
});

$app->run();
