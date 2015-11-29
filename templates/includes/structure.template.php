<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
			<table cellspacing="0" cellpadding="0" style="width:100%;"><tr><td>
<?php }elseif($template_hook=='2'){ ?>
<?php }elseif($template_hook=='3'){ ?>
			</td></tr></table>
<?php }elseif($template_hook=='4'){ ?>
		</div> <!-- close site width class from header template -->
	</body>
</html>
<?php }elseif($template_hook=='end'){ ?>
<?php } ?>