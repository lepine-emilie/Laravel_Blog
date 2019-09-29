<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Genert\BBCode\Facades\BBCode;

class BbcodeExtension extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        BBCode::addParser('color', '/\[color="?(.*?)"?\](.*?)\[\/color\]/si', '<font color="$1">$2</font>', '$2');
    }
}
