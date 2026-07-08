<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\ContactAdmin;
use App\Models\Contactus;
use App\Models\Logo;
use App\Models\Footer;
use App\Models\AboutUs;
use App\Models\PayScreenshot;
use App\Models\ReportAbuse;
use App\Models\Service;
use App\Models\AdminArea;
use App\Models\AdminBoard;
use App\Models\AdminGrade;
use App\Models\Sociallink;
use App\Models\AdminSubject;
use App\Models\StdPricing;
use App\Models\TeacherBooking;
use App\Models\TeacherPay;
use App\Models\TeacherVideo;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TeacherProfile;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $bookings = TeacherBooking::get();
        return view('admin.index', compact('bookings'));
    }




    //------------------All teachers------------------//
    public function allTeacher()
    {
        $Videos = TeacherVideo::get();
        if ($Videos->count() > 0) {
            foreach ($Videos as $video) {
                $teacher = TeacherProfile::where('role_id', $video->role_id)->first();
                if ($teacher) {
                    $allTeachers[] = $teacher;
                }
            }
            return view('admin.teacher.index', compact('allTeachers'));
        } else {
            $allTeachers = [];
            return view('admin.teacher.index', compact('allTeachers'));
        }
    }
    public function teacherApprove($id)
    {
        $approval = TeacherProfile::find($id);
        if ($approval->approval == 'pending') {
            $approval->approval = 'active';
        }
        $approval->save();
        $notification = array(
            'message' => 'Request Approved Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.teacher'))->with($notification);
    }
    public function teacherReject($id)
    {
        $approval = TeacherProfile::find($id);
        if ($approval->approval == 'pending') {
            $approval->approval = 'deactive';
        }
        $approval->save();
        $notification = array(
            'message' => 'Request Rejected Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.teacher'))->with($notification);
    }
    public function teacherReapprove($id)
    {
        $approval = TeacherProfile::find($id);
        if ($approval->approval == 'deactive') {
            $approval->approval = 'active';
        }
        $approval->save();
        $notification = array(
            'message' => 'Request Re-Approved Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.teacher'))->with($notification);
    }
    public function teacherStatus($id)
    {
        $approval = TeacherProfile::find($id);
        if ($approval->status == 'active') {
            $approval->status = 'deactive';
        } else {
            $approval->status = 'active';
        }
        $approval->save();
        $notification = array(
            'message' => 'Status Changed Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.teacher'))->with($notification);
    }
    public function pendingVideo()
    {
        $videos = TeacherVideo::where('approval', '2')->orWhere('approval', '0')->orderBy('id', 'desc')->get();
        return view('admin.teacher_video.pending_videos', compact('videos'));
    }
    public function approvedVideo()
    {
        $videos = TeacherVideo::where('approval', '1')->orderBy('id', 'desc')->get();
        return view('admin.teacher_video.approved_videos', compact('videos'));
    }
    public function videoApprove($id)
    {
        $approval = TeacherVideo::find($id);
        if ($approval->approval == '2') {
            $approval->approval = '1';
        }
        $approval->save();
        $notification = array(
            'message' => 'Video Approved Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.teacher.pending.video'))->with($notification);
    }
    public function videoReject($id)
    {
        $approval = TeacherVideo::find($id);
        if ($approval->approval == '2' || $approval->approval == '1') {
            $approval->approval = '0';
        }
        $approval->save();
        $notification = array(
            'message' => 'Video Rejected Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.teacher.pending.video'))->with($notification);
    }
    public function teacherUserSuspend($id)
    {
        $approval = User::find($id);
        if ($approval->status == '1') {
            $approval->status = '0';
        } else {
            $approval->status = '1';
        }
        $approval->save();
        $notification = array(
            'message' => 'Suspension changed Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.teacher'))->with($notification);
    }






    //------------------Statuses------------------//
    public function allStudent()
    {
        $students = User::where('role', 'student')->orderBy('id', 'desc')->get();
        return view('admin.student.index', compact('students'));
    }
    public function studentStatus($id)
    {
        $approval = User::find($id);
        if ($approval->status == '1') {
            $approval->status = '0';
        } else {
            $approval->status = '1';
        }
        $approval->save();
        $notification = array(
            'message' => 'Status Changed Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.student'))->with($notification);
    }
    public function studentFeesApproval($id)
    {
        $booking = TeacherBooking::find($id);
        if ($booking->admin_approval == '2') {
            $booking->admin_approval = '1';
        }
        $booking->save();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Payment Approval Done'
        ];
        return redirect(route('admin.dashboard'))->with($notification);
    }
    public function studentFeesReject($id)
    {
        $booking = TeacherBooking::find($id);
        if ($booking->admin_approval == '2') {
            $booking->admin_approval = '0';
        }
        $booking->save();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Payment Rejected'
        ];
        return redirect(route('admin.dashboard'))->with($notification);
    }







    //------------------All Reports------------------//
    public function abuseReports()
    {
        $reports = ReportAbuse::orderByRaw('read_no = 0 DESC')
            ->orderBy('created_at', 'desc') // secondary ordering
            ->get();
        // return $reports;
        return view('admin.report.index', compact('reports'));
    }

    public function teacherSuspend($id)
    {
        $approval = User::find($id);
        if ($approval->status == '1') {
            $approval->status = '0';
        } else {
            $approval->status = '1';
        }
        $approval->save();
        $notification = array(
            'message' => 'Teacher Suspended Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.abuse.report'))->with($notification);
    }
    public function studentSuspend($id)
    {
        $approval = User::find($id);
        if ($approval->status == '1') {
            $approval->status = '0';
        } else {
            $approval->status = '1';
        }
        $approval->save();
        $notification = array(
            'message' => 'Student Suspended Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.abuse.report'))->with($notification);
    }
    public function reportSeen($reportId)
    {
        $report = ReportAbuse::find($reportId);

        // Example logic: mark it as read
        $report->read_no = '1';
        $report->save();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Marked as seen'
        ];
        return redirect(route('admin.abuse.report'))->with($notification);
    }







    //------------------Contact Mails------------------//
    public function contactMails()
    {
        $mails = ContactAdmin::join('users', 'contact_admin.from_name', '=', 'users.id')
            ->select('contact_admin.*', 'users.email', 'users.name', 'users.photo', 'users.id as from_name')
            ->orderBy('contact_admin.seen', 'asc')
            ->paginate(6);
        return view('admin.mail.index', compact('mails'));
    }
    public function contactMailsSeen($id)
    {
        $mail = ContactAdmin::find($id);

        // Example logic: mark it as read
        $mail->seen = '1';
        $mail->save();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Marked as seen'
        ];
        return redirect(route('admin.contact.mail'))->with($notification);
    }








    //------------------Student Tickets------------------//
    public function studentTicket()
    {
        $studentTickets = Ticket::join('users', 'tickets.student_id', '=', 'users.id')
            ->select('tickets.*', 'users.email', 'users.name', 'users.photo', 'users.id as student_id')
            ->paginate(14);
        return view('admin.ticket.student-ticket', compact('studentTickets'));
    }
    public function teacherTicket()
    {
        $teacherTickets = Ticket::join('users', 'tickets.teacher_id', '=', 'users.id')
            ->select('tickets.*', 'users.email', 'users.name', 'users.photo', 'users.id as teacher_id')
            ->paginate(14);
        return view('admin.ticket.teacher-ticket', compact('teacherTickets'));
    }
    public function seenTicket($id)
    {
        $ticket = Ticket::find($id);
        $ticket->seen = '1';
        $ticket->save();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Marked as seen'
        ];
        return redirect()->back()->with($notification);
    }






    //----------------------Grade----------------------//

    public function gradeIndex()
    {
        $grades = AdminGrade::get();
        return view('admin.grade.index', compact('grades'));
    }
    public function gradeCreate()
    {
        return view('admin.grade.add');
    }
    public function gradeStore(Request $request)
    {
        $request->validate([
            'grade' => 'required',
        ]);
        AdminGrade::create([
            'grade' => $request->grade,
        ]);
        $notification = array(
            'message' => 'Grade Added Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.grade.index'))->with($notification);
    }
    public function gradeEdit($id)
    {
        $grade = AdminGrade::find($id);
        return view('admin.grade.edit', compact('grade'));
    }
    public function gradeUpdate(Request $request, $id)
    {
        $request->validate([
            'grade' => 'required',
        ]);
        $grade = AdminGrade::find($id);
        $grade->grade = $request->grade;
        $grade->save();
        $notification = array(
            'message' => 'Grade Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.grade.index'))->with($notification);
    }
    public function gradeDestroy($id)
    {
        $grade = AdminGrade::find($id);
        $grade->delete();
        $notification = array(
            'message' => 'Grade Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.grade.index'))->with($notification);
    }






    //----------------------Subject----------------------//

    public function subjectIndex()
    {
        $subjects = AdminSubject::get();
        return view('admin.subject.index', compact('subjects'));
    }
    public function subjectCreate()
    {
        return view('admin.subject.add');
    }
    public function subjectStore(Request $request)
    {
        $request->validate([
            'sub_img' => 'required',
            'subject' => 'required',
        ]);
        if ($request->file('sub_img')) {
            $file = $request->file('sub_img');
            // @unlink(public_path('uploads/profileimages/' . $profileData->sub_img));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads/adminimages'), $filename);
        }
        AdminSubject::create([
            'subject' => $request->subject,
            'sub_img' => $filename
        ]);
        $notification = array(
            'message' => 'Subject Added Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.subject.index'))->with($notification);
    }
    public function subjectEdit($id)
    {
        $subject = AdminSubject::find($id);
        return view('admin.subject.edit', compact('subject'));
    }
    public function subjectUpdate(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required',
        ]);
        $subject = AdminSubject::find($id);
        if ($request->file('sub_img')) {
            $file = $request->file('sub_img');
            @unlink(public_path('uploads/adminimages/' . $subject->sub_img));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads/adminimages'), $filename);
        }
        if ($request->file('sub_img')) {
            $subject->sub_img = $filename;
        }
        $subject->subject = $request->subject;
        $subject->save();
        $notification = array(
            'message' => 'Subject Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.subject.index'))->with($notification);
    }
    public function subjectDestroy($id)
    {
        $subject = AdminSubject::find($id);
        @unlink(public_path('uploads/adminimages/' . $subject->sub_img));
        $subject->delete();
        $notification = array(
            'message' => 'Subject Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.subject.index'))->with($notification);
    }







    //----------------------Board----------------------//

    public function boardIndex()
    {
        $boards = AdminBoard::get();
        return view('admin.board.index', compact('boards'));
    }
    public function boardCreate()
    {
        return view('admin.board.add');
    }
    public function boardStore(Request $request)
    {
        $request->validate([
            'board_name' => 'required',
        ]);
        AdminBoard::create([
            'board_name' => $request->board_name,
        ]);
        $notification = array(
            'message' => 'Board Added Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.board.index'))->with($notification);
    }
    public function boardEdit($id)
    {
        $board = AdminBoard::find($id);
        return view('admin.board.edit', compact('board'));
    }
    public function boardUpdate(Request $request, $id)
    {
        $request->validate([
            'board_name' => 'required',
        ]);
        $board = AdminBoard::find($id);
        $board->board_name = $request->board_name;
        $board->save();
        $notification = array(
            'message' => 'Board Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.board.index'))->with($notification);
    }
    public function boardDestroy($id)
    {
        $board = AdminBoard::find($id);
        $board->delete();
        $notification = array(
            'message' => 'Board Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.board.index'))->with($notification);
    }






    //----------------------Area----------------------//

    public function areaIndex()
    {
        $areas = AdminArea::get();
        return view('admin.area.index', compact('areas'));
    }
    public function areaCreate()
    {
        return view('admin.area.add');
    }
    public function areaStore(Request $request)
    {
        $request->validate([
            'area' => 'required',
        ]);
        AdminArea::create([
            'area' => $request->area,
        ]);
        $notification = array(
            'message' => 'Area Added Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.area.index'))->with($notification);
    }
    public function areaEdit($id)
    {
        $area = AdminArea::find($id);
        return view('admin.area.edit', compact('area'));
    }
    public function areaUpdate(Request $request, $id)
    {
        $request->validate([
            'area' => 'required',
        ]);
        $area = AdminArea::find($id);
        $area->area = $request->area;
        $area->save();
        $notification = array(
            'message' => 'Area Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.area.index'))->with($notification);
    }
    public function areaDestroy($id)
    {
        $area = AdminArea::find($id);
        $area->delete();
        $notification = array(
            'message' => 'Area Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.area.index'))->with($notification);
    }







    //----------------------Area----------------------//

    public function blogIndex()
    {
        $blogs = Blog::orderBy('id', 'desc')->get();
        return view('admin.blog.index', compact('blogs'));
    }
    public function blogCreate()
    {
        return view('admin.blog.add');
    }
    public function blogStore(Request $request)
    {
        $request->validate([
            'blog_img' => 'required|mimes:jpg,jpeg,png|max:5000',
            'img_title' => 'required',
            'blog_title' => 'required',
            'blog_para' => 'required',
        ], [
            'blog_img.required' => 'Please choose an image!',
            'blog_img.mimes' => 'Please choose valid image format (jpg, jpeg, png)!',
            'img_title.required' => 'Please enter image title!',
            'blog_title.required' => 'Please enter blog title!',
            'blog_para.required' => 'Please enter blog paragraph!',
        ]);
        if ($request->file('blog_img')) {
            $file = $request->file('blog_img');
            // @unlink(public_path('uploads/profileimages/' . $profileData->sub_img));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads/blogimages'), $filename);
        }
        Blog::create([
            'blog_img' => $filename,
            'img_title' => $request->img_title,
            'blog_title' => $request->blog_title,
            'blog_para' => $request->blog_para,
        ]);
        $notification = array(
            'message' => 'Blog Created Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.blog.index'))->with($notification);
    }
    public function blogEdit($id)
    {
        $blog = Blog::find($id);
        return view('admin.blog.edit', compact('blog'));
    }
    public function blogUpdate(Request $request, $id)
    {
        $request->validate([
            'blog_img' => 'mimes:jpg,jpeg,png|max:5000',
            'img_title' => 'required',
            'blog_title' => 'required',
            'blog_para' => 'required',
        ], [
            'blog_img.required' => 'Please choose an image!',
            'blog_img.mimes' => 'Please choose valid image format (jpg, jpeg, png)!',
            'img_title.required' => 'Please enter image title!',
            'blog_title.required' => 'Please enter blog title!',
            'blog_para.required' => 'Please enter blog paragraph!',
        ]);
        $blog = Blog::find($id);
        if ($request->file('blog_img')) {
            $file = $request->file('blog_img');
            @unlink(public_path('uploads/blogimages/' . $blog->blog_img));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads/blogimages'), $filename);
        }
        if ($request->file('blog_img')) {
            $blog->blog_img = $filename;
        }
        $blog->img_title = $request->img_title;
        $blog->blog_title = $request->blog_title;
        $blog->blog_para = $request->blog_para;
        $blog->save();
        $notification = array(
            'message' => 'Blog Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.blog.index'))->with($notification);
    }
    public function blogDestroy($id)
    {
        $blog = Blog::find($id);
        @unlink(public_path('uploads/blogimages/' . $blog->blog_img));
        $blog->delete();
        $notification = array(
            'message' => 'Blog Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('admin.blog.index'))->with($notification);
    }









    //----------------------Sponsor Teacher----------------------//

    public function addSponsorTeacher()
    {
        $allTeachers = TeacherProfile::join('users', 'teacher_profile.role_id', '=', 'users.id')
            ->join('teacher_videos', 'teacher_profile.role_id', '=', 'teacher_videos.role_id')
            ->where('teacher_profile.sponsor', '=', 'no')
            ->where('teacher_profile.approval', '=', 'active')
            ->where('teacher_profile.status', '=', 'active')
            ->select('users.photo', 'teacher_profile.*')
            ->get();
        return view('admin.sponsorteacher.add', compact('allTeachers'));
    }
    public function sponsorTeacher()
    {
        $allTeachers = TeacherProfile::join('users', 'teacher_profile.role_id', '=', 'users.id')
            ->where('teacher_profile.sponsor', '=', 'yes')
            ->where('teacher_profile.approval', '=', 'active')
            ->where('teacher_profile.status', '=', 'active')
            ->select('users.photo', 'teacher_profile.*')
            ->get();
        return view('admin.sponsorteacher.index', compact('allTeachers'));
    }
    public function storeSponsorTeacher($id)
    {
        $teacher = TeacherProfile::find($id);
        if ($teacher->sponsor == 'no') {
            $teacher->sponsor = 'yes';
            $notification = [
                'alert-type' => 'success',
                'message' => 'Teacher added to Sponsor'
            ];
        } else {
            $teacher->sponsor = 'no';
            $notification = [
                'alert-type' => 'success',
                'message' => 'Teacher removed from Sponsor'
            ];
        }
        $teacher->save();

        return redirect()->back()->with($notification);
    }








    //----------------------Area----------------------//

    public function stdPayment()
    {
        $screenshots = PayScreenshot::join('users', 'pay_screenshots.role_id', '=', 'users.id')
            ->Where('users.role', '=', 'student')
            ->select('users.name', 'users.email', 'users.photo', 'pay_screenshots.screenshot', 'pay_screenshots.status', 'pay_screenshots.id', 'pay_screenshots.plan_id')
            ->get();
        return view('admin.screenshot.student', compact('screenshots'));
    }
    public function teachPayment()
    {
        $screenshots = TeacherPay::join('teacher_bookings', 'teacher_pay.booking_id', '=', 'teacher_bookings.id')
            ->select('teacher_pay.screenshot', 'teacher_bookings.*')
            ->get();
        return view('admin.screenshot.teacher', compact('screenshots'));
    }
    public function teacherPaymentApprove($id)
    {
        $booking = TeacherBooking::find($id);
        if ($booking->pay_approval == 0) {
            $booking->pay_approval = '1';
        }
        $booking->save();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Payment approved successfully'
        ];
        return redirect()->back()->with($notification);
    }
    public function paymentApprove($id)
    {
        $screenshot = PayScreenshot::find($id);
        if ($screenshot->status == 2) {
            $screenshot->status = '1';
        }
        $screenshot->save();
        $pricing = StdPricing::find($screenshot->plan_id);
        $student = User::find($screenshot->role_id);
        $student->package = $pricing->name;
        $student->count = '0';
        $student->save();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Payment approved successfully'
        ];
        return redirect()->back()->with($notification);
    }
    // public function paymentReject($id)
    // {
    //     $screenshot = PayScreenshot::find($id);
    //     if ($screenshot->status == 2) {
    //         $screenshot->status = '0';
    //     }
    //     $screenshot->save();
    //     $notification = [
    //         'alert-type' => 'success',
    //         'message' => 'Payment rejected successfully'
    //     ];
    //     return redirect()->back()->with($notification);
    // }








    //********************FRONTEND**********************//

    //-------------------Logo--------------------//

    public function logo()
    {
        $logo = Logo::first();
        return view('admin.logo.index', compact('logo'));
    }
    public function logoCreate()
    {
        return view('admin.logo.add');
    }
    public function logoStore(Request $req)
    {
        $req->validate([
            'logo' => 'required|mimes:jpg.jpeg,png',
        ]);
        if ($req->file('logo')) {
            $file = $req->file('logo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('/uploads/logo'), $filename);
        }
        Logo::create([
            'logo' => $filename
        ]);
        $notification = [
            'alert-type' => 'success',
            'message' => 'Logo applied successfully',
        ];
        return redirect(route('admin.logo'))->with($notification);
    }
    public function logoEdit($id)
    {
        $logo = Logo::find($id);
        return view('admin.logo.edit', compact('logo'));
    }
    public function logoUpdate(Request $req, $id)
    {
        $req->validate([
            'logo' => 'required|mimes:jpg.jpeg,png',
        ]);
        $logo = Logo::find($id);
        if ($req->file('logo')) {
            $file = $req->file('logo');
            @unlink(public_path('/uploads/logo/' . $logo->logo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('/uploads/logo'), $filename);
        }
        $logo->logo = $filename;
        $logo->save();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Logo Updated successfully',
        ];
        return redirect(route('admin.logo'))->with($notification);
    }
    public function logoDestroy($id)
    {
        $logo = Logo::find($id);
        @unlink(public_path('/uploads/logo/' . $logo->logo));
        $logo->delete();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Logo deleted successfully',
        ];
        return redirect(route('admin.logo'))->with($notification);
    }






    //-------------------About Us--------------------//

    public function about()
    {
        $about = AboutUs::first();
        return view('admin.about.index', compact('about'));
    }
    public function aboutCreate()
    {
        return view('admin.about.add');
    }
    public function aboutStore(Request $req)
    {
        $req->validate([
            'aboutimg' => 'required|mimes:jpg,jpeg,png',
            'abouthead' => 'required',
            'aboutpara' => 'required',
        ]);
        if ($req->file('aboutimg')) {
            $file = $req->file('aboutimg');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('/uploads/adminimages'), $filename);
        }
        AboutUs::create([
            'aboutimg' => $filename,
            'abouthead' => $req->abouthead,
            'aboutpara' => $req->aboutpara,
        ]);
        $notification = [
            'alert-type' => 'success',
            'message' => 'AboutUs Added successfully',
        ];
        return redirect(route('admin.about'))->with($notification);
    }
    public function aboutEdit($id)
    {
        $about = AboutUs::find($id);
        return view('admin.about.edit', compact('about'));
    }
    public function aboutUpdate(Request $req, $id)
    {
        $req->validate([
            'aboutimg' => 'mimes:jpg,jpeg,png',
            'abouthead' => 'required',
            'aboutpara' => 'required',
        ]);
        $about = AboutUs::find($id);
        if ($req->file('aboutimg')) {
            $file = $req->file('aboutimg');
            @unlink(public_path('/uploads/adminimages/' . $about->aboutimg));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('/uploads/adminimages'), $filename);
        }
        if ($req->file('aboutimg')) {
            $about->aboutimg = $filename;
        }
        $about->abouthead = $req->abouthead;
        $about->aboutpara = $req->aboutpara;
        $about->save();
        $notification = [
            'alert-type' => 'success',
            'message' => 'AboutUs Updated successfully',
        ];
        return redirect(route('admin.about'))->with($notification);
    }
    public function aboutDestroy($id)
    {
        $about = AboutUs::find($id);
        @unlink(public_path('/uploads/adminimages/' . $about->aboutimg));
        $about->delete();
        $notification = [
            'alert-type' => 'success',
            'message' => 'AboutUs Deleted successfully',
        ];
        return redirect(route('admin.about'))->with($notification);
    }







    //-------------------About Us--------------------//

    public function contactus()
    {
        $contactus = Contactus::orderBy('id', 'desc')->get();
        return view('admin.contactus.index', compact('contactus'));
    }






    //-------------------Service--------------------//

    public function service()
    {
        $service = Service::first();
        return view('admin.service.index', compact('service'));
    }
    public function serviceCreate()
    {
        return view('admin.service.add');
    }
    public function serviceStore(Request $req)
    {
        $req->validate([
            'serviceimg' => 'required|mimes:jpg,jpeg,png',
            'servicehead' => 'required',
            'servicepara' => 'required',
        ]);
        if ($req->file('serviceimg')) {
            $file = $req->file('serviceimg');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('/uploads/adminimages'), $filename);
        }
        Service::create([
            'serviceimg' => $filename,
            'servicehead' => $req->servicehead,
            'servicepara' => $req->servicepara,
        ]);
        $notification = [
            'alert-type' => 'success',
            'message' => 'Service Added successfully',
        ];
        return redirect(route('admin.service'))->with($notification);
    }
    public function serviceEdit($id)
    {
        $service = Service::find($id);
        return view('admin.service.edit', compact('service'));
    }
    public function serviceUpdate(Request $req, $id)
    {
        $req->validate([
            'servicehead' => 'required',
            'servicepara' => 'required',
        ]);
        $service = Service::find($id);
        if ($req->file('serviceimg')) {
            $file = $req->file('serviceimg');
            @unlink(public_path('/uploads/adminimages/' . $service->serviceimg));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('/uploads/adminimages'), $filename);
        }
        if ($req->file('serviceimg')) {
            $service->serviceimg = $filename;
        }
        $service->servicehead = $req->servicehead;
        $service->servicepara = $req->servicepara;
        $service->save();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Service Updated successfully',
        ];
        return redirect(route('admin.service'))->with($notification);
    }
    public function serviceDestroy($id)
    {
        $service = Service::find($id);
        @unlink(public_path('/uploads/adminimages/' . $service->serviceimg));
        $service->delete();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Service Deleted successfully',
        ];
        return redirect(route('admin.service'))->with($notification);
    }





    //-------------------Footer--------------------//

    public function footer()
    {
        $footer = Footer::first();
        return view('admin.footer.index', compact('footer'));
    }
    public function footerCreate()
    {
        return view('admin.footer.add');
    }
    public function footerStore(Request $req)
    {
        $req->validate([
            'footerpara' => 'required',
            'contact' => 'required',
        ]);
        Footer::create([
            'footerpara' => $req->footerpara,
            'contact' => $req->contact,
        ]);
        $notification = [
            'alert-type' => 'success',
            'message' => 'Footer Added successfully',
        ];
        return redirect(route('admin.footer'))->with($notification);
    }
    public function footerEdit($id)
    {
        $footer = Footer::find($id);
        return view('admin.footer.edit', compact('footer'));
    }
    public function footerUpdate(Request $req, $id)
    {
        $req->validate([
            'footerpara' => 'required',
            'contact' => 'required',
        ]);
        $footer = Footer::find($id);
        $footer->contact = $req->contact;
        $footer->footerpara = $req->footerpara;
        $footer->save();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Footer Updated successfully',
        ];
        return redirect(route('admin.footer'))->with($notification);
    }
    public function footerDestroy($id)
    {
        $footer = Footer::find($id);
        $footer->delete();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Footer Deleted successfully',
        ];
        return redirect(route('admin.footer'))->with($notification);
    }






    //-------------------Social Links--------------------//

    public function sociallink()
    {
        $sociallinks = Sociallink::get();
        return view('admin.sociallink.index', compact('sociallinks'));
    }
    public function sociallinkCreate()
    {
        return view('admin.sociallink.add');
    }
    public function sociallinkStore(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'link' => 'required',
        ]);

        $real_name = "fa-brands fa-" . strtolower($req->name);
        Sociallink::create([
            'name' => $req->name,
            'real_name' => $real_name,
            'link' => $req->link,
        ]);
        $notification = [
            'alert-type' => 'success',
            'message' => 'Social Link Added successfully',
        ];
        return redirect(route('admin.sociallink'))->with($notification);
    }
    public function sociallinkEdit($id)
    {
        $sociallink = Sociallink::find($id);
        return view('admin.sociallink.edit', compact('sociallink'));
    }
    public function sociallinkUpdate(Request $req, $id)
    {
        $req->validate([
            'name' => 'required',
            'link' => 'required',
        ]);
        $real_name = "fa-brands fa-" . strtolower($req->name);
        $sociallink = Sociallink::find($id);
        $sociallink->name = $req->name;
        $sociallink->real_name = $real_name;
        $sociallink->link = $req->link;
        $sociallink->save();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Social Link Updated successfully',
        ];
        return redirect(route('admin.sociallink'))->with($notification);
    }
    public function sociallinkDestroy($id)
    {
        $sociallink = Sociallink::find($id);
        $sociallink->delete();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Social Link Deleted successfully',
        ];
        return redirect(route('admin.sociallink'))->with($notification);
    }






    //-------------------Social Links--------------------//

    public function pricing()
    {
        $pricings = StdPricing::get();
        return view('admin.pricing.index', compact('pricings'));
    }
    public function pricingCreate()
    {
        return view('admin.pricing.add');
    }
    public function pricingStore(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
        if ($req->click == '') {
            StdPricing::create([
                'name' => $req->name,
                'price' => $req->price,
                'click' => 'unlimited',
            ]);
        } else {
            StdPricing::create([
                'name' => $req->name,
                'price' => $req->price,
                'click' => $req->click,
            ]);
        }
        $notification = [
            'alert-type' => 'success',
            'message' => 'Pricing Added successfully',
        ];
        return redirect(route('admin.pricing'))->with($notification);
    }
    public function pricingEdit($id)
    {
        $pricing = StdPricing::find($id);
        return view('admin.pricing.edit', compact('pricing'));
    }
    public function pricingUpdate(Request $req, $id)
    {
        $req->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'click' => 'required|numeric',
        ]);
        $pricing = StdPricing::find($id);
        $pricing->name = $req->name;
        $pricing->price = $req->price;
        $pricing->click = $req->click;
        $pricing->save();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Pricing Updated successfully',
        ];
        return redirect(route('admin.pricing'))->with($notification);
    }
    public function pricingDestroy($id)
    {
        $pricing = StdPricing::find($id);
        $pricing->delete();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Pricing Deleted successfully',
        ];
        return redirect(route('admin.pricing'))->with($notification);
    }
}