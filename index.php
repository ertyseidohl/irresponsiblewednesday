<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="apple-touch-icon" sizes="57x57" href="/fav/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/fav/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/fav/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/fav/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/fav/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/fav/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/fav/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/fav/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/fav/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/fav/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/fav/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/fav/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/fav/favicon-16x16.png">
	<link rel="manifest" href="/fav/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<title>Irresponsible Wednesday</title>
	<script src="./moment.min.js" crossorigin="anonymous"></script>
	<script src="./jquery.min.js"></script>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
		<div class="header">
			<?php echo file_get_contents("Irresponsible.svg"); ?>
			<?php echo file_get_contents("Wednesday.svg"); ?>
		</div>
	</div>
	<div class="container">
		<h1>The Second Wednesday of Every Month</h1>
		<h2>A day of goofing off, dicking around, and general irresponsiblity</h2>
	</div>
	<div class="container">
		<h1>IS IT IRRESPONSIBLE WEDNESDAY?</h1>
		<h2 id="isit">Loading...</h2>
	</div>
	<div class="container">
		<p class="rules">The Rules:</p>
		<div class="rules-list">
			<ol>
				<li>Don't inconvenience others</li>
				<li>Don't harm your mind or body</li>
			</ol>
			<p class="rules">Otherwise, go wild</p>
		</div>
	</div>
	<div class="container image-container">
		<img src="lincoln.gif" />
		<img src="nixon.png" />
		<img src="matrix.png" />
		<img src="tinder.png" />
	</div>
	<script>
		// From https://stackoverflow.com/a/33620320/374601
		function getWednesdays(date) {
			var d = date || new Date(),
				month = d.getMonth(),
				wednesdays = [];

			d.setDate(1);

			// Get the first Monday in the month
			while (d.getDay() !== 3) {
				d.setDate(d.getDate() + 1);
			}

			// Get all the other Mondays in the month
			while (d.getMonth() === month) {
				wednesdays.push(new Date(d.getTime()));
				d.setDate(d.getDate() + 7);
			}

			return wednesdays;
		}
	</script>
	<script>
		var wednesdays = getWednesdays();

		function loop() {
			var itis = moment().startOf('day').isSame(moment(wednesdays[1]).startOf('day'));


			if (itis) {
				$('#isit').html('FUCK YEAH'.split('').map(function(f, i) {
					return '<span class="YEAH' + (i % 3) + '">' + f + '</span>';
				}));
				$('#isit').addClass('YEAH');
			} else {
				$('#isit').text('no.');
			}
			setTimeout(loop, 1000);
		}


		//via http://codepen.io/niorad/pen/xmfza

		// Easing excerpt from George McGinley Smith
		// http://gsgd.co.uk/sandbox/jquery/easing/
		jQuery.extend( jQuery.easing, {
			easeInOutQuad: function (x, t, b, c, d) {
				if ((t/=d/2) < 1) return c/2*t*t + b;
				return -c/2 * ((--t)*(t-2) - 1) + b;
			}
		});

		function SVG(tag) {
			return document.createElementNS('http://www.w3.org/2000/svg', tag);
		}


		function drawSVGPaths(_parentElement, _timeDelay) {
			var paths = $(_parentElement).find('path');
			$.each( paths, function(i) {
				var totalLength = this.getTotalLength();
				$(this).css({
					'stroke-dashoffset': totalLength,
					'stroke-dasharray': totalLength + ' ' + totalLength
				});

				$(this).delay(_timeDelay*i).animate({
					'stroke-dashoffset': 0
				}, {
					duration: 3000,
					easing: 'easeInOutQuad'
				});
			});
		}

		function startSVGAnimation(parentElement) {
			drawSVGPaths(parentElement, 50);
		}

		startSVGAnimation($('#irresponsible'));
		startSVGAnimation($('#wednesday'));

	</script>
	<p class="footer">by none other than <a href="http://erty.me">erty</a></p>
</body>
</html>
