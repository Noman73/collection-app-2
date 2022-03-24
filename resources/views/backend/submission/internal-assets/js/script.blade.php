<script>
  var datatable;
  $(document).ready(function(){
        datatable= $('#datatable').DataTable({
        processing:true,
        serverSide:true,
        responsive:true,
        ajax:{
          url:"{{route('submission.index')}}"
        },
        columns:[
          {
            data:'DT_RowIndex',
            name:'DT_RowIndex',
            orderable:false,
            searchable:false
          },
          {
            data:'collector',
            name:'collector',
          },
          {
            data:'ammount',
            name:'ammount',
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
    let collector=$('#collector').val();
    let ammount=$('#ammount').val();
    let comment=$('#comment').val();
    let id=$('#id').val();
    let formData= new FormData();
    formData.append('collector',collector);
    formData.append('ammount',ammount);
    formData.append('comment',comment);
    $('#exampleModalLabel').text('জমা করুন');
    if(id!=''){
      formData.append('_method','PUT');
    }
    //axios post request
    if (id==''){
         axios.post("{{route('submission.store')}}",formData)
        .then(function (response){
            if(response.data.message){
                toastr.success(response.data.message)
                datatable.ajax.reload();
                today=new Date();
                date=today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();;
                printStatement('{{auth()->user()->name}}','{{auth()->user()->adress}}','{{auth()->user()->mobile}}',ammount,comment,date)
                setTimeout(() => {
                  clear();
                }, 250);
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
      axios.post("{{URL::to('submission/')}}/"+id,formData)
        .then(function (response){
          if(response.data.message){
              toastr.success(response.data.message);
              datatable.ajax.reload();
              clear();
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
    clear();
    $('#exampleModalLabel').text('জমা নিন');

});
$(document).delegate(".editRow", "click", function(){
    $('#exampleModalLabel').text('জমা হালনাগাত করুন');
    let route=$(this).data('url');
    axios.get(route)
    .then((data)=>{
      var editKeys=Object.keys(data.data);
      editKeys.forEach(function(key){
        if(key=='name'){
          $('#'+'name').val(data.data[key]);
        }
        if(key=='category_id'){
          $('#category').val(data.data[key]).niceSelect('update');
        }
        $('#'+key).val(data.data[key]);
        if(key=='collector'){
          $('#collector').html("<option value='"+data.data.collector_id+"'>"+data.data.collector.name+"</option")
        }
         $('#modal').modal('show');
         $('#id').val(data.data.id);
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

$(document).delegate(".dataView", "click", function(){
  let route=$(this).data('url');
  console.log(route)
  axios.get(route)
  .then((res)=>{
    date= new Date(Date.parse(res.data.created_at));
    date=date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate();;
    printStatement(res.data.author.name,res.data.author.adress,res.data.author.mobile,res.data.ammount,(res.data.comment==null ? '' : res.data.comment),date)
    console.log(res)
  })
});
function clear(){
  $("input").removeClass('is-invalid').val('');
  $(".invalid-feedback").text('');
  $('form select').val('').trigger('change');
  $('input').val('');
}

$('#collector').select2({
    theme:'bootstrap4',
    placeholder:'select',
    allowClear:true,
    ajax:{
      url:"{{URL::to('/get-collector')}}",
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

function statement(name,adress,mobile,ammount,comment,date)
{
  console.log(name)
  // name="{{auth()->user()->name}}";
  // adress="{{auth()->user()->adress}}";
  // mobile="{{auth()->user()->mobile}}";
  // ammount=$('#ammount').val();
  // comment=$('#comment').val();
  // today=new Date();
  let html=`<h4 class='text-center'>অর্ঘ্য-প্রস্বস্তি</h4><hr/>
            <table class='table table-sm'>
              <tr>
                <td>তারিখঃ</td>
                <td> `+date+`</td>
              </tr>
              <tr>
                <td>সংগ্রহকারির নামঃ</td>
                <td> `+name+`</td>
              </tr>
              <tr>
                <td>ঠিকানাঃ</td>
                <td> `+adress+`</td>
              </tr>
              <tr>
                <td>মোবাইলঃ </td>
                <td> `+mobile+`</td>
              </tr>
              <tr>
                <td>টাকার পরিমানঃ</td>
                <td> `+ammount+`</td>
              </tr>
            </table>
            <div><strong>মন্তব্যঃ</strong> <span>`+comment+`</span></div>
            `
  return html;
}


function printStatement(name,adress,mobile,ammount,comment,date){
  data=`<div class="modal fade" id="statementModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="container">
                  `+statement(name,adress,mobile,ammount,comment,date)+`
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>`
    $('#statement').html(data);
    $('#statementModal').modal('show');
}




</script>
