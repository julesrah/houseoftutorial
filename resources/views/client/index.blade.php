@extends('layouts.base')
@extends('layouts.app')
@section('content')

<div class="container">
    <table id="ftable" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Client ID</th>
                <!-- <th>User ID</th> -->
                <th>Title</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Address</th>
                <th>Sex</th>
                <th>Phone</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="fbody">
        </tbody>
    </table>
</div>
</div>

<div class="modal fade" id="clientModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Client</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
            <form id="fform" method="#" action="#" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" class="form-control id" id="id" name="id">
                    </div>
                    <div class="form-group">
                        <label for="title" class="control-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="firstName" class="control-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName">
                    </div>
                    <div class="form-group">
                        <label for="lastName" class="control-label">Last Name</label>
                        <input type="text" class="form-control " id="lastName" name="lastName">
                    </div>
                    <div class="form-group">
                        <label for="age" class="control-label">Age</label>
                        <input type="text" class="form-control" id="age" name="age">
                    </div>

                    <div class="form-group">
                        <label for="address" class="control-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>

                    <div class="form-group">
                        <label for="sex" class="control-label">Sex</label>
                        <input type="text" class="form-control" id="sex" name="sex">
                    </div>

                    <div class="form-group">
                        <label for="phonenumber" class="control-label">Phone</label>
                        <input type="text" class="form-control" id="phonenumber" name="phonenumber">
                    </div>

                    <div class="form-group">
                        <label for="uploads" class="control-label">Client Image</label>
                        <input type="file" class="form-control" id="uploads" name="uploads">
                    </div>
                    </form>
          </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="clientUpdate" type="submit" class="btn btn-primary">Update</button>
                    <button id="clientSubmit" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>

@endsection
