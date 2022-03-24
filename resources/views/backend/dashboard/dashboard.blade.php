 <!-- Content Wrapper. Contains page content -->
 @php
 use Rakibhstu\Banglanumber\NumberToBangla;
 $bangla=new NumberToBangla;
 @endphp
 @extends('layouts.master')
 @section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ড্যাশবোর্ড</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">হোম</a></li>
              <li class="breadcrumb-item active">ড্যাশবোর্ড</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="row">
                <div class="col-md-3 col-12">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-sm" id="fromDate" placeholder="From Date">
                  </div>
                </div>
                <div class="col-md-3 col-12">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-sm" id="toDate" placeholder="To Date">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3 id="istovriti">{{$bangla->bnNum(number_format($data->sum('istovriti'),2,'.',''))}}</h3>
                  <p><strong>ইষ্টভৃতি</strong></p>
                </div>
                <div class="icon">
                  <i class="fa fa-money-bill-wave"></i>
                </div>
                <a href="{{URL::to('/collection')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3 id="sostoyoni">{{$bangla->bnNum(number_format($data->sum('sostoyoni'),2,'.',''))}}</h3>
                  <p><strong>স্বস্ত্যয়নী</strong></p>
                </div>
                <div class="icon">
                  <i class="fa fa-money-bill-wave"></i>
                </div>
                <a href="{{URL::to('/collection')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3 id="dokkhina">{{$bangla->bnNum(number_format($data->sum('dokkhina'),2,'.',''))}}</h3>
                  <p><strong>দক্ষিনা</strong></p>
                </div>
                <div class="icon">
                  <i class="fa fa-money-bill-wave"></i>
                </div>
                <a href="{{URL::to('/collection')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3 id="songothoni">{{$bangla->bnNum(number_format($data->sum('songothoni'),2,'.',''))}}</h3>
                  <p><strong>সংগঠনী</strong></p>
                </div>
                <div class="icon">
                  <i class="fa fa-money-bill-wave"></i>
                </div>
                <a href="{{URL::to('/collection')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3 id="pronami">{{$bangla->bnNum(number_format($data->sum('pronami'),2,'.',''))}}</h3>
                  <p><strong> প্রনামী</strong></p>
                </div>
                <div class="icon">
                  <i class="fa fa-money-bill-wave"></i>
                </div>
                <a href="{{URL::to('/collection')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-dark">
                <div class="inner">
                  <h3 id="advertise">{{$bangla->bnNum(number_format($data->sum('advertise'),2,'.',''))}}</h3>
                  <p><strong>বিজ্ঞাপন</strong></p>
                </div>
                <div class="icon">
                  <i class="fa fa-money-bill-wave"></i>
                </div>
                <a href="{{URL::to('/collection')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3 id="mandir_construction">{{$bangla->bnNum(number_format($data->sum('mandir_construction'),2,'.',''))}}</h3>
                  <p><strong>মন্দির তৈরী</strong></p>
                </div>
                <div class="icon">
                  <i class="fa fa-money-bill-wave"></i>
                </div>
                <a href="{{URL::to('/collection')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-muted">
                <div class="inner">
                  <h3 id="kristi_bandhob">{{$bangla->bnNum(number_format($data->sum('kristi_bandhob'),2,'.',''))}}</h3>
                  <p><strong>কৃষ্ট বান্ধব</strong></p>
                </div>
                <div class="icon">
                  <i class="fa fa-money-bill-wave"></i>
                </div>
                <a href="{{URL::to('/collection')}}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3 id="sri_thakur_vog">{{$bangla->bnNum(number_format($data->sum('sri_thakur_vog'),2,'.',''))}}</h3>
                  <p><strong>শ্রী শ্রী ঠাকুর ভোগ</strong></p>
                </div>
                <div class="icon">
                  <i class="fa fa-money-bill-wave"></i>
                </div>
                <a href="{{URL::to('/collection')}}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3 id="ananda_bazar">{{$bangla->bnNum(number_format($data->sum('ananda_bazar'),2,'.',''))}}</h3>
                  <p><strong>আনন্দ বাজার</strong></p>
                </div>
                <div class="icon">
                  <i class="fa fa-money-bill-wave"></i>
                </div>
                <a href="{{URL::to('/collection')}}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  @php 
                  $rittiki=0;
                  foreach($data as $rtk){
                    // dd($rtk);
                    $rittiki+=$rtk->totalrittik->sum('ammount');
                  }
                  @endphp
                  <h3 id="rittiki">{{$bangla->bnNum(number_format($rittiki,2,'.',''))}}</h3>
                  <p><strong> ঋত্বিকী</strong></p>
                </div>
                <div class="icon">
                  <i class="fa fa-money-bill-wave"></i>
                </div>
                <a href="{{URL::to('/collection')}}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3 id="various">{{$bangla->bnNum(number_format($data->sum('various'),2,'.',''))}}</h3>
                  <p><strong>বিবিধ</strong></p>
                </div>
                <div class="icon">
                  <i class="fa fa-money-bill-wave"></i>
                </div>
                <a href="{{URL::to('/collection')}}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            @php
            $sostoyoni=number_format($data->sum('sostoyoni'),2,'.','');
            $istovriti=number_format($data->sum('istovriti'),2,'.','');
            $dokkhina=number_format($data->sum('dokkhina'),2,'.','');
            $songothoni=number_format($data->sum('songothoni'),2,'.','');
            $pronami=number_format($data->sum('pronami'),2,'.','');
            $advertise=number_format($data->sum('advertise'),2,'.','');
            $mandir_construction=number_format($data->sum('mandir_construction'),2,'.','');
            $kristi_bandhob=number_format($data->sum('kristi_bandhob'),2,'.','');
            $sri_thakur_vog=number_format($data->sum('sri_thakur_vog'),2,'.','');
            $ananda_bazar=number_format($data->sum('ananda_bazar'),2,'.','');
            $various=number_format($data->sum('various'),2,'.','');
            $total=$sostoyoni+$istovriti+$dokkhina+$songothoni+$pronami+$advertise+$mandir_construction+$mandir_construction+$kristi_bandhob+$sri_thakur_vog+$ananda_bazar+$various+$rittiki;
            
            @endphp
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3 id="total">{{$bangla->bnNum(number_format($total,2,'.',''))}}</h3>
                  <p><strong>মোট আদায়</strong></p>
                </div>
                <div class="icon">
                  <i class="fa fa-money-bill-wave"></i>
                </div>
                <a href="{{URL::to('/collection')}}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-dark">
                <div class="inner">
                  <h3 id="total_paid">{{$bangla->bnNum(number_format($submission,2,'.',''))}}</h3>
                  <p><strong>মোট জমা</strong></p>
                </div>
                <div class="icon">
                  <i class="fa fa-money-bill-wave"></i>
                </div>
                <a href="{{URL::to('/collection')}}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3 id="total_having">{{$bangla->bnNum(number_format(($total-$submission),2,'.',''))}}</h3>
                  <p><strong>মোট টাকা আছে</strong></p>
                </div>
                <div class="icon">
                  <i class="fa fa-money-bill-wave"></i>
                </div>
                <a href="{{URL::to('/collection')}}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
      </div><!-- /.container-fluid -->
    </section>
  @endsection

  @section('script')
    <script>
      $('#fromDate,#toDate').daterangepicker({
        showDropdowns: true,
        singleDatePicker: true,
        parentEl: ".bd-example-modal-lg .modal-body",
        locale: {
            format: 'DD-MM-YYYY',
        }
  });

  function loadData(){
    let fromDate=$('#fromDate').val();
    let toDate=$('#toDate').val();
    $.post("{{URL::to('/load-data')}}",{fromDate:fromDate,toDate:toDate,_token:"{{csrf_token()}}"})
    .then(res=>{
      console.log(res);
      $('#sostoyoni').text(banglaNumberConverter(res.sostoyoni))
      $('#istovriti').text(banglaNumberConverter(res.istovriti))
      $('#dokkhina').text(banglaNumberConverter(res.dokkhina))
      $('#songothoni').text(banglaNumberConverter(res.songothoni))
      $('#pronami').text(banglaNumberConverter(res.pronami))
      $('#advertise').text(banglaNumberConverter(res.advertise))
      $('#mandir_construction').text(banglaNumberConverter(res.mandir_construction))
      $('#various').text(banglaNumberConverter(res.various))
      $('#kristi_bandhob').text(banglaNumberConverter(res.kristi_bandhob))
      $('#sri_thakur_vog').text(banglaNumberConverter(res.sri_thakur_vog))
      $('#ananda_bazar').text(banglaNumberConverter(res.ananda_bazar))
      $('#rittiki').text(banglaNumberConverter((res.rittiki).toString()))
      $('#total').text(banglaNumberConverter((res.total).toString()))
      $('#total_paid').text(banglaNumberConverter((res.total_paid).toString()))
      $('#total_having').text(banglaNumberConverter((res.total_having).toString()))
    })
  }
  $(document).on('change','#fromDate,#toDate',function(){
        loadData();
  })


  function banglaNumberConverter(english_number){
    var finalEnglishToBanglaNumber = {
   0: "০",
   1: "১",
   2: "২",
   3: "৩",
   4: "৪",
   5: "৫",
   6: "৬",
   7: "৭",
   8: "৮",
   9: "৯",
};

String.prototype.getDigitBanglaFromEnglish = function () {
   var retStr = this;
   for (var x in finalEnglishToBanglaNumber) {
      retStr = retStr.replace(
         new RegExp(x, "g"),
         finalEnglishToBanglaNumber[x]
      );
   }
   return retStr;
};



var bangla_converted_number = ((parseFloat(english_number).toFixed(2)).toString()).getDigitBanglaFromEnglish(); 

//outputs : ১২৩৪৫৬

return bangla_converted_number; //or alert(bangla_converted_number);

// another reference
// https://stackoverflow.com/questions/30629242/javascript-replace-to-english-number
  }
  </script>
  @endsection