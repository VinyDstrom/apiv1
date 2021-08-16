# apiv1
apiv1 using jwt token for login and registration.

# Install Composer in user system
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

https://getcomposer.org/download/

# Codeignitor 3 using Composer
composer create-project CodeIgniter/framework project_name

# Library
-> Find composer.json and paste inside application directory . 
-> Run Composer Install on same directory using terminal and it will create vendor dir and composer.lock file.
-> if you want vendor folder to be created somewhere else than make change on config file also (Change $config['composer_autoload'] = TRUE; to $config['composer_autoload'] = "autoload.php path on vendor";).

# Tables and Database
-> Create local database.
-> CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `create_date` timestamp default current_timestamp,
  `update_date` timestamp default current_timestamp on update current_timestamp,
  PRIMARY KEY (`id`,`username`)
);

# Run Project 
php -S localhost:8080

