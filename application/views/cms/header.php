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
			--sidebar-width: 260px;
			--sidebar-width-collapsed: 80px;
		}

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		html, body {
			height: 100%;
		}

		body {
			background: #f8f9fa;
			font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
			display: flex;
			flex-direction: column;
		}

		/* Navbar Styling */
		.navbar-cms {
			background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
			padding: 1rem 0;
			z-index: 1030;
		}

		.navbar-brand {
			font-weight: 700;
			font-size: 1.3rem;
			letter-spacing: 0.5px;
		}

		.sidebar-toggle-btn {
			background: rgba(255, 255, 255, 0.1);
			border: none;
			color: white;
			padding: 0.5rem 0.75rem;
			border-radius: 6px;
			cursor: pointer;
			transition: all 0.3s ease;
			font-size: 1.2rem;
		}

		.sidebar-toggle-btn:hover {
			background: rgba(255, 255, 255, 0.2);
		}

		.user-dropdown {
			cursor: pointer;
			transition: color 0.3s ease;
		}

		.user-dropdown:hover {
			color: #ffc107 !important;
		}

		/* Main Container */
		.cms-wrapper {
			display: flex;
			flex: 1;
			overflow: hidden;
		}

		/* Sidebar Styling */
		.sidebar {
			width: var(--sidebar-width);
			background: white;
			border-right: 1px solid #e9ecef;
			box-shadow: 2px 0 8px rgba(0, 0, 0, 0.08);
			overflow-y: auto;
			overflow-x: hidden;
			transition: width 0.3s ease;
			z-index: 1020;
		}

		.sidebar.collapsed {
			width: var(--sidebar-width-collapsed);
		}

		.sidebar-menu {
			padding: 1rem 0;
		}

		.sidebar-menu a {
			display: flex;
			align-items: center;
			padding: 1rem;
			color: #495057;
			text-decoration: none;
			border-left: 3px solid transparent;
			transition: all 0.3s ease;
			font-weight: 500;
			gap: 0.75rem;
		}

		.sidebar-menu a:hover {
			background: #f8f9fa;
			color: var(--primary-color);
			border-left-color: var(--primary-color);
		}

		.sidebar-menu a.active {
			background: #ffe8e8;
			color: var(--primary-color);
			border-left-color: var(--primary-color);
			font-weight: 600;
		}

		.sidebar-menu a i {
			font-size: 1.25rem;
			min-width: 1.5rem;
			text-align: center;
		}

		.sidebar-menu a span {
			white-space: nowrap;
		}

		.sidebar.collapsed .sidebar-menu a span {
			display: none;
		}

		/* Main Content Area */
		.main-content {
			flex: 1;
			display: flex;
			flex-direction: column;
			overflow: hidden;
		}

		.content-area {
			flex: 1;
			overflow-y: auto;
			padding: 2rem;
		}

		/* Cards and Components */
		.card {
			border: none;
			box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
			border-radius: 12px;
			transition: all 0.3s ease;
		}

		.card:hover {
			box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
		}

		.stat-card {
			border-left: 4px solid var(--primary-color);
		}

		.stat-icon {
			font-size: 2.5rem;
			color: var(--primary-color);
		}

		/* Responsive */
		@media (max-width: 768px) {
			.sidebar {
				position: fixed;
				top: 60px;
				left: 0;
				height: calc(100vh - 60px);
				z-index: 1025;
				transform: translateX(-100%);
				transition: transform 0.3s ease;
			}

			.sidebar.show {
				transform: translateX(0);
			}

			.sidebar.collapsed {
				width: var(--sidebar-width);
				transform: translateX(-100%);
			}

			.content-area {
				padding: 1.5rem;
			}

			/* Mobile backdrop overlay */
			.sidebar-backdrop {
				display: none;
				position: fixed;
				top: 60px;
				left: 0;
				width: 100%;
				height: calc(100vh - 60px);
				background: rgba(0, 0, 0, 0.5);
				z-index: 1024;
				opacity: 0;
				transition: opacity 0.3s ease;
			}

			.sidebar-backdrop.show {
				display: block;
				opacity: 1;
			}
		}

		/* Scrollbar Styling */
		.sidebar::-webkit-scrollbar {
			width: 6px;
		}

		.sidebar::-webkit-scrollbar-track {
			background: #f1f1f1;
		}

		.sidebar::-webkit-scrollbar-thumb {
			background: #ccc;
			border-radius: 3px;
		}

		.sidebar::-webkit-scrollbar-thumb:hover {
			background: #999;
		}

		/* Footer Integration */
		.cms-footer {
			background: #fff;
			border-top: 1px solid #e9ecef;
			padding: 1.5rem 2rem;
			margin-left: var(--sidebar-width);
			transition: margin-left 0.3s ease;
		}

		.cms-footer.collapsed {
			margin-left: var(--sidebar-width-collapsed);
		}

		@media (max-width: 768px) {
			.cms-footer {
				margin-left: 0;
			}
		}
	</style>
</head>
<body>
	<!-- Top Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark navbar-cms">
		<div class="container-fluid">
			<button type="button" class="sidebar-toggle-btn me-2" id="sidebarToggle" title="Toggle Sidebar">
				<i class="bi bi-list"></i>
			</button>
			<a class="navbar-brand" href="<?php echo site_url('cms/dashboard'); ?>">
				<i class="bi bi-speedometer2 me-2"></i>Portfolio CMS
			</a>
			<div class="ms-auto">
				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle user-dropdown" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="bi bi-person-circle me-2"></i>
							<span class="d-none d-sm-inline"><?php echo htmlspecialchars($this->session->userdata('full_name')); ?></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
							<li><h6 class="dropdown-header"><?php echo htmlspecialchars($this->session->userdata('email')); ?></h6></li>
							<li><hr class="dropdown-divider"></li>
							<li><a class="dropdown-item" href="<?php echo site_url('cms/change_password'); ?>">
								<i class="bi bi-lock me-2"></i>Change Password
							</a></li>
							<li><hr class="dropdown-divider"></li>
							<li><a class="dropdown-item text-danger" href="<?php echo site_url('auth/logout'); ?>">
								<i class="bi bi-box-arrow-right me-2"></i>Logout
							</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Main Wrapper -->
	<div class="cms-wrapper">
		<!-- Mobile Backdrop -->
		<div class="sidebar-backdrop" id="sidebarBackdrop"></div>

		<!-- Sidebar Menu -->
		<aside class="sidebar" id="sidebar">
			<div class="sidebar-menu">
				<a href="<?php echo site_url('cms/dashboard'); ?>" class="<?php echo strpos(current_url(), 'dashboard') !== FALSE ? 'active' : ''; ?>">
					<i class="bi bi-house-door"></i>
					<span>Dashboard</span>
				</a>
				<a href="<?php echo site_url('cms/portfolio_settings'); ?>" class="<?php echo strpos(current_url(), 'portfolio_settings') !== FALSE ? 'active' : ''; ?>">
					<i class="bi bi-person-badge"></i>
					<span>Portfolio Info</span>
				</a>
				<a href="<?php echo site_url('cms/skills'); ?>" class="<?php echo strpos(current_url(), 'skill') !== FALSE ? 'active' : ''; ?>">
					<i class="bi bi-stars"></i>
					<span>Skills</span>
				</a>
				<a href="<?php echo site_url('cms/experience'); ?>" class="<?php echo strpos(current_url(), 'experience') !== FALSE ? 'active' : ''; ?>">
					<i class="bi bi-building"></i>
					<span>Experience</span>
				</a>
				<a href="<?php echo site_url('cms/education'); ?>" class="<?php echo strpos(current_url(), 'education') !== FALSE ? 'active' : ''; ?>">
					<i class="bi bi-mortarboard"></i>
					<span>Education</span>
				</a>
				<a href="<?php echo site_url('cms/tech_stack'); ?>" class="<?php echo strpos(current_url(), 'tech_stack') !== FALSE ? 'active' : ''; ?>">
					<i class="bi bi-cpu"></i>
					<span>Tech Stack</span>
				</a>
				<a href="<?php echo site_url('cms/projects'); ?>" class="<?php echo strpos(current_url(), 'projects') !== FALSE ? 'active' : ''; ?>">
					<i class="bi bi-briefcase"></i>
					<span>Projects</span>
				</a>
				<a href="<?php echo site_url('cms/users'); ?>" class="<?php echo strpos(current_url(), 'users') !== FALSE ? 'active' : ''; ?>">
					<i class="bi bi-people"></i>
					<span>Users</span>
				</a>
			</div>
		</aside>

		<!-- Main Content -->
		<div class="main-content">
			<div class="content-area">
