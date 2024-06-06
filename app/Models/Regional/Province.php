<?php

namespace App\Models\Regional;

use App\Models\Regional\Regency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'provinces';

    public function regencies()
    {
        return $this->hasMany(Regency::class, 'no_province', 'no_province');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'no_province', 'no_province');
    }

    /**
     * Regency has many districts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
