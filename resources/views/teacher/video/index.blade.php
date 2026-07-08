@extends('layout.dashboard')
@section('dashboards')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-body">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Teacher</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('teacher.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Video</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-5 col-12">
                <div class="card">
                    <div class="card-body">
                        @if($video == null)
                        <div class="d-flex justify-content-between align-items-start gap-3">
                            <a href="{{ route('teacher.video.create') }}" class="btn btn-outline-success "><i class="fa-solid fa-plus fs-5"></i>Add Video</a>
                        </div>
                        <div class="alert alert-warning">Please Add Video</div>
                        @else
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <div class="d-flex justify-content-between mb-3">
                                        <h2>Your Trial Video</h2>
                                        @if($video->approval == '2')
                                        <button class="btn btn-warning" disabled>Approval Pending</button>
                                        @elseif($video->approval == '0')
                                        <a href="{{ route('teacher.video.edit',$video->id) }}" class="btn btn-outline-success text-center me-3"><i class="fa-solid fa-plus fs-5"></i>Add Video</a>
                                        @else
                                        <a href="{{ route('teacher.video.edit',$video->id) }}" class="btn btn-outline-primary text-center me-3"><i class="fa-solid fa-pen-to-square fs-5"></i>Edit</a>
                                        @endif
                                    </div>
                                    <tr>
                                        @if($video->approval == '0')
                                        <div class="alert alert-danger text-wrap">Some suspecious activity has been caught in your video. Please Upload another video.</div>
                                        @else
                                        <th style="vertical-align: middle; text-align: start"><video width="500" controls src="{{asset('/uploads/teacher_videos/'.$video->video)}}"></video></th>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->
@endsection
