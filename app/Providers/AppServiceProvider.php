<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\danhmuc;
use App\Models\nhanhieu;
use App\Models\sanpham;
use App\Helper\cart;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        view()->composer('*',function($view){
            $view->with([
                'danhmuc'=>danhmuc::all(),
                'nhanhieu'=>nhanhieu::all(),
                'sp'=>sanpham::search()->paginate(10),
                
                'cart'=>new cart(),
                'sp'=>sanpham::search()->paginate(10),
                // 'sanpham_i'=>sanpham::orderBy('id','DESC')->paginate(10),
                // 'nv'=>nhanvien::all(),
                // 'slide'=>slide::orderBy('id','DESC')->get(),
            ]);

        });
    }
}
