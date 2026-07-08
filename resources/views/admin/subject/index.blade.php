@extends('layout.dashboard')
@section('dashboards')
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
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Subject</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="col-5">
                <div class="d-flex justify-content-start align-items-center mb-4 gap-3">
                    <a href="{{ route('admin.subject.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="fa-solid fa-plus fs-5"></i>Add More</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        @if($subjects->count() > 0)
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    @foreach($subjects as $subject)
                                    <tr>
                                        <td style="vertical-align: middle; text-align: start">{{$subject->subject}}</td>
                                        <td style="vertical-align: middle; text-align: start"><span class="d-flex justify-content-center rounded-circle overflow-hidden" style="width: 8vw; height: 8vw;"><img src="{{ (!empty($subject->sub_img)) ? url('uploads/adminimages/'.$subject->sub_img) :  url('/noprofile/no-profile.jpg') }}" alt="Subject Image"></span></td>
                                        <td style="vertical-align: middle; text-align: end"><a href="{{ route('admin.subject.edit',$subject->id) }}" class="btn btn-primary text-center me-3"><i class="fa-solid fa-pen-to-square fs-5"></i></a><a href="{{ route('admin.subject.destroy',$subject->id) }}" class="btn btn-outline-danger text-center"><i class="fa-solid fa-trash fs-5"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-danger">Please add subjects</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->
@endsection
