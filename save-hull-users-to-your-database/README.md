Save hull users to your database
===============================

When a hull user log in, hull set a cookie that can be retrieved on your server.
This cookie can be used to save user to your database.

This demo uses `$hull->currentUserId()`, it returns the id of the logged hull
user if there is one. If we have one, we check in our sqlite database if there
is a user that match. If there is one we return it, if not we create a new one
and return it.

## Requirements

- PHP 5.4
- sqlite3
- composer

## Install

    git clone git@github.com:hull/hull-php-examples.git
    cd hull-php-examples/save-hull-user-to-your-database
    ./boot.sh

Browse to [http://localhost:8000](http://localhost:8000)

If you have any questions, [email us](mailto:contact@hull.io) or ping us on
Twitter [@hull](http://twitter.com/hull), we’re always here to help.
