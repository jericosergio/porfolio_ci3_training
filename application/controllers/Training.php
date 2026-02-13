<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

	public function index()
	{
		$data = array(
			'name' => 'Mat Jerico Sergio',
			'modules' => $this->get_modules(),
		);

		$this->load->view('training/module_list', $data);
	}

	public function module($module_slug = '')
	{
		if (empty($module_slug)) {
			redirect('training');
		}

		$all_modules = $this->get_modules();
		$module = null;

		foreach ($all_modules as $m) {
			if ($m['slug'] === $module_slug) {
				$module = $m;
				break;
			}
		}

		if (!$module) {
			show_404();
		}

		$data = array(
			'name' => 'Mat Jerico Sergio',
			'module' => $module,
		);

		$this->load->view('training/slide_viewer', $data);
	}

	private function get_modules()
	{
		return array(
			array(
				'slug' => 'php-fundamentals',
				'title' => 'PHP Fundamentals',
				'description' => 'Learn the basics of PHP programming language',
				'duration' => '40 minutes',
				'slides' => array(
					array(
						'number' => 1,
						'title' => 'Introduction to PHP',
						'explanation' => 'PHP (Hypertext Preprocessor) is a server-side scripting language designed for web development. It is open-source, free, and widely used to create dynamic web pages.',
						'examples' => array(
							'<?php 
    echo "Hello, World!"; 
?>',
							'<?php
    $name = "John";
    echo "Hello, " . $name; 
?>'
						),
						'key_points' => array(
							'PHP runs on the server and sends results to the browser',
							'PHP files can contain text, HTML, CSS, JavaScript, and PHP code',
							'PHP files have the extension .php',
							'PHP code is executed on the server'
						)
					),
					array(
						'number' => 2,
						'title' => 'Variables and Data Types',
						'explanation' => 'Variables are containers for storing data values. In PHP, a variable is declared with the $ sign, followed by the name of the variable.',
						'examples' => array(
							'<?php

    $x = 5; 
    $y = "Hello";
    $z = true;

?>',
							'<?php 

    var_dump($x); // displays type and value

 ?>'
						),
						'key_points' => array(
							'Variables must start with $',
							'Variable names are case-sensitive',
							'PHP supports multiple data types: String, Integer, Float, Boolean, Array, Object',
							'Use var_dump() to see type and value'
						)
					),
					array(
						'number' => 3,
						'title' => 'Arrays in PHP',
						'explanation' => 'Arrays store multiple values in a single variable. PHP supports indexed arrays, associative arrays, and multidimensional arrays to organize related data.',
						'examples' => array(
							'<?php

 $fruits = array("Apple", "Banana", "Orange");

?>',
							'<?php

 $user = array("name" => "Ana", "age" => 21);
 echo $user["name"];

 ?>'
						),
						'key_points' => array(
							'Indexed arrays use numeric keys (0, 1, 2...)',
							'Associative arrays use named keys ("name" => "Ana")',
							'Arrays can hold any data type',
							'Use count() to get the size of an array'
						)
					),
					array(
						'number' => 4,
						'title' => 'Objects in PHP',
						'explanation' => 'An object is an instance of a class. Objects bundle data (properties) and behavior (methods) together, making your code more organized and reusable.',
						'examples' => array(
							'<?php

    $user = (object) array("name" => "Ana", "age" => 21);

?>',
							'<?php

    echo $user->name; // access object property

    ?>'
						),
						'key_points' => array(
							'Objects store related data and behavior together',
							'Access properties using ->',
							'Objects are created from classes',
							'Useful for modeling real-world entities'
						)
					),
					array(
						'number' => 5,
						'title' => 'Classes in PHP',
						'explanation' => 'A class is a blueprint for creating objects. It defines properties and methods that objects created from the class will have.',
						'examples' => array(
							'<?php 
class User {

    public $name;

    public function greet() {
        return "Hi, " . $this->name; 
    }

    } 
?>',
							'<?php
    $user = new User();

    $user->name = "Ana";

    echo $user->greet();
?>'
						),
						'key_points' => array(
							'Classes define properties and methods',
							'Use new to create an object instance',
							'$this refers to the current object',
							'Classes help structure large applications'
						)
					),
					array(
						'number' => 6,
						'title' => 'OOP Basics in PHP',
						'explanation' => 'Object-Oriented Programming (OOP) organizes code into classes and objects. The core ideas are encapsulation, inheritance, and polymorphism.',
						'examples' => array(
							'<?php 
class Admin extends User {

    public function isAdmin() {

        return true;
    } 

}

?>',
							'<?php
    $admin = new Admin();

    $admin->name = "Ana"; 

    echo $admin->greet(); // Inherited method
?>'
						),
						'key_points' => array(
							'Encapsulation: keep data and methods together',
							'Inheritance: create child classes from parent classes',
							'Polymorphism: same method name, different behavior',
							'OOP improves reusability and maintainability'
						)
					),
					array(
						'number' => 7,
						'title' => 'Functions in PHP',
						'explanation' => 'A function is a block of code that can be called repeatedly. Functions help you organize your code and make it reusable.',
						'examples' => array(
							'<?php
    function greet($name) {
        return "Hello, " . $name; 
    }
        echo greet("John"); 
?>',
							'<?php

    function add($a, $b) {

        return $a + $b;

    } 
        
    echo add(5, 3); // outputs: 8 

?>'
						),
						'key_points' => array(
							'Define functions with the function keyword',
							'Functions can take parameters',
							'Functions can return values',
							'Function names are not case-sensitive'
						)
					),
				)
			),
			array(
				'slug' => 'dev-environment-setup',
				'title' => 'Development Environment Setup',
				'description' => 'Install and configure essential tools for web development',
				'duration' => '30 minutes',
				'slides' => array(
					array(
						'number' => 1,
						'title' => 'Development Environment Overview',
						'explanation' => 'A proper development environment is essential for efficient web development. You need a local server, version control, package manager, code editor, and database management tools. This module covers all the essential tools you need to start developing with CodeIgniter.',
						'examples' => array(
							'Tools you will install:
✓ XAMPP 7.4.33    - Local web server (Apache + PHP + MySQL)
✓ Git             - Version control system
✓ Composer        - PHP package manager
✓ VSCode          - Code editor
✓ HeidiSQL        - Database management tool'
						),
						'key_points' => array(
							'XAMPP: Provides local Apache server, PHP 7.4.33, and MySQL',
							'Git: Track code changes and collaborate with teams',
							'Composer: Manage PHP dependencies and libraries',
							'VSCode: Modern, lightweight code editor with extensions',
							'HeidiSQL: Visual database management and administration'
						)
					),
					array(
						'number' => 2,
						'title' => 'Installing XAMPP 7.4.33',
						'explanation' => 'XAMPP is a free and open-source cross-platform web server solution stack. It contains Apache, MySQL, PHP 7.4.33, and Perl. We\'ll use XAMPP to run our CodeIgniter application locally.',
						'examples' => array(
							'Installation Steps:
1. Download XAMPP 7.4.33 from:
   https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.4.33/
   
2. Run the installer (xampp-windows-x64-7.4.33-installer.exe)
3. Choose installation directory (default: C:\\xampp)
4. Select components:
   ✓ Apache
   ✓ MySQL
   ✓ PHP
   ✓ phpMyAdmin (optional)
5. Click Install and wait for completion',
							'After Installation:
1. Open XAMPP Control Panel
2. Start Apache (should show green "Running")
3. Start MySQL (should show green "Running")
4. Test in browser: http://localhost/
5. You should see XAMPP welcome page

Folder Structure:
C:\\xampp\\htdocs\\  → Your projects go here
C:\\xampp\\apache\\  → Apache server files
C:\\xampp\\mysql\\   → MySQL database files
C:\\xampp\\php\\     → PHP files'
						),
						'key_points' => array(
							'Download from: https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.4.33/',
							'Install in a path without spaces (e.g., C:\\xampp)',
							'Always start Apache before developing',
							'Always start MySQL if using databases',
							'Projects go in C:\\xampp\\htdocs\\ folder',
							'Access projects via http://localhost/project_name'
						)
					),
					array(
						'number' => 3,
						'title' => 'Installing Git',
						'explanation' => 'Git is a distributed version control system that tracks changes in your code. It allows you to save versions of your project, collaborate with others, and revert to previous versions if needed.',
						'examples' => array(
							'Installation Steps:
1. Download Git from:
   https://git-scm.com/install/windows
   
2. Run the installer (Git-2.x.x-64-bit.exe)
3. Keep default options (usually fine)
4. Choose "Use Git from Git Bash only" or add to PATH
5. Use default text editor (Vim or Notepad++)
6. Complete installation

Verify Installation:
Open Command Prompt and type:
git --version

You should see: git version 2.x.x',
							'Basic Git Commands:
git init              → Initialize new repository
git config --global user.name "Your Name"
git config --global user.email "your@email.com"
git add .             → Stage files for commit
git commit -m "msg"   → Save changes with message
git log               → View commit history
git status            → Check repository status'
						),
						'key_points' => array(
							'Download from: https://git-scm.com/install/windows',
							'Choose "Add Git to PATH" for command line access',
							'Configure username and email after installation',
							'Create .gitignore to exclude files (node_modules, vendor, etc.)',
							'Use meaningful commit messages',
							'Commit frequently with small, logical changes'
						)
					),
					array(
						'number' => 4,
						'title' => 'Installing Composer',
						'explanation' => 'Composer is a dependency manager for PHP. It allows you to easily manage and install PHP libraries and packages that your project needs. CodeIgniter and many third-party packages use Composer.',
						'examples' => array(
							'Installation Steps:
1. Download Composer from:
   https://getcomposer.org/download/
   
2. Download "Composer-Setup.exe" (Installer)
3. Run the installer
4. When asked for PHP location, select C:\\xampp\\php\\php.exe
5. Complete installation
6. Restart computer or command prompt

Verify Installation:
Open Command Prompt and type:
composer --version

You should see: Composer version x.x.x',
							'Using Composer:
# Navigate to your project folder
cd C:\\xampp\\htdocs\\my_project

# Install dependencies from composer.json
composer install

# Require a new package
composer require monolog/monolog

# Update packages
composer update

# View installed packages
composer show'
						),
						'key_points' => array(
							'Download from: https://getcomposer.org/download/',
							'Select PHP executable path during installation (C:\\xampp\\php\\php.exe)',
							'composer.json lists all project dependencies',
							'vendor/ folder contains all installed packages',
							'Add vendor/ to .gitignore (don\'t commit it)',
							'Run "composer install" to restore dependencies from composer.json'
						)
					),
					array(
						'number' => 5,
						'title' => 'Installing Visual Studio Code',
						'explanation' => 'Visual Studio Code (VSCode) is a lightweight, powerful code editor. It\'s perfect for web development with excellent support for PHP, JavaScript, Git integration, and extensions.',
						'examples' => array(
							'Installation Steps:
1. Download VSCode from:
   https://code.visualstudio.com/download
   
2. Run the installer (VSCodeUserSetup-x64-x.x.x.exe)
3. Choose installation location
4. Check "Add to PATH" option
5. Click Install and finish

Recommended Extensions:
1. PHP Intelephense (bmewburn.vscode-intelephense-client)
2. PHP Debug (felixbecker.php-debug)
3. ES7+ React/Redux/React-Native snippets
4. GitLens
5. Thunder Client or REST Client

Installing Extensions:
1. Click Extensions icon (Ctrl+Shift+X)
2. Search for extension name
3. Click Install',
							'Setting Up VSCode for CodeIgniter:
1. Install PHP Intelephense for code completion
2. Configure workspace folder: File → Open Folder
3. Select C:\\xampp\\htdocs\\your_project
4. Use Ctrl+` to open terminal
5. Create .vscode/settings.json:

{
  "editor.formatOnSave": true,
  "php.validate.executablePath": "C:\\\\xampp\\\\php\\\\php.exe",
  "editor.defaultFormatter": "felixbecker.php-intellisense"
}'
						),
						'key_points' => array(
							'Download from: https://code.visualstudio.com/download',
							'Check "Add to PATH" during installation',
							'Install PHP Intelephense for code intelligence',
							'Use integrated terminal (Ctrl+`) for Git and Composer commands',
							'Install GitLens extension for better Git integration',
							'Use Ctrl+Shift+F for global search across project',
							'Customize theme and font size in Settings (Ctrl+,)'
						)
					),
					array(
						'number' => 6,
						'title' => 'Installing HeidiSQL',
						'explanation' => 'HeidiSQL is a lightweight, easy-to-use database management tool for MySQL. It provides a visual interface to manage databases, tables, data, and run SQL queries. Perfect for developers who prefer GUI over command line.',
						'examples' => array(
							'Installation Steps:
1. Download HeidiSQL from:
   https://www.heidisql.com/download.php
   
2. Run the installer (heidisql_x.x_installer.exe)
3. Follow installation wizard
4. Click Finish to complete

Verify Installation:
Run HeidiSQL from Start Menu or desktop shortcut',
							'Connecting to MySQL:
1. Open HeidiSQL
2. Click "New" to create connection
3. Enter connection details:
   Host name/IP: localhost
   User: root
   Password: (usually empty for XAMPP)
   Port: 3306
4. Click Open
5. You\'re now connected!

Using HeidiSQL:
- Right-click to create new database
- Expand database to see tables
- Right-click table to view/edit data
- Use query editor (Tools → Query window)
- Export/Import databases (File menu)'
						),
						'key_points' => array(
							'Download from: https://www.heidisql.com/download.php',
							'No installation required (portable version available)',
							'Connect to localhost with username "root"',
							'No password needed for default XAMPP setup',
							'Can manage multiple databases simultaneously',
							'Supports SQL query execution and result viewing',
							'Can export data in multiple formats (SQL, CSV, etc.)'
						)
					),
					array(
						'number' => 7,
						'title' => 'Verifying Your Setup',
						'explanation' => 'After installing all tools, verify that everything is working correctly. This ensures you\'re ready to start developing CodeIgniter applications.',
						'examples' => array(
							'Verification Checklist:

1. XAMPP:
   → XAMPP Control Panel running
   → Apache showing "Running" (green)
   → MySQL showing "Running" (green)
   → Browser: http://localhost/ shows XAMPP page

2. Git:
   → Command Prompt: git --version
   → Should output version number

3. Composer:
   → Command Prompt: composer --version
   → Should output version number

4. VSCode:
   → Open VSCode from Start Menu
   → File → Open Folder → Select C:\\xampp\\htdocs
   → Open Integrated Terminal (Ctrl+`)

5. HeidiSQL:
   → Run HeidiSQL
   → Create new connection to localhost
   → Should see existing databases',
							'First Project Setup:
1. Create folder: C:\\xampp\\htdocs\\my_first_project
2. Open in VSCode: File → Open Folder
3. Open terminal in VSCode (Ctrl+`)
4. Initialize Git: git init
5. Configure Git user: git config --global user.name "Your Name"
6. Create .gitignore file with:
   vendor/
   .env
   logs/
7. Install CodeIgniter: composer create-project codeigniter3/codeigniter
8. Ready to develop!'
						),
						'key_points' => array(
							'Test XAMPP by visiting http://localhost',
							'Verify all tools through command line',
							'Create project folders in C:\\xampp\\htdocs',
							'Always initialize Git in new projects',
							'Use .gitignore to exclude unnecessary files',
							'Keep tools updated for security and compatibility'
						)
					),
					array(
						'number' => 8,
						'title' => 'Troubleshooting Common Issues',
						'explanation' => 'Common setup problems and how to fix them. These are issues you might encounter during installation and initial setup.',
						'examples' => array(
							'XAMPP Issues:

Problem: Port 80 already in use
Solution:
  → XAMPP Control Panel → Apache → Config → httpd.conf
  → Change: Listen 80 to Listen 8080
  → Access: http://localhost:8080 instead

Problem: MySQL won\'t start
Solution:
  → Backup C:\\xampp\\mysql\\data folder
  → Delete C:\\xampp\\mysql\\data\\ibdata1
  → Start MySQL again

Problem: Cannot access C:\\xampp\\htdocs files
Solution:
  → Check Apache file permissions
  → Ensure Apache service is running
  → Check Windows Firewall settings',
							'Git & Composer Issues:

Problem: "git" or "composer" not recognized
Solution:
  → Git/Composer not in PATH
  → Reinstall and check "Add to PATH"
  → Restart Command Prompt

Problem: Composer timeout errors
Solution:
  → composer config -g process-timeout 2000
  → composer install --no-interaction

HeidiSQL Issues:

Problem: Cannot connect to MySQL
Solution:
  → Ensure MySQL is running in XAMPP
  → Check credentials: user=root, password=empty
  → Verify port: 3306
  → Check Windows Firewall'
						),
						'key_points' => array(
							'Port conflicts: Change Apache port to 8080',
							'MySQL issues: Delete ibdata1 and restart',
							'Command not found: Add to PATH and restart terminal',
							'Timeout errors: Increase process timeout',
							'Connection refused: Verify service is running',
							'Always check firewall settings',
							'Restart applications after configuration changes'
						)
					),
				)
			),
			array(
				'slug' => 'codeigniter-basics',
				'title' => 'CodeIgniter 3 Basics',
				'description' => 'Master the fundamentals of CodeIgniter framework',
				'duration' => '40 minutes',
				'slides' => array(
					array(
						'number' => 1,
						'title' => 'What is CodeIgniter?',
						'explanation' => 'CodeIgniter is a powerful PHP framework built for developers who need a simple and elegant toolkit to create full-featured web applications. It follows the MVC (Model-View-Controller) architectural pattern.',
						'examples' => array(
							'// MVC Architecture Flow
┌─────────┐     ┌────────────┐     ┌───────┐
│ Browser │────>│ Controller │────>│ Model │
└─────────┘     └────────────┘     └───────┘
     ↑                 │                │
     │                 ↓                ↓
     │            ┌────────┐      ┌──────────┐
     └────────────│  View  │<─────│ Database │
                  └────────┘      └──────────┘'
						),
						'key_points' => array(
							'Light and fast framework with small footprint',
							'Follows MVC pattern for separation of concerns',
							'Excellent documentation and community support',
							'Built-in security features',
							'Minimal configuration required'
						)
					),
					array(
						'number' => 2,
						'title' => 'MVC Pattern Explained',
						'explanation' => 'MVC (Model-View-Controller) separates application logic into three interconnected components. This separation helps organize code and makes applications easier to maintain and scale.',
						'examples' => array(
							'MODEL
├─ Handles data and business logic
├─ Interacts with database
└─ Returns data to controller',

'VIEW
├─ Handles presentation layer
├─ Displays data to user
└─ Contains HTML, CSS, JavaScript',

'CONTROLLER
├─ Receives user requests
├─ Processes input and logic
└─ Coordinates Model and View',
						),
						'key_points' => array(
							'Model: Manages data and database operations',
							'View: Handles the user interface',
							'Controller: Processes requests and coordinates',
							'Clear separation of concerns',
							'Each component has a specific responsibility'
						)
					),
					array(
						'number' => 3,
						'title' => 'MODEL: Data Layer',
						'explanation' => 'Models represent your data layer. They handle database operations like retrieving, inserting, updating, and deleting records. Models keep your database logic organized and reusable.',
						'examples' => array(
							'// application/models/User_model.php

class User_model extends CI_Model {
    
    public function get_users() {
        return $this->db->get("users")->result();
    }
    
    public function get_user($id) {
        return $this->db->where("id", $id)
            ->get("users")
            ->row();
    }
    
    public function insert_user($data) {
        return $this->db->insert("users", $data);
    }
}'
						),
						'key_points' => array(
							'Models extend CI_Model',
							'Handle all database interactions',
							'Return data to controllers',
							'Should contain business logic',
							'Keep queries and data operations here'
						)
					),
					array(
						'number' => 4,
						'title' => 'VIEW: Presentation Layer',
						'explanation' => 'Views handle the presentation layer - what users see. They contain HTML markup and minimal PHP for displaying data. Views receive data from controllers and should not contain business logic.',
						'examples' => array(
							'<!-- application/views/user_list.php -->

<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
</head>
<body>
    <h1><?php echo $title; ?></h1>
    <ul>
        <?php foreach($users as $user): ?>
            <li><?php echo $user->name; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>'
						),
						'key_points' => array(
							'Views contain HTML and presentation code',
							'Receive data from controllers via $data array',
							'Should NOT contain business logic',
							'Can include other views',
							'Keep views simple and focused on display'
						)
					),
					array(
						'number' => 5,
						'title' => 'CONTROLLER: Request Handler',
						'explanation' => 'Controllers handle user requests and coordinate between Models and Views. They process input, load models to fetch data, and pass that data to views for display.',
						'examples' => array(
							'// application/controllers/Users.php

class Users extends CI_Controller {
    
    public function index() {
        // Load model
        $this->load->model("user_model");
        
        // Get data from model
        $data["users"] = $this->user_model->get_users();
        $data["title"] = "User List";
        
        // Load view with data
        $this->load->view("user_list", $data);
    }
    
    public function view($id) {
        $this->load->model("user_model");
        $data["user"] = $this->user_model->get_user($id);
        $this->load->view("user_detail", $data);
    }
}'
						),
						'key_points' => array(
							'Controllers extend CI_Controller',
							'Methods are called "actions"',
							'Load models with $this->load->model()',
							'Load views with $this->load->view()',
							'Pass data to views as array',
							'URL maps to controller/method'
						)
					),
					array(
						'number' => 6,
						'title' => 'Understanding URL Structure',
						'explanation' => 'CodeIgniter uses a segment-based URL structure where each part of the URL has a specific meaning. Understanding this structure is essential for routing requests to the right controller and method.',
						'examples' => array(
							'// URL Structure Breakdown
http://example.com/users/view/5
                   ──┬── ──┬─ ─┬─
                     │     │   │
                 Controller Method Parameter

WHO:   users      ─ Which controller class
WHERE: view       ─ Which method in controller
WHAT:  5          ─ Data/ID to pass as parameter',
							'// Real-world Examples

example.com/products/details/123
WHO:   products   (Products controller)
WHERE: details    (details() method)
WHAT:  123        (Product ID to display)

example.com/blog/post/my-first-article
WHO:   blog       (Blog controller)
WHERE: post       (post() method)
WHAT:  my-first-article (Article slug)

example.com/users
WHO:   users      (Users controller)
WHERE: index      (index() method - default)
WHAT:  none       (No parameter)'
						),
						'key_points' => array(
							'WHO = Controller: Which class handles the request',
							'WHERE = Method: Which function to execute',
							'WHAT = Parameter: Data passed to the method',
							'index() method is default if not specified',
							'Multiple parameters: site.com/controller/method/param1/param2',
							'Clean URLs without .php or query strings'
						)
					),
					array(
						'number' => 7,
						'title' => 'Putting It All Together',
						'explanation' => 'When a user visits your site, the URL determines which controller and method to execute. The controller loads the model to get data, then passes that data to the view for display.',
						'examples' => array(
							'// Complete Request Flow
http://example.com/users/view/5

1. Router parses URL segments
   WHO:   users    → Users controller
   WHERE: view     → view() method
   WHAT:  5        → $id parameter

2. Users controller executes view(5)
3. Controller loads User_model
4. Model queries: SELECT * FROM users WHERE id=5
5. Model returns user data to controller
6. Controller passes data to user_detail view
7. View renders HTML with user data
8. Browser displays the page',
							'// Data Flow Visualization
┌─────────┐
│ Browser │ http://example.com/users/view/5
└────┬────┘
     │
     ↓
┌────────────┐  load model   ┌─────────────┐
│ Controller │─────────────→ │    Model    │
│  (Users)   │               │ (User_model)│
└────────────┘               └──────┬──────┘
     │                              │
     │ pass data                    │ query
     ↓                              ↓
┌─────────┐                   ┌──────────┐
│  View   │                   │ Database │
│ (HTML)  │                   └──────────┘
└────┬────┘
     │
     ↓
┌─────────┐
│ Browser │ Displays rendered page
└─────────┘'
						),
						'key_points' => array(
							'URL structure: site.com/controller/method/param',
							'Router maps URL to controller class and method',
							'Controllers orchestrate the flow',
							'Models handle data operations',
							'Views display the results',
							'Clean separation makes debugging easier'
						)
					),
				)
			),
			array(
				'slug' => 'mysql-queries',
				'title' => 'MySQL Queries Essentials',
				'description' => 'Essential SQL queries and database operations',
				'duration' => '30 minutes',
				'slides' => array(
					array(
						'number' => 1,
						'title' => 'SELECT Query',
						'explanation' => 'The SELECT statement is used to select data from a database. The returned data is stored in a result table, sometimes called the result-set.',
						'examples' => array(
							'SELECT * FROM users;',
							'SELECT name, email FROM users WHERE age > 18;',
							'SELECT * FROM users ORDER BY name ASC;'
						),
						'key_points' => array(
							'SELECT * returns all columns',
							'Use WHERE clause to filter results',
							'Use ORDER BY to sort results',
							'Use LIMIT to restrict number of results'
						)
					),
					array(
						'number' => 2,
						'title' => 'INSERT Query',
						'explanation' => 'The INSERT INTO statement is used to insert new records in a table. You can insert one or multiple rows at a time.',
						'examples' => array(
							'INSERT INTO users (name, email) 
VALUES ("John", "john@example.com");',
							'INSERT INTO users (name, email) 
VALUES 
    ("Jane", "jane@example.com"), 
    ("Bob", "bob@example.com");'
						),
						'key_points' => array(
							'Specify column names and values',
							'Values must match column data types',
							'Use NULL for empty columns',
							'Auto-increment fields can be omitted'
						)
					),
					array(
						'number' => 3,
						'title' => 'UPDATE Query',
						'explanation' => 'The UPDATE statement is used to modify the existing records in a table. Always use WHERE clause to specify which records should be updated.',
						'examples' => array(
							'UPDATE users 
SET email = "newemail@example.com" 
WHERE id = 1;',
							'UPDATE users 
SET age = 25, status = "active" 
WHERE name = "John";'
						),
						'key_points' => array(
							'Always use WHERE clause to avoid updating all rows',
							'Multiple columns can be updated at once',
							'Use AND/OR in WHERE clause for complex conditions',
							'Test queries with SELECT first'
						)
					),
					array(
						'number' => 4,
						'title' => 'DELETE Query (Hard Delete)',
						'explanation' => 'The DELETE statement permanently removes records from a table. This action is irreversible and the data cannot be recovered. Use with extreme caution in production environments.',
						'examples' => array(
							'-- Permanently delete a single user
DELETE FROM users WHERE id = 1;',
							'-- Permanently delete multiple records
DELETE FROM users WHERE status = "inactive";',
							'-- DANGER: Delete all records (no WHERE clause)
DELETE FROM users;'
						),
						'key_points' => array(
							'Hard delete = permanent removal of data',
							'Always use WHERE clause to avoid deleting all records',
							'Data cannot be recovered after deletion',
							'Consider backup before major DELETE operations',
							'No audit trail of deleted records',
							'Use soft delete for important data'
						)
					),
					array(
						'number' => 5,
						'title' => 'Soft Delete Method',
						'explanation' => 'Soft delete marks records as deleted without removing them from the database. This preserves data for audit trails, recovery, and compliance. A deleted_at or is_deleted column indicates deletion status.',
						'examples' => array(
							'-- Add soft delete column to table
ALTER TABLE users 
ADD COLUMN deleted_at DATETIME NULL;
',
							'-- Query only active (non-deleted) records
SELECT * FROM users 
WHERE deleted_at IS NULL;

-- Query deleted records
SELECT * FROM users 
WHERE deleted_at IS NOT NULL;',
							'-- Soft delete: Mark record as deleted
UPDATE users 
SET deleted_at = NOW() 
WHERE id = 1;

-- Restore a soft-deleted record
UPDATE users 
SET deleted_at = NULL 
WHERE id = 1;'
						),
						'key_points' => array(
							'Soft delete preserves data in database',
							'Use deleted_at timestamp or is_deleted flag',
							'Records can be recovered/restored',
							'Maintains audit trail of deletions',
							'Filter with WHERE deleted_at IS NULL for active records',
							'Better for compliance and data retention policies'
						)
					),
					array(
						'number' => 6,
						'title' => 'Audit Trail & Why It Matters',
						'explanation' => 'An audit trail tracks who did what and when in your database. This is crucial for security, compliance, troubleshooting, and accountability. Soft deletes are part of maintaining a complete audit trail.',
						'examples' => array(
							'-- Audit table structure
CREATE TABLE audit_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action VARCHAR(50),
    table_name VARCHAR(50),
    record_id INT,
    old_value TEXT,
    new_value TEXT,
    created_at DATETIME DEFAULT NOW()
);',
							'-- Example audit trail for user deletion
INSERT INTO audit_log 
(user_id, action, table_name, record_id, old_value) 
VALUES 
(5, "SOFT_DELETE", "users", 123, 
    \'{"name":"Ana","email":"ana@example.com"}\');',
							'-- Query audit history
SELECT * FROM audit_log 
WHERE table_name = "users" 
AND record_id = 123 
ORDER BY created_at DESC;'
						),
						'key_points' => array(
							'Audit trails track all database changes',
							'Essential for compliance (GDPR, HIPAA, etc.)',
							'Helps troubleshoot data issues',
							'Provides accountability (who deleted what)',
							'Enables data recovery and rollback',
							'Soft deletes preserve deletion history',
							'Critical for financial and medical systems'
						)
					),
					array(
						'number' => 7,
						'title' => 'Hard Delete vs Soft Delete',
						'explanation' => 'Choosing between hard delete and soft delete depends on your data retention needs, compliance requirements, and business rules. Each approach has advantages and trade-offs.',
						'examples' => array(
							'HARD DELETE
✓ Pros:
  - Frees up database storage immediately
  - Simpler queries (no deleted_at filter)
  - Better for temporary/cache data
  
✗ Cons:
  - Data permanently lost
  - No recovery possible
  - No audit trail
  - Compliance issues
',
'SOFT DELETE
✓ Pros:
  - Data can be recovered
  - Maintains audit trail
  - Meets compliance requirements
  - Safer for production
  
✗ Cons:
  - Uses more storage space
  - Queries need WHERE deleted_at IS NULL
  - Requires cleanup strategy',
							'WHEN TO USE EACH:

Hard Delete:
- Session data
- Cache/temporary files
- Log files (after backup)
- Test data

Soft Delete:
- User accounts
- Financial transactions
- Medical records
- Business documents
- Customer data'
						),
						'key_points' => array(
							'Hard delete: Use for non-critical, temporary data',
							'Soft delete: Use for important business data',
							'Consider compliance and legal requirements',
							'Implement both based on data sensitivity',
							'Document your deletion policy clearly',
							'Regular cleanup of old soft-deleted records'
						)
					),
				)
			),
			array(
				'slug' => 'codeigniter-query-builder',
				'title' => 'CodeIgniter Query Builder',
				'description' => 'Master database queries using CodeIgniter Query Builder methods',
				'duration' => '40 minutes',
				'slides' => array(
					array(
						'number' => 1,
						'title' => 'Introduction to Query Builder',
						'explanation' => 'CodeIgniter Query Builder enables you to use simpler, easier to read syntax for building SQL queries. Instead of writing raw SQL strings, you use a fluent interface to build queries programmatically.',
						'examples' => array(
							'// Query Builder method
$this->db->from("users")->where("age >", 18)->get();

// Raw SQL equivalent
SELECT * FROM users WHERE age > 18;'
						),
						'key_points' => array(
							'Query Builder provides a fluent interface',
							'Protects against SQL injection attacks',
							'Makes code more readable and maintainable',
							'Supports all major database operations',
							'Database driver independent'
						)
					),
					array(
						'number' => 2,
						'title' => 'SELECT Queries with Query Builder',
						'explanation' => 'The Query Builder provides methods for selecting data from tables. You can specify columns, add WHERE conditions, order results, and limit output using method chaining.',
						'examples' => array(
							'// SELECT name, email from users where id = 1 limit 1;
$this->db->select("name, email")
    ->from("users")
    ->where("id", 1)
    ->get()
    ->row();',
							'// SELECT * from users where status="active";
$this->db->get_where("users", array("status" => "active"))
->result();',
							'// SELECT * from users where age>18 
order by name ASC limit 10;
$this->db->from("users")
    ->where("age >", 18)
    ->order_by("name", "ASC")
    ->limit(10)
    ->get();'
						),
						'key_points' => array(
							'select() - specify which columns to return',
							'from() - specify the table name',
							'where() - add conditions',
							'order_by() - sort results',
							'limit() - restrict number of rows returned',
							'get() - executes the query'
						)
					),
					array(
						'number' => 3,
						'title' => 'INSERT & UPDATE with Query Builder',
						'explanation' => 'The Query Builder simplifies inserting and updating records by accepting arrays of data. This is safer and more readable than constructing SQL strings manually.',
						'examples' => array(
							'// INSERT
$data = array(
    "name" => "John", 
    "email" => "john@example.com"
);
$this->db->insert("users", $data);',
							'// UPDATE
$data = array(
    "name" => "John", 
    "email" => "john@example.com"
);
$this->db->where("id", 1)->update("users", $data);'
						),
						'key_points' => array(
							'insert() - add new records to a table',
							'update() - modify existing records',
							'set() - set column values',
							'Pass data as an associative array',
							'Always use where() before update to specify which rows',
							'Returns TRUE on success, FALSE on failure'
						)
					),
					array(
						'number' => 4,
						'title' => 'DELETE, JOIN & Advanced Methods',
						'explanation' => 'Query Builder provides methods for deleting records, joining tables, and performing advanced database operations with clean, readable syntax.',
						'examples' => array(
							'// DELETE
$this->db->where("id", 1)->delete("users");',
							'// JOIN
$this->db->from("users")
    ->join("orders", "users.id = orders.user_id")
    ->get();',
							'// GROUP BY & HAVING
$this->db->select("name, COUNT(*) as total")
    ->from("users")
    ->group_by("name")
    ->having("total >", 5)
    ->get();'
						),
						'key_points' => array(
							'delete() - remove records from a table',
							'join() - combine rows from multiple tables',
							'group_by() - group results by column(s)',
							'having() - filter grouped results',
							'distinct() - return only unique values',
							'Method chaining allows complex queries'
						)
					),
					array(
						'number' => 5,
						'title' => 'Getting Single Results: row()',
						'explanation' => 'The row() method retrieves a single result row and returns it as a stdObject. Use this when your query returns only one record or when you want the first result as an object.',
						'examples' => array(
							'// Get single user by ID as object
$user = $this->db->from("users")
    ->where("id", 1)
    ->get()
    ->row();

// Access properties
echo $user->name;
echo $user->email;

// Returns NULL if no rows found'
						),
						'key_points' => array(
							'row() returns a single result as stdObject',
							'Returns NULL if no rows are found',
							'Access properties using arrow notation: $user->name',
							'Best for queries expecting one result',
							'First result returned if multiple rows exist',
							'Use with get() method'
						)
					),
					array(
						'number' => 6,
						'title' => 'Getting Single Results: row_array()',
						'explanation' => 'The row_array() method retrieves a single result row and returns it as an associative array. Use this when you prefer array syntax over object properties.',
						'examples' => array(
							'// Get single user by ID as array
$user = $this->db->from("users")
    ->where("id", 1)
    ->get()
    ->row_array();

// Access values with array keys
echo $user["name"];
echo $user["email"];

// Returns empty array if no rows found'
						),
						'key_points' => array(
							'row_array() returns a single result as associative array',
							'Returns empty array [] if no rows are found',
							'Access values using bracket notation: $user["name"]',
							'Best for queries expecting one result in array format',
							'First result returned if multiple rows exist',
							'Easier to work with in foreach loops with isset()'
						)
					),
					array(
						'number' => 7,
						'title' => 'Getting Multiple Results: result()',
						'explanation' => 'The result() method retrieves all matching rows and returns them as an array of stdObjects. Use this when your query returns multiple records as objects.',
						'examples' => array(
							'// Get all active users as objects
$users = $this->db->from("users")
    ->where("status", "active")
    ->get()
    ->result();

// Loop through results
foreach($users as $user) {
    echo $user->name;
}

// Returns empty array if no rows found'
						),
						'key_points' => array(
							'result() returns array of stdObjects',
							'Returns empty array [] if no rows are found',
							'Each element is an object with properties',
							'Perfect for looping with foreach',
							'Access data with arrow notation: $user->name',
							'No need to check if array is empty before looping'
						)
					),
					array(
						'number' => 8,
						'title' => 'Getting Multiple Results: result_array()',
						'explanation' => 'The result_array() method retrieves all matching rows and returns them as an array of associative arrays. Use this when your query returns multiple records in array format.',
						'examples' => array(
							'// Get all active users as arrays
$users = $this->db->from("users")
    ->where("status", "active")
    ->get()
    ->result_array();

// Loop through results
foreach($users as $user) {
    echo $user["name"];
}

// Returns empty array if no rows found'
						),
						'key_points' => array(
							'result_array() returns array of associative arrays',
							'Returns empty array [] if no rows are found',
							'Each element is an array with keys',
							'Perfect for looping with foreach',
							'Access data with bracket notation: $user["name"]',
							'Useful when converting results to JSON or CSV'
						)
					),
					array(
						'number' => 9,
						'title' => 'Query Builder Best Practices',
						'explanation' => 'Follow these best practices to write secure, efficient, and maintainable Query Builder code in your CodeIgniter applications.',
						'examples' => array(
							'// GOOD: Use method chaining
$users = $this->db->from("users")
    ->where("status", "active")
    ->order_by("name")
    ->limit(10)
    ->get()
    ->result_array();',
							'// AVOID: Raw SQL in critical code
$users = $this->db->query(
    "SELECT * FROM users WHERE status = \'" . $status . "\'"
);'
						),
						'key_points' => array(
							'Always use where() with update/delete to avoid affecting all records',
							'Use Query Builder instead of raw SQL when possible',
							'Choose result method based on your needs: row(), row_array(), result(), result_array()',
							'Method chaining improves readability',
							'Test queries before using them in production',
							'Validate and sanitize user input before queries'
						)
					),
				)
			),
			array(
				'slug' => 'ci3-libraries-helpers',
				'title' => 'CI3 Libraries & Helpers',
				'description' => 'Explore built-in libraries and helpers available in CodeIgniter 3',
				'duration' => '35 minutes',
				'slides' => array(
					array(
						'number' => 1,
						'title' => 'Introduction to Libraries & Helpers',
						'explanation' => 'CodeIgniter provides a collection of pre-built libraries and helpers to speed up development. Libraries are classes that encapsulate specific functionality, while Helpers are collections of functions that assist with common tasks.',
						'examples' => array(
							'// Loading a Library
$this->load->library("email");

// Using the library
$this->email->from("test@example.com");
$this->email->to("user@example.com");',
							'// Loading a Helper
$this->load->helper("url");

// Using helper functions
$link = anchor("welcome", "Click Here");'
						),
						'key_points' => array(
							'Libraries are object-oriented and can have properties and methods',
							'Helpers are procedural - they contain standalone functions',
							'Both can be auto-loaded in config/autoload.php',
							'Custom libraries and helpers can extend built-in functionality',
							'Libraries provide more powerful functionality than helpers'
						)
					),
					array(
						'number' => 2,
						'title' => 'Built-in Libraries Part 1',
						'explanation' => 'CodeIgniter includes several essential libraries for common tasks. Let\'s explore some of the most frequently used ones.',
						'examples' => array(
							'// Email Library
$this->load->library("email");
$this->email->from("sender@example.com");
$this->email->to("recipient@example.com");
$this->email->subject("Hello");
$this->email->message("This is a test email");
$this->email->send();',
							'// Form Validation Library
$this->load->library("form_validation");
$this->form_validation->set_rules("email", "Email", "required|valid_email");
if ($this->form_validation->run() == FALSE) {
    echo validation_errors();
}'
						),
						'key_points' => array(
							'Email Library: Send emails with SMTP or PHP mail',
							'Form Validation: Validate user input with built-in or custom rules',
							'Session Library: Manage user sessions securely',
							'Upload Library: Handle file uploads with validation',
							'Encryption Library: Encrypt/decrypt sensitive data'
						)
					),
					array(
						'number' => 3,
						'title' => 'Built-in Libraries Part 2',
						'explanation' => 'Additional libraries for pagination, image manipulation, caching, and more advanced features.',
						'examples' => array(
							'// Pagination Library
$this->load->library("pagination");
$config["base_url"] = site_url("products");
$config["total_rows"] = $total_count;
$config["per_page"] = 10;
$this->pagination->initialize($config);
echo $this->pagination->create_links();',
							'// Image Library
$this->load->library("image_lib");
$config["image_library"] = "gd2";
$config["source_image"] = "uploads/image.jpg";
$config["new_image"] = "uploads/thumbs/";
$config["maintain_ratio"] = TRUE;
$config["width"] = 150;
$config["height"] = 150;
$this->image_lib->initialize($config);
$this->image_lib->resize();'
						),
						'key_points' => array(
							'Pagination Library: Easy pagination for large datasets',
							'Image Library: Resize, crop, and manipulate images',
							'Cart Library: Shopping cart functionality',
							'Table Library: Generate HTML tables from arrays',
							'Zip Library: Create zip files programmatically'
						)
					),
					array(
						'number' => 4,
						'title' => 'URL and Text Helpers',
						'explanation' => 'Helpers provide utility functions for common tasks. URL helpers are used for generating links and URLs, while Text helpers manipulate strings.',
						'examples' => array(
							'// URL Helper functions
$this->load->helper("url");

site_url("products"); // Base URL + segment
base_url("assets/css/style.css"); // Base URL
anchor("welcome", "Click Here"); // HTML link
redirect("dashboard"); // Redirect to URL',
							'// Text Helper functions
$this->load->helper("text");

word_limiter("Long text here...", 10);
character_limiter("Long text...", 30);
highlight_phrase("text", "search_phrase");
random_string("alnum", 10); // Random string'
						),
						'key_points' => array(
							'site_url(): Generates URL with index.php removed',
							'base_url(): Returns base URL of your application',
							'anchor(): Creates HTML anchor tags',
							'redirect(): Redirects to specified URL',
							'Helper functions are faster than writing custom code'
						)
					),
					array(
						'number' => 5,
						'title' => 'Array and String Helpers',
						'explanation' => 'Array helpers manipulate arrays, while String helpers perform common string operations. These are essential for data processing.',
						'examples' => array(
							'// Array Helper functions
$this->load->helper("array");

$data = array("name" => "John", "age" => 30);
element("name", $data); // Get element or FALSE
random_element(array(1, 2, 3, 4)); // Random element

$array = array("a" => 1, "b" => 2);
$keys = array_keys($array); // Get all keys',
							'// String Helper functions
$this->load->helper("string");

repeat_pattern("ab", 3); // "ababab"
reverse_string("hello"); // "olleh"
increment_string("page_1", "_"); // "page_2"
quoted_implode(",", array("a","b")); // "a", "b"'
						),
						'key_points' => array(
							'element(): Safely access array elements',
							'random_element(): Get random item from array',
							'repeat_pattern(): Repeat a pattern N times',
							'increment_string(): Increment numeric suffix',
							'quoted_implode(): Join with quotes around elements'
						)
					),
					array(
						'number' => 6,
						'title' => 'File and Directory Helpers',
						'explanation' => 'These helpers provide functions for file system operations like reading, writing, and managing files and directories.',
						'examples' => array(
							'// File Helper functions
$this->load->helper("file");

read_file("path/to/file.txt");
write_file("path/to/file.txt", "content");
delete_files("path/to/dir");
get_filenames("path/to/dir");',
							'// Directory Helper functions
$this->load->helper("directory");

$map = directory_map("uploads/");
// Returns: array("file.txt" => array(...))

get_dir_file_info("uploads/images", "name");
// Returns info about all files in directory'
						),
						'key_points' => array(
							'read_file(): Read file contents into string',
							'write_file(): Write content to file',
							'delete_files(): Delete files from directory',
							'directory_map(): Get recursive directory structure',
							'get_dir_file_info(): Get file information from directory'
						)
					),
					array(
						'number' => 7,
						'title' => 'Cookie and Download Helpers',
						'explanation' => 'Cookie helpers manage browser cookies, while Download helpers facilitate file downloads to users.',
						'examples' => array(
							'// Cookie Helper functions
$this->load->helper("cookie");

set_cookie("name", "value", 3600);
get_cookie("name");
delete_cookie("name");

set_cookie(array(
    "name" => "user_id",
    "value" => 123,
    "expire" => 3600,
    "secure" => TRUE
));',
							'// Download Helper functions
$this->load->helper("download");

$data = file_get_contents("document.pdf");
force_download("document.pdf", $data);

// Download from file path
force_download("path/to/file.zip", NULL);'
						),
						'key_points' => array(
							'set_cookie(): Create browser cookies with options',
							'get_cookie(): Retrieve cookie values',
							'delete_cookie(): Remove cookies',
							'force_download(): Trigger file download dialog',
							'Cookies can store user preferences and authentication tokens'
						)
					),
					array(
						'number' => 8,
						'title' => 'Date and Number Helpers',
						'explanation' => 'Date helpers handle time and date operations, while Number helpers format numerical values for display.',
						'examples' => array(
							'// Date Helper functions
$this->load->helper("date");

now(); // Current UNIX timestamp
mdate("%Y-%m-%d", time()); // MySQL date format
human_time("2026-02-10"); // Relative time

timespan("time1", "time2");
days_in_month(2, 2026); // Days in month',
							'// Number Helper functions
$this->load->helper("number");

number_to_currency(1234.56, "USD");
number_to_byte(256000); // 250 KB
ordinal_number(21); // 21st
comma_number(1234567); // 1,234,567'
						),
						'key_points' => array(
							'now(): Get current UNIX timestamp',
							'mdate(): Format date like MySQL',
							'human_time(): Display relative time (2 hours ago)',
							'number_to_currency(): Format currency values',
							'comma_number(): Add commas to large numbers'
						)
					),
					array(
						'number' => 9,
						'title' => 'Creating Custom Libraries & Helpers',
						'explanation' => 'Extend CodeIgniter\'s functionality by creating custom libraries and helpers tailored to your application needs.',
						'examples' => array(
							'// application/libraries/MyCustomLibrary.php
class MyCustomLibrary {
    private $CI;
    
    function __construct() {
        $this->CI = &get_instance();
    }
    
    function process_data($data) {
        // Custom processing logic
        return $result;
    }
}

// Usage:
$this->load->library("MyCustomLibrary");
$this->mycustomlibrary->process_data($input);',
							'// application/helpers/my_custom_helper.php
if (!function_exists("my_function")) {
    function my_function($param) {
        // Custom function logic
        return $result;
    }
}

// Usage:
$this->load->helper("my_custom_helper");
my_function($value);'
						),
						'key_points' => array(
							'Custom libraries use class structure (OOP)',
							'Custom helpers use simple functions (procedural)',
							'Libraries access CI features via $CI reference',
							'Store custom libraries in application/libraries/',
							'Store custom helpers in application/helpers/',
							'Use naming conventions: MyClassName.php for libraries'
						)
					),
				)
			),
			array(
				'slug' => 'ci3-security-practices',
				'title' => 'CodeIgniter Security Practices',
				'description' => 'Learn about security vulnerabilities and how to protect your CodeIgniter applications',
				'duration' => '45 minutes',
				'slides' => array(
					array(
						'number' => 1,
						'title' => 'Web Security Overview',
						'explanation' => 'Security is critical for protecting user data and application integrity. Common vulnerabilities include SQL Injection, XSS, CSRF, and weak password handling. CodeIgniter provides built-in protection, but developers must follow best practices.',
						'examples' => array(
							'// VULNERABLE: No protection
$query = "SELECT * FROM users WHERE email = \'" . $email . "\'";

// SECURE: Query Builder auto-escapes
$user = $this->db->where("email", $email)
    ->get("users")
    ->row();',
							'// VULNERABLE: Direct output
echo $_GET["name"];

// SECURE: HTML escape output
echo htmlspecialchars($_GET["name"], ENT_QUOTES, "UTF-8");'
						),
						'key_points' => array(
							'Always assume user input is malicious',
							'Validate and sanitize all user input',
							'Use built-in CodeIgniter security features',
							'Keep frameworks and dependencies updated',
							'Test security regularly with vulnerability scanners',
							'Follow the principle of least privilege'
						)
					),
					array(
						'number' => 2,
						'title' => 'SQL Injection Vulnerability',
						'explanation' => 'SQL Injection occurs when attackers insert malicious SQL code into input fields. This can lead to unauthorized database access, data theft, or deletion. CodeIgniter\'s Query Builder protects against this by default.',
						'examples' => array(
							'// VULNERABLE: Raw SQL with concatenation
$email = $this->input->post("email");
$user = $this->db->query(
    "SELECT * FROM users WHERE email = \'" . $email . "\'"
);

// Attack: email = " OR 1=1 --',
							'// SECURE: Query Builder (parameterized)
$email = $this->input->post("email");
$user = $this->db->where("email", $email)
    ->get("users")
    ->row();

// SECURE: Using bind (for raw SQL)
$user = $this->db->query(
    "SELECT * FROM users WHERE email = ?",
    array($email)
)->row();'
						),
						'key_points' => array(
							'Never concatenate user input into SQL queries',
							'Always use Query Builder instead of raw SQL',
							'If using raw SQL, use parameterized queries with ? placeholders',
							'Use bind() method to bind values safely',
							'Test queries with malicious input: " OR 1=1 --',
							'Regular code review to catch vulnerable patterns'
						)
					),
					array(
						'number' => 3,
						'title' => 'Cross-Site Scripting (XSS) Vulnerability',
						'explanation' => 'XSS occurs when attacker-controlled data is displayed in HTML without escaping. This allows malicious JavaScript execution in users\' browsers, stealing cookies, sessions, or sensitive data.',
						'examples' => array(
							'// VULNERABLE: Unescaped output in view
<h1><?php echo $user_comment; ?></h1>

// Attacker injects: <script>alert("hacked")</script>',
							'// SECURE: Escape output
<h1><?php echo htmlspecialchars($user_comment, ENT_QUOTES, "UTF-8"); ?></h1>

// SECURE: Use esc() helper in views
<h1><?php echo esc($user_comment); ?></h1>

// SECURE: Store escaped in database
$safe_comment = htmlspecialchars($comment, ENT_QUOTES, "UTF-8");
$this->db->insert("comments", array("text" => $safe_comment));'
						),
						'key_points' => array(
							'Always escape output displayed in HTML',
							'Use htmlspecialchars() with ENT_QUOTES and UTF-8',
							'Use esc() helper function in CodeIgniter views',
							'Never trust user-submitted content',
							'Apply escaping at display time, not storage time',
							'Set Content Security Policy (CSP) headers'
						)
					),
					array(
						'number' => 4,
						'title' => 'Cross-Site Request Forgery (CSRF)',
						'explanation' => 'CSRF attacks trick users into performing unwanted actions. An attacker creates a form that, when visited by a logged-in user, submits requests on their behalf. CodeIgniter has built-in CSRF protection.',
						'examples' => array(
							'// Enable CSRF in config/config.php
$config["csrf_protection"] = TRUE;
$config["csrf_token_name"] = "csrf_test_name";
$config["csrf_cookie_name"] = "csrf_cookie_name";
$config["csrf_expire"] = 7200;

// In controller:
$data["csrf"] = array(
    "name" => $this->security->get_csrf_token_name(),
    "hash" => $this->security->get_csrf_hash()
);',
							'// In view form:
<?php echo form_open("dashboard/update"); ?>
    <input type="hidden" name="<?php echo $csrf["name"]; ?>" 
           value="<?php echo $csrf["hash"]; ?>">
    <input type="text" name="username">
    <button type="submit">Update</button>
<?php echo form_close(); ?>'
						),
						'key_points' => array(
							'Enable CSRF protection in config.php',
							'Include CSRF token in all forms',
							'CodeIgniter validates tokens automatically',
							'Tokens expire after configured time',
							'Use form_open() helper to auto-inject token',
							'Check for legitimate CSRF errors in logs'
						)
					),
					array(
						'number' => 5,
						'title' => 'Password Security',
						'explanation' => 'Weak password storage is a critical vulnerability. Never store plain text passwords. Use strong hashing algorithms like bcrypt or Argon2 with CodeIgniter.',
						'examples' => array(
							'// VULNERABLE: Storing plain text
$password = $this->input->post("password");
$this->db->insert("users", array(
    "email" => $email,
    "password" => $password  // Plain text!
));

// VULNERABLE: Using weak MD5
$password_hash = md5($password);',
							'// SECURE: Using password_hash (recommended)
$password = $this->input->post("password");
$hashed = password_hash($password, PASSWORD_BCRYPT, array(
    "cost" => 12  // Higher cost = more secure but slower
));
$this->db->insert("users", array(
    "email" => $email,
    "password" => $hashed
));

// Verify password:
if (password_verify($input_password, $stored_hash)) {
    // Password correct
}'
						),
						'key_points' => array(
							'Never store passwords in plain text',
							'Never use MD5 or SHA1 for password hashing',
							'Use password_hash() with PASSWORD_BCRYPT',
							'Use password_verify() to check passwords',
							'Set appropriate cost parameter (10-12)',
							'Enforce strong password requirements',
							'Implement login attempt rate limiting'
						)
					),
					array(
						'number' => 6,
						'title' => 'File Upload Security',
						'explanation' => 'File upload vulnerabilities allow attackers to upload malicious files. Validate file type, size, and store files outside web root when possible.',
						'examples' => array(
							'// VULNERABLE: No validation
if ($this->upload->do_upload("file")) {
    $file = $this->upload->data();
}

// VULNERABLE: Checking only extension
if (substr($filename, -4) == ".pdf") {
    // Not secure - extension can be spoofed
}',
							'// SECURE: Validate file type
$config["upload_path"] = "./uploads/";
$config["allowed_types"] = "pdf|doc|docx";
$config["max_size"] = 5120;  // 5MB
$config["file_name"] = time() . "_" . rand();

$this->load->library("upload", $config);
if (!$this->upload->do_upload("file")) {
    echo $this->upload->display_errors();
} else {
    $file = $this->upload->data();
    // File validated and uploaded
}'
						),
						'key_points' => array(
							'Always validate file type using MIME type, not extension',
							'Check file size before uploading',
							'Store uploaded files outside web root (application/files/)',
							'Rename uploaded files to prevent overwriting',
							'Set proper directory permissions (no execute)',
							'Disable script execution in upload directories',
							'Use CodeIgniter\'s Upload library for validation'
						)
					),
					array(
						'number' => 7,
						'title' => 'Session Security',
						'explanation' => 'Sessions store user authentication data. Protect sessions from hijacking, fixation, and other attacks by using secure configuration and HTTPS.',
						'examples' => array(
							'// Secure session configuration in config.php
$config["sess_driver"] = "database";
$config["sess_cookie_name"] = "ci_session";
$config["sess_samesite"] = "Strict";
$config["cookie_secure"] = TRUE;  // HTTPS only
$config["cookie_httponly"] = TRUE;  // No JavaScript access
$config["sess_match_ip"] = TRUE;  // Verify IP
$config["sess_match_useragent"] = TRUE;
$config["sess_time_to_update"] = 300;  // Regenerate',
							'// Regenerate session after login
public function login() {
    // Verify credentials
    if ($valid_user) {
        $this->session->sess_regenerate(FALSE);
        $this->session->set_userdata("user_id", $user_id);
    }
}

// Destroy session on logout
public function logout() {
    $this->session->sess_destroy();
    redirect("home");
}'
						),
						'key_points' => array(
							'Use database sessions instead of files',
							'Set cookie_httponly = TRUE to prevent JS access',
							'Set cookie_secure = TRUE to require HTTPS',
							'Set sess_match_ip = TRUE to verify IP address',
							'Regenerate session ID after login',
							'Destroy session completely on logout',
							'Use HTTPS to prevent session hijacking'
						)
					),
					array(
						'number' => 8,
						'title' => 'Input Validation & Sanitization',
						'explanation' => 'Validate all user input to ensure it matches expected format. Sanitization removes potentially harmful data. Use CodeIgniter\'s Form Validation library.',
						'examples' => array(
							'// VULNERABLE: No validation
$email = $this->input->post("email");
$age = $this->input->post("age");
$this->db->insert("users", array("email" => $email, "age" => $age));',
							'// SECURE: Validate and sanitize
$this->load->library("form_validation");
$this->form_validation->set_rules("email", "Email", 
    "required|valid_email|trim");
$this->form_validation->set_rules("age", "Age", 
    "required|integer|greater_than[0]|less_than[150]|trim");

if ($this->form_validation->run() == FALSE) {
    // Show validation errors
    echo validation_errors();
} else {
    $email = $this->input->post("email", TRUE);  // Sanitized
    $age = $this->input->post("age", TRUE);
    $this->db->insert("users", array("email" => $email, "age" => $age));
}'
						),
						'key_points' => array(
							'Use Form Validation library for structured validation',
							'Validate data type, length, and format',
							'Use second parameter TRUE in input->post() for sanitization',
							'Create custom validation rules for complex requirements',
							'Show generic errors to users (hide technical details)',
							'Log validation failures for security monitoring',
							'Validate on both client and server side'
						)
					),
					array(
						'number' => 9,
						'title' => 'Security Headers & HTTPS',
						'explanation' => 'HTTP security headers tell browsers how to handle content. HTTPS encrypts all communication. Implement both for comprehensive protection.',
						'examples' => array(
							'// Add security headers in application/core/MY_Controller.php
class MY_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
        
        // Force HTTPS
        if (empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] === "off") {
            redirect("https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        }
        
        // Security headers
        header("X-Content-Type-Options: nosniff");
        header("X-Frame-Options: SAMEORIGIN");
        header("X-XSS-Protection: 1; mode=block");
        header("Strict-Transport-Security: max-age=31536000");
        header("Content-Security-Policy: default-src \'self\'");
    }
}',
							'// In .htaccess
<IfModule mod_rewrite.c>
    # Force HTTPS
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
    
    # Remove X-Powered-By header
    Header always unset X-Powered-By
</IfModule>'
						),
						'key_points' => array(
							'X-Frame-Options: Prevent clickjacking attacks',
							'X-Content-Type-Options: Prevent MIME sniffing',
							'X-XSS-Protection: Enable browser XSS filters',
							'Strict-Transport-Security: Force HTTPS',
							'Content-Security-Policy: Control script sources',
							'Use SSL/TLS certificates from trusted providers',
							'Redirect all HTTP traffic to HTTPS'
						)
					),
					array(
						'number' => 10,
						'title' => 'Security Best Practices Checklist',
						'explanation' => 'Follow this comprehensive checklist to ensure your CodeIgniter application is secure. Regular audits and updates are essential.',
						'examples' => array(
							'// .env file for sensitive config (never commit to git)
DB_HOST=localhost
DB_USER=admin
DB_PASS=secure_password
ENCRYPTION_KEY=your_encryption_key

// application/config/database.php
$db["default"]["hostname"] = getenv("DB_HOST");
$db["default"]["username"] = getenv("DB_USER");
$db["default"]["password"] = getenv("DB_PASS");',
							'// Regular security checks
// 1. Run: composer update (update dependencies)
// 2. Check PHP version: PHP 7.4+ recommended
// 3. Disable debug mode in production
// 4. Use environment-specific configurations
// 5. Enable logging for security events
// 6. Test with OWASP ZAP or Burp Suite
// 7. Regular code review and penetration testing'
						),
						'key_points' => array(
							'Store sensitive config in .env file',
							'Never commit credentials to version control',
							'Keep PHP and dependencies updated',
							'Disable error display in production',
							'Enable comprehensive application logging',
							'Implement Web Application Firewall (WAF)',
							'Conduct regular security audits',
							'Use HTTPS with valid SSL certificates',
							'Implement rate limiting for API endpoints',
							'Monitor security advisories and CVEs'
						)
					),
				)
			),
			array(
				'slug' => 'calculator',
				'title' => 'Calculator Module',
				'description' => 'Standard and Scientific Calculator with real-time calculations and history tracking',
				'duration' => 'Interactive Tool',
				'slides' => array() // Calculator has no slides, it's an interactive tool
			),
		);
	}

	public function calculator()
	{
		$data = array(
			'name' => 'Mat Jerico Sergio',
		);

		$this->load->view('training/calculator', $data);
	}

}
