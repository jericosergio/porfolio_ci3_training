<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $page_title; ?> - Portfolio CMS</title>
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/favicon.ico'); ?>">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<style>
		:root {
			--primary-color: #a12124;
			--dark-color: #343434;
		}
		body {
			background: #f5f5f5;
		}
		.navbar-cms {
			background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);
		}
		.card {
			border: none;
			box-shadow: 0 2px 8px rgba(0,0,0,0.1);
			border-radius: 10px;
		}
		.stat-card {
			border-left: 4px solid var(--primary-color);
		}
		.stat-icon {
			font-size: 2.5rem;
			color: var(--primary-color);
		}
		.activity-item {
			padding: 12px;
			border-left: 3px solid #dee2e6;
			margin-bottom: 10px;
		}
		.activity-item:hover {
			background: #f8f9fa;
		}
	</style>
</head>
<body>
	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark navbar-cms mb-4">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?php echo base_url('cms/dashboard'); ?>">
				<i class="bi bi-speedometer2 me-2"></i>Portfolio CMS
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCMS">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCMS">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url('cms/dashboard'); ?>">
							<i class="bi bi-house-door me-1"></i>Dashboard
						</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
							<i class="bi bi-folder me-1"></i>Content
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="<?php echo base_url('cms/projects'); ?>">
								<i class="bi bi-folder me-2"></i>Projects
							</a></li>
							<li><a class="dropdown-item" href="<?php echo base_url('cms/skills'); ?>">
								<i class="bi bi-award me-2"></i>Skills
							</a></li>
							<li><a class="dropdown-item" href="<?php echo base_url('cms/experience'); ?>">
								<i class="bi bi-briefcase me-2"></i>Experience
							</a></li>
							<li><a class="dropdown-item" href="<?php echo base_url('cms/education'); ?>">
								<i class="bi bi-mortarboard me-2"></i>Education
							</a></li>
							<li><a class="dropdown-item" href="<?php echo base_url('cms/tech_stack'); ?>">
								<i class="bi bi-stack me-2"></i>Tech Stack
							</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url('cms/profile'); ?>">
							<i class="bi bi-person-circle me-1"></i>Profile
						</a>
					</li>
				</ul>
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url('portfolio'); ?>" target="_blank">
							<i class="bi bi-box-arrow-up-right me-1"></i>View Portfolio
						</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
							<i class="bi bi-person-circle me-1"></i><?php echo $this->session->userdata('full_name'); ?>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">
								<i class="bi bi-box-arrow-right me-2"></i>Logout
							</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container-fluid">
		<?php if ($this->session->flashdata('success')): ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<i class="bi bi-check-circle-fill me-2"></i>
				<?php echo $this->session->flashdata('success'); ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			</div>
		<?php endif; ?>

		<?php if ($this->session->flashdata('error')): ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<i class="bi bi-exclamation-triangle-fill me-2"></i>
				<?php echo $this->session->flashdata('error'); ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			</div>
		<?php endif; ?>

		<!-- Stats Cards -->
		<div class="row g-4 mb-4">
			<div class="col-md-4">
				<div class="card stat-card">
					<div class="card-body">
						<div class="d-flex justify-content-between align-items-center">
							<div>
								<h6 class="text-muted mb-2">Total Projects</h6>
								<h2 class="mb-0"><?php echo $total_projects; ?></h2>
							</div>
							<i class="bi bi-folder-fill stat-icon"></i>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card stat-card">
					<div class="card-body">
						<div class="d-flex justify-content-between align-items-center">
							<div>
								<h6 class="text-muted mb-2">Active Projects</h6>
								<h2 class="mb-0"><?php echo $active_projects; ?></h2>
							</div>
							<i class="bi bi-check-circle-fill stat-icon"></i>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card stat-card">
					<div class="card-body">
						<div class="d-flex justify-content-between align-items-center">
							<div>
								<h6 class="text-muted mb-2">Featured Projects</h6>
								<h2 class="mb-0"><?php echo $featured_projects; ?></h2>
							</div>
							<i class="bi bi-star-fill stat-icon"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Recent Activity -->
		<div class="row">
			<div class="col-lg-8">
				<div class="card">
					<div class="card-header bg-white">
						<h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Recent Activity</h5>
					</div>
					<div class="card-body">
						<?php if (!empty($recent_activity)): ?>
							<?php foreach ($recent_activity as $activity): ?>
								<div class="activity-item">
									<div class="d-flex justify-content-between">
										<div>
											<strong><?php echo htmlspecialchars($activity->action); ?></strong>
											<?php if ($activity->description): ?>
												<br><small class="text-muted"><?php echo htmlspecialchars($activity->description); ?></small>
											<?php endif; ?>
										</div>
										<small class="text-muted"><?php echo date('M d, Y h:i A', strtotime($activity->created_at)); ?></small>
									</div>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<p class="text-muted text-center py-4">No recent activity</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card">
					<div class="card-header bg-white">
						<h5 class="mb-0"><i class="bi bi-speedometer2 me-2"></i>Quick Actions</h5>
					</div>
					<div class="card-body">
						<div class="d-grid gap-2">
							<a href="<?php echo base_url('cms/project_create'); ?>" class="btn btn-primary">
								<i class="bi bi-plus-circle me-2"></i>New Project
							</a>
							<a href="<?php echo base_url('cms/projects'); ?>" class="btn btn-outline-primary">
								<i class="bi bi-folder me-2"></i>Manage Projects
							</a>
							<a href="<?php echo base_url('cms/profile'); ?>" class="btn btn-outline-primary">
								<i class="bi bi-person-circle me-2"></i>Edit Profile
							</a>
							<a href="<?php echo base_url('portfolio'); ?>" class="btn btn-outline-secondary" target="_blank">
								<i class="bi bi-box-arrow-up-right me-2"></i>View Portfolio
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
