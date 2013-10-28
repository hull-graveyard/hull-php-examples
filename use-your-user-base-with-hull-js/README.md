Use your user-base with hull.js
===============================

You already have your own users and you would like them to be recognized when
they use hull.js.

This demo uses [`$hull->userHash($user)`](/https://github.com/hull/hull-php-examples/blob/master/use-your-user-base-with-hull-js/index.php#L30) to generates an user hash. This hash is
used in [`Hull.init`](https://github.com/hull/hull-php-examples/blob/master/use-your-user-base-with-hull-js/views/admin.html#L13). It allows hull.js to recognize your users.

## Requirement

- PHP 5.4
- composer

## Install

    git clone git@github.com:hull/hull-php-examples.git
    cd hull-php-examples/use-your-user-base-with-hull-js
    ./boot.sh

Browse to [http://localhost:8000](http://localhost:8000)

If you have any questions, [email us](mailto:contact@hull.io) or ping us on
Twitter [@hull](http://twitter.com/hull), we’re always here to help.
