![E-exam](/symfonyApp/public/build/images/logo.png)

### Technologies
* PHP Symfony framework
* MySQL database  

### Prerequisites
* [Virtual Box (or similar)](https://www.virtualbox.org/wiki/Downloads)
* [Vagrant](https://www.vagrantup.com/)  

Also some Vagrant plugins are required
```
$ vagrant plugin install vagrant-vbguest 
$ vagrant plugin install vagrant-winnfsd 
```

### Installing
Clone the project:
```
$ git clone https://github.com/hung-dao/e-exam.git
```

After cloning, make a secure connection to the virtual machine:
```
$ vagrant ssh
```
#### in the virtual machine:
```
$ cd /vagrant/symfonyApp
$ composer require symfony/webpack-encore-pack
$ composer install
$ exit
```
#### in the host machine:
```
$ cd symfonyApp
$ npm install
$ npm run dev
```
