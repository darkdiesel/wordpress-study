#!/usr/bin/env bash

. /lib/lsb/init-functions

source /vagrant/configs/mariadb.conf
source /vagrant/configs/db.conf


log_begin_msg "Adding mariadb sources list"
if [ -f $APT_SOURCE ]; then
    sudo rm -rf $APT_SOURCE
fi

if [ -f $VAGRANT_APT_SOURCE ]; then
    sudo cp -R $VAGRANT_APT_SOURCE $APT_SOURCE > /dev/null 2>&1
else
    sudo touch $APT_SOURCE

    sudo chmod 777 $APT_SOURCE

    sudo echo "deb [arch=amd64,i386] http://mirrors.nav.ro/mariadb/repo/10.2/ubuntu trusty main" >> $APT_SOURCE
    sudo echo "deb-src http://mirrors.nav.ro/mariadb/repo/10.2/ubuntu trusty main" >> $APT_SOURCE

    sudo chmod 755 $APT_SOURCE
fi
log_end_msg 0

log_action_msg "Installing additional packages"

if [ $(dpkg-query -W -f='${Status}' software-properties-common 2>/dev/null | grep -c "ok installed") -eq 0 ]; then
    log_begin_msg "Installing software-properties-common"

    sudo apt-get install -y software-properties-common > /dev/null 2>&1

    if [[ $? > 0 ]]; then
        log_end_msg 1
    else
        log_end_msg 0
    fi
else
    log_begin_msg "software-properties-common installed"
    log_end_msg 0
fi

if [ $(dpkg-query -W -f='${Status}' dirmngr 2>/dev/null | grep -c "ok installed") -eq 0 ]; then
    log_begin_msg "Installing dirmngr" > /dev/null 2>&1

    sudo apt-get install -y dirmngr > /dev/null 2>&1

    if [[ $? > 0 ]]; then
        log_end_msg 1
    else
        log_end_msg 0
    fi
else
    log_begin_msg "dirmngr installed"
    log_end_msg 0
fi

log_begin_msg "Adding mariadb key"
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xcbcb082a1bb943db > /dev/null 2>&1
log_end_msg 0

log_begin_msg "Update packages list"
sudo apt-get update > /dev/null 2>&1
log_end_msg 0

if [ $(dpkg-query -W -f='${Status}' mariadb-server 2>/dev/null | grep -c "ok installed") -eq 0 ]; then
    log_begin_msg "Installing mariadb-server"

    sudo debconf-set-selections <<< "mariadb-server mysql-server/root_password password $DB_PASS"
    sudo debconf-set-selections <<< "mariadb-server mysql-server/root_password_again password $DB_PASS"

    sudo apt-get install -y mariadb-server > /dev/null 2>&1

    if [[ $? > 0 ]]; then
        log_end_msg 1
    else
#        sudo systemctl start mariadb.service
#        sudo systemctl enable mariadb.service
        log_end_msg 0
    fi
else
    log_begin_msg "mariadb-server installed"
    log_end_msg 0
fi