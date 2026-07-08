<?php

use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\Logo;
use App\Models\PayScreenshot;
use App\Models\Service;
use App\Models\Sociallink;
use App\Models\StdPricing;
use App\Models\Subjects;
use App\Models\AdminArea;
use App\Models\AdminSubject;
use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/cleareverything', function () {
    $clearcache = Artisan::call('cache:clear');
    echo "Cache cleared<br>";

    $clearview = Artisan::call('view:clear');
    echo "View cleared<br>";

    $clearconfig = Artisan::call('config:cache');
    echo "Config cleared<br>";

});
require __DIR__ . '/auth.php';
// Auth::routes([
//     "verify" => true
// ]);

// -------------Frontend-------------//
Route::get('/', function () {

    $user = Auth::user();
    $not_avail = false;
    if ($user && $user->role == 'student') {
        if ($user->email_verified_at == null) {
            return redirect('/verify-email');
        }
        $student = User::where('id', $user->id)->first();
        $not_avail = false;
    } else {
        $student = '';
        if ((Auth::check()) && (Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')) {
            $not_avail = true;
        }
    }
    if ($user && $user->role == 'student') {
        $package = PayScreenshot::where('role_id', $user->id)->latest()->first();
    } else {
        $package = '';
    }
    $teachers = TeacherProfile::join('teacher_videos', 'teacher_profile.role_id', '=', 'teacher_videos.role_id')
        ->where('teacher_videos.approval', '=', '1')
        ->where('teacher_profile.approval', '=', 'active')
        ->where('teacher_profile.status', '=', 'active')
        ->get();
    $sponsorTeachers = TeacherProfile::join('teacher_videos', 'teacher_profile.role_id', '=', 'teacher_videos.role_id')
        ->where('teacher_videos.approval', '=', '1')
        ->where('teacher_profile.approval', '=', 'active')
        ->where('teacher_profile.status', '=', 'active')
        ->where('teacher_profile.sponsor', '=', 'yes')
        ->get();

    $pricings = StdPricing::get();
    $subjects = AdminSubject::get();
    $about = AboutUs::first();
    $service = Service::first();
    $areas = AdminArea::get();
    $blogs = Blog::orderBy('id', 'desc')->get();
    $isloggedin = false;
    return view('frontend.index', compact('teachers', 'subjects', 'sponsorTeachers', 'isloggedin', 'areas', 'blogs', 'about', 'service', 'student', 'pricings', 'package', 'not_avail'));
})->name('home');
Route::get('blog-single/{id}', [FrontendController::class, 'blogSingle'])->name('blog.single');
Route::get('about-us', [FrontendController::class, 'aboutus'])->name('aboutus');
Route::get('contact-us', [FrontendController::class, 'contactus'])->name('contactus');
Route::post('contact-us/message', [FrontendController::class, 'contactusMessage'])->name('contactus.message');
Route::post('newsletter/subscribe', [FrontendController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');
Route::get('/dashboard',function(){
    return redirect()->back();
});

Route::get('teacher-search', [FrontendController::class, 'teacherSearch'])->name('teacher.search');
Route::get('teacher-details-{id}', [FrontendController::class, 'teacherDetails'])->name('teacher.details');
Route::get('subject-details-{id}', [FrontendController::class, 'subjectDetails'])->name('subject.details');
Route::post('teacher-booking', [FrontendController::class, 'teacherbooking'])->name('teacher.booking');
Route::get('package/payment/{id}', [FrontendController::class, 'pkgPayment'])->name('package.payment');
Route::post('package/payment/done', [FrontendController::class, 'pkgPaymentDone'])->name('package.payment.done');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profileview'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'ProfileUpdate'])->name('profile.update');
    Route::get('/password', [ProfileController::class, 'passwordview'])->name('password.view');
    Route::post('/password/update', [ProfileController::class, 'passwordupdate'])->name('update.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/logo', [AdminController::class, 'logo'])->name('admin.logo');
    Route::get('/admin/logo/create', [AdminController::class, 'logoCreate'])->name('admin.logo.create');
    Route::post('/admin/logo/store', [AdminController::class, 'logoStore'])->name('admin.logo.store');
    Route::get('/admin/logo/edit/{id}', [AdminController::class, 'logoEdit'])->name('admin.logo.edit');
    Route::post('/admin/logo/update/{id}', [AdminController::class, 'logoUpdate'])->name('admin.logo.update');
    Route::get('/admin/logo/destroy/{id}', [AdminController::class, 'logoDestroy'])->name('admin.logo.destroy');

    Route::get('/admin/contactus', [AdminController::class, 'contactus'])->name('admin.contactus');

    Route::get('/admin/about', [AdminController::class, 'about'])->name('admin.about');
    Route::get('/admin/about/create', [AdminController::class, 'aboutCreate'])->name('admin.about.create');
    Route::post('/admin/about/store', [AdminController::class, 'aboutStore'])->name('admin.about.store');
    Route::get('/admin/about/edit/{id}', [AdminController::class, 'aboutEdit'])->name('admin.about.edit');
    Route::post('/admin/about/update/{id}', [AdminController::class, 'aboutUpdate'])->name('admin.about.update');
    Route::get('/admin/about/destroy/{id}', [AdminController::class, 'aboutDestroy'])->name('admin.about.destroy');

    Route::get('/admin/pricing', [AdminController::class, 'pricing'])->name('admin.pricing');
    Route::get('/admin/pricing/create', [AdminController::class, 'pricingCreate'])->name('admin.pricing.create');
    Route::post('/admin/pricing/store', [AdminController::class, 'pricingStore'])->name('admin.pricing.store');
    Route::get('/admin/pricing/edit/{id}', [AdminController::class, 'pricingEdit'])->name('admin.pricing.edit');
    Route::post('/admin/pricing/update/{id}', [AdminController::class, 'pricingUpdate'])->name('admin.pricing.update');
    Route::get('/admin/pricing/destroy/{id}', [AdminController::class, 'pricingDestroy'])->name('admin.pricing.destroy');

    Route::get('/admin/payment/student', [AdminController::class, 'stdPayment'])->name('admin.student.payment');
    Route::get('/admin/payment/approve/{id}', [AdminController::class, 'paymentApprove'])->name('admin.payment.approve');
    Route::get('/admin/payment/teacher', [AdminController::class, 'teachPayment'])->name('admin.teacher.payment');
    Route::get('/admin/payment/teacher/approve/{id}', [AdminController::class, 'teacherPaymentApprove'])->name('admin.teacher.payment.approve');
    Route::get('/admin/payment/reject/{id}', [AdminController::class, 'paymentReject'])->name('admin.payment.reject');

    Route::get('/admin/service', [AdminController::class, 'service'])->name('admin.service');
    Route::get('/admin/service/create', [AdminController::class, 'serviceCreate'])->name('admin.service.create');
    Route::post('/admin/service/store', [AdminController::class, 'serviceStore'])->name('admin.service.store');
    Route::get('/admin/service/edit/{id}', [AdminController::class, 'serviceEdit'])->name('admin.service.edit');
    Route::post('/admin/service/update/{id}', [AdminController::class, 'serviceUpdate'])->name('admin.service.update');
    Route::get('/admin/service/destroy/{id}', [AdminController::class, 'serviceDestroy'])->name('admin.service.destroy');

    Route::get('/admin/footer', [AdminController::class, 'footer'])->name('admin.footer');
    Route::get('/admin/footer/create', [AdminController::class, 'footerCreate'])->name('admin.footer.create');
    Route::post('/admin/footer/store', [AdminController::class, 'footerStore'])->name('admin.footer.store');
    Route::get('/admin/footer/edit/{id}', [AdminController::class, 'footerEdit'])->name('admin.footer.edit');
    Route::post('/admin/footer/update/{id}', [AdminController::class, 'footerUpdate'])->name('admin.footer.update');
    Route::get('/admin/footer/destroy/{id}', [AdminController::class, 'footerDestroy'])->name('admin.footer.destroy');

    Route::get('/admin/sociallink', [AdminController::class, 'sociallink'])->name('admin.sociallink');
    Route::get('/admin/sociallink/create', [AdminController::class, 'sociallinkCreate'])->name('admin.sociallink.create');
    Route::post('/admin/sociallink/store', [AdminController::class, 'sociallinkStore'])->name('admin.sociallink.store');
    Route::get('/admin/sociallink/edit/{id}', [AdminController::class, 'sociallinkEdit'])->name('admin.sociallink.edit');
    Route::post('/admin/sociallink/update/{id}', [AdminController::class, 'sociallinkUpdate'])->name('admin.sociallink.update');
    Route::get('/admin/sociallink/destroy/{id}', [AdminController::class, 'sociallinkDestroy'])->name('admin.sociallink.destroy');

    Route::get('/admin/teacher', [AdminController::class, 'allTeacher'])->name('admin.teacher');
    Route::get('/admin/teacher/approve/{id}', [AdminController::class, 'teacherApprove'])->name('admin.teacher.approve');
    Route::get('/admin/teacher/reject/{id}', [AdminController::class, 'teacherReject'])->name('admin.teacher.reject');
    Route::get('/admin/teacher/reapprove/{id}', [AdminController::class, 'teacherReapprove'])->name('admin.teacher.reapprove');
    Route::get('/admin/teacher/status/{id}', [AdminController::class, 'teacherStatus'])->name('admin.teacher.status');
    Route::get('/admin/teacher/pending/videos', [AdminController::class, 'pendingVideo'])->name('admin.teacher.pending.video');
    Route::get('/admin/teacher/approved/videos', [AdminController::class, 'approvedVideo'])->name('admin.teacher.approved.video');
    Route::get('/admin/teacher/approve/video/{id}', [AdminController::class, 'videoApprove'])->name('admin.teacher.approve.video');
    Route::get('/admin/teacher/reject/video/{id}', [AdminController::class, 'videoReject'])->name('admin.teacher.reject.video');
    Route::get('/admin/teacher/user/suspend/{id}', [AdminController::class, 'teacherUserSuspend'])->name('admin.teacher.user.suspend');

    Route::get('/admin/student', [AdminController::class, 'allStudent'])->name('admin.student');
    Route::get('/admin/student/status/{id}', [AdminController::class, 'studentStatus'])->name('admin.student.status');
    Route::get('/admin/student/fees/approval/{id}', [AdminController::class, 'studentFeesApproval'])->name('admin.student.fees.approval');
    Route::get('/admin/student/fees/reject/{id}', [AdminController::class, 'studentFeesReject'])->name('admin.student.fees.reject');

    Route::get('/admin/grade', [AdminController::class, 'gradeIndex'])->name('admin.grade.index');
    Route::get('/admin/grade/create', [AdminController::class, 'gradeCreate'])->name('admin.grade.create');
    Route::post('/admin/grade/store', [AdminController::class, 'gradeStore'])->name('admin.grade.store');
    Route::get('/admin/grade/edit/{id}', [AdminController::class, 'gradeEdit'])->name('admin.grade.edit');
    Route::post('/admin/grade/update/{id}', [AdminController::class, 'gradeUpdate'])->name('admin.grade.update');
    Route::get('/admin/grade/destroy/{id}', [AdminController::class, 'gradeDestroy'])->name('admin.grade.destroy');

    Route::get('/admin/subject', [AdminController::class, 'subjectIndex'])->name('admin.subject.index');
    Route::get('/admin/subject/create', [AdminController::class, 'subjectCreate'])->name('admin.subject.create');
    Route::post('/admin/subject/store', [AdminController::class, 'subjectStore'])->name('admin.subject.store');
    Route::get('/admin/subject/edit/{id}', [AdminController::class, 'subjectEdit'])->name('admin.subject.edit');
    Route::post('/admin/subject/update/{id}', [AdminController::class, 'subjectUpdate'])->name('admin.subject.update');
    Route::get('/admin/subject/destroy/{id}', [AdminController::class, 'subjectDestroy'])->name('admin.subject.destroy');

    Route::get('/admin/board', [AdminController::class, 'boardIndex'])->name('admin.board.index');
    Route::get('/admin/board/create', [AdminController::class, 'boardCreate'])->name('admin.board.create');
    Route::post('/admin/board/store', [AdminController::class, 'boardStore'])->name('admin.board.store');
    Route::get('/admin/board/edit/{id}', [AdminController::class, 'boardEdit'])->name('admin.board.edit');
    Route::post('/admin/board/update/{id}', [AdminController::class, 'boardUpdate'])->name('admin.board.update');
    Route::get('/admin/board/destroy/{id}', [AdminController::class, 'boardDestroy'])->name('admin.board.destroy');

    Route::get('/admin/area', [AdminController::class, 'areaIndex'])->name('admin.area.index');
    Route::get('/admin/area/create', [AdminController::class, 'areaCreate'])->name('admin.area.create');
    Route::post('/admin/area/store', [AdminController::class, 'areaStore'])->name('admin.area.store');
    Route::get('/admin/area/edit/{id}', [AdminController::class, 'areaEdit'])->name('admin.area.edit');
    Route::post('/admin/area/update/{id}', [AdminController::class, 'areaUpdate'])->name('admin.area.update');
    Route::get('/admin/area/destroy/{id}', [AdminController::class, 'areaDestroy'])->name('admin.area.destroy');

    Route::get('/admin/blog', [AdminController::class, 'blogIndex'])->name('admin.blog.index');
    Route::get('/admin/blog/create', [AdminController::class, 'blogCreate'])->name('admin.blog.create');
    Route::post('/admin/blog/store', [AdminController::class, 'blogStore'])->name('admin.blog.store');
    Route::get('/admin/blog/edit/{id}', [AdminController::class, 'blogEdit'])->name('admin.blog.edit');
    Route::post('/admin/blog/update/{id}', [AdminController::class, 'blogUpdate'])->name('admin.blog.update');
    Route::get('/admin/blog/destroy/{id}', [AdminController::class, 'blogDestroy'])->name('admin.blog.destroy');

    Route::get('/admin/sponsor/teacher/add', [AdminController::class, 'addSponsorTeacher'])->name('admin.add.sponsor.teacher');
    Route::get('/admin/sponsor/teacher/store/{id}', [AdminController::class, 'storeSponsorTeacher'])->name('admin.store.sponsor.teacher');
    Route::get('/admin/sponsor/teacher', [AdminController::class, 'sponsorTeacher'])->name('admin.sponsor.teacher');

    Route::get('/admin/abuse/reports', [AdminController::class, 'abuseReports'])->name('admin.abuse.report');
    Route::get('/admin/teacher/suspend/{id}', [AdminController::class, 'teacherSuspend'])->name('admin.teacher.suspend');
    Route::get('/admin/student/suspend/{id}', [AdminController::class, 'studentSuspend'])->name('admin.student.suspend');
    Route::get('/admin/report/{reportId}/seen', [AdminController::class, 'reportSeen'])->name('admin.report.seen');

    Route::get('/admin/contact/mail', [AdminController::class, 'contactMails'])->name('admin.contact.mail');
    Route::get('/admin/contact/mail/seen/{id}', [AdminController::class, 'contactMailsSeen'])->name('admin.contact.mail.seen');

    Route::get('/admin/ticket/student', [AdminController::class, 'studentTicket'])->name('admin.ticket.student');
    Route::get('/admin/ticket/teacher', [AdminController::class, 'teacherTicket'])->name('admin.ticket.teacher');
    Route::get('/admin/ticket/seen/{id}', [AdminController::class, 'seenTicket'])->name('admin.ticket.seen');
});

Route::middleware(['auth', 'role:teacher', 'verified'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');

    Route::get('/teacher/profile', [TeacherController::class, 'profileIndex'])->name('teacher.profile.index');
    Route::get('/teacher/profile/create', [TeacherController::class, 'profileCreate'])->name('teacher.profile.create');
    Route::post('/teacher/profile/store', [TeacherController::class, 'profileStore'])->name('teacher.profile.store');
    Route::get('/teacher/profile/edit/{id}', [TeacherController::class, 'profileEdit'])->name('teacher.profile.edit');
    Route::post('/teacher/profile/update/{id}', [TeacherController::class, 'profileUpdate'])->name('teacher.profile.update');
    Route::get('/teacher/profile/destroy/{id}', [TeacherController::class, 'profileDestroy'])->name('teacher.profile.destroy');

    Route::get('/teacher/subject', [TeacherController::class, 'subjectIndex'])->name('teacher.subject.index');
    Route::get('/teacher/subject/create', [TeacherController::class, 'subjectCreate'])->name('teacher.subject.create');
    Route::post('/teacher/subject/store', [TeacherController::class, 'subjectStore'])->name('teacher.subject.store');
    Route::get('/teacher/subject/edit/{id}', [TeacherController::class, 'subjectEdit'])->name('teacher.subject.edit');
    Route::post('/teacher/subject/update/{id}', [TeacherController::class, 'subjectUpdate'])->name('teacher.subject.update');
    Route::get('/teacher/subject/destroy/{id}', [TeacherController::class, 'subjectDestroy'])->name('teacher.subject.destroy');

    Route::get('/teacher/grade', [TeacherController::class, 'gradeIndex'])->name('teacher.grade.index');
    Route::get('/teacher/grade/create', [TeacherController::class, 'gradeCreate'])->name('teacher.grade.create');
    Route::post('/teacher/grade/store', [TeacherController::class, 'gradeStore'])->name('teacher.grade.store');
    Route::get('/teacher/grade/edit/{id}', [TeacherController::class, 'gradeEdit'])->name('teacher.grade.edit');
    Route::post('/teacher/grade/update/{id}', [TeacherController::class, 'gradeUpdate'])->name('teacher.grade.update');
    Route::get('/teacher/grade/destroy/{id}', [TeacherController::class, 'gradeDestroy'])->name('teacher.grade.destroy');

    Route::get('/teacher/board', [TeacherController::class, 'boardIndex'])->name('teacher.board.index');
    Route::get('/teacher/board/create', [TeacherController::class, 'boardCreate'])->name('teacher.board.create');
    Route::post('/teacher/board/store', [TeacherController::class, 'boardStore'])->name('teacher.board.store');
    Route::get('/teacher/board/edit/{id}', [TeacherController::class, 'boardEdit'])->name('teacher.board.edit');
    Route::post('/teacher/board/update/{id}', [TeacherController::class, 'boardUpdate'])->name('teacher.board.update');
    Route::get('/teacher/board/destroy/{id}', [TeacherController::class, 'boardDestroy'])->name('teacher.board.destroy');

    Route::get('/teacher/area', [TeacherController::class, 'areaIndex'])->name('teacher.area.index');
    Route::get('/teacher/area/create', [TeacherController::class, 'areaCreate'])->name('teacher.area.create');
    Route::post('/teacher/area/store', [TeacherController::class, 'areaStore'])->name('teacher.area.store');
    Route::get('/teacher/area/edit/{id}', [TeacherController::class, 'areaEdit'])->name('teacher.area.edit');
    Route::post('/teacher/area/update/{id}', [TeacherController::class, 'areaUpdate'])->name('teacher.area.update');
    Route::get('/teacher/area/destroy/{id}', [TeacherController::class, 'areaDestroy'])->name('teacher.area.destroy');

    Route::get('/teacher/fees', [TeacherController::class, 'feesIndex'])->name('teacher.fees.index');
    Route::get('/teacher/fees/create', [TeacherController::class, 'feesCreate'])->name('teacher.fees.create');
    Route::post('/teacher/fees/store', [TeacherController::class, 'feesStore'])->name('teacher.fees.store');
    Route::get('/teacher/fees/edit/{id}', [TeacherController::class, 'feesEdit'])->name('teacher.fees.edit');
    Route::post('/teacher/fees/update/{id}', [TeacherController::class, 'feesUpdate'])->name('teacher.fees.update');
    Route::get('/teacher/fees/destroy/{id}', [TeacherController::class, 'feesDestroy'])->name('teacher.fees.destroy');

    Route::get('/teacher/video', [TeacherController::class, 'videoIndex'])->name('teacher.video.index');
    Route::get('/teacher/video/create', [TeacherController::class, 'videoCreate'])->name('teacher.video.create');
    Route::post('/teacher/video/store', [TeacherController::class, 'videoStore'])->name('teacher.video.store');
    Route::get('/teacher/video/edit/{id}', [TeacherController::class, 'videoEdit'])->name('teacher.video.edit');
    Route::post('/teacher/video/update/{id}', [TeacherController::class, 'videoUpdate'])->name('teacher.video.update');
    Route::get('/teacher/video/destroy/{id}', [TeacherController::class, 'videoDestroy'])->name('teacher.video.destroy');

    Route::get('/teacher/shift', [TeacherController::class, 'shiftIndex'])->name('teacher.shift.index');
    Route::get('/teacher/shift/create', [TeacherController::class, 'shiftCreate'])->name('teacher.shift.create');
    Route::post('/teacher/shift/store', [TeacherController::class, 'shiftStore'])->name('teacher.shift.store');
    Route::get('/teacher/shift/edit/{id}', [TeacherController::class, 'shiftEdit'])->name('teacher.shift.edit');
    Route::post('/teacher/shift/update/{id}', [TeacherController::class, 'shiftUpdate'])->name('teacher.shift.update');
    Route::get('/teacher/shift/destroy/{id}', [TeacherController::class, 'shiftDestroy'])->name('teacher.shift.destroy');
    Route::get('/teacher/shift/status/{id}', [TeacherController::class, 'shiftStatus'])->name('teacher.shift.status');
    Route::get('/teacher/approval/{id}', [TeacherController::class, 'approval'])->name('teacher.approval');
    Route::get('/teacher/reject/{id}', [TeacherController::class, 'reject'])->name('teacher.reject');

    Route::get('/teacher/mail', [TeacherController::class, 'allMails'])->name('teacher.mail');
    Route::get('/teacher/mail/new', [TeacherController::class, 'newMail'])->name('teacher.mail.new');
    Route::post('/teacher/mail/store', [TeacherController::class, 'storeMail'])->name('teacher.mail.store');

    Route::get('/teacher/ticket', [TeacherController::class, 'ticket'])->name('teacher.ticket');
    Route::get('/teacher/ticket/add', [TeacherController::class, 'ticketAdd'])->name('teacher.ticket.add');
    Route::post('/teacher/ticket/store', [TeacherController::class, 'ticketStore'])->name('teacher.ticket.store');

    Route::get('/teacher/session/end/{id}', [TeacherController::class, 'endSession'])->name('teacher.session.end');
});

Route::middleware(['auth', 'verified', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');

    Route::get('/student/payment/page/{id}', [StudentController::class, 'teacherPaymentPage'])->name('student.teacher.payment.page');
    Route::post('/student/payment/done', [StudentController::class, 'teacherPaymentDone'])->name('student.teacher.payment.done');

    Route::get('/student/report/teacher', [StudentController::class, 'reportTeacher'])->name('student.report.teacher');
    Route::post('/student/report', [StudentController::class, 'reportAbuse'])->name('student.report.abuse');

    Route::get('/student/ticket', [StudentController::class, 'ticket'])->name('student.ticket');
    Route::get('/student/ticket/add', [StudentController::class, 'ticketAdd'])->name('student.ticket.add');
    Route::post('/student/ticket/store', [StudentController::class, 'ticketStore'])->name('student.ticket.store');
});