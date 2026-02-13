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
	<h1 class="mb-0"><i class="bi bi-mortarboard me-2"></i><?php echo $page_title; ?></h1>
	<a href="<?php echo site_url('cms/education'); ?>" class="btn btn-outline-secondary btn-sm">
		<i class="bi bi-arrow-left me-2"></i>Back to Education
	</a>
</div>

<!-- Education Form -->
<form method="post" class="needs-validation" novalidate>
	<div class="row g-3">
		<!-- Education Information -->
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-white border-0">
					<h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Education Details</h5>
				</div>
				<div class="card-body">
					<div class="row g-3">
						<div class="col-12 col-md-8">
							<label for="degree" class="form-label">Degree/Qualification <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="degree" name="degree" value="<?php echo set_value('degree', isset($education) ? $education->degree : ''); ?>" required>
							<small class="text-muted">e.g., "Bachelor of Science in Computer Science"</small>
						</div>

						<div class="col-12 col-md-4">
							<label for="year" class="form-label">Year <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="year" name="year" value="<?php echo set_value('year', isset($education) ? $education->year : ''); ?>" required>
							<small class="text-muted">e.g., "2018-2022"</small>
						</div>

						<div class="col-12 col-md-6">
							<label for="school" class="form-label">School/Institution <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="school" name="school" value="<?php echo set_value('school', isset($education) ? $education->school : ''); ?>" required>
						</div>

						<div class="col-12 col-md-6">
							<label for="location" class="form-label">Location <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="location" name="location" value="<?php echo set_value('location', isset($education) ? $education->location : ''); ?>" required>
							<small class="text-muted">e.g., "Manila, Philippines"</small>
						</div>

						<div class="col-12">
							<label for="honors" class="form-label">Honors/Recognition</label>
							<input type="text" class="form-control" id="honors" name="honors" value="<?php echo set_value('honors', isset($education) ? $education->honors : ''); ?>">
							<small class="text-muted">e.g., "Cum Laude", "Dean's List", "Valedictorian" (optional)</small>
						</div>

						<div class="col-12">
							<label for="highlights" class="form-label">Highlights/Achievements</label>
							<textarea class="form-control" id="highlights" name="highlights" rows="5"><?php echo set_value('highlights', isset($education) ? $education->highlights : ''); ?></textarea>
							<small class="text-muted">Enter each highlight on a new line. These will display as bullet points (optional)</small>
						</div>

						<div class="col-12 col-md-6">
							<label for="display_order" class="form-label">Display Order <span class="text-danger">*</span></label>
							<input type="number" class="form-control" id="display_order" name="display_order" value="<?php echo set_value('display_order', isset($education) ? $education->display_order : '0'); ?>" required>
							<small class="text-muted">Lower numbers appear first</small>
						</div>

						<div class="col-12 col-md-6">
							<label class="form-label d-block">Status</label>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" <?php echo set_checkbox('is_active', '1', isset($education) ? $education->is_active : TRUE); ?>>
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
							<i class="bi bi-check-circle me-2"></i><?php echo $action == 'edit' ? 'Update' : 'Create'; ?> Education
						</button>
						<a href="<?php echo site_url('cms/education'); ?>" class="btn btn-secondary">
							<i class="bi bi-x-circle me-2"></i>Cancel
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<?php $this->load->view('cms/footer'); ?>
