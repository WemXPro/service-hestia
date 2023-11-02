# Hestia
Full hestia integration with WemX

Hestia Control Panel is designed to provide administrators an easy to use web and command line interface, enabling them to quickly deploy and manage web domains, mail accounts, DNS zones, and databases from one central dashboard without the hassle of manually deploying and configuring individual components or services. 
https://hestiacp.com/

# Install HestiaCP

***Hestia needs to be installed on a SEPARATE and NEW VPS/Machine***
https://hestiacp.com/install.html

# Installation
1. Download this Github repository as a zip file
2. Locate folder `/var/www/wemx/app/Services` and create a new Folder called `Hestia`
3. Open the zip hestia zip file, then open `service-hestia-main` and upload all the Hestia files to the newly created `/var/www/wemx/app/Services/Hestia` folder
4. Make sure to install the hestia dependencies using command `cd /var/www/wemx && php artisan module:update`
   

![image](https://github.com/WemXPro/service-hestia/assets/58806240/925e81e5-bd37-4f78-9086-ed66d8cc7b02)

![image](https://github.com/WemXPro/service-hestia/assets/58806240/d073e57b-02b6-43b8-8d15-2f1db1bae480)
