@php
    $prefix=Request::route()->getPrefix();
    $route=Request::route()->getName();
@endphp
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
			<div class="ulogo">
				 <a href="index.html">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">					 	
						  <img src="../images/logo-dark.png" alt="">
						  <h3><b>{{Auth::user()->name}}</b>  Admin</h3>
					 </div>
				</a>
			</div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
		  
		<li class="{{($route==='dashboard' ? 'active' : '')}}">
          <a href="{{route('dashboard')}}">
            <i data-feather="pie-chart"></i>
			<span>Dashboard</span>
          </a>
        </li>  
		@if (Auth::user()->role=='Admin')
    <li class="treeview {{($prefix==='/user' ? 'active' : '')}}">
      <a href="#">
        <i data-feather="message-circle"></i>
        <span>User Manager</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{($route=='user.view' ? 'active' : '')}}"><a href="{{ route('user.view') }}"><i class="ti-more"></i>View User</a></li>
        <li class="{{($route=='user.create' ? 'active' : '')}}"><a href="{{ route('user.create') }}"><i class="ti-more"></i>Add User</a></li>
      </ul>
    </li> 
    @endif
       
		  
        <li class="treeview {{($prefix==='/profile' ?'active':'')}}">
          <a href="#">
            <i data-feather="mail"></i> <span>User Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{($route=='profile.view'? 'active': '')}}"><a href="{{ route('profile.view') }}"><i class="ti-more"></i>Your Profile</a></li>
            <li class="{{($route=='profile.changepassword' ? 'active': '')}}"><a href="{{ route('profile.changepassword') }}"><i class="ti-more"></i>Change Password</a></li>
            
          </ul>
        </li>
		
        <li class="treeview {{($prefix==='/setup' ? 'active' : '')}}">
          <a href="#">
            <i data-feather="file"></i>
            <span>Setup Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{($route==='student.view.class') ? 'active' : ''}}"><a href="{{ route('student.view.class') }}"><i class="ti-more"></i>Class Management</a></li>
            <li class="{{($route=='student.view.year') ? 'active' : ''}}"><a href="{{ route('student.view.year') }}"><i class="ti-more"></i>Year Management</a></li>
            <li><a href="{{ route('studentgroup.index') }}"><i class="ti-more"></i>Group Management</a></li>
            <li><a href="{{ route('shift.index') }}"><i class="ti-more"></i>Shift Management</a></li>
            <li><a href="{{ route('feecategory.index') }}"><i class="ti-more"></i>Fee Category</a></li>
            <li><a href="{{ route('feecateamount.index') }}"><i class="ti-more"></i>Fee Cate Amount</a></li>
            <li><a href="{{ route('examtype.index') }}"><i class="ti-more"></i>Exam Type</a></li>
            <li><a href="{{ route('subject.index') }}"><i class="ti-more"></i>Manage Subject</a></li>
            <li><a href="{{ route('assignsubject.index') }}"><i class="ti-more"></i>Assigned Subject</a></li>
            <li><a href="{{ route('designation.index') }}"><i class="ti-more"></i>Manage Designations</a></li>
          </ul>
        </li> 
        
        <!--student Managemet--->
       
        <li class="treeview {{($prefix==='/student' ? 'active' : '')}}">
          <a href="#">
            <i data-feather="user"></i>
            <span>Student Registration</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{($route=='registration.index' ? 'active' : '')}}"><a href="{{ route('registration.index') }}"><i class="ti-more"></i>Student View</a></li>
            <li class="{{($route=='registration.create' ? 'active' : '')}}"><a href="{{ route('registration.create') }}"><i class="ti-more"></i>Add Student</a></li>
            <li class="{{($route=='rollview.view' ? 'active': '')}}"><a href="{{route('rollview.view')}}"><i class="ti-more"></i>RollNumber Generate</a></li>
            <li class="{{($route=='registrationfee.view' ? 'active': '')}}"><a href="{{route('registrationfee.view')}}"><i class="ti-more"></i>Registration Fees</a></li>
            
            
            <li class="{{($route=='monthlyFees.view' ? 'active': '')}}"><a href="{{route('monthlyFees.view')}}"><i class="ti-more"></i>Monthly Fees </a></li>
            <li class="{{($route=='examFees.view' ? 'active': '')}}"><a href="{{route('examFees.view')}}"><i class="ti-more"></i>Exam Fees</a></li>
            
          </ul>
        </li> 
         {{-- end of studentManagemet --}}
         <!--Marks Management--->
         <li class="treeview {{($prefix=='/marks' ? 'active' : '')}}" >
          <a href="#">
            <i data-feather="credit-card"></i>
            <span>Marks Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li class="{{($route=='marks.addmarks' ?'active':'')}}"><a href="{{ route('marks.addmarks') }}"><i class="ti-more"></i>Add Marks</a></li>
			<li class="{{($route=='marks.edit' ?'active':'')}}"><a href="{{ route('marks.edit') }}"><i class="ti-more"></i>Edit Marks</a></li>
      <li class="{{($route=='grade.view' ?'active':'')}}"><a href="{{ route('grade.view') }}"><i class="ti-more"></i>Manage Grade</a></li>
			
		  </ul>
        </li> 
        <!--end of Marks Management--->

        <li class="header nav-small-cap">Accounts Section</li>
		  
        <li class="treeview {{($prefix==='/employeeManagement' ? 'active' : '')}}">
          <a href="#">
            <i data-feather="grid"></i>
            <span>Employee Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{($route==='empregistration.ViewEmpRegis' ? 'active' : '')}}" ><a href="{{ route('empregistration.ViewEmpRegis') }}"><i class="ti-more"></i>Employee Registration</a></li>
            <li class="{{ $route==='salary.view' ?'active' :'' }}"><a href="{{ route('salary.view') }}"><i class="ti-more"></i>Manage Salary</a></li>
            <li class="{{$route==='leave.view' ? 'active' : ''}}"><a href="{{ route('leave.view') }}"><i class="ti-more"></i>Leave Management</a></li>
            <li class="{{$route==="attendence.view" ? 'active' :''}}"><a href="{{ route('attendence.view') }}"><i class="ti-more"></i>Employee Attendence</a></li>
            <li class="{{($route==='monthlysalary.view') ? 'active' : ''}}"><a href="{{ route('monthlysalary.view') }}"><i class="ti-more"></i>Employee Monthly Salary</a></li>
          </ul>
        </li>
		
		 
		  <!--account Management-->
        <li class="treeview" class="{{($prefix=='/account' ? 'active' : '')}}">
          <a href="#">
            <i data-feather="hard-drive"></i>
            <span>Account Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="content_typography.html"><i class="ti-more"></i>Srudent Fees</a></li>
            <li><a href="content_media.html"><i class="ti-more"></i>Employee Salary</a></li>
            <li><a href="content_grid.html"><i class="ti-more"></i>Others Cost</a></li>
          </ul>
        </li>
		  <!--End of account Management-->
      <li class="header nav-small-cap">Reports Section</li>
        <li class="treeview">
          <a href="#">
            <i data-feather="package"></i>
            <span>Reports Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="utilities_border.html"><i class="ti-more"></i>Monthly/Yearly Profit</a></li>
            <li><a href="utilities_color.html"><i class="ti-more"></i>Color</a></li>
            <li><a href="utilities_ribbons.html"><i class="ti-more"></i>Ribbons</a></li>
            <li><a href="utilities_tab.html"><i class="ti-more"></i>Tabs</a></li>
            <li><a href="utilities_animations.html"><i class="ti-more"></i>Animation</a></li>
          </ul>
        </li>
		  
		<li class="treeview">
          <a href="#">
            <i data-feather="edit-2"></i>
            <span>Icons</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="icons_fontawesome.html"><i class="ti-more"></i>Font Awesome</a></li>
            <li><a href="icons_glyphicons.html"><i class="ti-more"></i>Glyphicons</a></li>
            <li><a href="icons_material.html"><i class="ti-more"></i>Material Icons</a></li>	
            <li><a href="icons_themify.html"><i class="ti-more"></i>Themify Icons</a></li>
            <li><a href="icons_simpleline.html"><i class="ti-more"></i>Simple Line Icons</a></li>
            <li><a href="icons_cryptocoins.html"><i class="ti-more"></i>Cryptocoins Icons</a></li>
            <li><a href="icons_flag.html"><i class="ti-more"></i>Flag Icons</a></li>
            <li><a href="icons_weather.html"><i class="ti-more"></i>Weather Icons</a></li>
          </ul>
        </li> 
		  
        <li class="treeview">
          <a href="#">
            <i data-feather="inbox"></i>
			<span>Forms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="forms_advanced.html"><i class="ti-more"></i>Advanced Elements</a></li>
            <li><a href="forms_editors.html"><i class="ti-more"></i>Editors</a></li>
            <li><a href="forms_code_editor.html"><i class="ti-more"></i>Code Editor</a></li>
            <li><a href="forms_validation.html"><i class="ti-more"></i>Form Validation</a></li>
            <li><a href="forms_wizard.html"><i class="ti-more"></i>Form Wizard</a></li>
            <li><a href="forms_general.html"><i class="ti-more"></i>General Elements</a></li>
            <li><a href="forms_dropzone.html"><i class="ti-more"></i>Dropzone</a></li>
          </ul>
        </li>
		<li class="treeview">
          <a href="#">
            <i data-feather="server"></i>
			<span>Tables</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="tables_simple.html"><i class="ti-more"></i>Simple tables</a></li>
            <li><a href="tables_data.html"><i class="ti-more"></i>Data tables</a></li>
          </ul>
        </li>
		  
        <li class="treeview">
          <a href="#">
            <i data-feather="pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="charts_chartjs.html"><i class="ti-more"></i>ChartJS</a></li>
            <li><a href="charts_flot.html"><i class="ti-more"></i>Flot</a></li>
            <li><a href="charts_inline.html"><i class="ti-more"></i>Inline</a></li>	
            <li><a href="charts_morris.html"><i class="ti-more"></i>Morris</a></li>
            <li><a href="charts_peity.html"><i class="ti-more"></i>Peity</a></li>
            <li><a href="charts_chartist.html"><i class="ti-more"></i>Chartist</a></li>
          </ul>
        </li>  
		  
        <li class="treeview">
          <a href="#">
            <i data-feather="map"></i>
			<span>Map</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="map_google.html"><i class="ti-more"></i>Google Map</a></li>
            <li><a href="map_vector.html"><i class="ti-more"></i>Vector Map</a></li>
          </ul>
        </li> 			  
		  
		<li class="treeview">
          <a href="#">
            <i data-feather="alert-triangle"></i>
			<span>Authentication</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="auth_login.html"><i class="ti-more"></i>Login</a></li>
			<li><a href="auth_register.html"><i class="ti-more"></i>Register</a></li>
			<li><a href="auth_lockscreen.html"><i class="ti-more"></i>Lockscreen</a></li>
			<li><a href="auth_user_pass.html"><i class="ti-more"></i>Password</a></li>
			<li><a href="error_404.html"><i class="ti-more"></i>Error 404</a></li>
			<li><a href="error_maintenance.html"><i class="ti-more"></i>Maintenance</a></li>	
          </ul>
        </li> 		  		  
		  
		<li class="header nav-small-cap">EXTRA</li>		  
		  
        <li class="treeview">
          <a href="#">
            <i data-feather="layers"></i>
			<span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Level One</a></li>
            <li class="treeview">
              <a href="#">Level One
                <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#">Level Two</a></li>
                <li class="treeview">
                  <a href="#">Level Two
                    <span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#">Level Three</a></li>
                    <li><a href="#">Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#">Level One</a></li>
          </ul>
        </li>  
		  
		<li>
          <a href="auth_login.html">
            <i data-feather="lock"></i>
			<span>Log Out</span>
          </a>
        </li> 
        
      </ul>
    </section>
	
	<div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div>
  </aside>