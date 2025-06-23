# API Documentation - Men's Salon Management System

**Developed by Yeabsira, Saliha & Mihret**

## 📋 Overview

This document outlines the API endpoints and database structure for the Men's Salon Management System. While the current system is primarily a web-based PHP application, this documentation serves as a foundation for future API development.

## 🗄️ Database Schema

### Core Tables

#### tbladmin
```sql
-- Admin user management
ID (int, primary key, auto_increment)
AdminName (varchar 50) - Full name of admin
UserName (varchar 50) - Login username  
MobileNumber (bigint 10) - Contact number
Email (varchar 200) - Email address
Password (varchar 200) - Hashed password
AdminRegdate (timestamp) - Registration date
```

#### tblcustomers
```sql
-- Customer information
ID (int, primary key, auto_increment)
Name (varchar 120) - Customer full name
Email (varchar 200) - Customer email
MobileNumber (bigint 11) - Phone number
Gender (enum: 'Female','Male','Transgender')
Details (mediumtext) - Additional customer notes
CreationDate (timestamp) - Record creation date
UpdationDate (timestamp) - Last update date
```

#### tblappointment
```sql
-- Appointment bookings
ID (int, primary key, auto_increment)
AptNumber (varchar 80) - Unique appointment number
Name (varchar 120) - Customer name
Email (varchar 120) - Customer email
PhoneNumber (bigint 11) - Contact number
AptDate (varchar 120) - Appointment date
AptTime (varchar 120) - Appointment time
Services (varchar 120) - Requested services
ApplyDate (timestamp) - Booking creation date
Remark (varchar 250) - Admin remarks
Status (varchar 50) - Appointment status
RemarkDate (timestamp) - Status update date
```

#### tblservices
```sql
-- Available salon services
ID (int, primary key, auto_increment)
ServiceName (varchar 200) - Service name
Description (mediumtext) - Service description
Cost (int 10) - Service price
CreationDate (timestamp) - Service creation date
```

#### tblinvoice
```sql
-- Billing and invoicing
id (int, primary key, auto_increment)
Userid (int) - Customer ID reference
ServiceId (int) - Service ID reference
BillingId (int) - Unique billing identifier
PostingDate (timestamp) - Invoice creation date
```

## 🔗 Potential API Endpoints

### Authentication Endpoints

#### POST /api/auth/login
```json
{
  "username": "admin",
  "password": "password"
}
```

**Response:**
```json
{
  "status": "success",
  "token": "jwt_token_here",
  "user": {
    "id": 1,
    "name": "Development Team",
    "email": "team@salonsystem.com"
  }
}
```

### Customer Management

#### GET /api/customers
**Purpose:** Retrieve all customers
**Parameters:** 
- `page` (optional): Page number
- `limit` (optional): Records per page
- `search` (optional): Search term

**Response:**
```json
{
  "status": "success",
  "data": [
    {
      "id": 2,
      "name": "Yeabsira",
      "email": "yeabsira@email.com",
      "mobile": "1234567890",
      "gender": "Male",
      "details": "Lead Developer - System Testing",
      "created": "2024-01-01 11:10:02"
    }
  ],
  "pagination": {
    "current_page": 1,
    "total_pages": 10,
    "total_records": 100
  }
}
```

#### POST /api/customers
**Purpose:** Create new customer
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "mobile": "1234567890",
  "gender": "Male",
  "details": "Regular customer"
}
```

#### PUT /api/customers/{id}
**Purpose:** Update customer information

#### DELETE /api/customers/{id}
**Purpose:** Delete customer record

### Appointment Management

#### GET /api/appointments
**Purpose:** Retrieve appointments
**Parameters:**
- `status` (optional): Filter by status
- `date` (optional): Filter by date
- `customer_id` (optional): Filter by customer

#### POST /api/appointments
**Purpose:** Create new appointment
```json
{
  "customer_name": "John Doe",
  "email": "john@example.com",
  "phone": "1234567890",
  "date": "2024-02-15",
  "time": "10:00 AM",
  "services": "Hair Cut, Beard Trim"
}
```

#### PUT /api/appointments/{id}/status
**Purpose:** Update appointment status
```json
{
  "status": "Accepted",
  "remark": "Confirmed for 10:00 AM"
}
```

### Service Management

#### GET /api/services
**Purpose:** Retrieve all services
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "name": "O3 Facial",
      "description": "Activated charcoal facial treatment",
      "cost": 120,
      "created": "2023-12-05 11:22:38"
    }
  ]
}
```

#### POST /api/services
**Purpose:** Create new service

#### PUT /api/services/{id}
**Purpose:** Update service information

### Invoice Management

#### GET /api/invoices
**Purpose:** Retrieve invoices

#### POST /api/invoices
**Purpose:** Generate new invoice
```json
{
  "customer_id": 2,
  "services": [
    {
      "service_id": 1,
      "quantity": 1
    }
  ]
}
```

### Reports & Analytics

#### GET /api/reports/sales
**Purpose:** Sales report
**Parameters:**
- `start_date`: Report start date
- `end_date`: Report end date
- `format`: Response format (json, csv)

#### GET /api/reports/customers
**Purpose:** Customer analytics

#### GET /api/reports/appointments
**Purpose:** Appointment statistics

## 🔐 Authentication & Security

### JWT Token Structure
```json
{
  "header": {
    "alg": "HS256",
    "typ": "JWT"
  },
  "payload": {
    "user_id": 1,
    "username": "admin",
    "role": "admin",
    "exp": 1640995200
  }
}
```

### Security Headers
- `Authorization: Bearer {jwt_token}`
- `Content-Type: application/json`
- `X-API-Key: your_api_key` (if applicable)

## 📱 Mobile App Integration

### Booking Flow
1. **GET /api/services** - Load available services
2. **POST /api/appointments** - Submit booking
3. **GET /api/appointments/{id}** - Check booking status

### Customer App Features
- View service catalog
- Book appointments
- Check appointment history
- Update profile
- Receive notifications

### Admin App Features
- Manage appointments
- Customer management
- Service management
- Generate reports
- Send notifications

## 🔄 Webhook Integration

### Appointment Status Updates
```json
{
  "event": "appointment.status_changed",
  "data": {
    "appointment_id": 123,
    "customer_email": "customer@example.com",
    "old_status": "Pending",
    "new_status": "Accepted",
    "timestamp": "2024-01-15T10:00:00Z"
  }
}
```

## 📊 Rate Limiting

- **General API**: 100 requests per hour per IP
- **Authentication**: 10 attempts per 15 minutes per IP
- **Booking**: 5 bookings per hour per customer

## 🧪 Testing

### Sample API Test (PHP)
```php
<?php
/*
 * API Test Example
 * By Yeabsira, Saliha & Mihret
 */

$api_url = 'https://your-domain.com/api';
$token = 'your_jwt_token';

// Test customer creation
$data = [
    'name' => 'Test Customer',
    'email' => 'test@example.com',
    'mobile' => '1234567890',
    'gender' => 'Male'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url . '/customers');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $token
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>
```

## 📝 Future API Development

### Planned Features
- RESTful API implementation
- GraphQL endpoint
- Real-time WebSocket connections
- Third-party integrations (SMS, Email)
- Payment gateway integration
- Calendar sync (Google, Outlook)

### Development Roadmap
1. **Phase 1**: Basic CRUD API endpoints
2. **Phase 2**: Authentication & authorization
3. **Phase 3**: Real-time features
4. **Phase 4**: Mobile app support
5. **Phase 5**: Third-party integrations

## 📞 Developer Contact

For API development questions or contributions:

- **Yeabsira** (Lead Developer): API architecture & database design
- **Saliha** (Frontend Developer): Frontend API integration
- **Mihret** (Backend Developer): API security & performance

**Team Email:** team@salonsystem.com
**Repository:** https://github.com/yeabkal1001/Men-Salon-Management-System-Project-PHP

---

*API Documentation maintained by Yeabsira, Saliha & Mihret*
*Version 1.0 - Last updated: January 2024*