 <!-- Content Wrapper. Contains page content -->
 @extends('layouts.master')
 @section('link')
 <link rel="stylesheet" href="{{('storage/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{('storage/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 @endsection
 @section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">আমার কালেকশন হিসাব</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">হোম</a></li>
              <li class="breadcrumb-item active">আমার কালেকশন হিসাব</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card ">
            <div class="card-header bg-dark">
              <div class="card-title">আমার কালেকশন হিসাব <button class="btn btn-primary ml-auto" data-toggle="modal" data-target="#modal" data-whatever="@mdo">নতুন</button></div>
            </div>
            <div class="card-body">
              <table class="table table-bordered" id="datatable">
                <thead>
                  <tr>
                    <th>আইডি</th>
                    <th>নাম</th>
                    <th>স্বস্ত্যয়নী</th>
                    <th>ইষ্টভৃতি</th>
                    <th>দক্ষিনা</th>
                    <th>সংগঠনী</th>
                    <th>প্রনামী</th>
                    <th>প্রচার ও প্রকাশন</th>
                    <th>মন্দির নির্মান</th>
                    <th>বিবিধ</th>
                    <th>ঋত্বিকী</th>
                    <th>মোট</th>
                    <th>জমা</th>
                    <th>ব্যালেন্স</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
      </div><!-- /.container-fluid -->
      {{-- modal --}}
     
      {{-- endmodal --}}
    </section>
  @endsection
  @section('script')
  <script src="{{('storage/adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{('storage/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{('storage/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{('storage/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

  @include('backend.collector-data.internal-assets.js.script')

  @endsection