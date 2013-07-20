if [ ! -f composer.phar ]; then
  echo 'Install composer'
  curl -sS https://getcomposer.org/installer | php
fi

echo 'Install dependencies'
php composer.phar install

echo 'Prepare database'
cat user.sql | sqlite3 app.db

echo 'Start server'
php -S localhost:8000
