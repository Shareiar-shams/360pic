<!DOCTYPE html>
<html>
<head>
  @include('admin.include.head')
</head>
<body class="hold-transition skin-blue sidebar-mini" onload="myFunction()">
    <!--================ Page Loading Area ================ -->
    <div id="loader"></div>
    <!-- wrapper -->
    <div class="wrapper">

      @include('admin.include.header')
      <!-- Left side column. contains the logo and sidebar -->
      @include('admin.include.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          @include('admin.include.content-header')

          <!-- Main content -->
          <section class="content">
              <!-- Main row -->
              @section('admin_main_content')
                  @show
              <!-- /.row (main row) -->

          </section>
          <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      @include('admin.include.footer')

      
     
    </div>
    <!-- ./wrapper -->

@include('admin.include.js')
</body>
</html>
