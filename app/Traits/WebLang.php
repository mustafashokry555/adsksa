<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait WebLang
{

    protected function getLang()
    {
        return App::getLocale();
    }
}
