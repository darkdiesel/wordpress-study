# Wordpress Study

Website based on WordPress CMS for study 

### Run Vagrant Project ###
* [Download](https://www.vagrantup.com/downloads.html) and [install](https://www.vagrantup.com/docs/installation/) Vagrant
* [Check](#db-backups) db backup files before location  
* Install VirtualBox on you machine from. See [virtualbox.org](https://www.virtualbox.org/) for installation package.
* Vagrant Box init wih ubuntu/trusty64 box. Before running vagrant check for last box version `vagrant box update`. Remove old with `vagran box prune` command
* Install plugin vagrant-vbguest `vagrant plugin install vagrant-vbguest`
* Run vagrant `vagrant up`
* Add to hosts `192.168.56.146  wordpress-study.loc www.wordpress-study.loc pma.wordpress-study.loc mailcatcher.wordpress-study.loc`
* Note! After installation complete [update](#update-db-links) db links.

#### Config
* Create copy of wp-config-sample.php with name wp-config.php
* Set db name, user, password, table prefix and other settings for db connections.

#### Db backups
* Db backup files ignored by git 
* Create database backup and put it to `data/db-backups/` folder
* Rename db backup file to `db.sql`

#### Update db links
* Use searchreplacedb2.php (php 5.x) or search-replace-db-3 (php 7.x) for updating urls in db. Run this file in browser.

#### Deploy
* After deploying to production server be sure that you remove searchreplacedb2.php and  search-replace-db-3