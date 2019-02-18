#!/usr/bin/env bash

. /lib/lsb/init-functions

source /vagrant/configs/global.conf
source /vagrant/configs/nginx.conf

if [ $(dpkg-query -W -f='${Status}' nginx 2>/dev/null | grep -c "ok installed") -eq 0 ]; then
    log_begin_msg "Installing nginx"
    sudo apt-get install nginx -y > /dev/null

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

log_begin_msg "Generate ssl certs for nginx"

if [ ! -d /etc/nginx/ssl ]; then
    sudo mkdir /etc/nginx/ssl
fi

if [ -d "$MAIN_SITE_DIR" ]; then
    if [ ! -d "/vagrant/configs/etc/nginx/ssl" ]; then
        sudo mkdir /vagrant/configs/etc/nginx/ssl
    fi


    if [ ! -f "/vagrant/configs/etc/nginx/ssl/wordpress-study.loc_bundle.crt" ]; then
        if [ ! -f "/vagrant/configs/etc/nginx/ssl/wordpress-study.loc_private.key" ]; then
            sudo openssl req -new -newkey rsa:1024 -nodes -keyout /vagrant/configs/etc/nginx/ssl/wordpress-study.loc_private.key -x509 -days 500 -subj /C=RU/ST=Grodno/L=Grodno/O=Companyname/OU=User/CN=wordpress-study.loc/emailAddress=admin@wordpress-study.loc -out /vagrant/configs/etc/nginx/ssl/wordpress-study.loc_bundle.crt > /dev/null
        fi
    fi
fi

log_end_msg 0


log_begin_msg "Remove nginx default hosts"
sudo rm -rf /etc/nginx/sites-enabled/* > /dev/null
log_end_msg 0


log_begin_msg "Copy nginx configs"
sudo cp -R /vagrant/configs/etc/nginx/* /etc/nginx/ > /dev/null
log_end_msg 0

log_begin_msg "Create links for nginx hosts"
if [ -d "$MAIN_SITE_DIR" ]; then
    sudo ln -s /etc/nginx/sites-available/wordpress-study.loc.conf /etc/nginx/sites-enabled/ > /dev/null
fi
log_end_msg 0

log_begin_msg "Update privileges for nginx logs"
sudo chmod 777 -R /var/log/nginx/ > /dev/null
log_end_msg 0

log_begin_msg "Starting nginx"
    sudo service nginx start > /dev/null 2>&1
log_end_msg 0