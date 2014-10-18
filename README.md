Video_Site
==========
Apache Virtual Host Config:
=================================================================
<Directory "F:\GitHub\Video_Site\public"> 
 Options Indexes FollowSymLinks Includes ExecCGI
 AllowOverride All
 Order allow,deny
 Allow from all
</Directory>
<VirtualHost *:80>
 ServerName fduvideo.net
 DocumentRoot "F:\GitHub\Video_Site\public"
</VirtualHost>
=================================================================