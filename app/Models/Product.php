<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Uuids, HasFactory, SoftDeletes;
    protected $guarded = [];

    public function devise(): ?BelongsTo
    {
        return $this->belongsTo(Devise::class);
    }
    public function orders(): ?BelongsToMany
    {
      return $this->belongsToMany(Order::class);
    }

    public function companies(): ?BelongsToMany
    {
      return $this->belongsToMany(Company::class);
    }

    public function companyProduct(): ?HasMany
    {
       return $this->hasMany(CompanyProduct::class);
    }
}
