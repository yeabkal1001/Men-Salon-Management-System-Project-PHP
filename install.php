<?php
/*
 * Men's Salon Management System - Installation Script
 * Developed by: Yeabsira, Saliha & Mihret
 */

// Installation configuration
$db_host = 'localhost';
$db_name = 'msmsdb';
$db_user = 'root';
$db_pass = '';

echo "<h1>Men's Salon Management System Installation</h1>";
echo "<h3>Developed by Yeabsira, Saliha & Mihret</h3>";
echo "<hr>";

// Check if form is submitted
if ($_POST) {
    $db_host = $_POST['db_host'];
    $db_name = $_POST['db_name'];
    $db_user = $_POST['db_user'];
    $db_pass = $_POST['db_pass'];
    
    // Test database connection
    $connection = @mysqli_connect($db_host, $db_user, $db_pass);
    
    if (!$connection) {
        echo "<div style='color: red;'>❌ Database connection failed: " . mysqli_connect_error() . "</div>";
    } else {
        echo "<div style='color: green;'>✅ Database connection successful!</div>";
        
        // Create database if it doesn't exist
        $create_db = mysqli_query($connection, "CREATE DATABASE IF NOT EXISTS $db_name");
        
        if ($create_db) {
            echo "<div style='color: green;'>✅ Database '$db_name' created successfully!</div>";
            
            // Update dbconnection.php file
            $config_content = "<?php\n";
            $config_content .= "/*\n";
            $config_content .= " * Men's Salon Management System Database Configuration\n";
            $config_content .= " * Developed by: Yeabsira, Saliha & Mihret\n";
            $config_content .= " */\n\n";
            $config_content .= "\$con = mysqli_connect('$db_host', '$db_user', '$db_pass', '$db_name');\n";
            $config_content .= "if(mysqli_connect_errno()) {\n";
            $config_content .= "    echo 'Failed to connect to MySQL: ' . mysqli_connect_error();\n";
            $config_content .= "}\n";
            $config_content .= "?>";
            
            file_put_contents('msms/includes/dbconnection.php', $config_content);
            
            echo "<div style='color: green;'>✅ Database configuration updated!</div>";
            echo "<div style='margin-top: 20px;'>";
            echo "<h3>Next Steps:</h3>";
            echo "<ol>";
            echo "<li>Import the database: <code>mysql -u $db_user -p $db_name < 'SQL File/msmsdb.sql'</code></li>";
            echo "<li>Or use phpMyAdmin to import 'SQL File/msmsdb.sql'</li>";
            echo "<li>Access your application: <a href='msms/'>Frontend</a> | <a href='msms/admin/'>Admin Panel</a></li>";
            echo "<li>Default admin login: username = <strong>admin</strong>, password = <strong>Test@123</strong></li>";
            echo "</ol>";
            echo "</div>";
        } else {
            echo "<div style='color: red;'>❌ Failed to create database: " . mysqli_error($connection) . "</div>";
        }
        
        mysqli_close($connection);
    }
} else {
?>

<!DOCTYPE html>
<html>
<head>
    <title>Men's Salon Management System - Installation</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="password"] { width: 300px; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #007cba; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #005a87; }
        .team-info { background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 30px; }
    </style>
</head>
<body>
    <div class="team-info">
        <h2>👥 Development Team</h2>
        <p><strong>Yeabsira</strong> - Lead Developer & Database Designer</p>
        <p><strong>Saliha</strong> - Frontend Developer & UI/UX Designer</p>
        <p><strong>Mihret</strong> - Backend Developer & System Architect</p>
    </div>

    <h2>Database Configuration</h2>
    <form method="POST">
        <div class="form-group">
            <label for="db_host">Database Host:</label>
            <input type="text" id="db_host" name="db_host" value="localhost" required>
        </div>
        
        <div class="form-group">
            <label for="db_name">Database Name:</label>
            <input type="text" id="db_name" name="db_name" value="msmsdb" required>
        </div>
        
        <div class="form-group">
            <label for="db_user">Database Username:</label>
            <input type="text" id="db_user" name="db_user" value="root" required>
        </div>
        
        <div class="form-group">
            <label for="db_pass">Database Password:</label>
            <input type="password" id="db_pass" name="db_pass" value="">
        </div>
        
        <button type="submit">Install System</button>
    </form>
</body>
</html>

<?php
}
?>