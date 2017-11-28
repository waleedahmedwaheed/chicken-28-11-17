<?php
include("db/dbcon.php"); 
include("functions.php"); 
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
								//echo get_stock(qty,$s_id,9999,$dbconfig);
								//echo "',";
							}								
									?> '0','40','0','0','490','0'
]

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
								//echo get_stock(weight,$s_id,9999,$dbconfig);
								//echo "',";
							}								
									?>  '0','40','0','0','490','0'
]

    }]
});
		</script>
		
		
		<script type="text/javascript">

var chart = Highcharts.chart('container2', {

    title: {
        text: 'Monthly Income'
    },

    subtitle: {
        text: ''
    },

    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },

    series: [{
        type: 'column',
        colorByPoint: true,
        data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
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
            ['Chicken Keema', 8],
            ['Drum Stick', 3],
            ['Wings', 1],
            ['Boneless', 6],
            ['Chicken Thighs', 8],
            ['Chicken Breast', 4],
            ['Chicken Banner', 4],
            ['Whole Chicken', 1],
            ['Chicken Skinless', 1]
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
            text: 'Amount'
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

    series: [{
        name: 'Commercial Shop',
        data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175, 97031, 119931, 137133, 154175]
    }, {
        name: 'I-9 Shop',
        data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434, 32490, 30282, 38121, 40434]
    }, {
        name: 'G-9 Shop',
        data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387, 20185, 24377, 32147, 39387]
    }, {
        name: 'F-9 Shop',
        data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227, 15112, 22452, 34400, 34227]
    }]

});
		</script>