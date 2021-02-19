                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    
                    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                @if (Auth::check())
                                    @hasanyrole('approver|reviewer|creator')
                                    <li class="app-sidebar__heading">Dashboard</li>
                                     
                                    <li class='{{ Request::is("home") ? "mm-active" : Request::is("/") ? "mm-active" : "" }}'>
                                        <a href="{{ route('home') }}" >
                                            <i class="metismenu-icon fa fa-home"></i>
                                            Home
                                        </a>
                                    </li>
                                    @endhasrole
                                    @can('user-list')
                                    
                                    <li class="app-sidebar__heading">Main Menu</li>
                                        <li class='{{ Request::is("users*") ? "mm-active" : "" }}'>
                                            <a href="{{ route('users.index') }}">
                                                <i class="metismenu-icon fa fa-users"></i>
                                                Manage Users
                                            </a>
                                        </li>
                                    @endcan
                                    @hasrole('super-admin')
                                        <li class="mm-active">
                                            <a href="#">
                                                <i class="metismenu-icon fa fa-sun"></i>
                                                Masters
                                                <i class="metismenu-state-icon fa fa-angle-down caret-left"></i>
                                            </a>
                                            <ul>
                                                @can('permission-list')
                                                    <li class={{ Request::is("permission*") ? "mm-active" : "" }}>
                                                        <a href="{{ route('permission.index') }}" >
                                                            <i class="metismenu-icon">
                                                            </i>Permissions
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('location-list')
                                                    <li class={{ Request::is("locations*") ? "mm-active" : "" }}>
                                                        <a href="{{ route('locations.index') }}" >
                                                            <i class="metismenu-icon">
                                                            </i>Locations
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('role-list')
                                                    <li class={{ Request::is("role*") ? "mm-active" : "" }}>
                                                        <a href="{{ route('roles.index') }}" >
                                                            <i class="metismenu-icon">
                                                            </i>Role
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('skill-list')
                                                    <li class={{ Request::is("projectskills*") ? "mm-active" : "" }}>
                                                        <a href="{{ route('projectskills.index') }}" >
                                                            <i class="metismenu-icon">
                                                            </i>Skills
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('manager-list')
                                                    <li class={{ Request::is("managers*") ? "mm-active" : "" }}>
                                                        <a href="{{ route('managers.index') }}" >
                                                            <i class="metismenu-icon">
                                                            </i>Manager
                                                        </a>
                                                    </li>
                                                @endcan
                                                {{--@can('workflow-list')
                                                    <li class={{ Request::is("workflows*") ? "mm-active" : "" }}>
                                                        <a href="{{ route('workflows.index') }}" >
                                                            <i class="metismenu-icon">
                                                            </i>Workflow
                                                        </a>
                                                    </li>
                                                @endcan--}}
                                                @can('projectrole-list')
                                                    <li class={{ Request::is("projectroles*") ? "mm-active" : "" }}>
                                                        <a href="{{ route('projectroles.index') }}" > <!-- class="mm-active" -->
                                                            <i class="metismenu-icon">
                                                            </i>Project Roles
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('procuringparties-list')
                                                    <li class={{ Request::is("procuring*") ? "mm-active" : "" }}>
                                                        <a href="{{ route('procuring.index') }}" >
                                                            <i class="metismenu-icon">
                                                            </i>Procuring Party
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('project_type-list')
                                                    <li class={{ Request::is("project_type*") ? "mm-active" : "" }}>
                                                        <a href="{{ route('project_type.index') }}" >
                                                            <i class="metismenu-icon">
                                                            </i>Project Type
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('sow_master-list')
                                                    <li class={{ Request::is("sow_header*") ? "mm-active" : "" }}>
                                                        <a href="{{ route('sow_header') }}" >
                                                            <i class="metismenu-icon">
                                                            </i>Sow Header
                                                        </a>
                                                    </li>
                                                @endcan
                                                
                                            </ul>
                                        </li>
                                    @endhasrole
                                    @hasanyrole('approver|reviewer')
                                    
                                        <li class="app-sidebar__heading">My Tasks</li>
                                        @hasrole('approver')
                                            <li class={{ Request::is("approve*") ? "mm-active" : ""}}>
                                                <a href="{{ route('sowslist', ['filter' => 'approve']) }}">
                                                    <i class="metismenu-icon fa fa-tasks"></i>
                                                    Approve Requests
                                                    @if(isset($sidebar["action"]["sent_to_approver"]))
                                                    <div class="badge badge-success mr-1 ml-0">
                                                        <large>{{$sidebar["action"]["sent_to_approver"]}}</large>
                                                    </div>
                                                    @endif
                                                </a>
                                            </li>
                                        @endhasrole
                                        @hasrole('reviewer')
                                            <li class={{ Request::is("review*") ? "mm-active" : ""}}>
                                                <a href="{{ route('sowslist', ['filter' => 'review']) }}">
                                                    <i class="metismenu-icon fa fa-search"></i>
                                                    Review Requests
                                                    @if(isset($sidebar["action"]["sent_to_reviewer"]))
                                                    <div class="badge badge-success mr-1 ml-0">
                                                        <large>{{$sidebar["action"]["sent_to_reviewer"]}}</large>
                                                    </div>
                                                    @endif
                                                </a>
                                            </li>
                                        @endhasrole
                                        <li class={{ Request::is("processed*") ? "mm-active" : ""}}>
                                                <a href="{{ route('sowslist', ['filter' => 'processed']) }}">
                                                    <i class="metismenu-icon fa fa-database"></i>
                                                    Processed Requests
                                                   </a>
                                            </li>
                                        <div tabindex="-1" class="dropdown-divider"></div>
                                    @endhasrole
                                    @hasrole('creator')
                                        <li class="app-sidebar__heading">My Items</li>
                                        <!-- <li class={{ Request::is("sows/create") ? "mm-active" : ""}}>
                                            <a href="{{ route('sows.create') }}" type="button" class="btn-shadow btn btn-success btn-block">
                                                <i class="metismenu-icon fa fa-plus"></i>
                                                Create New SOW
                                            </a>
                                        </li> -->
                                        <div class="dropdown show">
  <a class="btn btn-success dropdown-toggle btn-block btn-shadow " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Create New
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="{{ route('sows.create') }}">SOW</a>
    <a class="dropdown-item" href="{{ route('createAmendment') }}">Amendment</a>
  </div>
</div>
                                        <li class={{ Request::is("draft/*") ? "mm-active" : "" }}>
                                            <a href="{{ route('sowslist', ['filter' => 'draft']) }}">
                                                <i class="metismenu-icon fa fa-edit"></i>
                                                Drafts
                                                @if(isset($sidebar["creator"]["draft"]))
                                                <div class="badge badge-info mr-1 ml-0">
                                                    <large>{{$sidebar["creator"]["draft"]}}</large>
                                                </div>
                                                @endif
                                            </a>
                                        </li>
                                        <li class={{ Request::is("inprogress/*") ? "mm-active" : "" }}>
                                            <a href="{{ route('sowslist', ['filter' => 'inprogress']) }}">
                                                <i class="metismenu-icon fa fa-hourglass-half"></i>
                                                In Progress
                                                @if(isset($sidebar["creator"]["sent_to_reviewer"]) || isset($sidebar["creator"]["sent_to_approver"]) )
                                                <div class="badge badge-info mr-1 ml-0">
                                                    <large>{{ (isset($sidebar["creator"]["sent_to_reviewer"]) ? $sidebar["creator"]["sent_to_reviewer"] : 0) + 
                                                    (isset($sidebar["creator"]["sent_to_approver"]) ? $sidebar["creator"]["sent_to_approver"] : 0) }}</large>
                                                </div>
                                                @endif 
                                            </a>
                                        </li>
                                        <li class={{ Request::is("approved/*") ? "mm-active" : "" }}>
                                            <a href="{{ route('sowslist', ['filter' => 'approved']) }}">
                                                <i class="metismenu-icon fa fa-tasks fa-w-1"></i>
                                                Approved
                                                @if(isset($sidebar["creator"]["approved_by_approver"]))
                                                <div class="badge badge-success mr-1 ml-0">
                                                    <large>{{$sidebar["creator"]["approved_by_approver"]}}</large>
                                                </div>
                                                @endif
                                            </a>
                                        </li>
                                        <li class={{ Request::is("rejected/*") ? "mm-active" : "" }}>
                                            <a href="{{ route('sowslist', ['filter' => 'rejected']) }}">
                                                <i class="metismenu-icon fa fa-times-circle"></i>
                                                Rejected
                                                @if(isset($sidebar["creator"]["rejected_by_reviewer"]) || isset($sidebar["creator"]["rejected_by_approver"]) )
                                                <div class="badge badge-danger mr-1 ml-0">
                                                    <large>{{ (isset($sidebar["creator"]["rejected_by_reviewer"]) ? $sidebar["creator"]["rejected_by_reviewer"] : 0) + 
                                                    (isset($sidebar["creator"]["rejected_by_approver"]) ? $sidebar["creator"]["rejected_by_approver"] : 0) }}</large>
                                                </div>
                                                @endif
                                            </a>
                                        </li>
                                    @endhasrole
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
