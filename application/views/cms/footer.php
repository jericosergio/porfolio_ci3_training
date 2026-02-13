			</div>
		</div>
	</div>

	<!-- Footer -->
	<footer class="cms-footer bg-white border-top" id="cmsFooter">
		<div class="d-flex justify-content-between align-items-center">
			<div>
				<p class="mb-0 text-muted small">&copy; <?php echo date('Y'); ?> Portfolio CMS. All rights reserved.</p>
			</div>
			<div class="text-end">
				<small class="text-muted">Logged in as: <strong><?php echo htmlspecialchars($this->session->userdata('username')); ?></strong></small>
			</div>
		</div>
	</footer>

	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.1/Sortable.min.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Initialize Bootstrap components explicitly
			if (typeof bootstrap !== 'undefined') {
				// Initialize all dropdowns
				const dropdownElementList = document.querySelectorAll('[data-bs-toggle="dropdown"]');
				const dropdownList = [...dropdownElementList].map(dropdownToggleEl => new bootstrap.Dropdown(dropdownToggleEl));
				console.log('Bootstrap dropdowns initialized');
			} else {
				console.error('Bootstrap is not loaded');
			}
			
			// Sidebar Toggle Functionality
			const sidebar = document.getElementById('sidebar');
			const toggleBtn = document.getElementById('sidebarToggle');
			const footer = document.getElementById('cmsFooter');
			const backdrop = document.getElementById('sidebarBackdrop');
			const contentArea = document.querySelector('.content-area');
			
			// Verify elements exist
			if (!sidebar || !toggleBtn || !footer || !backdrop) {
				console.error('Required elements not found:', {
					sidebar: !!sidebar,
					toggleBtn: !!toggleBtn,
					footer: !!footer,
					backdrop: !!backdrop
				});
				return;
			}
			
			console.log('Sidebar toggle elements found');
			
			// Check localStorage for sidebar state
			const isSidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
			if (isSidebarCollapsed && window.innerWidth >= 768) {
				sidebar.classList.add('collapsed');
				footer.classList.add('collapsed');
			}

			// Toggle sidebar on button click
			toggleBtn.addEventListener('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				console.log('Toggle button clicked');
				
				// Desktop: collapse/expand
				if (window.innerWidth >= 768) {
					sidebar.classList.toggle('collapsed');
					footer.classList.toggle('collapsed');
					
					// Save state to localStorage
					const isCollapsed = sidebar.classList.contains('collapsed');
					localStorage.setItem('sidebarCollapsed', isCollapsed);
				} else {
					// Mobile: show/hide sidebar
					sidebar.classList.toggle('show');
					backdrop.classList.toggle('show');
				}
			});

			// Mobile: Hide sidebar when clicking backdrop
			backdrop.addEventListener('click', function() {
				sidebar.classList.remove('show');
				backdrop.classList.remove('show');
			});

			// Mobile: Hide sidebar after clicking a link
			const sidebarLinks = document.querySelectorAll('.sidebar-menu a');
			sidebarLinks.forEach(link => {
				link.addEventListener('click', function() {
					if (window.innerWidth < 768) {
						sidebar.classList.remove('show');
						backdrop.classList.remove('show');
					}
				});
			});

			// Adjust sidebar on window resize
			window.addEventListener('resize', function() {
				if (window.innerWidth >= 768) {
					sidebar.classList.remove('show');
					backdrop.classList.remove('show');
					if (localStorage.getItem('sidebarCollapsed') === 'true') {
						sidebar.classList.add('collapsed');
						footer.classList.add('collapsed');
					}
				} else {
					sidebar.classList.remove('collapsed');
					footer.classList.remove('collapsed');
				}
			});

			// Auto-hide alerts after 5 seconds
			document.querySelectorAll('.alert').forEach(function(alert) {
				setTimeout(function() {
					const bsAlert = new bootstrap.Alert(alert);
					bsAlert.close();
				}, 5000);
			});
		});
	</script>
</body>
</html>
