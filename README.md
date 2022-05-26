<h2><b>About itrack</b></h2>

itrack is a full Item stockings and issuings tracking web app.
Its features include:
<ul>
  <li>Creating or adding of new users</li>
  <li>Creating or adding of new items</li>
  <li>Stocking items</li>
  <li>Issuing items</li>
  <li>Controlling user actions with laravel policies</li>
  <li>Updating user details</li>
  <li>Updating item details</li>
  <li>Updating stockings</li>
  <li>Updating issuings</li>
  <li>User blocking mechanism/feature</li>
  <li>It also has a feature of logging CRUD activities to a database table, and also to a file (can be found in storage/logs/activity.txt)</li>
 </ul>


<h2><b>How to use it</h2>

NB: I am assuming you are already familiar with at least the basics of Laravel. Otherwise you can contact me via <b>peprahdaniel.dp@gmail.com</b> for any help or explanations needed. Also, you can visit <a href="https://laravel.com/docs">Laravel</a> and read the documentation.

<h2><b>Database configuration</b></h2>

First and foremost, open the .env file and make changes to the following to suit your system
<ul>
  <li>DB_CONNECTION=your_datasource_connection(eg.mysql)</li>  
  <li>DB_HOST=127.0.0.1</li>  
  <li>DB_PORT=your_datasource_connection_port(eg.3306)</li>  
  <li>DB_DATABASE=your_database</li>  
  <li>DB_USERNAME=your_username</li>  
  <li>DB_PASSWORD=your_password</li>
<ul>

When you are done, make sure you create the database, and run migrations (with artisan command: php artisan migrate)
After running migrations with no errors generated, go ahead and start the server (with artisan command: php artisan serve)
  
Now, there is the need to have a superadmin, so open a browser and visit the url: 127.0.0.1:8000/create_superuser. If no errors/exceptions are thrown, it means you have successfully created a super admin with the following details:
<ul>
  <li>Name: Admin</li>
  <li>Email: superadmin@admin.com</li>
  <li>Designation: IT Technician</li>
  <li>Password:admin</li>
</ul>

You can make changes inside the web/routes.php file, but know that the email has been used to set policy logics, so if you decide to change it, you’d have to visit the various policy files inside <b>app/Policies</b> and change the email there as well.
Also, if you decide to change the email, you’d have to change the email inside the isSuperAdmin() method inside the app/Models/User.php file. The isSuperAdmin() is a method used to check if a user is superadmin or not.

Once the above changes have been made, you may access the dashboard by hitting the url: <b>127.0.0.1/login</b>
Fill out the form with the created superadmin’s email and password, and after a successful request, you shall be redirected to the dashboard. Once you get to the dashboard you will be able to peform various CRUD actions.

NB: only the superadmin will be able to create new items and users. Also, every other user created will not be a super admin, unless you change the logic inside the various policies to include other/specific emails.
It is also only a superadmin that can block and/or delete normal users.
Also, note that only superadmin would be able to view or delete activity logs.


Please, if you find my work interesting and would like to work with me, you can contact me on the following platforms:
<ul>
  <li>Twitter: <a href="https://twitter.com/devleinad">@devleinad</a></li>
  <li>Email:peprahdaniel.dp@gmail.com</li>
</ul>


<h2>Thank you!!</h2>
