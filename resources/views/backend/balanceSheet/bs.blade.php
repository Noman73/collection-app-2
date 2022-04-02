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
            <h1 class="m-0">ব্যালেন্স শিট</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">হোম</a></li>
              <li class="breadcrumb-item active">ব্যালেন্স শিট</li>
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
                <div class="col-md-3 col-12">
                    <button class="btn btn-sm btn-primary" onclick="loadData()">Apply </button>
                </div>
              </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      Featured
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>তারিখ</th>
                                    <th>বিষয়</th>
                                    <th>আয়</th>
                                    <th>ব্যয়</th>
                                    <th>ব্যালেন্স</th>
                                </tr>
                            </thead>
                            <tbody id="data">
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                    </div>
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
    $.post("{{URL::to('/balance_sheet_data')}}",{fromDate:fromDate,toDate:toDate,_token:"{{csrf_token()}}"})
    .then(res=>{
      console.log(res);
      table="";
      balance=0;
        console.log(table)
      res.forEach(function(d){
          balance+=(parseFloat(d.total)-parseFloat(d.expence))
        table+="<tr>";
        table+="<td>"+d.created_at+"</td>";
        table+="<td>"+d.names+"</td>";
        table+="<td>"+d.total+"</td>";
        table+="<td>"+d.expence+"</td>";
        table+="<td>"+(balance).toFixed(2)+"</td>";
        table+="</tr>";
      })
      table+="<tr><th colspan='4' class='text-right'>Balance=</th><th>"+(balance).toFixed(2)+"</th>";
        table+="</tr>";
      $('#data').html(table);
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