<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $page_title; ?> - Portfolio CMS</title>
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/favicon.ico'); ?>">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
	<style>
		:root {
			--primary-color: #a12124;
			--dark-color: #343434;
		}
		.navbar-cms {
			background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);
		}
		.card {
			border: none;
			box-shadow: 0 2px 8px rgba(0,0,0,0.1);
			border-radius: 10px;
		}
		.btn-primary {
			background-color: var(--primary-color);
			border-color: var(--primary-color);
		}
		.btn-primary:hover {
			background-color: var(--dark-color);
			border-color: var(--dark-color);
		}
	</style>
</head>
<body>
	<!-- Navigation (same as dashboard) -->
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
						<a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">
							<i class="bi bi-folder me-1"></i>Content
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="<?php echo base_url('cms/projects'); ?>">
								<i class="bi bi-folder me-2"></i>Projects
							</a></li>
							<li><a class="dropdown-item active" href="<?php echo base_url('cms/skills'); ?>">
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

		<div class="card">
			<div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
				<h5 class="mb-0"><i class="bi bi-award me-2"></i><?php echo $page_title; ?></h5>
				<a href="<?php echo base_url('cms/skill_form'); ?>" class="btn btn-primary">
					<i class="bi bi-plus-circle me-1"></i>Add Skill
				</a>
			</div>
			<div class="card-body">
				<table id="skillsTable" class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Level</th>
							<th>Order</th>
							<th>Status</th>
							<th width="120">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($skills)): ?>
							<?php foreach ($skills as $skill): ?>
								<tr>
									<td><?php echo htmlspecialchars($skill['name']); ?></td>
									<td>
										<div class="progress" style="height: 25px;">
											<div class="progress-bar bg-success" role="progressbar" 
												 style="width: <?php echo $skill['level']; ?>%;" 
												 aria-valuenow="<?php echo $skill['level']; ?>" 
												 aria-valuemin="0" aria-valuemax="100">
												<?php echo $skill['level']; ?>%
											</div>
										</div>
									</td>
									<td><?php echo $skill['display_order']; ?></td>
									<td>
										<?php if ($skill['is_active']): ?>
											<span class="badge bg-success">Active</span>
										<?php else: ?>
											<span class="badge bg-secondary">Inactive</span>
										<?php endif; ?>
									</td>
									<td>
										<a href="<?php echo base_url('cms/skill_form/' . $skill['id']); ?>" 
										   class="btn btn-sm btn-outline-primary" title="Edit">
											<i class="bi bi-pencil"></i>
										</a>
										<a href="<?php echo base_url('cms/skill_delete/' . $skill['id']); ?>" 
										   class="btn btn-sm btn-outline-danger" title="Delete"
										   onclick="return confirm('Are you sure you want to delete this skill?');">
											<i class="bi bi-trash"></i>
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan="5" class="text-center">No skills found</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#skillsTable').DataTable({
				"order": [[2, "asc"]], // Sort by display_order
				"pageLength": 25
			});
		});
	</script>
</body>
</html>
