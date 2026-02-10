<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css">

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
		text-decoration: none;
	}

	a:hover {
		color: #97310e;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
		min-height: 96px;
	}

	p {
		margin: 0 0 10px;
		padding:0;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}

	.btn {
		background-color: #003399;
		color: white;
		padding: 10px 20px;
		border: none;
		border-radius: 4px;
		cursor: pointer;
		font-size: 14px;
		margin: 20px;
	}

	.btn:hover {
		background-color: #97310e;
	}

	.modal {
		display: none;
		position: fixed;
		z-index: 1000;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		overflow: auto;
		background-color: rgba(0,0,0,0.4);
	}

	.modal-content {
		background-color: #fefefe;
		margin: 5% auto;
		padding: 20px;
		border: 1px solid #888;
		width: 80%;
		max-width: 600px;
		border-radius: 5px;
	}

	.close {
		color: #aaa;
		float: right;
		font-size: 28px;
		font-weight: bold;
		cursor: pointer;
	}

	.close:hover,
	.close:focus {
		color: #000;
	}

	.form-group {
		margin-bottom: 15px;
	}

	.form-group label {
		display: block;
		margin-bottom: 5px;
		font-weight: bold;
	}

	.form-group input,
	.form-group select {
		width: 100%;
		padding: 8px;
		border: 1px solid #ddd;
		border-radius: 4px;
		box-sizing: border-box;
	}
	</style>
</head>
<body>

<div id="container">
	<button class="btn" onclick="openModal()">Add New User</button>
	
	<table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
		<thead>
			<tr style="background-color: #f2f2f2;">
				<th style="border: 1px solid #ddd; padding: 8px; text-align: left;">ID</th>
				<th style="border: 1px solid #ddd; padding: 8px; text-align: left;">First Name</th>
				<th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Middle Name</th>
				<th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Last Name</th>
				<th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Created Date</th>
				<th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Update Date</th>
				<th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Valid</th>
				<th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($users as $user): ?>
			<tr>
				<td style="border: 1px solid #ddd; padding: 8px;"><?php echo $user['id']; ?></td>
				<td style="border: 1px solid #ddd; padding: 8px;"><?php echo $user['first_name']; ?></td>
				<td style="border: 1px solid #ddd; padding: 8px;"><?php echo $user['middle_name'] ?? 'N/A'; ?></td>
				<td style="border: 1px solid #ddd; padding: 8px;"><?php echo $user['last_name']; ?></td>
				<td style="border: 1px solid #ddd; padding: 8px;"><?php echo $user['created_date']; ?></td>
				<td style="border: 1px solid #ddd; padding: 8px;"><?php echo $user['update_date']; ?></td>
				<td style="border: 1px solid #ddd; padding: 8px;"><?php echo $user['valid'] ? 'Yes' : 'No'; ?></td>
				<td style="border: 1px solid #ddd; padding: 8px;">
					<a class="btn" style="padding: 6px 10px; margin: 0; background-color: #666;" href="<?php echo base_url('welcome/delete_user/' . $user['id']); ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

<!-- Modal -->
<div id="userModal" class="modal">
	<div class="modal-content">
		<span class="close" onclick="closeModal()">&times;</span>
		<h2>Add New User</h2>
		<form action="<?php echo base_url('welcome/insert_user'); ?>" method="POST">
			<div class="form-group">
				<label for="first_name">First Name:</label>
				<input type="text" id="first_name" name="fname" required>
			</div>
			<div class="form-group">
				<label for="middle_name">Middle Name:</label>
				<input type="text" id="middle_name" name="mname">
			</div>
			<div class="form-group">
				<label for="last_name">Last Name:</label>
				<input type="text" id="last_name" name="lname" required>
			</div>
		
			<button type="submit" class="btn">Submit</button>
			<button type="button" class="btn" onclick="closeModal()" style="background-color: #666;">Cancel</button>
		</form>
	</div>
</div>

<script>
	function openModal() {
		document.getElementById('userModal').style.display = 'block';
	}

	function closeModal() {
		document.getElementById('userModal').style.display = 'none';
	}

	// Close modal when clicking outside of it
	window.onclick = function(event) {
		var modal = document.getElementById('userModal');
		if (event.target == modal) {
			closeModal();
		}
	}
</script>
	<script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
	<?php $flash_message = $this->session->flashdata('msg_box'); ?>
	<?php if (!empty($flash_message)): ?>
	<script>
		iziToast.show({
			title: 'Notice',
			message: <?php echo json_encode($flash_message); ?>,
			position: 'topRight',
			timeout: 4000
		});
	</script>
	<?php endif; ?>

</body>
</html>
