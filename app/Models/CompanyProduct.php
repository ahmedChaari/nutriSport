<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyProduct extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'company_product';


    public function company(): ?BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function product(): ?BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
