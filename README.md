README
======

This file can be read at https://github.com/Joyas/date-converter, and has been 
formatted for that.

Description of this project
-----------------

This project is a Symfony2 project (Can be used as a Symfony2 bundle) which 
allows to convert a date using a specific calendar to another date using a 
different calendar. For example from the Julian calendar to the gregorian one. 
After the installation, you can see a full description of this application 
on the route /documentation, and also all the convertions which are working. 
(You can see the html page of this documentation in 
/src/TH/DateConverter/Bundle/Resources/views/Documentation/index.html)
However, because it is a symfony bundle, when you query the server, you always
must query the route /web and then the route that you want to query. For example
URL/web/documentation.

## Installing

### Overall

In order to use this project, you can either add the bundle to your symfony 
project or install the full project and run the project in localhost.

In order to install the project, you have to:

  * Install a web server (Apache for example) using PHP with a higher version 
than 5.3.8. (I recommand you to use WAMP/MAMP or LAMP if you are not used to 
those technologies. They contain a web server, a mysql server and a good version of PHP)
  * Install a database server with PDO (a mysql server and mysql_pdo for example).
  * Then, you can download the date-converter project on github.
  * You have to download composer.phar on https://getcomposer.org/download/ and 
execute the command line "php composer.phar update" in the project directory, in 
order to download all the extentions which are needed for date-converter.
  * Now, the project should be well initialize, so you just have to launch the web 
server and go to http://localhost/date-converter/web/config.php (with the good port) 
in order to know if everything is alright.
  * Then, you must configure the database server in the file /app/config/parameters.yml 
(If you are using WAMP/MAMP/LAMP, the default port is 8889, the password and 
username are root, and you should name your database date-converter)
  * In order to create the database, launch php app/console doctrine:database:create
  * Then, you should import the initial data on your database by importing the 
file "db.sql" situated at the root of date-converter. If you do not do that, an 
exception will be throw if you go to /documentation because the table King must be set.
  * After, you can go to http://localhost/date-converter/web/app_dev.php/documentation
 (with the good port) in order to have more information about this project ! If an error 
404 appears, there is probably a problem with your web server or the URL (maybe the port), 
otherwise the problem should come from the database server.

I recommand you to download WAMP (on windows), LAMP (on Linux) or MAMP (on MacOS). 
Those packages already contain the web server Apache, a good version of PHP, and
a mysql server.

Finally, you can enjoy the application and modify it as much as you want! Enjoy ! :)

### MacOS

Below, all the step to launch the application on OSx using MAMP: 

* First, install MAMP. You can find it at http://www.mamp.info/en/downloads/. It 
contains the good version of PHP , Apache as a web server, and a mysql server. In 
all the following command, you have to use the php binary which is situated in the 
directory /Applications/MAMP/bin/php/php5.X.X/bin/ (replace X.X by the version of 
PHP that you dowloaded). You can update you PATH variable in your environment in 
order to use this php binary as default by adding the line 
"PATH=/Applications/MAMP/bin/php/php5.X.X/bin/:$PATH" in the file .profile and then 
launch source ~/.profile.
* Then, you can download the date-converter project on github, and put it on the root 
directory of your web server. You can change the root directory on the settings of the 
MAMP software.
* Now, you must download the composer command that will be use to initiate the 
application. If you have curl, you can launch the command line 
"curl -sS https://getcomposer.org/installer | php". Make sure to use the good version 
of php downloaded with MAMP. If you do not have curl, you can follow the instruction 
on https://getcomposer.org/download/.
* Now, you must use composer.phar that you just downloaded by tapping 
"php composer.phar update". All the dependencies of the date-converter project should 
be download. The port of the mysql server is 8889 by default, and the user & the password 
are root by default. You should name your database date-converter.
* Now, you can launch the mysql and the webserver on MAMP, and then go to 
http://localhost:8888/date-converter/web/config.php in order to know if everything works well.
* After, you must create the database by tapping "php app/console doctrine:database:create". 
* Now, you just need to initialise this database with the initial data. With MAMP, you
have to go at http://localhost:8888/phpMyAdmin/?lang=en, then choose the database date-converter 
(that you just created), and then import the file db.sql which is situated at the root of 
the date-converter project.
* Finally, you can go to http://localhost:8888/date-converter/web/app_dev.php/documentation 
in order to see how works this application ;) Enjoy !
