<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?> - <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/favicon.ico'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .project-hero {
            background: linear-gradient(135deg, #a12124 0%, #343434 100%);
            color: white;
            padding: 80px 0 40px;
        }
        .project-image {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        .metric-box {
            background: rgba(255,255,255,0.1);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            backdrop-filter: blur(10px);
        }
        .metric-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #ffffff;
        }
        .metric-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }
        .content-section {
            padding: 60px 0;
        }
        .tech-badge {
            display: inline-block;
            padding: 8px 16px;
            background: #f8f9fa;
            border-radius: 20px;
            margin: 5px;
            font-size: 0.9rem;
            border: 2px solid #dee2e6;
        }
        .highlight-item {
            padding: 15px;
            background: #f8f9fa;
            border-left: 4px solid #a12124;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .back-button {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 2px solid white;
            padding: 10px 25px;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        .back-button:hover {
            background: white;
            color: #a12124;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="project-hero">
        <div class="container">
            <div class="mb-4">
                <a href="<?php echo base_url('portfolio#projects'); ?>" class="back-button">
                    <i class="bi bi-arrow-left me-2"></i>Back to Portfolio
                </a>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="display-4 fw-bold mb-3"><?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
                    <p class="lead mb-4"><?php echo htmlspecialchars($project['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php if (isset($project['timeline'])): ?>
                    <p class="mb-2"><i class="bi bi-calendar-event me-2"></i><?php echo htmlspecialchars($project['timeline'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endif; ?>
                    <?php if (isset($project['event'])): ?>
                    <p class="mb-0"><i class="bi bi-award me-2"></i><?php echo htmlspecialchars($project['event'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6">
                    <?php $featured_image = isset($project['featured_image']) ? $project['featured_image'] : $project['image']; ?>
                    <img src="<?php echo htmlspecialchars($featured_image, ENT_QUOTES, 'UTF-8'); ?>" 
                         alt="<?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?>" 
                         class="project-image">
                </div>
            </div>

            <?php if (isset($project['metrics'])): ?>
            <div class="row mt-5 g-3">
                <?php foreach ($project['metrics'] as $label => $value): ?>
                <div class="col-6 col-md-3">
                    <div class="metric-box">
                        <div class="metric-value"><?php echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); ?></div>
                        <div class="metric-label"><?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <?php if (isset($project['full_description'])): ?>
                    <div class="mb-5">
                        <?php
                        // Convert markdown-style bold to HTML
                        $content = $project['full_description'];
                        $content = preg_replace('/\*\*(.*?)\*\*/s', '<strong>$1</strong>', $content);
                        $paragraphs = explode("\n\n", $content);
                        foreach ($paragraphs as $para):
                            if (strpos($para, '**') === 0 || strpos($para, '<strong>') !== false):
                        ?>
                        <h4 class="fw-bold mt-4 mb-3" style="color: #343434;"><?php echo $para; ?></h4>
                        <?php else: ?>
                        <p class="lead text-muted"><?php echo nl2br($para); ?></p>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($project['images']) && is_array($project['images']) && count($project['images']) > 1): ?>
                    <div class="mb-5">
                        <h3 class="fw-bold mb-4" style="color: #343434;">Project Gallery</h3>
                        <div class="row g-3">
                            <?php foreach ($project['images'] as $gallery_image): ?>
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm">
                                    <img src="<?php echo htmlspecialchars($gallery_image, ENT_QUOTES, 'UTF-8'); ?>" 
                                         class="img-fluid rounded" 
                                         alt="<?php echo htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8'); ?>">
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($project['highlights'])): ?>
                    <div class="mb-5">
                        <h3 class="fw-bold mb-4" style="color: #a12124;">Key Highlights</h3>
                        <?php foreach ($project['highlights'] as $highlight): ?>
                        <div class="highlight-item">
                            <i class="bi bi-check-circle-fill me-2" style="color: #a12124;"></i>
                            <?php echo htmlspecialchars($highlight, ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <div class="mb-5">
                        <h3 class="fw-bold mb-4" style="color: #343434;">Technologies Used</h3>
                        <div>
                            <?php 
                            $tech_items = explode(',', $project['tech']);
                            foreach ($tech_items as $tech): 
                            ?>
                            <span class="tech-badge"><?php echo trim(htmlspecialchars($tech, ENT_QUOTES, 'UTF-8')); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="text-center mt-5 pt-4 border-top">
                        <a href="<?php echo base_url('portfolio#projects'); ?>" class="btn btn-lg px-5" style="background: linear-gradient(135deg, #a12124 0%, #343434 100%); color: white; border: none;">
                            <i class="bi bi-arrow-left me-2"></i>Back to All Projects
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
