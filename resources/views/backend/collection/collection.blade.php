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
            <h1 class="m-0">কালেকশন</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">হোম</a></li>
              <li class="breadcrumb-item active">কালেকশন</li>
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
              <div class="row">
                <div class="col-6">
                  <div class="card-title">কালেকশন</div>
                </div>
                <div class="col-6 ">
                  <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modal" data-whatever="@mdo">নতুন</button>
                </div>
              </div>
              
               
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
                    <th>কৃষ্টি বান্ধব</th>
                    <th>শ্রী শ্রী ঠাকুর ভোগ</th>
                    <th>আনন্দ বাজার</th>
                    <th>বিবিধ</th>
                    <th>ঋত্বিকী</th>
                    <th>মোট</th>
                    <th>ঠিকানা</th>
                    <th>এ্যাকশন</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
      </div><!-- /.container-fluid -->
      {{-- modal --}}
      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal" >
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">নতুন কালেকশন</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="Clear()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" >
              <form method="POST">
                <input type="hidden" id="id">
                <div class="row">
                  <div class="col-12 col-md-6">
                    <label for="recipient-name" class="col-form-label d-block">দাতা:</label>
                    <div class="input-group">
                      <select  class="form-control" id="donor" >
                        <option value="">select</option>
                      </select>
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="add-donor">যুক্ত করুন</button>
                      </div>
                      <div class="invalid-feedback" id="donor_msg">
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6"> 
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">স্বস্ত্যয়নী:</label>
                      <input type="number" class="form-control" id="sostoyoni" placeholder="0.00">
                      <div class="invalid-feedback" id="sostoyoni_msg">
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">ইষ্টভৃতি:</label>
                      <input type="number" class="form-control" id="istovriti" placeholder="0.00">
                      <div class="invalid-feedback" id="istovriti_msg">
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">দক্ষিনা:</label>
                      <input type="number" class="form-control" id="dokkhina" placeholder="0.00">
                      <div class="invalid-feedback" id="dokkhina_msg">
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">সংগঠনী:</label>
                      <input type="number" class="form-control" id="songothoni" placeholder="0.00">
                      <div class="invalid-feedback" id="songothoni_msg">
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">প্রনামী:</label>
                      <input type="number" class="form-control" id="pronami" placeholder="0.00">
                      <div class="invalid-feedback" id="pronami_msg">
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">প্রচার ও প্রকাশন:</label>
                      <input type="number" class="form-control" id="advertisement" placeholder="0.00">
                      <div class="invalid-feedback" id="advertisement_msg">
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">শ্রীমন্দির নির্মান:</label>
                      <input type="number" class="form-control" id="mandir_construction" placeholder="0.00">
                      <div class="invalid-feedback" id="mandir_construction_msg">
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">কৃষ্টি বান্ধব:</label>
                      <input type="number" class="form-control" id="kristi_bandhob" placeholder="0.00">
                      <div class="invalid-feedback" id="kristi_bandhob_msg">
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">শ্রী শ্রী ঠাকুর ভোগ:</label>
                      <input type="number" class="form-control" id="sri_thakur_vog" placeholder="0.00">
                      <div class="invalid-feedback" id="sri_thakur_vog_msg">
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">আনন্দ বাজার:</label>
                      <input type="number" class="form-control" id="ananda_bazar" placeholder="0.00">
                      <div class="invalid-feedback" id="ananda_bazar_msg">
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">বিবিধ:</label>
                      <input type="number" class="form-control" id="various" placeholder="0.00">
                      <div class="invalid-feedback" id="various_msg">
                      </div>
                    </div>
                  </div>
                  
                  
                </div>
                <div class="row">
                  <div class="col-12">
                    <p class="mt-2">ঋত্বিকী</p>
                  </div>
                  {{-- <div class="col-6">
                    <button onclick="event.preventDefault()" class="btn btn-primary float-right mb-1" id="add-rittiki">যুক্ত করুন</button>
                  </div> --}}
                    <div class="table-responsive">
                      <table class="table table-sm text-center">
                        <tbody id="render_rittiki">
                         
                        </tbody>
                      </table>
                    </div>
                    <button class="btn ml-2 btn-primary" onclick="event.preventDefault();newRittiki()"><i class="fa fa-plus"></i></button>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label text-center d-block">মোট:</label>
                    <input type="number" disabled class="form-control" id="total" placeholder="0.00">
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="Clear()">Close</button>
              <button type="button" class="btn btn-primary" onclick="event.preventDefault();formRequest()">Save</button>
            </div>
          </div>
        </div>
      </div>
      {{-- endmodal --}}
      {{-- donor modal --}}
      <div id="modal2" class="modal fade" role="dialog" style="z-index: 1600;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">নতুন দাতা</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="Clear()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">নাম:</label>
                    <input type="text" class="form-control" id="name" placeholder="নাম লিখুন">
                    <div class="invalid-feedback" id="name_msg">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">ঠিকানা:</label>
                    <input type="text" class="form-control" id="adress" placeholder="ঠিকানা">
                    <div class="invalid-feedback" id="adress_msg">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">মোবাইল:</label>
                    <input type="number" class="form-control" id="mobile" placeholder="মোবাইল">
                    <div class="invalid-feedback" id="mobile_msg">
                    </div>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="Clear()">Close</button>
              <button type="button" class="btn btn-primary" onclick="event.preventDefault();donorRequest()">Save</button>
            </div>     
          </div>
        </div>
      </div>
      {{-- end donor modal --}}
      {{-- rittiki modal --}}
      {{-- <div id="modal3" class="modal fade" role="dialog" style="z-index: 1600;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">নতুন ঋত্বিকী</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="Clear()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">নাম:</label>
                    <input type="text" class="form-control" id="rittiki-name" placeholder="নাম লিখুন">
                    <div class="invalid-feedback" id="name_msg">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">ঠিকানা:</label>
                    <input type="text" class="form-control" id="rittiki-adress" placeholder="ঠিকানা">
                    <div class="invalid-feedback" id="adress_msg">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">মোবাইল:</label>
                    <input type="number" class="form-control" id="rittiki-mobile" placeholder="মোবাইল">
                    <div class="invalid-feedback" id="mobile_msg">
                    </div>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="Clear()">Close</button>
              <button type="button" class="btn btn-primary" onclick="event.preventDefault();rittikiRequest()">Save</button>
            </div>     
          </div>
        </div>
      </div> --}}
      {{-- end donor modal --}}
    </section>
  @endsection
  @section('script')
  <script src="{{('storage/adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{('storage/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{('storage/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{('storage/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  @include('backend.collection.internal-assets.js.script')
  @endsection