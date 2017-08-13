// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['line']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);
google.charts.setOnLoadCallback(drawDiff);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart() {

// Create the data table.
$.getJSON('json/rewards-date.php', function(cdata) {
	if(cdata.sucess)
	{
		var data = new google.visualization.arrayToDataTable(cdata.data);
		// Set chart options
		var options = {
			'width':1000,
			'height':500,
			series: {
				0: {axis: 'Reward'},
				1: {axis: 'Total'}
			},
			axes: {
				y: {
					Reward: {label: 'Block Rewards'},
					Total: {label: 'Total Mined'}
				}
			},
			backgroundColor: '#f0f0f0',
			fontName: 'Open Sans Light',
			vAxis: {
				format: 'decimal'
			},
			hAxis: {
				format: 'decimal'
			}				
		};

		// Instantiate and draw our chart, passing in some options.
		var chart = new google.charts.Line(document.getElementById('chart_rewards_date'));
		chart.draw(data, google.charts.Line.convertOptions(options));
	}
});

$.getJSON('json/rewards-height.php', function(cdata) {
	if(cdata.sucess)
	{
		var data = new google.visualization.arrayToDataTable(cdata.data);
		// Set chart options
		var options = {
			'width':1000,
			'height':500,
			series: {
				0: {axis: 'Reward'},
				1: {axis: 'Total'}
			},
			axes: {
				y: {
					Reward: {label: 'Block Rewards'},
					Total: {label: 'Total Mined'}
				}
			},
			backgroundColor: '#f0f0f0',
			fontName: 'Open Sans Light',
			vAxis: {
				format: 'decimal'
			},
			hAxis: {
				format: 'decimal'
			}				
		};

		// Instantiate and draw our chart, passing in some options.
		var chart = new google.charts.Line(document.getElementById('chart_rewards_height'));
		chart.draw(data, google.charts.Line.convertOptions(options));
	}
});
}

function drawDiff() {
	var algo = $('#algo').val();
	$.getJSON('json/difficulty.php?algo=' + algo, function(cdata) {
		if(cdata.sucess)
		{
			$('#chart_difficulty').empty();
			var data = new google.visualization.arrayToDataTable(cdata.data);
			var options = {
				chart: {
					curveType: 'function'
				},
				'width':1000,
				'height':500,
				series: {
					0: {axis: 'Difficulty'}
				},
				axes: {
					y: {
						Reward: {label: 'Block Difficulty'}
					}
				},
				backgroundColor: '#f0f0f0',
				fontName: 'Open Sans Light',
				vAxis: {
					format: 'decimal'
				},
				hAxis: {
					format: 'decimal'
				}				
			};

			// Instantiate and draw our chart, passing in some options.
			var chart = new google.charts.Line(document.getElementById('chart_difficulty'));
			chart.draw(data, google.charts.Line.convertOptions(options));
			
		}
	});
}