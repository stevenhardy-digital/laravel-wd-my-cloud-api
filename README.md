# Laravel WD My Cloud Home API Package

## Installation

### Publish the config file
Run this command in your console:
`php artisan vendor:publish -tag=laravel-wd-my-cloud-api-config`

### Register for an app
1. Obtain a free developer account from here - https://developer.westerndigital.com/develop/wd-my-cloud-home/forms/mchoff/register-app-new-mchoff.html

2. Once your account is approved, add the keys to your `.env`:

```
MYCLOUD_CLIENT_ID=
MYCLOUD_CLIENT_SECRET=
```

3. Make a request to the below URL using your client ID WDC have provided:
```
https://<service.auth0.url>/authorize?
scope=openid%20offline_access%20nas_read_write%20nas_read_only%20user_read%20device_read
&response_type=code&connection=Username-Password-Authentication&sso=false
&audience=mycloud.com&state=my-custom-state&protocol=oauth2
&client_id=<client_id>&redirect_uri=http%3A%2F%2Flocalhost
```

Return `http://localhost/?code=&state=`
