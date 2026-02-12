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
	<a href="<?php echo site_url('cms/dashboard'); ?>" class="btn btn-secondary btn-sm">
		<i class="bi bi-arrow-left me-2"></i>Back to Dashboard
	</a>
</div>

<!-- Change Password Form -->
<div class="row g-3">
	<div class="col-12 col-lg-6">
		<div class="card">
			<div class="card-header bg-white border-0">
				<h5 class="mb-0"><i class="bi bi-lock-fill me-2"></i>Change Password</h5>
			</div>
			<div class="card-body">
				<p class="text-muted mb-4">Enter your current password and set a new one below.</p>

				<form method="post" class="needs-validation" novalidate>
					<div class="mb-3">
						<label for="old_password" class="form-label">Current Password <span class="text-danger">*</span></label>
						<input type="password" class="form-control <?php echo form_error('old_password') ? 'is-invalid' : ''; ?>" id="old_password" name="old_password" required>
						<?php if (form_error('old_password')): ?>
							<div class="invalid-feedback d-block"><?php echo form_error('old_password'); ?></div>
						<?php endif; ?>
					</div>

					<hr>

					<div class="mb-3">
						<label for="new_password" class="form-label">New Password <span class="text-danger">*</span></label>
						<input type="password" class="form-control <?php echo form_error('new_password') ? 'is-invalid' : ''; ?>" id="new_password" name="new_password" required>
						<?php if (form_error('new_password')): ?>
							<div class="invalid-feedback d-block"><?php echo form_error('new_password'); ?></div>
						<?php endif; ?>
						<small class="form-text text-muted">Minimum 8 characters. Use a mix of letters, numbers, and symbols for better security.</small>
					</div>

					<div class="mb-3">
						<label for="confirm_password" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
						<input type="password" class="form-control <?php echo form_error('confirm_password') ? 'is-invalid' : ''; ?>" id="confirm_password" name="confirm_password" required>
						<?php if (form_error('confirm_password')): ?>
							<div class="invalid-feedback d-block"><?php echo form_error('confirm_password'); ?></div>
						<?php endif; ?>
					</div>

					<hr>

					<div class="d-flex gap-2">
						<button type="submit" class="btn btn-primary">
							<i class="bi bi-check-lg me-2"></i>Update Password
						</button>
						<a href="<?php echo site_url('cms/dashboard'); ?>" class="btn btn-secondary">
							<i class="bi bi-x-lg me-2"></i>Cancel
						</a>
					</div>
				</form>
			</div>
		</div>

		<div class="card mt-3">
			<div class="card-header bg-white border-0">
				<h6 class="mb-0"><i class="bi bi-lightbulb me-2"></i>Password Tips</h6>
			</div>
			<div class="card-body">
				<ul class="small mb-0 ps-3">
					<li>Use at least 8 characters</li>
					<li>Mix uppercase and lowercase letters</li>
					<li>Include numbers and special characters</li>
					<li>Avoid using personal information</li>
					<li>Don't reuse old passwords</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('cms/footer'); ?>
