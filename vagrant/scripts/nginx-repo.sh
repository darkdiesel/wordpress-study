#!/usr/bin/env bash

. /lib/lsb/init-functions

source /vagrant/configs/global.conf
source /vagrant/configs/nginx.conf

if [ $(dpkg-query -W -f='${Status}' nginx 2>/dev/null | grep -c "ok installed") -eq 0 ]; then
    log_begin_msg "Installing nginx"
    sudo apt-get install nginx -y > /dev/null 2>&1

    if [[ $? > 0 ]]; then
        log_end_msg 1
    else
        sudo service nginx stop
        log_end_msg 0
    fi
else
    log_begin_msg "nginx installed"
    log_end_msg 0
fi

log_begin_msg "Adding nginx sources list"
if [ -f $APT_SOURCE ]; then
    sudo rm -rf $APT_SOURCE
fi

if [ -f $VAGRANT_APT_SOURCE ]; then
    sudo cp -R $VAGRANT_APT_SOURCE $APT_SOURCE > /dev/null 2>&1
    sudo add-apt-repository ppa:nginx/stable -y > /dev/null 2>&1
else
    sudo touch $APT_SOURCE

    sudo chmod 777 $APT_SOURCE

    sudo echo "deb http://nginx.org/packages/ubuntu/ trusty nginx" >> $APT_SOURCE
    sudo echo "deb-src http://nginx.org/packages/ubuntu/ trusty nginx" >> $APT_SOURCE

    sudo add-apt-repository ppa:nginx/stable

    sudo chmod 755 $APT_SOURCE
fi
log_end_msg 0


log_begin_msg "Adding nginx signing key"
cd ~

if [ -f ~/nginx_signing.key ]; then
    sudo rm -rf ~/nginx_signing.key
fi

wget http://nginx.org/keys/nginx_signing.key  > /dev/null 2>&1
sudo apt-key add nginx_signing.key > /dev/null 2>&1
log_end_msg 0


log_begin_msg "Update nginx package"

sudo aptitude update > /dev/null 2>&1 && sudo aptitude safe-upgrade -y > /dev/null 2>&1 && sudo apt-get install -f -y > /dev/null 2>&1

log_end_msg 0


log_begin_msg "Generate ssl certs for nginx"
if [ ! -d /etc/nginx/ssl ]; then
    sudo mkdir /etc/nginx/ssl
fi

if [ -d "$MAIN_SITE_DIR" ]; then
    sudo openssl req -new -newkey rsa:1024 -nodes -keyout /etc/nginx/ssl/wordpress-study.loc_private.key -x509 -days 500 -subj /C=RU/ST=Grodno/L=Grodno/O=Companyname/OU=User/CN=wordpress-study.loc/emailAddress=admin@wordpress-study.loc -out /etc/nginx/ssl/wordpress-study.loc_bundle.crt > /dev/null 2>&1
fi

log_end_msg 0


log_begin_msg "Remove nginx default hosts"
sudo rm -rf /etc/nginx/sites-enabled/* > /dev/null 2>&1
log_end_msg 0


log_begin_msg "Copy nginx configs"
sudo cp -R /vagrant/configs/etc/nginx/* /etc/nginx/ > /dev/null 2>&1
log_end_msg 0

log_begin_msg "Create links for nginx hosts"
if [ -d "$MAIN_SITE_DIR" ]; then
    sudo ln -s /etc/nginx/sites-available/wordpress-study.loc /etc/nginx/sites-enabled/ > /dev/null 2>&1
fi

sudo ln -s /etc/nginx/sites-available/pma.wordpress-study.loc /etc/nginx/sites-enabled/ > /dev/null 2>&1

log_end_msg 0

log_begin_msg "Update privileges for nginx logs"
sudo chmod 777 -R /var/log/nginx/ > /dev/null 2>&1
log_end_msg 0

log_begin_msg "Starting nginx"
    sudo service nginx start
log_end_msg 0