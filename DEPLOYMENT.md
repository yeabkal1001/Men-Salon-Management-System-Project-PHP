# Deployment Guide - Men's Salon Management System

**Developed by Yeabsira, Saliha & Mihret**

This comprehensive guide will help you deploy the Men's Salon Management System on various hosting platforms.

## 📋 Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or MariaDB 10.3+
- Web server (Apache/Nginx)
- Git (for version control)

## 🚀 Quick Start Deployment

### Method 1: Using Our Installation Script

1. **Download the project:**
   ```bash
   git clone https://github.com/yeabkal1001/Men-Salon-Management-System-Project-PHP.git
   cd Men-Salon-Management-System-Project-PHP
   ```

2. **Run the installation script:**
   - Navigate to `http://your-domain/install.php`
   - Fill in your database credentials
   - Follow the on-screen instructions

3. **Import database:**
   ```bash
   mysql -u username -p database_name < "SQL File/msmsdb.sql"
   ```

### Method 2: Manual Installation

1. **Setup Database:**
   ```sql
   CREATE DATABASE msmsdb;
   USE msmsdb;
   SOURCE /path/to/SQL File/msmsdb.sql;
   ```

2. **Configure Database Connection:**
   Edit `msms/includes/dbconnection.php`:
   ```php
   <?php
   $con = mysqli_connect("localhost", "username", "password", "msmsdb");
   if(mysqli_connect_errno()) {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
   ?>
   ```

## 🖥️ Server-Specific Deployment

### XAMPP (Local Development)

1. **Install XAMPP:**
   - Download from https://www.apachefriends.org/
   - Install and start Apache and MySQL

2. **Deploy Project:**
   ```bash
   # Copy project to XAMPP htdocs
   cp -r Men-Salon-Management-System-Project-PHP C:/xampp/htdocs/
   
   # Or create symbolic link
   ln -s /path/to/project C:/xampp/htdocs/salon-system
   ```

3. **Access Application:**
   - Frontend: `http://localhost/Men-Salon-Management-System-Project-PHP/msms/`
   - Admin: `http://localhost/Men-Salon-Management-System-Project-PHP/msms/admin/`

### Shared Hosting (cPanel)

1. **Upload Files:**
   - Compress project folder
   - Upload via File Manager or FTP
   - Extract in public_html directory

2. **Create Database:**
   - Use cPanel MySQL Database Wizard
   - Import SQL file via phpMyAdmin

3. **Configure:**
   - Update database credentials in `dbconnection.php`
   - Set proper file permissions (755 for directories, 644 for files)

### VPS/Dedicated Server (Ubuntu/CentOS)

1. **Install LAMP Stack:**
   ```bash
   # Ubuntu
   sudo apt update
   sudo apt install apache2 mysql-server php php-mysql
   
   # CentOS
   sudo yum install httpd mysql-server php php-mysql
   ```

2. **Deploy Project:**
   ```bash
   # Clone repository
   cd /var/www/html
   git clone https://github.com/yeabkal1001/Men-Salon-Management-System-Project-PHP.git
   
   # Set permissions
   chown -R www-data:www-data Men-Salon-Management-System-Project-PHP
   chmod -R 755 Men-Salon-Management-System-Project-PHP
   ```

3. **Configure Virtual Host:**
   ```apache
   <VirtualHost *:80>
       ServerName your-domain.com
       DocumentRoot /var/www/html/Men-Salon-Management-System-Project-PHP/msms
       <Directory /var/www/html/Men-Salon-Management-System-Project-PHP/msms>
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```

### Docker Deployment

1. **Create Dockerfile:**
   ```dockerfile
   FROM php:7.4-apache
   
   # Install MySQL extension
   RUN docker-php-ext-install mysqli
   
   # Copy project files
   COPY . /var/www/html/
   
   # Set permissions
   RUN chown -R www-data:www-data /var/www/html
   RUN chmod -R 755 /var/www/html
   
   EXPOSE 80
   ```

2. **Create docker-compose.yaml:**
   ```yaml
   version: '3.8'
   services:
     web:
       build: .
       ports:
         - "8080:80"
       depends_on:
         - db
       volumes:
         - .:/var/www/html
     
     db:
       image: mysql:8.0
       environment:
         MYSQL_ROOT_PASSWORD: password
         MYSQL_DATABASE: msmsdb
       ports:
         - "3306:3306"
       volumes:
         - mysql_data:/var/lib/mysql
   
   volumes:
     mysql_data:
   ```

3. **Deploy:**
   ```bash
   docker-compose up -d
   ```

## 🌐 Cloud Platform Deployment

### AWS EC2

1. **Launch EC2 Instance:**
   - Choose Amazon Linux 2 AMI
   - Configure security groups (HTTP, HTTPS, SSH)

2. **Install Dependencies:**
   ```bash
   sudo yum update -y
   sudo yum install -y httpd php php-mysqlnd mysql-server
   sudo systemctl start httpd
   sudo systemctl enable httpd
   ```

3. **Deploy Application:**
   ```bash
   cd /var/www/html
   sudo git clone https://github.com/yeabkal1001/Men-Salon-Management-System-Project-PHP.git
   sudo chown -R apache:apache Men-Salon-Management-System-Project-PHP
   ```

### Heroku

1. **Prepare for Heroku:**
   ```bash
   # Create Procfile
   echo "web: vendor/bin/heroku-php-apache2 msms/" > Procfile
   
   # Create composer.json
   echo '{"require":{"php":"^7.4"}}' > composer.json
   ```

2. **Deploy:**
   ```bash
   heroku create your-app-name
   heroku addons:create cleardb:ignite
   heroku config:get CLEARDB_DATABASE_URL
   git push heroku main
   ```

### DigitalOcean

1. **Create Droplet:**
   - Choose LAMP stack
   - Configure firewall rules

2. **Deploy:**
   ```bash
   cd /var/www/html
   git clone https://github.com/yeabkal1001/Men-Salon-Management-System-Project-PHP.git
   sudo chown -R www-data:www-data Men-Salon-Management-System-Project-PHP
   ```

## 🔧 Post-Deployment Configuration

### Security Settings

1. **File Permissions:**
   ```bash
   find . -type d -exec chmod 755 {} \;
   find . -type f -exec chmod 644 {} \;
   chmod 600 msms/includes/dbconnection.php
   ```

2. **Secure Database:**
   ```bash
   mysql_secure_installation
   ```

3. **SSL Certificate:**
   ```bash
   # Using Let's Encrypt
   sudo certbot --apache -d your-domain.com
   ```

### Performance Optimization

1. **Enable PHP OpCache:**
   ```php
   ; In php.ini
   opcache.enable=1
   opcache.memory_consumption=128
   opcache.max_accelerated_files=10000
   ```

2. **Configure Apache:**
   ```apache
   # Enable compression
   LoadModule deflate_module modules/mod_deflate.so
   
   # Enable caching
   LoadModule expires_module modules/mod_expires.so
   ExpiresActive On
   ExpiresByType text/css "access plus 1 month"
   ExpiresByType application/javascript "access plus 1 month"
   ```

## 📊 Monitoring & Maintenance

### Log Files

- Apache Logs: `/var/log/apache2/`
- PHP Logs: `/var/log/php/`
- MySQL Logs: `/var/log/mysql/`

### Backup Strategy

1. **Database Backup:**
   ```bash
   # Daily backup script
   mysqldump -u username -p msmsdb > backup_$(date +%Y%m%d).sql
   ```

2. **File Backup:**
   ```bash
   tar -czf salon_backup_$(date +%Y%m%d).tar.gz Men-Salon-Management-System-Project-PHP/
   ```

### Updates

```bash
# Pull latest updates
git pull origin main

# Update database if needed
mysql -u username -p msmsdb < migration.sql
```

## 🚨 Troubleshooting

### Common Issues

1. **Database Connection Error:**
   - Check credentials in `dbconnection.php`
   - Ensure MySQL service is running
   - Verify database name exists

2. **Permission Denied:**
   ```bash
   sudo chown -R www-data:www-data project-directory
   sudo chmod -R 755 project-directory
   ```

3. **500 Internal Server Error:**
   - Check Apache error logs
   - Verify PHP syntax
   - Check file permissions

### Contact Support

For deployment issues or questions:
- **Email:** team@salonsystem.com
- **GitHub Issues:** https://github.com/yeabkal1001/Men-Salon-Management-System-Project-PHP/issues

---

**Happy Deploying! 🚀**
*Deployment Guide by Yeabsira, Saliha & Mihret*