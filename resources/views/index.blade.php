
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
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">

                  <!-- /.card -->

                  <div class="card">
                    <div class="card-header">
                   <button id="createbtn" class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#modalLoginForm">Create</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Name</th>
                          <th>Designation</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($employee_data as $key => $emp)
                            <tr>
                              <td>{{ $emp->name }}</td>
                              <td>{{ $emp->designation_name }}</td>
                              <td>{{ $emp->email }}</td>
                              <td>{{ $emp->employee_status }}</td>
                              <td> <a href="{{ url('employees/'.$emp->id) }}" title="{{trans('messages.edit ')}}" class="btn btn-primary btn-xs">Edit</a>
                                <a href="{{ url('services/'.$emp->id ) }}" title="{{trans('messages.show_more')}}" class="btn btn-danger btn-xs">Disable</a>
                            </td>

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>

                        </tfoot>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <form id="employeeRegform" method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data" >
                  {{csrf_field()}}
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
                        <input type="text" class="form-control"  placeholder="name" name="name">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control"  placeholder="email" name="email">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Photo</label>
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
                                  @foreach($designations as $designationskey => $designation)
                                <option value="{{$designation->id}}" <?= ( $designation->id == old('design_ation')  ) ? 'selected="selected"' : ''?>>{{ $designation->name}}</option>
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
                  <button class="btn btn-success" type="submit">Register</button>
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

