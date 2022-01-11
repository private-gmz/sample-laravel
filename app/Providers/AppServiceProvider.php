<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $productImgPath = 'upload/products/';
        $productImg = 'upload/no_image.jpg';
        $adminImgPath = 'upload/admin_images/';
        $userImgPath = 'upload/user_images/';
        $userImg = 'upload/default.jpg';

        config(['default_product_image' => $productImg,
            'default_user_image' => $userImg,
            'default_product_image_path' => $productImgPath,
            'default_admin_image_path' => $adminImgPath,
            'default_user_image_path' => $userImgPath,
        ]);
    }
}
