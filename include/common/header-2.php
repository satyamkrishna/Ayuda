<?php
$table = 'ud_header';
// Header
if(ud_volunteer_loggedin())
{
	$table = 'ud_header_volunteer';
}
$result = $db -> ud_whereQuery($table, NULL, array('headerVisible' => 1), 'AND', false, 'ORDER BY headerNo ASC');
$header = $db -> ud_mysql_fetch_assoc_all($result);
?>
<div id="header">
	<div class="row">
	<div class="large-12 columns">
		<div class="contain-to-grid">
		<nav class="top-bar header">
			

			<section class="top-bar-section">
				<ul class="left">
					
					<?php 
					for($i=0;$i<sizeof($header);$i++)
					{
						if($_SERVER['SERVER_ADDR'] == '127.0.0.1')
						{
						?>
					<li>
						<a href="<?php echo $header[$i]['headerLink']; ?>">
							<?php echo $header[$i]['headerName']; ?>
						</a>
					</li>
					<?php
						}
						else
						{
					?>
					<li>
						<a href="<?php echo $header[$i]['headerLinkS']; ?>">
							<?php echo $header[$i]['headerName']; ?>
						</a>
					</li>
					<?php
						}
					}
					?>
					<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
					<li class="toggle-topbar right">
						<a href="#"><span>Menu</span></a>
					</li>
				</ul>
				
		
		</nav>
		</div>
	</div>
</div>

</div>
<?php ?>