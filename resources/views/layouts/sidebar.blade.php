<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">	
		<div class="user-profile px-20 py-10">
			<div class="d-flex align-items-center">			
				<div class="image">
				  <img src="{{ asset('asset/dist/img/user2-160x160.jpg')}}" class="avatar avatar-lg bg-primary-light rounded100" alt="User Image">

				</div>
				<div class="info">
					<a class="dropdown-toggle px-20" data-bs-toggle="dropdown" href="#">{{Session::get('first_name')}} {{Session::get('last_name')}}</a>
					<div class="dropdown-menu">
					  <a class="dropdown-item" href="#"><i class="ti-user"></i> Profile</a>
					  <a class="dropdown-item" href="#"><i class="ti-email"></i> Inbox</a>
					  <a class="dropdown-item" href="#"><i class="ti-link"></i> Connections</a>
					  <div class="dropdown-divider"></div>
					  <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
					</div>
				</div>
			</div>
			<ul class="list-inline profile-setting mt-20 mb-0 d-flex justify-content-between">
				<li><a href="#" data-bs-toggle="tooltip" title="Search"><i data-feather="search"></i></a></li>
				<li><a href="#" data-bs-toggle="tooltip" title="Notification"><i data-feather="bell"></i></a></li>
				<li><a href="#" data-bs-toggle="tooltip" title="Chat"><i data-feather="message-square"></i></a></li>
				<li><a href="#" data-bs-toggle="tooltip" title="Logout"><i data-feather="log-out"></i></a></li>
			</ul>
	    </div>
	  	<div class="multinav">
		  <div class="multinav-scroll" style="height: 100%;">	
			  <!-- sidebar menu-->
			  <ul class="sidebar-menu" data-widget="tree">		
				<li class="treeview">
				  <a href="#">
					<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
					<span>Dashboard</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li class="@if($uri_segments_parameter == 'dashboard') active @endif"><a href="{{url('/dashboard')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dashboard</a></li>

				  </ul>
				</li>	
                @if(Session::get("userLevel") > 5)
				<li class="treeview ">
				  <a href="#">
					<i class="icon-Briefcase"><span class="path1"></span><span class="path2"></span></i>
					<span>  User Management</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu @if($uri_segments_parameter == 'roles' || $uri_segments_parameter == 'users' ||  $uri_segments_parameter == 'groups') active @endif">
					<li class="@if($uri_segments_parameter == 'users') active @endif"><a href="{{url('/users')}}"class="@if($uri_segments_parameter == 'users') active @endif"><i class="icon-Briefcase"><span class="path1"></span><span class="path2"></span></i>Users</a></li>
					<li class="@if($uri_segments_parameter == 'roles') active @endif"><a href="{{url('/roles')}}"><i class="icon-File"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>Roles</a></li>
					<li class="@if($uri_segments_parameter == 'groups') active @endif"><a href="{{url('/groups')}}"><i class="icon-Add-user"><span class="path1"></span><span class="path2"></span></i>Groups</a></li>
	
				  </ul>
				</li>
				
				<li class="treeview @if($uri_segments_parameter == 'lists') active @endif">
				  <a href="{{url('/lists')}}" >
					<i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
					<span>Lists</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				 
				</li>
				@endif
				<li class="treeview @if($uri_segments_parameter == 'leads') active @endif">
				  <a href="{{url('/leads')}}">
					<i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
					<span>Leads</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				 
				</li> 
				
                @if(Session::get("userLevel") > 5)
                <li class="treeview">
				  <a href="#">
					<i class="icon-Write"><span class="path1"></span><span class="path2"></span></i>
					<span>Settings</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li class="treeview @if($uri_segments_parameter == 'lenders') active @endif">
						<a href="{{url('/lenders')}}">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Lenders
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						
					</li>				
					<li class="treeview @if($uri_segments_parameter == 'email-templates') active @endif">
						<a href="{{url('/email-templates')}}">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Email Templates
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						
					</li>												
					<li class="treeview @if($uri_segments_parameter == 'pdf-templates') active @endif">
						<a href="{{url('/pdf-templates')}}">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pdf Templates
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
					
					</li>								
					<li class="treeview @if($uri_segments_parameter == 'smtps') active @endif">
						<a href="{{url('/smtps')}}">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>SMTP
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						
					</li>	
					<li><a href="ui_grid.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>SMS Configuration</a></li> 
                    <li class="treeview @if($uri_segments_parameter == 'lead-status') active @endif">
						<a href="{{url('/lead-status')}}" >
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Lead Status
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						
					</li>	
                    <li class="treeview @if($uri_segments_parameter == 'dids') active @endif">
						<a href="{{url('/dids')}}">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>DID
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						
					</li>	
                    <li class="treeview @if($uri_segments_parameter == 'labels') active @endif">
						<a href="{{url('/labels')}}">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Labels
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						
					</li>	 
                    <li class="treeview @if($uri_segments_parameter == 'lead-source') active @endif">
						<a href="{{url('/lead-source')}}">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Lead Source
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						
					</li>
                    <li class="treeview @if($uri_segments_parameter == 'document-types') active @endif">
						<a href="{{url('/document-types')}}">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Document Types
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						
					</li>
                   
				  </ul>
				</li>	
                @endif		
				<li class="treeview">
				  <a href="{{url('/logout')}}">
					<i class="icon-File"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
					<span>Logout</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>					
				
				</li>
			
				
				
			
			  </ul>
		  </div>
		</div>
    </section>
  </aside>
