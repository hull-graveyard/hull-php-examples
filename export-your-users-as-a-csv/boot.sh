if [ ! -f composer.phar ]; then
  echo 'Install composer'
  curl -sS https://getcomposer.org/installer | php
fi

echo 'Install dependencies'
php composer.phar install

echo '\033[01;31mTo export your data change hull config in "export.php" then run "php export.php" \033[0m'
