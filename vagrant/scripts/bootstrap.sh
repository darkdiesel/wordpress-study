#!/usr/bin/env bash

. /lib/lsb/init-functions

log_begin_msg "Installing dos2unix"
sudo apt-get install -y dos2unix > /dev/null 2>&1
log_end_msg 0

sudo dos2unix /vagrant/scripts/*.conf  > /dev/null 2>&1

#echo "Copy apt configs"
#sudo cp -R /vagrant/configs/etc/apt/* /etc/apt/ > /dev/null 2>&1

#log_begin_msg "Updating packages list"
#sudo apt-get update -q > /dev/null 2>&1
#log_end_msg 0

log_begin_msg "Update privileges for bash scripts"
sudo chmod +x /vagrant/scripts/*.sh
log_end_msg 0

log_begin_msg "Convert to unix format sh scripts"
sudo dos2unix /vagrant/scripts/*.sh  > /dev/null 2>&1
log_end_msg 0

/vagrant/scripts/fix-locale.sh
/vagrant/scripts/mc.sh
/vagrant/scripts/apache2.sh
/vagrant/scripts/nginx.sh
/vagrant/scripts/mariadb10.2.sh
/vagrant/scripts/db-setup.sh
/vagrant/scripts/php5.sh
/vagrant/scripts/sendmail.sh
/vagrant/scripts/phpmyadmin.sh
/vagrant/scripts/mailcatcher.sh