@extends('layout.dashboard')
@section('dashboards')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Student</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('student.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('student.ticket')}}" class="text-decoration-none">Tickets</a></li>
                        <li class="breadcrumb-item active" aria-current="page">New Ticket</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-lg-6">
                <div class="border border-3 p-4 rounded">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <!-- Restaurant Name -->
                                <form method="POST" action="{{route('student.ticket.store')}}">
                                    @csrf
                                    <div class="col-md-12 mb-3">
                                        <label for="subject" class="form-label mb-2">Subject</label>
                                        <textarea name="subject" id="subject" rows="1" style="resize: none" class="form-control @error('subject') is-invalid @enderror" placeholder="Write your subject here..">{{old('subject')}}</textarea>
                                        <span class="text-danger">{{ $errors->first('subject') }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="concern" class="form-label mb-2">What is your concern?</label>
                                        <select name="concern" id="concern" class="form-select @error('concern') is-invalid @enderror">
                                            <option value="Billing" {{old('concern') == 'Billing' ? 'selected' : ''}}>Billing</option>
                                            <option value="Support" {{old('concern') == 'Support' ? 'selected' : ''}}>Support</option>
                                            <option value="Admin" {{old('concern') == 'Admin' ? 'selected' : ''}}>Admin</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->first('concern') }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="message" class="form-label mb-2">Message</label>
                                        <textarea name="message" id="message" rows="6" class="form-control @error('message') is-invalid @enderror" placeholder="Write your message here..">{{old('message')}}</textarea>
                                        <span class="text-danger">{{ $errors->first('message') }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <p>Choose ticket priority</p>
                                        <div class="d-flex gap-3">
                                            <span class="d-flex gap-2 align-items-center">
                                                <label for="low" class="form-label m-0">Low</label>
                                                <input type="radio" name="priority" checked id="low" value="low" class="form-check-input">
                                            </span>
                                            <span class="d-flex gap-2 align-items-center">
                                                <label for="medium" class="form-label m-0">Medium</label>
                                                <input type="radio" name="priority" id="medium" value="medium" class="form-check-input">
                                            </span>
                                            <span class="d-flex gap-2 align-items-center">
                                                <label for="high" class="form-label m-0">High</label>
                                                <input type="radio" name="priority" id="high" value="high" class="form-check-input">
                                            </span>
                                        </div>
                                        <span class="text-danger">{{ $errors->first('priority') }}</span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                            <button type="submit" class="btn btn-primary px-4">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
