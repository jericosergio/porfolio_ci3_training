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
