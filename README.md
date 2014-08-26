README
======

Description of this project
-----------------

This project is a Symfony2 bundle which allow to convert a date from a calendar to another. For example from the Julian calendar to the gregorian one. After the installation, you can see a full description of this application on the route /documentation, and also all the convertion which are working.

Install this project: global explanations
-----------------

In order to use this project, you can either add the bundle to your symfony project or install the full project and run the project in localhost.

In order to install the project, you have to:

  * Install a web server (Apache for example) using PHP with a higher version than 5.3.8.
  * Install a database server with PDO (a mysql server and mysql_pdo for example).
  * Then, you can download the date-converter project on github.
  * Then you have to download composer.phar on https://getcomposer.org/download/ and execute the command line "php composer.phar update" in the project directory, in order to download all the extentions which are needed for date-converter.
  * Now, the project should be well initialize, so you just have to launch the web server and go to http://localhost/date-converter/web/config.php (With the good port) in order to know if everything is alright.
  * Then, you must configure the database server in the file /app/config/parameters.yml
  * In order to create the database, launch php app/console doctrine:database:create
  * Then, you should import the initial data on your database by importing the file "db.sql" situated at the root of date-converter.
  * After, you can go to http://localhost/date-converter/web/app_dev.php/documentation (with the good port) in order to have more information about this project ! If an error 404 appears, there is probably a problem with your web server or the URL (maybe the port), otherwise the problem should come from the database server.

Install this project: OSx
-----------------

