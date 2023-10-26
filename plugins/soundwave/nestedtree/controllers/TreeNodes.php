<?php namespace Soundwave\NestedTree\Controllers;

use Backend\Behaviors\RelationController;
use Backend\Classes\Controller;
use BackendMenu;
use Soundwave\NestedTree\Models\TreeNode;

/**
 * Tree Nodes Backend Controller
 *
 * @link https://docs.octobercms.com/3.x/extend/system/controllers.html
 */
class TreeNodes extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        RelationController::class,
    ];

    /**
     * @var string formConfig file
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string listConfig file
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var string relationConfig file
     */
    public $relationConfig = 'config_relation.yaml';

    /**
     * @var array required permissions
     */
    public $requiredPermissions = ['soundwave.nestedtree.treenodes'];

    /**
     * __construct the controller
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Soundwave.NestedTree', 'nestedtree', 'treenodes');
    }

    public function listGetConfig($definition)
    {
        $config = $this->asExtension('ListController')->listGetConfig($definition);

        // Implement structure dynamically
        $config->structure = [
            'structure' => true
        ];

        return $config;
    }

    public function listAfterReorder()
    {
        $tree = (new TreeNode)->getAllRoot();

        foreach ($tree as $index => $rootItem) {
            $rootItem->wbs = $index + 1;
            $rootItem->save();

            if ($rootItem->children()->count() > 0) {
                $this->updateChildrenWbs($rootItem);
            }
        }
    }

    public function updateChildrenWbs($parent)
    {
        foreach ($parent->children as $index => $child) {
            $child->wbs = $parent->wbs . '.' . ($index + 1);
            $child->save();

            if ($child->children()->count() > 0) {
                $this->updateChildrenWbs($child);
            }
        }
    }

}
