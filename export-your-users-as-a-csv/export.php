<?php

require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set('America/Los_Angeles');

$hull = new Hull_Client(array(
  'hull' => array(
    'host' => 'https://hull-demos.hullapp.io',
    'appId' => '51bf3c5f3c923f805f0001ec',
    'appSecret' => 'APP_SECRET'
  )
));

$users = [];

$csv = array(
  array('name', 'email', 'picture', 'sign in count')
);

$page = 1;
$is_last_page = false;
while (!$is_last_page) {
  $success = true;
  try {
    $response = $hull->get('app/users', array( 'per_page' => 100, 'page' => $page));
  } catch (Exception $e) {
    $success = false;
  }

  if ($success) {
    echo "Page #" . $page . ": Fetched\n";
    $page++;

    $c = count($response);
    if ($c > 0) {
      foreach($response as $p) {
        $u = $p->user;

        $email = empty($u->email) ? 'unknow' : $u->email;
        $picture = empty($u->picture) ? 'unknow' : $u->picture;
        $sign_in_count = property_exists($u->stats, 'sign_in_count') ? $u->stats->sign_in_count : 'unknow';

        array_push($csv, array($u->name, $email, $picture, $sign_in_count));
      }
    }

    $is_last_page = $c < 100;
  } else {
    echo "Page #" . $page . ": Failed, retrying\n";
  }
}

$filename = 'users-'. $hull->appId .'-'. date('Y-m-d-H-i-s') .'.csv';
$f = fopen($filename, 'w');
foreach ($csv as $fields) {
  fputcsv($f, $fields);
}
fclose($f);

echo "Users exported in ". $filename ."\n";
