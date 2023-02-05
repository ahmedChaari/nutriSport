<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use Uuids ,HasFactory, SoftDeletes;
    protected $guarded = [];

      public function users(): ?HasMany
     {
        return $this->hasMany(User::class);
     }

     public function devises(): ?HasMany
     {
        return $this->hasMany(Devise::class);
     }

     public function orders(): ?HasMany
     {
        return $this->hasMany(Order::class);
     }


     public function paymentTypes(): ?HasMany
     {
        return $this->hasMany(PaymentType::class);
     }

     public function products(): ?BelongsToMany
     {
       return $this->belongsToMany(Product::class);
     }


     public function companyProduct(): ?HasMany
    {
       return $this->hasMany(CompanyProduct::class);
    }
}




