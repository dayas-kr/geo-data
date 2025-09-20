<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeographicalTables extends Migration
{
  public function up()
  {
    // Create regions table
    Schema::create('regions', function (Blueprint $table) {
      $table->id();
      $table->string('name', 100);
      $table->json('translations')->nullable();
      $table->timestamps();
      $table->tinyInteger('flag')->default(1);
      $table->string('wikiDataId')->nullable();
    });

    // Create subregions table
    Schema::create('subregions', function (Blueprint $table) {
      $table->id();
      $table->string('name', 100);
      $table->json('translations')->nullable();
      $table->unsignedMediumInteger('region_id');
      $table->timestamps();
      $table->tinyInteger('flag')->default(1);
      $table->string('wikiDataId')->nullable();

      $table->foreign('region_id')->references('id')->on('regions');
    });

    // Create countries table
    Schema::create('countries', function (Blueprint $table) {
      $table->id();
      $table->string('name', 100);
      $table->char('iso3', 3)->nullable();
      $table->char('numeric_code', 3)->nullable();
      $table->char('iso2', 2)->nullable();
      $table->string('phonecode')->nullable();
      $table->string('capital')->nullable();
      $table->string('currency')->nullable();
      $table->string('currency_name')->nullable();
      $table->string('currency_symbol')->nullable();
      $table->string('tld')->nullable();
      $table->string('native')->nullable();
      $table->string('region')->nullable();
      $table->unsignedMediumInteger('region_id')->nullable();
      $table->string('subregion')->nullable();
      $table->unsignedMediumInteger('subregion_id')->nullable();
      $table->string('nationality')->nullable();
      $table->text('timezones')->nullable();
      $table->text('translations')->nullable();
      $table->decimal('latitude', 10, 8)->nullable();
      $table->decimal('longitude', 11, 8)->nullable();
      $table->string('emoji', 191)->nullable();
      $table->string('emojiU', 191)->nullable();
      $table->timestamps();
      $table->tinyInteger('flag')->default(1);
      $table->string('wikiDataId')->nullable();

      $table->foreign('region_id')->references('id')->on('regions');
      $table->foreign('subregion_id')->references('id')->on('subregions');
    });

    // Create states table
    Schema::create('states', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->unsignedMediumInteger('country_id');
      $table->char('country_code', 2);
      $table->string('fips_code')->nullable();
      $table->string('iso2')->nullable();
      $table->string('iso3166_2', 10)->nullable();
      $table->string('type', 191)->nullable();
      $table->integer('level')->nullable();
      $table->integer('parent_id')->nullable();
      $table->string('native')->nullable();
      $table->decimal('latitude', 10, 8)->nullable();
      $table->decimal('longitude', 11, 8)->nullable();
      $table->string('timezone')->nullable();
      $table->timestamps();
      $table->tinyInteger('flag')->default(1);
      $table->string('wikiDataId')->nullable();

      $table->foreign('country_id')->references('id')->on('countries');
    });

    // Create districts table
    Schema::create('districts', function (Blueprint $table) {
      $table->id();
      $table->string('name', 100);
      $table->unsignedMediumInteger('state_id');
      $table->json('translations')->nullable();
      $table->decimal('latitude', 10, 8)->nullable();
      $table->decimal('longitude', 11, 8)->nullable();
      $table->timestamps();
      $table->tinyInteger('flag')->default(1);
      $table->string('wikiDataId')->nullable();

      $table->foreign('state_id')->references('id')->on('states');
    });

    // Create cities table
    Schema::create('cities', function (Blueprint $table) {
      $table->id();
      $table->string('name', 100);
      $table->unsignedInteger('state_id');
      $table->unsignedMediumInteger('district_id')->nullable();
      $table->json('translations')->nullable();
      $table->decimal('latitude', 10, 8)->nullable();
      $table->decimal('longitude', 11, 8)->nullable();
      $table->timestamps();
      $table->tinyInteger('flag')->default(1);
      $table->string('wikiDataId')->nullable();

      $table->foreign('state_id')->references('id')->on('states');
      $table->foreign('district_id')->references('id')->on('districts');
    });
  }

  public function down()
  {
    Schema::dropIfExists('cities');
    Schema::dropIfExists('districts');
    Schema::dropIfExists('states');
    Schema::dropIfExists('countries');
    Schema::dropIfExists('subregions');
    Schema::dropIfExists('regions');
  }
}
