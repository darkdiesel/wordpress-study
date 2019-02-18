#!/usr/bin/env bash

. /lib/lsb/init-functions


if [ $(dpkg-query -W -f='${Status}' build-essential 2>/dev/null | grep -c "ok installed") -eq 0 ]; then
    log_begin_msg "Installing build-essential"
    sudo apt-get install -y build-essential > /dev/null 2>&1

    if [[ $? > 0 ]]; then
        log_end_msg 1
    else
        log_end_msg 0
    fi
else
    log_begin_msg "build-essential installed"
    log_end_msg 0
fi


if [ $(dpkg-query -W -f='${Status}' ruby-dev 2>/dev/null | grep -c "ok installed") -eq 0 ]; then
    log_begin_msg "Installing ruby-dev"
    sudo apt-get install -y ruby-dev > /dev/null 2>&1

    if [[ $? > 0 ]]; then
        log_end_msg 1
    else
        log_end_msg 0
    fi
else
    log_begin_msg "ruby-dev installed"
    log_end_msg 0
fi


if [ $(dpkg-query -W -f='${Status}' sqlite3 2>/dev/null | grep -c "ok installed") -eq 0 ]; then
    log_begin_msg "Installing sqlite3"
    sudo apt-get install -y sqlite3 > /dev/null 2>&1

    if [[ $? > 0 ]]; then
        log_end_msg 1
    else
        log_end_msg 0
    fi
else
    log_begin_msg "sqlite3 installed"
    log_end_msg 0
fi


if [ $(dpkg-query -W -f='${Status}' libsqlite3-dev 2>/dev/null | grep -c "ok installed") -eq 0 ]; then
    log_begin_msg "Installing libsqlite3-dev"
    sudo apt-get install -y libsqlite3-dev > /dev/null 2>&1

    if [[ $? > 0 ]]; then
        log_end_msg 1
    else
        log_end_msg 0
    fi
else
    log_begin_msg "libsqlite3-dev installed"
    log_end_msg 0
fi


log_begin_msg "Installing mailcatcher and gems for ruby"

sudo gem install bundler > /dev/null 2>&1
sudo gem install eventmachine -v 1.0.3 > /dev/null 2>&1
sudo gem install mime-types -v 2.99.1 > /dev/null 2>&1
sudo gem install mailcatcher -v 0.5.12 > /dev/null 2>&1

log_end_msg 0

if [ $(dpkg-query -W -f='${Status}' apache2 2>/dev/null | grep -c "ok installed") -eq 0 ]; then
    log_progress_msg "Apache2 not installed, mailcatcher host not enabled"
else
    log_begin_msg "Enable mailcatcher apache2 host"

    sudo a2ensite mailcatcher.wordpress-study.loc.conf > /dev/null 2>&1
    sudo service apache2 restart > /dev/null 2>&1

    log_end_msg 0
fi


if [ $(dpkg-query -W -f='${Status}' nginx 2>/dev/null | grep -c "ok installed") -eq 0 ]; then
    log_progress_msg "nginx not installed, mailcatcher host not enabled"
else
    log_begin_msg "Enable mailcatcher nginx host"

    sudo ln -s /etc/nginx/sites-available/mailcatcher.wordpress-study.loc.conf /etc/nginx/sites-enabled/ > /dev/null 2>&1
    sudo service nginx restart > /dev/null 2>&1

    log_end_msg 0
fi

log_begin_msg "Make mailcatcher start on boot"

sudo chmod 777 /etc/crontab
echo "@reboot root $(which mailcatcher) --http-ip=0.0.0.0" >> /etc/crontab
sudo chmod 644 /etc/crontab
sudo update-rc.d cron defaults > /dev/null

log_end_msg 0

log_begin_msg "Make php use mailcatcher to send mail"

# older ubuntus
sudo touch /etc/php5/mods-available/mailcatcher.ini
sudo chmod 777 /etc/php5/mods-available/mailcatcher.ini
sudo echo "sendmail_path = /usr/bin/env $(which catchmail) -f 'www-data@localhost'" >> /etc/php5/mods-available/mailcatcher.ini
sudo chmod 644 /etc/php5/mods-available/mailcatcher.ini

# xenial
#sudo touch /etc/php/7.0/mods-available/mailcatcher.ini
#sudo chmod 777 /etc/php/7.0/mods-available/mailcatcher.ini
#sudo echo "sendmail_path = /usr/bin/env $(which catchmail) -f 'www-data@localhost'" >> /etc/php/7.0/mods-available/mailcatcher.ini
#sudo chmod 644 /etc/php/7.0/mods-available/mailcatcher.ini
log_end_msg 0

log_begin_msg "Notify php mod manager (5.5+)"

# older ubuntus
sudo php5enmod mailcatcher
sudo service apache2 restart > /dev/null 2>&1

# xenial
#sudo phpenmod mailcatcher
log_end_msg 0

log_begin_msg "Starting mailcatcher"
/usr/bin/env $(which mailcatcher) --http-ip=0.0.0.0
log_end_msg 0
