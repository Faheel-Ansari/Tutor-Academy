<?php

namespace App\Providers;

use App\Models\Logo;
use App\Models\StdPricing;
use App\Models\TeacherFee;
use App\Models\ReportAbuse;
use App\Models\ContactAdmin;
use App\Models\TeacherShift;
use App\Models\TeacherVideo;
use App\Models\TeacherProfile;
use App\Models\Ticket;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        Paginator::useBootstrapFive();

        View::composer('backend.body.header', function ($view) {
            $view->with('profileData', Auth::user());
            $view->with('logo', Logo::first());
        });

        View::composer('backend.body.sidebar', function ($view) {
            $view->with('profileData', Auth::user());
            $view->with('teacherProfile', TeacherProfile::where('role_id', Auth::user()->id)->first());
            $view->with('fee', TeacherFee::where('role_id', Auth::user()->id)->first());
            $view->with('video', TeacherVideo::where('role_id', Auth::user()->id)->first());
            $view->with('shifts', TeacherShift::where('role_id', Auth::user()->id)->get());
            $view->with('pricings', StdPricing::get());
            $view->with('allreports', ReportAbuse::where('read_no', '=', '0')->get());
            $view->with('allmails', ContactAdmin::where('seen', '=', '0')->get());
            $view->with('allTickets', Ticket::where('seen', '=', '0')->get());
            $view->with('studentTickets', Ticket::where('seen', '=', '0')->where('student_id', '!=', 'null')->get());
            $view->with('teacherTickets', Ticket::where('seen', '=', '0')->where('teacher_id', '!=', 'null')->get());
            $view->with('logo', Logo::first());
        });

        View::composer('backend.body.changepassword', function ($view) {
            $view->with('profileData', Auth::user());
            $view->with('logo', Logo::first());
        });

        View::composer('layout.dashboard', function ($view) {
            $view->with('logo', Logo::first());
        });

        View::composer('frontend.body.master', function ($view) {
            $view->with('logo', Logo::first());
        });

        View::composer('auth.verify-email', function ($view) {
            $view->with('logo', Logo::first());
        });
    }
}
