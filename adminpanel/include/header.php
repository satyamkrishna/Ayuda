<?php



if(!ud_admin_loggedin())
{

?>

<div class="header">
	<div class="row" >
	<div class="large-12 columns">
		<nav class="top-bar">
			<ul>
				<li class="name">
					<a href="http://www.utopiadevelopers.com" target="_blank"><img src="../../resources/images/common/utopia.png"></a>
				</li>
				<li class="toggle-topbar"><a href="#"></a></li>
			</ul>	
		</nav>
	</div>
	</div>
</div>
<?php
}
else
{

$src = '../../resources/images/user/'.$_SESSION['userLogo'];
if(!file_exists($src))
{
	$src = '../../resources/images/user/user_blue.png';
}
?>

<div class="header">
	<div class="row">
		<div class="large-12 columns">
			<nav class="top-bar">
				<ul class="title-area">
	    			<!-- Title Area -->
	    			<li class="name logo">
						<a href="http://www.utopiadevelopers.com" target="_blank">
							<img src="../../resources/images/common/utopia.png">
						</a>
					</li>
		
	    			<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  				</ul>
				
				<section class="top-bar-section">
			    <!-- Left Nav Section -->
				    <ul class="left">
				      <li class="divider"></li>
				      <li><a href="index.php">Dashboard</a></li>
				      <li class="divider"></li>
				      <li class="has-dropdown"><a href="#">Manage Your Site</a>
					     <ul class="dropdown">
						    <li class="has-dropdown"><a href="#">Content</a> 	
						  		<ul class="dropdown">
						  			<li><a href="home.php">Homepage</a></li>	
							  		<li><a href="whatwedo.php">What We Do</a></li>
							  		<li><a href="home.php">Our Team</a></li>
							  		<li><a href="faq.php">FAQs</a></li>
						  		</ul>
						  	</li>
					  		<li><a href="photos.php">Gallery</a></li>
					  		<li><a href="user.php">Certificate</a></li>
					  		<li class="has-dropdown"><a href="#">Reports</a> 	
						  		<ul class="dropdown">
						  			<li><a href="user_city_report.php?city=all">City Wise Reports</a></li>
					  				<li><a href="user_state_report.php">State Wise Reports</a></li>
					  				<li><a href="manage_city.php">Manage User Cities</a></li>	
						  		</ul>
						  	</li>		  					  								  		
						  </ul>
					  </li>
					  <li class="divider"></li>
					  <li><a target="_blank" href="../../../index.php">Visit Your Site</a></li>
					</ul>
				
					<ul class="right">
						<li class="divider"></li>
						<li class="has-dropdown"><a href="#"> <img alt="user"
								class="user-image" src="<?php echo $src; ?>" />
						</a>
							<ul class="dropdown">
								<li class="divider"></li>
								
								<li><a href="../../logout.php">Logout</a></li>
							</ul>
						</li>
					</ul>
				</section>				
								
			</nav>
		</div>
	</div>
</div>


<?php
}
?>