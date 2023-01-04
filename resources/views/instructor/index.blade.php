@extends('layouts.base')
@extends('layouts.app')
@section('content')

<div class="container">
    <table id="gtable" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Instructor ID</th>
                <!-- <th>USER ID</th> -->
                <th>Name</th>
                <th>Specialty</th>
                <th>Description</th>
                <th>Status</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="gbody">
        </tbody>
    </table>
</div>
</div>

<div class="modal fade" id="instructorModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Instructor</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
            <form id="gform" method="#" action="#" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" class="form-control id" id="id" name="id">
                    </div>
                    <div class="form-group">
                        <label for="instructor_name" class="control-label">Name</label>
                        <input type="text" class="form-control" id="instructor_name" name="instructor_name">
                    </div>
                    <div class="form-group">
                        <label for="specialty" class="control-label">Specialty</label>
                        <input type="text" class="form-control" id="specialty" name="specialty">
                    </div>
                    <div class="form-group">
                        <label for="instructor_description" class="control-label">Description</label>
                        <input type="text" class="form-control " id="instructor_description" name="instructor_description">
                    </div>
                    <div class="form-group">
                        <label for="status" class="control-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status">
                    </div>

                    <div class="form-group">
                        <label for="address" class="control-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="phonenumber" class="control-label">Phone</label>
                        <input type="text" class="form-control" id="phonenumber" name="phonenumber">
                    </div>

                    <div class="form-group">
                        <label for="uploads" class="control-label">Instructor Image</label>
                        <input type="file" class="form-control" id="uploads" name="uploads">
                    </div>
                </form>
          </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="instructorUpdate" type="submit" class="btn btn-primary">Update</button>
                    <button id="instructorSubmit" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
</div>
@endsection
