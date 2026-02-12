<?php $this->load->view('cms/header'); ?>

<!-- Page Title -->
<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="mb-0"><?php echo $page_title; ?></h1>
	<a href="<?php echo site_url('cms/users'); ?>" class="btn btn-secondary btn-sm">
		<i class="bi bi-arrow-left me-2"></i>Back to Users
	</a>
</div>

<!-- User Form -->
<div class="row g-3">
	<div class="col-12 col-lg-8">
		<div class="card">
			<div class="card-header bg-white border-0">
				<h5 class="mb-0"><i class="bi bi-person-fill me-2"></i><?php echo isset($user->id) ? 'Edit User' : 'Create New User'; ?></h5>
			</div>
			<div class="card-body">
				<form method="post" class="needs-validation" novalidate>
					<div class="mb-3">
						<label for="username" class="form-label">Username <span class="text-danger">*</span></label>
						<input type="text" class="form-control <?php echo form_error('username') ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?php echo set_value('username', isset($user->username) ? $user->username : ''); ?>" required>
						<?php if (form_error('username')): ?>
							<div class="invalid-feedback d-block"><?php echo form_error('username'); ?></div>
						<?php endif; ?>
						<small class="form-text text-muted">Letters, numbers, and underscores only</small>
					</div>

					<div class="mb-3">
						<label for="email" class="form-label">Email <span class="text-danger">*</span></label>
						<input type="email" class="form-control <?php echo form_error('email') ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo set_value('email', isset($user->email) ? $user->email : ''); ?>" required>
						<?php if (form_error('email')): ?>
							<div class="invalid-feedback d-block"><?php echo form_error('email'); ?></div>
						<?php endif; ?>
					</div>

					<div class="mb-3">
						<label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control <?php echo form_error('full_name') ? 'is-invalid' : ''; ?>" id="full_name" name="full_name" value="<?php echo set_value('full_name', isset($user->full_name) ? $user->full_name : ''); ?>" required>
						<?php if (form_error('full_name')): ?>
							<div class="invalid-feedback d-block"><?php echo form_error('full_name'); ?></div>
						<?php endif; ?>
					</div>

					<hr>

					<div class="mb-3">
						<label for="password" class="form-label">
							Password 
							<?php if (!isset($user->id)): ?>
								<span class="text-danger">*</span>
							<?php else: ?>
								<span class="text-muted">(Leave blank to keep current password)</span>
							<?php endif; ?>
						</label>
						<input type="password" class="form-control <?php echo form_error('password') ? 'is-invalid' : ''; ?>" id="password" name="password" <?php echo !isset($user->id) ? 'required' : ''; ?>>
						<?php if (form_error('password')): ?>
							<div class="invalid-feedback d-block"><?php echo form_error('password'); ?></div>
						<?php endif; ?>
						<small class="form-text text-muted">Minimum 8 characters</small>
					</div>

					<div class="mb-3">
						<label for="password_confirm" class="form-label">Confirm Password</label>
						<input type="password" class="form-control <?php echo form_error('password_confirm') ? 'is-invalid' : ''; ?>" id="password_confirm" name="password_confirm">
						<?php if (form_error('password_confirm')): ?>
							<div class="invalid-feedback d-block"><?php echo form_error('password_confirm'); ?></div>
						<?php endif; ?>
					</div>

					<hr>

					<div class="mb-3">
						<label for="role" class="form-label">Role</label>
						<select class="form-select" id="role" name="role">
							<option value="user" <?php echo set_select('role', 'user', isset($user->role) && $user->role === 'user'); ?>>User</option>
							<option value="admin" <?php echo set_select('role', 'admin', isset($user->role) && $user->role === 'admin'); ?>>Admin</option>
						</select>
					</div>

					<div class="mb-3 form-check">
						<input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" <?php echo set_checkbox('is_active', 1, isset($user->is_active) ? $user->is_active : 1); ?>>
						<label class="form-check-label" for="is_active">
							Active (User can log in)
						</label>
					</div>

					<hr>

					<div class="d-flex gap-2">
						<button type="submit" class="btn btn-primary">
							<i class="bi bi-check-lg me-2"></i><?php echo isset($user->id) ? 'Update User' : 'Create User'; ?>
						</button>
						<a href="<?php echo site_url('cms/users'); ?>" class="btn btn-secondary">
							<i class="bi bi-x-lg me-2"></i>Cancel
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('cms/footer'); ?>
