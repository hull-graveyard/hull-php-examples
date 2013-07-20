if [ ! -f composer.phar ]; then
  echo 'Install composer'
  curl -sS https://getcomposer.org/installer | php
fi

echo 'Install dependencies'
php composer.phar install

echo 'Start server'
php -S localhost:8000
