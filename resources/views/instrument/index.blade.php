@extends('layouts.base')
@extends('layouts.app')
@section('content')

              @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

<div class="container">
    <table id="rtable" class="table table-striped table-hover">
      <thead>
                <tr>
                    <th>Instrument ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Condition</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
      <tbody id="rbody">
      </tbody>
    </table>
  </div>
</div>


<div class="modal fade" id="instrumentModal" role="dialog" style="display:none">
  <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Instrument</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
            <form id="rform" method="#" action="#" enctype="multipart/form-data">

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id" name="id">
                        
                    </div>
              
                    <div class="form-group">
                        <label for="instrument_name" class="control-label">Name</label>
                        <input type="text" class="form-control" id="instrument_name" name="instrument_name">
                        <!-- @error('instrument_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror -->
                        @if ($errors->has('instrument_name'))
                          <span class="text-danger">{{ $errors->first('instrument_name') }} </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="type" class="control-label">Choose Type:</label>
                        <select class="form-control" id="type" name="type">
                          <option>--Select type of instrument:--</option>
                          <option value="String">String</option>
                          <option value="Brass">Brass</option>
                          <option value="Woodwind">Woodwind</option>
                          <option value="Percussion">Percussion</option>
                          <option value="Keyboard">Keyboard</option>
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="description" class="control-label">Description</label>
                        <input type="text" class="form-control " id="description" name="description">
                    </div>
                    <div class="form-group">
                        <label for="condition" class="control-label">Choose Condition:</label>
                        <select class="form-control " id="condition" name="condition">
                          <option>--Select condition of instrument:--</option>
                            <option value="Good">Good</option>
                            <option value="Damaged">Damaged</option>
                            <option value="Under maintenance">Under maintenance</option>
                        </select>
                    </div>

                    <div class="form-group"> 
                        <label for="image" class="control-label">Image</label>
                        <input type="file" class="form-control" id="uploads" name="uploads" />
                    </div>
            </form>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button id="instrumentUpdate" type="submit" class="btn btn-primary">Update</button>
          <button id="instrumentSubmit" type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
  </div>
</div>

@endsection