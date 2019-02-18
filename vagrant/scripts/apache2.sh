#!/usr/bin/env bash

. /lib/lsb/init-functions

source /vagrant/configs/global.conf

if [ $(dpkg-query -W -f='${Status}' apache2 2>/dev/null | grep -c "ok installed") -eq 0 ]; then
    log_begin_msg "Installing apache2"
    sudo apt-get update > /dev/null 2>&1 && sudo apt-get install -y apache2 > /dev/null 2>&1

    if [[ $? > 0 ]]; then
        log_end_msg 1
    else
        sudo service apache2 stop
        log_end_msg 0
    fi
else
    log_begin_msg "apache2 installed"
    log_end_msg 0
fi

log_action_msg "Removing apache2 default hosts"
    sudo a2dissite 000-default.conf > /dev/null 2>&1
#    sudo rm -rf /etc/apache2/sites-enabled/* > /dev/null 2>&1


log_action_msg "Copping apache2 configs"
sudo cp -R /vagrant/configs/etc/apache2/* /etc/apache2/ > /dev/null 2>&1


log_action_msg "Creating links for apache2 hosts"
if [ -d "$MAIN_SITE_DIR" ]; then
    sudo a2ensite wordpress-study.loc.conf > /dev/null 2>&1
fi

log_begin_msg "Enable apache mods"
sudo a2enmod rewrite > /dev/null 2>&1
sudo a2enmod expires > /dev/null 2>&1
sudo a2enmod headers > /dev/null 2>&1

#sudo a2enmod ssl > /dev/null 2>&1

sudo a2enmod proxy_fcgi > /dev/null 2>&1
sudo a2enmod proxy > /dev/null 2>&1
#sudo a2enmod proxy_http > /dev/null 2>&1
#sudo a2enmod proxy_ajp > /dev/null 2>&1
#sudo a2enmod proxy_balancer > /dev/null 2>&1
#sudo a2enmod proxy_connect > /dev/null 2>&1
#sudo a2enmod proxy_html > /dev/null 2>&1
log_end_msg 0

log_begin_msg "Installing libapache2-mod-rpaf"
sudo apt-get install -y libapache2-mod-rpaf > /dev/null 2>&1

if [[ $? > 0 ]]; then
    log_end_msg 1
else
    log_end_msg 0
fi

log_begin_msg "Update privileges for apache2 logs"
sudo chmod 777 -R /var/log/apache2/ > /dev/null 2>&1
log_end_msg 0

log_begin_msg "Starting apache2"
    sudo service apache2 start > /dev/null 2>&1
log_end_msg 0