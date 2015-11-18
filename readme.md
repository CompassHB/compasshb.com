# Compass Bible Church Huntington Beach
[![Build Status](https://travis-ci.org/CompassHB/compasshb.com.svg?branch=master)](https://travis-ci.org/CompassHB/compasshb.com)

CompassHB is the main website app and source code for [compassHB.com](http://www.compasshb.com/).
## Getting Started
##### Local Server
Run the following one-time commands to spin up a local instance of the application. Requires VirtualBox and Vagrant.

	git clone git@github.com:CompassHB/compasshb.com.git
	composer install
	php vendor/bin/homestead make --name compasshb.com --hostname compasshb.local

Next, run the `vagrant up` command in your terminal and access your project at `http://homestead.app` in your browser. Remember, you will still need to add an `/etc/hosts` file entry for `homestead.app` or the domain of your choice. [Source](http://laravel.com/docs/master/homestead#introduction)

You will also want to run these commands:

	npm install
	gulp
	php artisan migrate:refresh --seed

##### Staging Server
The master branch is automatically deployed to [http://staging.compasshb.com/](http://staging.compasshb.com/).

## Contribution
Thank you for considering contributing to CompassHB.com. Send in a [pull request](https://help.github.com/articles/using-pull-requests/) or attend the next "tech night" to get involved.
