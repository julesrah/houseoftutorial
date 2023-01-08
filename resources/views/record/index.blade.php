@extends('layouts.base')
@extends('layouts.app')
@section('content')

<div class="container">
    <table id="xtable" class="table table-striped table-hover">
      <thead>
                <tr>
                    <th>Record ID</th>
                    <th>Instructor</th>
                    <th>Instrument</th>
                    <th>Record Date</th>
                    <th>Fee</th>
                    <th>Comment</th>
                    <th>Damages</th>
                </tr>
            </thead>
      <tbody id="qbody">
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="recordModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Record</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
            <form id="rform" method="#" action="#" enctype="multipart/form-data">

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id" name="id">
                    </div>
              
                    <div class="form-group">
                        <label for="instructor_id" class="control-label">Choose Instructor:</label>
                        {!! F::select('instructor_id', $instructor, null, ['class'=>'form-control']) !!}

                    <div class="form-group">
                        <label for="instrument_id" class="control-label">Choose Instrument:</label>
                        {!! F::select('instrument_id', $instrument, null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        <label for="servname" class="control-label">Name</label>
                        <input type="text" class="form-control" id="servname" name="servname">
                    </div>
                    <div class="form-group">
                        <label for="recordDate" class="control-label">Record Date</label>
                        <input type="date" class="form-control" id="recordDate" name="recordDate">
                    </div>

                    <div class="form-group">
                        <label for="fee" class="control-label">Fee</label>
                        <input type="text" class="form-control" id="fee" name="fee">
                    </div>

                    <div class="form-group">
                        <label for="comment" class="control-label">Comment</label>
                        <input type="text" class="form-control" id="comment" name="comment">
                    </div>

                    <div class="form-group">
                        <label for="damage_id" class="control-label">Choose Damages:</label>
                        {!! F::select('damage_id', $damage, null, ['class'=>'form-control']) !!}
                    </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button id="recordSubmit" type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
  </div>
</div>

@endsection
