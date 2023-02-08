<div class="box">
    <div class="box-header with-border">
     <div class="row">
        <div class="col-sm-8 col-md-8">
            <h3 class="box-title">{{$tableTitle}}</h3>
        </div>
        <div class="col-sm-4 col-md-4 float-right">
            {{$buttonArea}}
        </div>
     </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped table-responsive" width="100%">
            <thead>
                <tr>
                   {{$tableHead}}
                </tr>
            </thead>
            <tbody>
                {{$slot}}
                
            </tbody>
            {{-- <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </tfoot> --}}
          </table>
        </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
  @section('js')
  @include('Admin.Backend.includes.datatablejs')
@endsection

