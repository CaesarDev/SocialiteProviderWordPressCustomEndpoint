# WordPressCustomEndpoint
We use it for https://wp-oauth.com/ (I think so at least)

```bash
composer require CaesarDev/SocialiteProviderWordPressCustomEndpoint
```

## Installation & Basic Usage

Please see the [Base Installation Guide](https://socialiteproviders.com/usage/), then follow the provider specific instructions below.

### Add configuration to `config/services.php`

```php
'wordpress' => [
    'client_id' => env('WORDPRESS_KEY'),
    'client_secret' => env('WORDPRESS_SECRET'),
    'redirect' => env('WORDPRESS_REDIRECT_URI'),  
    'api_top_endpoint' => env('WORDPRESS_API_TOP_ENDPOINT'),
    'api_endpoint' => env('WORDPRESS_API_ENDPOINT'),
],
```

### Add provider event listener

Configure the package's listener to listen for `SocialiteWasCalled` events.

Add the event to your `listen[]` array in `app/Providers/EventServiceProvider`. See the [Base Installation Guide](https://socialiteproviders.com/usage/) for detailed instructions.

```php
protected $listen = [
    \SocialiteProviders\Manager\SocialiteWasCalled::class => [
        // ... other providers
        'CaesarDev\\SocialiteProviderWordPressCustomEndpoint\\WordPressExtendSocialite@handle',
    ],
];
```

### Usage

You should now be able to use the provider like you would regularly use Socialite (assuming you have the facade installed):

```php
return Socialite::driver('wordpress')->redirect();
```

### Returned User fields

- ``id``
- ``nickname``
- ``name``
- ``email``
- ``avatar``
