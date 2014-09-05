<?php 

// Header
$result = $db -> ud_whereQuery('ud_footer', NULL, array('visible' => 1), 'AND', false, 'ORDER BY no ASC');
$footer = $db -> ud_mysql_fetch_assoc_all($result);

$term_link = 'terms&conditions';

if($_SERVER['SERVER_ADDR'] == '127.0.0.1')
{
	$term_link = 'terms.php';
}

?>
<footer class="footer">
	<div class="row footer-body">
			<div class="large-4 columns hide-for-small" style="padding-top: 10px;">
				<a href="index.php"><img src="../../resources/images/common/logogrey.png" width="80%"></a>
			</div>
			<div class="small-12 large-4 columns terms">
				<p><a href="<?php echo $term_link;?>">Terms Of Use</a> &middot; <a>Privacy Policy</a></p>
				<p>&copy; 2013 Ayuda - Ngo </p>
				<p>All Rights Reserved</p>
				<p>Powered By <a href="http://www.utopiadevelopers.com" target="_blank">Utopia Developers</a></p>
			</div>
			<div class="large-4 columns footer-link hide-for-small">
				<ul class="footer-nav">
				<?php 
					for($i=0;$i<sizeof($footer);$i++)
					{
						if($_SERVER['SERVER_ADDR'] == '127.0.0.1')
						{
							$footer[$i]['footerLinkS'] = $footer[$i]['footerLink'];
						}
						?>
					<li>
						<a href="<?php echo $footer[$i]['footerLinkS']; ?>">
							<?php echo $footer[$i]['footerName']; ?>
						</a>
					</li>
					<?php
						
					}
					?>
					
				</ul>
			</div>
		</div> 
</footer>

<script>
    	$(document).foundation();
    	$('.main-login').click(function()
    	{
    		$('#submit-form-login').submit();
        });
</script>

<?php 

?>