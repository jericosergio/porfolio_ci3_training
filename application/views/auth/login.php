<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CMS Login - Portfolio Management</title>
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/favicon.ico'); ?>">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<style>
		body {
			background: linear-gradient(135deg, #a12124 0%, #343434 100%);
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.login-card {
			max-width: 450px;
			width: 100%;
			background: white;
			border-radius: 15px;
			box-shadow: 0 15px 50px rgba(0,0,0,0.3);
		}
		.login-header {
			background: linear-gradient(135deg, #a12124 0%, #7a1a1c 100%);
			color: white;
			padding: 30px;
			border-radius: 15px 15px 0 0;
			text-align: center;
		}
		.login-body {
			padding: 40px;
		}
		.form-control:focus {
			border-color: #a12124;
			box-shadow: 0 0 0 0.2rem rgba(161, 33, 36, 0.25);
		}
		.btn-login {
			background: linear-gradient(135deg, #a12124 0%, #7a1a1c 100%);
			border: none;
			padding: 12px;
			font-weight: 500;
		}
		.btn-login:hover {
			background: linear-gradient(135deg, #7a1a1c 0%, #a12124 100%);
		}
		.back-link {
			color: #a12124;
			text-decoration: none;
		}
		.back-link:hover {
			color: #7a1a1c;
		}
	</style>
</head>
<body>
	<div class="login-card">
		<div class="login-header">
			<h2 class="mb-0"><i class="bi bi-shield-lock-fill me-2"></i>CMS Login</h2>
			<p class="mb-0 mt-2">Portfolio Management System</p>
		</div>
		<div class="login-body">
			<?php if ($this->session->flashdata('error')): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<i class="bi bi-exclamation-triangle-fill me-2"></i>
					<?php echo $this->session->flashdata('error'); ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				</div>
			<?php endif; ?>

			<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="bi bi-check-circle-fill me-2"></i>
					<?php echo $this->session->flashdata('success'); ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				</div>
			<?php endif; ?>

			<?php echo form_open('auth/login', array('id' => 'loginForm')); ?>
				<div class="mb-4">
					<label for="username" class="form-label"><i class="bi bi-person-fill me-2"></i>Username</label>
					<input type="text" class="form-control form-control-lg" id="username" name="username" required autofocus>
					<?php echo form_error('username', '<div class="text-danger small mt-1">', '</div>'); ?>
				</div>

				<div class="mb-4">
					<label for="password" class="form-label"><i class="bi bi-lock-fill me-2"></i>Password</label>
					<input type="password" class="form-control form-control-lg" id="password" name="password" required>
					<?php echo form_error('password', '<div class="text-danger small mt-1">', '</div>'); ?>
				</div>

				<div class="d-grid mb-3">
					<button type="submit" class="btn btn-primary btn-lg btn-login">
						<i class="bi bi-box-arrow-in-right me-2"></i>Login
					</button>
				</div>

				<div class="text-center">
					<a href="<?php echo base_url('portfolio'); ?>" class="back-link">
						<i class="bi bi-arrow-left me-1"></i>Back to Portfolio
					</a>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
