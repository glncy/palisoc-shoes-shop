<?php
$date_month=$_POST['month'];
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
}
?>

<script type="text/javascript">
$(function () {
        var seriesData=[
        <?php
        include('connection.php');
        $month_target=$date_month;
        $year=date('Y');
        $output="";
        $days=cal_days_in_month(CAL_GREGORIAN, $month_target, $year);
        $day=1;
        while ( $day<= $days) {
            $result=0;
            $timestamp = strtotime($month_target."/".$day."/".$year);
            $to_date = date("Y-m-d",$timestamp);
            //$current_date=date('Y-m-d',strtotime($year."-".$date_month."-".$day));
            $query="SELECT * FROM tblcheckout WHERE checkout_date='$to_date'";
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
                if ($day==$days) {
                    $output .="['".date('d',$timestamp)."',".$result."]";
                }
                else
                {
                    $output .="['".date('d',$timestamp)."',".$result."],";
                }
            }
            else
            {
                if ($day==$days) {
                    $output .="['".date('d',$timestamp)."',".$result."]";
                }
                else
                {
                    $output .="['".date('d',$timestamp)."',".$result."],";
                }
            }
            $day++;
        }
        echo $output;
        mysqli_close($con);
        ?>];
        $('#month_chart').highcharts({
            chart: {

            },
            title: {
                text: '<?php echo $month;?>'
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
                    text: 'Days'
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
            }]
        });
    });
</script>
<div class="row">
    <div class="col-sm-12">
        <div id="month_chart"></div>
    </div>
</div>
