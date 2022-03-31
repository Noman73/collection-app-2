<script>
  var datatable
  $(document).ready(function(){
        datatable= $('#datatable').DataTable({
        processing:true,
        serverSide:true,
        responsive:true,
        ajax:{
          url:"{{route('collection.index')}}"
        },
        columns:[
          {
            data:'DT_RowIndex',
            name:'DT_RowIndex',
            orderable:false,
            searchable:false
          },
          {
            data:'name',
            name:'name',
          },
          {
            data:'sostoyoni',
            name:'sostoyoni',
          },
          {
            data:'istovriti',
            name:'istovriti',
          },
          {
            data:'dokkhina',
            name:'dokkhina',
          },
          {
            data:'songothoni',
            name:'songothoni',
          },
          {
            data:'pronami',
            name:'pronami',
          },
          {
            data:'advertise',
            name:'advertise',
          },
          {
            data:'mandir_construction',
            name:'mandir_construction',
          },
          {
            data:'kristi_bandhob',
            name:'kristi_bandhob',
          },
          {
            data:'sri_thakur_vog',
            name:'sri_thakur_vog',
          },
          {
            data:'ananda_bazar',
            name:'ananda_bazar',
          },
          {
            data:'various',
            name:'various',
          },
          {
            data:'totalrittik',
            name:'totalrittik',
          },
          {
            data:'total',
            name:'total',
          },
          {
            data:'adress',
            name:'adress',
          },
          {
            data:'action',
            name:'action',
          }
        ]
    });
  })
    

window.formRequest= function(){
    $('input,select').removeClass('is-invalid');
    let donor=$('#donor').val();
    let sostoyoni=$('#sostoyoni').val();
    let istovriti=$('#istovriti').val();
    let dokkhina=$('#dokkhina').val();
    let songothoni=$('#songothoni').val();
    let pronami=$('#pronami').val();
    let advertisement=$('#advertisement').val();
    let mandir_construction=$('#mandir_construction').val();
    let kristi_bandhob=$('#kristi_bandhob').val();
    let sri_thakur_vog=$('#sri_thakur_vog').val();
    let ananda_bazar=$('#ananda_bazar').val();
    let various=$('#various').val();
    let rittiki = $("select[name='rittiki[]']")
                  .map(function(){return $(this).val();}).get();
    let rittiki_ammount = $("input[name='rittiki_ammount[]']")
                  .map(function(){return $(this).val();}).get();
    console.log(donor,sostoyoni,istovriti,dokkhina,songothoni,pronami,advertisement,mandir_construction,various,rittiki,rittiki_ammount);
 
    let id=$('#id').val();
    let formData= new FormData();
    formData.append('donor',donor);
    formData.append('sostoyoni',sostoyoni);
    formData.append('istovriti',istovriti);
    formData.append('dokkhina',dokkhina);
    formData.append('songothoni',songothoni);
    formData.append('pronami',pronami);
    formData.append('advertisement',advertisement);
    formData.append('mandir_construction',mandir_construction);
    formData.append('various',various);
    formData.append('rittiki',rittiki);
    formData.append('rittiki_ammount',rittiki_ammount);
    formData.append('kristi_bandhob',kristi_bandhob);
    formData.append('sri_thakur_vog',sri_thakur_vog);
    formData.append('ananda_bazar',ananda_bazar);
    $('#exampleModalLabel').text('কালেকশন হালনাগাত করুন');
    if(id!=''){
      let rel_no = $("input[name='rel_no[]']")
                  .map(function(){return $(this).val();}).get();
      formData.append('_method','PUT');
      formData.append('rel_no',rel_no);
    }
    //axios post request
    if (id==''){
         axios.post("{{route('collection.store')}}",formData)
        .then(function (response){
          console.log(response)
            if(response.data.message){
                toastr.success(response.data.message)
                datatable.ajax.reload();
                Clear();
                $('#modal').modal('hide');
            }else if(response.data.error){
              var keys=Object.keys(response.data.error);
              keys.forEach(function(d){
                $('#'+d).addClass('is-invalid');
                $('#'+d+'_msg').text(response.data.error[d][0]);
              })
            }
        })
    }else{
      axios.post("{{URL::to('collection/')}}/"+id,formData)
        .then(function (response){
          if(response.data.message){
              toastr.success(response.data.message);
              datatable.ajax.reload();
              Clear();
          }else if(response.data.error){
              var keys=Object.keys(response.data.error);
              keys.forEach(function(d){
                $('#'+d).addClass('is-invalid')
                $('#'+d+'_msg').text(response.data.error[d][0]);
              })
            }
        })
    }
}
$(document).delegate("#modalBtn", "click", function(event){
    Clear();
    $('#exampleModalLabel').text('নতুন কালেকশন যুক্ত করুন');
});
$(document).delegate(".editRow", "click", function(){
    countRittiki=0;
    $('#render_rittiki').empty();
    $('#exampleModalLabel').text('কালেকশন হালনাগাত করুন');
    let route=$(this).data('url');
    axios.get(route)
    .then((data)=>{
      console.log(data.data)
      console.log(data.data.donor.name)
      var editKeys=Object.keys(data.data);
      editKeys.forEach(function(key){
        if(key=='advertise'){
          $('#advertisement').val(data.data[key]);
        }
         $('#'+key).val(data.data[key]);
        if(key=='donor'){
          $('#donor').html("<option value='"+data.data.donor_id+"'>"+data.data.donor.name+"</option>");
        }
         $('#modal').modal('show');
         $('#id').val(data.data.id);
         if(key=='rittik'){
           index=0;
           data.data[key].forEach(function(d){
             console.log(d)
             editRittiki(d.id);
             console.log('#rittiki'+index,d.ammount)
              $('#rittiki'+index).html("<option value='"+d.rittiki.id+"'>"+d.rittiki.name+"</option>");
              $('#rittiki_ammount'+index).val(d.ammount);
             index=index+1
           })
         }
      })
    })
});
$(document).delegate(".deleteRow", "click", function(){
    let route=$(this).data('url');
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value==true) {
        axios.delete(route)
        .then((data)=>{
          if(data.data.message){
            toastr.success(data.data.message);
            datatable.ajax.reload();
          }else if(data.data.warning){
            toastr.error(data.data.warning);
          }
        })
      }
    })
});
function Clear(){
  countRittiki=0;
  $("input").removeClass('is-invalid').val('');
  $(".invalid-feedback").text('');
  $('form select').val('').trigger('change');
  $('input').val('');
  $('#render_rittiki').empty()
  newRittiki();
}

// $('#donor').select2({
//   'theme':'bootstrap4',
// })

$('#donor').select2({
    theme:'bootstrap4',
    placeholder:'select',
    allowClear:true,
    ajax:{
      url:"{{URL::to('/get-donor')}}",
      type:'post',
      dataType:'json',
      delay:20,
      data:function(params){
        return {
          searchTerm:params.term,
          _token:"{{csrf_token()}}",
          }
      },
      processResults:function(response){
        return {
          results:response,
        }
      },
      cache:true,
    }
  })
  var countRittiki=0;
  function newRittiki(){
    html=`<tr>
            <td width="65%"><select class="form-control rittiki" name="rittiki[]" id="rittiki`+countRittiki+`"><option value="">select</option></select></td>
            <td width="20%"><input type="number" class="form-control rittiki_ammount" name="rittiki_ammount[]" id="rittiki_ammount`+countRittiki+`" placeholder="0.00"></td>
            <td width="15%"><button class="btn  btn-danger" onclick="removeRittik(this)">X</button></td>
          </tr>`
          $('#render_rittiki').append(html);
    $(".rittiki").select2({
    theme:'bootstrap4',
    placeholder:'select',
    allowClear:true,
    ajax:{
      url:"{{URL::to('/get-rittiki')}}",
      type:'post',
      dataType:'json',
      delay:20,
      data:function(params){
        return {
          searchTerm:params.term,
          _token:"{{csrf_token()}}",
          }
      },
      processResults:function(response){
        return {
          results:response,
        }
      },
      cache:true,
    }
  })
    countRittiki+=1;
  }
  function editRittiki(val){
    html=`<tr>
            <td width="65%"><input type="hidden" value="`+val+`" name="rel_no[]"><select class="form-control rittiki" name="rittiki[]" id="rittiki`+countRittiki+`"><option value="">select</option></select></td>
            <td width="20%"><input type="number" class="form-control rittiki_ammount" name="rittiki_ammount[]" id="rittiki_ammount`+countRittiki+`" placeholder="0.00"></td>
            <td width="15%"><button class="btn  btn-danger" onclick="removeRittik(this)">X</button></td>
          </tr>`
          $('#render_rittiki').append(html);
    $(".rittiki").select2({
    theme:'bootstrap4',
    placeholder:'select',
    allowClear:true,
    ajax:{
      url:"{{URL::to('/get-rittiki')}}",
      type:'post',
      dataType:'json',
      delay:20,
      data:function(params){
        return {
          searchTerm:params.term,
          _token:"{{csrf_token()}}",
          }
      },
      processResults:function(response){
        return {
          results:response,
        }
      },
      cache:true,
    }
  })
  countRittiki+=1;
  }
 $(document).ready(function(){
    newRittiki();
 })
  function removeRittik(val){
    $(val).parent().parent().remove();
  }
function totalCount(){
  sostoyoni=parseInt($('#sostoyoni').val());
  istovriti=parseInt($('#istovriti').val());
  dokkhina=parseInt($('#dokkhina').val());
  songothoni=parseInt($('#songothoni').val());
  pronami=parseInt($('#pronami').val());
  advertisement=parseInt($('#advertisement').val());
  mandir_construction=parseInt($('#mandir_construction').val());
  various=parseInt($('#various').val());
  kristi_bandhob=parseInt($('#kristi_bandhob').val());
  sri_thakur_vog=parseInt($('#sri_thakur_vog').val());
  ananda_bazar=parseInt($('#ananda_bazar').val());
  rittiki_ammount=0;
  (isNaN(sostoyoni) ? sostoyoni=0 : sostoyoni);
  (isNaN(istovriti) ? istovriti=0 : istovriti);
  (isNaN(dokkhina) ? dokkhina=0 : dokkhina);
  (isNaN(songothoni) ? songothoni=0 : songothoni);
  (isNaN(pronami) ? pronami=0 : pronami);
  (isNaN(advertisement) ? advertisement=0 : advertisement);
  (isNaN(mandir_construction) ? mandir_construction=0 : mandir_construction);
  (isNaN(kristi_bandhob) ? kristi_bandhob=0 : kristi_bandhob);
  (isNaN(sri_thakur_vog) ? sri_thakur_vog=0 : sri_thakur_vog);
  (isNaN(ananda_bazar) ? ananda_bazar=0 : ananda_bazar);
  (isNaN(various) ? various=0 : various);
  console.log(sostoyoni,istovriti,dokkhina,songothoni,pronami,advertisement,mandir_construction,various)
  total_ammount=sostoyoni+istovriti+dokkhina+songothoni+pronami+advertisement+mandir_construction+kristi_bandhob+sri_thakur_vog+ananda_bazar+various;
  $("input[name='rittiki_ammount[]']")
  .map(function(){
    amount=parseInt($(this).val());
    if(isNaN(amount)){
      amount=0;
    }
    // console.log($(this).val());
    rittiki_ammount+= amount;
    $('#total').val((total_ammount+rittiki_ammount).toFixed(2));
  });
}
$(document).on('change keyup','input',function(){
  totalCount()
})

$(document).ready(function(){
    $("#add-donor").click(function(){
        $("#modal2").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
});
$(document).ready(function(){
    $("#add-rittiki").click(function(){
        $("#modal3").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
});

// donor request
window.donorRequest= function(){
    $('input,select').removeClass('is-invalid');
    let name=$('#name').val();
    let adress=$('#adress').val();
    let mobile=$('#mobile').val();
    let formData= new FormData();
    formData.append('name',name);
    formData.append('adress',adress);
    formData.append('mobile',mobile);
    formData.append('_token','{{csrf_token()}}')
    //axios post request
         axios.post("{{route('donor.store')}}",formData)
        .then(function (response){
          console.log(response)
            if(response.data.message){
                toastr.success(response.data.message)
                datatable.ajax.reload();
                Clear();
                $('#modal2').modal('hide');
            }else if(response.data.error){
              var keys=Object.keys(response.data.error);
              keys.forEach(function(d){
                $('#'+d).addClass('is-invalid');
                $('#'+d+'_msg').text(response.data.error[d][0]);
              })
            }
        })
}

// window.rittikiRequest= function(){
//     $('input,select').removeClass('is-invalid');
//     let rittiki_name=$('#rittiki-name').val();
//     let rittiki_adress=$('#rittiki-adress').val();
//     let rittiki_mobile=$('#rittiki-mobile').val();
//     let formData= new FormData();
//     formData.append('name',rittiki_name);
//     formData.append('adress',rittiki_adress);
//     formData.append('mobile',rittiki_mobile);
//     formData.append('_token','{{csrf_token()}}')
//     //axios post request
//          axios.post("{{route('rittiki.store')}}",formData)
//         .then(function (response){
//           console.log(response)
//             if(response.data.message){
//                 toastr.success(response.data.message)
//                 datatable.ajax.reload();
//                 Clear();
//                 $('#modal3').modal('hide');
//             }else if(response.data.error){
//               var keys=Object.keys(response.data.error);
//               keys.forEach(function(d){
//                 $('#'+d).addClass('is-invalid');
//                 $('#'+d+'_msg').text(response.data.error[d][0]);
//               })
//             }
//         })
// }
</script>
