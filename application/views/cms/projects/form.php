<?php $this->load->view('cms/header'); ?>

<!-- Toast UI Editor CSS -->
<link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />

<style>
	.dynamic-field-group {
		background: #f8f9fa;
		padding: 15px;
		margin-bottom: 10px;
		border-radius: 5px;
		border-left: 3px solid var(--primary-color);
	}
</style>

<?php if ($this->session->flashdata('error')): ?>
	<div class="alert alert-danger alert-dismissible fade show ms-3 mt-3 me-3" role="alert">
		<i class="bi bi-exclamation-triangle-fill me-2"></i>
		<?php echo $this->session->flashdata('error'); ?>
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

<div class="row g-3">
	<div class="col-12 col-lg-10 offset-lg-1">
		<div class="card">
			<div class="card-header bg-white border-0">
				<h5 class="mb-0"><i class="bi bi-folder-plus me-2"></i><?php echo $page_title; ?></h5>
			</div>
			<div class="card-body">
						<?php echo form_open_multipart('', array('class' => 'needs-validation')); ?>
							
							<div class="row">
								<div class="col-md-6 mb-3">
									<label for="slug" class="form-label">Slug (URL-friendly) <span class="text-danger">*</span></label>
									<input type="text" class="form-control <?php echo form_error('slug') ? 'is-invalid' : ''; ?>" 
										   id="slug" name="slug" 
										   value="<?php echo set_value('slug', isset($project) ? $project['slug'] : ''); ?>" required>
									<?php echo form_error('slug', '<div class="invalid-feedback">', '</div>'); ?>
								</div>

								<div class="col-md-6 mb-3">
									<label for="title" class="form-label">Project Title <span class="text-danger">*</span></label>
									<input type="text" class="form-control <?php echo form_error('title') ? 'is-invalid' : ''; ?>" 
										   id="title" name="title" 
										   value="<?php echo set_value('title', isset($project) ? $project['title'] : ''); ?>" required>
									<?php echo form_error('title', '<div class="invalid-feedback">', '</div>'); ?>
								</div>
							</div>

							<div class="mb-3">
								<label for="description" class="form-label">Short Description <span class="text-danger">*</span></label>
								<textarea class="form-control <?php echo form_error('description') ? 'is-invalid' : ''; ?>" 
										  id="description" name="description" rows="3" required><?php echo set_value('description', isset($project) ? $project['description'] : ''); ?></textarea>
								<div class="form-text">Brief project summary (displayed on portfolio cards)</div>
								<?php echo form_error('description', '<div class="invalid-feedback">', '</div>'); ?>
							</div>

							<div class="mb-3">
								<label for="full_description" class="form-label">Full Description</label>
							<div id="editor"></div>
							<textarea class="form-control d-none" id="full_description" name="full_description"><?php echo set_value('full_description', isset($project) ? $project['full_description'] : ''); ?></textarea>

							<div class="row">
								<div class="col-md-6 mb-3">
									<label for="tech" class="form-label">Technologies <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="tech" name="tech" 
										   value="<?php echo set_value('tech', isset($project) ? $project['tech'] : ''); ?>" required>
									<div class="form-text">Comma-separated (e.g., "PHP, MySQL, Bootstrap")</div>
								</div>

								<div class="col-md-3 mb-3">
									<label for="timeline" class="form-label">Timeline</label>
									<input type="text" class="form-control" id="timeline" name="timeline" 
										   value="<?php echo set_value('timeline', isset($project) ? $project['timeline'] : ''); ?>">
									<div class="form-text">e.g., "Jan 2024 - Present"</div>
								</div>

								<div class="col-md-3 mb-3">
									<label for="event" class="form-label">Event/Context</label>
									<input type="text" class="form-control" id="event" name="event" 
										   value="<?php echo set_value('event', isset($project) ? $project['event'] : ''); ?>">
								</div>
							</div>

							<div class="row">
								<div class="col-md-6 mb-3">
									<label for="image" class="form-label">Main Image</label>
									<input type="file" class="form-control" id="image" name="image" accept="image/*">
									<?php if (isset($project) && $project['image']): ?>
										<div class="mt-2">
											<img src="<?php echo htmlspecialchars($project['image'], ENT_QUOTES, 'UTF-8'); ?>" class="img-thumbnail" style="max-height: 100px; cursor: pointer;" alt="Main image"
												 data-bs-toggle="modal" data-bs-target="#imagePreviewModal" data-image="<?php echo htmlspecialchars($project['image'], ENT_QUOTES, 'UTF-8'); ?>">
											<div class="form-check mt-1">
												<input type="checkbox" class="form-check-input" id="remove_main_image" name="remove_main_image" value="1">
												<label class="form-check-label small" for="remove_main_image">Remove this image</label>
											</div>
										</div>
									<?php endif; ?>
								</div>

								<div class="col-md-6 mb-3">
									<label for="featured_image" class="form-label">Featured Image</label>
									<input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*">
									<?php if (isset($project) && isset($project['featured_image'])): ?>
										<div class="mt-2">
											<img src="<?php echo htmlspecialchars($project['featured_image'], ENT_QUOTES, 'UTF-8'); ?>" class="img-thumbnail" style="max-height: 100px; cursor: pointer;" alt="Featured image"
												 data-bs-toggle="modal" data-bs-target="#imagePreviewModal" data-image="<?php echo htmlspecialchars($project['featured_image'], ENT_QUOTES, 'UTF-8'); ?>">
											<div class="form-check mt-1">
												<input type="checkbox" class="form-check-input" id="remove_featured_image" name="remove_featured_image" value="1">
												<label class="form-check-label small" for="remove_featured_image">Remove this image</label>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>

							<div class="mb-3">
								<label for="gallery_images" class="form-label">Gallery Images (Multiple)</label>
								<input type="file" class="form-control" id="gallery_images" name="gallery_images[]" accept="image/*" multiple>
								<div class="form-text">Select multiple images for the project gallery (Hold Ctrl/Cmd to select multiple files)</div>
								<?php if (isset($project) && !empty($project['images'])): ?>
									<div class="mt-3">
										<strong class="d-block mb-2">Current Gallery Images:</strong>
										<div class="row g-3" id="current-gallery-images">
											<?php 
											$image_index = 0;
											foreach ($project['images'] as $img): 
											?>
												<div class="col-md-3">
													<div class="card position-relative">
														<img src="<?php echo htmlspecialchars($img, ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top" alt="Gallery image" style="height: 150px; object-fit: cover; cursor: pointer;"
															 data-bs-toggle="modal" data-bs-target="#imagePreviewModal" data-image="<?php echo htmlspecialchars($img, ENT_QUOTES, 'UTF-8'); ?>">
														<div class="card-body p-2">
															<div class="form-check">
																<input type="checkbox" class="form-check-input" id="remove_gallery_<?php echo $image_index; ?>" 
																	   name="remove_gallery_images[]" value="<?php echo htmlspecialchars($img, ENT_QUOTES, 'UTF-8'); ?>">
																<label class="form-check-label small" for="remove_gallery_<?php echo $image_index; ?>">
																	Remove
																</label>
															</div>
														</div>
													</div>
												</div>
											<?php 
											$image_index++;
											endforeach; 
											?>
										</div>
									</div>
								<?php endif; ?>
							</div>

							<div class="row">
								<div class="col-md-4 mb-3">
									<label for="display_order" class="form-label">Display Order <span class="text-danger">*</span></label>
									<input type="number" class="form-control" id="display_order" name="display_order" 
										   value="<?php echo set_value('display_order', isset($project) ? $project['display_order'] : '1'); ?>" required>
									<div class="form-text">Lower numbers appear first</div>
								</div>

								<div class="col-md-4 mb-3 form-check mt-5">
									<input type="checkbox" class="form-check-input" id="featured" name="featured" value="1"
										   <?php echo set_checkbox('featured', '1', isset($project) ? $project['featured'] : FALSE); ?>>
									<label class="form-check-label" for="featured">Featured Project</label>
								</div>

								<div class="col-md-4 mb-3 form-check mt-5">
									<input type="checkbox" class="form-check-input" id="is_training" name="is_training" value="1"
										   <?php echo set_checkbox('is_training', '1', isset($project) ? $project['is_training'] : FALSE); ?>>
									<label class="form-check-label" for="is_training">Training Module</label>
								</div>
							</div>

							<div class="mb-3 form-check">
								<input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
									   <?php echo set_checkbox('is_active', '1', isset($project) ? $project['is_active'] : TRUE); ?>>
								<label class="form-check-label" for="is_active">Active (Display on portfolio)</label>
							</div>

							<hr class="my-4">

							<h5 class="mb-3"><i class="bi bi-bar-chart me-2"></i>Project Metrics</h5>
							<div id="metrics-container">
								<!-- Metrics will be added here dynamically -->
						</div>
						<button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="add-metric">
							<i class="bi bi-plus-circle me-1"></i>Add Metric
						</button>

						<hr class="my-4">

						<h5 class="mb-3"><i class="bi bi-star me-2"></i>Project Highlights</h5>
						<div id="highlights-container">
							<!-- Highlights will be added here dynamically -->
						</div>
						<button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="add-highlight">
							<i class="bi bi-plus-circle me-1"></i>Add Highlight
						</button>

						<hr class="my-4">

						<div class="d-flex gap-2">
							<button type="submit" class="btn btn-primary">
								<i class="bi bi-check-circle me-1"></i>Save Project
							</button>
							<a href="<?php echo base_url('cms/projects'); ?>" class="btn btn-secondary">
								<i class="bi bi-x-circle me-1"></i>Cancel
							</a>
						</div>

						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
	<script>
		// Initialize TOAST UI Editor
		const editor = new toastui.Editor({
			el: document.querySelector('#editor'),
			height: '400px',
			initialEditType: 'markdown',
			previewStyle: 'vertical',
			initialValue: document.querySelector('#full_description').value,
			placeholder: 'Write your project description in markdown...',
			toolbarItems: [
				['heading', 'bold', 'italic', 'strike'],
				['hr', 'quote'],
				['ul', 'ol', 'task', 'indent', 'outdent'],
				['table', 'link', 'image'],
				['code', 'codeblock'],
				['scrollSync']
			]
		});

		// Sync editor content to hidden textarea before form submit
		document.querySelector('form').addEventListener('submit', function(e) {
			document.querySelector('#full_description').value = editor.getMarkdown();
		});

		let metricCounter = 0;
		let highlightCounter = 0;

		// Load existing metrics if in edit mode
		<?php if (isset($project) && !empty($project['metrics'])): ?>
		<?php foreach ($project['metrics'] as $label => $value): ?>
		metricCounter++;
		$('#metrics-container').append(`
			<div class="dynamic-field-group" id="metric-${metricCounter}">
				<div class="row">
					<div class="col-md-4">
						<input type="text" class="form-control" name="metrics[${metricCounter}][label]" placeholder="Metric Label" value="<?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?>" required>
					</div>
					<div class="col-md-4">
						<input type="text" class="form-control" name="metrics[${metricCounter}][value]" placeholder="Metric Value" value="<?php echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); ?>" required>
					</div>
					<div class="col-md-3">
						<input type="number" class="form-control" name="metrics[${metricCounter}][order]" placeholder="Order" value="${metricCounter}" required>
					</div>
					<div class="col-md-1">
						<button type="button" class="btn btn-sm btn-outline-danger remove-field" data-target="metric-${metricCounter}">
							<i class="bi bi-trash"></i>
						</button>
					</div>
				</div>
			</div>
		`);
		<?php endforeach; ?>
		<?php endif; ?>

		// Load existing highlights if in edit mode
		<?php if (isset($project) && !empty($project['highlights'])): ?>
		<?php foreach ($project['highlights'] as $highlight): ?>
		highlightCounter++;
		$('#highlights-container').append(`
			<div class="dynamic-field-group" id="highlight-${highlightCounter}">
				<div class="row">
					<div class="col-md-10">
						<input type="text" class="form-control" name="highlights[${highlightCounter}][text]" placeholder="Highlight Text" value="<?php echo htmlspecialchars($highlight, ENT_QUOTES, 'UTF-8'); ?>" required>
					</div>
					<div class="col-md-1">
						<input type="number" class="form-control" name="highlights[${highlightCounter}][order]" placeholder="Order" value="${highlightCounter}" required>
					</div>
					<div class="col-md-1">
						<button type="button" class="btn btn-sm btn-outline-danger remove-field" data-target="highlight-${highlightCounter}">
							<i class="bi bi-trash"></i>
						</button>
					</div>
				</div>
			</div>
		`);
		<?php endforeach; ?>
		<?php endif; ?>

		// Add Metric
		$('#add-metric').click(function() {
			metricCounter++;
			const html = `
				<div class="dynamic-field-group" id="metric-${metricCounter}">
					<div class="row">
						<div class="col-md-4">
							<input type="text" class="form-control" name="metrics[${metricCounter}][label]" placeholder="Metric Label" required>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" name="metrics[${metricCounter}][value]" placeholder="Metric Value" required>
						</div>
						<div class="col-md-3">
							<input type="number" class="form-control" name="metrics[${metricCounter}][order]" placeholder="Order" value="${metricCounter}" required>
						</div>
						<div class="col-md-1">
							<button type="button" class="btn btn-sm btn-outline-danger remove-field" data-target="metric-${metricCounter}">
								<i class="bi bi-trash"></i>
							</button>
						</div>
					</div>
				</div>
			`;
			$('#metrics-container').append(html);
		});

		// Add Highlight
		$('#add-highlight').click(function() {
			highlightCounter++;
			const html = `
				<div class="dynamic-field-group" id="highlight-${highlightCounter}">
					<div class="row">
						<div class="col-md-10">
							<input type="text" class="form-control" name="highlights[${highlightCounter}][text]" placeholder="Highlight Text" required>
						</div>
						<div class="col-md-1">
							<input type="number" class="form-control" name="highlights[${highlightCounter}][order]" placeholder="Order" value="${highlightCounter}" required>
						</div>
						<div class="col-md-1">
							<button type="button" class="btn btn-sm btn-outline-danger remove-field" data-target="highlight-${highlightCounter}">
								<i class="bi bi-trash"></i>
							</button>
						</div>
					</div>
				</div>
			`;
			$('#highlights-container').append(html);
		});

		// Remove Field
		$(document).on('click', '.remove-field', function() {
			const target = $(this).data('target');
			$('#' + target).remove();
		});

		// Generate slug from title
		$('#title').on('input', function() {
			if (!$('#slug').val()) {
				const slug = $(this).val()
					.toLowerCase()
					.replace(/[^a-z0-9]+/g, '-')
					.replace(/^-+|-+$/g, '');
				$('#slug').val(slug);
			}
		});

		// Handle image preview modal - create instance once
		let imagePreviewModal = null;
		$(document).on('click', '[data-image]', function(e) {
			const imageSrc = $(this).data('image');
			if (imageSrc) {
				$('#modalImage').attr('src', imageSrc);
				if (!imagePreviewModal) {
					imagePreviewModal = new bootstrap.Modal(document.getElementById('imagePreviewModal'), {
						backdrop: true,
						keyboard: true
					});
				}
				imagePreviewModal.show();
			}
		});

		// Clean up modal backdrop when modal is hidden
		$(document).ready(function() {
			const modalElement = document.getElementById('imagePreviewModal');
			if (modalElement) {
				modalElement.addEventListener('hidden.bs.modal', function() {
					// Remove any lingering backdrop
					const backdrops = document.querySelectorAll('.modal-backdrop');
					backdrops.forEach(backdrop => backdrop.remove());
				});
			}
		});

	</script>

<!-- Image Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<div class="modal-content bg-dark">
			<div class="modal-header border-secondary">
				<h5 class="modal-title text-white" id="imagePreviewLabel">Image Preview</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body text-center p-0 d-flex align-items-center justify-content-center" style="min-height: 80vh;">
				<img id="modalImage" src="" alt="Preview" class="img-fluid" style="max-width: 95%; max-height: 90vh; object-fit: contain;">
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('cms/footer'); ?>
