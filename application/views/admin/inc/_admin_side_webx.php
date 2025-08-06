<!-- Create your own Sidebar here -->
<li class="app-sidebar__heading">Posts</li>
<li>
	<a href="<?= base_url('admin/perform/custom/all-posts') ?>">
		<i class="fa-duotone fa-comment metismenu-icon"></i>
		All Posts
	</a>
</li>
<li class="app-sidebar__heading">Manage Properties</li>
<li <?php if (is_tab_selected('all-properties', 1) || is_tab_selected('add-property', 1)) {
		echo 'class="mm-active"';
	} ?>>
	<a href="#">
		<i class="fa-duotone fa-home metismenu-icon"></i>
		Manage Properties
		<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
	</a>
	<ul>
		<li>
			<a href="<?= base_url('admin/perform/custom/add-property') ?>">
				<i class="metismenu-icon">
				</i>Add property
			</a>
		</li>
		<li>
			<a href="<?= base_url('admin/perform/custom/all-properties') ?>">
				<i class="metismenu-icon">
				</i>All Properties
			</a>
		</li>
	</ul>
</li>
