@extends('layout.dashboard')
@section('dashboards')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-body">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Student</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('student.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">tickets</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        @if($tickets != null && $tickets->count() > 0 )
                        <div class="table-responsive">
                            <table id="studentDetails" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>Date</th>
                                        <th>Subject</th>
                                        <th>Ticket Message</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                    <tr class="text-center">
                                        <td style="vertical-align: middle;">{{ \Carbon\Carbon::parse($ticket->created_at)->format('d M Y h:i A') }}</td>
                                        <td style="vertical-align: middle">{{ $ticket->subject }}</td>
                                        <td style="vertical-align: middle"><a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="{{'#message'.$ticket->id}}">Read Message</a></td>
                                        @if($ticket->priority == 'high')
                                        <td style="vertical-align: middle"><button class="btn btn-danger" disabled>High</button></td>
                                        @elseif($ticket->priority == 'medium')
                                        <td style="vertical-align: middle"><button class="btn btn-warning" disabled>Medium</button></td>
                                        @else
                                        <td style="vertical-align: middle"><button class="btn btn-secondary" disabled>Low</button></td>
                                        @endif
                                        @if($ticket->seen == 1)
                                        <td style="vertical-align: middle"><button class="btn btn-secondary" disabled>Seen</button></td>
                                        @else
                                        <td style="vertical-align: middle"><button class="btn btn-warning" disabled>Pending</button></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-warning">No Ticket Found</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($tickets as $ticket)
<div class="modal fade" id="{{'message'.$ticket->id}}" tabindex="-1" aria-labelledby="messageLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ticket Message</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{$ticket->message}}
            </div>
        </div>
    </div>
</div>
@endforeach
<!--end page wrapper -->
@endsection
