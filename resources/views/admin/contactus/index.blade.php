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
                            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        @if($contactus != null && $contactus->count() > 0 )
                        <div class="table-responsive">
                            <table id="studentDetails" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contactus as $contact)
                                    <tr class="text-center">
                                        <td style="vertical-align: middle;">{{ \Carbon\Carbon::parse($contact->created_at)->format('d M Y') }}</td>
                                        <td style="vertical-align: middle;">{{ $contact->fname }} {{$contact->lname}}</td>
                                        <td style="vertical-align: middle" class="text-primary">{{ $contact->email }}</td>
                                        <td style="vertical-align: middle">{{ $contact->subject }}</td>
                                        <td style="vertical-align: middle"><a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="{{'#message'.$contact->id}}">Read Message</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-warning">No Message Found</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($contactus as $contact)
<div class="modal fade" id="{{'message'.$contact->id}}" tabindex="-1" aria-labelledby="messageLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Contact Message</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{$contact->message}}</p>
            </div>
        </div>
    </div>
</div>
@endforeach
<!--end page wrapper -->
@endsection
