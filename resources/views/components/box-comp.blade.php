<div class="box">
    <div class="box-header with-border">
     <div class="row">
        <div class="col-sm-8 col-md-8">
            <h3 class="box-title">{{$boxTitle}}</h3>
        </div>
        <div class="col-sm-4 col-md-4 float-right">
            {{$buttonArea}}
        </div>
     </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
       {{$slot}}
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->