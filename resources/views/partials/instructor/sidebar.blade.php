<div id="slide-out" class="side-nav side-nav-light fixed">
    <ul class="custom-scrollbar">
        <li>
            <div class="logo-wrapper waves-light">
                <img style="height:50px;width:50px;padding:5px;margin-top:15px;" src="{{ asset('images/wah1.png') }}" alt=""> 
                <p style="margin-top:13px;color:black;padding-top:15px;font-size:16px;position:absolute;top:0;left:54px;">Wireless Access for Health</p>
            </div>
        </li>
        <li>
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a href="{{route('instructor.dashboard')}}" class="{{Nav::isRoute('instructor.dashboard')}} collapsible-header waves-effect arrow-r"><i class="fa fa-list"></i> Courses</a>
                </li>

                @if (Nav::hasSegment('course', 2))
                    <li>
                        <a href="{{route('instructor.section.index', $course->id)}}" class="{{Nav::hasSegment('section',4)}} {{Nav::hasSegment('sections',4)}} collapsible-header waves-effect arrow-r"><i class="fa fa-graduation-cap"></i> Sections</a>
                    </li>
                    <li>
                        <a href="{{route('instructor.announcement.index', $course->id)}}" class="{{Nav::hasSegment('announcements',4)}} {{Nav::hasSegment('announcement',4)}} collapsible-header waves-effect arrow-r"><i class="fa fa-bullhorn"></i> Announcements</a>
                    </li>
                    <li>
                        <a href="{{route('instructor.lesson.index', $course->id)}}" class="{{Nav::hasSegment('lesson',4)}} {{Nav::hasSegment('lessons',4)}} collapsible-header waves-effect arrow-r"><i class="fa fa-bookmark"></i> Lessons</a>
                    </li>
                    <li>
                        <a href="{{route('instructor.quiz.index', $course->id)}}" class="{{Nav::hasSegment('quiz',4)}} {{Nav::hasSegment('quizzes',4)}} collapsible-header waves-effect arrow-r"><i class="fa fa-book"></i> Quizzes</a>
                    </li>
                    <li>
                        <a href="{{route('instructor.assignment.index', $course->id)}}" class="{{Nav::hasSegment('assignment',4)}} {{Nav::hasSegment('assignments',4)}} collapsible-header waves-effect arrow-r"><i class="fa fa-address-book"></i> Assignments</a>
                    </li>
                    <li>
                        <a href="{{route('instructor.token.index', $course->id)}}" class="{{Nav::hasSegment('token',4)}} {{Nav::hasSegment('tokens',4)}} collapsible-header waves-effect arrow-r"><i class="fa fa-key"></i> Tokens</a>
                    </li>
                @endif
            </ul>
        </li>
    </ul>
    <div class="sidenav-bg mask-strong"></div>
</div>
