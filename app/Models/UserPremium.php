<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPremium extends Model
{
    use HasFactory;

    protected $table = 'user_premiums';

    protected $guarded = ['id'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
