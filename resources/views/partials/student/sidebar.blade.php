<div id="slide-out" class="side-nav side-nav-light fixed">
        <ul class="custom-scrollbar">
            <li>
                <div class="logo-wrapper waves-light">
                    <img style="height:50px;width:50px;padding:5px;margin-top:15px;" src="{{ asset('images/ccs.png') }}" alt=""> 
                    <p style="margin-top:13px;color:black;padding-top:15px;font-size:16px;position:absolute;top:0;left:54px;">Learning Management System</p>
                </div>
            </li>
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a href="{{route('student.dashboard')}}" class="{{Nav::hasSegment('dashboard',2)}} collapsible-header waves-effect arrow-r"><i class="fa fa-list"></i> Course</a>
                    </li>
                    @if (Nav::hasSegment('section', 4))
                        <li>
                            <a href="{{route('student.section.index', [$course->id, $section->id])}}" class="{{Nav::isRoute('student.section.index')}} {{Nav::hasSegment('mysection',6)}} collapsible-header waves-effect arrow-r"><i class="fa fa-graduation-cap"></i>  Section</a>
                        </li>
                        <li>
                            <a href="{{route('student.announcement', [$course->id, $section->id])}}" class="{{Nav::hasSegment('announcements',6)}} collapsible-header waves-effect arrow-r"><i class="fa fa-bullhorn"></i> Announcements</a>
                        </li>
                        <li>
                            <a href="{{route('student.lesson.index', [$course->id, $section->id])}}" class="{{Nav::hasSegment('lessons',6)}} {{Nav::hasSegment('lesson',6)}} collapsible-header waves-effect arrow-r"><i class="fa fa-bookmark"></i> Lessons</a>
                        </li>
                        <li>
                            <a href="{{route('student.quiz.index', [$course->id, $section->id])}}" class="{{Nav::hasSegment('quizzes',6)}} {{Nav::hasSegment('quiz',6)}} collapsible-header waves-effect arrow-r"><i class="fa fa-book"></i> Quizzes</a>
                        </li>
                        <li>
                            <a href="{{route('student.assignment.index', [$course->id, $section->id])}}" class="{{Nav::hasSegment('assignment',6)}} {{Nav::hasSegment('assignments',6)}} collapsible-header waves-effect arrow-r"><i class="fa fa-address-book"></i> Assignments</a>
                        </li>
                    @endif
                </ul>
            </li>
        </ul>
        <div class="sidenav-bg mask-strong"></div>
    </div>
