<style>
    a {
        text-decoration: none;
    }

</style>
@php
use App\Models\TeacherProfile;
use App\Models\TeacherArea;
use App\Models\Subjects;
use App\Models\TeacherFee;
use App\Models\TeacherShift;
use App\Models\TeacherGrade;
use App\Models\TeacherBoard;
$user = Auth::user()->id;
$about_me = TeacherProfile::where('role_id',$user)->first();
$all_subjects = Subjects::where('role_id',$user)->get();
$all_areas = TeacherArea::where('role_id',$user)->get();
$all_fees = TeacherFee::where('role_id',$user)->first();
$all_grades = TeacherGrade::where('role_id',$user)->get();
$all_shift = TeacherShift::where('role_id',$user)->get();
$all_boards = TeacherBoard::where('role_id',$user)->get();
@endphp
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="@if($logo){{ asset('/uploads/logo/'.$logo->logo) }}@endif" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">ManalTutors</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @if ($profileData->role==='admin')
        <li>
            <a href="{{route('admin.dashboard')}}">
                <div class="parent-icon"><i class="fa-solid fa-house"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{route('admin.teacher')}}">
                <div class="parent-icon"><i class="fa-solid fa-user-tie"></i>
                </div>
                <div class="menu-title">Teachers</div>
            </a>
        </li>
        <li>
            <a href="{{route('admin.student')}}">
                <div class="parent-icon"><i class="fa-solid fa-user-graduate"></i>
                </div>
                <div class="menu-title">Students</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div class="menu-title">Grade</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.grade.create')}}"><i class='bx bx-radio-circle'></i>Add Grade</a>
                </li>
                <li> <a href="{{route('admin.grade.index')}}"><i class='bx bx-radio-circle'></i>View Grades</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-book"></i>
                </div>
                <div class="menu-title">Subject</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.subject.create')}}"><i class='bx bx-radio-circle'></i>Add Subject</a>
                </li>
                <li> <a href="{{route('admin.subject.index')}}"><i class='bx bx-radio-circle'></i>View Subjects</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="menu-title">Areas</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.area.create')}}"><i class='bx bx-radio-circle'></i>Add Area</a>
                </li>
                <li> <a href="{{route('admin.area.index')}}"><i class='bx bx-radio-circle'></i>View Areas</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-landmark"></i>
                </div>
                <div class="menu-title">Education Boards</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.board.create')}}"><i class='bx bx-radio-circle'></i>Add Board</a>
                </li>
                <li> <a href="{{route('admin.board.index')}}"><i class='bx bx-radio-circle'></i>View Boards</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-video"></i>
                </div>
                <div class="menu-title">Teacher Videos</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.teacher.pending.video')}}"><i class='bx bx-radio-circle'></i>Pending Videos</a>
                </li>
                <li> <a href="{{route('admin.teacher.approved.video')}}"><i class='bx bx-radio-circle'></i>Approved Videos</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-certificate"></i>
                </div>
                <div class="menu-title">Sponsored Teacher</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.add.sponsor.teacher')}}"><i class='bx bx-radio-circle'></i>Add Sponsored Teachers</a>
                </li>
                <li> <a href="{{route('admin.sponsor.teacher')}}"><i class='bx bx-radio-circle'></i>View Sponsored Teachers</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-tags"></i>
                </div>
                <div class="menu-title">Pricing & Plans</div>
            </a>
            <ul>
                @if($pricings->count() < 3) <li>
                    <a href="{{route('admin.pricing.create')}}"><i class='bx bx-radio-circle'></i>Add Pricing</a>
        </li>
        @endif
        <li> <a href="{{route('admin.pricing')}}"><i class='bx bx-radio-circle'></i>View Pricing</a>
        </li>
    </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-money-bill-1-wave"></i>
                </div>
                <div class="menu-title">Payments</div>
            </a>
            <ul>
                <li><a href="{{route('admin.student.payment')}}"><i class='bx bx-radio-circle'></i>Student Package Payments</a>
                </li>
                <li> <a href="{{route('admin.teacher.payment')}}"><i class='bx bx-radio-circle'></i>Student Hiring Payments</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-newspaper"></i>
                </div>
                <div class="menu-title">Blogs</div>
            </a>
            <ul>
                <li><a href="{{route('admin.blog.create')}}"><i class='bx bx-radio-circle'></i>New Blog</a>
                </li>
                <li> <a href="{{route('admin.blog.index')}}"><i class='bx bx-radio-circle'></i>All Blogs</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{route('admin.abuse.report')}}">
                <div class="parent-icon position-relative"><i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div class="menu-title ">
                    Abuse Reports
                    <span class="position-absolute top-50 end-0 translate-middle badge rounded-pill bg-danger">
                        {{$allreports ? $allreports->count() : 0}}
                    </span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{route('admin.contact.mail')}}">
                <div class="parent-icon position-relative"><i class="fa-solid fa-comments"></i>
                </div>
                <div class="menu-title">
                    Contact Mails
                    <span class="position-absolute top-50 end-0 translate-middle badge rounded-pill bg-danger">
                        {{$allmails ? $allmails->count() : 0}}
                    </span>
                </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="">
                <div class="parent-icon"><i class="fa-solid fa-ticket"></i>
                </div>
                <div class="menu-title">
                    Ticket
                    <span class="position-absolute top-50 end-0 translate-middle badge rounded-pill bg-danger">
                        {{$allTickets ? $allTickets->count() : 0}}
                    </span>
                </div>
            </a>
            <ul>
                <li class="position-relative"> <a href="{{route('admin.ticket.student')}}"><i class='bx bx-radio-circle'></i>Student Tickets</a>
                    <span class="position-absolute top-50 end-0 translate-middle badge rounded-pill bg-danger">
                        {{$studentTickets ? $studentTickets->count() : 0}}
                    </span>
                </li>
                <li class="position-relative"> <a href="{{route('admin.ticket.teacher')}}"><i class='bx bx-radio-circle'></i>Teacher Tickets</a>
                    <span class="position-absolute top-50 end-0 translate-middle badge rounded-pill bg-danger">
                        {{$teacherTickets ? $teacherTickets->count() : 0}}
                    </span>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{route('admin.contactus')}}">
                <div class="parent-icon"><i class="fa-solid fa-phone"></i>
                </div>
                <div class="menu-title ">
                    Contact Us
                </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-display"></i>
                </div>
                <div class="menu-title">Frontend</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.logo')}}"><i class='bx bx-radio-circle'></i>Logo</a>
                </li>
                <li> <a href="{{route('admin.about')}}"><i class='bx bx-radio-circle'></i>About Us</a>
                </li>
                <li> <a href="{{route('admin.service')}}"><i class='bx bx-radio-circle'></i>Service</a>
                </li>
                <li> <a href="{{route('admin.footer')}}"><i class='bx bx-radio-circle'></i>Footer</a>
                </li>
                <li> <a href="{{route('admin.sociallink')}}"><i class='bx bx-radio-circle'></i>Social Links</a>
                </li>
            </ul>
        </li>
        @endif
        @if ($profileData->role==='teacher')
        <li>
            <a href="{{route('teacher.dashboard')}}">
                <div class="parent-icon"><i class="fa-solid fa-house"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-user-tie"></i>
                </div>
                <div class="menu-title">About me</div>
            </a>
            <ul>
                @if($teacherProfile == null )
                <li> <a href="{{route('teacher.profile.create')}}"><i class='bx bx-radio-circle'></i>Add Info</a>
                </li>
                @endif
                <li> <a href="{{route('teacher.profile.index')}}"><i class='bx bx-radio-circle'></i>View Info</a>
                </li>
            </ul>
        </li>
        @if($about_me != null)
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-book"></i>
                </div>
                <div class="menu-title">Subject</div>
            </a>
            <ul>
                <li> <a href="{{route('teacher.subject.create')}}"><i class='bx bx-radio-circle'></i>Add Subjects</a>
                </li>
                <li> <a href="{{route('teacher.subject.index')}}"><i class='bx bx-radio-circle'></i>View Subjects</a>
                </li>
            </ul>
        </li>
        @endif
        @if($all_subjects->count() > 0)
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="menu-title">Areas</div>

            </a>
            <ul>
                <li> <a href="{{route('teacher.area.create')}}"><i class='bx bx-radio-circle'></i>Add Area</a>
                </li>
                <li> <a href="{{route('teacher.area.index')}}"><i class='bx bx-radio-circle'></i>View Areas</a>
                </li>
            </ul>
        </li>
        @endif
        @if($all_areas->count() > 0)
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-money-bill-1-wave"></i>
                </div>
                <div class="menu-title">Fees</div>
            </a>
            <ul>
                @if($fee != null)
                <li> <a href="{{route('teacher.fees.index')}}"><i class='bx bx-radio-circle'></i>View Fees</a>
                </li>
                @else
                <li> <a href="{{route('teacher.fees.create')}}"><i class='bx bx-radio-circle'></i>Add Fees</a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if($all_fees != null)
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-clock"></i>
                </div>
                <div class="menu-title">Timings</div>
            </a>
            <ul>
                @if($shifts->count() < 3) <li><a href="{{route('teacher.shift.create')}}"><i class='bx bx-radio-circle'></i>Add Timing</a>
        </li>
        @endif
        <li><a href="{{route('teacher.shift.index')}}"><i class='bx bx-radio-circle'></i>View Timing</a>
        </li>
        </ul>
        </li>
        @endif
        @if($all_shift->count() > 0)
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div class="menu-title">Grade</div>
            </a>
            <ul>
                <li> <a href="{{route('teacher.grade.create')}}"><i class='bx bx-radio-circle'></i>Add Grades</a>
                </li>
                <li> <a href="{{route('teacher.grade.index')}}"><i class='bx bx-radio-circle'></i>View Grades</a>
                </li>
            </ul>
        </li>
        @endif
        @if($all_grades->count() > 0)
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-landmark"></i>
                </div>
                <div class="menu-title">Education Boards</div>
            </a>
            <ul>
                <li> <a href="{{route('teacher.board.create')}}"><i class='bx bx-radio-circle'></i>Add Board</a>
                </li>
                <li> <a href="{{route('teacher.board.index')}}"><i class='bx bx-radio-circle'></i>View Boards</a>
                </li>
            </ul>
        </li>
        @endif
        @if($all_boards->count() > 0)
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-video"></i>
                </div>
                <div class="menu-title">Trial Video</div>
            </a>
            <ul>
                @if($fee == null)
                <li> <a href="{{route('teacher.video.create')}}"><i class='bx bx-radio-circle'></i>Add Video</a>
                </li>
                @else
                <li> <a href="{{route('teacher.video.index')}}"><i class='bx bx-radio-circle'></i>View Video</a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-comments"></i>
                </div>
                <div class="menu-title">Contact to Admin</div>
            </a>
            <ul>
                <li> <a href="{{route('teacher.mail.new')}}"><i class='bx bx-radio-circle'></i>New Mail</a>
                </li>
                <li> <a href="{{route('teacher.mail')}}"><i class='bx bx-radio-circle'></i>All Mails</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-ticket"></i>
                </div>
                <div class="menu-title">Ticket</div>
            </a>
            <ul>
                <li> <a href="{{route('teacher.ticket.add')}}"><i class='bx bx-radio-circle'></i>New Ticket</a>
                </li>
                <li> <a href="{{route('teacher.ticket')}}"><i class='bx bx-radio-circle'></i>All Tickets</a>
                </li>
            </ul>
        </li>
        @endif
        @if ($profileData->role==='student')
        <li>
            <a href="{{route('student.dashboard')}}">
                <div class="parent-icon"><i class="fa-solid fa-house"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{route('student.report.teacher')}}">
                <div class="parent-icon"><i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div class="menu-title">Report Teacher</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa-solid fa-ticket"></i>
                </div>
                <div class="menu-title">Ticket</div>
            </a>
            <ul>
                <li> <a href="{{route('student.ticket.add')}}"><i class='bx bx-radio-circle'></i>New Ticket</a>
                </li>
                <li> <a href="{{route('student.ticket')}}"><i class='bx bx-radio-circle'></i>All Tickets</a>
                </li>
            </ul>
        </li>
        @endif
    </ul>
</div>
