<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');

	}

	public function index()
	{
		$this->portfolio();
	}

	public function project($slug = '')
	{
		if (empty($slug)) {
			redirect('portfolio');
		}

		

		// Get all projects data
		$all_projects = $this->get_projects_data();

		// Find the project by slug
		$project = null;
		foreach ($all_projects as $proj) {
			if ($proj['slug'] === $slug) {
				$project = $proj;
				break;
			}
		}

		if (!$project) {
			show_404();
		}

		$data = array(
			'name' => 'Mat Jerico Sergio',
			'project' => $project,
		);

		$this->load->view('project_detail', $data);
	}

	public function training()
	{
		$this->load->controller('Training');
		$this->Training->index();
	}

	public function portfolio()
	{
		$data = array(
			'name' => 'Mat Jerico Sergio',
			'tagline' => 'Web Development Engineer',
			'about' => 'Management Information System Head at St. Dominic College of Asia, leading application development and MIS operations for educational technology initiatives. With 3+ years of progressive experience, I build practical systems that serve Registrars, Finance/Treasury, Admissions, Program Chairs, Faculty, and students daily.

I steward mission-critical platforms including WEBDOSE (School Information System for Higher Education and Graduate Studies), RFID attendance with turnstile integration, Canvas LMS importation tools, and property management workflows. Recently developed Dominican Forge a gamified AI prompt engineering platform using Google Gemini API serving student attendies with hundreds of submissions during SDCA\'s 22nd Founding Anniversary.

My approach is objective-driven: understand stakeholder needs, trace existing data flows, leverage current platforms, and build what\'s missing on time. I deliver pragmatic, maintainable solutions using CodeIgniter 3, PHP, MySQL, Bootstrap, and jQuery, while integrating emerging technologies like AI/LLM APIs to drive digital transformation in education.',
			'email' => 'jericosergio2@gmail.com',
			'work_email' => 'mjsergio@sdca.edu.ph',
			'phone' => '+63 XXX XXX XXXX',
			'location' => 'Bacoor, Cavite, Philippines',
			'github' => 'https://github.com/jericosergio',
			'linkedin' => 'https://www.linkedin.com/in/jrcsrg',
			'skills' => array(
				array('name' => 'PHP & CodeIgniter', 'level' => 95),
				array('name' => 'Laravel Framework', 'level' => 50),
				array('name' => 'MySQL Database', 'level' => 90),
				array('name' => 'HTML/CSS & Responsive Design', 'level' => 90),
				array('name' => 'JavaScript & Front-end', 'level' => 85),
				array('name' => 'Git & Version Control', 'level' => 90),
				array('name' => 'Web Services API & OOP', 'level' => 85),
				array('name' => 'AI/LLM Integration (Gemini API)', 'level' => 88),
				array('name' => 'Agile PM & Six Sigma', 'level' => 80),
				array('name' => 'React & Next.js', 'level' => 70),
				array('name' => 'Bootstrap & jQuery', 'level' => 95),
			),
			'experience' => array(
				array(
					'position' => 'Management Information System Head',
					'company' => 'St. Dominic College of Asia',
					'location' => 'Bacoor, Calabarzon, Philippines',
					'duration' => 'Aug 2024 - Present',
					'responsibilities' => array(
						'Lead MIS operations and application development; own roadmaps and stakeholder alignment',
						'Oversee PHP/CodeIgniter platforms, Web Services APIs, and OOP best practices',
						'Drive Agile project management and process improvements (Six Sigma)',
						'Manage cross-functional teams and technical strategy for school administrative systems'
					)
				),
				array(
					'position' => 'System Analyst (Concurrent)',
					'company' => 'St. Dominic College of Asia',
					'location' => 'Bacoor, Calabarzon, Philippines',
					'duration' => 'Aug 2024 - Present',
					'responsibilities' => array(
						'Program and software system analysis for departmental tools and integrations',
						'Translate business needs into clear technical specs and acceptance criteria',
						'Collaborate with stakeholders to gather requirements and define system architecture',
						'Conduct feasibility studies and technical documentation'
					)
				),
				array(
					'position' => 'Business Development Application Lead',
					'company' => 'St. Dominic College of Asia',
					'location' => 'Bacoor, Calabarzon, Philippines',
					'duration' => 'Feb 2024 - Aug 2024',
					'responsibilities' => array(
						'Led cross-functional web development using the PHP MVC stack',
						'Designed & implemented apps improving efficiency and UX for students, instructors, and staff',
						'Owned end-to-end lifecycles; met deadlines while upholding QA and security',
						'Maintained & optimized CodeIgniter (CI3) systems; reduced downtime and risk'
					)
				),
				array(
					'position' => 'Web Developer Engineer',
					'company' => 'St. Dominic College of Asia',
					'location' => 'Bacoor, Calabarzon, Philippines',
					'duration' => 'Aug 2023 - Feb 2024',
					'responsibilities' => array(
						'Developed responsive MVC web apps with PHP/CodeIgniter, MySQL, HTML/CSS, JavaScript',
						'Version control and collaboration with Git; ensured content and UX quality',
						'Implemented secure and scalable solutions for school management systems',
						'Maintained code quality and documentation standards'
					)
				),
				array(
					'position' => 'Web Development Intern',
					'company' => 'St. Dominic College of Asia',
					'location' => 'Bacoor, Calabarzon, Philippines',
					'duration' => 'Jul 2022 - Jul 2023',
					'responsibilities' => array(
						'Built a web-based property management catalogue for the Property Management Office to streamline material requisition across departments',
						'Applied web dev/maintenance skills in a live environment (security, performance, reliability)',
						'Hands-on with data management, networking, and information security fundamentals',
						'Continued maintaining and improving SDCA web systems'
					)
				),
			),
			'education' => array(
				array(
					'degree' => 'Bachelor of Science in Information Technology',
					'school' => 'St. Dominic College of Asia',
					'location' => 'St. Dominic Complex, Aguinaldo Hiway,Bacoor, Cavite, Philippines',
					'year' => '2018 - 2023',
					'honors' => '',
					'highlights' => array(
						'Specialized in Web Development and Database Management',
						'Completed capstone project on Property Management System',
						'Active participant in web development workshops and seminars'
					)
				),
				array(
					'degree' => 'Senior High School - ICT (Technical-Vocational-Livelihood Track)',
					'school' => 'STI College Bacoor',
					'location' => 'STI College Bacoor Bldg, Tirona Hwy, Bacoor 4102 Cavite',
					'year' => '2016 - 2018',
					'honors' => '',
					'highlights' => array(
						'IT in Mobile App and Web Development (ITMAWD) specialization',
						'Built iOS/Android apps and optimized content for mobile and web applications',
						'Focused on computer programming, scripting languages, and web/mobile development skills',
						'Program Outcomes: design program logic, apply OOP skills, and web/mobile programming',
						'Completed thesis project system Hotel Management System project using VB .NET and MySQL',
						'Specialized Subjects: Java, HTML/CSS, JavaScript/jQuery, SQL/ASP.NET, Android, .NET',
					)
				),

			),

		'aspirations' => 'Continue growing as a technical leader and software engineer, building systems that solve real problems for real people. Passionate about learning modern technologies while maintaining deep expertise in proven tools. Committed to mentoring others, driving digital transformation, and creating software that makes a meaningful impact.',
		'tech_stack' => array(
			'Backend/Web' => 'CodeIgniter 3 (PHP), Laravel, MySQL',
				'Frontend/UI' => 'Bootstrap, jQuery, Chart.js, HTML5/CSS3',
				'Modern Frontend (Learning)' => 'React, JavaScript ES6+, Next.js',
				'Desktop/Legacy' => 'Microsoft Visual Studio (Windows apps), VB.NET',
				'Tools & Practices' => 'Git/GitHub, Web Services API, Agile PM, Six Sigma'
			),
			'clients_stakeholders' => 'Registrar, Admissions Office, Program Chairs/Deans, Faculty, Students—the day-to-day users I build for and support.',
			'projects' => $this->get_projects_data(),
		);

		$this->load->view('portfolio', $data);
	}



	private function get_projects_data()
	{
		return array(
			array(
				'slug' => 'dominican-forge',
				'title' => 'Dominican Forge - LLM Prompt Engineering Challenge Platform',
				'description' => 'Gamified AI education platform built for SDCA\'s 22nd Founding Anniversary. Features dual-AI evaluation system, real-time leaderboards, anti-cheat measures, and prompt injection defense. Served 500+ students with 2,400+ submissions during "How to Train Your AI" exhibit.',
				'tech' => 'CodeIgniter 3, Google Gemini API, MySQL 8.0, Bootstrap 5, jQuery, Chart.js',
				'image' => base_url('/assets/projects/DominicanForgeArticleFeature_Image.png'),
				'featured' => true,
				'metrics' => array(
					'Users' => '100+ students',
					'Submissions' => '300+',
					'Uptime' => '99.8%',
					'Avg Response' => '1.2-1.8s'
				),
				'highlights' => array(
					'Dual-AI evaluation system with sophisticated scoring algorithm',
					'Multi-factor scoring (keywords, constraints, quality, speed)',
					'Advanced prompt injection defense with pattern detection',
					'Real-time leaderboards with tier system and program rankings',
					'Automated certificate generation and email distribution'
				),
				'timeline' => 'Oct 13 - Nov 26, 2025 (6 weeks)',
				'event' => 'ICT Department Exhibit | 22nd Founding Anniversary',
				'full_description' => 'Dominican Forge is a full-stack web application that transforms prompt engineering education into an interactive challenge system. Built in just 6 weeks for St. Dominic College of Asia\'s 22nd Founding Anniversary, the platform served as the centerpiece for "How to Train Your AI" exhibit.

**The Challenge:**

How do you teach prompt engineering interactively in a way that\'s educational, measurable, genuinely engaging, and demo-ready? The answer was Dominican Forge-a competitive, gamified platform where students learn by doing, racing against the clock to craft prompts that make Google\'s Gemini AI produce specific outputs while meeting hidden constraints.

**Technical Architecture:**

The platform features a sophisticated dual-AI evaluation system. First, the student\'s prompt generates an AI response through Gemini API. Then, a separate AI grader assesses quality on a 0-10 scale with detailed reasoning. This separation prevents students from gaming the system.

**Multi-Factor Scoring:**

The scoring algorithm evaluates submissions across multiple dimensions-keyword matching (400 pts), constraint adherence (300 pts), prompt quality (200 pts), negative constraints (100 pts), plus multipliers for AI quality assessment, speed bonuses, time penalties, and cross-program challenges.

**Security & Defense:**

One of the most fascinating challenges was defending against prompt injection attacks where clever students try to manipulate the AI system itself. The platform implements pattern detection for instruction overrides, prompt leakage attempts, role manipulation, constraint bypass, and encoding tricks-each with risk scoring that rejects malicious submissions before hitting the API.

**Real-Time Competition:**

Features include global rankings, daily leaders, program-specific leaderboards, speed forgers category, and a tier system (Initiate â†’ Forge Master). Performance optimization uses MySQL window functions with strategic caching for 10-minute TTL on leaderboard data.

**Impact:**

During the November 26, 2025 event at DRA Hall, the platform processed 2,400+ submissions with 99.8% API success rate, zero downtime, and an average API response time of 1.2-1.8s for dual-call evaluation. Students gained practical understanding of prompt engineering principles through competitive gameplay rather than traditional lectures.',
			),
			array(
				'slug' => 'webdose-sis',
				'title' => 'WEBDOSE - School Information System (SIS)',
				'description' => 'Stewarded comprehensive SIS for Higher Education, Graduate Studies, and School of Medicine. Maintained the majority of school web systems and now manage new experimental systems to help offices and stakeholders.',
				'tech' => 'CodeIgniter 3, MySQL, Bootstrap, jQuery, Chart.js',
				'image' => base_url('assets/projects/feature-webdose.JPG'),
				'full_description' => 'WEBDOSE is the mission-critical School Information System serving Higher Education, Graduate Studies, and School of Medicine at St. Dominic College of Asia. As the primary steward, I maintain and enhance this comprehensive platform that powers daily operations for registrars, admissions, program chairs, faculty, and students.

**Scope & Responsibilities:**

The system handles student enrollment, grade management, scheduling, faculty administration, and academic records. I manage the majority of school web systems and continuously develop new experimental features to improve office workflows and stakeholder visibility.

**Technical Foundation:**

Built on CodeIgniter 3 with MySQL database backend, the platform uses Bootstrap for responsive UI, jQuery for client interactions, and Chart.js for data visualizations and reporting dashboards.

**Impact:**

WEBDOSE serves as the central hub for academic administration, processing thousands of transactions daily and maintaining critical student data with high availability and security standards.',
			),
			array(
				'slug' => 'canvas-lms-integration',
				'title' => 'Canvas LMS Integration - SIS Importation Tool',
				'description' => 'Built an export tool that extracts vital SIS data to CSV for Canvas upload, streamlining course/user provisioning. Enables seamless integration between school SIS and Canvas Learning Management System.',
				'tech' => 'PHP, CodeIgniter 3, CSV Export, Canvas LMS API',
				'image' => base_url('assets/projects/feature-canvasconnect.JPG'),
				'full_description' => 'The Canvas LMS Integration tool bridges St. Dominic College of Asia\'s internal Student Information System with Canvas Learning Management System, automating the tedious process of course and user provisioning.

**The Problem:**

Manually uploading student enrollments, course rosters, and user accounts to Canvas was time-consuming and error-prone, especially during peak enrollment periods.

**The Solution:**

Built an automated export tool that extracts vital SIS data-student information, course enrollments, faculty assignments, and program details-and formats it into Canvas-compatible CSV files ready for bulk import.

**Technical Implementation:**

Developed using CodeIgniter 3 and PHP, the tool queries the MySQL SIS database, applies data transformation logic to match Canvas requirements, validates data integrity, and generates properly formatted CSV exports.

**Impact:**

Dramatically reduced manual data entry time during semester setup, minimized enrollment errors, and enabled smoother integration between SDCA\'s internal systems and the Canvas learning platform.',
			),
			array(
				'slug' => 'queuing-system',
				'title' => 'Queuing System (Cashier)',
				'description' => 'Implemented a queuing workflow tailored for cashier operations for smoother front-desk handling, reporting and advertisement. Improves student experience and operational efficiency.',
				'tech' => 'CodeIgniter 3, MySQL, Real-time Updates, Bootstrap',
				'featured_image' => base_url('assets/projects/feature-QUEUEASE.JPG'),
				'images' => array(
					base_url('assets/projects/feature-QUEUEASEview.JPG'),
					base_url('assets/projects/feature-QUEUEASE-getqueue.JPG'),
				),
				'full_description' => 'A digital queuing system designed specifically for cashier operations at St. Dominic College of Asia, improving front-desk efficiency and student experience during peak payment periods.

**Key Features:**

- Real-time queue management with ticket generation
- Digital display for called ticket numbers
- Cashier dashboard for managing serving windows
- Queue analytics and reporting capabilities
- Advertisement display during student waiting time

**Technical Stack:**

Built with CodeIgniter 3 and MySQL for backend operations, the system uses real-time updates via AJAX polling and Bootstrap for responsive frontend design across different display sizes.

**Impact:**

Streamlined cashier operations, reduced perceived wait times through organized queuing, provided management with operational metrics, and improved overall student satisfaction during payment processing.',
			),
			array(
				'slug' => 'property-management',
				'title' => 'Property Management w/ Inventory',
				'description' => 'Developed an end-to-end workflow for the Property Management Office, including inventory tracking aligned to their process. Streamlines material requisition across departments.',
				'tech' => 'CodeIgniter 3, MySQL, Bootstrap, JavaScript',
				'featured_image' => base_url('assets/projects/feature-propertymanagementcatalogue-mrs.JPG'),
				'images' => array(
					base_url('assets/projects/feature-propertymanagementcatalogue-mrs.JPG'),
					base_url('assets/projects/feature-propertymanagementcatalogue.JPG'),
				),
				'full_description' => 'A comprehensive property management catalogue system developed for the Property Management Office to streamline material requisition workflows across all departments at St. Dominic College of Asia.

**System Capabilities:**

- Complete inventory tracking of institutional property and materials
- Requisition workflow management with approval chains
- Department-based requisition submission
- Real-time inventory status and availability checks
- Reporting and analytics for resource allocation

**Development Context:**

Initially built during my Web Development Internship as a capstone-style project, the system addressed real operational challenges in tracking and distributing institutional resources efficiently.

**Technical Implementation:**

Developed using CodeIgniter 3 MVC framework with MySQL database, Bootstrap for UI components, and JavaScript for interactive inventory management features.

**Impact:**

Digitized previously manual requisition processes, provided transparency in resource allocation, reduced processing time for material requests, and gave management better visibility into institutional asset utilization.',
			),
			array(
				'slug' => 'rfid-attendance',
				'title' => 'RFID Attendance + Turnstile Integration',
				'description' => 'Delivered an RFID-based Attendance Management System integrated with turnstiles, designed for reliable, fast access control. Real-time monitoring and reporting capabilities.',
				'tech' => 'VB.NET Framework, API Integration, CodeIgniter 3, RFID Hardware, MySQL, Real-time Processing',
				'image' => base_url('assets/projects/TURNSTILE%20ATTENDANCE%20SYSTEM/turnstile%20software.JPG'),
				'featured_image' => base_url('assets/projects/TURNSTILE%20ATTENDANCE%20SYSTEM/turnstile%20software.JPG'),
				'images' => array(
					base_url('assets/projects/TURNSTILE%20ATTENDANCE%20SYSTEM/turnstile%20software.JPG'),
					base_url('assets/projects/TURNSTILE%20ATTENDANCE%20SYSTEM/turnstile%20implementation.jpg'),
					base_url('assets/projects/TURNSTILE%20ATTENDANCE%20SYSTEM/id-enrollment-system.JPG'),
					base_url('assets/projects/TURNSTILE%20ATTENDANCE%20SYSTEM/student-attendance-report.JPG'),

				),
				'full_description' => 'An RFID-based attendance management system integrated with physical turnstiles for automated, reliable access control and attendance tracking at St. Dominic College of Asia.

**System Overview:**

The platform combines RFID card readers, turnstile hardware, and custom software across multiple technology stacks to create a seamless attendance and access control solution for students and faculty.

**Key Features:**

- Real-time RFID card scanning and validation
- Automated attendance logging tied to physical access
- Turnstile integration for controlled entry/exit
- Live monitoring dashboard for security and administration
- Comprehensive attendance reports and analytics
- Alert system for unauthorized access attempts

**Technical Architecture:**

**Windows Application (Turnstile Control):**

The main turnstile application is built using VB.NET Framework as a Windows desktop application. This application handles real-time control of each individual turnstile gate, processing RFID card scans and managing gate opening/closing logic with precision timing.

The application communicates with KMtronic USB relay modules to send electrical signals to the turnstile motor gates. Based on the RFID validation result and entrance/exit status, the application implements intelligent logic to determine whether to activate the relay signal-opening the gate for authorized entry, blocking unauthorized access, or managing exit-only scenarios with appropriate gate control.

**API Layer:**

A dedicated API created for this application serves as the bridge between the turnstile application and the backend system. The API is responsible for:
- Fetching student information from the database
- Validating RFID card credentials against enrolled students
- Logging attendance records in real-time as gates are triggered
- Communicating gate control signals to the Windows application

**Web-Based Administration:**

The WEBDOSE module handles student RFID card registration, attendance report generation, and administrative functions. This allows staff to manage the RFID database and access historical attendance data through a web interface while the Windows application handles the physical gate operations.

**Maintenance & Enhancement:**

Actively maintain legacy DOSE biometrics attendance and RFID turnstile systems, implementing fixes and enhancements to keep critical access control infrastructure running smoothly.

**Impact:**

Provided fast, reliable attendance tracking, improved campus security through automated access control, reduced manual attendance monitoring workload, and generated accurate attendance data for academic and administrative purposes.',
			),
			array(
				'slug' => 'webdiaris',
				'title' => 'WEBDIARIS (K-12 SIS) - Early Development',
				'description' => 'Contributed to early development for the Basic Education Department (BED) Student Information System. Building modern, scalable solution for K-12 administration.',
				'tech' => 'CodeIgniter 3, MySQL, Bootstrap, Modern UI/UX',
				'image' => base_url('assets/projects/feature-WEBDIARIS.JPG'),
				'full_description' => 'WEBDIARIS is a Student Information System specifically designed for the Basic Education Department (K-12) at St. Dominic College of Asia, built from the ground up to meet the unique needs of elementary and secondary education administration.

**Project Scope:**
Contributed to early development phase, working on foundational architecture, database design, and core modules for student management, grading, attendance, and parent communication features.

**Technical Approach:**
Leveraging experience from WEBDOSE (Higher Ed SIS), the system is built with CodeIgniter 3 and MySQL, focusing on modern UI/UX principles to make the platform intuitive for teachers, administrators, and parents who interact with K-12 systems differently than higher education users.

**Development Focus:**
Creating a scalable, maintainable solution that can grow with the Basic Education Department\'s needs while maintaining separation of concerns from the Higher Education systems.

**Current Status:**
Early development phase with ongoing contributions to establish core functionality and system architecture that will support future expansion of BED administrative capabilities.',
			),
			array(
				'slug' => 'training-module',
				'title' => 'CodeIgniter 3 Training Module - Comprehensive Developer Guide',
				'description' => '4+ hour interactive training system covering PHP fundamentals, CodeIgniter 3 basics, MySQL queries, Query Builder, libraries, helpers, security practices, and development environment setup. Features zoom controls, syntax highlighting, keyboard navigation, and comprehensive code examples.',
				'tech' => 'CodeIgniter 3, Bootstrap 5.3, Highlight.js, JavaScript, MySQL',
				'image' => base_url('assets/projects/training-module.png'),
				'is_training' => true,
				'metrics' => array(
					'Total Duration' => '4 hours 20 minutes',
					'Modules' => '7 comprehensive',
					'Total Slides' => '45',
					'Code Examples' => '100+',
					'Features' => 'Zoom, Syntax Highlighting'
				),
				'highlights' => array(
					'7 comprehensive modules covering PHP to security practices',
					'Interactive slide viewer with zoom controls (50%-150%)',
					'Professional syntax highlighting with VS2015 theme',
					'Keyboard navigation and shortcuts support',
					'100+ code examples with proper indentation',
					'Development environment setup guide with verified download links'
				),
				'timeline' => 'Self-paced learning',
				'full_description' => 'A comprehensive training system designed to teach CodeIgniter 3 development from fundamentals to advanced practices. Perfect for new developers, trainees, and anyone learning modern web development with CodeIgniter 3 and PHP.

**Project Purpose & Intended Use:**

The CodeIgniter 3 Training Module was developed with three primary objectives:

1. **Onboarding New Developers:** Provide a structured, self-paced learning path for trainees joining the MIS development team. The module eliminates guesswork about what needs to be learned first and establishes a common knowledge baseline across the team.

2. **Knowledge Documentation:** Create permanent, searchable documentation of CodeIgniter 3 best practices, security considerations, and development patterns used at St. Dominic College of Asia. This becomes a reference resource for the entire development team.

3. **Skill Standardization:** Ensure consistent coding practices, security awareness, and architectural understanding across all projects and team members, reducing technical debt and improving code quality long-term.

**Module Structure:**

1. **PHP Fundamentals** (40 min, 7 slides) - Variables, data types, arrays, objects, classes, OOP concepts
2. **Development Environment Setup** (30 min, 8 slides) - XAMPP, Git, Composer, VSCode, HeidiSQL installation and verification
3. **CodeIgniter 3 Basics** (40 min, 7 slides) - MVC architecture, file structure, controllers, views, models
4. **MySQL Queries Essentials** (30 min, 7 slides) - SELECT, INSERT, UPDATE, DELETE, JOIN operations, soft vs hard deletes
5. **CodeIgniter Query Builder** (40 min, 9 slides) - Building queries, result methods, transactions, best practices
6. **CI3 Libraries & Helpers** (35 min, 9 slides) - Built-in libraries, custom libraries, form/URL/text helpers
7. **CodeIgniter Security Practices** (45 min, 10 slides) - SQL injection, XSS, CSRF, password security, input validation

**Features:**

- **Interactive Zoom Control:** Adjust slide content from 50% to 150% with keyboard shortcuts (Ctrl++ / Ctrl+-)
- **Syntax Highlighting:** Professional code display using Highlight.js with VS2015 dark theme
- **Responsive Design:** Works seamlessly on desktop and mobile devices
- **Keyboard Navigation:** Arrow keys, spacebar, and shortcuts for efficient learning
- **Module Header:** Clear module title and progress tracking
- **Code Examples:** 100+ real-world code snippets with proper indentation and syntax highlighting

**Learning Outcomes:**

By completing this training, you will understand:
- PHP language fundamentals and object-oriented programming
- CodeIgniter 3 architecture and best practices
- Database design and SQL query optimization
- Security vulnerabilities and prevention techniques
- Development environment setup and tools
- Professional code organization and conventions',
			),
			array(
				'slug' => 'portfolio-ci3-training',
				'title' => 'Portfolio CI3 Training System — Integrated Learning Platform',
				'description' => 'Full-stack integrated system combining professional portfolio showcase with interactive CodeIgniter 3 training modules. Seamlessly connects portfolio projects with comprehensive developer training, enabling visitors to learn from real-world applications.',
				'tech' => 'CodeIgniter 3, Bootstrap 5.3, Highlight.js, jQuery, MySQL, PHP 7.4',
				'image' => base_url('assets/projects/portfolio-ci3-training.png'),
				'featured' => false,
				'metrics' => array(
					'Portfolio Projects' => '5 professional',
					'Training Modules' => '7 comprehensive',
					'Total Content' => '45+ slides',
					'Code Examples' => '100+',
					'Learning Hours' => '4+ hours'
				),
				'highlights' => array(
					'Dual-system integration: Portfolio projects + Training modules in one platform',
					'Interactive training viewer with zoom controls and syntax highlighting',
					'Bidirectional navigation between portfolio and training sections',
					'Mobile-responsive design for all screen sizes',
					'Professional portfolio showcasing real-world projects (Dominican Forge, WEBDOSE, RFID, etc.)',
					'Comprehensive onboarding system for new developers and trainees'
				),
				'timeline' => 'Ongoing Development',
				'full_description' => 'An innovative integrated platform that merges professional portfolio presentation with interactive developer training. This system demonstrates how to build scalable, maintainable web applications while simultaneously serving as a practical learning resource.


**Project Purpose & Intended Use:**


The Portfolio CI3 Training System was conceived with multiple strategic objectives:


1. **Unified Professional Presence:** Create a single, cohesive platform where visitors can explore real-world professional work (portfolio projects) and simultaneously access comprehensive training resources. This demonstrates both capability and commitment to knowledge-sharing.

2. **Accelerated Team Onboarding:** Eliminate the traditional "ramp-up" period for new developers by providing a structured, searchable, always-available training resource. New team members can learn at their own pace while referencing live examples from actual production systems.

3. **Knowledge Preservation:** Document architectural decisions, security practices, and development patterns used across production systems. Creates a living knowledge base that grows with the organization and survives personnel changes.

4. **Training-Driven Development:** Use training content to guide architectural decisions. When building systems, ensure they follow patterns and practices documented in the training modules, creating a virtuous cycle of knowledge.

5. **Public Demonstration of Expertise:** Showcase not just the ability to build systems, but the ability to teach and document them clearly. This differentiates from competitors and demonstrates professional maturity.

**System Architecture:**

**Frontend Layer:**
- Bootstrap 5.3.3 for responsive, professional UI
- Highlight.js for syntax-highlighted code examples
- jQuery for interactive elements and DOM manipulation
- Custom CSS with gradient themes (#a12124 red to #343434 dark gray)

**Backend Layer:**
- CodeIgniter 3 MVC framework providing clean separation of concerns
- Welcome controller managing portfolio and training navigation
- Training controller handling module data and presentation
- MySQL database for project and user data

**Integration Points:**

1. **Portfolio Navigation:** Training link in main navbar with direct access to modules
2. **Project Cards:** Training Module appears as special project in portfolio projects section
3. **Bidirectional Links:** Training modules link back to portfolio, creating seamless navigation
4. **Unified Styling:** Consistent design language across portfolio and training sections

**Key Features:**

**Portfolio Section:**
- Hero section with personal branding and professional summary
- Featured project showcase (Dominican Forge AI platform)
- Project grid with descriptions, tech stacks, metrics, and highlights
- Experience timeline showing career progression
- Skills assessment with proficiency levels
- Contact information and social links
- Education background and certifications
- Career aspirations and professional philosophy

**Training Section:**
- Module list with duration and slide count
- Full-screen slide viewer with progressive disclosure
- Zoom controls (50%-150%) for accessibility
- Code examples with VS2015 dark theme syntax highlighting
- Keyboard shortcuts (arrows, space, Ctrl+/-/0)
- Navigation between slides, modules, and portfolio
- Responsive design for mobile and desktop

**Integration Benefits:**

- **Learning by Example:** Training content references patterns and practices visible in actual production projects
- **Credibility:** Demonstrates expertise through both finished products and teaching ability
- **Engagement:** Visitors spend more time on platform by combining portfolio with learning resources
- **SEO:** Rich content covering technical topics increases discoverability
- **Scalability:** New training modules can be added without portfolio restructuring
- **Maintenance:** Centralized system reduces duplicate documentation and maintenance burden

**Technical Achievements:**

1. **Seamless Integration:** Training and portfolio systems communicate cleanly without tight coupling
2. **Accessibility:** Zoom controls and responsive design ensure usability for all visitors
3. **Performance:** Optimized asset loading and rendering for fast page transitions
4. **Code Quality:** Follows CodeIgniter 3 best practices demonstrated in training modules
5. **User Experience:** Intuitive navigation flows in both directions between systems

**Learning Outcomes for Visitors:**

By exploring this system, developers learn:
- How to build integrated multi-section web applications
- CodeIgniter 3 architecture and best practices
- PHP fundamentals and OOP concepts
- MySQL database design and query optimization
- Web security practices and vulnerability prevention
- Front-end development with Bootstrap and JavaScript
- Professional code organization and documentation
- How to structure training and educational content

**Impact & Metrics:**

- **Audience Reach:** Accessible to global audience interested in CodeIgniter 3, PHP development, or career development
- **Time Investment:** 4+ hours of training content for serious learners
- **Portfolio Impact:** 5 professional projects demonstrating full-stack capabilities
- **Professional Value:** Showcases both technical skills and ability to communicate/teach
- **Team Value:** Becomes institutional knowledge repository for development team',
			),
		);
	}

}
