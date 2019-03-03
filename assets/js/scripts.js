var csrfCookie, getLocation, alertBox, alertMsg, closeBtn, latitude, longitude;

csrfCookie = Cookies.get('csrf_cookie');

getLocation = $('#getLocation');
alertBox = $('.alert');
alertMsg = $('#alert');
closeBtn = $('.close');

// Callback functiion to match alert color classes
function alertColor(index, className) {
	// Return all classes starting with alert-color pattern
	return (className.match (/(^|\s)alert-\S+/g) || []).join(' ');
}

// Get location button event listener
getLocation.click(function() {
	// Check if browser supports geolocation
	if(navigator.geolocation) {
		// Get the user position object
		navigator.geolocation.getCurrentPosition(function(position) {
			// Retrieve the latitude and longitde from the position object
			latitude = position.coords.latitude;
			longitude = position.coords.longitude;

			// If latitude and longitude are within the correct range
			if( (latitude >= -90 && latitude <= 90) && (longitude >= -180 && longitude <= 180) ) {
				// Round latitude and longitude to the a precision of 8 digiters after the decimal
				latitude = Math.floor(latitude * 1e8) / 1e8;
				longitude = Math.floor(longitude * 1e8) / 1e8;
			} else {
				// Clear old alert color class
				alertBox.removeClass(alertColor);
				// Show alert box
				alertBox.removeClass('hidden');
				// Set warning color
				alertBox.addClass('alert-warning');
				// Out of range error message
				alertMsg.html('Invalid location provided');
			}

			if(typeof csrfCookie !== 'undefined') {
				// Formulate POST request with parameters
				var request = {
					'latitude' : latitude,
					'longitude' : longitude,
					'csrf_token' : csrfCookie,
				};

				// Submit aJax request to endpoint
				$.ajax({
					async: true,
					type: 'POST',
					url: 'location',
					dataType: 'text',
					data: request,
				}).done(function(response) {
					response = 'success';
					if(response === 'success') {
						// Clear old alert color class
						alertBox.removeClass(alertColor);
						// Show alert box
						alertBox.removeClass('hidden');
						// Set success color
						alertBox.addClass('alert-success');
						// Location was stored successfully message
						alertMsg.html('Location obtained successfully');

						// Refresh current page
						location.reload();
					} else if(response === 'error') {
						// Clear old alert color class
						alertBox.removeClass(alertColor);
						// Show alert box
						alertBox.removeClass('hidden');
						// Set danger color
						alertBox.addClass('alert-danger');
						// Location storage was not successful
						alertMsg.html('A server error has occurred');
					}
				});
			} else {
				// Clear old alert color class
				alertBox.removeClass(alertColor);
				// Show alert box
				alertBox.removeClass('hidden');
				// Set danger color
				alertBox.addClass('alert-danger');
				// Failute to read the cookie
				alertMsg.html('Unable to read CSRF cookie');
			}
		}, function(error) {
			// Clear old alert color class
			alertBox.removeClass(alertColor);
			// Show alert box
			alertBox.removeClass('hidden');
			// Set danger color
			alertBox.addClass('alert-danger');

			switch(error.code) {
				case error.PERMISSION_DENIED:
					// Set error message
					alertMsg.html('User denied the request for Geolocation');
					break;
				case error.POSITION_UNAVAILABLE:
					// Set error message
					alertMsg.html('Location information is unavailable');
					break;
				case error.TIMEOUT:
					// Set error message
					alertMsg.html('The request to get user location timed out');
					break;
				case error.UNKNOWN_ERROR:
					// Set error message
					alertMsg.html('An unknown error occurred');
					break;
			}
		});
	} else {
		// Clear old alert color class
		alertBox.removeClass(alertColor);
		// Show alert box
		alertBox.removeClass('hidden');
		// Set danger color
		alertBox.addClass('alert-danger');
		// Set error message
		alertMsg.html('Geolocation is not supported by this browser');
	}
});

// Custom alert close button function
closeBtn.click(function() {
	// Hide alert box
	alertBox.addClass('hidden');
	// Clear color class
	alertBox.removeClass(alertColor);
	// Remove alert text
	alertMsg.html('');
});
