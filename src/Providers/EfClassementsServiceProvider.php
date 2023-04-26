<?php

namespace Azuriom\Plugin\EfClassements\Providers;

use Azuriom\Extensions\Plugin\BasePluginServiceProvider;
use Azuriom\Plugin\EfClassements\Models\Faction;
use Azuriom\Plugin\EfClassements\Models\Player;
use Azuriom\Plugin\EfClassements\Models\Ranking;
use Azuriom\Plugin\EfClassements\Observers\FactionObserver;
use Azuriom\Plugin\EfClassements\Observers\PlayerObserver;
use Azuriom\Plugin\EfClassements\Observers\RankingObserver;
use Illuminate\Database\Eloquent\Relations\Relation;

class EfClassementsServiceProvider extends BasePluginServiceProvider
{
    /**
     * The plugin's global HTTP middleware stack.
     *
     * @var array
     */
    protected array $middleware = [
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
    ];

    /**
     * The policy mappings for this plugin.
     *
     * @var array
     */
    protected array $policies = [
    ];

    /**
     * Register any plugin services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any plugin services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViews();

        $this->loadTranslations();

        $this->loadMigrations();

        $this->registerRouteDescriptions();

        $this->registerAdminNavigation();

        $this->registerUserNavigation();

        Relation::enforceMorphMap([
            'player' => 'Azuriom\Plugin\EfClassements\Models\Player',
            'faction' => 'Azuriom\Plugin\EfClassements\Models\Faction',
        ]);

        Faction::observe(FactionObserver::class);
        Ranking::observe(RankingObserver::class);
        Player::observe(PlayerObserver::class);
    }

    /**
     * Returns the routes that should be able to be added to the navbar.
     *
     * @return array
     */
    protected function routeDescriptions()
    {
        return [
            "ef-classements.index" => "Classement"
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
            'Ef-Classements' =>  [
                'name' => 'EfClassements',
                'type' => 'dropdown',
                'icon' => '',
                'route' => 'ef-classements-faction.admin.*',
                'permission' => 'ef-classements-faction.admin',
                'items' => [
                    'ef-classements.admin.settings' => trans('Paramètres'),
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
