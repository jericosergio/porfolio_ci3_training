<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?> - Portfolio">
    <title><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?> | Portfolio</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/favicon.ico'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .hero-section {
            background: linear-gradient(135deg, #a12124 0%, #343434 100%);
            color: white;
            padding: 100px 0 80px;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="87" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="kumiko" width="100" height="87" patternUnits="userSpaceOnUse"><g stroke="rgba(255,255,255,0.18)" stroke-width="1.2" fill="none"><path d="M 50 0 L 75 12.5 L 75 37.5 L 50 50 L 25 37.5 L 25 12.5 Z"/><path d="M 0 25 L 25 12.5 L 25 37.5 Z"/><path d="M 100 25 L 75 12.5 L 75 37.5 Z"/><path d="M 50 50 L 75 62.5 L 75 87.5"/><path d="M 50 50 L 25 62.5 L 25 87.5"/><path d="M 0 75 L 25 62.5 L 25 87.5"/><path d="M 100 75 L 75 62.5 L 75 87.5"/><line x1="25" y1="12.5" x2="75" y2="37.5"/><line x1="75" y1="12.5" x2="25" y2="37.5"/><line x1="50" y1="0" x2="50" y2="50"/><line x1="25" y1="37.5" x2="25" y2="62.5"/><line x1="75" y1="37.5" x2="75" y2="62.5"/><circle cx="50" cy="25" r="8" opacity="0.6"/><circle cx="25" cy="25" r="4" opacity="0.4"/><circle cx="75" cy="25" r="4" opacity="0.4"/><circle cx="25" cy="75" r="4" opacity="0.4"/><circle cx="75" cy="75" r="4" opacity="0.4"/></g></pattern></defs><rect width="100%" height="100%" fill="url(%23kumiko)"/></svg>');
            opacity: 0.3;
        }
        .profile-img {
            width: 280px;
            height: 380px;
            border-radius: 10px;
            border: 5px solid white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            overflow: hidden;
            object-fit: cover;
        }
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, #a12124 0%, #343434 100%);
            border-radius: 2px;
        }
        .skill-bar {
            background: #e9ecef;
            border-radius: 10px;
            height: 12px;
            overflow: hidden;
            margin-top: 8px;
        }
        .skill-progress {
            background: linear-gradient(135deg, #a12124 0%, #343434 100%);
            height: 100%;
            border-radius: 10px;
            transition: width 1s ease;
        }
        .project-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            height: 100%;
        }
        .project-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        .project-card img {
            height: 220px;
            object-fit: cover;
        }
        .contact-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #a12124 0%, #343434 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .social-link {
            display: inline-block;
            width: 45px;
            height: 45px;
            line-height: 45px;
            text-align: center;
            border-radius: 50%;
            background: linear-gradient(135deg, #a12124 0%, #343434 100%);
            color: white;
            font-size: 20px;
            transition: transform 0.3s ease;
            text-decoration: none;
        }
        .social-link:hover {
            transform: scale(1.1);
            color: white;
        }
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .aspiration-box {
            background: linear-gradient(135deg, #a12124 0%, #343434 100%);
            color: white;
            padding: 40px;
            border-radius: 15px;
            position: relative;
            overflow: hidden;
        }
        .aspiration-box::before {
            content: '"';
            position: absolute;
            top: 10px;
            left: 20px;
            font-size: 120px;
            opacity: 0.2;
            font-family: Georgia, serif;
        }
        .timeline-item {
            position: relative;
            padding-left: 40px;
            padding-bottom: 30px;
            border-left: 2px solid #e9ecef;
        }
        .timeline-item:last-child {
            border-left: 2px solid transparent;
        }
        .timeline-dot {
            position: absolute;
            left: -9px;
            top: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: linear-gradient(135deg, #a12124 0%, #343434 100%);
            border: 3px solid white;
            box-shadow: 0 0 0 2px #e9ecef;
        }
        .experience-card, .education-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        .experience-card:hover, .education-card:hover {
            transform: translateX(10px);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url('assets/jrcsrg_transparent.png'); ?>" alt="Logo" height="35">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
                    <li class="nav-item"><a class="nav-link" href="#experience">Experience</a></li>
                    <li class="nav-item"><a class="nav-link" href="#education">Education</a></li>
                    <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="#aspirations">Aspirations</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('welcome'); ?>">Home</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container position-relative">
            <div class="row align-items-center gap-4">
                <div class="col-lg-3">
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <img src="<?php echo base_url('assets/og-image.jpg'); ?>" alt="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>" class="profile-img">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h1 class="display-3 fw-bold mb-3"><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></h1>
                    <h3 class="h4 mb-4 opacity-75"><?php echo htmlspecialchars($tagline, ENT_QUOTES, 'UTF-8'); ?></h3>
                    <div class="d-flex gap-3 justify-content-center justify-content-lg-start mb-4">
                        <a href="<?php echo htmlspecialchars($github, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" class="social-link">
                            <i class="bi bi-github"></i>
                        </a>
                        <a href="<?php echo htmlspecialchars($linkedin, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" class="social-link">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="mailto:<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" class="social-link">
                            <i class="bi bi-envelope"></i>
                        </a>
                    </div>
                    <a href="#contact" class="btn btn-light btn-lg px-4">
                        <i class="bi bi-chat-dots me-2"></i>Get In Touch
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title h1 fw-bold">About Me</h2>
            <div class="row mt-4">
                <div class="col-lg-8">
                    <p class="lead text-muted text-justify"><?php echo htmlspecialchars($about, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Quick Info</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="bi bi-geo-alt me-2" style="color: #a12124;"></i>
                                    <?php echo htmlspecialchars($location, ENT_QUOTES, 'UTF-8'); ?>
                                </li>
                                <?php if (isset($work_email) && !empty($work_email)): ?>
                                <li class="mb-2">
                                    <i class="bi bi-envelope-at me-2" style="color: #a12124;"></i>
                                    <small><?php echo htmlspecialchars($work_email, ENT_QUOTES, 'UTF-8'); ?></small>
                                </li>
                                <?php endif; ?>
                                <li class="mb-2">
                                    <i class="bi bi-envelope me-2" style="color: #a12124;"></i>
                                    <?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>
                                </li>
                            </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title h1 fw-bold">Skills & Technologies</h2>
            <div class="row mt-4">
                <?php foreach ($skills as $skill): ?>
                <div class="col-md-6 mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="fw-semibold"><?php echo htmlspecialchars($skill['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <span class="text-muted"><?php echo $skill['level']; ?>%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-progress" style="width: <?php echo $skill['level']; ?>%"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section id="experience" class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title h1 fw-bold">Work Experience</h2>
            <p class="lead text-muted mb-5">My professional journey and accomplishments</p>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <?php foreach ($experience as $exp): ?>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="experience-card">
                            <div class="d-flex justify-content-between align-items-start mb-2 flex-wrap">
                                <div>
                                    <h4 class="fw-bold mb-1"><?php echo htmlspecialchars($exp['position'], ENT_QUOTES, 'UTF-8'); ?></h4>
                                    <h6 class="mb-0" style="color: #a12124;">
                                        <i class="bi bi-building me-2"></i><?php echo htmlspecialchars($exp['company'], ENT_QUOTES, 'UTF-8'); ?>
                                    </h6>
                                </div>
                                <span class="badge bg-secondary"><?php echo htmlspecialchars($exp['duration'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </div>
                            <p class="text-muted mb-3">
                                <i class="bi bi-geo-alt me-2"></i><?php echo htmlspecialchars($exp['location'], ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <ul class="mb-0">
                                <?php foreach ($exp['responsibilities'] as $responsibility): ?>
                                <li class="mb-2 text-muted"><?php echo htmlspecialchars($responsibility, ENT_QUOTES, 'UTF-8'); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Education Section -->
    <section id="education" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title h1 fw-bold">Education</h2>
            <p class="lead text-muted mb-5">My academic background and achievements</p>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <?php foreach ($education as $edu): ?>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="education-card">
                            <div class="d-flex justify-content-between align-items-start mb-2 flex-wrap">
                                <div>
                                    <h4 class="fw-bold mb-1"><?php echo htmlspecialchars($edu['degree'], ENT_QUOTES, 'UTF-8'); ?></h4>
                                    <h6 class="mb-0" style="color: #a12124;">
                                        <i class="bi bi-mortarboard me-2"></i><?php echo htmlspecialchars($edu['school'], ENT_QUOTES, 'UTF-8'); ?>
                                    </h6>
                                </div>
                                <span class="badge bg-secondary"><?php echo htmlspecialchars($edu['year'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </div>
                            <p class="text-muted mb-2">
                                <i class="bi bi-geo-alt me-2"></i><?php echo htmlspecialchars($edu['location'], ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <?php if (!empty($edu['honors'])): ?>
                            <p class="mb-3">
                                <span class="badge bg-success">
                                    <i class="bi bi-award me-1"></i><?php echo htmlspecialchars($edu['honors'], ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                            </p>
                            <?php endif; ?>
                            <ul class="mb-0">
                                <?php foreach ($edu['highlights'] as $highlight): ?>
                                <li class="mb-2 text-muted"><?php echo htmlspecialchars($highlight, ENT_QUOTES, 'UTF-8'); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title h1 fw-bold">My Projects</h2>
            <p class="lead text-muted mb-4">Showcasing my creative work and technical expertise</p>
            
            <?php 
            $featured_projects = array_filter($projects, function($p) { return isset($p['featured']) && $p['featured']; });
            $regular_projects = array_filter($projects, function($p) { return !isset($p['featured']) || !$p['featured']; });
            ?>
            
            <?php if (!empty($featured_projects)): ?>
            <!-- Featured Project -->
            <div class="mb-5">
                <?php foreach ($featured_projects as $project): ?>
                <a href="<?php echo base_url('project/' . $project['slug']); ?>" class="text-decoration-none">
                <div class="card shadow-lg border-0" style="background: linear-gradient(135deg, #343434 0%, #625f5f 100%); cursor: pointer; transition: transform 0.3s, box-shadow 0.3s;" 
                     onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 40px rgba(0,0,0,0.4)';"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow=''">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge" style="background-color: #a12124; font-size: 0.85rem;">
                                <i class="bi bi-star-fill me-1"></i>FEATURED PROJECT
                            </span>
                            <?php if (isset($project['timeline'])): ?>
                            <small class="text-white-50 ms-auto">
                                <i class="bi bi-calendar-event me-1"></i><?php echo htmlspecialchars($project['timeline'], ENT_QUOTES, 'UTF-8'); ?>
                            </small>
                            <?php endif; ?>
                        </div>
                        <h3 class="fw-bold text-white mb-3"><?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="text-white-50 mb-4"><?php echo htmlspecialchars($project['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                        
                        <?php if (isset($project['metrics'])): ?>
                        <div class="row g-3 mb-4">
                            <?php foreach ($project['metrics'] as $label => $value): ?>
                            <div class="col-6 col-md-3">
                                <div class="text-center p-3 rounded" style="background: rgba(255,255,255,0.1);">
                                    <h4 class="fw-bold mb-1" style="color: #a12124;"><?php echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); ?></h4>
                                    <small class="text-white-50"><?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></small>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (isset($project['highlights'])): ?>
                        <div class="mb-4">
                            <h6 class="text-white fw-semibold mb-3">Key Highlights:</h6>
                            <div class="row g-2">
                                <?php foreach ($project['highlights'] as $highlight): ?>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-check-circle-fill me-2 mt-1" style="color: #a12124;"></i>
                                        <small class="text-white-50"><?php echo htmlspecialchars($highlight, ENT_QUOTES, 'UTF-8'); ?></small>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <small class="text-white-50 me-2">
                                <i class="bi bi-tools me-1"></i><strong>Tech Stack:</strong>
                            </small>
                            <?php 
                            $tech_items = explode(',', $project['tech']);
                            foreach ($tech_items as $tech): 
                            ?>
                            <span class="badge bg-dark"><?php echo trim(htmlspecialchars($tech, ENT_QUOTES, 'UTF-8')); ?></span>
                            <?php endforeach; ?>
                        </div>
                        
                        <?php if (isset($project['event'])): ?>
                        <div class="mt-3 pt-3 border-top border-secondary">
                            <small class="text-white-50">
                                <i class="bi bi-calendar-check me-1"></i><?php echo htmlspecialchars($project['event'], ENT_QUOTES, 'UTF-8'); ?>
                            </small>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            
            <!-- Regular Projects Grid -->
            <div class="row g-4">
                <?php foreach ($regular_projects as $project): ?>
                <div class="col-lg-4 col-md-6">
                    <a href="<?php echo base_url('project/' . $project['slug']); ?>" class="text-decoration-none">
                    <div class="card project-card shadow-sm h-100" style="cursor: pointer; transition: transform 0.3s, box-shadow 0.3s;"
                         onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.15)';"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow=''">
                    <?php $card_image = isset($project['featured_image']) ? $project['featured_image'] : $project['image']; ?>
                    <img src="<?php echo htmlspecialchars($card_image, ENT_QUOTES, 'UTF-8'); ?>" 
                             class="card-img-top" 
                             alt="<?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark"><?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?></h5>
                            <p class="card-text text-muted flex-grow-1"><?php echo htmlspecialchars($project['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="mb-0 mt-auto">
                                <small class="fw-semibold" style="color: #a12124;">
                                    <i class="bi bi-tools me-1"></i><?php echo htmlspecialchars($project['tech'], ENT_QUOTES, 'UTF-8'); ?>
                                </small>
                            </p>
                        </div>
                    </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Aspirations Section -->
    <section id="aspirations" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title h1 fw-bold">My Aspirations</h2>
            <div class="row mt-4">
                <div class="col-lg-10 mx-auto">
                    <div class="aspiration-box">
                        <p class="h5 mb-0 position-relative"><?php echo htmlspecialchars($aspirations, ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tech Stack & Approach Section -->
    <?php if (isset($tech_stack)): ?>
    <section id="tech-stack" class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title h1 fw-bold">Tech Stack & Approach</h2>
            <div class="row mt-4">
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h4 class="fw-bold mb-4" style="color: #a12124;">
                                <i class="bi bi-stack me-2"></i>Tech I Use Today
                            </h4>
                            <?php foreach ($tech_stack as $category => $tools): ?>
                            <div class="mb-3">
                                <h6 class="fw-semibold text-muted mb-2"><?php echo htmlspecialchars($category, ENT_QUOTES, 'UTF-8'); ?></h6>
                                <p class="mb-0"><?php echo htmlspecialchars($tools, ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h4 class="fw-bold mb-4" style="color: #a12124;">
                                <i class="bi bi-compass me-2"></i>How I Approach Builds
                            </h4>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <i class="bi bi-check-circle-fill me-2" style="color: #a12124;"></i>
                                    <strong>Start with objectives:</strong> understand what the office/client needs to accomplish
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-check-circle-fill me-2" style="color: #a12124;"></i>
                                    <strong>Trace the data:</strong> check if the required data already exists in current workflows
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-check-circle-fill me-2" style="color: #a12124;"></i>
                                    <strong>Leverage the platform:</strong> if the need fits within our system, integrate it cleanly
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-check-circle-fill me-2" style="color: #a12124;"></i>
                                    <strong>Create what's missing:</strong> if not available, I build it—within the deadline—so the team can move forward
                                </li>
                            </ul>
                            <?php if (isset($clients_stakeholders)): ?>
                            <div class="mt-4 pt-3 border-top">
                                <h6 class="fw-semibold mb-2" style="color: #343434;">Clients & Stakeholders</h6>
                                <p class="mb-0 text-muted"><?php echo htmlspecialchars($clients_stakeholders, ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Contact Section -->
    <section id="contact" class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title h1 fw-bold text-center">Get In Touch</h2>
            <p class="lead text-muted text-center mb-5">Feel free to reach out for collaborations or just a friendly chat!</p>
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <div class="contact-icon mx-auto">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <h5 class="fw-bold">Email</h5>
                    <p class="text-muted"><?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="contact-icon mx-auto">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <h5 class="fw-bold">Phone</h5>
                    <p class="text-muted"><?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="contact-icon mx-auto">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <h5 class="fw-bold">Location</h5>
                    <p class="text-muted"><?php echo htmlspecialchars($location, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-2">&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Animate skill bars on scroll
        const observeSkills = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.width = entry.target.getAttribute('style').match(/width:\s*(\d+%)/)[1];
                }
            });
        });

        document.querySelectorAll('.skill-progress').forEach(el => {
            observeSkills.observe(el);
        });
    </script>
</body>
</html>