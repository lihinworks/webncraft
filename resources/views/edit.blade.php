
      @extends( 'master');

      @section('content');
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Employees</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">DataTables</li> --}}
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>
          @if(session()->get('success'))
          <div class="alert alert-success" id="message">
      {{ session()->get('success') }}
      </div><br />
      @endif


      @if(count($errors) > 0 )
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <ul class="p-0 m-0" style="list-style: none;">
          @foreach($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
      </ul>
      </div>
      @endif

          <!-- Main content -->
          <section class="content">

            <!-- /.container-fluid -->
            <div>
            <div class="modal-dialog" role="document">

              <form id="employeeRegform" method="POST" action="{{ route('employees.update',[$employee_data->id]) }}" enctype="multipart/form-data" >
                  {{csrf_field()}}
                  {{ method_field('PATCH') }}
              <div class="modal-content">
                <div class="modal-header text-center">
                  <h4 class="modal-title w-100 font-weight-bold">Register</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body mx-3">
                  {{-- <div class="md-form mb-5">
                    <i class="fas fa-envelope prefix grey-text"></i>
                    <input type="email" id="defaultForm-email" class="form-control validate">
                    <label data-error="wrong" data-success="right" for="defaultForm-email">Your email</label>
                  </div> --}}
                  <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control"  placeholder="name" name="name" value="{{$employee_data->name}}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control"  placeholder="email" name="email" value="{{$employee_data->email}}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Photo</label>
                      <div class="col-sm-10">
                        <img src="{{ URL::asset('storage/upload/'.$employee_data->image) }}" width="100" height="100"/>
                           {{-- <input type="file" id="myfile" name="myfile"> --}}
                              {{-- <input type="file" id="customFile" name="image"> --}}

                      </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Change photo</label>
                        <div class="col-sm-10">
                              <input type="file" id="myfile" name="myfile">
                                {{-- <input type="file" id="customFile" name="image"> --}}

                        </div>
                      </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Role</label>
                      <div class="col-sm-10">
                          <div class="form-group">
                              <label></label>
                              <select class="form-control select2" style="width: 100%;" name="design_ation">
                                @foreach($designations as $designationsKey => $des)
                                <option value="{{ $des->id }}" {{$employee_data->designation == $des->id  ? 'selected' : ''}}>{{ $des->name}}</option>
                                @endforeach
                              </select>
                            </div>
                      </div>
                    </div>

                  {{-- <div class="md-form mb-4">
                    <i class="fas fa-lock prefix grey-text"></i>
                    <input type="password" id="defaultForm-pass" class="form-control validate">
                    <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label>
                  </div> --}}

                </div>
                <div class="modal-footer d-flex justify-content-center">
                  <button class="btn btn-success" type="submit">Update</button>
                </div>
              </div>
          </form>
            </div>
          </div>

          {{-- <div class="text-center">
            <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm">Launch
              Modal Login Form</a>
          </div> --}}
          </section>
          <!-- /.content -->
        </div>


        <!-- /.content-wrapper -->
      @endsection

