# CodeIgniter 3 Web Developer Training Manual

Date: February 10, 2026

## Purpose
This manual is a foundational guide for OJT/trainee web developers using this CodeIgniter 3 (CI3) project. It introduces CI3, its MVC architecture, and the baseline workflow used in our company. It also defines the hands-on project tasks trainees must complete.

## Training Outcomes
By the end of this training, trainees should be able to:
- Explain what CodeIgniter 3 is and how it works.
- Navigate a CI3 project structure confidently.
- Build pages using the MVC pattern.
- Implement routing, controllers, models, and views.
- Use Bootstrap 5 for layout and components.
- Use JavaScript and AJAX for client-server interactions.
- Build a complete CRUD module and authentication flow.

## What is CodeIgniter 3?
CodeIgniter 3 is a lightweight PHP framework that helps build web applications faster with:
- MVC architecture
- Simple, clean APIs
- Minimal configuration
- Built-in helpers, libraries, and security features

## MVC Overview
CI3 follows the MVC (Model-View-Controller) pattern:
- Model: Handles data and business logic (database interactions).
- View: UI templates (HTML, Bootstrap 5, JS).
- Controller: The “traffic cop” that connects models and views.

Example flow:
1. User visits /portfolio
2. Router maps URL to Portfolio controller
3. Controller loads data from model
4. Controller renders view with data

## Project Structure (Key Directories)
- application/config
  - config.php, routes.php, autoload.php
- application/controllers
  - Request handlers (e.g., Welcome.php)
- application/models
  - Data logic (e.g., user_model.php)
- application/views
  - UI templates (e.g., portfolio.php)
- assets
  - CSS, JS, images (Bootstrap 5, custom scripts)
- system
  - CI3 core (do not edit)

## Local Setup (XAMPP)
1. Place project in: c:\xampp\htdocs\porfolio_ci3_training
2. Start Apache and MySQL in XAMPP
3. Access via browser: http://localhost/porfolio_ci3_training
4. Configure base URL in application/config/config.php

## Development Environment Setup

Before starting CI3 development, you need to install and configure the following tools:

### Required Tools and Download Links

| Tool | Version | Download Link |
|------|---------|---------------|
| XAMPP | 7.4.33 | https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.4.33/ |
| Git | Latest | https://git-scm.com/install/windows |
| Composer | Latest | https://getcomposer.org/download/ |
| Visual Studio Code | Latest | https://code.visualstudio.com/download |
| HeidiSQL | Latest | https://www.heidisql.com/download.php |

### Installation Order
1. **XAMPP 7.4.33** - Install first (local server with Apache, PHP, MySQL)
2. **Git** - Install second (version control)
3. **Composer** - Install third (PHP package manager, requires PHP in PATH)
4. **Visual Studio Code** - Install fourth (code editor)
5. **HeidiSQL** - Install fifth (database management tool)

### Quick Setup Verification
After installation, verify everything works:
```bash
# Test Git
git --version

# Test Composer
composer --version

# Test PHP (using XAMPP)
C:\xampp\php\php.exe --version

# XAMPP: Start Apache and MySQL, then visit http://localhost
```

### VSCode Recommended Extensions
- PHP Intelephense (code intelligence)
- PHP Debug (debugging)
- GitLens (Git integration)
- Thunder Client (API testing)
- ES7+ React/Redux/React-Native snippets


- application/config/config.php
  - base_url
  - encryption_key
- application/config/database.php
  - Database credentials
- application/config/routes.php
  - URL routing
- application/config/autoload.php
  - Libraries, helpers, and models to auto-load

## CI3 Basics (Examples)

### Controller Example
Location: application/controllers/Portfolio.php
```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio extends CI_Controller {
    public function index() {
        $this->load->view('portfolio');
    }
}
```

### Model Example
Location: application/models/Project_model.php
```php
<?php
class Project_model extends CI_Model {
    public function get_all() {
        return $this->db->get('projects')->result();
    }
}
```

### View Example
Location: application/views/portfolio.php
```html
<h1>My Portfolio</h1>
```

### Route Example
Location: application/config/routes.php
```php
$route['portfolio'] = 'portfolio/index';
```

## Bootstrap 5 Usage
- Use Bootstrap 5 for all layout and components.
- Keep UI consistent with company standards.
- Include Bootstrap assets in a shared layout.

## JavaScript and AJAX
- Use JS for interactivity and AJAX for CRUD operations.
- Prefer JSON endpoints from controllers.
- Validate on both client and server.

## Trainee Project Tasks
Trainees must complete the following modules using CI3 + Bootstrap 5 + JS/AJAX.

### 1) Portfolio Page
Showcase:
- Who they are
- Aspirations
- Skills
- Projects
- Images and text content

Requirements:
- Use Bootstrap 5 grid and cards
- Responsive layout
- At least 3 project showcases

### 2) Login Page
Requirements:
- Authentication against users table
- Secure password hashing (password_hash)
- Session handling
- Redirect to CRUD dashboard on success
- Error handling on invalid login

### 3) CRUD Management System
Pick any domain (e.g., Books, Inventory, Events, Tasks, etc.)

Requirements:
- Create, Read, Update, Delete
- AJAX-based create/update/delete
- Search and pagination (server-side or client-side)
- Clean UI with Bootstrap 5
- Server-side validation

### 4) Calculator Module
Any type (basic or scientific)

Requirements:
- UI in Bootstrap 5
- JS logic for calculations
- Optional: History of calculations

## Suggested Training Milestones
1. CI3 introduction + MVC walkthrough
2. Routes, controllers, and views
3. Models + database setup
4. Bootstrap 5 layout and shared templates
5. Authentication flow
6. CRUD with AJAX
7. Final project assembly + demo

## Evaluation Checklist
- MVC usage is correct
- Clean routes and controller actions
- Reusable views and partials
- Proper validation and error handling
- Consistent Bootstrap 5 UI
- Proper use of JS/AJAX
- Code readability and structure

## Submission Guidelines
- Code must run locally with XAMPP
- Provide SQL export for database
- Include a short README with setup steps
- Ensure all pages are accessible and linked

## Next Steps
After the presentation, trainees will build their project based on these tasks. This manual is the reference for CI3 best practices and the expected output.
