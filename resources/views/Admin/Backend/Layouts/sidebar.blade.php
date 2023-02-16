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
      <li class="treeview {{($prefix==='/account' ? 'active' : '')}}">
          <a href="#">
            <i data-feather="hard-drive"></i>
            <span>Account Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{$route=='fees.view' ? 'active' : ''}}"><a href="{{ route('fees.view') }}"><i class="ti-more"></i>Srudent Fees</a></li>
            <li class="{{$route==='acc.empsalary.view' ? 'active' : ''}}"><a href="{{ route('acc.empsalary.view') }}"><i class="ti-more"></i>Employee Salary</a></li>
            <li class="{{$route=="cost.view" ?'active' :''}}"><a href="{{ route('cost.view') }}"><i class="ti-more"></i>Others Cost</a></li>
          </ul>
        </li>
		  <!--End of account Management-->
      <li class="header nav-small-cap">Reports Section</li>
        <li class="treeview">
          <a href="#" class="{{$prefix==='/reports' ? 'active' : ''}}">
            <i data-feather="package"></i>
            <span>Reports Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{$route==='profit.view' ? 'active' : ''}}"><a href="{{ route('profit.view') }}"><i class="ti-more"></i>Monthly/Yearly Profit</a></li>
            <li class="{{$route=='marksheet.view' ? 'active' :''}}"><a href="{{ route('marksheet.view') }}"><i class="ti-more"></i>Generate Marksheet</a></li>
            <li class="{{$route=='att.view' ?'active' :''}}"><a href="{{route('att.view')}}"><i class="ti-more"></i>Employee Attendance</a></li>
            <li class="{{$route==='result.view' ? 'active' : ''}}"><a href="{{ route('result.view') }}"><i class="ti-more"></i>Student Result</a></li>
            <li class="{{$route=='idcard.view' ? 'active' : ''}}"><a href="{{ route('idcard.view') }}"><i class="ti-more"></i>Student Id Card</a></li>
          </ul>
        </li>
		<li class="header nav-small-cap">EXTRA</li>		  
		
		<li>
          <a href="{{ route('user.logout') }}">
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