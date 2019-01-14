<script src="<?php echo site_url(ASSET);?>/raphael/raphael.min.js"></script>
<script src="<?php echo site_url(ASSET);?>/morris.js/morris.min.js"></script>
<script src="<?php echo site_url(ASSET);?>/echarts/dist/echarts.min.js"></script>
<script src="<?php echo site_url(ASSET);?>/Chart.js/dist/Chart.min.js"></script>
<?php
/*** bar graph start ***/
// fill month and value for non-exist month to daily data
$days = array();
$current_day = date('j');
$sales_daily_in_current_month_new = array();
foreach($sales_daily_in_current_month as $sales) {
	$days[] = $sales->day_for;
	$sales_daily_in_current_month_new[$sales->day_for] = $sales;
}
for($i = 1; $i <= $current_day; $i++) {
	
	if(!in_array($i, $days)) {
		// add data for month and value
		$obj = new stdClass;
		$obj->total_order = 0;
		$obj->total_price = 0;
		$obj->day_for = $i;
		$sales_daily_in_current_month_new[$i] = $obj;
	}
}
$sales_daily_in_current_month = $sales_daily_in_current_month_new;
ksort($sales_daily_in_current_month);
$sep = $labels_graph_bar = '';
foreach($sales_daily_in_current_month as $sales) {
	$total_price = intval($sales->total_price);	
	$date = date('Y-M-'.$sales->day_for);
	
	$labels_graph_bar .= $sep . "{day: '".$date."', order_amount: ".$total_price."}";
	
	$sep = "," . "\n";
}
/*** bar graph end ***/

// fill month and value for non-exist month to sales_summary
$months = array();
$current_month = date('n');
foreach($sales_summary as $sales) {
	$months[] = $sales->month_for;
}
$sales_summary_cnt = count($sales_summary);
for($i = 1; $i <= $current_month; $i++) {
	
	if(!in_array($i, $months)) {
		// add data for month and value
		$obj = new stdClass;
		$obj->total_order = 0;
		$obj->total_price = 0;
		$obj->month_for = $i;
		$sales_summary[$sales_summary_cnt] = $obj;
		$sales_summary_cnt++;
	}
}

// sort by month
if($sales_summary) {
	usort($sales_summary, function($a, $b) {
		
		if ($a->month_for == $b->month_for)
			return 0;
		if ($a->month_for > $b->month_for)
			return 1;
		if ($a->month_for < $b->month_for)
			return -1;
		
		//return $a->month_for <=> $b->month_for;
		
	});
}

$sep = $sep_echart_pie = $labels_echart_pie = $echart_pie_data = '';
$orders_registers = array();
foreach($sales_summary as $sales) {
	$total_price = intval($sales->total_price);
	
	$dateObj   = DateTime::createFromFormat('!m', $sales->month_for);
	$monthName = $dateObj->format('F'); // March
	
	// pie chart graph
	$labels_echart_pie .= $sep_echart_pie . "'".$monthName."'";
	$echart_pie_data .= $sep . "{value: ".$total_price.",name: '".$monthName."'}";
	
	// line chart graph
	$orders_registers[$sales->month_for]['total_order'] = intval($sales->total_order);	
	
	$sep = "," . "\n";
	$sep_echart_pie = ",";
}
// line chart graph
foreach($customer_summary as $customer) {
	$orders_registers[$customer->month_for]['total_register'] = $customer->total_users;
}
ksort($orders_registers);
$sep = '';
$line_chart_labels = $line_chart_register = $line_chart_order = '';
foreach($orders_registers as $month_for => $data) {
	$dateObj   = DateTime::createFromFormat('!m', $month_for);
	$monthName = $dateObj->format('F');
	
	$line_chart_labels .= $sep . "'".$monthName."'";
	$total_register = isset($data['total_register']) ? $data['total_register'] : 0;
	$total_order = isset($data['total_order']) ? $data['total_order'] : 0;
	
	$line_chart_register .= $sep . $total_register;
	$line_chart_order .= $sep . $total_order;
	
	$sep = ",";
}
?>

<script>
	<?php if($labels_graph_bar):?>
	if ($('#graph_bar').length){ 
			
		Morris.Bar({
		  element: 'graph_bar',
		  data: [
			<?php echo $labels_graph_bar;?>
		  ],
		  xkey: 'day',
		  ykeys: ['order_amount'],
		  labels: ['Order Amount'],
		  barRatio: 0.4,
		  barColors: ['#005952', '#34495E', '#ACADAC', '#3498DB'],
		  xLabelAngle: 35,
		  hideHover: 'auto',
		  resize: true
		});

	}
	<?php endif;?>
	
	<?php if($labels_echart_pie):?>
	if ($('#echart_pie').length ){  
			  
		  var theme = {
				  color: [
					  '#005952', '#0195ED', '#DC0A15', '#f4b100',
					  '#028f50', '#2b2b33', '#739000', '#f4f4f4',
					  '#d9534f', '#ecfccb', '#a94442', '#a942a1'
				  ],

				  title: {
					  itemGap: 8,
					  textStyle: {
						  fontWeight: 'normal',
						  color: '#408829'
					  }
				  },

				  dataRange: {
					  color: ['#1f610a', '#97b58d']
				  },

				  toolbox: {
					  color: ['#408829', '#408829', '#408829', '#408829']
				  },

				  tooltip: {
					  backgroundColor: 'rgba(0,0,0,0.5)',
					  axisPointer: {
						  type: 'line',
						  lineStyle: {
							  color: '#408829',
							  type: 'dashed'
						  },
						  crossStyle: {
							  color: '#408829'
						  },
						  shadowStyle: {
							  color: 'rgba(200,200,200,0.3)'
						  }
					  }
				  },

				  dataZoom: {
					  dataBackgroundColor: '#eee',
					  fillerColor: 'rgba(64,136,41,0.2)',
					  handleColor: '#408829'
				  },
				  grid: {
					  borderWidth: 0
				  },

				  categoryAxis: {
					  axisLine: {
						  lineStyle: {
							  color: '#408829'
						  }
					  },
					  splitLine: {
						  lineStyle: {
							  color: ['#eee']
						  }
					  }
				  },

				  valueAxis: {
					  axisLine: {
						  lineStyle: {
							  color: '#408829'
						  }
					  },
					  splitArea: {
						  show: true,
						  areaStyle: {
							  color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
						  }
					  },
					  splitLine: {
						  lineStyle: {
							  color: ['#eee']
						  }
					  }
				  },
				  timeline: {
					  lineStyle: {
						  color: '#408829'
					  },
					  controlStyle: {
						  normal: {color: '#408829'},
						  emphasis: {color: '#408829'}
					  }
				  },

				  k: {
					  itemStyle: {
						  normal: {
							  color: '#68a54a',
							  color0: '#a9cba2',
							  lineStyle: {
								  width: 1,
								  color: '#408829',
								  color0: '#86b379'
							  }
						  }
					  }
				  },
				  map: {
					  itemStyle: {
						  normal: {
							  areaStyle: {
								  color: '#ddd'
							  },
							  label: {
								  textStyle: {
									  color: '#c12e34'
								  }
							  }
						  },
						  emphasis: {
							  areaStyle: {
								  color: '#99d2dd'
							  },
							  label: {
								  textStyle: {
									  color: '#c12e34'
								  }
							  }
						  }
					  }
				  },
				  force: {
					  itemStyle: {
						  normal: {
							  linkStyle: {
								  strokeColor: '#408829'
							  }
						  }
					  }
				  },
				  chord: {
					  padding: 4,
					  itemStyle: {
						  normal: {
							  lineStyle: {
								  width: 1,
								  color: 'rgba(128, 128, 128, 0.5)'
							  },
							  chordStyle: {
								  lineStyle: {
									  width: 1,
									  color: 'rgba(128, 128, 128, 0.5)'
								  }
							  }
						  },
						  emphasis: {
							  lineStyle: {
								  width: 1,
								  color: 'rgba(128, 128, 128, 0.5)'
							  },
							  chordStyle: {
								  lineStyle: {
									  width: 1,
									  color: 'rgba(128, 128, 128, 0.5)'
								  }
							  }
						  }
					  }
				  },
				  gauge: {
					  startAngle: 225,
					  endAngle: -45,
					  axisLine: {
						  show: true,
						  lineStyle: {
							  color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
							  width: 8
						  }
					  },
					  axisTick: {
						  splitNumber: 10,
						  length: 12,
						  lineStyle: {
							  color: 'auto'
						  }
					  },
					  axisLabel: {
						  textStyle: {
							  color: 'auto'
						  }
					  },
					  splitLine: {
						  length: 18,
						  lineStyle: {
							  color: 'auto'
						  }
					  },
					  pointer: {
						  length: '90%',
						  color: 'auto'
					  },
					  title: {
						  textStyle: {
							  color: '#333'
						  }
					  },
					  detail: {
						  textStyle: {
							  color: 'auto'
						  }
					  }
				  },
				  textStyle: {
					  fontFamily: 'Arial, Verdana, sans-serif'
				  }
			  };
		  
		  var echartPie = echarts.init(document.getElementById('echart_pie'), theme);

		  echartPie.setOption({
			tooltip: {
			  trigger: 'item',
			  formatter: "{a} <br/>{b} : {c} ({d}%)"
			},
			legend: {
			  x: 'center',
			  y: 'bottom',
			  data: [<?php echo $labels_echart_pie;?>]
			},
			toolbox: {
			  show: true,
			  feature: {
				magicType: {
				  show: true,
				  type: ['pie', 'funnel'],
				  option: {
					funnel: {
					  x: '25%',
					  width: '50%',
					  funnelAlign: 'left',
					  max: 1548
					}
				  }
				},
				restore: {
				  show: false
				},
				saveAsImage: {
				  show: false
				}
			  }
			},
			calculable: true,
			series: [{
			  name: 'Sales',
			  type: 'pie',
			  radius: '55%',
			  center: ['50%', '48%'],
			  data: [<?php echo $echart_pie_data;?>]
			}]
		  });


	}
	<?php endif;?>
	
	<?php if($line_chart_order || $line_chart_register):?>
	if ($('#lineChart').length ){	
			
	  var ctx = document.getElementById("lineChart");
	  var lineChart = new Chart(ctx, {
		type: 'line',
		data: {
		  labels: [<?php echo $line_chart_labels;?>],
		  datasets: [{
			label: "Registration",
			fill: false,
			height: '400px',
			backgroundColor: "rgba(220, 10, 21, 0.81)",
			borderColor: "#DC0A15",
			pointBorderColor: "rgba(220, 10, 21, 0.68)",
			pointBackgroundColor: "rgba(220, 10, 21, 0.68)",
			pointHoverBackgroundColor: "#fff",
			pointHoverBorderColor: "rgba(220,220,220,1)",
			pointBorderWidth: 1,
			data: [<?php echo $line_chart_register;?>]
		  }, {
			label: "No. of orders",
			fill: false,
			height: '400px',
			backgroundColor: "#0195ED",
			borderColor: "#047dc5",
			pointBorderColor: "rgba(3, 88, 106, 0.70)",
			pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
			pointHoverBackgroundColor: "#fff",
			pointHoverBorderColor: "rgba(151,187,205,1)",
			pointBorderWidth: 1,
			data: [<?php echo $line_chart_order;?>]
		  }]
		},
	  });
	
	}
	<?php endif;?>
</script>