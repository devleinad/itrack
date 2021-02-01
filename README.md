About itrack

itrack is a tracking full CRUD web app created by Daniel Peprah. It is meant to be used for tracking items together with their stockings and issuings.
Its features include:
•	Creating or adding of new users
•	Creating or adding of new items
•	Stocking items
•	Issuing items
•	Controlling user actions with laravel policies
•	Updating user details
•	Updating item details
•	Updating stockings
•	Updating issuings
•	User blocking mechanism/feature
•	It also has a feature of logging CRUD activities to a database table, and also to a file (can be found in storage/logs/activity.txt)

How to use it

NB: I am assuming you are already familiar with at least the basics of Laravel. Otherwise you can contact me via peprahdaniel.dp@gmail.com for any help or explanations needed. Also, you can visit https://laravel.com/docs and read the documentation.

Database configuration

First and foremost, open the .env file and make changes to the following to suit your system
•	DB_CONNECTION=your_datasource_connection(eg.mysql)
•	DB_HOST=127.0.0.1
•	DB_PORT=your_datasource_connection_port(eg.3306)
•	DB_DATABASE=your_database
•	DB_USERNAME=your_username
•	DB_PASSWORD=your_password
When you are done, make sure you create the database, and run migrations (with artisan command: php artisan migrate)
After running migrations with no errors generated, go ahead and start the server (with artisan command: php artisan serve)

Now, there is the need to have a superadmin, so opena browser and visit the url:127.0.0.1:8000/create_superuser. If no errors/exceptions are thrown, it means you have successfully created a super admin with the following details:
Name: Admin
Email: superadmin@admin.com
Designation: IT Technician
Password:admin

You can make changes inside the web/routes.php file, but know that the email has been used to set policy logics, so if you decide to change it, you’d have to visit the various policy files inside app/Policies and change the email there as well.
Also, if you decide to change the email, you’d have to change the email inside the isSuperAdmin() method inside the app/Models/User.php file. The isSuperAdmin() is a method used to check if a user is superadmin or not.

Once the above changes have been made, you may access the dashboard by hitting the url: 127.0.0.1/login
Fill out the form with the created superadmin’s email and password, and after a successful request, you shall be redirected to the dashboard. Once you get to the dashboard you will be able to peform various CRUD actions.

NB: only the superadmin will be able to create new items and users. Also, every other user created will not be a super admin, unless you change the logic inside the various policies to include other/specific emails.
It is also only a superadmin that can block and/or delete normal users.
Also, note that only superadmin would be able to view or delete activity logs.


Please, if you find my work interesting and would like to work with me, you can contact me on the following platforms:
Twitter: https://twitter.com/devleinad
Email:peprahdaniel.dp@gmail.com


Thank you!!
