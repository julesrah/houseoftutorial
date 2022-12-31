@extends('layouts.base')
@extends('layouts.app')
@section('content')

<div class="container">
    <table id="ptable" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Instructor ID</th>
                <!-- <th>User ID</th> -->
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
        <tbody id="pbody">
        </tbody>
    </table>
</div>
</div>

<div class="modal fade" id="instructorModal" role="dialog" style="display:none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create New Instructor</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div style="padding: 0 2rem;">
                <form id="pform" action="#" method="#" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" class="form-control id" id="id" name="id">
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="specialty" class="control-label">Specialty</label>
                        <input type="text" class="form-control" id="specialty" name="specialty">
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Description</label>
                        <input type="text" class="form-control " id="description" name="description">
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

            <div class="modal-footer" id="footer">

                <button id="instructorSubmit" type="submit" class="btn btn-primary">Save</button>
                <br>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

 <div class="modal fade" id="editModal" role="dialog" style="display:none">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
             <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Instructor</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateinstructor" method="#" action="#" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="ename" class="control-label">Name</label>
                        <input type="text" class="form-control" id="ename" name="name">
                    </div>
                    <div class="form-group">
                        <label for="especialty" class="control-label">Specialty</label>
                        <input type="text" class="form-control" id="especialty" name="especialty">
                    </div>
                    <div class="form-group">
                        <label for="edescription" class="control-label">Description</label>
                        <input type="text" class="form-control " id="edescription" name="description">
                    </div>
                    <div class="form-group">
                        <label for="estatus" class="control-label">Status</label>
                        <input type="text" class="form-control" id="estatus" name="status">
                    </div>

                    <div class="form-group">
                        <label for="eaddress" class="control-label">Address</label>
                        <input type="text" class="form-control" id="eaddress" name="address">
                    </div>
                    <div class="form-group">
                        <label for="ephonenumber" class="control-label">Phone</label>
                        <input type="text" class="form-control" id="ephonenumber" name="phonenumber">
                    </div>

                    <div class="form-group">
                        <label for="uploads" class="control-label">instructor Image</label>
                        <input type="file" class="form-control" id="uploads" name="uploads">
                    </div>
                </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button id="updatebtn" type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>

@endsection
