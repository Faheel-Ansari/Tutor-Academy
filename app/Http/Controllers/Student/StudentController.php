<?php

namespace App\Http\Controllers\Student;

use App\Models\ReportAbuse;
use App\Models\TeacherFee;
use App\Models\TeacherPay;
use App\Models\TeacherProfile;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TeacherBooking;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $student = Auth::user();
        if ($student->status == '0') {
            Auth::guard('web')->logout();

            session()->invalidate();

            session()->regenerateToken();

            return redirect('/login')->with('status', 'suspend');
        }
        $bookings = TeacherBooking::where('student_id', $student->id)->orderBy('id', 'desc')->get();
        return view('student.index', compact('bookings'));
    }
    public function teacherPaymentPage($id)
    {
        $pageid = TeacherBooking::find($id);
        $teacher = TeacherProfile::where('role_id', $pageid->teacher_id)->first();
        $teacherFee = TeacherFee::where('role_id', $pageid->teacher_id)->first();
        return view('student.payment', compact('pageid', 'teacher', 'teacherFee'));
    }
    public function teacherPaymentDone(Request $req)
    {
        $req->validate([
            'booking_id' => 'required',
            'screenshot' => 'required|mimes:jpg,png,jpeg',
        ]);
        if ($req->file('screenshot')) {
            $file = $req->file('screenshot');
            // @unlink(public_path('uploads/teacher_videos/' . $profileData->video));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('payment/screenshot'), $filename);
        }
        $booking = TeacherBooking::find($req->booking_id);
        if ($booking->paid == 0) {
            $booking->paid = '1';
        }
        $booking->save();
         
        TeacherPay::create([
            'booking_id' => $req->booking_id,
            'screenshot' => $filename
        ]);
        $notification = [
            'alert-type' => 'success',
            'message' => 'Screenshot sent'
        ];
        return redirect(route('student.dashboard'))->with($notification);
    }
    public function reportTeacher()
    {
        $reportTeachers = TeacherBooking::join('users', 'teacher_bookings.teacher_id', '=', 'users.id')
            ->join('teacher_profile', 'teacher_bookings.teacher_id', '=', 'teacher_profile.role_id')
            ->where('teacher_bookings.student_id', Auth::user()->id)
            ->select('users.id', 'users.photo', 'teacher_profile.*')
            ->distinct()
            ->get();
        // return $reportTeachers;
        return view('student.report_teacher.index', compact('reportTeachers'));
    }
    public function reportAbuse(Request $req)
    {
        $req->validate([
            'message' => 'required',
            'teacher_id' => 'required',
            'student_id' => 'required'
        ], [
            'message.required' => 'Please write some valid reason!'
        ]);
        ReportAbuse::create([
            'message' => $req->message,
            'teacher_id' => $req->teacher_id,
            'student_id' => $req->student_id,
            'std_phone' => $req->std_phone,
            'status' => '1'
        ]);
        $notification = [
            'alert-type' => 'success',
            'message' => 'Report sent successfully.',
        ];
        return redirect(route('student.report.teacher'))->with($notification);
    }
    public function ticket()
    {
        $tickets = Ticket::where('student_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('student.ticket.index', compact('tickets'));
    }
    public function ticketAdd()
    {
        return view('student.ticket.add');
    }
    public function ticketStore(Request $req)
    {
        $req->validate([
            'subject' => 'required|max:100',
            'concern' => 'required',
            'message' => 'required|max:500',
            'priority' => 'required',
        ]);
        Ticket::create([
            'student_id' => Auth::user()->id,
            'subject' => $req->subject,
            'concern' => $req->concern,
            'message' => $req->message,
            'priority' => $req->priority,
        ]);
        $notification = [
            'alert-type' => 'success',
            'message' => 'Ticket has been sent successfully',
        ];
        return redirect(route('student.ticket'))->with($notification);
    }
}
