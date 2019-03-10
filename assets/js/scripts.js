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

function showAlert(type, message) {
	// Clear old alert color class
	alertBox.removeClass(alertColor);
	// Show alert box
	alertBox.removeClass('hidden');
	// Set warning color
	alertBox.addClass('alert-'+type);
	// Set alert message
	alertMsg.html(message);
}

function checkLocation(latitude, longitude) {
	// If latitude and longitude are within the correct range
	if( (latitude >= -90 && latitude <= 90) && (longitude >= -180 && longitude <= 180) ) {
		// Location is correct
		return true;
	} else {
		// Set alert type and message
		showAlert('warning', 'Invalid location provided');
	}
}

function submitLocation(latitude, longitude) {
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
		if(response === 'success') {
			// Set alert type and message
			showAlert('success', 'Location obtained successfully');
			// Refresh current page
			location.reload();
		} else if(response === 'error') {
			// Set alert type and message
			showAlert('danger', 'A server error has occurred');
		}
	});
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

			// Check if the provided location coordinates are within the true range
			if( checkLocation(latitude, longitude) === true ) {
				// Round latitude and longitude to the a precision of 8 digiters after the decimal
				latitude = Math.floor(latitude * 1e8) / 1e8;
				longitude = Math.floor(longitude * 1e8) / 1e8;

				if(typeof csrfCookie !== 'undefined') {
					// Submit location via asynhronous request
					submitLocation(latitude, longitude);
				} else {
					// Set alert type and message
					showAlert('danger', 'Unable to read CSRF cookie');
				}
			}
		}, function(error) {
			switch(error.code) {
				case error.PERMISSION_DENIED:
					// Set alert type and message
					showAlert('danger', 'User denied the request for Geolocation');
					break;
				case error.POSITION_UNAVAILABLE:
					// Set alert type and message
					showAlert('danger', 'Location information is unavailable');
					break;
				case error.TIMEOUT:
					// Set alert type and message
					showAlert('danger', 'The request to get user location timed out');
					break;
				case error.UNKNOWN_ERROR:
					// Set alert type and message
					showAlert('danger', 'An unknown error occurred');
					break;
			}
		});
	} else {
		// Set alert type and message
		showAlert('danger', 'Geolocation is not supported by this browser');
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
