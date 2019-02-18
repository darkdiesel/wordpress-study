#!/usr/bin/env bash

. /lib/lsb/init-functions

source /vagrant/configs/db.conf

if [ $(dpkg-query -W -f='${Status}' phpmyadmin 2>/dev/null | grep -c "ok installed") -eq 0 ]; then
    log_begin_msg "Installing phpmyadmin"

    sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
    sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password $DB_PASS"
    sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password $DB_PASS"
    sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password $DB_PASS"
    sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2"

#    sudo echo "phpmyadmin phpmyadmin/dbconfig-install boolean true" | debconf-set-selections
#    sudo echo "phpmyadmin phpmyadmin/app-password-confirm password $DB_PASS" | debconf-set-selections
#    sudo echo "phpmyadmin phpmyadmin/mysql/admin-pass password $DB_PASS" | debconf-set-selections
#    sudo echo "phpmyadmin phpmyadmin/mysql/app-pass password $DB_PASS" | debconf-set-selections
#    sudo echo "phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2" | debconf-set-selections

    sudo apt-get install -y phpmyadmin > /dev/null 2>&1

    if [[ $? > 0 ]]; then
        log_end_msg 1
    else
        log_end_msg 0
    fi
else
    log_begin_msg "phpmyadmin installed"
    log_end_msg 0
fi

if [ $(dpkg-query -W -f='${Status}' apache2 2>/dev/null | grep -c "ok installed") -eq 0 ]; then
    log_progress_msg "Apache2 not installed, pma host not enabled"
else
    log_begin_msg "Enable pma apache2 host"

    sudo a2ensite pma.wordpress-study.loc.conf > /dev/null 2>&1
    sudo service apache2 restart > /dev/null 2>&1

    log_end_msg 0
fi


if [ $(dpkg-query -W -f='${Status}' nginx 2>/dev/null | grep -c "ok installed") -eq 0 ]; then
    log_progress_msg "nginx not installed, pma host not enabled"
else
    log_begin_msg "Enable pma nginx host"

    sudo ln -s /etc/nginx/sites-available/pma.wordpress-study.loc.conf /etc/nginx/sites-enabled/ > /dev/null 2>&1
    sudo service nginx restart > /dev/null 2>&1

    log_end_msg 0
fi