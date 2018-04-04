# StudentScreenViewer

Copy the client files to a web server and edit ldap.php and screens.php to change the $ldap_host, $ldap_user and $ldap_pass to reflect your environment. There is also a $filter array in ldap.php which keeps certain OUs from displaying or being processed.

Copy the server files to a network share along with the windows php files and edit the server.bat file to reflect their locations.  The vcrun140.dll file needs to be with PHP if all your systems do not have the visual c runtime installed.

Add a GPO to have the server.bat run as a logon script.

Access the client from a web browser and as the student machines are logged on then you should be able to view their screens with a 5 second refresh rate.  If you click on a screen then you see an enlarged view and you can see the username, date, time, hostname and IP displayed in the top left corner.
