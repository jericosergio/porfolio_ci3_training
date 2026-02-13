<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Training Modules">
    <title>Training Modules - <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></title>
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
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        .module-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            height: 100%;
        }
        .module-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        .module-header {
            background: linear-gradient(135deg, #a12124 0%, #343434 100%);
            color: white;
            padding: 25px;
        }
        .module-body {
            padding: 25px;
        }
        .module-duration {
            display: inline-block;
            background: #e9ecef;
            color: #343434;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url('assets/jrcsrg_transparent.png'); ?>" alt="Logo" height="35">
                Training
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('portfolio#projects'); ?>">Back to Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('portfolio'); ?>">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('training'); ?>">Training</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Training Modules</h1>
            <p class="lead mb-0">Learn professional development concepts through interactive slides and comprehensive examples</p>
        </div>
    </section>

    <!-- Modules Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title h1 fw-bold mb-5">Available Modules</h2>
            <div class="row g-4">
                <?php foreach ($modules as $module): ?>
                <div class="col-lg-4 col-md-6">
                    <?php 
                    // Direct link for calculator module, otherwise use module viewer
                    $module_url = ($module['slug'] === 'calculator') 
                        ? base_url('training/calculator') 
                        : base_url('training/module/' . $module['slug']);
                    ?>
                    <a href="<?php echo $module_url; ?>" class="text-decoration-none">
                    <div class="card module-card shadow-sm h-100">
                        <div class="module-header">
                            <h5 class="card-title fw-bold mb-0">
                                <?php if ($module['slug'] === 'calculator'): ?>
                                    <i class="bi bi-calculator me-2"></i>
                                <?php endif; ?>
                                <?php echo htmlspecialchars($module['title'], ENT_QUOTES, 'UTF-8'); ?>
                            </h5>
                        </div>
                        <div class="module-body">
                            <p class="module-duration">
                                <?php if ($module['slug'] === 'calculator'): ?>
                                    <i class="bi bi-tools me-1"></i><?php echo htmlspecialchars($module['duration'], ENT_QUOTES, 'UTF-8'); ?>
                                <?php else: ?>
                                    <i class="bi bi-clock me-1"></i><?php echo htmlspecialchars($module['duration'], ENT_QUOTES, 'UTF-8'); ?>
                                <?php endif; ?>
                            </p>
                            <p class="text-muted mb-3"><?php echo htmlspecialchars($module['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <?php if ($module['slug'] !== 'calculator'): ?>
                                <p class="text-muted mb-0">
                                    <small><i class="bi bi-collection me-1" style="color: #a12124;"></i><?php echo count($module['slides']); ?> slides</small>
                                </p>
                            <?php else: ?>
                                <p class="text-muted mb-0">
                                    <small><i class="bi bi-calculator-fill me-1" style="color: #a12124;"></i>Standard & Scientific</small>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    </a>
                </div>
                <?php endforeach; ?>
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
</body>
</html>
