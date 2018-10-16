![E-exam](/symfonyApp/public/build/images/logo.png)

### Description
E-exam system where having 2 basic module:

The teacher module, which is used by teachers to create exams and to create new multiple-choice questions, which the exams are based on. Additionally, teachers should see the results of the student's exams.  

The student module, which is used by students to answer to the exams and to see their results.  
### Technologies
* PHP Symfony framework version 4.1
* MySQL database  
* Vagrant 2.1.5
* Bootstrap 4
* Doctrine 2 (Document below)

### Prerequisites to run
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
#### in the virtual machine - to update database:
```
$ cd /vagrant/symfonyApp
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:create
$ php bin/console doctrine:fixtures:load

```
#### in the virtual machine - View database by Mysql:
```
$ mysql -u root -p
$ User and Password declare from file .env
$ Created mysql User and Password in vagrantfile provisions (VagrantBootstrap.sh)
```
Doctrine
------------
[References](https://github.com/beberlei/DoctrineExtensions)
 
Set of extensions to Doctrine 2

| DB | Functions |
|:-----:|:----:|
| MySQL | `ACOS, AES_DECRYPT, AES_ENCRYPT, ANY_VALUE, ASCII, ASIN, ATAN, ATAN2, BINARY, BIT_COUNT, BIT_XOR, CAST, CEIL, CHAR_LENGTH, COLLATE, CONCAT_WS, CONVERT_TZ, COS, COT, COUNTIF, CRC32, DATE, DATE_FORMAT, DATEADD, DATEDIFF, DATESUB, DAY, DAYNAME, DAYOFWEEK, DAYOFYEAR, DEGREES, DIV, EXP, EXTRACT, FIELD, FIND_IN_SET, FLOOR, FROM_UNIXTIME, GREATEST, GROUP_CONCAT, HEX, HOUR, IFELSE, IFNULL, INET_ATON, INET_NTOA, INET6_ATON, INET6_NTOA, INSTR, IS_IPV4, IS_IPV4_COMPAT, IS_IPV4_MAPPED, IS_IPV6, LAST_DAY, LEAST, LOG, LOG10, LOG2, LPAD, MATCH, MD5, MINUTE, MONTH, MONTHNAME, NOW, NULLIF, PERIOD_DIFF, PI, POWER, QUARTER, RADIANS, RAND, REGEXP, REPLACE, ROUND, RPAD, SECOND, SECTOTIME, SHA1, SHA2, SIN, SOUNDEX, STD, STDDEV, STRTODATE, STR_TO_DATE, SUBSTRING_INDEX, TAN, TIME, TIMEDIFF, TIMESTAMPADD, TIMESTAMPDIFF, TIMETOSEC, UNHEX, UNIX_TIMESTAMP, UTC_TIMESTAMP, UUID_SHORT, VARIANCE, WEEK, WEEKDAY, YEAR, YEARMONTH, YEARWEEK` |

### INSTALL

To install this library, run the command below and you will get the latest
version:

```
composer require beberlei/DoctrineExtensions
```

If you want to run phpunit:

```
make test
```

If you want to run php-cs-fixer:

```sh
make fix  # (or make lint for a dry-run)
```

### USAGE

Read Symfony for Doctrine documentation on [How to Register custom DQL Functions](https://symfony.com/doc/current/doctrine/custom_dql_functions.html).

You can find example Symfony configuration for using DoctrineExtensions custom DQL functions in [config](config).


For more information check out the documentation of [Doctrine DQL User Defined Functions](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/cookbook/dql-user-defined-functions.html).
