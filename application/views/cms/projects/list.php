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
	<h1 class="mb-0"><i class="bi bi-folder me-2"></i><?php echo $page_title; ?></h1>
	<a href="<?php echo base_url('cms/project_create'); ?>" class="btn btn-primary btn-sm">
		<i class="bi bi-plus-circle me-2"></i>New Project
	</a>
</div>

<!-- Projects Table -->
<div class="card">
	<div class="table-responsive">
		<table class="table table-hover mb-0">
			<thead class="table-light">
				<tr>
					<th>Title</th>
					<th>Slug</th>
					<th>Technologies</th>
					<th>Status</th>
					<th>Order</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($projects as $project): ?>
					<tr>
						<td>
							<strong><?php echo htmlspecialchars($project['title']); ?></strong>
							<?php if ($project['featured']): ?>
								<span class="badge bg-warning text-dark ms-2"><i class="bi bi-star-fill me-1"></i>Featured</span>
							<?php endif; ?>
						</td>
						<td><code class="small"><?php echo htmlspecialchars($project['slug']); ?></code></td>
						<td><small><?php echo htmlspecialchars(substr($project['tech'], 0, 50)); ?><?php echo strlen($project['tech']) > 50 ? '...' : ''; ?></small></td>
						<td>
							<?php if ($project['is_active']): ?>
								<span class="badge bg-success">Active</span>
							<?php else: ?>
								<span class="badge bg-secondary">Inactive</span>
							<?php endif; ?>
						</td>
						<td><span class="badge bg-light text-dark"><?php echo $project['display_order']; ?></span></td>
						<td>
							<a href="<?php echo base_url('cms/project_edit/' . $project['id']); ?>" class="btn btn-sm btn-warning" title="Edit">
								<i class="bi bi-pencil"></i>
							</a>
							<button type="button" class="btn btn-sm btn-danger" onclick="deleteProject(<?php echo $project['id']; ?>, '<?php echo htmlspecialchars($project['title']); ?>')" title="Delete">
								<i class="bi bi-trash"></i>
							</button>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete the project <strong id="deleteProjectName"></strong>?</p>
				<p class="text-muted small">This action cannot be undone.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				<a href="#" id="deleteConfirmBtn" class="btn btn-danger">Delete</a>
			</div>
		</div>
	</div>
</div>

<script>
function deleteProject(projectId, projectName) {
	document.getElementById('deleteProjectName').textContent = projectName;
	document.getElementById('deleteConfirmBtn').href = '<?php echo base_url('cms/project_delete/'); ?>' + projectId;
	
	const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
	deleteModal.show();
}
</script>

<?php $this->load->view('cms/footer'); ?>
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
