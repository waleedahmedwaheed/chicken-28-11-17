<?php
include_once('db/dbcon.php');

function convert_number_to_words($number) {
    
    $hyphen      = '-';
    $conjunction = ' , ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' AND ';
    $dictionary  = array(
        0                   => 'ZERO',
        1                   => 'ONE',
        2                   => 'TWO',
        3                   => 'THREE',
        4                   => 'FOUR',
        5                   => 'FIVE',
        6                   => 'SIX',
        7                   => 'SEVEN',
        8                   => 'EIGHT',
        9                   => 'NINE',
        10                  => 'TEN',
        11                  => 'ELEVEN',
        12                  => 'TWELVE',
        13                  => 'THIRTEEN',
        14                  => 'FOURTEEN',
        15                  => 'FIFTEEN',
        16                  => 'SIXTEEN',
        17                  => 'SEVENTEEN',
        18                  => 'EIGHTEEN',
        19                  => 'NINETEEN',
        20                  => 'TWENTY',
        30                  => 'THIRTY',
        40                  => 'FORTY',
        50                  => 'FIFTY',
        60                  => 'SIXTY',
        70                  => 'SEVENTY',
        80                  => 'EIGHTY',
        90                  => 'NINETY',
        100                 => 'HUNDRED',
        1000                => 'THOUSAND',
        1000000             => 'MILLION',
        1000000000          => 'BILLION',
        1000000000000       => 'TRILLION',
        1000000000000000    => 'QUADRILLION',
        1000000000000000000 => 'QUINTILLION'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words)." PAISAS";
    }
    
    return $string;
}

 
function get_title($mode,$text,$dbconfig){
switch($mode)
{
case shop_name: $sql2 = "select shop_name title from shop where shop_id ='$text'"; break;   
case prod_name: $sql2 = "select prod_name title from product where prod_id ='$text'"; break;   
case prod_id: 	$sql2 = "select prod_id title from product where prod_code ='$text'"; break;   
case pcat_desc: $sql2 = "select pcat_desc title from product_category where pcat_id ='$text'"; break;   
case st_total:  $sql2 = "SELECT COALESCE((select st_total FROM stock WHERE shop_id = '$text' order by stock_id desc limit 1),0) as title"; break;
case wt_total:  $sql2 = "SELECT COALESCE((select wt_total FROM stock WHERE shop_id = '$text' order by stock_id desc limit 1),0) as title"; break;
case sales_id: 	$sql2 = "SELECT sales_id title from sales where sales_no = '$text'"; break;
case sales_sid:	$sql2 = "SELECT sales_id title from sales_detail where sd_id = '$text'"; break;
case item_type:	$sql2 = "SELECT item_type title from sales where sales_id = '$text'"; break;
case name:		$sql2 = "SELECT name title from user where user_id = '$text'"; break;
case username:	$sql2 = "SELECT username title from user where user_id = '$text'"; break;
case cust_name:	$sql2 = "SELECT cust_name title from customer where cust_id = '$text'"; break;
case pcat_id:	$sql2 = "SELECT pcat_id title from product where prod_id = '$text'"; break;
case ie_type:	$sql2 = "SELECT ie_type title from ie_cat where iecat_id = '$text'"; break;
case ie_desc:	$sql2 = "SELECT ie_desc title from ie_cat where iecat_id = '$text'"; break;
case shop_id:	$sql2 = "SELECT shop_id title from sales where sales_id = '$text'"; break;
case shop_head:	$sql2 = "SELECT shop_id title from shop where shop_head = '$text'"; break;
case shop_contact:	$sql2 = "SELECT shop_contact title from shop where shop_id = '$text'"; break;
case shop_ho:	$sql2 = "SELECT shop_head title from shop where shop_id = '$text'"; break;
case loss_qty:	$sql2 = "SELECT loss_qty title from loss where pur_id = '$text'"; break;
case loss_weight:	$sql2 = "SELECT loss_weight title from loss where pur_id = '$text'"; break;
case loss_id:	$sql2 = "SELECT loss_id title from loss where pur_id = '$text'"; break;
case loss_status:	$sql2 = "SELECT loss_status title from loss where pur_id = '$text'"; break;
case count_prod:	$sql2 = "select count(prod_id) as title from product where prod_status = '$text'"; break;
case count_cust:	$sql2 = "select count(cust_id) as title from customer where cust_status = '$text'"; break;
case count_order:	$sql2 = "select count(co_id) as title from cust_order where co_date = '$text' and co_status = 2"; break;
case count_sales:	$sql2 = "select count(stock_id) as title from stock where sales_id is not null and shop_id = '$text'"; break;
case count_sales_cons:	$sql2 = "select count(stock_id) as title from stock where sales_id is not null and sales_id <> 0 and st_date like '$text%'"; break;
case co_status:	$sql2 = "select co_status as title from cust_order where co_id = '$text'"; break;
case cust_id_co:	$sql2 = "select cust_id as title from cust_order where co_id = '$text'"; break;
case cod_status:	 $sql2 = "select cod_status title from cust_order_detail where co_id = '$text' group by co_id"; break;
case cust_order_amount:	 $sql2 = "select sum(c.rv_weight * c.price) as title from cust_order_detail c where co_id = '$text'"; break;
case pp_prod_fn:	  $sql2 = "select count(p.pp_id) as title from production_prod p where p.pp_status = 0 and p.pro_id = '$text'"; break;
case ppr_prod_fn:	  $sql2 = "select count(p.pprp_id) as title from ppr_products p where p.pprp_status = 0 and p.ppr_id = '$text'"; break;
case ppr_rcv_fn:	  $sql2 = "select p.pprp_status  as title from ppr_products p where p.pprp_status = 3 and p.ppr_id = '$text' group by p.pprp_status"; break;
case prod_exp:	  $sql2 = "select prod_exp as title from product where prod_id = '$text'"; break;
case daily_sp_cons:	  $sql2 = "select COALESCE(SUM(s.amount_due),0) as title from sales s where s.sale_status = 2 and s.date_added like '$text%'"; break;
case bprod_id:	  $sql2 = "select prod_id as title from barcode where bar_id = '$text'"; break;
case bqty:	  $sql2 = "select qty as title from barcode where bar_id = '$text'"; break;
case bwgt:	  $sql2 = "select wgt as title from barcode where bar_id = '$text'"; break;
case co_amount:	  $sql2 = "select co_amount as title from cust_order_amount where co_id = '$text'"; break;

 
}
mysql_select_db("isbpos", $dbconfig);
$result = mysql_query($sql2);
//mysql_select_db($database_dbconfig, $dbconfig);
$rows = mysql_fetch_assoc($result);
$title	= $rows["title"];
return $title;
}


function get_price($mode,$prod_id,$shop_id,$r_date,$dbconfig){
switch($mode)
{
	
case pur_price:   $sql2 = "select pur_price title from rates where shop_id ='$shop_id' and prod_id ='$prod_id' and r_date ='$r_date'"; break;   
case sale_price:  $sql2 = "select sale_price title from rates where shop_id ='$shop_id' and prod_id ='$prod_id' and r_date ='$r_date'"; break;   
case ws_price: 	  $sql2 = "select ws_price title from rates where shop_id ='$shop_id' and prod_id ='$prod_id' and r_date ='$r_date'"; break;   
case sup_price:   $sql2 = "select sup_price title from rates where shop_id ='$shop_id' and prod_id ='$prod_id' and r_date ='$r_date'"; break;   
  
}
mysql_select_db("isbpos", $dbconfig);
$result = mysql_query($sql2);
//mysql_select_db($database_dbconfig, $dbconfig);
$rows = mysql_fetch_assoc($result);
$title	= $rows["title"];
return $title;
}

function get_mandirate($mode,$shop_id,$cur_date,$dbconfig){
switch($mode)
{
	
case mr_rate:   $sql3 = "select mr_rate title from daily_rates where shop_id ='$shop_id' and cur_date = '$cur_date'"; break;   
case sale_rate: $sql3 = "select sale_rate title from daily_rates where shop_id ='$shop_id' and cur_date = '$cur_date'"; break;   
case cur_sale:  $sql3 = "select count(sales_id) as title from sales where sale_status = 2 and shop_id ='$shop_id' and date_added like '$cur_date%'"; break;   
case daily_sp_shop:	  $sql3 = "select COALESCE(SUM(s.amount_due),0) as title from sales s where s.sale_status = 2 and s.date_added like '$cur_date%'
and s.shop_id = '$shop_id'"; break;
}
mysql_select_db("isbpos", $dbconfig);
$result3 = mysql_query($sql3);
//mysql_select_db($database_dbconfig, $dbconfig);
$rows3 = mysql_fetch_assoc($result3);
$title3	= $rows3["title"];
return $title3;
}


function get_stock($mode,$shop_id,$prod_id,$dbconfig){
switch($mode)
{
	
case qty:   $sql4 = "select COALESCE((SUM(CASE WHEN st_inout = 0 THEN qty ELSE 0 END) -
SUM(CASE WHEN st_inout = 1 THEN qty ELSE 0 END)), 0) as title 
 from stock s where s.shop_id = $shop_id and s.prod_id = $prod_id"; break;
 
 case weight:   $sql4 = "select COALESCE((SUM(CASE WHEN st_inout = 0 THEN weight ELSE 0 END) -
SUM(CASE WHEN st_inout = 1 THEN weight ELSE 0 END)), 0) as title
 from stock s where s.shop_id = $shop_id and s.prod_id = $prod_id"; break;
 
 case live_qty:   $sql4 = "select COALESCE((SUM(CASE WHEN st_inout = 0 THEN qty ELSE 0 END) -
SUM(CASE WHEN st_inout = 1 THEN qty ELSE 0 END)), 0) as title 
 from stock s where s.shop_id = $shop_id and s.prod_id = $prod_id"; break;
 
 case live_weight:   $sql4 = "select COALESCE((SUM(CASE WHEN st_inout = 0 THEN weight ELSE 0 END) -
SUM(CASE WHEN st_inout = 1 THEN weight ELSE 0 END)), 0) as title
 from stock s where s.shop_id = $shop_id and s.prod_id = $prod_id"; break;   
  
}
mysql_select_db("isbpos", $dbconfig);
$result4 = mysql_query($sql4);
//mysql_select_db($database_dbconfig, $dbconfig);
$rows4 = mysql_fetch_assoc($result4);
$title4	= $rows4["title"]; 
return  $title4;
}


function sale_stock($mode,$sales_id,$prod_id,$dbconfig){
switch($mode)
{
	
case qty:   $sql5 = "select COALESCE(SUM(s.qty),0) as title
 from sales_detail s where  s.sales_id = $sales_id and s.prod_id = $prod_id and s.sd_status=0"; break;
 
case weight:   $sql5 = "select COALESCE(SUM(s.weight),0) as title 
 from sales_detail s where  s.sales_id = $sales_id and s.prod_id = $prod_id and s.sd_status=0"; break;
  
  
}
mysql_select_db("isbpos", $dbconfig);
$result5 = mysql_query($sql5);
//mysql_select_db($database_dbconfig, $dbconfig);
$rows5 = mysql_fetch_assoc($result5);
$title5	= $rows5["title"]; 
return  $title5;
}


function sale_total($sales_id,$dbconfig){
	
$sql6 = "select s.sales_id,sd.prod_id,sd.qty,sd.weight,sd.sd_date,sd.sales_no,s.shop_id 
from sales s, sales_detail sd where sd.sd_status = 0 and s.sales_id = $sales_id and s.sale_status = 0
and s.sales_id = sd.sales_id";
 
 mysql_select_db("isbpos", $dbconfig);
$result6 = mysql_query($sql6);
//mysql_select_db($database_dbconfig, $dbconfig);
while($rows6 = mysql_fetch_assoc($result6))
{
	$prod_id = $rows6["prod_id"];
	$shop_id = $rows6["shop_id"];
	$sd_date = $rows6["sd_date"];
	$qty 	 = $rows6["qty"];
	$weight	 = $rows6["weight"];
	
	if($prod_id==9999)
	{
		$live = get_mandirate(sale_rate,$shop_id,$sd_date);
		$live_price = $weight * $live;
	}
	else
	{
		$price_ = get_price(sale_price,$prod_id,$shop_id,$sd_date);
		$pr_price = $price_ * $weight;
	}
	
	$total = $live_price + $pr_price; 
	$total_o = $total_o + $total;
		
	$total = 0;	
	$live_price = 0;	
	$pr_price = 0;	
	$weight = 0;	
	$qty = 0;	
	
}

return  $total_o;
}


function cust_outstandings($mode,$cust_id,$dbconfig){
switch($mode)
{
	
case out:   $sql7 = "select COALESCE((q1.co_amount - q2.cp_amount),0) as cust_out from
(select sum(ca.co_amount) as co_amount from cust_order_amount ca where ca.co_id IN
(select co.co_id from cust_order co where co.cust_id =  '$cust_id' and co.co_status = '2'and co.co_id=ca.co_id)) q1,
(select sum(cp_amount) as cp_amount from cust_paid where cust_id = '$cust_id' and cp_status = 2) q2"; break;  
  
}
mysql_select_db("isbpos", $dbconfig);
$result7 = mysql_query($sql7);
//mysql_select_db($database_dbconfig, $dbconfig);
$rows7 = mysql_fetch_assoc($result7);
$title7	= $rows7["cust_out"]; 
return  $title5;
}


function factor($mode,$cust_id,$prod_id,$dbconfig){
switch($mode)
{
	
case factor:   $sql8 = "select count(fact_id) as factor from cust_factor where cust_id = $cust_id and prod_id = $prod_id"; break;  
case other:    $sql8 = "select other from cust_factor where cust_id = $cust_id and prod_id = $prod_id"; break;  
case mandi_fact:   $sql8 = "select mandi_fact as factor from cust_factor where cust_id = $cust_id and prod_id = $prod_id"; break;  
  
}
mysql_select_db("isbpos", $dbconfig);
$result8 = mysql_query($sql8);
//mysql_select_db($database_dbconfig, $dbconfig);
$rows8 = mysql_fetch_assoc($result8);
$title8	= $rows8["factor"]; 
return  $title8;
}


function get_openstock($mode,$shop_id,$prod_id,$date,$dbconfig){
switch($mode)
{
	
case qty:   $sql9 = "select COALESCE((SUM(CASE WHEN st_inout = 0 THEN qty ELSE 0 END) -
SUM(CASE WHEN st_inout = 1 THEN qty ELSE 0 END)), 0) as title 
 from stock s where s.shop_id = $shop_id and s.prod_id = $prod_id and st_date < '$date'"; break;
 
 case weight:   $sql9 = "select COALESCE((SUM(CASE WHEN st_inout = 0 THEN weight ELSE 0 END) -
SUM(CASE WHEN st_inout = 1 THEN weight ELSE 0 END)), 0) as title
 from stock s where s.shop_id = $shop_id and s.prod_id = $prod_id and st_date < '$date'"; break;    
  
}
mysql_select_db("isbpos", $dbconfig);
$result9 = mysql_query($sql9);
//mysql_select_db($database_dbconfig, $dbconfig);
$rows9 = mysql_fetch_assoc($result9);
$title9	= $rows9["title"]; 
return  $title9;
}

function get_openprodstock($mode,$shop_id,$pcat_id,$date_from,$date_to,$dbconfig){
switch($mode)
{
	
case weight_open:   $sql9 = "select COALESCE((SUM(CASE WHEN st_inout = 0 THEN weight ELSE 0 END) -
SUM(CASE WHEN st_inout = 1 THEN weight ELSE 0 END)), 0) as title 
 from stock s where s.shop_id = $shop_id 
 and st_date < '$date_from 00:00:00'
 and prod_id in (select prod_id from product where pcat_id = $pcat_id)"; break;
 
 case weight_cur:   $sql9 = "select COALESCE((SUM(CASE WHEN st_inout = 0 THEN weight ELSE 0 END) -
SUM(CASE WHEN st_inout = 1 THEN weight ELSE 0 END)), 0) as title 
 from stock s where s.shop_id = $shop_id 
 and st_date between '$date_from 00:00:00' and '$date_to 23:59:59'
 and prod_id in (select prod_id from product where pcat_id = $pcat_id)"; break;

 case weight_sales:   $sql9 = "select COALESCE(SUM(s.weight),0) as title
 from sales_detail s where  s.sd_status=2 and 
 s.sales_id in (select sa.sales_id from sales sa where sa.date_added between '$date_from 00:00:00' and '$date_from 23:59:59' and sa.shop_id = $shop_id)
 and prod_id in (select prod_id from product where pcat_id = $pcat_id)"; break;
 
 case weight_loss:   $sql9 = "select COALESCE(SUM(loss_weight),0) as title from loss where loss_datetime between '$date_from 00:00:00' and '$date_from 23:59:59'
 and prod_id in (select prod_id from product where pcat_id = $pcat_id) and loss_status = 2 and shop_id = $shop_id"; break;

 case weight_price:   $sql9 = "select COALESCE(SUM(s.price),0) as title 
 from sales_detail s where s.sd_status=2 and 
 s.sales_id in (select sa.sales_id from sales sa where sa.date_added between '$date_from 00:00:00' and '$date_from 23:59:59' and sa.shop_id = $shop_id)
 and prod_id in (select prod_id from product where pcat_id = $pcat_id)"; break;
  
}
mysql_select_db("isbpos", $dbconfig);
$result9 = mysql_query($sql9);
//mysql_select_db($database_dbconfig, $dbconfig);
$rows9 = mysql_fetch_assoc($result9);
$title9	= $rows9["title"]; 
return  $title9;
}

 


?>