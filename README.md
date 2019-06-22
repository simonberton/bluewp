# Blue wp

## Installation

Worked locally with this Docker Image:
https://github.com/simonberton/wpdockernginx

Steps:
Go to downloaded docker image folder and run:
```
 docker-compose up --build -d
 docker exec -it mysql bash
 mysql -u root -p
 password
 CREATE DATABASE bluewp;
 GRANT ALL ON bluewp.* TO 'root'@'%';
 FLUSH PRIVILEGES
```

###Copy bluewp.sql from local to docker
On root directory

```
docker cp bluewp.sql mysql:/bluewp.sql
docker exec -it mysql bash
mysql -uroot -ppassword bluewp < bluewp.sql
```

Test: localhost and verify site is working properly.

Copy wp-config.php on root dir and check database connection is properly set.

Users list for facebook login is located under the theme:

themes/airi-child/users.json

## Testimonials

Located under /testimonials/ uri

http://localhost/testimonials/

Lists all published testimonials.

To edit and publish a drafted one visit:

http://localhost/wp-admin/edit.php?post_type=testimonial

Edit the desired one and change its status tu "Published".


## Facebook Login

Using Facebook SDK.

Key is stored in 
- themes/airi-child/callback.php
- themes/airi-child/login.php

We request the users email, make a new user if user email is present in the users.json file.

It's a json file, so follow the same logic when editing it.

Test Case:

Remove all users from json.
Register with personal facebook with simonberton@gmail.com accounnt.
Grant permissions
Create Contributor user with my email.
Log user in with such permission.

Remove simonberton@gmail.com user from Wordpress.
Add simonberton@gmail.com to users.jso.
Register with personal facebook with simonberton@gmail.com accounnt.
Grant permissions, already granted from before.
Create Administrator user with my email.
Log user in with such permission.

## OLD Wordpress Login

Made a copy wp-login.php to wp-login-old.php just in case you need the old functionality without the need to edit the functions.php and remove the logic:

```
add_action('init','custom_login');
function custom_login(){
    global $pagenow;
    if( 'wp-login.php' == $pagenow ) {
        wp_redirect('/login');
        exit();
    }
}
```
