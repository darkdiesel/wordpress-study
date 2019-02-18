#!/usr/bin/env bash

. /lib/lsb/init-functions


if [ $(dpkg-query -W -f='${Status}' php-fpm 2>/dev/null | grep -c "ok installed") -eq 0 ]; then
    log_begin_msg "Installing php-fpm"
    sudo apt-get install -y php7.0-fpm php7.0-mbstring php7.0-gd php7.0-curl php-xdebug > /dev/null 2>&1

    if [[ $? > 0 ]]; then
        log_end_msg 1
    else
        log_end_msg 0
    fi
else
    log_begin_msg "php-fpm installed"
    log_end_msg 0
fi

if [ $(dpkg-query -W -f='${Status}' php-mysql 2>/dev/null | grep -c "ok installed") -eq 0 ]; then
    log_begin_msg "Installing php-mysql"
    sudo apt-get install -y php-mysql > /dev/null 2>&1

    if [[ $? > 0 ]]; then
        log_end_msg 1
    else
        log_end_msg 0
    fi
else
    log_begin_msg "php-mysql installed"
    log_end_msg 0
fi

log_action_msg "Starting php7.0-fpm"
sudo service php7.0-fpm start  > /dev/null 2>&1

log_action_msg "Enabling php7.0-fpm"
sudo systemctl enable php7.0-fpm > /dev/null 2>&1

log_action_msg "Enabling apache2 php7.0-fpm conf"
sudo a2enconf php7.0-fpm > /dev/null 2>&1

log_action_msg "Restarting apache2"
sudo systemctl restart apache2 > /dev/null 2>&1