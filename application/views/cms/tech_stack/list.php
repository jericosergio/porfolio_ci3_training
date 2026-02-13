<?php $this->load->view('cms/header'); ?>

<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success alert-dismissible fade show ms-3 mt-3 me-3" role="alert">
		<i class="bi bi-check-circle-fill me-2"></i>
		<?php echo $this->session->flashdata('success'); ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	</div>
<?php endif; ?>

<!-- Page Title -->
<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="mb-0"><i class="bi bi-cpu me-2"></i><?php echo $page_title; ?></h1>
	<a href="<?php echo site_url('cms/tech_stack_form'); ?>" class="btn btn-primary">
		<i class="bi bi-plus-circle me-2"></i>Add New Tech Stack
	</a>
</div>

<!-- Tech Stack Description -->
<div class="alert alert-info mb-4">
	<i class="bi bi-hand-index-thumb me-2"></i>
	<strong>Tip:</strong> Drag and drop cards to reorder them. Changes are saved automatically. Organize your technologies by category (e.g., "Frontend", "Backend", "Database", "Tools").
</div>

<!-- Tech Stack List -->
<div class="card">
	<div class="card-body">
		<?php 
		$this->db->order_by('display_order', 'ASC');
		$all_tech_stack = $this->db->get('tech_stack')->result();
		?>
		<?php if (empty($all_tech_stack)): ?>
			<div class="text-center py-5">
				<i class="bi bi-inbox display-1 text-muted"></i>
				<p class="text-muted mt-3">No tech stack added yet. Click "Add New Tech Stack" to get started.</p>
			</div>
		<?php else: ?>
			<div class="row g-3" id="sortable-tech-stack">
				<?php foreach ($all_tech_stack as $tech): ?>
					<div class="col-12 col-md-6 col-lg-4" data-id="<?php echo $tech->id; ?>" style="cursor: move;">
						<div class="card h-100 <?php echo $tech->is_active ? 'border-success' : 'border-secondary'; ?>">
							<div class="card-header bg-white d-flex justify-content-between align-items-center">
								<h6 class="mb-0">
									<i class="bi bi-grip-vertical text-muted me-2"></i>
									<i class="bi bi-box me-2"></i><?php echo htmlspecialchars($tech->category); ?>
								</h6>
								<?php if ($tech->is_active): ?>
									<span class="badge bg-success">Active</span>
								<?php else: ?>
									<span class="badge bg-secondary">Inactive</span>
								<?php endif; ?>
							</div>
							<div class="card-body">
								<p class="mb-2"><small class="text-muted">Technologies:</small></p>
								<p><?php echo htmlspecialchars($tech->technologies); ?></p>
								<div class="mt-3">
									<small class="text-muted">Display Order: <span class="badge bg-secondary order-badge"><?php echo $tech->display_order; ?></span></small>
								</div>
							</div>
							<div class="card-footer bg-white border-top d-flex gap-2">
								<a href="<?php echo site_url('cms/tech_stack_form/' . $tech->id); ?>" class="btn btn-sm btn-outline-primary flex-fill">
									<i class="bi bi-pencil me-1"></i>Edit
								</a>
								<a href="<?php echo site_url('cms/tech_stack_delete/' . $tech->id); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this tech stack?');" title="Delete">
									<i class="bi bi-trash"></i>
								</a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const sortableGrid = document.getElementById('sortable-tech-stack');
	
	if (sortableGrid) {
		new Sortable(sortableGrid, {
			animation: 150,
			onEnd: function(evt) {
				const cols = sortableGrid.querySelectorAll('[data-id]');
				const order = Array.from(cols).map(col => col.getAttribute('data-id'));
				
				fetch('<?php echo site_url('cms/reorder_tech_stack'); ?>', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded',
						'X-Requested-With': 'XMLHttpRequest'
					},
					body: 'order=' + encodeURIComponent(JSON.stringify(order))
				})
				.then(response => response.json())
				.then(data => {
					if (data.status === 'success') {
						cols.forEach((col, index) => {
							const badge = col.querySelector('.order-badge');
							if (badge) badge.textContent = index + 1;
						});
						
						const alertDiv = document.createElement('div');
						alertDiv.className = 'alert alert-success alert-dismissible fade show position-fixed';
						alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
						alertDiv.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i>Order updated successfully! <button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
						document.body.appendChild(alertDiv);
						setTimeout(() => alertDiv.remove(), 3000);
					}
				})
				.catch(error => console.error('Error:', error));
			}
		});
	}
});
</script>

<?php $this->load->view('cms/footer'); ?>
