-- Populate portfolio tables with current data from Welcome controller

-- Insert Skills
INSERT INTO `skills` (`name`, `level`, `display_order`, `is_active`, `created_at`, `updated_at`) VALUES
('PHP & CodeIgniter', 95, 1, 1, NOW(), NOW()),
('Laravel Framework', 50, 2, 1, NOW(), NOW()),
('MySQL Database', 90, 3, 1, NOW(), NOW()),
('HTML/CSS & Responsive Design', 90, 4, 1, NOW(), NOW()),
('JavaScript & Front-end', 85, 5, 1, NOW(), NOW()),
('Git & Version Control', 90, 6, 1, NOW(), NOW()),
('Web Services API & OOP', 85, 7, 1, NOW(), NOW()),
('AI/LLM Integration (Gemini API)', 88, 8, 1, NOW(), NOW()),
('Agile PM & Six Sigma', 80, 9, 1, NOW(), NOW()),
('React & Next.js', 70, 10, 1, NOW(), NOW()),
('Bootstrap & jQuery', 95, 11, 1, NOW(), NOW());

-- Insert Experience
INSERT INTO `experience` (`position`, `company`, `location`, `duration`, `responsibilities`, `display_order`, `is_active`, `created_at`, `updated_at`) VALUES
('Management Information System Head', 'St. Dominic College of Asia', 'Bacoor, Calabarzon, Philippines', 'Aug 2024 - Present', 'Lead MIS operations and application development; own roadmaps and stakeholder alignment\nOversee PHP/CodeIgniter platforms, Web Services APIs, and OOP best practices\nDrive Agile project management and process improvements (Six Sigma)\nManage cross-functional teams and technical strategy for school administrative systems', 1, 1, NOW(), NOW()),
('System Analyst (Concurrent)', 'St. Dominic College of Asia', 'Bacoor, Calabarzon, Philippines', 'Aug 2024 - Present', 'Program and software system analysis for departmental tools and integrations\nTranslate business needs into clear technical specs and acceptance criteria\nCollaborate with stakeholders to gather requirements and define system architecture\nConduct feasibility studies and technical documentation', 2, 1, NOW(), NOW()),
('Business Development Application Lead', 'St. Dominic College of Asia', 'Bacoor, Calabarzon, Philippines', 'Feb 2024 - Aug 2024', 'Led cross-functional web development using the PHP MVC stack\nDesigned & implemented apps improving efficiency and UX for students, instructors, and staff\nOwned end-to-end lifecycles; met deadlines while upholding QA and security\nMaintained & optimized CodeIgniter (CI3) systems; reduced downtime and risk', 3, 1, NOW(), NOW()),
('Web Developer Engineer', 'St. Dominic College of Asia', 'Bacoor, Calabarzon, Philippines', 'Aug 2023 - Feb 2024', 'Developed responsive MVC web apps with PHP/CodeIgniter, MySQL, HTML/CSS, JavaScript\nVersion control and collaboration with Git; ensured content and UX quality\nImplemented secure and scalable solutions for school management systems\nMaintained code quality and documentation standards', 4, 1, NOW(), NOW()),
('Web Development Intern', 'St. Dominic College of Asia', 'Bacoor, Calabarzon, Philippines', 'Jul 2022 - Jul 2023', 'Built a web-based property management catalogue for the Property Management Office to streamline material requisition across departments\nApplied web dev/maintenance skills in a live environment (security, performance, reliability)\nHands-on with data management, networking, and information security fundamentals\nContinued maintaining and improving SDCA web systems', 5, 1, NOW(), NOW());

-- Insert Education
INSERT INTO `education` (`degree`, `school`, `location`, `year`, `honors`, `highlights`, `display_order`, `is_active`, `created_at`, `updated_at`) VALUES
('Bachelor of Science in Information Technology', 'St. Dominic College of Asia', 'St. Dominic Complex, Aguinaldo Hiway,Bacoor, Cavite, Philippines', '2018 - 2023', '', 'Specialized in Web Development and Database Management\nCompleted capstone project on Property Management System\nActive participant in web development workshops and seminars', 1, 1, NOW(), NOW()),
('Senior High School - ICT (Technical-Vocational-Livelihood Track)', 'STI College Bacoor', 'STI College Bacoor Bldg, Tirona Hwy, Bacoor 4102 Cavite', '2016 - 2018', '', 'IT in Mobile App and Web Development (ITMAWD) specialization\nBuilt iOS/Android apps and optimized content for mobile and web applications\nFocused on computer programming, scripting languages, and web/mobile development skills\nProgram Outcomes: design program logic, apply OOP skills, and web/mobile programming\nCompleted thesis project system Hotel Management System project using VB .NET and MySQL\nSpecialized Subjects: Java, HTML/CSS, JavaScript/jQuery, SQL/ASP.NET, Android, .NET', 2, 1, NOW(), NOW());

-- Insert Tech Stack
INSERT INTO `tech_stack` (`category`, `technologies`, `display_order`, `is_active`, `created_at`, `updated_at`) VALUES
('Backend/Web', 'CodeIgniter 3 (PHP), Laravel, MySQL', 1, 1, NOW(), NOW()),
('Frontend/UI', 'Bootstrap, jQuery, Chart.js, HTML5/CSS3', 2, 1, NOW(), NOW()),
('Modern Frontend (Learning)', 'React, JavaScript ES6+, Next.js', 3, 1, NOW(), NOW()),
('Desktop/Legacy', 'Microsoft Visual Studio (Windows apps), VB.NET', 4, 1, NOW(), NOW()),
('Tools & Practices', 'Git/GitHub, Web Services API, Agile PM, Six Sigma', 5, 1, NOW(), NOW());

-- Insert Projects
INSERT INTO `projects` (`slug`, `title`, `description`, `tech`, `image`, `featured_image`, `timeline`, `event`, `full_description`, `featured`, `is_training`, `display_order`, `is_active`, `created_at`, `updated_at`) VALUES
('dominican-forge', 'Dominican Forge', 'Gamified AI prompt engineering platform using Google Gemini API. Students crafted AI prompts to reveal hidden "cards" based on SDCA\'s history and cultural identity. Delivered during SDCA\'s 22nd Founding Anniversary (Nov 2024) with hundreds of student submissions across multiple events.', 'CodeIgniter 3, PHP, MySQL, Google Gemini API, Bootstrap, jQuery', 'assets/img/projects/DominicanForgeArticleFeature_Image.png', 'assets/img/projects/DominicanForgeArticleFeature_Image.png', 'Nov 2024', 'Founding Anniversary 2024', '**Overview:**\nDominican Forge is an innovative gamified AI prompt engineering platform built for SDCA\'s 22nd Founding Anniversary. Students engage with Google Gemini API to craft effective AI prompts that unlock hidden "cards" revealing the institution\'s rich history and cultural identity.\n\n**Technical Implementation:**\n- Built on CodeIgniter 3 framework with PHP and MySQL backend\n- Integrated Google Gemini API for AI-powered responses\n- Responsive UI with Bootstrap and jQuery for seamless student interaction\n- Real-time submission tracking and leaderboard system\n\n**Impact & Results:**\n- Hundreds of student submissions during the Founding Anniversary events\n- Innovative approach to teaching prompt engineering and AI literacy\n- Engaging way to connect students with institutional heritage\n- Successfully demonstrated practical AI integration in educational context', 1, 0, 1, 1, NOW(), NOW()),

('webdose-sis', 'WEBDOSE School Information System', 'Enterprise school information system serving Higher Education and Graduate Studies at SDCA. Manages student records, enrollment, grading, faculty assignments, curriculum, and generates official transcripts. Mission-critical platform used daily by Registrar, Program Chairs, Faculty, and Students.', 'CodeIgniter 3, PHP, MySQL, Bootstrap, jQuery, Chart.js', 'assets/img/projects/feature-webdose.JPG', 'assets/img/projects/feature-webdose.JPG', 'Aug 2023 - Present', 'Ongoing Development', '**Overview:**\nWEBDOSE (Web-Based Document and Student Enrollment System) is the primary school information system for SDCA\'s Higher Education and Graduate Studies programs. It serves as the central hub for all student lifecycle management.\n\n**Core Features:**\n- Student enrollment and registration workflows\n- Faculty assignment and load management\n- Grading system with automated computations\n- Curriculum management and course scheduling\n- Official transcript generation and records management\n- Real-time reporting dashboards for administrators\n\n**Technical Architecture:**\n- Built with CodeIgniter 3 MVC framework\n- MySQL database with normalized schema for academic data\n- Role-based access control (Registrar, Program Chairs, Faculty, Students)\n- Responsive Bootstrap interface for multi-device access\n- Chart.js visualizations for enrollment and performance analytics\n\n**Impact:**\n- Serves hundreds of students and dozens of faculty members daily\n- Reduced manual paperwork and administrative processing time\n- Centralized source of truth for academic records\n- Improved data accuracy and consistency across departments', 1, 0, 2, 1, NOW(), NOW()),

('canvas-lms-integration', 'Canvas LMS Data Importation Tool', 'Web-based tool for importing bulk student enrollment data into Canvas LMS. Streamlines the process of syncing SDCA student records with Canvas courses, reducing manual data entry and ensuring accuracy. Supports CSV batch imports with validation and error handling.', 'CodeIgniter 3, PHP, Canvas LMS API, MySQL, Bootstrap', 'assets/img/projects/feature-canvasconnect.JPG', 'assets/img/projects/feature-canvasconnect.JPG', 'Mar 2024 - May 2024', 'Canvas LMS Integration Project', '**Project Context:**\nSDCA adopted Canvas LMS for online learning, requiring efficient synchronization of student enrollment data between WEBDOSE and Canvas. Manual data entry was time-consuming and error-prone.\n\n**Solution:**\nDeveloped a web-based importation tool that bridges SDCA\'s internal systems with Canvas LMS API:\n- CSV batch upload with data validation\n- Automated enrollment creation in Canvas courses\n- Error detection and reporting for data quality issues\n- Rollback capability for failed imports\n- Activity logging for audit trail\n\n**Technical Implementation:**\n- Canvas REST API integration using OAuth authentication\n- PHP data processing with validation rules\n- MySQL temporary tables for import staging\n- Bootstrap interface for upload and monitoring\n- Background processing for large batch imports\n\n**Outcomes:**\n- Reduced enrollment processing time from hours to minutes\n- Eliminated manual data entry errors\n- Enabled seamless integration between internal SIS and Canvas LMS\n- Improved data consistency across platforms', 0, 0, 3, 1, NOW(), NOW()),

('queuing-system', 'Digital Queuing System', 'Digital queue management system for SDCA offices. Students and staff can join virtual queues via kiosk or mobile device, view real-time wait times, and receive notifications when their turn approaches. Reduces physical crowding and improves service efficiency.', 'CodeIgniter 3, PHP, MySQL, WebSockets, Bootstrap, jQuery', 'assets/img/projects/feature-QUEUEASE.JPG', 'assets/img/projects/feature-QUEUEASE.JPG', 'Jan 2024 - Feb 2024', 'Campus Services Modernization', '**Problem Statement:**\nSDCA offices (Registrar, Admissions, Finance) experienced long physical queues, especially during enrollment periods. Students faced uncertainty about wait times and crowded waiting areas.\n\n**Solution Features:**\n- Digital check-in via kiosk or mobile web interface\n- Real-time queue position display on TV monitors\n- SMS/web notifications when turn is approaching\n- Multi-counter support with queue routing\n- Analytics dashboard for office management\n\n**Technical Stack:**\n- CodeIgniter 3 backend with MySQL database\n- WebSockets for real-time queue updates\n- Responsive Bootstrap UI for multi-device support\n- jQuery for dynamic interface updates\n- SMS API integration for notifications\n\n**Benefits:**\n- Reduced physical crowding in office areas\n- Improved student satisfaction with transparent wait times\n- Increased service counter efficiency\n- Data-driven insights on peak hours and service times', 0, 0, 4, 1, NOW(), NOW()),

('property-management', 'Property Management System', 'Web-based inventory and requisition system for SDCA Property Management Office. Tracks institutional assets, manages material requisitions from departments, monitors stock levels, and generates inventory reports. Streamlines procurement workflows and maintains audit trails.', 'CodeIgniter 3, PHP, MySQL, Bootstrap, jQuery, Chart.js', 'assets/img/projects/feature-propertymanagementcatalogue.JPG', 'assets/img/projects/feature-propertymanagementcatalogue.JPG', 'Jul 2022 - Jul 2023', 'Capstone/Internship Project', '**Background:**\nDeveloped during my Web Development Internship (later became my capstone project), this system addresses the Property Management Office\'s need to digitize inventory tracking and requisition workflows.\n\n**Core Functionality:**\n- Asset inventory management with categories and locations\n- Material requisition workflow (request → approval → fulfillment)\n- Stock level monitoring with low-stock alerts\n- Department-wise requisition tracking\n- Inventory reports and audit trails\n- User roles: Admin, Property Officer, Department Heads\n\n**Technical Features:**\n- CodeIgniter 3 MVC architecture\n- MySQL database with relational schema for inventory data\n- Bootstrap responsive design for office and mobile use\n- Chart.js visualizations for inventory analytics\n- PDF report generation for official documentation\n\n**Project Outcomes:**\n- Successfully deployed and used by Property Management Office\n- Reduced paper-based requisition processing time\n- Improved inventory accuracy and accountability\n- Provided foundation for my web development career at SDCA', 0, 0, 5, 1, NOW(), NOW()),

('rfid-attendance', 'RFID Attendance System with Turnstile Integration', 'Automated attendance tracking system using RFID cards integrated with physical turnstiles. Students tap RFID cards to enter campus, automatically logging attendance. Provides real-time attendance monitoring for faculty, generates reports, and integrates with existing student information system.', 'CodeIgniter 3, PHP, MySQL, RFID Hardware Integration, WebSockets, Bootstrap', 'assets/img/projects/TURNSTILE ATTENDANCE SYSTEM/turnstile implementation.jpg', 'assets/img/projects/TURNSTILE ATTENDANCE SYSTEM/turnstile implementation.jpg', 'Sep 2023 - Dec 2023', 'Campus Security & Attendance Project', '**System Overview:**\nIntegrated hardware-software solution combining RFID turnstiles with web-based attendance management. Students use their ID cards (embedded with RFID chips) to enter campus, automatically recording attendance.\n\n**Technical Architecture:**\n- RFID reader hardware integration via serial communication\n- CodeIgniter 3 backend processing attendance logs\n- MySQL database for student records and attendance data\n- WebSockets for real-time attendance updates to dashboards\n- Bootstrap web interface for faculty and administrators\n\n**Key Features:**\n- Automatic attendance logging at turnstile entry points\n- Real-time attendance monitoring dashboards\n- Attendance reports by date, course, and student\n- Integration with student information system (WEBDOSE)\n- Late arrival tracking and notifications\n- Attendance analytics and trends visualization\n\n**Impact:**\n- Eliminated manual attendance taking, saving class time\n- Improved attendance accuracy and reduced disputes\n- Enhanced campus security with entry logging\n- Provided data for attendance-based interventions', 0, 0, 6, 1, NOW(), NOW()),

('webdiaris', 'WEBDIARIS Document Management System', 'Digital document routing and information system for SDCA administrative workflows. Facilitates electronic routing of official documents (memos, requests, approvals) across departments. Tracks document status, maintains version history, and provides audit trails for compliance.', 'CodeIgniter 3, PHP, MySQL, Bootstrap, jQuery, PDF.js', 'assets/img/projects/feature-WEBDIARIS.JPG', 'assets/img/projects/feature-WEBDIARIS.JPG', 'Jun 2024 - Aug 2024', 'Administrative Digital Transformation', '**Project Context:**\nSDCA administrative processes relied on physical document routing, causing delays and tracking difficulties. WEBDIARIS digitalizes document workflows for faster processing and better accountability.\n\n**System Features:**\n- Electronic document creation and upload\n- Multi-step approval workflows with routing rules\n- Document tracking (draft → pending → approved → archived)\n- Email notifications for pending actions\n- Version control for document revisions\n- Search and retrieval with filters\n- PDF viewer integration for inline document preview\n- Digital signatures for approvals\n\n**Technical Implementation:**\n- CodeIgniter 3 MVC framework\n- MySQL database with document metadata and workflow state\n- File storage with organized directory structure\n- PDF.js for client-side PDF rendering\n- Role-based permissions (Department Heads, Approvers, Staff)\n- Audit logging for compliance tracking\n\n**Benefits:**\n- Reduced document processing time from days to hours\n- Transparent tracking of document status\n- Eliminated lost or misplaced documents\n- Improved accountability with digital audit trails\n- Supported remote work during pandemic restrictions', 0, 0, 7, 1, NOW(), NOW()),

('training-module', 'CodeIgniter 3 Training Module', 'Interactive training module with 7 comprehensive modules covering CodeIgniter 3 development fundamentals. Includes 45 slides with code examples, live demos, and hands-on exercises. Covers MVC architecture, routing, controllers, views, models, database operations, and best practices.', 'CodeIgniter 3, PHP, HTML/CSS, JavaScript, Highlight.js', 'assets/img/projects/training-module.PNG', 'assets/img/projects/training-module.PNG', 'Jan 2024 - Feb 2024', 'Internal Training Initiative', '**Training Overview:**\nDeveloped as part of internal capacity building at SDCA, this comprehensive training module introduces web developers to CodeIgniter 3 framework fundamentals.\n\n**Training Structure:**\n- **Module 1:** Introduction to CodeIgniter 3 & MVC Architecture\n- **Module 2:** Routing & Controllers\n- **Module 3:** Views & Templates\n- **Module 4:** Models & Database Operations\n- **Module 5:** Form Validation & Security\n- **Module 6:** Libraries & Helpers\n- **Module 7:** Best Practices & Deployment\n\n**Technical Features:**\n- Interactive slide-based presentation system\n- Syntax-highlighted code examples using Highlight.js\n- Live demo sections with executable code\n- Navigation between modules and slides\n- Responsive design for desktop and tablet viewing\n\n**Content Highlights:**\n- 45 detailed slides across 7 modules\n- Real-world code examples from SDCA projects\n- Hands-on exercises with solutions\n- Best practices and common pitfalls\n- Deployment and security considerations\n\n**Impact:**\n- Used for onboarding new developers at SDCA\n- Reference material for team development standards\n- Foundation for consistent coding practices across projects', 1, 1, 8, 1, NOW(), NOW()),

('portfolio-ci3-training', 'Portfolio & Training System', 'This integrated portfolio and training platform showcasing projects and CodeIgniter 3 training modules. Features bidirectional navigation between portfolio and training sections, responsive design, and comprehensive project documentation. Serves as both a professional portfolio and educational resource.', 'CodeIgniter 3, PHP, MySQL, Bootstrap, jQuery, Highlight.js', 'assets/img/projects/portfolio-ci3-training.PNG', 'assets/img/projects/portfolio-ci3-training.PNG', 'Feb 2024 - Present', 'Portfolio Development', '**System Purpose:**\nCombined portfolio and training platform that serves dual purposes:\n1. Professional showcase of projects and experience\n2. Educational training resource for CodeIgniter 3 development\n\n**Portfolio Features:**\n- Comprehensive project showcase with detailed descriptions\n- Skills proficiency visualization\n- Work experience timeline\n- Education background\n- Technology stack overview\n- Contact information and social links\n\n**Training Module Integration:**\n- Seamless navigation between portfolio and training sections\n- 7 training modules with 45 slides\n- Interactive code examples\n- Syntax highlighting for code readability\n- Progress tracking through modules\n\n**Technical Implementation:**\n- CodeIgniter 3 MVC framework\n- MySQL database for dynamic content (via CMS)\n- Bootstrap 5 responsive design\n- jQuery for interactive elements\n- Highlight.js for code syntax highlighting\n- Clean URL routing for user-friendly navigation\n\n**CMS Integration:**\n- Admin panel for content management\n- Project CRUD operations\n- Skills, experience, education management\n- User authentication and activity logging\n- Image upload functionality\n\n**Benefits:**\n- Single platform for professional presence and knowledge sharing\n- Easy content updates through CMS\n- Mobile-responsive for all devices\n- SEO-friendly structure\n- Serves as live demonstration of CodeIgniter 3 capabilities', 1, 1, 9, 1, NOW(), NOW());

-- Insert Project Metrics
INSERT INTO `project_metrics` (`project_id`, `metric_label`, `metric_value`, `display_order`) VALUES
(1, 'Student Submissions', '400+', 1),
(1, 'Events Duration', '3 Days', 2),
(1, 'API Integration', 'Google Gemini', 3),
(2, 'Active Users', '500+', 1),
(2, 'Departments', '8', 2),
(2, 'Development Time', '18+ Months', 3),
(3, 'Import Speed', '1000+ records/min', 1),
(3, 'API Platform', 'Canvas LMS', 2),
(3, 'Error Rate', '<1%', 3),
(4, 'Daily Transactions', '200+', 1),
(4, 'Offices Supported', '5', 2),
(4, 'Wait Time Reduction', '40%', 3),
(5, 'Asset Records', '2000+', 1),
(5, 'Departments', '15', 2),
(5, 'Project Type', 'Capstone', 3),
(6, 'Daily Scans', '300+', 1),
(6, 'Turnstile Points', '4', 2),
(6, 'Accuracy Rate', '99.5%', 3),
(7, 'Document Types', '12', 1),
(7, 'Processing Time', '-60%', 2),
(7, 'Users', '50+', 3),
(8, 'Training Modules', '7', 1),
(8, 'Total Slides', '45', 2),
(8, 'Topics Covered', '15+', 3),
(9, 'Projects Showcased', '9', 1),
(9, 'CMS Features', 'Full CRUD', 2),
(9, 'Responsive Design', 'Mobile-First', 3);

-- Insert Project Highlights
INSERT INTO `project_highlights` (`project_id`, `highlight_text`, `display_order`) VALUES
(1, 'Google Gemini API integration for AI-powered prompt engineering', 1),
(1, 'Gamification mechanics with card collection system', 2),
(1, 'Real-time leaderboard and submission tracking', 3),
(1, 'Hundreds of student participants across 3-day event', 4),
(2, 'Mission-critical platform serving entire institution', 1),
(2, 'Comprehensive student lifecycle management', 2),
(2, 'Role-based access for multiple stakeholder types', 3),
(2, 'Official transcript generation and records management', 4),
(3, 'Batch CSV import with validation and error handling', 1),
(3, 'Canvas REST API OAuth authentication', 2),
(3, 'Background processing for large datasets', 3),
(3, 'Eliminated manual data entry errors', 4),
(4, 'Multi-device check-in (kiosk and mobile)', 1),
(4, 'Real-time queue updates via WebSockets', 2),
(4, 'SMS notifications for queue progression', 3),
(4, 'Analytics dashboard for service optimization', 4),
(5, 'Multi-step requisition approval workflow', 1),
(5, 'Low-stock alerts and inventory monitoring', 2),
(5, 'Department-wise tracking and reporting', 3),
(5, 'Successfully deployed as capstone project', 4),
(6, 'Hardware-software integration with RFID turnstiles', 1),
(6, 'Real-time attendance monitoring dashboards', 2),
(6, 'Integration with student information system', 3),
(6, '99.5% accuracy rate with automated tracking', 4),
(7, 'Multi-step approval workflow engine', 1),
(7, 'Version control for document revisions', 2),
(7, 'Digital signatures for compliance', 3),
(7, '60% reduction in processing time', 4),
(8, '7 comprehensive training modules', 1),
(8, '45 detailed slides with code examples', 2),
(8, 'Syntax-highlighted live demos', 3),
(8, 'Used for developer onboarding at SDCA', 4),
(9, 'Integrated portfolio and training platform', 1),
(9, 'Full CMS with authentication and CRUD operations', 2),
(9, 'Database-driven dynamic content management', 3),
(9, 'Responsive Bootstrap 5 design', 4);

-- Insert Project Images
INSERT INTO `project_images` (`project_id`, `image_path`, `caption`, `display_order`) VALUES
(1, 'assets/img/projects/DominicanForgeArticleFeature_Image.png', 'Dominican Forge AI prompt engineering platform', 1),
(2, 'assets/img/projects/feature-webdose.JPG', 'WEBDOSE School Information System dashboard', 1),
(3, 'assets/img/projects/feature-canvasconnect.JPG', 'Canvas LMS integration interface', 1),
(4, 'assets/img/projects/feature-QUEUEASE.JPG', 'Digital queuing system main interface', 1),
(4, 'assets/img/projects/feature-QUEUEASE-getqueue.JPG', 'Queue check-in interface', 2),
(4, 'assets/img/projects/feature-QUEUEASEview.JPG', 'Queue monitoring display', 3),
(5, 'assets/img/projects/feature-propertymanagementcatalogue.JPG', 'Property management system main interface', 1),
(5, 'assets/img/projects/feature-propertymanagementcatalogue-mrs.JPG', 'Material requisition system', 2),
(6, 'assets/img/projects/TURNSTILE ATTENDANCE SYSTEM/turnstile implementation.jpg', 'RFID turnstile entry point', 1),
(6, 'assets/img/projects/TURNSTILE ATTENDANCE SYSTEM/turnstile software.JPG', 'Attendance tracking software interface', 2),
(6, 'assets/img/projects/TURNSTILE ATTENDANCE SYSTEM/id-enrollment-system.JPG', 'ID card enrollment system', 3),
(6, 'assets/img/projects/TURNSTILE ATTENDANCE SYSTEM/student-attendance-report.JPG', 'Student attendance reports', 4),
(7, 'assets/img/projects/feature-WEBDIARIS.JPG', 'WEBDIARIS document routing system', 1),
(8, 'assets/img/projects/training-module.PNG', 'Training module overview', 1),
(8, 'assets/img/projects/training-module-detail.PNG', 'Training module detailed view', 2),
(9, 'assets/img/projects/portfolio-ci3-training.PNG', 'Portfolio and training platform', 1);
