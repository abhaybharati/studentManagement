@extends('layouts.app')

@section('content')
{{-- Student Data starts --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <button class="btn btn-success mb-3 bg-dark text-white" id="createNewStudent">Add Student</button>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Marks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Student Data  ends--}}
{{-- modal for student form --}}
<div class="modal fade" id="ajaxModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="modelHeading"></h5>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="studentForm" name="studentForm" class="form-horizontal">
                    <input type="hidden" name="student_id" id="student_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="subject" class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject" value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="marks" class="col-sm-2 control-label">Marks</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="marks" name="marks" placeholder="Enter Marks" value="" required="">
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                         <button type="submit" class="btn btn-dark" id="saveBtn" value="create">Save changes
                         </button>
                     </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- modal for student form end --}}
@endsection
