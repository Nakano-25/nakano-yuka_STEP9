<?php

namespace App\Models;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'product_name',
        'price',
        'stock',
        'description',
        'img_path',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function likedBy($user)
    {
        if (!$user) {
            return false;
        }

        return $this->likedUsers()->where('user_id', $user->id)->exists();
    }
}