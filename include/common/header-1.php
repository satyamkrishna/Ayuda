<?php 


?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=124622221045340";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="row">
	<div class="large-4 small-7 columns">
		<a href="<?php echo $link_array['logo'];?>"><img src="../../resources/images/common/logo.png" width="90%"></a>
		<div class="fb-like" style="margin-bottom: 10px;" data-href="https://www.facebook.com/pages/Ayuda/119611828228616?fref=ts" data-send="true" data-width="450" data-show-faces="false" data-font="segoe ui"></div>
	</div>
	<?php 
	if(ud_volunteer_loggedin())
	{
	?>
	<div class="large-4 columns subscribe-container">
		
	</div>
	<div class="large-4 columns">
		<div class="row panel volunteer-box-login">
			<p>Hello, <?php echo $_SESSION['userName'];?>. Welcome Back !!</p>
			<a href="<?php echo $link_array['logout'];?>" class="button secondary right">Logout</a>
			
		</div>
	</div>
	<?php 
	}
	else
	{
	?>
	<div class="large-3 columns subscribe-container">
		
	</div>
	<div class="large-5 columns volunteer-box">
		<div class="row">
			<div class="large-8 columns">
				<form action="../../modules/homepage/volunteer-login.php" method="post" id="submit-form-login">
					<div class="row">
						<div class="large-4 hide-for-small columns">
							<label class="inline">Email</label>
							<label class="inline">Password</label> </div>
						<div class="large-8 columns">
							<input name="username" placeholder="email" type="text" />
							<input name="password" placeholder="password" type="password" />
						</div>
					</div>
				</form>	
			</div>
			<div class="large-4 columns">
				<div type="button" value="Login" class="secondary radius button right main-login">Login</div>
			</div>
		</div>
	</div>
	<?php 
	}
	?>	
	</div>
</div>


<?php 

?>