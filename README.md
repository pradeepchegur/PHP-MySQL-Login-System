# PHP-MySQL-Login-System
User login and registration system built using PHP and MySQL. User login, registration and logout time also saved in database to track user activity. 

# Implemenatation Steps:
1. Install Xampp and Start Apache Server and MySQL Server.
2. Type http://localhost/phpmyadmin in chrome tab. It will head to phpMyAdmin where all MySQL databases are stored.
3. Import users SQL file in phpMyAdmin to set up database.
4. Type http://localhost/phpmyadmin in chrome tab to access website features.
5. Once the user registered, account created time is stored in users table under created_at column.
6. Registered user can login into the website and can logout. Both login and logout times are stored in user_logins table.
7. If the same user logged in again then it is also stored in new row with the same user id in user_logins table.
8. Time is stored based on IST. India Standard Time (IST) is 5:30 hours ahead of Coordinated Universal Time (UTC).

# Application:
It is helpful to track user activity for implemented website.
