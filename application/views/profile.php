<?php $this->load->view('includes/header'); ?>

<div class="navbar navbar-fixed">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="<?php echo site_url('site');?>">Your Contacts</a>
			<ul class="nav">
				<li><?php echo anchor('site/add', 'Add');?></li>
				<li><?php echo anchor('site/delete', 'Delete');?></li>
				<li><?php echo anchor('site/edit', 'Edit');?></li>
			</ul>
			<div class="pull-right">
				<small class="navbar-text">User: <?php echo anchor('site/profile', $this->session->userdata('email'));?></small>
				<a href="<?php echo site_url('site/logout');?>" class="btn" type="submit">Logout</a>
			</div>
		</div>
	</div>
</div>

<div class="container">

	<div class="content">
		<div class="page-header">
			<h1>Change Your Password</h1>
		</div>
		<div class="row">
			<div class="span4">
			<form id="formPassword" class="well" accept-charset="utf-8">
			<input type="text" name="oldpassword" class="span3" placeholder="Old Password" required maxlength="20">
			<input type="text" name="newpassword" class="span3" placeholder="New Password" required maxlength="20">
			<br>
			<input type="submit" class="btn btn-danger btn-large" value="Change Password"/>
			</form>
			</div>
		</div>
		
		<div id="success" class="row" style="display: none">
			<div class="span4">
			<div id="successMessage" class="alert alert-success">
      		</div>
      		</div>
      	</div>
      	
      	<div id="error" class="row" style="display: none">
			<div class="span4">
			<div id="errorMessage" class="alert alert-error">n.
      		</div>
      		</div>
      	</div>
			
	</div>
	
	<script src="<?php echo base_url("js/jquery.js");?>"></script>
	<script>
	$(document).ready(function() {
		
		$("#formPassword").submit(function(){
			
			$("#formPassword input[type='submit']").attr("disabled", "true");
			$("#formPassword input[type='submit']").attr("value", "Sending...");
			$("#success").hide();
			$("#error").hide();
			
			var faction = "<?php echo site_url('site/change_password')?>";
			var fdata = $("#formPassword").serialize();
			$.post(faction, fdata, function(rdata){
				var json = jQuery.parseJSON(rdata);
				if(json.isSuccessful){
					$("#successMessage").html(json.message);
					$("#success").show();
				}else{
					$("#errorMessage").html(json.message);
					$("#error").show();
				}
				
				$("#formPassword input[type='submit']").attr("value", "Change Password");
				$("#formPassword input[name='oldpassword']").val("");
				$("#formPassword input[name='newpassword']").val("");
				$("#formPassword input[type='submit']").removeAttr("disabled");
			});
				
			return false;
		});
	});
	</script>
<?php $this->load->view('includes/footer'); ?>