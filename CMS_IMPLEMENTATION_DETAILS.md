# CMS Layout Implementation Details

## Architecture Overview

### Layout Structure

```
┌─────────────────────────────────────────────────────────┐
│                    NAVBAR (Fixed)                       │
│              Brand | Menu | User Dropdown               │
├──────────────────┬─────────────────────────────────────┤
│                  │                                     │
│    SIDEBAR       │          MAIN CONTENT               │
│   (Collapsible)  │       (Full Width Flexible)         │
│                  │                                     │
│  260px/80px      │                                     │
│  [Icon] [Text]   │      Dashboard / Forms / Tables    │
│                  │                                     │
│  [Toggle -]      │                                     │
├──────────────────┴─────────────────────────────────────┤
│                    FOOTER                              │
│              Scripts & Modals                          │
└─────────────────────────────────────────────────────────┘
```

## CSS Architecture

### Custom Properties (Variables)

Located in `header.php`:

```css
:root {
    --primary-color: #a12124;        /* Brand red */
    --dark-color: #343434;           /* Brand dark */
    --sidebar-width: 260px;          /* Normal sidebar */
    --sidebar-width-collapsed: 80px; /* Collapsed sidebar */
    --transition-speed: 0.3s;        /* Smooth transitions */
}
```

### Layout System

#### Body Styling
```css
body {
    margin: 0;
    padding: 0;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto;
    background: #f5f5f5;
    display: flex;
    flex-direction: column;
    height: 100vh;
}
```

#### Navbar
```css
.navbar {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1030;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
```

#### CMS Wrapper
```css
.cms-wrapper {
    display: flex;
    flex: 1;
    margin-top: 60px;  /* Below navbar */
    overflow: hidden;
}
```

#### Sidebar
```css
.sidebar {
    width: var(--sidebar-width);
    background: #fff;
    border-right: 1px solid #e0e0e0;
    padding: 20px 0;
    overflow-y: auto;
    transition: width var(--transition-speed) ease;
    flex-shrink: 0;
}

.sidebar.collapsed {
    width: var(--sidebar-width-collapsed);
}

.sidebar.collapsed .sidebar-label {
    display: none;  /* Hide text labels */
}

.sidebar.collapsed .sidebar-menu a span {
    display: none;  /* Hide text in menu */
}
```

#### Main Content Area
```css
.main-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.content-area {
    flex: 1;
    overflow-y: auto;
    padding: 20px 30px;
}
```

#### Footer
```css
.cms-footer {
    margin-left: var(--sidebar-width);
    transition: margin-left var(--transition-speed) ease;
}

.cms-footer.collapsed {
    margin-left: var(--sidebar-width-collapsed);
}
```

## Component Styling

### Navbar Components
```css
.navbar-brand {
    font-size: 1.3rem;
    font-weight: 600;
    color: white;
}

.nav-link {
    color: rgba(255,255,255,0.8);
    transition: color 0.3s ease;
}

.nav-link:hover {
    color: white;
}

.nav-link.active {
    color: white;
    border-bottom: 2px solid white;
}
```

### Sidebar Menu
```css
.sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-menu a {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: #555;
    text-decoration: none;
    transition: all 0.3s ease;
    gap: 12px;
}

.sidebar-menu a:hover {
    background: #f5f5f5;
    color: var(--primary-color);
}

.sidebar-menu a.active {
    background: var(--primary-color);
    color: white;
}
```

### Cards
```css
.card {
    border: none;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: box-shadow 0.3s ease;
}

.card:hover {
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
}

.card-header {
    border-bottom: 1px solid #e9ecef;
}

.card-header.bg-white {
    background-color: #fff !important;
}
```

### Stat Cards
```css
.stat-card {
    background: white;
    border: 1px solid #e0e0e0;
}

.stat-icon {
    font-size: 2.5rem;
    color: var(--primary-color);
    opacity: 0.1;
}

.stat-card:hover {
    border-color: var(--primary-color);
}
```

### Forms
```css
.form-label {
    font-weight: 500;
    color: #333;
    margin-bottom: 0.5rem;
}

.form-control, .form-select {
    border-radius: 4px;
    border: 1px solid #ddd;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(161,33,36,0.25);
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}
```

### Buttons
```css
.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: var(--dark-color);
    border-color: var(--dark-color);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(161,33,36,0.3);
}

.btn-sm {
    padding: 0.35rem 0.75rem;
    font-size: 0.875rem;
}
```

### Alerts
```css
.alert {
    border-radius: 4px;
    border: none;
    margin-bottom: 20px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
}
```

### Badges
```css
.badge {
    padding: 0.35em 0.65em;
    border-radius: 12px;
    font-size: 0.85em;
    font-weight: 500;
}

.badge.bg-success {
    background-color: #28a745 !important;
}

.badge.bg-warning {
    background-color: #ffc107 !important;
    color: #000;
}
```

### Tables
```css
.table {
    border-collapse: collapse;
    margin-bottom: 0;
}

.table thead th {
    border-bottom: 2px solid #dee2e6;
    font-weight: 600;
    color: #555;
    background-color: #f8f9fa;
}

.table tbody tr:hover {
    background-color: #f5f5f5;
}

.table td {
    vertical-align: middle;
    border-bottom: 1px solid #dee2e6;
}
```

## JavaScript Implementation

### Sidebar Toggle (in footer.php)

```javascript
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');
    const footer = document.getElementById('cmsFooter');

    // Load saved state from localStorage
    const isSidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
    if (isSidebarCollapsed) {
        sidebar.classList.add('collapsed');
        footer.classList.add('collapsed');
    }

    // Toggle sidebar on button click
    toggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');
        footer.classList.toggle('collapsed');
        
        // Save new state
        const isCollapsed = sidebar.classList.contains('collapsed');
        localStorage.setItem('sidebarCollapsed', isCollapsed);
    });

    // Mobile: Close sidebar on link click
    if (window.innerWidth < 768) {
        const sidebarLinks = document.querySelectorAll('.sidebar-menu a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 768) {
                    sidebar.classList.remove('show');
                }
            });
        });
    }

    // Auto-dismiss alerts
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
```

### Modal Confirmations

```javascript
// Delete confirmation (used in multiple pages)
function deleteItem(itemId, itemName, confirmUrl) {
    document.getElementById('deleteItemName').textContent = itemName;
    document.getElementById('deleteConfirmBtn').href = confirmUrl + itemId;
    
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}
```

### Form Validation

```javascript
// Bootstrap form validation
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
});
```

## Responsive Design Breakpoints

### Bootstrap Grid System
```
xs  < 576px (Mobile)
sm  ≥ 576px (Mobile landscape)
md  ≥ 768px (Tablet)
lg  ≥ 992px (Desktop)
xl  ≥ 1200px (Large desktop)
```

### CMS Specific
```
< 768px   : Tablet/Mobile - Single column layouts
≥ 768px   : Desktop - Multi-column layouts
≥ 1200px  : Large desktop - Full featured layouts
```

### Example Grid Layout
```html
<!-- This layout adapts across screen sizes -->
<div class="row g-3">
    <div class="col-12 col-lg-8">
        <!-- Full width on mobile, 8/12 on desktop -->
    </div>
    <div class="col-12 col-lg-4">
        <!-- Full width on mobile, 4/12 on desktop -->
    </div>
</div>
```

## File Dependencies

### Header.php
- Bootstrap 5.3.3 CSS
- Bootstrap Icons 1.11.3
- Custom CSS (embedded)
- No JS required (uses native APIs)

### Footer.php
- jQuery 3.7.1 (optional, for form handling)
- Bootstrap 5.3.3 JS Bundle
- Custom JavaScript (embedded)
- TOAST UI Editor (for rich text, if needed)

### Views
- header.php (always first)
- Page-specific content
- footer.php (always last)

## Performance Optimizations

### CSS
- CSS custom properties reduce duplication
- Single CSS block in header
- Minimal animations (0.3s transitions)
- Hardware acceleration with transform

### JavaScript
- Event delegation for sidebar toggle
- localStorage for state (no server calls)
- Auto-dismiss alerts use setTimeout
- Modals use Bootstrap native (no extra library)

### Layout
- Flexbox for efficient layout
- Fixed navbar doesn't cause repaints
- Sidebar toggle doesn't cause reflow (only width)
- Content area overflow handles scrolling

## Customization Guide

### Change Sidebar Width
Edit in header.php:
```css
--sidebar-width: 280px;           /* Wider sidebar */
--sidebar-width-collapsed: 70px;  /* Narrower icons */
```

### Change Colors
Edit in header.php:
```css
--primary-color: #003366;  /* Blue */
--dark-color: #001a33;     /* Dark blue */
```

### Change Transition Speed
Edit in header.php:
```css
transition: width 0.5s ease;  /* Slower animation */
```

### Add Animations
Use CSS to enhance transitions:
```css
.sidebar {
    transition: width 0.3s ease,
                background 0.3s ease,
                box-shadow 0.3s ease;
}
```

## Browser Compatibility

### Modern Features Used
- CSS Custom Properties (IE 11: Not supported)
- Flexbox Layout (IE 10+)
- Grid System (Bootstrap 5 requirement)
- localStorage API (All modern browsers)
- Bootstrap 5.3.3 (CSS framework)

### Fallbacks
- No JavaScript fallbacks (localStorage)
- CSS custom properties have no fallbacks
- Progressive enhancement not applicable

## Known Issues & Solutions

### Sidebar Not Persisting
**Cause**: localStorage disabled
**Fix**: Enable in browser settings or use private window

### Layout Breaking on Zoom
**Cause**: Zoom > 150% on small screens
**Fix**: Not a real issue, expected behavior

### Scrollbar Jump
**Cause**: Sidebar toggle causing reflow
**Fix**: Not critical, acceptable trade-off

### Modal Backdrop Issues
**Cause**: Z-index conflicts
**Fix**: Bootstrap modals have z-index 1050+

## Testing Checklist

- [ ] Sidebar toggle works
- [ ] State persists after refresh
- [ ] Mobile responsive (375px - 1920px)
- [ ] Forms validate correctly
- [ ] Modals appear and dismiss
- [ ] Alerts auto-dismiss
- [ ] No console errors
- [ ] No layout shifts
- [ ] Touch-friendly on mobile
- [ ] Keyboard navigation works
