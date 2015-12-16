<div id = "topBar" class="navbar-wrapper header <?php echo $debugMode;?>" style="height:42px;width:100%">
	<div class="glass"></div>
	<div class="navbar navbar-inverse">
		<div class="navbar-inner" style="border-radius: 10px;">
		  <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
	    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	    </a>
		<?php if ($me != false ):?>
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li><a href="<?php echo !empty($baseurl) ? $baseurl : '/';?>" style="color:white">Home</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							Event Actions
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo $baseurl;?>/events/index">List Events</a></li>
							<?php if ($isAclAdd): ?>
							<li><a href="<?php echo $baseurl;?>/events/add">Add Event</a></li>
							<?php endif; ?>
							<li class="divider"></li>
							<li><a href="<?php echo $baseurl;?>/attributes/index">List Attributes</a></li>
							<li><a href="<?php echo $baseurl;?>/attributes/search">Search Attributes</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo $baseurl;?>/shadow_attributes/index">View Proposals</a></li>
							<li><a href="<?php echo $baseurl;?>/events/proposalEventIndex">Events with proposals</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo $baseurl;?>/tags/index">List Tags</a></li>
							<?php if ($isAclTagger): ?>
							<li><a href="<?php echo $baseurl;?>/tags/add">Add Tag</a></li>
							<?php endif; ?>
							<li class="divider"></li>
							<li><a href="<?php echo $baseurl;?>/templates/index">List Templates</a></li>
							<?php if ($isAclTemplate): ?>
							<li><a href="<?php echo $baseurl;?>/templates/add">Add Template</a></li>
							<?php endif; ?>
							<li class="divider"></li>
							<li><a href="<?php echo $baseurl;?>/events/export">Export</a></li>
							<?php if ($isAclAuth): ?>
							<li><a href="<?php echo $baseurl;?>/events/automation">Automation</a></li>
							<?php endif;?>

						</ul>
					</li>

					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							Input Filters
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<?php if ($isAclRegexp): ?>
							<li><a href="<?php echo $baseurl;?>/admin/regexp/index">Import Regexp</a></li>
							<li><a href="<?php echo $baseurl;?>/admin/whitelists/index">Signature Whitelist</a></li>
							<?php endif;?>
							<?php if (!$isAclRegexp): ?>
							<li><a href="<?php echo $baseurl;?>/regexp/index">Import Regexp</a></li>
							<li><a href="<?php echo $baseurl;?>/whitelists/index">Signature Whitelist</a></li>
							<?php endif;?>
						</ul>
					</li>

					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							Global Actions
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo $baseurl;?>/users/view/me">My Profile</a></li>
							<li><a href="<?php echo $baseurl;?>/users/memberslist">Members List</a></li>
							<li><a href="<?php echo $baseurl;?>/roles/index">Role Permissions</a></li>
							<li><a href="<?php echo $baseurl;?>/pages/display/doc/quickstart">User Guide</a></li>
							<li><a href="<?php echo $baseurl;?>/users/terms">Terms &amp; Conditions</a></li>
							<li><a href="<?php echo $baseurl;?>/users/statistics">Statistics</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo $baseurl;?>/users/logout">Log out</a></li>
						</ul>
					</li>

					<?php if ($isAclSync || $isAdmin): ?>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							Sync Actions
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo $baseurl;?>/servers/index">List Servers</a></li>
						</ul>
					</li>
					<?php endif;?>

					<?php if($isAdmin || $isSiteAdmin): ?>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							Administration
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo $baseurl;?>/admin/users/add">New User</a></li>
							<li><a href="<?php echo $baseurl;?>/admin/users/index">List Users</a></li>
							<li><a href="<?php echo $baseurl;?>/admin/users/email">Contact Users</a></li>
							<li class="divider"></li>
							<?php if($isSiteAdmin): ?>
							<li><a href="<?php echo $baseurl;?>/admin/roles/add">New Role</a></li>
							<?php endif; ?>
							<li><a href="<?php echo $baseurl;?>/admin/roles/index">List Roles</a></li>
							<?php if($isSiteAdmin): ?>
								<li class="divider"></li>
								<li><a href="<?php echo $baseurl;?>/pages/display/administration">Administrative tools</a></li>
								<li><a href="<?php echo $baseurl;?>/servers/serverSettings">Server settings</a></li>
								<?php if (Configure::read('MISP.background_jobs')): ?>
									<li class="divider"></li>
									<li><a href="<?php echo $baseurl;?>/jobs/index">Jobs</a></li>
									<li class="divider"></li>
									<li><a href="<?php echo $baseurl;?>/tasks">Scheduled Tasks</a></li>
								<?php endif; ?>
								<?php if (Configure::read('MISP.enableEventBlacklisting') && $isSiteAdmin): ?>	
									<li class="divider"></li>
									<li><a href="<?php echo $baseurl;?>/eventBlacklists/add">Blacklist Event</a></li>
									<li><a href="<?php echo $baseurl;?>/eventBlacklists">Manage Event Blacklists</a></li>
								<?php endif; ?>			
							<?php endif; ?>
						</ul>
					</li>
					<?php endif; ?>

					<?php if($isAclAudit): ?>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							Audit
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo $baseurl;?>/admin/logs/index">List Logs</a></li>
							<li><a href="<?php echo $baseurl;?>/admin/logs/search">Search Logs</a></li>
						</ul>
					</li>
					<?php endif;?>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							Discussions
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo $baseurl;?>/threads/index">List Discussions</a></li>
							<li><a href="<?php echo $baseurl;?>/posts/add">Start Discussion</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="nav-collapse collapse pull-right">
				<ul class="nav">
					<li>
						<a href="<?php echo $baseurl;?>/events/proposalEventIndex" <?php if ($proposalCount > 0) echo 'style="font-weight:bold;"'; ?>>
							<?php 
								$proposalPluralOrZero = 's';
								if ($proposalCount == 1) $proposalPluralOrZero = '';
								$proposalEventPluralOrZero = 's';
								if ($proposalEventCount == 1) $proposalEventPluralOrZero = '';
								echo $proposalCount . ' proposal' . $proposalPluralOrZero . ' in ' . $proposalEventCount . ' event' . $proposalEventPluralOrZero; 
							?>
						</a>
					</li>
					<li>
						<a href="<?php echo $baseurl;?>/" id="fullLogo" style="font-weight:bold;">
							<span class="logoBlueStatic">M</span><span class="logoGray">alware</span>
							<span class="logoBlueStatic">I</span><span class="logoGray">nformation </span>
							<span class="logoBlueStatic">S</span><span class="logoGray">haring</span>
							<span class="logoBlueStatic">P</span><span class="logoGray">latform</span>
						</a>
						<a href="<?php echo $baseurl;?>/" id="smallLogo" style="display:none;font-weight:bold;">
							<span class="logoBlueStatic">MISP</span>
						</a>
					</li>
					<li><a href="<?php echo $baseurl;?>/users/logout">Log out</a></li>
				</ul>
			</div>
		<?php endif;?>
		</div>
	</div>
</div>
<script type="text/javascript">
window.onload = resizeLogo;
window.onresize = resizeLogo;

function resizeLogo() {
	var testElem = document.getElementById('fullLogo');
	var topBar = document.getElementById('topBar');
	
	if (testElem != null) {
		if ($(window).width() < 1400) {
			document.getElementById('fullLogo').style.display='none';
			document.getElementById('smallLogo').style.display='block';
		}
		if ($(window).width() > 1399) {
			document.getElementById('fullLogo').style.display='block';
			document.getElementById('smallLogo').style.display='none';	
		}
	}

	if ($(window).width() < 1185) {
		topBar.style.width = '1185px';
	}
	if ($(window).width() > 1184) {
		topBar.style.width = '100%';
	}
}
</script>