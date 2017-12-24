var graph = {
	queryParams: {
		currentStep: 0,
		dates: [],
		rates: [],
		ajax_dates: [],
		period: 0,
		defaultPeriod: 3,
		currentCurrency: 'RUB',
	},

	ui: {
		periodButtons: '',
		select: '',
		preloader: ''
	},

	init: function() {
		var ctrl = this;
		ctrl.ui.periodButtons = $('[data-cg-get-days]');
		ctrl.ui.select = $('[data-cg-currency-list]');
		ctrl.ui.preloader = $('.cg-preloader');
		ctrl.queryParams.currentCurrency = ctrl.ui.select.val();

		ctrl.createChart();

		ctrl.events();

		ctrl.getDataByPeriod(ctrl.queryParams.currentCurrency, ctrl.queryParams.defaultPeriod);

		ctrl.ui.periodButtons.filter('[data-cg-get-days=' + ctrl.queryParams.defaultPeriod + ']')
		.addClass('cg-periods__item_active').attr('disabled', 'disabled');
	},

	events: function() {
		var ctrl = this;

		ctrl.ui.periodButtons.click(function() {
			ctrl.queryParams.period = parseInt($(this).attr('data-cg-get-days'));
			console.log(ctrl.queryParams.period);
			ctrl.getDataByPeriod(ctrl.queryParams.currentCurrency, ctrl.queryParams.period);
			ctrl.ui.periodButtons.removeClass('cg-periods__item_active').removeAttr('disabled');
			$(this).addClass('cg-periods__item_active').attr('disabled', 'disabled');
		});

		ctrl.ui.select.change(function() {
			ctrl.queryParams.currentCurrency = $(this).val();
			ctrl.getDataByPeriod(ctrl.queryParams.currentCurrency, ctrl.queryParams.defaultPeriod);
			ctrl.ui.periodButtons.removeClass('cg-periods__item_active').removeAttr('disabled');
			ctrl.ui.periodButtons.filter('[data-cg-get-days=' + ctrl.queryParams.defaultPeriod + ']')
			.addClass('cg-periods__item_active').attr('disabled', 'disabled');
		});
	},

	preload: function(state = true) {
		var ctrl = this;
		if (state) {
			ctrl.ui.preloader.show();
		} else {
			ctrl.ui.preloader.hide();
		}
	},

	getData: function(dates) {
		var ctrl = this;
		ctrl.preload(true);
		console.log(ctrl.queryParams.currentCurrency);
		$.ajax({
			url: window.cg_ajax_url,
			timeout: 0,
			data: {
				action: 'cg_get_by_date',
				dates: JSON.stringify(ctrl.queryParams.ajax_dates),
				currency: ctrl.queryParams.currentCurrency
			},
		})
		.done(function(data) {
			console.log(data);
			var json = JSON.parse(data);
			ctrl.addRate(json);
			console.log('UPD');
			ctrl.preload(false);
			ctrl.updateChart(ctrl.queryParams.dates, ctrl.queryParams.rates);
		});
	},

	getDataByPeriod: function(currency, period) {
		var ctrl = this;
		ctrl.queryParams.dates = [];
		ctrl.queryParams.period = period;
		ctrl.queryParams.currentCurrency = currency;
		ctrl.queryParams.ajax_dates = [],
		today = new Date();

		for (var i = period; i > 0; i--) {
			var day = new Date(today);
			day.setDate(today.getDate() - i);
			var dd = day.getDate();
			var mm = day.getMonth()+1;
			var yyyy = day.getFullYear();

			if(dd<10){
				dd='0'+dd;
			} 
			if(mm<10){
				mm='0'+mm;
			} 

			var day = yyyy.toString() + mm.toString() + dd.toString();
			ctrl.queryParams.ajax_dates.push(day);

			var day = dd + '.' + mm + '.'  + yyyy;
			ctrl.queryParams.dates.push(day);
		}

		ctrl.queryParams.rates = [];
		ctrl.queryParams.currentStep = 0;

		ctrl.getData(ctrl.queryParams.ajax_dates);
	},

	updateChart: function(dates, rates) {
		var ctrl = this;
		ctrl.chart.data.labels = dates;
		ctrl.chart.data.datasets.forEach((dataset) => {
			dataset.data = rates;
			dataset.label = ctrl.queryParams.currentCurrency + "/UAH";
		});

		ctrl.chart.update();
	},

	addRate: function(rate) {
		var ctrl = this;

		rate.forEach(function(item, i){
			ctrl.queryParams.rates.push(item['0']['rate']);
		})
	},

	createChart: function() {
		var ctrl = this;

		var ctx = document.getElementById('myChart').getContext('2d');
		ctrl.chart = new Chart(ctx, {
			type: 'line',
			data: {
				datasets: [{
					label: "",
					backgroundColor: 'rgb(255, 99, 132)',
					borderColor: 'rgb(255, 99, 132)',
					fill: false
				}]
			},

			options: {
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
						scaleLabel: {
							display: true,
							labelString: 'Day'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Value'
						}
					}]
				}
			}
		});
	}
};

