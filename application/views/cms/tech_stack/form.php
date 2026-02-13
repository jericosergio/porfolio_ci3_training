<?php $this->load->view('cms/header'); ?>

<?php if (validation_errors()): ?>
	<div class="alert alert-danger alert-dismissible fade show ms-3 mt-3 me-3" role="alert">
		<i class="bi bi-exclamation-triangle-fill me-2"></i>
		<?php echo validation_errors(); ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	</div>
<?php endif; ?>

<!-- Page Title -->
<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="mb-0"><i class="bi bi-cpu me-2"></i><?php echo $page_title; ?></h1>
	<a href="<?php echo site_url('cms/tech_stack'); ?>" class="btn btn-outline-secondary btn-sm">
		<i class="bi bi-arrow-left me-2"></i>Back to Tech Stack
	</a>
</div>

<!-- Tech Stack Form -->
<form method="post" class="needs-validation" novalidate>
	<div class="row g-3">
		<!-- Tech Stack Information -->
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-white border-0">
					<h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Tech Stack Details</h5>
				</div>
				<div class="card-body">
					<div class="alert alert-info">
						<i class="bi bi-lightbulb me-2"></i>
						<strong>Tip:</strong> Create categories like "Frontend", "Backend", "Database", "DevOps", "Tools" to organize your technologies.
					</div>

					<div class="row g-3">
						<div class="col-12 col-md-6">
							<label for="category" class="form-label">Category <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="category" name="category" value="<?php echo set_value('category', isset($tech_stack) ? $tech_stack->category : ''); ?>" required>
							<small class="text-muted">e.g., "Frontend", "Backend", "Database", "DevOps"</small>
						</div>

						<div class="col-12 col-md-6">
							<label for="display_order" class="form-label">Display Order <span class="text-danger">*</span></label>
							<input type="number" class="form-control" id="display_order" name="display_order" value="<?php echo set_value('display_order', isset($tech_stack) ? $tech_stack->display_order : '0'); ?>" required>
							<small class="text-muted">Lower numbers appear first</small>
						</div>

						<div class="col-12">
							<label for="technologies" class="form-label">Technologies <span class="text-danger">*</span></label>
							<textarea class="form-control" id="technologies" name="technologies" rows="6" required><?php echo set_value('technologies', isset($tech_stack) ? $tech_stack->technologies : ''); ?></textarea>
							<small class="text-muted">List technologies in this category. Use commas to separate (e.g., "React, Vue, Angular, Next.js")</small>
						</div>

						<div class="col-12">
							<div class="card bg-light border-0">
								<div class="card-body">
									<h6 class="mb-3">Example Categories:</h6>
									<div class="row g-2">
										<div class="col-md-6">
											<p class="mb-1"><strong>Frontend:</strong></p>
											<small class="text-muted">React, Vue.js, Angular, Next.js, Tailwind CSS</small>
										</div>
										<div class="col-md-6">
											<p class="mb-1"><strong>Backend:</strong></p>
											<small class="text-muted">Node.js, PHP, Python, Ruby on Rails, Express</small>
										</div>
										<div class="col-md-6">
											<p class="mb-1"><strong>Database:</strong></p>
											<small class="text-muted">MySQL, PostgreSQL, MongoDB, Redis</small>
										</div>
										<div class="col-md-6">
											<p class="mb-1"><strong>DevOps:</strong></p>
											<small class="text-muted">Docker, Kubernetes, Jenkins, AWS, Azure</small>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-12">
							<label class="form-label d-block">Status</label>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" <?php echo set_checkbox('is_active', '1', isset($tech_stack) ? $tech_stack->is_active : TRUE); ?>>
								<label class="form-check-label" for="is_active">
									Active (visible on portfolio)
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Action Buttons -->
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="d-flex gap-2">
						<button type="submit" class="btn btn-primary">
							<i class="bi bi-check-circle me-2"></i><?php echo $action == 'edit' ? 'Update' : 'Create'; ?> Tech Stack
						</button>
						<a href="<?php echo site_url('cms/tech_stack'); ?>" class="btn btn-secondary">
							<i class="bi bi-x-circle me-2"></i>Cancel
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<?php $this->load->view('cms/footer'); ?>
