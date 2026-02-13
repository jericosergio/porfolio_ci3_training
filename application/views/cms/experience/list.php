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
	<h1 class="mb-0"><i class="bi bi-building me-2"></i><?php echo $page_title; ?></h1>
	<a href="<?php echo site_url('cms/experience_form'); ?>" class="btn btn-primary">
		<i class="bi bi-plus-circle me-2"></i>Add New Experience
	</a>
</div>

<!-- Experience List -->
<div class="card">
	<div class="card-body">
		<?php 
		$this->db->order_by('display_order', 'ASC');
		$all_experience = $this->db->get('experience')->result();
		?>
		<?php if (empty($all_experience)): ?>
			<div class="text-center py-5">
				<i class="bi bi-inbox display-1 text-muted"></i>
				<p class="text-muted mt-3">No experience added yet. Click "Add New Experience" to get started.</p>
			</div>
		<?php else: ?>
			<div class="alert alert-info mb-3">
				<i class="bi bi-hand-index-thumb me-2"></i>
				<strong>Tip:</strong> Drag and drop rows to reorder them. Changes are saved automatically.
			</div>
			<div class="table-responsive">
				<table class="table table-hover align-middle">
					<thead>
						<tr>
							<th width="50"><i class="bi bi-grip-vertical"></i></th>
							<th>Position</th>
							<th>Company</th>
							<th>Duration</th>
							<th class="text-center">Display Order</th>
							<th class="text-center">Status</th>
							<th class="text-end">Actions</th>
						</tr>
					</thead>
					<tbody id="sortable-experience">
						<?php foreach ($all_experience as $exp): ?>
							<tr data-id="<?php echo $exp->id; ?>" style="cursor: move;">
								<td class="drag-handle"><i class="bi bi-grip-vertical text-muted"></i></td>
								<td>
									<strong><?php echo htmlspecialchars($exp->position); ?></strong>
								</td>
								<td>
									<?php echo htmlspecialchars($exp->company); ?>
									<br><small class="text-muted"><i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($exp->location); ?></small>
								</td>
								<td>
									<span class="badge bg-info"><?php echo htmlspecialchars($exp->duration); ?></span>
								</td>
								<td class="text-center">
									<span class="badge bg-secondary"><?php echo $exp->display_order; ?></span>
								</td>
								<td class="text-center">
									<?php if ($exp->is_active): ?>
										<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Active</span>
									<?php else: ?>
										<span class="badge bg-secondary"><i class="bi bi-x-circle me-1"></i>Inactive</span>
									<?php endif; ?>
								</td>
								<td class="text-end">
									<a href="<?php echo site_url('cms/experience_form/' . $exp->id); ?>" class="btn btn-sm btn-outline-primary" title="Edit">
										<i class="bi bi-pencil"></i>
									</a>
									<a href="<?php echo site_url('cms/experience_delete/' . $exp->id); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this experience?');" title="Delete">
										<i class="bi bi-trash"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const sortableTable = document.getElementById('sortable-experience');
	
	if (sortableTable) {
		new Sortable(sortableTable, {
			animation: 150,
			handle: '.drag-handle',
			onEnd: function(evt) {
				const rows = sortableTable.querySelectorAll('tr[data-id]');
				const order = Array.from(rows).map(row => row.getAttribute('data-id'));
				
				fetch('<?php echo site_url('cms/reorder_experience'); ?>', {
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
						rows.forEach((row, index) => {
							const badge = row.querySelector('.badge.bg-secondary');
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
