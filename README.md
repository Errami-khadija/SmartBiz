# SmartBiz

SmartBiz is a **small business management system** built with **Laravel**.  
It acts as a lightweight ERP to help freelancers (developers, editers, designers ) manage their daily operations efficiently.

---

## Features

- User authentication (login & registration)
- Admin dashboard
- Clients management
- Services management
- Orders & payments tracking
- Expenses tracking
- Modular & scalable Laravel architecture

> Note: SmartBiz is currently under active development.

---

## Technologies Used

- **Laravel 12**
- PHP 8+
- MySQL
- Blade templating engine
- Tailwind CSS
- Composer & NPM
- MVC architecture

---

## Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL 

---

## Installation

Follow these steps to run SmartBiz locally:

### 1. Clone the repository
```bash
git clone https://github.com/Errami-khadija/SmartBiz.git
cd SmartBiz 
```

### 2. Install dependencies
```bash
composer install
npm install
npm run build
```
### 3. Environment setup
```bash
cp .env.example .env
```

Edit .env and add your database credentials.

### 4. Generate app key
```bash
php artisan key:generate
```

### 5. Run migrations
```bash
php artisan migrate
```

### 6. Start the development server
```bash
php artisan serve
```

## Author

Khadija Errami
- Laravel Developer

## License

This project is open-source and available under the MIT License.

## Thanks

Thanks for checking out SmartBiz! If you find this project useful, feel free to ⭐ star the repo and share your feedback 