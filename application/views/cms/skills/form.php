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
	<h1 class="mb-0"><i class="bi bi-stars me-2"></i><?php echo $page_title; ?></h1>
	<a href="<?php echo site_url('cms/skills'); ?>" class="btn btn-outline-secondary btn-sm">
		<i class="bi bi-arrow-left me-2"></i>Back to Skills
	</a>
</div>

<!-- Skill Form -->
<form method="post" class="needs-validation" novalidate>
	<div class="row g-3">
		<!-- Skill Information -->
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-white border-0">
					<h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Skill Details</h5>
				</div>
				<div class="card-body">
					<div class="row g-3">
						<div class="col-12 col-md-8">
							<label for="name" class="form-label">Skill Name <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name', isset($skill) ? $skill->name : ''); ?>" required>
							<small class="text-muted">e.g., "JavaScript", "Python", "Project Management"</small>
						</div>

						<div class="col-12 col-md-4">
							<label for="level" class="form-label">Proficiency Level (%) <span class="text-danger">*</span></label>
							<input type="number" class="form-control" id="level" name="level" min="0" max="100" value="<?php echo set_value('level', isset($skill) ? $skill->level : '50'); ?>" required>
							<small class="text-muted">0-100 scale</small>
						</div>

						<div class="col-12 col-md-6">
							<label for="display_order" class="form-label">Display Order <span class="text-danger">*</span></label>
							<input type="number" class="form-control" id="display_order" name="display_order" value="<?php echo set_value('display_order', isset($skill) ? $skill->display_order : '0'); ?>" required>
							<small class="text-muted">Lower numbers appear first</small>
						</div>

						<div class="col-12 col-md-6">
							<label class="form-label d-block">Status</label>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" <?php echo set_checkbox('is_active', '1', isset($skill) ? $skill->is_active : TRUE); ?>>
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
							<i class="bi bi-check-circle me-2"></i><?php echo $action == 'edit' ? 'Update' : 'Create'; ?> Skill
						</button>
						<a href="<?php echo site_url('cms/skills'); ?>" class="btn btn-secondary">
							<i class="bi bi-x-circle me-2"></i>Cancel
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<?php $this->load->view('cms/footer'); ?>
