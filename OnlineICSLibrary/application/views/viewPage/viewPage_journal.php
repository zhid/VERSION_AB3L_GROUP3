<! DOCTYPE html>
<html>	
	<head>
		<title>
			ONLINE ICS LIBRARY
		</title>
		<link rel="stylesheet" type="text/css" href="<?php $this->load->helper('url'); echo base_url();?>stylesheet/home_page.css"/>
		<link rel="stylesheet" type="text/css" href="<?php $this->load->helper('url'); echo base_url();?>stylesheet/mylib.css"/>
		
		<script type="text/javascript" src="<?php $this->load->helper('url'); echo base_url();?>javascript/jquery-1.9.0.js"></script>
		<script type="text/javascript" src="<?php $this->load->helper('url'); echo base_url();?>javascript/jquery-1.9.0.min.js"></script>
		<script type="text/javascript" src="<?php $this->load->helper('url'); echo base_url();?>javascript/slides.min.jquery.js"></script>
		
		<script>
			$(document).ready(function() {
				var form_data = {
					is_ajax: 1
				};
				
				$.ajax({
					type: "POST",
					url: '<?php $this->load->helper('url'); echo base_url();?>index.php/homePage/home/displayAccountBox',
					data: form_data,
					success: function(response)
					{
						if(response != 'not logged in')
						{
							$("#left_header").html("<a href='<?php $this->load->helper('url'); echo base_url();?>index.php/homePage/home/logout'><img src='<?php $this->load->helper('url'); echo base_url();?>images/logout.png' width=80  height=50/></a>");
						}
					}
				});
				return false;
			});
			
			$(function() {
				$('#not_member span').click(function () {
					$('#overlay').fadeIn('fast');
					$('#form_externalcontainer').fadeIn('fast');
					$('#catalog').fadeOut('fast');
				});
			});
			
			$(function() {
				$('#signup').click(function () {
					$('#overlay').fadeIn('fast');
					$('#form_externalcontainer').fadeIn('fast');
					$('#catalog').fadeOut('fast');
				});
			});
			
			$(function() {
				$('#login').click(function () {
					$('#overlay').fadeIn('fast');
					$('#catalog').fadeIn('fast');
					$('#form_externalcontainer').fadeOut('fast');
				});
			});
			
			$(function() {
				$('#cancel1 img').click(function () {
					$('#overlay').fadeOut('fast');
					$('#catalog').fadeOut('fast');
				});
			});
			
			$(function() {
				$('#cancel2 img').click(function () {
					$('#overlay').fadeOut('fast');
					$('#form_externalcontainer').fadeOut('fast');
				});
			});
			
			$(function() {
				$('#success_button').click(function () {
					$('#overlay').fadeOut('fast');
					$('#success_box').fadeOut('fast');
					window.location = '<?php $this->load->helper('url'); echo base_url();?>index.php/myLibrary/mylibrary';
				});
			});
			
			$(function() {
				$('#registration_form').submit(function() {
					var action = $("#registration_form").attr('action');
					$.ajax({
						type: "POST",
						url: action,
						data: $("#registration_form").serialize(),
						success: function(response)
						{
							if(response == 'success')
							{
								$('#form_externalcontainer').fadeOut('fast', function() {
									$('#overlay').fadeIn('fast');
									$('#success_box').fadeIn('fast');
								});
							}
							else if(response == 'failed')
							{
								$('#registration_comment').html('REGISTRATION FAILED! PLEASE TRY CHANGING THE USERNAME.');
								$("#registration_comment").css({"background-color":"red"});
							}
						}	
					});
					return false;
				});
			});
			
			$(function() {
				$('#loginsubmit').click(function() {
					var action = $("#loginform").attr('action');
					var form_data = {
						username: $("#loginform #username").val(),
						password: $("#loginform #password").val(),
						usertype: $("#loginform #usertype").val(),
						is_ajax: 1
					};
					
					$.ajax({
						type: "POST",
						url: action,
						data: form_data,
						success: function(response)
						{
							if(response == 'fail')
							{
								$("#login_comment").html("LOG IN FAILED!");
								$("#login_comment").css({"background-color":"red"});
							}
							else
							{
								window.location = '<?php $this->load->helper('url'); echo base_url();?>index.php/myLibrary/mylibrary';
							}
						}
					});
					return false;
				});
			});
			
			$(function() {
				$('#usertype').change(
					function() {
						var user_type = $(this).val();
					
						var form_data = {
							user_type: $(this).val(),
							is_ajax: 1
						};
						
						$.ajax({
							type: "POST",
							url: '<?php $this->load->helper('url'); echo base_url();?>index.php/registerPage/register/loadUserNumber',
							data: form_data,
							success: function(response)
							{
								$("#for_user_num").html(response);
							}
						});
						return false;
					}
				);
			});
			
		
			$(function(){
				$('#images').slides({
					preload: true,
					preloadImage: '<?php $this->load->helper('url'); echo base_url();?>images/loading.png',
					play: 5000,
					pause: 2500,
					hoverPause: true
				});
			});
		</script>
	</head>
	
	<body>
		<div id="overlay" style="display:none;"></div>
		
		<div id="success_box" style="display:none;"> 
			<div id="success_message">
				<h1>Registration Successful</h1>
				<p>Your account is pending for approval, comeback after 24hours</p>
				<input type="button" id="success_button" value="okay!"/>
			</div>
			
			<div id="success_image">
				<img src="<?php $this->load->helper('url'); echo base_url();?>images/success-icon.png" width=300 height=300 alt="success"/>
			</div>
		</div>
		
		<div id= "form_externalcontainer" style="display:none;">
			<div id="container_header">
				<h2>CREATE YOUR LIBRARY ACCOUNT</h2>
			</div>
			
			<div id="cancel2">
				<img src="<?php $this->load->helper('url'); echo base_url();?>images/cancel.png" width="30" height="30" alt="account picture"/>
			</div>
			
			<div id="registration_comment">
				
			</div>
			
			<div id="form_container">
				<form id = "registration_form" name = "registration_form" action = "<?php $this->load->helper('url'); echo base_url();?>index.php/registerPage/register/registerUser" method = "POST" >
					<table>
						<tr>
							<td><img src="<?php $this->load->helper('url'); echo base_url();?>images/user.png" width=50  height=50/></td>
							<td width=200><h4>ACCOUNT DETAILS</h4></td>
						</tr>
					
						<tr>
							<td></td>
							<td><label for="username">Username</label></td>
							<td><input type="text" id="username" name="username" maxlength="10" placeholder="Username" pattern="[a-zA-Z]{4,10}" autofocus required/></td>
						</tr>
					
						<tr>
							<td></td>
							<td><label for="password">Password</label></td>
							<td><input type="password" id="password" name="password" maxlength="10" placeholder="Password" pattern="[a-zA-Z0-9]{6,10}" title="must be alphanumeric 6-10 characters" autofocus required/></td>
						</tr>
						
						<tr>
							<td><img src="<?php $this->load->helper('url'); echo base_url();?>images/detail.png" width=50  height=50/></td>
							<td><h4>USER DETAILS</h4></td>
							<td><select id="usertype" name="usertype">
									<option value="student">I am a Student</option>
									<option value="faculty">I am a Faculty Member</option>
								</select>
							</td>
						</tr>	
						
						<tr id="for_user_num">
							<td></td>
							<td><label for="student_number">Student Number</label></td>
							<td><input type="text" id="student_number" name="student_number" maxlength=10 placeholder="2013-12345" pattern="[1-2][0-9][0-9][0-9][\-][0-9][0-9][0-9][0-9][0-9]" title="e.g. 2013-12345" autofocus required/></td>
						</tr>
						
						<tr>
							<td></td>
							<td><label for="first_name">First Name</label></td>
							<td><input type="text" id="first_name" name="first_name"  placeholder="Given" pattern="[a-zA-Z ]{4,30}" title="must be 4-30 characters" autofocus required/></td>
						</tr>
						
						<tr>
							<td></td>
							<td><label for="middle_name">Middle Name</label></td>
							<td><input type="text" id="middle_name" name="middle_name"  placeholder="Middle" placeholder="Given" pattern="[a-zA-Z ]{4,30}" title="must be 4-30 characters" autofocus required/></td>
						</tr>
						
						<tr>
							<td></td>
							<td><label for="last_name">Last Name</label></td>
							<td><input type="text" id="last_name" name="last_name"  placeholder="Last" placeholder="Given" pattern="[a-zA-Z ]{4,30}" title="must be 4-30 characters" autofocus required/></td>
						</tr>
							
						<tr>
							<td></td>
							<td><label for="email_address">Email Address</label></td>
							<td><input type="email" id="email_address" name="email_address" placeholder="user@email.com" autofocus required/></td>
						</tr>
					
						<tr>
							<td></td>
							<td><label for="address">Address</label></td>
							<td><input type="text" id="address" name="address" autofocus required/></td>
						</tr>
					<br/>
					</table>
					<input type="submit" id="signup_button" name="signup_button" value="Sign me up!"/>
				</form>
			</div>
			
			<div id="rightOfForm">
				<img height=400 width=200 src="<?php $this->load->helper('url'); echo base_url();?>images/books-pile.png" />
			</div>
		</div>
		
		<div id="catalog" style="display:none;">
			<div id="catalog_header">
				LOGIN TO YOUR ACCOUNT
			</div>
			
			<div id="cancel1">
				<img src="<?php $this->load->helper('url'); echo base_url();?>images/cancel.png" width="30" height="30" alt="account picture"/>
			</div>
			
			<div id="login_comment">
				
			</div>
			
			<div id="account_picture">
				<img src="<?php $this->load->helper('url'); echo base_url();?>images/account_pic.png" width="170" height="170" alt="account picture"/>
			</div>
			
			<div id="account_box">
				<form id="loginform" name="loginform" action="<?php $this->load->helper('url'); echo base_url();?>index.php/homePage/home/validateLogin" method="POST">
					<input type="text" id="username" name="username" placeholder="username" maxlength="10"/>
					<input type="password" id="password" name="password" placeholder="password" maxlength="10"/>
					<br/>
					<select id="usertype" name="usertype">
						<option value="student">I am a Student</option>
						<option value="faculty">I am a Faculty Member</option>
						<option value="librarian">I am the Librarian</option>
					</select>
					<br/>
					<input type="submit" id="loginsubmit" value="Login"/>
				</form>
				
				<div id="not_member">
					<span>Need an account?</span>
				</div>
			</div>
		</div>
	
		<div id="logo_header">
			<img src="<?php $this->load->helper('url'); echo base_url();?>images/icslogo.png" width="100" height="100" />
			<span id="header_title">ONLINE ICS LIBRARY</span>
			<div id="left_header">
				<img id="login" src='<?php $this->load->helper('url'); echo base_url();?>images/login-icon.png' width=60  height=60/>
				<img id="signup" src='<?php $this->load->helper('url'); echo base_url();?>images/sign-up-icon.png' width=60  height=60/>
			</div>
		</div>
		
		<div id="navigationBox">
			<ul id="navigation">
				<li id="home"><a href="<?php $this->load->helper('url'); echo base_url();?>"><span>Home</span></a></li>
				<li id="gallery_page"><a href=""><span>Gallery Page</span></a></li>
				<li id="catalouge"><a href="<?php $this->load->helper('url'); echo base_url();?>index.php/myLibrary/mylibrary"><span>My Library</span></a></li>
				<li id="about"><a href=""><span>About the Library</span></a></li>
				<li id="help"><a href=""><span>Help</span></a></li>
			</ul>
		</div>
		
		<div id="mylibrary_box">
			<div id="materialImage">
			</div>
			<div id="materialData">
				<p>Title: <?php echo $title?><br/>
				Author: <?php echo $author?><br/>
				Subject: <?php echo $subject?><br/>
				Status: <?php echo $status?><br/>
				Type: <?php echo $type?><br/>
				Account Number: <?php echo $accountnumber?><br/>
				Call Number: <?php echo $callnumber?><br />
				Publication Date: <?php echo $publicationdate?><br />
				Number Of Copies: <?php echo $copies?><br />
				Description: <?php echo $description?><br />
				Volume: <?php echo $volume?><br />
				</p>
			</div>
		</div>
		
		<div id="footerNavigationBox">
			<div id="beforeFooter">
				<ul id="footerNavigation">
					<li id="fhome"><a href="<?php $this->load->helper('url'); echo base_url();?>"><span>Home</span></a></li>
					<li>|</li>
					<li id="fgallery_page"><a href=""><span>Gallery Page</span></a></li>
					<li>|</li>
					<li id="fcatalouge"><a href="<?php $this->load->helper('url'); echo base_url();?>index.php/myLibrary/mylibrary"><span>Catalogue</span></a></li>
					<li>|</li>
					<li id="fabout"><a href=""><span>About the Library</span></a></li>
					<li>|</li>
					<li id="fhelp"><a href=""><span>Help</span></a></li>
				</ul>
			</div>
			
			<div id="afterFooter">
				<span>ONLINE ICS LIBRARY 2013</span>
			</div>
		</div>
	</body>
</html>