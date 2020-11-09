@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
      <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Users</a> <a href="#" class="current">View User Repoting</a> </div>
    <h1> User</h1>
    @include('errorMessage.message')
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Users Reporting</h5>
          </div>
          <div class="widget-content nopadding">
            <?php
            $day1 = date('D');
            $day2 = date('D',strtotime("-1 day"));
            $day3 = date('D',strtotime("-2 day"));
            $day4 = date('D',strtotime("-3 day"));
            $day5 = date('D',strtotime("-4 day"));
            $day6 = date('D',strtotime("-5 day"));
            $day7 = date('D',strtotime("-6 day"));

          $dataPoints = array(
            array("y" => $day1_orders, "label" => $day1),
            array("y" => $day2_orders, "label" => $day2),
            array("y" => $day3_orders, "label" => $day3),
            array("y" => $day4_orders, "label" => $day4),
            array("y" => $day5_orders, "label" => $day5),
            array("y" => $day6_orders, "label" => $day6),
              array("y" => $day7_orders, "label" => $day7),

          );
        ?>
        <!DOCTYPE HTML>
        <html>
        <head>
        <script>
        window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
        	animationEnabled: true,
        	theme: "light2",
        	title:{
        		text: "Orders Products"
        	},
        	axisY: {
        		title: "Number of Order Products "
        	},
        	data: [{
        		type: "column",
        		yValueFormatString: "#,##0.## products",
        		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        	}]
        });
        chart.render();

        }
        </script>
        </head>
        <body>
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        </body>
        </html>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection
