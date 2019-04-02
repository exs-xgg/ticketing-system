<div id="slide-out" class="side-nav side-nav-light fixed">
    <ul class="custom-scrollbar">
        <li>
            <div class="logo-wrapper waves-light">
                <img style="height:50px;width:50px;padding:5px;margin-top:15px;" src="{{ asset('images/wah.png') }}" alt=""> 
                <p style="margin-top:13px;color:black;padding-top:15px;font-size:16px;position:absolute;top:0;left:54px;">Wireless Access for Health</p>
            </div>
        </li>
        <li>
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a href="{{route('admin.dashboard')}}" class="{{Nav::isRoute('admin.dashboard')}} collapsible-header waves-effect arrow-r"><i class="fa fa-tachometer"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{route('admin.course.index')}}" class="{{Nav::hasSegment('course', 2)}} {{Nav::isRoute('admin.course.index')}} collapsible-header waves-effect arrow-r"><i class="fa fa-list"></i> Concern Records</a>
                </li>
                <li>
                    <a href="{{route('admin.instructor.index')}}" class="{{Nav::hasSegment('instructor', 2)}} collapsible-header waves-effect arrow-r"><i class="fa fa-users"></i> Admin Accounts</a>
                </li>
                <li>
                    <a href="{{route('admin.student.index')}}" class="{{Nav::hasSegment('student', 2)}} collapsible-header waves-effect arrow-r"><i class="fa fa-user"></i> RHU Accounts</a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="sidenav-bg mask-strong"></div>
</div>
