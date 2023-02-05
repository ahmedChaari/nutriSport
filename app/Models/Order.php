<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use Uuids, HasFactory, SoftDeletes;

    public function company(): ?BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function paymentType(): ?BelongsTo
    {
        return $this->belongsTo(PaymentType::class);
    }
     public function products(): ?BelongsToMany
     {
       return $this->belongsToMany(Product::class);
     }

     public function user(): ?BelongsTo
    {
      return $this->belongsTo(User::class);
    }
}
