<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $page_title; ?> - Portfolio CMS</title>
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/favicon.ico'); ?>">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<style>
		:root {
			--primary-color: #a12124;
			--dark-color: #343434;
		}
		.navbar-cms {
			background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);
		}
		.card {
			border: none;
			box-shadow: 0 2px 8px rgba(0,0,0,0.1);
			border-radius: 10px;
		}
		.btn-primary {
			background-color: var(--primary-color);
			border-color: var(--primary-color);
		}
		.btn-primary:hover {
			background-color: var(--dark-color);
			border-color: var(--dark-color);
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark navbar-cms mb-4">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?php echo base_url('cms/dashboard'); ?>">
				<i class="bi bi-speedometer2 me-2"></i>Portfolio CMS
			</a>
		</div>
	</nav>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<div class="card">
					<div class="card-header bg-white py-3">
						<h5 class="mb-0"><i class="bi bi-award me-2"></i><?php echo $page_title; ?></h5>
					</div>
					<div class="card-body">
						<?php echo form_open('', array('class' => 'needs-validation', 'novalidate' => '')); ?>
							
							<div class="mb-3">
								<label for="name" class="form-label">Skill Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control <?php echo form_error('name') ? 'is-invalid' : ''; ?>" 
									   id="name" name="name" 
									   value="<?php echo set_value('name', isset($skill) ? $skill->name : ''); ?>" required>
								<?php echo form_error('name', '<div class="invalid-feedback">', '</div>'); ?>
							</div>

							<div class="mb-3">
								<label for="level" class="form-label">Proficiency Level (0-100) <span class="text-danger">*</span></label>
								<input type="number" class="form-control <?php echo form_error('level') ? 'is-invalid' : ''; ?>" 
									   id="level" name="level" min="0" max="100"
									   value="<?php echo set_value('level', isset($skill) ? $skill->level : '85'); ?>" required>
								<div class="form-text">Enter a value between 0 and 100</div>
								<?php echo form_error('level', '<div class="invalid-feedback">', '</div>'); ?>
							</div>

							<div class="mb-3">
								<label for="display_order" class="form-label">Display Order <span class="text-danger">*</span></label>
								<input type="number" class="form-control <?php echo form_error('display_order') ? 'is-invalid' : ''; ?>" 
									   id="display_order" name="display_order" 
									   value="<?php echo set_value('display_order', isset($skill) ? $skill->display_order : '1'); ?>" required>
								<div class="form-text">Lower numbers appear first</div>
								<?php echo form_error('display_order', '<div class="invalid-feedback">', '</div>'); ?>
							</div>

							<div class="mb-3 form-check">
								<input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
									   <?php echo set_checkbox('is_active', '1', isset($skill) ? $skill->is_active : TRUE); ?>>
								<label class="form-check-label" for="is_active">Active (Display on portfolio)</label>
							</div>

							<div class="d-flex gap-2">
								<button type="submit" class="btn btn-primary">
									<i class="bi bi-check-circle me-1"></i>Save Skill
								</button>
								<a href="<?php echo base_url('cms/skills'); ?>" class="btn btn-secondary">
									<i class="bi bi-x-circle me-1"></i>Cancel
								</a>
							</div>

						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
