 <?php include("db/dbcon.php"); 
 include("functions.php"); 
 session_start();
 error_reporting(0);
 
  $sales_no = $_GET["sales_no"];
  $sales_id = get_title(sales_id,$sales_no,$dbconfig)
 ?>

			<form id="saleform" method="post">
			
				<input type="hidden" name="sales_no" value="<?php echo $sales_no; ?>" />
			
						<div class="form-group">
							<label for="date">Total</label>
							
								<input type="text" style="text-align:right" class="form-control" id="total" name="total" placeholder="Total" value="<?php echo sale_total($sales_id); ?>" readonly="">
							
						  </div><!-- /.form group -->
						  <div class="form-group">
							<label for="date">Discount</label>
							
								<input type="text" class="form-control text-right" id="discount" name="discount" onfocus="startCalc();" onblur="startCalc();" tabindex="6" placeholder="0" >
							 
						  </div><!-- /.form group -->
						  <div class="form-group">
							<label for="date">Amount Due</label>
							
								<input type="text" style="text-align:right" class="form-control" id="amount_due" name="amount_due" placeholder="Amount Due" value="<?php echo sale_total($sales_id); ?>" readonly="">
							
						  </div><!-- /.form group -->
              
						 
              <div class="form-group"  >
                <label for="date">Cash Tendered</label><br>
                <input type="text" style="text-align:right" class="form-control" id="cash" onfocus="startCalc();" onblur="startCalc();" name="cash" placeholder="0">
              </div><!-- /.form group -->
              <div class="form-group" >
                <label for="date">Change</label><br>
                <input type="text" style="text-align:right" class="form-control" id="changed" name="change" placeholder="Change">
              </div><!-- /.form group -->
			  <div class="form-group" >
                <label for="date">Round Off</label><br>
                <input type="text" style="text-align:right" class="form-control" id="roundoff" name="roundoff" placeholder="Change">
              </div><!-- /.form group -->
				
				<button class="btn btn-lg btn-block btn-success" name="cash" id="complete" type="submit" onclick="blur(this);">
                        Complete Sale
                      </button>

					  <button class="btn btn-lg btn-block btn-primary" type="button" onclick="doPrint(<?php echo $sales_id; ?>);">
                        Print
                      </button>
					  
					  <button class="btn btn-lg btn-block" id="daterange-btn" type="reset" tabindex="8">
                        <a href="#">Cancel Sale</a>
                      </button>
			
			</form>
			
			<span id="response">  </span>
					  
<script>

function startCalc() {
       var txtFirstNumberValue = document.getElementById('total').value;
       var txtSecondNumberValue = document.getElementById('discount').value;
       if (txtFirstNumberValue == "")
           txtFirstNumberValue = 0;
       if (txtSecondNumberValue == "")
           txtSecondNumberValue = 0;

       var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
       if (!isNaN(result)) {
           document.getElementById('amount_due').value = result;
       }
	   
	   ////////////////////////////////////
	   
	   var txtthirdNumberValue = document.getElementById('cash').value;
       var txtforthNumberValue = document.getElementById('amount_due').value;
       if (txtthirdNumberValue == "")
           txtthirdNumberValue = 0;
       if (txtforthNumberValue == "")
           txtforthNumberValue = 0;
	   
		if (txtthirdNumberValue != ""){	
       var resultscnd = parseInt(txtthirdNumberValue) - parseInt(txtforthNumberValue);
       if (!isNaN(resultscnd)) {
           document.getElementById('changed').value = resultscnd;
       }
		}
	   
	    $.ajax({
				  type: "POST",
				  url: "update_sale.php",
				  data: $("#saleform").serialize(),
				  success: function(data) {
					$("#response").html(data)
				  }
				});
	   
   }
  
$( document ).ready(function() {  
$("#discount,#cash,#changed,#roundoff").bind("propertychange change keyup paste input", function(){

	startCalc();

});   
});   
  
</script>   



<script>

$(document).ready(function (e) {
$("#saleform").on('submit',(function(e) {
e.preventDefault();
$('#response').show();
$("#loader").show();
$.ajax({
url: "com_sales.php", // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
$("#response").html(data);
}
});

}));
});


</script>