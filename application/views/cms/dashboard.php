<?php $this->load->view('cms/header'); ?>

<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success alert-dismissible fade show ms-3 mt-3 me-3" role="alert">
		<i class="bi bi-check-circle-fill me-2"></i>
		<?php echo $this->session->flashdata('success'); ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	</div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
	<div class="alert alert-danger alert-dismissible fade show ms-3 mt-3 me-3" role="alert">
		<i class="bi bi-exclamation-triangle-fill me-2"></i>
		<?php echo $this->session->flashdata('error'); ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	</div>
<?php endif; ?>

<!-- Page Title -->
<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="mb-0"><?php echo $page_title; ?></h1>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
	<div class="col-12 col-sm-6 col-lg-4">
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
	<div class="col-12 col-sm-6 col-lg-4">
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
	<div class="col-12 col-sm-6 col-lg-4">
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
<div class="row g-3">
	<div class="col-12 col-lg-8">
		<div class="card">
			<div class="card-header bg-white border-0">
				<h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Recent Activity</h5>
			</div>
			<div class="card-body">
				<?php if (!empty($recent_activity)): ?>
					<?php foreach ($recent_activity as $activity): ?>
						<div class="activity-item border-bottom pb-3 mb-3">
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
	<div class="col-12 col-lg-4">
		<div class="card">
			<div class="card-header bg-white border-0">
				<h5 class="mb-0"><i class="bi bi-speedometer2 me-2"></i>Quick Actions</h5>
			</div>
			<div class="card-body">
				<div class="d-grid gap-2">
					<a href="<?php echo base_url('cms/project_create'); ?>" class="btn btn-primary btn-sm">
						<i class="bi bi-plus-circle me-2"></i>New Project
					</a>
					<a href="<?php echo base_url('cms/projects'); ?>" class="btn btn-outline-primary btn-sm">
						<i class="bi bi-folder me-2"></i>Manage Projects
					</a>
					<a href="<?php echo base_url('cms/users'); ?>" class="btn btn-outline-primary btn-sm">
						<i class="bi bi-people me-2"></i>Manage Users
					</a>
					<a href="<?php echo base_url('cms/change_password'); ?>" class="btn btn-outline-secondary btn-sm">
						<i class="bi bi-lock me-2"></i>Change Password
					</a>
					<a href="<?php echo base_url('portfolio'); ?>" class="btn btn-outline-secondary btn-sm" target="_blank">
						<i class="bi bi-box-arrow-up-right me-2"></i>View Portfolio
					</a>
				</div>
			</div>
		</div>
	</div>
