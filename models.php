<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
  protected $guarded = [];

  protected $casts = [
    'translations' => 'array',
  ];

  public function subregions()
  {
    return $this->hasMany(Subregion::class);
  }

  public function countries()
  {
    return $this->hasMany(Country::class);
  }
}

class Subregion extends Model
{
  protected $guarded = [];
  protected $casts = [
    'translations' => 'array',
  ];

  public function region()
  {
    return $this->belongsTo(Region::class);
  }

  public function countries()
  {
    return $this->hasMany(Country::class);
  }
}

class Country extends Model
{
  protected $guarded = [];
  protected $casts = [
    'translations' => 'array',
    'timezones' => 'array',
    'latitude' => 'decimal:8',
    'longitude' => 'decimal:8',
  ];

  public function region()
  {
    return $this->belongsTo(Region::class);
  }

  public function subregion()
  {
    return $this->belongsTo(Subregion::class);
  }

  public function states()
  {
    return $this->hasMany(State::class);
  }

  public function districts()
  {
    return $this->hasMany(District::class);
  }

  public function cities()
  {
    return $this->hasMany(City::class);
  }
}

class State extends Model
{
  protected $guarded = [];
  protected $casts = [
    'latitude' => 'decimal:8',
    'longitude' => 'decimal:8',
  ];

  public function country()
  {
    return $this->belongsTo(Country::class);
  }

  public function districts()
  {
    return $this->hasMany(District::class);
  }

  public function cities()
  {
    return $this->hasMany(City::class);
  }
}

class District extends Model
{
  protected $guarded = [];
  protected $casts = [
    'translations' => 'array',
    'latitude' => 'decimal:8',
    'longitude' => 'decimal:8',
  ];

  public function state()
  {
    return $this->belongsTo(State::class);
  }

  public function cities()
  {
    return $this->hasMany(City::class);
  }
}

class City extends Model
{
  protected $guarded = [];
  protected $casts = [
    'translations' => 'array',
    'latitude' => 'decimal:8',
    'longitude' => 'decimal:8',
  ];

  public function state()
  {
    return $this->belongsTo(State::class);
  }

  public function district()
  {
    return $this->belongsTo(District::class);
  }
}
