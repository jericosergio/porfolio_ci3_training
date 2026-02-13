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
		// Sidebar Toggle Functionality
		const sidebar = document.getElementById('sidebar');
		const toggleBtn = document.getElementById('sidebarToggle');
		const footer = document.getElementById('cmsFooter');
		const contentArea = document.querySelector('.content-area');
		
		// Check localStorage for sidebar state
		const isSidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
		if (isSidebarCollapsed) {
			sidebar.classList.add('collapsed');
			footer.classList.add('collapsed');
		}

		// Toggle sidebar on button click
		toggleBtn.addEventListener('click', function() {
			sidebar.classList.toggle('collapsed');
			footer.classList.toggle('collapsed');
			
			// Save state to localStorage
			const isCollapsed = sidebar.classList.contains('collapsed');
			localStorage.setItem('sidebarCollapsed', isCollapsed);
		});

		// Mobile: Show/hide sidebar on menu click
		const sidebarLinks = document.querySelectorAll('.sidebar-menu a');
		sidebarLinks.forEach(link => {
			link.addEventListener('click', function() {
				if (window.innerWidth < 768) {
					sidebar.classList.remove('show');
				}
			});
		});

		// Auto-hide alerts after 5 seconds
		document.querySelectorAll('.alert').forEach(function(alert) {
			setTimeout(function() {
				const bsAlert = new bootstrap.Alert(alert);
				bsAlert.close();
			}, 5000);
		});
	</script>
</body>
</html>
