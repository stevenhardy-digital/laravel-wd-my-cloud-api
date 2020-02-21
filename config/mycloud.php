<?php 

return [
	'client_id' 	=> env('MYCLOUD_API_CLIENT'),
	'client_secret' => env('MYCLOUD_API_SECRET'),
	'redirect' 	=> env('MYCLOUD_REDIRECT_URI'),
	'url' 			=> env('MYCLOUD_API_URL')

	// Add this to your config/services.php file in your laravel project
	// 'mycloud' => [
	// 	'client_id' 	=> env('MYCLOUD_API_CLIENT'),
	// 	'client_secret' => env('MYCLOUD_API_SECRET'),
	// 	'redirect' 	=> env('MYCLOUD_REDIRECT_URI'),
	// 	'url' 			=> env('MYCLOUD_API_URL')
	// ],
];