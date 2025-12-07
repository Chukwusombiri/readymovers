# ReadyMovers - Moving Service Management System
A full-stack, modern web application for moving company management, built with React.js (Inertia.js) + Laravel, containerized with Docker for seamless deployment and scalability.


**🚀 Live Demo**
- Check out the live application: https://readymovers.onrender.com

## 🏗️ Tech Stack
- Backend: Laravel 10+ (PHP 8.2) / Laravel livewire

- Frontend: React 18 + Inertia.js, TailwindCSS, Alpine.js

- Database: MySQL

- Container: Docker & Docker Compose

- Payment: Stripe Integration

- Authentication: Laravel Fortify

- Third-Party API: Mapbox (Mapping features)


## 📋 Prerequisites
- Docker (v20.10+)

- Docker Compose (v2.0+)

- Git

## 🚀 Quick Start Guide
1. Clone the Repository
```bash
git clone <repository-url>
cd readymovers
```
2. Configure Environment Variables
Copy the example environment file:

```bash
cp .env.example .env
```

Edit the .env file and set your configuration values. Important keys to configure:

```bash
# App Configuration
APP_NAME="ReadyMovers"
APP_ENV=local
APP_KEY=
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=pgsql  # or mysql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=readymovers
DB_USERNAME=readymovers_user
DB_PASSWORD=your_secure_password

# Stripe Configuration
STRIPE_KEY=pk_test_your_stripe_public_key
STRIPE_SECRET=sk_test_your_stripe_secret_key
STRIPE_WEBHOOK_SECRET=whsec_your_webhook_secret

# Mail Configuration (for production)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
```
3. Start the Application
- Option A: Default Setup (Recommended)
If you're using the provided Docker configuration, simply run:

```bash
docker compose up -d
```
- Option B: Custom Docker Setup
If you're experienced with Docker, you can customize the docker-compose.yml file to suit your needs (change ports, volumes, services, etc.).

4. Application Setup
- Step 1: Generate Application Key
Once the containers are running, generate the Laravel application key:

```bash
docker compose exec app php artisan key:generate
```
- Step 2: Run Database Migrations & Seeding
Important: The database might take a moment to initialize. If the first attempt fails, wait 30 seconds and try again.

```bash
# This might fail on first try - wait for DB to be ready
docker compose exec app php artisan migrate --seed --force

# If failed, wait and retry:
sleep 30 && docker-compose exec app php artisan migrate --seed --force
```

5. Access the Application
Main Application: http://localhost:80

Admin Dashboard: http://localhost:80/admin

### 🔐 Default Admin Credentials
After seeding the database, you can access the admin panel with:

Email: developer@readymovers.com

Password: Pa$$w0rd!

Note: These credentials are seeded by the AdminFactory. You can change them in the Laravel database seeder files if needed.


## 📱 Application Features
### 👤 For Visitors (Public Features)
**Move Request Form:** Complete moving job booking with detailed information

**Instant Quote Calculator:** Get moving cost estimates based on items and distance

- **Payment Options:**

**Stripe Integration:** Secure online payment processing

**WhatsApp Discussion:** Option to continue quote discussions via WhatsApp

**Order Tracking:** Track moving job status with reference number

**Contact Form:** Direct communication with the moving company

### 👑 For Admin (Management Features)
**Secure Authentication:** Admin-only access with Laravel Fortify

**Dashboard:** Overview of all moving requests and statistics

**Order Management:**

- View all moving job requests with full details

- Update order status (Pending → Approved → Dispatched → Delivered)

- Manage payment status (Paid/Unpaid/Refunded)

- Edit customer and order details

- Client Management:

- View customer contact information

- Track booking history

- Manage communication logs

**Financial Overview:**

- View payment transactions

- Track outstanding balances

- Generate financial reports

## 🐳 Docker Services
The application consists of the following services:

app: Laravel + React application (PHP 8.2 + Node.js)

db: MySQL

nginx: Web server

### Port Mappings
**Application:** 8000:80

**Database:** 3307:3306 (MySQL)

### 🛠️ Development Commands
Inside Docker Container
```bash
# Access app container shell
docker compose exec app bash

# Run Laravel commands
docker compose exec app php artisan [command]

# Run npm commands
docker compose exec app npm [command]

# View logs
docker compose logs -f app
```

Common Artisan Commands
```bash
# Run migrations
docker compose exec app php artisan migrate

# Clear cache
docker compose exec app php artisan cache:clear
docker compose exec app php artisan config:clear
docker compose exec app php artisan view:clear

# Generate storage link
docker-compose exec app php artisan storage:link

# Run tests
docker-compose exec app php artisan test
```

## 🌐 Production Deployment
The live demo is deployed on Render.com using Docker. For production deployment:

Set APP_ENV=production in .env

Configure secure database credentials

Set up SSL certificates

Configure proper mail settings

Update Stripe keys to production credentials

## 🔧 Troubleshooting
### Common Issues
- *Database Connection Failed*

Wait 30 seconds for DB to initialize, then retry migrations

### Permission Issues

```bash
# Fix storage permissions
docker compose exec app chmod -R 775 storage bootstrap/cache
```

### Application Key Error

```bash
# Regenerate application key
docker compose exec app php artisan key:generate
```

### Port Already in Use

```bash
# Stop existing services
docker compose down

# Change ports in docker-compose.yml
ports:
  - "8080:80"  # Change 8000 to another port
```

## View Logs
```bash
# Application logs
docker compose logs app

# Database logs
docker compose logs db

# All logs with follow mode
docker compose logs -f
```

## 📁 Project Structure
```text
readymovers/
├── app/                 # Laravel application
│   ├── Http/
│   ├── Models/
│   └── Providers/
├── resources/
│   └── js/             # React components (Inertia.js)
│       ├── Components/
│       ├── Layouts/
│       └── Pages/
├── docker/             # Docker configuration
├── docker-compose.yml  # Multi-container setup
├── .env.example        # Environment template
└── README.md          # This file
```

## 🔐 Security Notes
- Change default admin credentials in production

- Use strong database passwords

- Configure HTTPS in production

- Regularly update dependencies

- Monitor application logs

## 🤝 Contributing
- Fork the repository

- Create a feature branch

- Commit your changes

- Push to the branch

- Open a Pull Request


## 📄 License
This project is proprietary software. All rights reserved.


## 🆘 Support
For issues with setup or application functionality:

Check the troubleshooting section

Review Docker logs

Ensure all environment variables are set

Verify database connection

***ReadyMovers - Streamlining moving services management since 2024.***

*Built with Laravel, Inertia.js, React, and Docker*

