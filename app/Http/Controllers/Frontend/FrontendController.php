<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\Contactus;
use App\Models\NewsLetter;
use Auth;
use App\Models\User;
use App\Models\AboutUs;
use App\Models\Subjects;
use App\Models\AdminArea;
use App\Models\AdminBoard;
use App\Models\AdminGrade;
use App\Models\StdPricing;
use App\Models\TeacherFee;
use App\Models\TeacherArea;
use App\Models\AdminSubject;
use App\Models\TeacherBoard;
use App\Models\TeacherGrade;
use App\Models\TeacherShift;
use App\Models\TeacherVideo;
use Illuminate\Http\Request;
use App\Models\PayScreenshot;
use App\Models\TeacherBooking;
use App\Models\TeacherProfile;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function teacherDetails($id)
    {
        if (!Auth::check()) {
            return redirect()->back()->with(['isloggedin' => '1']);
        }
        $student = User::find(Auth::user()->id);
        $admin_pricing = StdPricing::where('name', $student->package)->first();

        if (($admin_pricing && $student->count <= $admin_pricing->click) || $student->count <= 8) {
            $student->increment('count');
        }
        $teacherData = TeacherProfile::join('teacher_videos', 'teacher_profile.role_id', '=', 'teacher_videos.role_id')
            ->where('teacher_profile.role_id', '=', $id)
            ->where('teacher_videos.role_id', '=', $id)
            ->where('teacher_videos.approval', '=', '1')
            ->first();
        $user = User::find($teacherData->role_id);
        $teacherSubjects = Subjects::where('role_id', $teacherData->role_id)->get();
        $teacherGrades = TeacherGrade::where('role_id', $teacherData->role_id)->get();
        $teacherBoards = TeacherBoard::where('role_id', $teacherData->role_id)->get();
        $teacherShifts = TeacherShift::where('role_id', $teacherData->role_id)->get();
        $teacherAreas = TeacherArea::where('role_id', $teacherData->role_id)->get();
        $teacherFee = TeacherFee::where('role_id', $teacherData->role_id)->first();
        $teachers = TeacherProfile::join('teacher_videos', 'teacher_profile.role_id', '=', 'teacher_videos.role_id')
            ->where('teacher_profile.approval', '=', 'active')
            ->where('teacher_profile.status', '=', 'active')
            ->where('teacher_videos.approval', '=', '1')
            ->select('teacher_profile.*')
            ->get();
        $subjects = AdminSubject::get();
        // return $teacherData;
        return view('frontend.teacher_detail', compact('teacherData', 'teacherShifts', 'admin_pricing', 'teacherAreas', 'student', 'teacherFee', 'teacherBoards', 'teacherSubjects', 'teacherGrades', 'user', 'teachers', 'subjects'));
    }
    public function subjectDetails($id)
    {
        if (!Auth::check()) {
            return redirect()->back()->with(['isloggedin' => '1']);
        }
        $subjectname = AdminSubject::find($id);
        $allSubjects = Subjects::join('teacher_profile', 'subjects.role_id', '=', 'teacher_profile.role_id')
            ->join('teacher_videos', 'subjects.role_id', '=', 'teacher_videos.role_id')
            ->where('subjectname', $subjectname->subject)
            ->where('teacher_profile.approval', '=', 'active')
            ->where('teacher_profile.status', '=', 'active')
            ->where('teacher_videos.approval', '=', 1)
            ->select('subjects.*')
            ->get();
        $teachers = TeacherProfile::join('teacher_videos', 'teacher_profile.role_id', '=', 'teacher_videos.role_id')
            ->where('teacher_videos.approval', '=', '1')
            ->where('teacher_profile.status', 'active')
            ->where('teacher_profile.approval', 'active')
            ->select('teacher_profile.*')
            ->get();
        $subjects = AdminSubject::get();
        $student = User::where('id', Auth::user()->id)->first();
        $admin_pricing = StdPricing::where('name', $student->package)->first();
        return view('frontend.subject_detail', compact('teachers', 'subjects', 'subjectname', 'allSubjects', 'student', 'admin_pricing'));
    }
    public function teacherSearch(Request $req)
    {
        if (!Auth::check()) {
            return redirect()->back()->with(['isloggedin' => '1']);
        }
        // return $req;
        $req->validate([
            'search' => 'required',
            'area' => 'required',
        ], [
            'search.required' => 'Subject or Name is required',
            'area.required' => 'Please select your Area'
        ]);
        $search = $req->search;
        $selectedArea = $req->area;
        $selectedBoard = $req->board;
        $selectedClass = $req->class;
        $selectedFees = $req->fees;
        $areas = AdminArea::get();
        $boards = AdminBoard::get();
        $classes = AdminGrade::get();
        $student = User::where('id', Auth::user()->id)->first();
        $admin_pricing = StdPricing::where('name', $student->package)->first();
        $results = TeacherArea::join('subjects', 'teacher_areas.role_id', '=', 'subjects.role_id')
            ->join('teacher_profile', 'teacher_areas.role_id', '=', 'teacher_profile.role_id')
            ->join('teacher_videos', 'teacher_areas.role_id', '=', 'teacher_videos.role_id')
            ->join('teacher_boards', 'teacher_areas.role_id', '=', 'teacher_boards.role_id')
            ->join('teacher_classes', 'teacher_areas.role_id', '=', 'teacher_classes.role_id')
            ->join('teacher_fees', 'teacher_areas.role_id', '=', 'teacher_fees.role_id')
            ->where('teacher_areas.area', 'LIKE', "%" . $req->area . "%")
            ->where('teacher_videos.approval', '=', '1')
            ->where('teacher_profile.approval', '=', 'active')
            ->where('teacher_profile.status', '=', 'active')
            ->where(function ($query) use ($req) {
                $query->where('subjects.subjectname', 'LIKE', "%" . $req->search . "%")
                    ->orWhere('teacher_profile.fullname', 'LIKE', "%" . $req->search . "%");
            })
            ->when($req->class, function ($query) use ($req) {
                $query->where('teacher_classes.class', $req->class);
            })
            ->when($req->board, function ($query) use ($req) {
                $query->where('teacher_boards.board_name', $req->board);
            })
            ->when($req->fees, function ($query) use ($req) {
                $query->whereRaw('CAST(teacher_fees.fee AS UNSIGNED) <= ?', [$req->fees]);
            })
            ->select('teacher_areas.role_id')
            ->distinct()
            ->get();
        // return $results;
        $searchBoards = TeacherBoard::where('board_name', 'LIKE', '%' . $req->search . '%')->get();
        $searchClass = TeacherGrade::where('class', 'LIKE', '%' . $req->search . '%')->select('role_id')->distinct()->get();
        $subjects = AdminSubject::get();
        $teachers = TeacherProfile::join('teacher_videos', 'teacher_profile.role_id', '=', 'teacher_videos.role_id')
            ->where('teacher_videos.approval', '=', '1')
            ->where('teacher_profile.approval', '=', 'active')
            ->where('teacher_profile.status', '=', 'active')
            ->select('teacher_profile.*')
            ->get();
        if ($results->count() > 0) {
            return view('frontend.search', compact('search', 'classes', 'admin_pricing', 'student', 'selectedFees', 'selectedClass', 'selectedBoard', 'selectedArea', 'results', 'boards', 'areas', 'subjects', 'teachers'));
        } else {
            return view('frontend.search', compact('search', 'classes', 'admin_pricing', 'student', 'selectedFees', 'selectedClass', 'selectedBoard', 'selectedArea', 'results', 'boards', 'areas', 'subjects', 'teachers'));
        }
    }

    public function aboutus()
    {
        $about = AboutUs::first();
        return view('frontend.about', compact('about'));
    }
    public function contactus()
    {
        return view('frontend.contact');
    }
    public function contactusMessage(Request $req)
    {
        $req->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'subject' => 'required|max:200',
            'message' => 'required|max:500',
        ]);
        Contactus::create([
            'fname' => $req->fname,
            'lname' => $req->lname,
            'email' => $req->email,
            'subject' => $req->subject,
            'message' => $req->message,
        ]);
        $notification = [
            'alert-type' => 'success',
            'message' => 'Message sent successfully',
        ];
        return redirect()->back()->with($notification);
    }
    public function newsletterSubscribe(Request $req)
    {
        $req->validate([
            'newsletterEmail' => 'required|email',
        ], [
            'newsletterEmail.required' => 'Please enter your email!',
            'newsletterEmail.email' => 'Please enter a valid email!'
        ]);
        NewsLetter::create([
            'email' => $req->newsletterEmail
        ]);
        $notification = [
            'alert-type' => 'success',
            'message' => 'News Letter Subscribed successfully',
        ];
        return redirect(route('home'))->with($notification);
    }

    public function blogSingle($id)
    {
        $blog = Blog::find($id);
        $blogs = Blog::orderBy('id','desc')->get();
        return view('frontend.blog_single',compact('blogs','blog'));
    }


    public function teacherbooking(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'school' => 'required',
            'area' => 'required',
            'class' => 'required',
            'shift' => 'required',
        ]);
        $user = Auth::user();
        TeacherBooking::create([
            'teacher_id' => $req->teacher_id,
            'student_id' => $user->id,
            'std_name' => $req->name,
            'std_email' => $req->email,
            'std_dob' => $req->dob,
            'std_school' => $req->school,
            'std_area' => $req->area,
            'std_phone' => $req->phone,
            'std_address' => $req->address,
            'std_class' => $req->class,
            'std_shift' => $req->shift,
            'std_subject' => json_encode($req->subject),
        ]);
        return redirect(route('student.dashboard'));
    }

    public function pkgPayment($id)
    {
        $pricing = StdPricing::find($id);
        return view('frontend.payment', compact('pricing'));
    }
    public function pkgPaymentDone(Request $req)
    {
        $req->validate([
            'screenshot' => 'required|mimes:jpeg,jpg,png|max:2048'
        ], [
            'screenshot.required' => 'Please Upload screenshot!'
        ]);
        $student = Auth::user();
        if ($req->file('screenshot')) {
            $file = $req->file('screenshot');
            // @unlink(public_path('uploads/teacher_videos/' . $profileData->video));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('payment/screenshot'), $filename);
        }
        PayScreenshot::create([
            'screenshot' => $filename,
            'plan_id' => $req->plan_id,
            'role_id' => $student->id
        ]);
        $notification = [
            'alert-type' => 'success',
            'message' => 'Screenshot sent.'
        ];
        return redirect(route('home'))->with($notification);
    }
}