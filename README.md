# Men's Salon Management System

A comprehensive web-based management system designed specifically for men's salons and barbershops. This system streamlines salon operations, customer management, appointment scheduling, and service billing.

## 👥 Development Team

This project was developed by:
- **Yeabsira** - Lead Developer & Database Designer
- **Saliha** - Frontend Developer & UI/UX Designer  
- **Mihret** - Backend Developer & System Architect

## 🚀 Features

### Customer Management
- Add, edit, and delete customer profiles
- Track customer history and preferences
- Maintain detailed customer records with contact information
- Gender-based service customization

### Appointment Management
- Online appointment booking system
- Appointment status tracking (Pending, Accepted, Rejected)
- Date and time slot management
- Service selection during booking
- Email notifications for appointments

### Service Management
- Add, edit, and delete salon services
- Pricing management for different services
- Service categories (Facial, Hair Cut, Beard Trim, etc.)
- Detailed service descriptions

### Billing & Invoicing
- Generate invoices for completed services
- Track payment history
- Billing reports and analytics
- Service-wise revenue tracking

### Admin Dashboard
- Comprehensive admin panel
- Sales reports and analytics
- Customer analytics
- Appointment management
- Service management interface

### Reports & Analytics
- Daily, weekly, monthly sales reports
- Customer visit frequency analysis
- Popular services tracking
- Revenue analytics with date range filters

## 🛠️ Technology Stack

- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 4
- **Backend**: PHP 7.4+
- **Database**: MySQL/MariaDB
- **Server**: Apache/Nginx
- **Additional**: jQuery, Font Awesome

## 📋 System Requirements

- **Web Server**: Apache 2.4+ or Nginx 1.18+
- **PHP**: Version 7.4 or higher
- **Database**: MySQL 5.7+ or MariaDB 10.3+
- **Browser**: Modern web browsers (Chrome, Firefox, Safari, Edge)

## 🔧 Installation Guide

### Step 1: Download and Setup
```bash
# Clone the repository
git clone https://github.com/yeabkal1001/Men-Salon-Management-System-Project-PHP.git

# Navigate to project directory
cd Men-Salon-Management-System-Project-PHP
```

### Step 2: Database Setup
1. Start your MySQL/MariaDB server
2. Create a new database:
```sql
CREATE DATABASE msmsdb;
```
3. Import the database structure:
```bash
# Using command line
mysql -u your_username -p msmsdb < "SQL File/msmsdb.sql"

# Or using phpMyAdmin
# - Open phpMyAdmin
# - Select msmsdb database
# - Go to Import tab
# - Choose "SQL File/msmsdb.sql"
# - Click Go
```

### Step 3: Configuration
1. Navigate to `msms/includes/dbconnection.php`
2. Update database credentials:
```php
<?php
$con = mysqli_connect("localhost", "your_username", "your_password", "msmsdb");
if(mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
```

### Step 4: Web Server Setup

#### For XAMPP/WAMP/LAMP:
1. Copy the project folder to your web server directory:
   - **XAMPP**: `C:\xampp\htdocs\` (Windows) or `/opt/lampp/htdocs/` (Linux)
   - **WAMP**: `C:\wamp\www\`
   - **LAMP**: `/var/www/html/`

2. Start Apache and MySQL services

3. Access the application:
   - **Frontend**: `http://localhost/Men-Salon-Management-System-Project-PHP/msms/`
   - **Admin Panel**: `http://localhost/Men-Salon-Management-System-Project-PHP/msms/admin/`

#### For Production Server:
1. Upload files via FTP/cPanel
2. Configure virtual host (if needed)
3. Set proper file permissions:
```bash
chmod 755 -R /path/to/project/
chmod 644 -R /path/to/project/msms/
```

## 🔐 Default Login Credentials

### Admin Panel Access
- **URL**: `http://your-domain/msms/admin/`
- **Username**: `admin`
- **Password**: `Test@123`

> **Important**: Change default password after first login!

## 📱 How to Use

### For Customers:
1. **Browse Services**: Visit the homepage to view available services
2. **Book Appointment**: Click "Make an Appointment" and fill the form
3. **Contact**: Use the contact page for inquiries

### For Admin:
1. **Login**: Access admin panel with credentials
2. **Dashboard**: View overview of appointments, customers, and sales
3. **Manage Appointments**: Accept/reject appointments, view details
4. **Customer Management**: Add customers, view history
5. **Service Management**: Add/edit salon services and pricing
6. **Reports**: Generate sales reports and analytics
7. **Profile**: Update admin profile and change password

## 📊 Database Structure

### Main Tables:
- **tbladmin**: Admin user credentials and profile
- **tblappointment**: Customer appointments and booking details
- **tblcustomers**: Customer profiles and information
- **tblservices**: Salon services and pricing
- **tblinvoice**: Billing and invoice records
- **tblpage**: CMS pages (About Us, Contact)
- **tblsubscriber**: Newsletter subscribers

## 🎨 Customization

### Branding:
- Update logo in `msms/images/`
- Modify color scheme in `msms/css/style.css`
- Update business information in admin panel

### Services:
- Add new services through admin panel
- Update pricing as needed
- Add service images and descriptions

### Content:
- Update About Us page through admin panel
- Modify contact information
- Customize homepage content

## 🔒 Security Features

- SQL injection prevention using prepared statements
- XSS protection with input sanitization
- Session management for admin authentication
- Password hashing for secure storage
- CSRF protection on forms

## 🐛 Troubleshooting

### Common Issues:

**Database Connection Error:**
- Check database credentials in `dbconnection.php`
- Ensure MySQL service is running
- Verify database name exists

**Permission Denied:**
- Set proper file permissions (755 for directories, 644 for files)
- Check web server user ownership

**Admin Login Not Working:**
- Verify credentials in database
- Check session configuration in PHP
- Clear browser cache and cookies

**Appointment Form Not Submitting:**
- Check JavaScript console for errors
- Verify form action URLs
- Ensure all required fields are filled

## 📞 Support & Contact

For technical support or inquiries about this project:

- **Yeabsira**: Lead Developer - [yeabsira@email.com]
- **Saliha**: Frontend Developer - [saliha@email.com]
- **Mihret**: Backend Developer - [mihret@email.com]

## 🤝 Contributing

We welcome contributions to improve this project:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

## 🙏 Acknowledgments

- Bootstrap team for the responsive framework
- Font Awesome for the icon library
- jQuery team for the JavaScript library
- PHP community for excellent documentation

## 📈 Future Enhancements

- Mobile app development
- SMS notifications
- Online payment integration
- Multi-location support
- Advanced reporting dashboard
- Customer loyalty program
- Social media integration

---

**Developed with ❤️ by Yeabsira, Saliha & Mihret**

*Making salon management simple and efficient!*