@extends('layouts.base')
@extends('layouts.app')
@section('content')

<div class="container">
    <table id="stable" class="table table-striped table-hover">
      <thead>
                <tr>
                    <th>Service ID</th>
                    <th>Instructor</th>
                    <th>Instrument</th>
                    <th>Service Name</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
      <tbody id="sbody">
      </tbody>
    </table>
  </div>
</div>


<div class="modal fade" id="serviceModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Service</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
            <form id="sform" method="#" action="#" enctype="multipart/form-data">

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
                        <label for="eventStarts" class="control-label">Date</label>
                        <input type="date" class="form-control" id="eventStarts" name="eventStarts">
                    </div>

                    <div class="form-group">
                        <label for="description" class="control-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>

                    <div class="form-group">
                        <label for="price" class="control-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>

              <div class="form-group"> 
                <label for="image" class="control-label">Image</label>
                <input type="file" class="form-control" id="uploads" name="uploads" />
               </div>
            </form>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button id="serviceUpdate" type="submit" class="btn btn-primary">Update</button>
          <button id="serviceSubmit" type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
  </div>
</div>

@endsection