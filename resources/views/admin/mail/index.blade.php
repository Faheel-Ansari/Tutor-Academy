@extends('layout.dashboard')
@section('dashboards')
@php
use App\Models\TeacherProfile;
@endphp
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-body">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Admin</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('teacher.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Mails</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if($mails != null && $mails->count() > 0 )
            <div class="col-12 d-flex flex-wrap gap-5">
                @foreach($mails as $mail)
                <div class="col-md-3">
                    <div class="card bg-info-subtle h-100">
                        <div class="card-body d-flex flex-column justify-content-between h-100">
                            <div>
                                <p>
                                    <img src="{{ (!empty($mail->photo)) ? url('uploads/profileimages/'.$mail->photo) :  url('/noprofile/no-profile.jpg') }}" alt="Profile Image" id="" class="rounded-circle me-2 bg-primary" width="60">
                                    <a class="cursor-pointer text-primary" data-bs-toggle="modal" data-bs-target="{{'#detail'.$mail->id}}">{{$mail->email}}</a>
                                </p>
                                <p><strong>Subject:</strong></p>
                                <p>{{$mail->subject}}</p>
                            </div>
                            <div class="d-flex">
                                <a class="btn btn-primary mt-3 me-2" data-bs-toggle="modal" data-bs-target="{{'#message'.$mail->id}}">Read Message</a>
                                @if($mail->seen == 0)
                                <a href="{{route('admin.contact.mail.seen',$mail->id)}}" class="btn btn-warning mt-3">Pending</a>
                                @else
                                <button class="btn btn-secondary mt-3" disabled>Seen</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-5">
                {!! $mails->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
            @else
            <div class="alert alert-warning">No Mails found</div>
            @endif
        </div>
    </div>
</div>
@foreach($mails as $mail)`
@php
$teacher = TeacherProfile::where('role_id',$mail->from_name)->first();
@endphp
<div class="modal fade" id="{{'message'.$mail->id}}" tabindex="-1" aria-labelledby="messageLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="messageLabel">Message</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{$mail->message}}
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="{{'detail'.$mail->id}}" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detailLabel">Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex gap-3 mb-4 align-items-center"><img src="{{ (!empty($mail->photo)) ? url('uploads/profileimages/'.$mail->photo) :  url('/noprofile/no-profile.jpg') }}" alt="Profile Image" id="" class="rounded-circle me-4 bg-primary" width="150">
                    <h2>{{$teacher->fullname}}</h2>
                </div>
                <div class="d-flex flex-column ">
                    <p><strong>Email :</strong> {{$teacher->email}}</p>
                    <p><strong>Phone :</strong> {{$teacher->phone_no}}</p>
                    <p><strong>CNIC :</strong> {{$teacher->cnic}}</p>
                    <p class="text-wrap"><strong>Address :</strong> {{$teacher->address}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<!--end page wrapper -->
@endsection
