<?php $this->load->view('cms/header'); ?>

<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success alert-dismissible fade show ms-3 mt-3 me-3" role="alert">
		<i class="bi bi-check-circle-fill me-2"></i>
		<?php echo $this->session->flashdata('success'); ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	</div>
<?php endif; ?>

<?php if (validation_errors()): ?>
	<div class="alert alert-danger alert-dismissible fade show ms-3 mt-3 me-3" role="alert">
		<i class="bi bi-exclamation-triangle-fill me-2"></i>
		<?php echo validation_errors(); ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	</div>
<?php endif; ?>

<!-- Page Title -->
<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="mb-0"><i class="bi bi-person-badge me-2"></i><?php echo $page_title; ?></h1>
	<a href="<?php echo base_url('portfolio'); ?>" class="btn btn-outline-primary btn-sm" target="_blank">
		<i class="bi bi-eye me-2"></i>View Portfolio
	</a>
</div>

<!-- Portfolio Settings Form -->
<form method="post" class="needs-validation" novalidate>
	<div class="row g-3">
		<!-- Personal Information -->
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-white border-0">
					<h5 class="mb-0"><i class="bi bi-person-circle me-2"></i>Personal Information</h5>
				</div>
				<div class="card-body">
					<div class="row g-3">
						<div class="col-12 col-md-6">
							<label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name', isset($portfolio_data['name']) ? $portfolio_data['name'] : ''); ?>" required>
						</div>

						<div class="col-12 col-md-6">
							<label for="tagline" class="form-label">Tagline/Title <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="tagline" name="tagline" value="<?php echo set_value('tagline', isset($portfolio_data['tagline']) ? $portfolio_data['tagline'] : ''); ?>" required>
							<small class="text-muted">e.g., "Web Development Engineer"</small>
						</div>

						<div class="col-12">
							<label for="about" class="form-label">About Me</label>
							<textarea class="form-control" id="about" name="about" rows="5"><?php echo set_value('about', isset($portfolio_data['about']) ? $portfolio_data['about'] : ''); ?></textarea>
							<small class="text-muted">Tell visitors about yourself, your expertise, and what you do</small>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Contact Information -->
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-white border-0">
					<h5 class="mb-0"><i class="bi bi-envelope me-2"></i>Contact Information</h5>
				</div>
				<div class="card-body">
					<div class="row g-3">
						<div class="col-12 col-md-6">
							<label for="email" class="form-label">Personal Email <span class="text-danger">*</span></label>
							<input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email', isset($portfolio_data['email']) ? $portfolio_data['email'] : ''); ?>" required>
						</div>

						<div class="col-12 col-md-6">
							<label for="work_email" class="form-label">Work Email</label>
							<input type="email" class="form-control" id="work_email" name="work_email" value="<?php echo set_value('work_email', isset($portfolio_data['work_email']) ? $portfolio_data['work_email'] : ''); ?>">
						</div>

						<div class="col-12 col-md-6">
							<label for="phone" class="form-label">Phone Number</label>
							<input type="text" class="form-control" id="phone" name="phone" value="<?php echo set_value('phone', isset($portfolio_data['phone']) ? $portfolio_data['phone'] : ''); ?>">
							<small class="text-muted">e.g., "+63 XXX XXX XXXX"</small>
						</div>

						<div class="col-12 col-md-6">
							<label for="location" class="form-label">Location</label>
							<input type="text" class="form-control" id="location" name="location" value="<?php echo set_value('location', isset($portfolio_data['location']) ? $portfolio_data['location'] : ''); ?>">
							<small class="text-muted">e.g., "Bacoor, Cavite, Philippines"</small>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Social Links -->
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-white border-0">
					<h5 class="mb-0"><i class="bi bi-share me-2"></i>Social Media Links</h5>
				</div>
				<div class="card-body">
					<div class="row g-3">
						<div class="col-12 col-md-6">
							<label for="github" class="form-label">GitHub Profile</label>
							<div class="input-group">
								<span class="input-group-text"><i class="bi bi-github"></i></span>
								<input type="url" class="form-control" id="github" name="github" value="<?php echo set_value('github', isset($portfolio_data['github']) ? $portfolio_data['github'] : ''); ?>" placeholder="https://github.com/username">
							</div>
						</div>

						<div class="col-12 col-md-6">
							<label for="linkedin" class="form-label">LinkedIn Profile</label>
							<div class="input-group">
								<span class="input-group-text"><i class="bi bi-linkedin"></i></span>
								<input type="url" class="form-control" id="linkedin" name="linkedin" value="<?php echo set_value('linkedin', isset($portfolio_data['linkedin']) ? $portfolio_data['linkedin'] : ''); ?>" placeholder="https://linkedin.com/in/username">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Professional Details -->
		<div class="col-12">
			<div class="card">
				<div class="card-header bg-white border-0">
					<h5 class="mb-0"><i class="bi bi-star me-2"></i>Professional Details</h5>
				</div>
				<div class="card-body">
					<div class="row g-3">
						<div class="col-12">
							<label for="aspirations" class="form-label">Career Aspirations</label>
							<textarea class="form-control" id="aspirations" name="aspirations" rows="4"><?php echo set_value('aspirations', isset($portfolio_data['aspirations']) ? $portfolio_data['aspirations'] : ''); ?></textarea>
							<small class="text-muted">Describe your career goals and what you're looking to achieve</small>
						</div>

						<div class="col-12">
							<label for="clients_stakeholders" class="form-label">Clients & Stakeholders</label>
							<textarea class="form-control" id="clients_stakeholders" name="clients_stakeholders" rows="4"><?php echo set_value('clients_stakeholders', isset($portfolio_data['clients_stakeholders']) ? $portfolio_data['clients_stakeholders'] : ''); ?></textarea>
							<small class="text-muted">List notable clients or stakeholders you've worked with</small>
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
							<i class="bi bi-check-circle me-2"></i>Save Changes
						</button>
						<a href="<?php echo site_url('cms/dashboard'); ?>" class="btn btn-secondary">
							<i class="bi bi-x-circle me-2"></i>Cancel
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<?php $this->load->view('cms/footer'); ?>
