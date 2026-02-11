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
		.badge-featured {
			background: #ffc107;
			color: #000;
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
					<li class="nav-item">
						<a class="nav-link active" href="<?php echo base_url('cms/projects'); ?>">
							<i class="bi bi-folder me-1"></i>Projects
						</a>
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
			<div class="card-header bg-white d-flex justify-content-between align-items-center">
				<h5 class="mb-0"><i class="bi bi-folder me-2"></i>Manage Projects</h5>
				<a href="<?php echo base_url('cms/project_create'); ?>" class="btn btn-primary">
					<i class="bi bi-plus-circle me-2"></i>New Project
				</a>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="projectsTable" class="table table-hover">
						<thead>
							<tr>
								<th>Title</th>
								<th>Slug</th>
								<th>Tech</th>
								<th>Status</th>
								<th>Order</th>
								<th width="120">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($projects as $project): ?>
								<tr>
									<td>
										<?php echo htmlspecialchars($project['title']); ?>
										<?php if ($project['featured']): ?>
											<span class="badge badge-featured ms-2">Featured</span>
										<?php endif; ?>
									</td>
									<td><code><?php echo htmlspecialchars($project['slug']); ?></code></td>
									<td><small><?php echo htmlspecialchars(substr($project['tech'], 0, 50)); ?>...</small></td>
									<td>
										<?php if ($project['is_active']): ?>
											<span class="badge bg-success">Active</span>
										<?php else: ?>
											<span class="badge bg-secondary">Inactive</span>
										<?php endif; ?>
									</td>
									<td><?php echo $project['display_order']; ?></td>
									<td>
										<a href="<?php echo base_url('cms/project_edit/' . $project['id']); ?>" class="btn btn-sm btn-outline-primary" title="Edit">
											<i class="bi bi-pencil"></i>
										</a>
										<a href="<?php echo base_url('cms/project_delete/' . $project['id']); ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this project?');">
											<i class="bi bi-trash"></i>
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#projectsTable').DataTable({
				order: [[4, 'asc']],
				pageLength: 25
			});
		});
	</script>
</body>
</html>
