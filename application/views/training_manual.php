<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CI3 Training Manual</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			background: #f3f5f7;
		}
		.hero {
			background: radial-gradient(circle at top left, #0d6efd, #0b2e6d 60%);
			color: #fff;
			border-radius: 1rem;
			padding: 2.5rem;
		}
		.section-card {
			border: 0;
			border-radius: 1rem;
			box-shadow: 0 12px 30px rgba(16, 24, 40, 0.08);
		}
		.section-card .card-body {
			padding: 2rem;
		}
		.manual-content p {
			margin-bottom: .75rem;
			color: #475467;
		}
		.manual-content ul {
			margin-bottom: 1rem;
		}
		.manual-content h5,
		.manual-content h6 {
			color: #1d2939;
			margin-top: 1.25rem;
			margin-bottom: .75rem;
		}
		.sidebar {
			position: sticky;
			top: 1rem;
		}
		.section-link {
			text-decoration: none;
			color: #344054;
		}
		.section-link.active,
		.section-link:hover {
			color: #0d6efd;
		}
		.badge-soft {
			background: rgba(13, 110, 253, 0.12);
			color: #0d6efd;
			font-weight: 600;
		}
		.presentation-note {
			background: #fff;
			border-radius: 1rem;
			padding: 1.25rem;
			border: 1px dashed #d0d5dd;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="<?php echo base_url(); ?>">CI3 Training</a>
			<div class="ms-auto">
				<a class="btn btn-outline-light btn-sm" href="<?php echo base_url('welcome'); ?>">Home</a>
			</div>
		</div>
	</nav>

	<main class="container py-4">
		<?php
			function render_manual_html($text)
			{
				$lines = preg_split("/\r\n|\n|\r/", $text);
				$html = '';
				$in_list = false;

				foreach ($lines as $line) {
					$trimmed = trim($line);

					if (preg_match('/^###\s+(.+)/', $trimmed, $matches)) {
						if ($in_list) {
							$html .= '</ul>';
							$in_list = false;
						}
						$html .= '<h5>' . htmlspecialchars($matches[1], ENT_QUOTES, 'UTF-8') . '</h5>';
						continue;
					}
					if (preg_match('/^####\s+(.+)/', $trimmed, $matches)) {
						if ($in_list) {
							$html .= '</ul>';
							$in_list = false;
						}
						$html .= '<h6>' . htmlspecialchars($matches[1], ENT_QUOTES, 'UTF-8') . '</h6>';
						continue;
					}
					if (preg_match('/^-\s+(.+)/', $trimmed, $matches)) {
						if (!$in_list) {
							$html .= '<ul class="list-unstyled">';
							$in_list = true;
						}
						$html .= '<li class="mb-2">• ' . htmlspecialchars($matches[1], ENT_QUOTES, 'UTF-8') . '</li>';
						continue;
					}
					if ($trimmed === '') {
						if ($in_list) {
							$html .= '</ul>';
							$in_list = false;
						}
						continue;
					}
					if ($in_list) {
						$html .= '</ul>';
						$in_list = false;
					}
					$html .= '<p>' . htmlspecialchars($trimmed, ENT_QUOTES, 'UTF-8') . '</p>';
				}

				if ($in_list) {
					$html .= '</ul>';
				}

				return $html;
			}
		?>

		<div class="hero mb-4">
			<div class="row align-items-center">
				<div class="col-lg-8">
					<p class="badge badge-soft mb-3">CI3 Trainer Deck</p>
					<h1 class="display-6 fw-bold mb-3"><?php echo htmlspecialchars($manual_title, ENT_QUOTES, 'UTF-8'); ?></h1>
					<p class="lead mb-0">Present this guide as a slide-style walkthrough for new trainees.</p>
				</div>
				<div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
					<a class="btn btn-light" href="<?php echo base_url('TRAINING_MANUAL.md'); ?>" target="_blank" rel="noopener">Open Markdown File</a>
				</div>
			</div>
		</div>

		<?php if ($manual_exists): ?>
			<div class="row g-4">
				<div class="col-lg-3">
					<div class="sidebar">
						<div class="card section-card mb-3">
							<div class="card-body">
								<h6 class="text-uppercase text-muted">Agenda</h6>
								<div class="d-grid gap-2">
									<?php foreach ($manual_sections as $index => $section):
										$section_id = 'section-' . ($index + 1);
									?>
										<a class="section-link" href="#<?php echo $section_id; ?>">
											<?php echo htmlspecialchars($section['title'] ?: 'Section ' . ($index + 1), ENT_QUOTES, 'UTF-8'); ?>
										</a>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
						<div class="presentation-note">
							<h6 class="fw-bold mb-2">Presentation tip</h6>
							<p class="mb-0 text-muted">Open each section as a talking point. Use the tasks list as your assignment brief.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-9">
					<?php foreach ($manual_sections as $index => $section):
						$section_id = 'section-' . ($index + 1);
					?>
						<section id="<?php echo $section_id; ?>" class="mb-4">
							<div class="card section-card">
								<div class="card-body">
									<div class="d-flex justify-content-between align-items-center mb-3">
										<span class="badge badge-soft">Slide <?php echo $index + 1; ?></span>
									</div>
									<h2 class="h4 fw-bold mb-3"><?php echo htmlspecialchars($section['title'] ?: 'Section ' . ($index + 1), ENT_QUOTES, 'UTF-8'); ?></h2>
									<div class="manual-content">
										<?php echo render_manual_html($section['content']); ?>
									</div>
								</div>
							</div>
						</section>
					<?php endforeach; ?>
				</div>
			</div>
		<?php else: ?>
			<div class="alert alert-warning">
				Manual file not found at: <strong><?php echo htmlspecialchars($manual_path, ENT_QUOTES, 'UTF-8'); ?></strong>
			</div>
		<?php endif; ?>
	</main>
</body>
</html>
