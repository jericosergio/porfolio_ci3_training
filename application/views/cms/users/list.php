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
	<a href="<?php echo site_url('cms/user_form'); ?>" class="btn btn-primary btn-sm">
		<i class="bi bi-plus-lg me-2"></i>Add New User
	</a>
</div>

<!-- Users Table -->
<div class="card">
	<div class="table-responsive">
		<table class="table table-hover mb-0">
			<thead class="table-light">
				<tr>
					<th>Username</th>
					<th>Full Name</th>
					<th>Email</th>
					<th>Role</th>
					<th>Status</th>
					<th>Last Login</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($users)): ?>
					<?php foreach ($users as $user): ?>
						<tr>
							<td>
								<span class="fw-500"><?php echo htmlspecialchars($user['username']); ?></span>
							</td>
							<td><?php echo htmlspecialchars($user['full_name']); ?></td>
							<td><?php echo htmlspecialchars($user['email']); ?></td>
							<td>
								<span class="badge bg-info">
									<?php echo isset($user['role']) ? ucfirst($user['role']) : 'User'; ?>
								</span>
							</td>
							<td>
								<?php if ($user['is_active'] == 1): ?>
									<span class="badge bg-success">Active</span>
								<?php else: ?>
									<span class="badge bg-secondary">Inactive</span>
								<?php endif; ?>
							</td>
							<td>
								<?php if (!empty($user['last_login'])): ?>
									<?php echo date('M d, Y H:i', strtotime($user['last_login'])); ?>
								<?php else: ?>
									<span class="text-muted">Never</span>
								<?php endif; ?>
							</td>
							<td>
								<a href="<?php echo site_url('cms/user_form/' . $user['id']); ?>" class="btn btn-sm btn-warning" title="Edit">
									<i class="bi bi-pencil"></i>
								</a>
								<?php if ($this->session->userdata('user_id') != $user['id']): ?>
									<button type="button" class="btn btn-sm btn-danger" onclick="deleteUser(<?php echo $user['id']; ?>, '<?php echo htmlspecialchars($user['username']); ?>')" title="Delete">
										<i class="bi bi-trash"></i>
									</button>
								<?php else: ?>
									<button class="btn btn-sm btn-danger" disabled title="Cannot delete your own account">
										<i class="bi bi-trash"></i>
									</button>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td colspan="7" class="text-center text-muted py-4">
							No users found. <a href="<?php echo site_url('cms/user_form'); ?>">Create one now</a>.
						</td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteModalLabel">Confirm Deactivation</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to deactivate the user <strong id="deleteUsername"></strong>?</p>
				<p class="text-muted small">This action will deactivate the user account and they won't be able to log in.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				<a href="#" id="deleteConfirmBtn" class="btn btn-danger">Deactivate</a>
			</div>
		</div>
	</div>
</div>

<script>
function deleteUser(userId, username) {
	document.getElementById('deleteUsername').textContent = username;
	document.getElementById('deleteConfirmBtn').href = '<?php echo site_url('cms/user_delete/'); ?>' + userId;
	
	const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
	deleteModal.show();
}
</script>

<?php $this->load->view('cms/footer'); ?>
