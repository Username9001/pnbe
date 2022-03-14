<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->string('latin_name');
            $table->string('author')->nullable();
            $table->string('botanical_references')->nullable();
            $table->string('family')->nullable();
            $table->string('common_name')->nullable();
            $table->string('habit')->nullable();
            $table->string('deciduous_evergreen')->nullable();
            $table->float('height')->nullable();
            $table->float('width')->nullable();
            $table->tinyInteger('hardyness')->nullable();
            $table->boolean('in_cultivation')->nullable();
            $table->text('medicinal')->nullable();
            $table->text('region')->nullable();
            $table->text('habitat')->nullable();
            $table->string('soil_pref')->nullable();
            $table->string('shade_pref')->nullable();
            $table->string('moisture_pref')->nullable();
            $table->boolean('well_drained')->nullable();
            $table->boolean('nitrogen_fixer')->nullable();
            $table->string('ph')->nullable();
            $table->boolean('acid')->nullable();
            $table->boolean('alkaline')->nullable();
            $table->boolean('saline')->nullable();
            $table->string('wind')->nullable();
            $table->string('growth_rate')->nullable();
            $table->string('pollution')->nullable();
            $table->boolean('poor_soil')->nullable();
            $table->boolean('drought')->nullable();
            $table->boolean('wildlife')->nullable();
            $table->boolean('woodland')->nullable();
            $table->boolean('meadow')->nullable();
            $table->boolean('wall')->nullable();
            $table->string('in_leaf')->nullable();
            $table->string('flowering_month')->nullable();
            $table->string('seed_ripens')->nullable();
            $table->string('flower_type')->nullable();
            $table->string('pollinators')->nullable();
            $table->string('self_fertile')->nullable();
            $table->text('hazards')->nullable();
            $table->text('synonyms')->nullable();
            $table->text('cultivation_details')->nullable();
            $table->text('edible_uses')->nullable();
            $table->text('uses_notes')->nullable();
            $table->text('propagation')->nullable();
            $table->boolean('cultivars')->nullable();
            $table->boolean('cultivars_in_cultivation')->nullable();
            $table->boolean('heavy_clay')->nullable();
            $table->boolean('pull_out')->nullable();
            $table->boolean('record_checked')->nullable();
            $table->tinyInteger('rating')->nullable();
            $table->string('frost_tender')->nullable();
            $table->text('site_specific_notes')->nullable();
            $table->boolean('scented')->nullable();
            $table->tinyInteger('medicinal_rating')->nullable();
            $table->tinyInteger('in_leaf_start')->nullable();
            $table->tinyInteger('in_leaf_end')->nullable();
            $table->tinyInteger('flowering_time_start')->nullable();
            $table->tinyInteger('flowering_time_end')->nullable();
            $table->tinyInteger('seed_ripens_start')->nullable();
            $table->tinyInteger('seed_ripens_end')->nullable();
            $table->tinyInteger('palatable_rating')->nullable();
            $table->tinyInteger('use_rating')->nullable();
            $table->tinyInteger('grow_rating')->nullable();
            $table->tinyInteger('overall_rating')->nullable();
            // wikipedia img
            $table->text('wiki_img')->nullable();
            // gbif identification
            $table->integer('gbif_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('species');
    }
}
