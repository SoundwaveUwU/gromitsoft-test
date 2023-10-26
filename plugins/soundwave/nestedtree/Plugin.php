<?php namespace Soundwave\NestedTree;

use Backend;
use Soundwave\NestedTree\Models\TreeNode;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Многоуровневое дерево',
            'description' => 'Плагин позволяющий управлять многоуровневой древовидной схемой данных',
            'author' => 'Soundwave',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        //
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        //
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Soundwave\NestedTree\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'soundwave.nestedtree.some_permission' => [
                'tab' => 'NestedTree',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return [
            'nestedtree' => [
                'label' => 'NestedTree',
                'url' => Backend::url('soundwave/nestedtree/treenodes'),
                'icon' => 'icon-leaf',
                'permissions' => ['soundwave.nestedtree.*'],
                'order' => 500,
            ],
        ];
    }
}
