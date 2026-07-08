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
                            <li class="breadcrumb-item active" aria-current="page">Board</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start gap-3">
                            <a href="{{ route('teacher.board.create') }}" class="btn btn-outline-success "><i class="fa-solid fa-plus fs-5"></i>Add More</a>
                        </div>
                        @if($boards != null && $boards->count() > 0 )
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    @foreach($boards as $board)
                                    <tr>
                                        <td style="vertical-align: middle; text-align: start">{{$board->board_name}}</td>
                                        <td style="vertical-align: middle; text-align: end"><a href="{{ route('teacher.board.edit',$board->id) }}" class="btn btn-outline-primary text-center me-3"><i class="fa-solid fa-pen-to-square fs-5"></i></a><a href="{{ route('teacher.board.destroy',$board->id) }}" class="btn btn-outline-danger text-center"><i class="fa-solid fa-trash fs-5"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-warning">Please Add Boards</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->
@endsection
