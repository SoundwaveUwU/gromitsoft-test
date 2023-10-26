<?php namespace Soundwave\NestedTree\Models;

use Model;
use October\Rain\Database\Traits\NestedTree;
use October\Rain\Database\Traits\Validation;

/**
 * TreeNode Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class TreeNode extends Model
{
    use Validation;
    use NestedTree;

    /**
     * @var string table name
     */
    public $table = 'soundwave_nestedtree_tree_nodes';

    /**
     * @var array rules for validation
     */
    public $rules = [];

    public function getParentIdOptions()
    {
        return TreeNode::query()->listsNested('name');
    }
}
