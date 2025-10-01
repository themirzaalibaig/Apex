<?php

namespace App\Providers;

use App\Models\Team;
use App\Models\Service;
use App\Models\Project;
use App\Models\Review;
use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

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
        Relation::enforceMorphMap([
            'service' => Service::class,
            'project' => Project::class,
            'team' => Team::class,
            'review' => Review::class,
            'menu' => Menu::class,
            'sub_menu' => SubMenu::class,
        ]);
    }
}
