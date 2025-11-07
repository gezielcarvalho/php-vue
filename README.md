# PHP-Vue MVC Framework

A lightweight MVC framework built with PHP 8.1+ and Vue.js 3, designed for rapid web application development with modern frontend capabilities.

## Features

- **Custom MVC Architecture**: Clean separation of concerns with Controllers, Models, and Views
- **Vue.js 3 Integration**: Modern reactive frontend framework with CDN integration
- **Custom Router**: Flexible URL routing with parameter support
- **Environment Configuration**: `.env` file support for configuration management
- **Database Integration**: PDO-based database abstraction layer
- **Template System**: Support for multiple template engines (Bootstrap/Vue)
- **Error Handling**: Comprehensive error and exception handling
- **Auto-loading**: PSR-4 compatible class auto-loading

## Project Structure

```
php-vue/
├── App/
│   ├── Controllers/        # Application controllers
│   │   └── HomeController.php
│   ├── Models/            # Data models
│   │   ├── User.php
│   │   └── sample_db.sql
│   └── Views/             # View templates
│       └── Home/
│           └── index.php
├── Core/                  # Framework core classes
│   ├── Config.php         # Environment configuration loader
│   ├── Controller.php     # Base controller class
│   ├── Error.php          # Error handling
│   ├── Model.php          # Base model class
│   ├── Router.php         # URL routing system
│   └── View.php           # View rendering engine
├── public/                # Web server document root
│   ├── index.php          # Application entry point
│   ├── .htaccess          # Apache rewrite rules
│   ├── .env.example       # Environment configuration template
│   └── assets/            # Static assets (CSS, JS, images)
└── templates/             # Template layouts
    ├── Bootstrap/         # Bootstrap-based templates
    └── Vue/               # Vue.js-based templates
```

## Getting Started

### Prerequisites

- **PHP 8.1+** with the following extensions:
  - PDO
  - PDO MySQL (if using MySQL database)
- **Apache/Nginx** web server
- **MySQL/MariaDB** (optional, for database features)
- **Composer** (optional, for dependency management)

### Installation

1. **Clone the repository**

   ```bash
   git clone <repository-url> php-vue
   cd php-vue
   ```

2. **Configure your web server**

   **Apache**: Point your document root to the `public/` directory. The included `.htaccess` file will handle URL rewriting.

   **Nginx**: Add this configuration to your server block:

   ```nginx
   location / {
       try_files $uri $uri/ /index.php?$query_string;
   }
   ```

3. **Set up environment configuration**

   ```bash
   cp public/.env.example public/.env
   ```

   Edit `public/.env` with your configuration:

   ```bash
   APP_ENV=dev
   DATABASE_NAME=your_database_name
   DATABASE_HOST=localhost
   DATABASE_USER=your_username
   DATABASE_PASSWORD=your_password
   ```

4. **Database Setup** (Optional)

   If you're using database features:

   - Create a MySQL database
   - Import `App/Models/sample_db.sql` if available
   - Update the database credentials in your `.env` file

5. **Access your application**

   Open your browser and navigate to your configured domain/localhost.

### Development Server (PHP Built-in)

For quick development, you can use PHP's built-in server:

```bash
cd public
php -S localhost:8000
```

Then visit `http://localhost:8000` in your browser.

## Usage

### Creating Controllers

Controllers should extend the `Core\Controller` class and be placed in `App/Controllers/`:

```php
<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class YourController extends Controller
{
    public function index()
    {
        $data = ['message' => 'Hello World'];
        View::render('YourView/index.php', $data);
    }
}
```

### Adding Routes

Routes are defined in `public/index.php`:

```php
$router->add('/your-route', [
    'controller' => 'App\Controllers\YourController',
    'action' => 'index',
    'request' => 'GET'
]);
```

### Creating Models

Models should extend `Core\Model` and be placed in `App/Models/`:

```php
<?php

namespace App\Models;

use Core\Model;
use PDO;

class YourModel extends Model
{
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM your_table');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
```

### Creating Views

Views are PHP files placed in `App/Views/` and can include Vue.js components:

```php
<div id="app">
    <h1>{{ message }}</h1>
    <button @click="updateMessage">Click me!</button>
</div>

<script>
const { createApp } = Vue;

createApp({
    data() {
        return {
            message: '<?= $data['message'] ?? 'Default message' ?>'
        }
    },
    methods: {
        updateMessage() {
            this.message = 'Message updated!';
        }
    }
}).mount('#app');
</script>
```

### Template System

The framework supports multiple template systems. You can switch between them in `Core/View.php`:

```php
$template = "Vue"; // or "Bootstrap"
```

## Architecture

### Router

- Custom routing system that parses URLs and dispatches to appropriate controllers
- Supports route parameters and different HTTP methods
- Clean URL structure with `.htaccess` rewrite rules

### MVC Pattern

- **Models**: Handle data logic and database interactions
- **Views**: Presentation layer with template support
- **Controllers**: Business logic and request handling

### Configuration

- Environment-based configuration using `.env` files
- Secure credential management
- Easy deployment across different environments

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is open source and available under the [MIT License](LICENSE).

## Support

For questions and support, please open an issue in the repository or refer to the documentation in the `devlog.md` file.
