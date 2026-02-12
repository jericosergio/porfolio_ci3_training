# User Management - Quick Reference Guide

## 🎯 Quick Links

### User Management Routes
```
GET  /cms/users                  → List all users
GET  /cms/user_form              → Create user form
POST /cms/user_form              → Save new user
GET  /cms/user_form/{id}         → Edit user form
POST /cms/user_form/{id}         → Update user
GET  /cms/user_delete/{id}       → Deactivate user (soft delete)
GET  /cms/change_password        → Change password form
POST /cms/change_password        → Update password
GET  /auth/logout                → Logout user
```

---

## 💻 Key Code Snippets

### Creating a User (Programmatically)
```php
$this->load->model('User_model');

$user_data = array(
    'username' => 'john_doe',
    'email' => 'john@example.com',
    'full_name' => 'John Doe',
    'password' => 'SecurePassword123',
    'role' => 'user',
    'is_active' => 1
);

$user_id = $this->User_model->create_user($user_data);
```

### Authenticating a User
```php
$user = $this->User_model->authenticate($username, $password);

if ($user) {
    // User authenticated successfully
    $session_data = array(
        'user_id' => $user->id,
        'username' => $user->username,
        'full_name' => $user->full_name,
        'email' => $user->email,
        'logged_in' => TRUE
    );
    $this->session->set_userdata($session_data);
} else {
    // Invalid credentials
}
```

### Getting User Information
```php
// By ID
$user = $this->User_model->get_by_id($user_id);

// By Username
$user = $this->User_model->get_by_username($username);

// All users
$users = $this->User_model->get_users();

// Active users only
$active_users = $this->User_model->get_active_users();
```

### Updating User
```php
$update_data = array(
    'email' => 'newemail@example.com',
    'full_name' => 'John Updated',
    'role' => 'admin'
);

$this->User_model->update_user($user_id, $update_data);
```

### Changing Password
```php
// Directly (for admin actions)
$this->User_model->change_password($user_id, $new_password);

// With verification (for user self-service)
$user = $this->User_model->get_by_id($user_id);
if (password_verify($old_password, $user->password)) {
    $this->User_model->change_password($user_id, $new_password);
}
```

### Deactivating User (Soft Delete)
```php
$this->User_model->soft_delete_user($user_id);
// Sets is_active = 0 instead of deleting
```

### Checking Username/Email Availability
```php
// Check if username exists
if ($this->User_model->username_exists('john_doe')) {
    echo "Username already taken";
}

// Check if email exists
if ($this->User_model->email_exists('john@example.com')) {
    echo "Email already in use";
}

// Exclude current user from check (useful in edit mode)
if ($this->User_model->username_exists('john_doe', $user_id)) {
    echo "Username taken by another user";
}
```

---

## 🔐 Password Handling

### Hashing a Password
```php
$hashed_password = password_hash($plain_password, PASSWORD_BCRYPT);
// Save $hashed_password to database

// This is done automatically in create_user() and change_password()
```

### Verifying a Password
```php
if (password_verify($user_input, $hashed_from_db)) {
    // Password is correct
}

// This is done automatically in authenticate()
```

---

## 📋 Form Validation Rules

### Creating User
```php
$this->form_validation->set_rules('username', 'Username', 'required|trim');
$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
$this->form_validation->set_rules('full_name', 'Full Name', 'required|trim');
$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'matches[password]');
```

### Editing User
```php
// Same as above, but password is optional
$this->form_validation->set_rules('password', 'Password', 'min_length[8]');
// Leave blank in edit to keep current password
```

### Changing Password
```php
$this->form_validation->set_rules('old_password', 'Current Password', 'required');
$this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]');
$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'matches[new_password]');
```

---

## 🎨 View Helper Functions

### In Views, Check If User is Logged In
```php
<?php if ($this->session->userdata('logged_in')): ?>
    <!-- User is logged in -->
<?php else: ?>
    <!-- User is not logged in -->
<?php endif; ?>
```

### Display Logged-In User Info
```php
<?php echo $this->session->userdata('full_name'); ?>
<?php echo $this->session->userdata('email'); ?>
<?php echo $this->session->userdata('username'); ?>
```

### Check User Role
```php
<?php if ($this->session->userdata('role') === 'admin'): ?>
    <!-- Admin-only content -->
<?php endif; ?>
```

### Display Form Errors
```php
<?php if (form_error('username')): ?>
    <div class="alert alert-danger">
        <?php echo form_error('username'); ?>
    </div>
<?php endif; ?>
```

### Display Success/Error Messages
```php
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php endif; ?>
```

---

## 🗄️ Database Queries

### Find User by ID
```sql
SELECT * FROM users WHERE id = ? AND is_active = 1;
```

### List All Users
```sql
SELECT * FROM users ORDER BY created_at DESC;
```

### Count Active Users
```sql
SELECT COUNT(*) as total FROM users WHERE is_active = 1;
```

### Find by Username
```sql
SELECT * FROM users WHERE username = ? AND is_active = 1;
```

### Get Recent Activity
```sql
SELECT * FROM activity_log 
WHERE table_name = 'users' 
ORDER BY created_at DESC 
LIMIT 50;
```

### Check for Duplicate Username
```sql
SELECT COUNT(*) FROM users WHERE username = ?;
```

---

## 🔍 Debugging Tips

### Check if User Model is Loaded
```php
// In controller
var_dump($this->User_model); // Should show User_model object

// Or check if method exists
if (method_exists($this->User_model, 'authenticate')) {
    echo "User_model is loaded correctly";
}
```

### Check Session Data
```php
// Print all session data
var_dump($this->session->all_userdata());

// Check specific session variable
var_dump($this->session->userdata('user_id'));
```

### Check Form Validation Errors
```php
// Get all validation errors
var_dump(validation_errors());

// Get specific field error
echo form_error('username');
```

### Check Database Connection
```php
// In any controller
$tables = $this->db->list_tables();
var_dump($tables); // Should include 'users'
```

### Log Debug Information
```php
// Add to controller
log_message('info', 'User login attempted for username: ' . $username);
log_message('error', 'Database error: ' . $this->db->error()['message']);

// Check logs in application/logs/
```

---

## 🚀 Common Tasks

### Task: Add a New User Programmatically
```php
public function add_initial_admin() {
    $admin_data = array(
        'username' => 'admin',
        'email' => 'admin@example.com',
        'full_name' => 'Administrator',
        'password' => 'SecurePassword123',
        'role' => 'admin',
        'is_active' => 1
    );
    
    $admin_id = $this->User_model->create_user($admin_data);
    echo "Admin user created with ID: " . $admin_id;
}
```

### Task: Reset a User's Password
```php
public function reset_user_password($user_id, $new_password) {
    if (!is_numeric($user_id) || strlen($new_password) < 8) {
        return FALSE;
    }
    
    return $this->User_model->change_password($user_id, $new_password);
}
```

### Task: Deactivate Inactive Users
```php
public function deactivate_inactive_users($days = 30) {
    $cutoff_date = date('Y-m-d H:i:s', strtotime("-$days days"));
    
    $this->db->where("last_login < '$cutoff_date' OR last_login IS NULL");
    $this->db->where('is_active', 1);
    
    $inactive_users = $this->db->get('users')->result_array();
    
    foreach ($inactive_users as $user) {
        $this->User_model->soft_delete_user($user['id']);
    }
    
    return count($inactive_users);
}
```

### Task: Bulk Import Users
```php
public function import_users_from_array($users_data) {
    $imported = 0;
    $errors = array();
    
    foreach ($users_data as $user_info) {
        try {
            // Validate data
            if (empty($user_info['username']) || empty($user_info['email'])) {
                $errors[] = "Row missing required fields";
                continue;
            }
            
            // Create user
            $this->User_model->create_user($user_info);
            $imported++;
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
    }
    
    return array('imported' => $imported, 'errors' => $errors);
}
```

---

## 📚 Related Files Reference

### Core Files
- **User Model**: `application/models/user_model.php`
- **CMS Controller**: `application/controllers/Cms.php`
- **Auth Controller**: `application/controllers/Auth.php`
- **Admin Controller**: `application/core/MY_Controller.php`

### Views
- **Header**: `application/views/cms/header.php`
- **Footer**: `application/views/cms/footer.php`
- **Users List**: `application/views/cms/users/list.php`
- **User Form**: `application/views/cms/users/form.php`
- **Change Password**: `application/views/cms/change_password.php`
- **Dashboard**: `application/views/cms/dashboard.php`

### Configuration
- **Database**: `application/config/database.php`
- **Session**: `application/config/config.php` (sess_* settings)

---

## ⚡ Performance Notes

### Database Indexes
Recommended indexes for optimal performance:
```sql
CREATE INDEX idx_username ON users(username);
CREATE INDEX idx_email ON users(email);
CREATE INDEX idx_is_active ON users(is_active);
```

### Query Optimization
- Always filter by `is_active = 1` when listing users
- Use indexed fields (username, email) for lookups
- Consider caching user data for frequently accessed users

### Session Storage
- File-based sessions: Default, works for small teams
- Database sessions: Better for scaling/load balancing
- Redis/Memcached: Best for high-traffic systems

---

## 🔗 Integration Examples

### With Existing Projects Management
```php
// In your projects view, show project creator
$project = $this->Project_model->get_by_id($project_id);
$creator = $this->User_model->get_by_id($project['created_by']);
echo "Created by: " . $creator->full_name;
```

### With Activity Logging
```php
// Already integrated in CMS controller
$this->log_activity('create', 'users', $new_user_id, 'Created user: ' . $username);
```

### With Email Notifications
```php
// When creating new user, send welcome email
$this->load->library('email');
$this->email->from('noreply@portfolio.com');
$this->email->to($email);
$this->email->subject('Welcome to Portfolio CMS');
$this->email->message("Your account has been created...");
$this->email->send();
```

---

## 📞 Support & Documentation

For more detailed information, see:
- `USER_MANAGEMENT_GUIDE.md` - Complete feature documentation
- `SETUP_CHECKLIST.md` - Installation and testing guide
- CodeIgniter 3 Documentation: https://codeigniter.com/user_guide/
- PHP Password Functions: https://www.php.net/manual/en/ref.password.php

---

**Last Updated**: Today
**Version**: 1.0
**Status**: Production Ready ✅
