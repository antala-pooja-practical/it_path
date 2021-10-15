$(document).ready(function () {
     
    $('#product_listing').DataTable();
    
    //product delete
    $('.deleteProduct').click(function(){
       var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
       $.ajax({
           url:getsiteurl()+'/product/destory',
           method:'DELETE',
           data:{_token:CSRF_TOKEN,productId:$(this).attr('id')},
           success:function(r){
               if(r){
                   alert('Product deleted successfully...');
                   location.reload();
               }
           }
       })
    });
    
    //product order change
    $( "#productListing-body" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
        });

        function sendOrderToServer() {
          var order = [];
          var token = $('meta[name="csrf-token"]').attr('content');
          $('tr.row1').each(function(index,element) {
            order.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });

          $.ajax({
            type: "POST", 
            dataType: "json", 
            url: getsiteurl()+'/product-sortable',
            data: {
              order: order,
              _token: token
            },
            success: function(response) {console.log(response);
                if (response.status == "success") {
                  console.log(response);
                } else {
                  console.log(response);
                }
            }
          });
        }
});