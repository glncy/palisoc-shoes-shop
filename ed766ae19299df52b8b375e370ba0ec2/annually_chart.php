
<?php
/*if (isset($_POST['month'])) {
    $date_month=$_POST['month'];
}
else
{
    $date_month=date('m');   
}
$ref_id=$_POST['id'];

if ($date_month=="1") {
    $month = "January";
}
elseif ($date_month=="2") {
    $month = "February";
}
elseif ($date_month=="3") {
    $month = "March";
}
elseif ($date_month=="4") {
    $month = "April";
}
elseif ($date_month=="5") {
    $month = "May";
}
elseif ($date_month=="6") {
    $month = "June";
}
elseif ($date_month=="7") {
    $month = "July";
}
elseif ($date_month=="8") {
    $month = "August";
}
elseif ($date_month=="9") {
    $month = "September";
}
elseif ($date_month=="10") {
    $month = "October";
}
elseif ($date_month=="11") {
    $month = "November";
}
elseif ($date_month=="12") {
    $month = "December";
}*/

?>

<script type="text/javascript">
$(function () {
        var seriesData=[
        <?php
        include('connection.php');
        $month_target=12;
        $year=date('Y');
        $output="";
        $month_loop = 1;
        while ( $month_loop<= $month_target) {
            $days=cal_days_in_month(CAL_GREGORIAN, $month_loop, $year);
            $result=0;
            $timestamp = strtotime($month_loop."/"."1"."/".$year);
            $from_date = date("Y-m-d",$timestamp);
            $timestamp = strtotime($month_loop."/".$days."/".$year);
            $to_date = date("Y-m-d",$timestamp);
            //$current_date=date('Y-m-d',strtotime($year."-".$date_month."-".$day));
            $query="SELECT * FROM tblcheckout WHERE checkout_date>='$from_date' AND checkout_date<='$to_date'";
            $get=mysqli_query($con,$query) or die(mysqli_error($con));
            $num_rows=mysqli_num_rows($get);
            if ($num_rows>0) {
                while ($row=mysqli_fetch_array($get))
                {
                    $qty=explode("#", $row['qtys']);
                    array_pop($qty);

                    $cnt = count($qty);
                    $loop = 0;
                    while ($loop<$cnt) {
                        $result += (int)$qty[$loop];
                        $loop++;
                    }
                }
                if ($month_loop==$month_target) {
                    $output .="['".date('M',$timestamp)."',".$result."]";
                }
                else
                {
                    $output .="['".date('M',$timestamp)."',".$result."],";
                }
            }
            else
            {
                if ($month_loop==$month_target) {
                    $output .="['".date('M',$timestamp)."',".$result."]";
                }
                else
                {
                    $output .="['".date('M',$timestamp)."',".$result."],";
                }
            }
            $month_loop++;
        }
        echo $output;
        mysqli_close($con);
        ?>];
        $('#chart').highcharts({
            chart: {

            },
            title: {
                text: 'Year : <?php echo $year;?>'
            },
            yAxis: {
                title: {
                    text: 'Sold'
                }
            },
            exporting: { enabled: false },
            subtitle: {
                text: ''
            },
            xAxis: {
                title: {
                    text: 'Months'
                },
                tickInterval: 1,
                labels: {
                    enabled: true,
                    formatter: function() { return seriesData[this.value][0];},
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                showInLegend: false,name: 'Sold Products',data: seriesData     
            }],
            plotOptions: {
                series: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function () {
                                var month = this.category+1;
                                //alert(month);
                                $.ajax({
                                    type: "post",
                                    url: '/admin/monthly_chart',
                                    data: {
                                        month:month,
                                    },
                                    success: function(result){
                                        $('#monthly').html(result);
                                    }
                                });
                                $('#monthly_chart').modal('show');
                                //alert('Category: ' + this.category + ', value: ' + this.y);
                            }
                        }
                    }
                }
            }
        });
    });
</script>

<div id="chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>