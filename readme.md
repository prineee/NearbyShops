# Nearby Shops
----------
Just a simple implementation of a web app that lists nearby shops.

# Setup instructions
----------
* Open **/config/config.php** file:
    1: Set '$config['base_url']' to the root directory of the project, starting after the '//' and including any subdirectories as required.
    2: Save and close config file.

* Open **/config/database.php** file:
    1: Set "$db['default']" array values: **hostname, port, username, password, database** to your MySQL server settings and project database name.
    2: Save and close config file.

# Platforms and frameworks
----------
* **Frontend**: Bootstrap 4 with jQuery 3
* **Backend**: CodeIgniter 3 on PHP 7
* **Database**: MySQL 5 with InnoDB tables

# Additional components
----------
* **JS-Cookie** library
* **Placeholder** API

# What is implemented
----------
* Signup/login using email and password
* Logout from the logged in user account
* Display nearby shops sorted by Geolocation distance
* Display liked shops in a preferred shops page
* Like a shop (hidden from main/shown in preferred)
* Dislike a shop (hidden for 2 hours)
* Remove a liked from (from preferred page)

# What is left
----------
None in the technical spec.

# Credits
----------
Made by: Achraf Almouloudi