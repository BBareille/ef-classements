<?php

namespace Azuriom\Plugin\EfClassements\Providers;

use Azuriom\Extensions\Plugin\BasePluginServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class RankFactionServiceProvider extends BasePluginServiceProvider
{
    /**
     * The plugin's global HTTP middleware stack.
     *
     * @var array
     */
    protected array $middleware = [
        // \Azuriom\Plugin\RankFaction\Middleware\ExampleMiddleware::class,
    ];

    /**
     * The plugin's route middleware groups.
     *
     * @var array
     */
    protected array $middlewareGroups = [];

    /**
     * The plugin's route middleware.
     *
     * @var array
     */
    protected array $routeMiddleware = [
        // 'example' => \Azuriom\Plugin\RankFaction\Middleware\ExampleRouteMiddleware::class,
    ];

    /**
     * The policy mappings for this plugin.
     *
     * @var array
     */
    protected array $policies = [
        // User::class => UserPolicy::class,
    ];

    /**
     * Register any plugin services.
     *
     * @return void
     */
    public function register()
    {
//        require_once __DIR__.'/../../vendor/autoload.php';

        //
    }

    /**
     * Bootstrap any plugin services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();


        $this->loadViews();

        $this->loadTranslations();

        $this->loadMigrations();

        $this->registerRouteDescriptions();

        $this->registerAdminNavigation();

        $this->registerUserNavigation();

        Relation::enforceMorphMap([
            'player' => 'Azuriom\Models\Player',
            'faction' => 'Azuriom\Models\Faction',
        ]);
    }

    /**
     * Returns the routes that should be able to be added to the navbar.
     *
     * @return array
     */
    protected function routeDescriptions()
    {
        return [
            "ef-classements.index" => "Classement faction"
        ];
    }

    /**
     * Return the admin navigations routes to register in the dashboard.
     *
     * @return array
     */
    protected function adminNavigation()
    {
        return [
            'RankFaction' =>  [
                'name' => 'RankFaction',
                'type' => 'dropdown',
                'icon' => '',
                'route' => 'ef-classements-faction.admin.*',
                'permission' => 'ef-classements-faction.admin',
                'items' => [
                    'ef-classements.admin.settings' => trans('Settings'),
                ],
            ],
        ];
    }

    /**
     * Return the user navigations routes to register in the user menu.
     *
     * @return array
     */
    protected function userNavigation()
    {
        return [
            //
        ];
    }


}
