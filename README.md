# Project to get you started with a Vagrant VM and Symfony 4 

This project gives you an empty Vagrant based virtual machine with Ubuntu server configured to run Symfony 4 with Apache 2 web server. 

## Prerequisites
  - [Virtual Box (or similar)](https://www.virtualbox.org/wiki/Downloads )
  - [Vagrant](https://www.vagrantup.com/)
  
Also some Vagrant plugins are required
```sh
$ vagrant plugin install vagrant-vbguest  
$ vagrant plugin install vagrant-winnfsd 
```

## Post installation startup commands

First clone this repository and then execute following steps in the folder where you cloed the repo.

Start Vagrant (note! this will take a while on the first time when everything is downloaded)
```sh
$ vagrant up
```

Open SSH connection to the VM
```sh
$ vagrant ssh
```

Navigate to the /vagrant folder and execute composer command to create a new Symfony 4 project
```sh
$ cd /vagrant
$ composer create-project symfony/skeleton symfonyApp
```

If everything went correct, you should now be able to see the welcome page of an empty symfony 4 application here:
 http://localhost:4567/
 
