
{{-- -------------------script--------------------- --}}

<script>
  $('#exampleModalLabel').show();
  $('#ModalLabel').hide();
  $('#butup').hide();
  $('#butsave').show();

  function hideModal() {
    $("#myModal").removeClass("in");
    $(".modal-backdrop").remove();
    $("#myModal").hide();
  }
  function cleardata(){
  $('#exampleModalLabel').show();
  $('#ModalLabel').hide();
  $('#butup').hide();
  $('#butsave').show();
    clear();
  }

// ------------------------getdata----------
function getData(){
$.ajax({

type:"GET",
datatype:"json",
url:'/customer/data',
success:function(response){
    var data=""
    $.each(response,function(key,value){
        data = data + "<tr>"
            data = data + "<td>"+value.cus_name+"</td>"
            data = data + "<td>"+value.company_name+"</td>"
            data = data + "<td>"+value.cus_email+"</td>"
            data = data + "<td>"+value.phone+"</td>"
            data = data + "<td>"+value.tax_no+"</td>"
            data = data + "<td>"+value.address+"</td>"
            data = data + "<td>"+value.city+"</td>"
            data = data + "<td>"+value.state+"</td>"
            data = data + "<td>"+value.postal_code+"</td>"
            data = data + "<td>"+value.country+"</td>"
            data = data + "<td>"
            data = data + "<button class='btn btn-sm btn-primary mr-2' onclick='editData("+value.id+")' data-toggle='modal' data-target='#myModal'>Edit</button>"
            data = data + "<button class='btn btn-sm btn-danger mr-2' onclick='Delete("+value.id+")'>Delete</button>"
            data = data + "</td>"
        data = data + "</tr>"
        
    })
    
    $('tbody').html(data);

}
})
}
getData();

// ----------cleardata---------
function clear(){
          $('#nError').text('');
          $('#eError').text('');
          $('#cError').text('');
          $('#pError').text('');
          $('#tError').text('');
          $('#aError').text('');
          $('#ciError').text('');
          $('#sError').text('');
          $('#poError').text('');
          $('#cuError').text('');

          $('#name').val('');
          $('#companyname').val('');
          $('#mail').val('');
          $('#phone').val('');
          $('#tax').val('');
          $('#address').val('');
          $('#city').val('');
          $('#state').val('');
          $('#postalcode').val('');
          $('#country').val('');            
}

// ------------------------------Insert------------------

function addData(){

   $('#nError').text('');
   $('#eError').text('');
   $('#cError').text('');
   $('#pError').text('');
   $('#tError').text('');
   $('#aError').text('');
   $('#ciError').text('');
   $('#sError').text('');
   $('#poError').text('');
   $('#cuError').text('');


var name=  $('#name').val();
var companyname= $('#companyname').val();
var mail= $('#mail').val();
var phone= $('#phone').val();
var tax= $('#tax').val();
var address= $('#address').val();
var city= $('#city').val();
var state= $('#state').val();
var postalcode= $('#postalcode').val();
var country= $('#country').val();
$.ajax({
type:"post",
datatype:"json",
data:{name:name,mail:mail,companyname:companyname,phone:phone,tax:tax,
address:address,city:city,state:state,postalcode:postalcode,country:country
},
headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
url:'/customer/store',
success:function(data){
   console.log("data inserted");
    clear();
    hideModal();
    getData();
    swal("Inserted!", "Data has been Successfully Insert!", "success")
},

error:function(error){
   $('#nError').text(error.responseJSON.errors.name);
   $('#eError').text(error.responseJSON.errors.mail);
   $('#cError').text(error.responseJSON.errors.companyname);
   $('#pError').text(error.responseJSON.errors.phone);
   $('#tError').text(error.responseJSON.errors.tax);
   $('#aError').text(error.responseJSON.errors.address);
   $('#ciError').text(error.responseJSON.errors.city);
   $('#sError').text(error.responseJSON.errors.state);
   $('#poError').text(error.responseJSON.errors.postalcode);
   $('#cuError').text(error.responseJSON.errors.country);
  
}

})

}
// ------------------------------Insertend------------------


//  ----------------------------edit data-----------------------------
function editData(id){
$.ajax({
type:"GET",
datatype:"json",
url:"/customer/edit/"+id,
success:function(data){
      $('#exampleModalLabel').hide();
      $('#ModalLabel').show();
      $('#butup').show();
      $('#butsave').hide();

      $('#id').val(data.id);
      $('#name').val(data.cus_name);
      $('#mail').val(data.cus_email);
      $('#companyname').val(data.company_name);
      $('#phone').val(data.phone);
      $('#tax').val(data.tax_no);
      $('#address').val(data.address);
      $('#city').val(data.city);
      $('#state').val(data.state);
      $('#postalcode').val(data.postal_code);
      $('#country').val(data.country);
}
})   
}
//  ----------------------------editEnd-----------------------------


// -------------------------------updatedata-----------------

function updateData(){
  $('#nError').text('');
   $('#eError').text('');
   $('#cError').text('');
   $('#pError').text('');
   $('#tError').text('');
   $('#aError').text('');
   $('#ciError').text('');
   $('#sError').text('');
   $('#poError').text('');
   $('#cuError').text('');

var id=  $('#id').val();
var name=  $('#name').val();
var companyname= $('#companyname').val();
var mail= $('#mail').val();
var phone= $('#phone').val();
var tax= $('#tax').val();
var address= $('#address').val();
var city= $('#city').val();
var state= $('#state').val();
var postalcode= $('#postalcode').val();
var country= $('#country').val();

$.ajax({
type:"post",
datatype:"json",
data:{name:name,mail:mail,companyname:companyname,phone:phone,tax:tax,
address:address,city:city,state:state,postalcode:postalcode,country:country
},
headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
url:"/customer/update/"+id,
success:function(data){
  $('#exampleModalLabel').show();
  $('#ModalLabel').hide();
  $('#butup').hide();
  $('#butsave').show();
  clear();
  hideModal();
  getData();
  swal("Updated!", "Data has been Successfully Updated!", "success")

},

error:function(error){
   $('#nError').text(error.responseJSON.errors.name);
   $('#eError').text(error.responseJSON.errors.mail);
   $('#cError').text(error.responseJSON.errors.companyname);
   $('#pError').text(error.responseJSON.errors.phone);
   $('#tError').text(error.responseJSON.errors.tax);
   $('#aError').text(error.responseJSON.errors.address);
   $('#ciError').text(error.responseJSON.errors.city);
   $('#sError').text(error.responseJSON.errors.state);
   $('#poError').text(error.responseJSON.errors.postalcode);
   $('#cuError').text(error.responseJSON.errors.country);
  
}
})
}
// -------------------------------updatedataend-----------------


// ---------------------------------Delete--------------------
function Delete(id){
swal({
  title: "Are you sure Want to delete?",
  text: "Once Delete, This will be Permanently Delete!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
if (willDelete) {           
  $.ajax({
      type:"get",
      datatype:"json",
      url:"/customer/delete/"+id,
      success:function(response){
      getData();
    
      }
  })  
     swal("Deleted!", "Data has been Successfully Deleted!", "success");
}
else {
swal("Safe Data!");
}
});
}
// ---------------------------------DeleteEND--------------------

// ----------------------------------searchdata-----------------------------

          function search() {
                var search=$('#search').val();
                if(search){
                $('#adata').show();
                $('#gdata').hide();
                }else{
                $('#adata').hide();
                $('#gdata').show();
                }
                $.ajax({
                type:"post",
                url:"/search",
                data:{
                search:search,          
                },
                  headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                  datatype:"json",
                  success:function(data){        
                  $('#success').html(data);

          }
          })
          }

// ----------------------------------searchdataend-----------------------------

</script>
