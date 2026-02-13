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
	<h1 class="mb-0"><i class="bi bi-building me-2"></i><?php echo $page_title; ?></h1>
	<a href="<?php echo site_url('cms/experience'); ?>" class="btn btn-outline-secondary btn-sm">
		<i class="bi bi-arrow-left me-2"></i>Back to Experience
	</a>
</div>

<!-- Experience Form -->
<form method="post" class="needs-validation" novalidate>
	<div class="row g-3">
		<!-- Experience Information -->
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-white border-0">
					<h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Experience Details</h5>
				</div>
				<div class="card-body">
					<div class="row g-3">
						<div class="col-12 col-md-6">
							<label for="position" class="form-label">Position/Role <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="position" name="position" value="<?php echo set_value('position', isset($experience) ? $experience->position : ''); ?>" required>
							<small class="text-muted">e.g., "Senior Web Developer"</small>
						</div>

						<div class="col-12 col-md-6">
							<label for="company" class="form-label">Company <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="company" name="company" value="<?php echo set_value('company', isset($experience) ? $experience->company : ''); ?>" required>
							<small class="text-muted">Company or organization name</small>
						</div>

						<div class="col-12 col-md-6">
							<label for="location" class="form-label">Location <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="location" name="location" value="<?php echo set_value('location', isset($experience) ? $experience->location : ''); ?>" required>
							<small class="text-muted">e.g., "Manila, Philippines"</small>
						</div>

						<div class="col-12 col-md-6">
							<label for="duration" class="form-label">Duration <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="duration" name="duration" value="<?php echo set_value('duration', isset($experience) ? $experience->duration : ''); ?>" required>
							<small class="text-muted">e.g., "Jan 2020 - Present" or "2 years"</small>
						</div>

						<div class="col-12">
							<label for="responsibilities" class="form-label">Responsibilities <span class="text-danger">*</span></label>
							<textarea class="form-control" id="responsibilities" name="responsibilities" rows="8" required><?php echo set_value('responsibilities', isset($experience) ? $experience->responsibilities : ''); ?></textarea>
							<small class="text-muted">Enter each responsibility on a new line. These will display as bullet points on your portfolio.</small>
						</div>

						<div class="col-12 col-md-6">
							<label for="display_order" class="form-label">Display Order <span class="text-danger">*</span></label>
							<input type="number" class="form-control" id="display_order" name="display_order" value="<?php echo set_value('display_order', isset($experience) ? $experience->display_order : '0'); ?>" required>
							<small class="text-muted">Lower numbers appear first</small>
						</div>

						<div class="col-12 col-md-6">
							<label class="form-label d-block">Status</label>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" <?php echo set_checkbox('is_active', '1', isset($experience) ? $experience->is_active : TRUE); ?>>
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
							<i class="bi bi-check-circle me-2"></i><?php echo $action == 'edit' ? 'Update' : 'Create'; ?> Experience
						</button>
						<a href="<?php echo site_url('cms/experience'); ?>" class="btn btn-secondary">
							<i class="bi bi-x-circle me-2"></i>Cancel
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<?php $this->load->view('cms/footer'); ?>
