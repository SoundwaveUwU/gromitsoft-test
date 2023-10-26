<?php namespace Soundwave\NestedTree\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateTreeNodesTable Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
return new class extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::create('soundwave_nestedtree_tree_nodes', function(Blueprint $table) {
            $table->id();

            $table->string('wbs')->nullable();
            $table->string('name');

            $table->integer('parent_id')->nullable()->unsigned();
            $table->integer('nest_left')->nullable();
            $table->integer('nest_right')->nullable();
            $table->integer('nest_depth')->nullable();

            $table->timestamps();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('soundwave_nestedtree_tree_nodes');
    }
};
