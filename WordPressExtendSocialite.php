<?php

namespace CaesarDev\SocialiteProviderWordPressCustomEndpoint;

use SocialiteProviders\Manager\SocialiteWasCalled;

class WordPressExtendSocialite
{
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('wordpress', __NAMESPACE__.'\Provider');
    }
}
