    Pathology Lab Reporting System
    ==============================


    What Is This?
    -------------

		This is Pathology Lab Reporting System based on PHP Codeigniter framework.
		you can watch swf files in wink folder.
		
    How To Use (Overview)
    ---------------------
	  	
      Patients:

			1. Patients can view their Reports online and login on "Pathology Reports Result" link in main web page  with their 
			   full name and passcode

			2. After log into system, patients can view, convert to pdf file and send email.
			
			3. Patients will receive SMS or E-Mail or else(if integrated it)  if their login created by Lab Technicians.
			
			4. Reports can be convert to Pdf file.
			
			5. Report's Pdf file  can be send as email by clicking email link.
	 
      Operator Admins: 
	
			1. Lab Technician (Admin) can manage their patiens,operators and their reports online.

			2. Admin can login through "Laboratory Operator" link on main web page with their username and password [ Ex. Username: admin and Password: 123456].
			
			3. Patients section admin can add / update / delete patient information.

			4. Settings/Users section admin can add / update / delete other operators information. 
			
			5. Settings/Test Types section admin can add / update / delete Test Types of Pathology Tests information. 
			
			6. Settings/Lab info section admin can add / update / delete name,address,email...etc of Lab information. 
			
			7. Reports can be add / update / delete 
			
			8. Reports can be send as info to patient by clicking Sent to Patient.
      Operators    : 
	
			1. Lab Technician (Admin) can manage their reports online.

			2. Operator can login through "Laboratory Operator" link on main web page with their username and password.
			
			3. Reports can be add / update / delete 
			
			4. Reports can be send as info to patient by clicking Sent to Patient.
	
	
    Pre-Requirements
	-----------------
	
			1. PHP version 5.6 or newer is recommended.
			   
			2. MySQL (5.1+) via the mysql (deprecated), mysqli and pdo drivers.
			
			3. PHP OpenSSL extension for PHPMailer SSL login.
			
			4. Codeigniter 3.10. 

			5. PDF plugin in browser to view PDF files. 
	
	
    How To Install The application
    ------------------------------

			1. Copy Codeigniter files into web server. 
		
			2. Copy Source files into web server.
			
			3. Enter virtual host settings in Apache config file.
				ex.
				Listen 80
			<VirtualHost *:80>
			    DocumentRoot "[web server Source Directory]/www"
			    Options +FollowSymLinks
			    RewriteEngine On
			    RewriteCond %{REQUEST_FILENAME} !-f
			    RewriteCond %{REQUEST_FILENAME} !-d
 			    RewriteCond %{REQUEST_URI} !^/assets
			    RewriteRule ^(.*)$ /index.php/$1 [L]
			</VirtualHost>

  		        3. Enter Project base application and system path  in index file. (path: .../www/index.php   ex. $application_folder = '/opt/labinfo/application';$system_path='/usr/local/Codeigniter-3/system')
	
			4. Enter MySQL DB database credentials in database config file (path: /application/config/database.php)
			
			5. Import database.sql file in desired database. Ex. mysql -u root <database.sql 
			   Not:Default database name LabReport.
			
			6. Enter Email and lab info  configuration deatail in labsetting confir file (path: /application/config/labsetting.php) also you can change in database settings table.
		
			7. Thats it! you can open  http://localhost/ 
	
	
    Feedback to Improve
	-------------------
	
			1. Patient name is unique and also report name is unique.so you can give add patient name or number as report name.  
			   There is two role as admin,operator for lab operators.
@