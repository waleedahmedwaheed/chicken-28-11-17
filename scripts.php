<?php
include("db/dbcon.php"); 
//include("functions.php"); 
?>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/jRespond.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/nav-accordion.js"></script>
<script src="js/hoverintent.js"></script>
<script src="js/waves.js"></script>
<script src="js/switchery.js"></script>
<script src="js/jquery.loadmask.js"></script>
<script src="js/icheck.js"></script>
<script src="js/bootbox.js"></script>
<script src="js/animation.js"></script>
<script src="js/colorpicker.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/select2.js"></script>
<script src="js/sweetalert.js"></script>
<script src="js/moment.js"></script>
<script src="js/calendar/fullcalendar.js"></script>
<!--CHARTS-->
<script src="js/chart/sparkline/jquery.sparkline.js"></script>
<script src="js/chart/easypie/jquery.easypiechart.min.js"></script>
<script src="js/chart/flot/excanvas.min.js"></script>
<script src="js/chart/flot/jquery.flot.min.js"></script>
<script src="js/chart/flot/jquery.flot.pie.min.js"></script>
<script src="js/chart/flot/jquery.flot.stack.min.js"></script>
<script src="js/chart/flot/jquery.flot.axislabels.js"></script>
<script src="js/chart/flot/jquery.flot.time.min.js"></script>
<script src="js/chart/flot/jquery.flot.resize.min.js"></script>
<script src="js/chart/flot/jquery.flot.tooltip.min.js"></script>
<script src="js/chart/flot/jquery.flot.spline.js"></script>
<script src="js/chart.init.js"></script>
<!--Data Tables-->
<script src="js/jquery.dataTables.js"></script>
<script src="js/dataTables.responsive.js"></script>
<script src="js/dataTables.tableTools.js"></script>
<script src="js/dataTables.bootstrap.js"></script>
<script src="js/stacktable.js"></script>
<script src="js/smart-resize.js"></script>
<script src="js/layout.init.js"></script>
<script src="js/matmix.init.js"></script>
<script src="js/retina.min.js"></script>

<!--jquery.mentionsInput-->
<script src="js/underscore.js"></script>
<script src="js/jquery.elastic.js"></script>
<script src="js/jquery.events.input.js"></script>
<script src="js/jquery.mentionsInput.js"></script>
<!--Text Editor-->
<script src="js/summernote.min.js"></script>
<script src="js/shortcut.js"></script>


<script src="lobibox-master/js/Lobibox.js"></script>
<script src="lobibox-master/demo/demo.js"></script>		

<script src="code/highcharts.js"></script>
<script src="code/modules/exporting.js"></script>
<script src="code/highcharts-more.js"></script>
<script src="code/highcharts-3d.js"></script>

<script>

	var _delay = 20000;
function checkLoginStatus(){
	
	//alert("data");
	
     jQuery.get("check-status.php", function(data){
		 
		// alert("data");
		 
		 //console.log(data);
		 
        if(!data) {
            window.location = "logout.php"; 
        }
        setTimeout(function(){  checkLoginStatus(); }, _delay); 
        });
}
checkLoginStatus();

</script>

<script>
jQuery('.decimal').keyup(function(){
    var val = $(this).val();
    if(isNaN(val)){
         val = val.replace(/[^0-9\.]/g,'');
         if(val.split('.').length>2) 
             val =val.replace(/\.+$/,"");
    }
    $(this).val(val); 
});
</script>

<!-----------Input Accept Float Numners--------->

<script>
jQuery('.number').keypress(function(event) {
    if(event.which < 46
    || event.which > 59) {
        event.preventDefault();
    } // prevent if not number/dot

    if(event.which == 46
    && $(this).val().indexOf('.') != -1) {
        event.preventDefault();
    } // prevent if already dot
});

jQuery('.number').bind("cut copy paste",function(e) {
          e.preventDefault();
});	  
</script>

<!-----------Input Accept Int Numners--------->
			
 <script>
 jQuery('.validateNumber').on('keypress', function(ev) {
    var keyCode = window.event ? ev.keyCode : ev.which;
    //codes for 0-9
    if (keyCode < 48 || keyCode > 57) {
        //codes for backspace, delete, enter
        if (keyCode != 0 && keyCode != 8 && keyCode != 13 && !ev.ctrlKey) {
            ev.preventDefault();
        }
    }
});

jQuery('.validateNumber').bind("cut copy paste",function(e) {
          e.preventDefault();
});	 
</script>

 <script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>

<script type="text/javascript">
function AvoidSpace(event) {
    var k = event ? event.which : window.event.keyCode;
    if (k == 32) return false;
}

    </script>
 
 <script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Current Live Stock'
    },
    subtitle: {
        text: 'Islamabad Chicken'
    },
    xAxis: {
        categories: [
            <?php
		$selectSQL = "select * from shop ORDER BY shop_id ASC";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$shop_name =$row1['shop_name'];
							
		 	echo "'";					
            echo $shop_name;
			echo "',";
		  } ?>
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Stock'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Quantity',
        data: [<?php	
							$selectSQL = "select * from shop ORDER BY shop_id ASC";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$s_id=$row1['shop_id'];
								//echo "'";
								echo get_stock(qty,$s_id,9999,$dbconfig);
								echo ",";
							}								
									?>]

    }, {
        name: 'Weight',
        data: [<?php	
							$selectSQL = "select * from shop ORDER BY shop_id ASC";
							mysql_select_db($database_dbconfig, $dbconfig);
							$Result1 = mysql_query($selectSQL, $dbconfig) or die(mysql_error());	 
							while($row1 = mysql_fetch_assoc($Result1))
							{
								$s_id=$row1['shop_id'];
								//echo "'";
								echo get_stock(weight,$s_id,9999,$dbconfig);
								echo ",";
							}								
									?> ]

    }]
});
		</script>
		
		
		<script type="text/javascript">

var chart = Highcharts.chart('container2', {

    title: {
        text: 'Monthly Sales'
    },

    subtitle: {
        text: ''
    },
	yAxis: {
        title: {
            text: 'Total No of Sales'
        }
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },

    series: [{
        type: 'column',
        colorByPoint: true,
		name: 'Sales',
        data: [<?php 
		for($i=1;$i<=12;$i++)
 {	 
	 $start_date = date("$year-$i-01");
	 $end_days = cal_days_in_month(CAL_GREGORIAN, $i, $year);
	 $end_date = date("$year-$i-$end_days");
	 //echo $start_date." ".$end_date."<br>";
	 $sql2 = "select count(sales_id) as title from sales where sale_status = 2 and 
	 date_added between '$start_date 00:00:00' and '$end_date 23:59:59'";
	 mysql_select_db($database_dbconfig, $dbconfig);
	 $result = mysql_query($sql2);
     $rows = mysql_fetch_assoc($result);
	 $title	= $rows["title"];
	 echo $title;
	 echo ",";
 }
		?>],
        showInLegend: false
    }]

});



		</script>
		
		
		<script type="text/javascript">

Highcharts.chart('container3', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45
        }
    },
    title: {
        text: 'Highest sale products'
    },
    subtitle: {
        text: ''
    },
    plotOptions: {
        pie: {
            innerSize: 100,
            depth: 45
        }
    },
    series: [{
        name: 'Weight',
        data: [
		<?php 
		
	 $sql3 = "select COALESCE (SUM(weight) ,0) as title,prod_id from sales_detail where sd_status = 2 group by prod_id limit 10";
	 mysql_select_db($database_dbconfig, $dbconfig);
	 $result3 = mysql_query($sql3);
     while($rows3 = mysql_fetch_assoc($result3))
	 {
		 
	 $title3	= $rows3["title"];
	 $prod_id3	= $rows3["prod_id"];
	 if($prod_id3=="9999"){ $prod_name =  "Live Chicken"; } else { $prod_name =  get_title(prod_name,$prod_id3,$dbconfig); }
	 
	 echo "[";
	 echo "'$prod_name'";
	 echo ",";
	 echo $title3;
	 echo "],";
	 
	 }
		?>

        ]
    }]
});
		</script>
		
		
				<script type="text/javascript">

Highcharts.chart('container4', {

    title: {
        text: 'Sales Graph'
    },

    subtitle: {
        text: ''
    },

    yAxis: {
        title: {
            text: 'Amount (Rs)'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },

    series: [
	<?php 
	if($shop_ho==1)
	{
		$sqls = "select * from shop where shop_status = 0 and shop_head = 0";
	}
	else
	{
		$sqls = "select * from shop where shop_status = 0 and shop_head = 0 and shop_id='".$_SESSION['s_id']."'";
	}
	 mysql_select_db($database_dbconfig, $dbconfig);
	 $results = mysql_query($sqls);
     while($rowss = mysql_fetch_assoc($results))
	 {
		$shop_id_ 	= $rowss["shop_id"];
		$shop_name_ = $rowss["shop_name"];
	 ?>
	{
        name: '<?php echo $shop_name_; ?>',
        data: [<?php 
		for($i=1;$i<=12;$i++)
 {	 
	 $start_date = date("$year-$i-01");
	 $end_days = cal_days_in_month(CAL_GREGORIAN, $i, $year);
	 $end_date = date("$year-$i-$end_days");
	 //echo $start_date." ".$end_date."<br>";
	 $sql2 = "select COALESCE(SUM(s.amount_due),0) as title from sales s where s.sale_status = 2 and s.shop_id=$shop_id_ and
	 date_added between '$start_date 00:00:00' and '$end_date 23:59:59'";
	 mysql_select_db($database_dbconfig, $dbconfig);
	 $result = mysql_query($sql2);
     $rows = mysql_fetch_assoc($result);
	 $title	= $rows["title"];
	 echo $title;
	 echo ",";
 }
		?>]
    },
	 <?php } ?>
	]

});
		</script>
		
		<script>
		
		setInterval(function() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
         if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText);
         }
      }
    request.open('GET', 'server_rates.php', true);
    request.send();

	}, 60 * 1000);
		
		setInterval(function() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
         if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText);
         }
      }
    request.open('GET', 'server_live_rates.php', true);
    request.send();

	}, 60 * 1000);
		
		setInterval(function() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
         if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText);
         }
      }
    request.open('GET', 'server_purchase.php', true);
    request.send();

	}, 60 * 1000);
		
		setInterval(function() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
         if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText);
         }
      }
    request.open('GET', 'server_live.php', true);
    request.send();

	}, 60 * 1000);
		
		setInterval(function() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
         if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText);
         }
      }
    request.open('GET', 'server_chiller.php', true);
    request.send();

	}, 60 * 1000);
		
		setInterval(function() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
         if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText);
         }
      }
    request.open('GET', 'server_sales.php', true);
    request.send();

	}, 60 * 1000);
	
	setInterval(function() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
         if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText);
         }
      }
    request.open('GET', 'server_loss.php', true);
    request.send();

	}, 60 * 1000);
		
		</script>
		