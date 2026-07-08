<?php

namespace App\Http\Controllers\Teacher;

use Auth;
use App\Models\Ticket;
use App\Models\Subjects;
use App\Models\AdminArea;
use App\Models\AdminBoard;
use App\Models\AdminGrade;
use App\Models\TeacherFee;
use App\Models\TeacherArea;
use App\Models\AdminSubject;
use App\Models\ContactAdmin;
use App\Models\TeacherBoard;
use App\Models\TeacherGrade;
use App\Models\TeacherShift;
use App\Models\TeacherVideo;
use Illuminate\Http\Request;
use App\Models\TeacherBooking;
use App\Models\TeacherProfile;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();
        $profile = TeacherProfile::where('role_id', $teacher->id)->first();

        if ($profile && $profile->approval == 'deactive') {
            return view('teacher.index', compact('profile'));
        }
        $bookings = TeacherBooking::where('teacher_id', $teacher->id)->orderBy('id', 'desc')->get();
        $totalStudents = TeacherBooking::join('users', 'teacher_bookings.student_id', '=', 'users.id')
            ->where('teacher_bookings.teacher_id', $teacher->id)
            ->select('users.name')
            ->distinct()
            ->get();
        return view('teacher.index', compact('bookings', 'profile','totalStudents'));
    }







    //----------------------Profile----------------------//
    public function profileIndex()
    {
        $user = Auth::user();
        $teacherProfile = TeacherProfile::where('role_id', $user->id)->first();
        return view('teacher.profile.index', compact('teacherProfile', 'user'));
    }
    public function profileCreate()
    {
        return view('teacher.profile.add');
    }
    public function profileStore(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'fname' => 'required',
            'phone_no' => 'required',
            'cnic' => 'required',
            'qualification' => 'required',
            'address' => 'required',
            'experience' => 'required',
        ]);
        $user = Auth::user();
        TeacherProfile::create([
            'role_id' => $user->id,
            'fullname' => $request->fullname,
            'fname' => $request->fname,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'cnic' => $request->cnic,
            'qualification' => $request->qualification,
            'address' => $request->address,
            'experience' => $request->experience,
        ]);
        $notification = array(
            'message' => 'Profile Created Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.profile.index'))->with($notification);
    }
    public function profileEdit($id)
    {
        $teacherProfile = TeacherProfile::find($id);
        return view('teacher.profile.edit', compact('teacherProfile'));
    }
    public function profileUpdate(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required',
            'fname' => 'required',
            'phone_no' => 'required',
            'cnic' => 'required',
            'qualification' => 'required',
            'address' => 'required',
            'experience' => 'required',
        ]);
        $teacherProfile = TeacherProfile::find($id);
        $teacherProfile->fullname = $request->fullname;
        $teacherProfile->fname = $request->fname;
        $teacherProfile->email = $request->email;
        $teacherProfile->phone_no = $request->phone_no;
        $teacherProfile->cnic = $request->cnic;
        $teacherProfile->qualification = $request->qualification;
        $teacherProfile->address = $request->address;
        $teacherProfile->experience = $request->experience;
        $teacherProfile->save();
        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.profile.index'))->with($notification);
    }
    public function profileDestroy($id)
    {
        $teacherProfile = TeacherProfile::find($id);
        $teacherProfile->delete();
        $notification = array(
            'message' => 'Profile Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.profile.index'))->with($notification);
    }







    //----------------------Subject----------------------//

    public function subjectIndex()
    {
        $user = Auth::user();
        $subjects = Subjects::where('role_id', $user->id)->get();
        return view('teacher.subject.index', compact('user', 'subjects'));
    }
    public function subjectCreate()
    {
        $subjects = AdminSubject::get();
        return view('teacher.subject.add', compact('subjects'));
    }
    public function subjectStore(Request $request)
    {
        $request->validate([
            'subjectname' => 'required',
        ]);
        $user = Auth::user();
        Subjects::create([
            'role_id' => $user->id,
            'subjectname' => $request->subjectname,
        ]);
        $notification = array(
            'message' => 'Subject Added Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.subject.index'))->with($notification);
    }
    public function subjectEdit($id)
    {
        $allsubjects = AdminSubject::get();
        $subject = Subjects::find($id);
        return view('teacher.subject.edit', compact('subject', 'allsubjects'));
    }
    public function subjectUpdate(Request $request, $id)
    {
        $request->validate([
            'subjectname' => 'required',
        ]);
        $subject = Subjects::find($id);
        $subject->subjectname = $request->subjectname;
        $subject->save();
        $notification = array(
            'message' => 'Subject Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.subject.index'))->with($notification);
    }
    public function subjectDestroy($id)
    {
        $subject = Subjects::find($id);
        $subject->delete();
        $notification = array(
            'message' => 'Subject Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.subject.index'))->with($notification);
    }







    //----------------------Grade----------------------//

    public function gradeIndex()
    {
        $user = Auth::user();
        $grades = TeacherGrade::where('role_id', $user->id)->get();
        return view('teacher.grade.index', compact('user', 'grades'));
    }
    public function gradeCreate()
    {
        $grades = AdminGrade::get();
        return view('teacher.grade.add', compact('grades'));
    }
    public function gradeStore(Request $request)
    {
        $request->validate([
            'grade' => 'required',
        ]);
        $user = Auth::user();
        TeacherGrade::create([
            'role_id' => $user->id,
            'class' => $request->grade,
        ]);
        $notification = array(
            'message' => 'Grade Added Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.grade.index'))->with($notification);
    }
    public function gradeEdit($id)
    {
        $selectedgrade = TeacherGrade::find($id);
        $grades = AdminGrade::get();
        return view('teacher.grade.edit', compact('selectedgrade', 'grades'));
    }
    public function gradeUpdate(Request $request, $id)
    {
        $request->validate([
            'grade' => 'required',
        ]);
        $grade = TeacherGrade::find($id);
        $grade->class = $request->grade;
        $grade->save();
        $notification = array(
            'message' => 'Grade Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.grade.index'))->with($notification);
    }
    public function gradeDestroy($id)
    {
        $grade = TeacherGrade::find($id);
        $grade->delete();
        $notification = array(
            'message' => 'Grade Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.grade.index'))->with($notification);
    }








    //----------------------Board----------------------//

    public function boardIndex()
    {
        $user = Auth::user();
        $boards = TeacherBoard::where('role_id', $user->id)->get();
        return view('teacher.board.index', compact('user', 'boards'));
    }
    public function boardCreate()
    {
        $boards = AdminBoard::get();
        return view('teacher.board.add', compact('boards'));
    }
    public function boardStore(Request $request)
    {
        $request->validate([
            'board_name' => 'required',
        ]);
        $user = Auth::user();
        TeacherBoard::create([
            'role_id' => $user->id,
            'board_name' => $request->board_name,
        ]);
        $notification = array(
            'message' => 'Board Added Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.board.index'))->with($notification);
    }
    public function boardEdit($id)
    {
        $selectedboard = TeacherBoard::find($id);
        $boards = AdminBoard::get();
        return view('teacher.board.edit', compact('selectedboard', 'boards'));
    }
    public function boardUpdate(Request $request, $id)
    {
        $request->validate([
            'board_name' => 'required',
        ]);
        $board = TeacherBoard::find($id);
        $board->board_name = $request->board_name;
        $board->save();
        $notification = array(
            'message' => 'Board Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.board.index'))->with($notification);
    }
    public function boardDestroy($id)
    {
        $board = TeacherBoard::find($id);
        $board->delete();
        $notification = array(
            'message' => 'Board Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.board.index'))->with($notification);
    }








    //----------------------Shift----------------------//

    public function shiftIndex()
    {
        $user = Auth::user();
        $shifts = TeacherShift::where('role_id', $user->id)->get();
        return view('teacher.shift.index', compact('user', 'shifts'));
    }
    public function shiftCreate()
    {
        return view('teacher.shift.add');
    }
    public function shiftStore(Request $request)
    {
        $request->validate([
            'shift_name' => 'required',
        ]);
        $user = Auth::user();
        TeacherShift::create([
            'role_id' => $user->id,
            'shift_name' => $request->shift_name,
        ]);
        $notification = array(
            'message' => 'Shift Added Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.shift.index'))->with($notification);
    }
    public function shiftEdit($id)
    {
        $shift = TeacherShift::find($id);
        return view('teacher.shift.edit', compact('shift'));
    }
    public function shiftUpdate(Request $request, $id)
    {
        $request->validate([
            'shift_name' => 'required',
        ]);
        $shift = TeacherShift::find($id);
        $shift->shift_name = $request->shift_name;
        $shift->save();
        $notification = array(
            'message' => 'Shift Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.shift.index'))->with($notification);
    }
    public function shiftDestroy($id)
    {
        $shift = TeacherShift::find($id);
        $shift->delete();
        $notification = array(
            'message' => 'Shift Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.shift.index'))->with($notification);
    }
    public function shiftStatus($id)
    {
        $shift = TeacherShift::find($id);
        if ($shift->status == '0') {
            $shift->status = '1';
        } else {
            $shift->status = '0';
        }
        $shift->save();
        $notification = array(
            'message' => 'Status Changed Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.shift.index'))->with($notification);
    }
    public function approval($id)
    {
        $approval = TeacherBooking::find($id);
        if ($approval->approval == '2') {
            $approval->approval = '1';
        }
        $approval->save();
        $notification = array(
            'message' => 'Request Approved Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.dashboard'))->with($notification);
    }
    public function reject($id)
    {
        $approval = TeacherBooking::find($id);
        if ($approval->approval == '2') {
            $approval->approval = '0';
        }
        $approval->save();
        $notification = array(
            'message' => 'Request Rejected Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.dashboard'))->with($notification);
    }








    //----------------------Area----------------------//

    public function areaIndex()
    {
        $user = Auth::user();
        $areas = TeacherArea::where('role_id', $user->id)->get();
        return view('teacher.area.index', compact('user', 'areas'));
    }
    public function areaCreate()
    {
        $areas = AdminArea::get();
        return view('teacher.area.add', compact('areas'));
    }
    public function areaStore(Request $request)
    {
        $request->validate([
            'area' => 'required',
        ]);
        $user = Auth::user();
        TeacherArea::create([
            'role_id' => $user->id,
            'area' => $request->area,
        ]);
        $notification = array(
            'message' => 'Area Added Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.area.index'))->with($notification);
    }
    public function areaEdit($id)
    {
        $selectedarea = TeacherArea::find($id);
        $areas = AdminArea::get();
        return view('teacher.area.edit', compact('selectedarea', 'areas'));
    }
    public function areaUpdate(Request $request, $id)
    {
        $request->validate([
            'area' => 'required',
        ]);
        $area = TeacherArea::find($id);
        $area->area = $request->area;
        $area->save();
        $notification = array(
            'message' => 'Area Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.area.index'))->with($notification);
    }
    public function areaDestroy($id)
    {
        $area = TeacherArea::find($id);
        $area->delete();
        $notification = array(
            'message' => 'Area Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.area.index'))->with($notification);
    }








    //----------------------Fees----------------------//

    public function feesIndex()
    {
        $user = Auth::user();
        $fee = TeacherFee::where('role_id', $user->id)->first();
        return view('teacher.fees.index', compact('user', 'fee'));
    }
    public function feesCreate()
    {
        return view('teacher.fees.add');
    }
    public function feesStore(Request $request)
    {
        $request->validate([
            'fee' => 'required|numeric|min:5000|max:50000',
        ], [
            'fee.min' => 'Fees must be at least 5000',
            'fee.max' => 'Fees must be under 50000',
        ]);
        $user = Auth::user();
        TeacherFee::create([
            'role_id' => $user->id,
            'fee' => $request->fee,
        ]);
        $notification = array(
            'message' => 'Fees Added Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.fees.index'))->with($notification);
    }
    public function feesEdit($id)
    {
        $fee = TeacherFee::find($id);
        return view('teacher.fees.edit', compact('fee'));
    }
    public function feesUpdate(Request $request, $id)
    {
        $request->validate([
            'fee' => 'required|numeric|min:5000|max:50000',
        ], [
            'fee.min' => 'Fees must be at least 5000',
            'fee.max' => 'Fees must be under 50000',
        ]);
        $fee = TeacherFee::find($id);
        $fee->fee = $request->fee;
        $fee->save();
        $notification = array(
            'message' => 'Fees Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.fees.index'))->with($notification);
    }
    public function feesDestroy($id)
    {
        $fee = TeacherFee::find($id);
        $fee->delete();
        $notification = array(
            'message' => 'Fees Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.fees.index'))->with($notification);
    }








    //----------------------Video----------------------//

    public function videoIndex()
    {
        $user = Auth::user();
        $video = TeacherVideo::where('role_id', $user->id)->first();
        return view('teacher.video.index', compact('user', 'video'));
    }
    public function videoCreate()
    {
        return view('teacher.video.add');
    }
    public function videoStore(Request $request)
    {
        $request->validate([
            'video' => 'required',
        ]);
        $user = Auth::user();
        if ($request->file('video')) {
            $file = $request->file('video');
            // @unlink(public_path('uploads/teacher_videos/' . $profileData->video));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads/teacher_videos'), $filename);
        }
        TeacherVideo::create([
            'role_id' => $user->id,
            'video' => $filename,
        ]);
        $notification = array(
            'message' => 'Video Added Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.video.index'))->with($notification);
    }
    public function videoEdit($id)
    {
        $video = TeacherVideo::find($id);
        return view('teacher.video.edit', compact('video'));
    }
    public function videoUpdate(Request $request, $id)
    {
        $request->validate([
            'video' => 'required',
        ]);
        $video = TeacherVideo::find($id);
        if ($request->file('video')) {
            $file = $request->file('video');
            @unlink(public_path('/uploads/teacher_videos/' . $video->video));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads/teacher_videos'), $filename);
        }
        if ($request->file('video')) {
            $video->video = $filename;
            $video->approval = 2;
        }
        $video->save();
        $notification = array(
            'message' => 'Video Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.video.index'))->with($notification);
    }
    public function videoDestroy($id)
    {
        $video = TeacherVideo::find($id);
        @unlink(public_path('/uploads/teacher_videos/' . $video->video));
        $video->delete();
        $notification = array(
            'message' => 'Video Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect(route('teacher.video.index'))->with($notification);
    }








    //----------------------Session----------------------//
    public function allMails()
    {
        $mails = ContactAdmin::where('from_name', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('teacher.mail.index', compact('mails'));
    }
    public function newMail()
    {
        return view('teacher.mail.add');
    }
    public function storeMail(Request $req)
    {
        $req->validate([
            'subject' => 'required|max:100',
            'message' => 'required'
        ], [
            'subject.required' => 'Subject is required.',
            'message.required' => 'Message is required.',
            'subject.max' => 'Subject Cannot be greater than 100 characters',
        ]);
        $user = Auth::user();
        ContactAdmin::create([
            'from_name' => $user->id,
            'subject' => $req->subject,
            'message' => $req->message
        ]);
        $notification = [
            'alert-type' => 'success',
            'message' => 'Mail sent successfully'
        ];
        return redirect(route('teacher.mail'))->with($notification);
    }





    

    //----------------------Tickets----------------------//
    public function ticket()
    {
        $tickets = Ticket::where('teacher_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('teacher.ticket.index',compact('tickets'));
    }
    public function ticketAdd()
    {
        return view('teacher.ticket.add');
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
            'teacher_id' => Auth::user()->id,
            'subject' => $req->subject,
            'concern' => $req->concern,
            'message' => $req->message,
            'priority' => $req->priority,
        ]);
        $notification = [
            'alert-type' => 'success',
            'message' => 'Ticket has been sent successfully',
        ];
        return redirect(route('teacher.ticket'))->with($notification);
    }







    
    //----------------------Session----------------------//
    public function endSession($id)
    {
        $hiring = TeacherBooking::find($id);
        $hiring->session = '0';
        $hiring->save();
        $notification = [
            'alert-type' => 'success',
            'message' => 'Session has been ended successfully'
        ];
        return redirect(route('teacher.dashboard'))->with($notification);
    }
}