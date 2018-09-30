# E-Exam
![E-exam](/symfonyApp/public/build/images/logo.png)

E-exam system based on PHP Symfony framework.

---
Clone the project:
```
git clone https://github.com/hung-dao/e-exam.git
```

After cloning, make a secure connection to the virtual machine:
```
vagrant ssh
```
#### in the virtual machine:
```
cd /vagrant/symfonyApp
composer require symfony/webpack-encore-pack
composer install
exit
```
#### in the host machine:
```
cd symfonyApp
npm install
npm run dev
```
