<div class="actions <?php echo $debugMode;?> sideMenu">
	<ul class="nav nav-list">
		<?php 
			switch ($menuList) {
				case 'event': 
					if ($menuItem === 'addAttribute' || 
						$menuItem === 'addAttachment' || 
						$menuItem === 'addIOC' || 
						$menuItem === 'addThreatConnect' ||
						$menuItem === 'populateFromtemplate'
					) {
						// we can safely assume that mayModify is true if comming from these actions, as they require it in the controller and the user has already passed that check
						$mayModify = true;
						if ($isAclPublish) $mayPublish = true;
					}
					?>
					<li <?php if ($menuItem === 'viewEvent') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/events/view/<?php echo h($event['Event']['id']);?>">View Event</a></li>
					<li <?php if ($menuItem === 'eventLog') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/logs/event_index/<?php echo h($event['Event']['id']);?>">View Event History</a></li>
					<li class="divider"></li>
					<?php if ($isSiteAdmin || (isset($mayModify) && $mayModify)): ?>
					<li <?php if ($menuItem === 'editEvent') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/events/edit/<?php echo h($event['Event']['id']);?>">Edit Event</a></li>
					<li><?php echo $this->Form->postLink('Delete Event', array('action' => 'delete', $event['Event']['id']), null, __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?></li>
					<li <?php if ($menuItem === 'addAttribute') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/attributes/add/<?php echo h($event['Event']['id']);?>">Add Attribute</a></li>
					<li <?php if ($menuItem === 'addAttachment') echo 'class="active"';;?>><a href="<?php echo $baseurl;?>/attributes/add_attachment/<?php echo h($event['Event']['id']);?>">Add Attachment</a></li>
					<li <?php if ($menuItem === 'addIOC') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/events/addIOC/<?php echo h($event['Event']['id']);?>">Populate from OpenIOC</a></li>
					<li <?php if ($menuItem === 'addThreatConnect') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/attributes/add_threatconnect/<?php echo h($event['Event']['id']); ?>">Populate from ThreatConnect</a></li>
						<?php if ($menuItem === 'populateFromtemplate'): ?>
							<li class="active"><a href="<?php echo $baseurl;?>/templates/populateEventFromTemplate/<?php echo h($template_id) . '/' . h($event['Event']['id']); ?>">Populate From Template</a></li>
						<?php endif; ?>
					<?php endif; ?>
					<?php if (($isSiteAdmin && (!isset($mayModify) || !$mayModify)) || (!isset($mayModify) || !$mayModify)): ?>
					<li <?php if ($menuItem === 'proposeAttribute') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/shadow_attributes/add/<?php echo h($event['Event']['id']);?>">Propose Attribute</a></li>
					<li <?php if ($menuItem === 'proposeAttachment') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/shadow_attributes/add_attachment/<?php echo h($event['Event']['id']);?>">Propose Attachment</a></li>
					<?php endif; ?>
					<li class="divider"></li>
					<?php 
						$publishButtons = ' style="display:none;"';
						$exportButtons = ' style="display:none;"';
						if (isset($event['Event']['published']) && 0 == $event['Event']['published'] && ($isAdmin || (isset($mayPublish) && $mayPublish))) $publishButtons = "";
						if (isset($event['Event']['published']) && $event['Event']['published']) $exportButtons = "";
					?>
					<li<?php echo $publishButtons; ?> class="publishButtons"><a href="#" onClick="publishPopup('<?php echo h($event['Event']['id']); ?>', 'alert')">Publish Event</a></li>
					<li<?php echo $publishButtons; ?> class="publishButtons"><a href="#" onClick="publishPopup('<?php echo h($event['Event']['id']); ?>', 'publish')">Publish (no email)</a></li>

					<li <?php if ($menuItem === 'contact') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/events/contact/<?php echo h($event['Event']['id']);?>">Contact Reporter</a></li>
					<li><a onClick="getPopup('<?php echo h($event['Event']['id']); ?>', 'events', 'exportChoice');" style="cursor:pointer;">Download as...</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo $baseurl;?>/events/index">List Events</a></li>
					<?php if ($isAclAdd): ?>
					<li><a href="<?php echo $baseurl;?>/events/add">Add Event</a></li>
					<?php endif;
				break;

				case 'event-collection': ?>
					<li <?php if ($menuItem === 'index') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/events/index">List Events</a></li>
					<?php if ($isAclAdd): ?>
					<li <?php if ($menuItem === 'add') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/events/add">Add Event</a></li>
					<li <?php if ($menuItem === 'addMISPExport') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/events/add_misp_export">Import from MISP Export</a></li>
					<?php endif; ?>
					<li class="divider"></li>
					<li <?php if ($menuItem === 'listAttributes') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/attributes/index">List Attributes</a></li>
					<li <?php if ($menuItem === 'searchAttributes' || $menuItem === 'searchAttributes2') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/attributes/search">Search Attributes</a></li>
					<?php if ($menuItem == 'searchAttributes2'): ?>
					<li class="divider"></li>
					<li><a href="<?php echo $baseurl;?>/events/downloadSearchResult">Download results as XML</a></li>
					<li><a href="<?php echo $baseurl;?>/events/csv/download/search">Download results as CSV</a></li>
					<?php endif; ?>
					<li class="divider"></li>
					<li <?php if ($menuItem === 'viewProposals') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/shadow_attributes/index">View Proposals</a></li>
					<li <?php if ($menuItem === 'viewProposalIndex') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/events/proposalEventIndex">Events with proposals</a></li>
					<li class="divider"></li>
					<li <?php if ($menuItem === 'export') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/events/export">Export</a></li>
					<?php if ($isAclAuth): ?>
					<li <?php if ($menuItem === 'automation') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/events/automation">Automation</a></li>
					<?php endif;
				break;
					
				case 'regexp': ?>
					<li <?php if ($menuItem === 'index') echo 'class="active"';?>><?php echo $this->Html->link('List Regexp', array('admin' => $isSiteAdmin, 'action' => 'index'));?></li>
					<?php if ($isSiteAdmin): ?>
					<li <?php if ($menuItem === 'add') echo 'class="active"';?>><?php echo $this->Html->link('New Regexp', array('admin' => true, 'action' => 'add'));?></li>
					<li><?php echo $this->Form->postLink('Perform on existing', array('admin' => true, 'action' => 'clean'));?></li>
					<?php endif;
					if ($menuItem == 'edit'):?> 
					<li class="divider"></li>
					<li class="active"><?php echo $this->Html->link('Edit Regexp', array('admin' => true, 'action' => 'edit', $id));?></li>
					<li><?php echo $this->Form->postLink('Delete Regexp', array('admin' => true, 'action' => 'delete', $id), null, __('Are you sure you want to delete # %s?', $id));?></li>
					<?php 
					endif;
				break;
					
					case 'whitelist':?>
					<li <?php if ($menuItem === 'index') echo 'class="active"';?>><?php echo $this->Html->link('List Whitelist', array('admin' => $isSiteAdmin, 'action' => 'index'));?></li>
					<?php if ($isSiteAdmin): ?>
					<li <?php if ($menuItem === 'add') echo 'class="active"';?>><?php echo $this->Html->link('New Whitelist', array('admin' => true, 'action' => 'add'));?></li>
					<?php endif;
					if ($menuItem == 'edit'):?> 
					<li class="divider"></li>
					<li class="active"><?php echo $this->Html->link('Edit Whitelist', array('admin' => true, 'action' => 'edit', $id));?></li>
					<li><?php echo $this->Form->postLink('Delete Whitelist', array('admin' => true, 'action' => 'delete', $id), null, __('Are you sure you want to delete # %s?', $id));?></li>
					<?php 
					endif;
				break;
					
				case 'globalActions':
					if ($menuItem === 'edit' || $menuItem === 'view'): ?>
					<li <?php if ($menuItem === 'edit') echo 'class="active"';?>><?php echo $this->Html->link(__('Edit User', true), array('action' => 'edit', $user['User']['id'])); ?></li>
					<li class="divider"></li>
					<?php endif; ?>
					<li <?php if ($menuItem === 'view') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/users/view/me">My Profile</a></li>
					<li <?php if ($menuItem === 'members') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/users/memberslist">Members List</a></li>
					<li <?php if ($menuItem === 'roles') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/roles/index">Role Permissions</a></li>
					<li <?php if ($menuItem === 'userGuide') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/pages/display/doc/general">User Guide</a></li>
					<li <?php if ($menuItem === 'terms') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/users/terms">Terms &amp; Conditions</a></li>
					<li <?php if ($menuItem === 'statistics') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/users/statistics">Statistics</a></li>
					<?php 
				break;
				
				case 'sync':
					if ($menuItem === 'edit' && $isAdmin): ?>
					<li class="active"><?php if ($isAdmin) echo $this->Html->link('Edit Server', array('controller' => 'servers', 'action' => 'edit')); ?></li>
					<li><?php echo $this->Form->postLink('Delete', array('action' => 'delete', $this->Form->value('Server.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Server.id'))); ?></li>
					<li class="divider"></li>
					<?php endif; ?>
					<li <?php if ($menuItem === 'index') echo 'class="active"';?>><?php echo $this->Html->link('List Servers', array('controller' => 'servers', 'action' => 'index'));?></li>
					<li <?php if ($menuItem === 'add') echo 'class="active"';?>><?php echo $this->Html->link(__('New Server'), array('controller' => 'servers', 'action' => 'add')); ?></li>
					<?php 
				break;	
				
				case 'admin': 
					if ($menuItem === 'editUser' || $menuItem === 'viewUser'): ?>
					<li <?php if ($menuItem === 'viewUser') echo 'class="active"';?>><?php echo $this->Html->link('View User', array('controller' => 'users', 'action' => 'view', 'admin' => true, $id)); ?> </li>
					<li><a href="#" onClick="initiatePasswordReset('<?php echo h($id); ?>');">Send Credentials</a></li>
					<li <?php if ($menuItem === 'editUser') echo 'class="active"';?>><?php echo $this->Html->link('Edit User', array('controller' => 'users', 'action' => 'edit', 'admin' => true, $id)); ?> </li>
					<li><?php echo $this->Form->postLink('Delete User', array('admin' => true, 'action' => 'delete', $id), null, __('Are you sure you want to delete # %s?', $id));?></li>
					<li class="divider"></li>
					<?php endif; 
					if ($isSiteAdmin && $menuItem === 'editRole'): ?>
					<li class="active"><?php echo $this->Html->link('Edit Role', array('controller' => 'roles', 'action' => 'edit', 'admin' => true, $id)); ?> </li>
					<li><?php echo $this->Form->postLink('Delete Role', array('controller' => 'roles', 'admin' => true, 'action' => 'delete', $id), null, __('Are you sure you want to delete # %s?', $id));?></li>
					<li class="divider"></li>
					<?php endif; 
					if ($isSiteAdmin): ?>
					<li <?php if ($menuItem === 'addUser') echo 'class="active"';?>><?php echo $this->Html->link('New User', array('controller' => 'users', 'action' => 'add', 'admin' => true)); ?> </li>
					<li <?php if ($menuItem === 'indexUser') echo 'class="active"';?>><?php echo $this->Html->link('List Users', array('controller' => 'users', 'action' => 'index', 'admin' => true)); ?> </li>
					<?php endif; ?>
					<?php if ($isAdmin): ?>
					<li <?php if ($menuItem === 'contact') echo 'class="active"';?>><?php echo $this->Html->link('Contact Users', array('controller' => 'users', 'action' => 'email', 'admin' => true)); ?> </li>
					<?php endif; ?>
					<li class="divider"></li>
					<?php if ($isSiteAdmin): ?>
					<li <?php if ($menuItem === 'addRole') echo 'class="active"';?>><?php echo $this->Html->link('New Role', array('controller' => 'roles', 'action' => 'add', 'admin' => true)); ?> </li>
					<?php endif; ?>
					<li <?php if ($menuItem === 'indexRole') echo 'class="active"';?>><?php echo $this->Html->link('List Roles', array('controller' => 'roles', 'action' => 'index', 'admin' => true)); ?> </li>
					<?php if ($isSiteAdmin): ?>
						<li class="divider"></li>
						<li <?php if ($menuItem === 'adminTools') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/pages/display/administration">Administrative Tools</a></li>
						<li <?php if ($menuItem === 'serverSettings') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/servers/serverSettings">Server Settings</a></li>
						<li class="divider"></li>
						<?php if (Configure::read('MISP.background_jobs')): ?>
							<li <?php if ($menuItem === 'jobs') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/jobs/index">Jobs</a></li>
							<li class="divider"></li>
							<li <?php if ($menuItem === 'tasks') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/tasks">Scheduled Tasks</a></li>
						<?php endif; 
						if (Configure::read('MISP.enableEventBlacklisting')): ?>
							<li <?php if ($menuItem === 'eventBlacklistsAdd') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/eventBlacklists/add">Blacklists Event</a></li>		
							<li <?php if ($menuItem === 'eventBlacklists') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/eventBlacklists">Manage Event Blacklists</a></li>
						<?php endif;
					endif;
				break;	
				
				case 'logs': ?>
					<li <?php if ($menuItem === 'index') echo 'class="active"';?>><?php echo $this->Html->link('List Logs', array('admin' => true, 'action' => 'index'));?></li>
					<li <?php if ($menuItem === 'search') echo 'class="active"';?>><?php echo $this->Html->link('Search Logs', array('admin' => true, 'action' => 'search'));?></li>
					<?php 
				break;	
				
				case 'threads': 
				
					if ($menuItem === 'add' || $menuItem === 'view') {
						if (!(empty($thread_id) && empty($target_type))) { ?>
					<li  <?php if ($menuItem === 'view') echo 'class="active"';?>><?php echo $this->Html->link('View Thread', array('controller' => 'threads', 'action' => 'view', $thread_id));?></li>
					<li  <?php if ($menuItem === 'add') echo 'class="active"';?>><?php echo $this->Html->link('Add Post', array('controller' => 'posts', 'action' => 'add', 'thread', $thread_id));?></li>
					<li class="divider"></li>
					<?php 
						}
					}
					if ($menuItem === 'edit') { ?>
						<li><?php echo $this->Html->link('View Thread', array('controller' => 'threads', 'action' => 'view', $thread_id));?></li>
						<li class="active"><?php echo $this->Html->link('Edit Post', array('controller' => 'threads', 'action' => 'view', $id));?></li>
						<li class="divider"></li>
					<?php 
					}
					?>
					<li <?php if ($menuItem === 'index') echo 'class="active"';?>><?php echo $this->Html->link('List Threads', array('controller' => 'threads', 'action' => 'index'));?></li>
					<li <?php if ($menuItem === 'add' && !isset($thread_id)) echo 'class="active"';?>><a href = "<?php echo Configure::read('MISP.baseurl');?>/posts/add">New Thread</a></li>
					<?php 
				break;	
				
				case 'tags': ?>
					<li <?php if ($menuItem === 'index') echo 'class="active"';?>><?php echo $this->Html->link('List Tags', array('action' => 'index'));?></li>
					<?php if ($isAclTagger): ?>
					<li <?php if ($menuItem === 'add') echo 'class="active"';?>><?php echo $this->Html->link('Add Tag', array('action' => 'add'));?></li>
					<?php 
					endif;
					if ($menuItem === 'edit'): 
					?>
					<li class="active"><?php echo $this->Html->link('Edit Tag', array('action' => 'edit'));?></li>
					<?php 
					endif;
				break;	
				
				case 'templates': ?>
					<li <?php if ($menuItem === 'index') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/templates/index">List Templates</a></li>
					<?php if ($isSiteAdmin || $isAclTemplate): ?>
					<li <?php if ($menuItem === 'add') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/templates/add">Add Template</a></li>
					<?php 
					endif;
					if (($menuItem === 'view' || $menuItem === 'edit')): 
					?>
					<li <?php if ($menuItem === 'view') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/templates/view/<?php echo h($id); ?>">View Template</a></li>
					<?php if ($mayModify): ?>
					<li <?php if ($menuItem === 'edit') echo 'class="active"';?>><a href="<?php echo $baseurl;?>/templates/edit/<?php echo h($id); ?>">Edit Template</a></li>
					<?php
					endif; 
					endif;
				break;	
			}
		?>
	</ul>
</div>
