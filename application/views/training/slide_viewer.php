<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($module['title'], ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/favicon.ico'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/vs2015.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            background: #1a1a1a;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .slide-container {
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #a12124 0%, #343434 100%);
            color: white;
        }
        .slide-header {
            background: rgba(0, 0, 0, 0.3);
            padding: 15px 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid rgba(255, 235, 59, 0.3);
            flex-shrink: 0;
        }
        .module-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #ffeb3b;
        }
        .zoom-controls {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .zoom-button {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid white;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .zoom-button:hover {
            background: white;
            color: #a12124;
        }
        .zoom-button:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }
        .zoom-level {
            font-size: 0.9rem;
            color: white;
            min-width: 50px;
            text-align: center;
        }
        .slide-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding: 40px 80px;
            overflow-y: auto;
        }
        .slide-title {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 30px;
            color: #ffffff;
        }
        .slide-explanation {
            font-size: 1.3rem;
            line-height: 1.8;
            margin-bottom: 40px;
            opacity: 0.95;
        }
        .examples-section {
            margin-bottom: 40px;
        }
        .examples-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #ffeb3b;
        }
        .examples-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        .code-block {
            background: #1e1e1e;
            border: 2px solid #ffeb3b;
            border-radius: 8px;
            padding: 20px;
            font-family: 'Consolas', 'Monaco', 'Courier New', monospace;
            font-size: 0.95rem;
            overflow-x: auto;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            line-height: 1.6;
        }
        .code-block:hover {
            background: #252526;
            box-shadow: 0 6px 20px rgba(255, 235, 59, 0.2);
            transform: translateY(-2px);
        }
        .code-block pre {
            margin: 0;
            padding: 0;
            background: transparent;
        }
        .code-block code {
            font-family: 'Consolas', 'Monaco', 'Courier New', monospace;
            font-size: 0.95rem;
        }
        .key-points-section {
            margin-top: 40px;
        }
        .key-points-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #ffeb3b;
        }
        .key-point {
            font-size: 1.2rem;
            margin-bottom: 12px;
            padding-left: 30px;
            position: relative;
        }
        .key-point::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #ffeb3b;
            font-weight: bold;
        }
        .slide-footer {
            background: rgba(0, 0, 0, 0.2);
            padding: 20px 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
        }
        .slide-counter {
            font-size: 1.2rem;
            font-weight: 600;
        }
        .slide-nav-buttons {
            display: flex;
            gap: 15px;
        }
        .nav-button {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid white;
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .nav-button:hover {
            background: white;
            color: #a12124;
        }
        .nav-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .back-to-modules {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        .back-to-modules:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        @media (max-width: 768px) {
            .slide-header {
                padding: 15px 20px;
                flex-direction: column;
                gap: 10px;
            }
            .module-title {
                font-size: 1rem;
            }
            .slide-content {
                padding: 40px 20px;
            }
            .slide-title {
                font-size: 2.5rem;
            }
            .slide-explanation {
                font-size: 1.1rem;
            }
            .slide-footer {
                padding: 15px 20px;
                flex-direction: column;
                gap: 15px;
            }
            .code-block {
                font-size: 0.9rem;
            }
            .examples-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="slide-container">
        <div class="slide-header">
            <div class="module-title">
                <i class="bi bi-book me-2"></i><?php echo htmlspecialchars($module['title'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
            <div class="zoom-controls">
                <button class="zoom-button" id="zoomOutBtn" onclick="zoomOut()" title="Zoom Out">
                    <i class="bi bi-dash-lg"></i>
                </button>
                <span class="zoom-level" id="zoomLevel">100%</span>
                <button class="zoom-button" id="zoomInBtn" onclick="zoomIn()" title="Zoom In">
                    <i class="bi bi-plus-lg"></i>
                </button>
            </div>
        </div>
        <div class="slide-content" id="slideContent">
            <!-- Slides will be inserted here by JavaScript -->
        </div>
        <div class="slide-footer">
            <a href="<?php echo base_url('training'); ?>" class="back-to-modules">
                <i class="bi bi-arrow-left me-1"></i>Back to Modules
            </a>
            <div class="slide-counter">
                <span id="currentSlide">1</span> / <span id="totalSlides"><?php echo count($module['slides']); ?></span>
            </div>
            <div class="slide-nav-buttons">
                <button class="nav-button" id="prevBtn" onclick="previousSlide()">
                    <i class="bi bi-chevron-left"></i>Previous
                </button>
                <button class="nav-button" id="nextBtn" onclick="nextSlide()">
                    Next<i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/sql.min.js"></script>
    <script>
        const slides = <?php echo json_encode($module['slides']); ?>;
        let currentSlideIndex = 0;
        let zoomLevel = 100;
        const minZoom = 50;
        const maxZoom = 150;
        const zoomStep = 10;

        function renderSlide(index) {
            const slide = slides[index];
            const slideContent = document.getElementById('slideContent');

            let html = `
                <h1 class="slide-title">${escapeHtml(slide.title)}</h1>
                <div class="slide-explanation">${escapeHtml(slide.explanation)}</div>
            `;

            if (slide.examples && slide.examples.length > 0) {
                html += `<div class="examples-section">
                    <div class="examples-title">Examples</div>
                    <div class="examples-grid">`;
                slide.examples.forEach(example => {
                    html += `<div class="code-block"><pre><code class="language-php">${escapeHtml(example)}</code></pre></div>`;
                });
                html += `</div></div>`;
            }

            if (slide.key_points && slide.key_points.length > 0) {
                html += `<div class="key-points-section">
                    <div class="key-points-title">Key Points</div>`;
                slide.key_points.forEach(point => {
                    html += `<div class="key-point">${escapeHtml(point)}</div>`;
                });
                html += `</div>`;
            }

            slideContent.innerHTML = html;
            
            // Apply syntax highlighting
            document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightElement(block);
            });
            
            document.getElementById('currentSlide').textContent = index + 1;
            updateButtonStates();
        }

        function updateButtonStates() {
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            prevBtn.disabled = currentSlideIndex === 0;
            nextBtn.disabled = currentSlideIndex === slides.length - 1;
        }

        function nextSlide() {
            if (currentSlideIndex < slides.length - 1) {
                currentSlideIndex++;
                renderSlide(currentSlideIndex);
            }
        }

        function previousSlide() {
            if (currentSlideIndex > 0) {
                currentSlideIndex--;
                renderSlide(currentSlideIndex);
            }
        }

        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, m => map[m]);
        }

        function zoomIn() {
            if (zoomLevel < maxZoom) {
                zoomLevel += zoomStep;
                applyZoom();
            }
        }

        function zoomOut() {
            if (zoomLevel > minZoom) {
                zoomLevel -= zoomStep;
                applyZoom();
            }
        }

        function applyZoom() {
            const scale = zoomLevel / 100;
            
            // Set base font size for content
            const slideContent = document.getElementById('slideContent');
            
            // Apply font size scaling to various elements
            const titleElement = slideContent.querySelector('.slide-title');
            if (titleElement) {
                titleElement.style.fontSize = (3.5 * scale) + 'rem';
            }
            
            const explanationElement = slideContent.querySelector('.slide-explanation');
            if (explanationElement) {
                explanationElement.style.fontSize = (1.3 * scale) + 'rem';
            }
            
            const examplesTitleElements = slideContent.querySelectorAll('.examples-title');
            examplesTitleElements.forEach(el => {
                el.style.fontSize = (1.5 * scale) + 'rem';
            });
            
            const codeBlockElements = slideContent.querySelectorAll('.code-block');
            codeBlockElements.forEach(el => {
                el.style.fontSize = (0.95 * scale) + 'rem';
            });
            
            const keyPointsTitle = slideContent.querySelector('.key-points-title');
            if (keyPointsTitle) {
                keyPointsTitle.style.fontSize = (1.5 * scale) + 'rem';
            }
            
            const keyPointElements = slideContent.querySelectorAll('.key-point');
            keyPointElements.forEach(el => {
                el.style.fontSize = (1.2 * scale) + 'rem';
            });
            
            // Update zoom level display
            document.getElementById('zoomLevel').textContent = zoomLevel + '%';
            
            // Update button states
            document.getElementById('zoomInBtn').disabled = zoomLevel >= maxZoom;
            document.getElementById('zoomOutBtn').disabled = zoomLevel <= minZoom;
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight' || e.key === ' ') {
                e.preventDefault();
                nextSlide();
            } else if (e.key === 'ArrowLeft') {
                e.preventDefault();
                previousSlide();
            } else if (e.ctrlKey && (e.key === '=' || e.key === '+')) {
                e.preventDefault();
                zoomIn();
            } else if (e.ctrlKey && (e.key === '-' || e.key === '_')) {
                e.preventDefault();
                zoomOut();
            } else if (e.ctrlKey && e.key === '0') {
                e.preventDefault();
                zoomLevel = 100;
                applyZoom();
            }
        });

        // Initialize
        renderSlide(currentSlideIndex);
    </script>
</body>
</html>
