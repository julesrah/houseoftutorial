@extends('layouts.base')
@extends('layouts.app')
@section('content')

<div class="container">
    <table id="mtable" class="table table-striped table-hover">
      <thead>
                <tr>
                    <th>Damage ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
      <tbody id="mbody">
      </tbody>
    </table>
  </div>
</div>


<div class="modal fade" id="damageModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Damage</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
            <form id="vform" method="#" action="#" enctype="multipart/form-data">

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id" name="id">
                    </div>
              
                    <div class="form-group">
                        <label for="title" class="control-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>

              <div class="form-group"> 
                <label for="image" class="control-label">Image</label>
                <input type="file" class="form-control" id="uploads" name="uploads" />
               </div>
            </form>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button id="damageUpdate" type="submit" class="btn btn-primary">Update</button>
          <button id="damageSubmit" type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
  </div>
</div>

@endsection