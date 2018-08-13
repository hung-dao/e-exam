#!/usr/bin/env bash

apt-get install -y python-software-properties
add-apt-repository -y ppa:ondrej/php
apt-get update -y

apt-get install curl
debconf-set-selections <<< 'mysql-server-5.7 mysql-server/root_password password my-vagrant-password'
debconf-set-selections <<< 'mysql-server-5.7 mysql-server/root_password_again password my-vagrant-password'
echo "Installing mysql-server 5.7 with my-vagrant-password as root password"
apt-get -y install mysql-server-5.7

apt-get install -y apache2

a2enmod ssl
a2enmod rewrite

apt-get install -y php7.1 libapache2-mod-php7.1 php7.1-cli php7.1-common php7.1-mbstring php7.1-gd php7.1-intl php7.1-xml php7.1-mysql php7.1-mcrypt php7.1-zip php7.1-curl

#copy apache2 sites files
cp /vagrant/.vagrant/apache2/sites-available/* /etc/apache2/sites-available
a2ensite symfonyApp
a2dissite 000-default
service apache2 restart

apt-get install -y composer




