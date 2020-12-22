
        var updatestatus = $(".updatestatus").val();
                 alert(updatestatus);
          $(document).ready(function() {


          $(".updatestatus").click(function() {
                

            var updatestatus = $(this).val();
            var imageid = $(this).attr('data-imageid');
            var _token   = $('meta[name="csrf-token"]').attr('content');
            //var $imageid = $(this).val();
              //   alert(imageid);
                $.ajax({

                      cache: false,
                       async: "false",
                  url:"{{ url('ajaxupdate')}}",
                  type:"POST",
                      //dataType: 'JSON',
                  data: {
                    imageid:imageid,
                    updatestatus:updatestatus,
                    _token:_token,                

                    },    
                    success: function (res) {
                    //$('#imageid_'+imageid).value(res.data.image_status);
                    $('#msg').html(res.data.imageName+" is changed to "+res.data.visible).fadeIn('slow');
                     $('#msg').delay(3000).fadeOut('slow');
                       $('#ajaxdiv').html(res.data.html);


                        
                    },              

                   
                  });
             });
           });  


$(".delete").click(function(e) {
  let deleteimg = $(this).val();
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      cache: false,
           async: "false",
              url:"{{ url('ajaxDelete')}}",
              type:"POST",
              data: {
                    imageid:deleteimg,
                    _token:_token,                

                    },
                    success: function (res) {
                    //  console.log(res);
                  $('#msg').html(res.data.imageName+" is deleted, please refresh the page ").fadeIn('slow');
                    $('#msg').delay(3000).fadeOut('slow');

                  //  $('#ajaxdiv').html('i am here');



                        
                    },  


    });

  //alert(deleteimg );
});




 