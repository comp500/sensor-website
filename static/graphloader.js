window.addEventListener("load", function(event) {
	var currentSeconds = parseInt(document.getElementsByClassName("measurementTime")[0].innerText);
	window.setInterval(function () {
		currentSeconds++;
		var timeElements = document.getElementsByClassName("measurementTime");
		for (var i = 0; i < timeElements.length; i++) {
			timeElements[i].innerText = currentSeconds;
		}
	}, 1000);
	
	var createGraphs = function (ajaxdata) {
		for (var i = 0; i < ajaxdata.metadata.length; i++) {
			var meta = ajaxdata.metadata[i];
			meta.unit = meta.unit.replace(/&#176;/g, String.fromCharCode(176)); // fix degree symbol
			new Chart(document.getElementById("graph-" + meta.sensorID).getContext("2d"), {
				type: 'line',
				data: {
					labels: ["-195", "-190", "-185", "-180", "-175", "-170", "-165", "-160", "-155", "-150", "-145", "-140", "-135", "-130", "-125", "-120", "-115", "-110", "-105", "-100", "-95", "-90", "-85", "-80", "-75", "-70", "-65", "-60", "-55", "-50", "-45", "-40", "-35", "-30", "-25", "-20", "-15", "-10", "-5", "0"],
					datasets: [{
						label: meta.measurement + " (" + meta.unit + ")",
						backgroundColor: meta.color,
						borderColor: meta.color,
						data: ajaxdata.values[meta.sensorID],
						fill: false
					}]
				},
				options: {
					responsive: true,
					pointRadius: 0,
					tooltips: {
						mode: 'index',
						intersect: false,
					},
					hover: {
						mode: 'nearest',
						intersect: true
					},
					scales: {
						xAxes: [{
							display: true,
							// type: 'time',
							distribution: 'series',
							scaleLabel: {
								display: true,
								labelString: 'Time (Mins ago)',
								fontFamily: "sans-serif"
							}
							/*
							time: {
                    						unit: 'minute'
                					}
							*/
						}],
						yAxes: [{
							display: true,
							ticks: {
								min: meta.min,
								max: meta.max
							},
							scaleLabel: {
								display: true,
								labelString: meta.measurement
							}
						}]
					}
				}
			});
		}
	};
	
	var oReq = new XMLHttpRequest();

	oReq.onreadystatechange = function () {
		if (oReq.readyState === XMLHttpRequest.DONE) {
			if (oReq.status === 200) {
				console.log(JSON.parse(this.responseText));
				createGraphs(JSON.parse(this.responseText));
			} else {
				console.log(oReq.status);
			}
		}
	};

	oReq.open("GET", "/data.json");
	oReq.send();
}, false);
