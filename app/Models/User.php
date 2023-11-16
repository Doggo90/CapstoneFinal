<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeFilter($query, array $filters){

        $query-> where('name', 'like', '%' . request('tag'). '%');

        if($filters['search'] ?? false){
            $query-> where('name', 'like', '%' . request('search'). '%')
            ->orWhere('email', 'like', '%' . request('search'). '%')
            ->orWhere('phone', 'like', '%' . request('search'). '%')
            ->orWhere('role', 'like', '%' . request('search'). '%');
        }

    }
    public static function generateUsername($username){
        if($username === null){
            $username = Str::lower(Str::random(8));
        }
        if(User::where('username',$username)->exists()){
            $newUsername = Str::lower(Str::random(8));
            $username = $newUsername.Str::lower(Str::random(3));
        }
        return $username;
    }
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
    public function likes(){
        return $this->belongsToMany(Post::class, 'post_like')->withTimestamps();
    }
    public function hasUpvoted(Post $post){
        return $this->likes()->where('post_id', $post->id)->exists();
    }
    public function organizations(): belongsTo
    {
        return $this->belongsTo(Organization::class);
    }
    public function canAccessPanel(Panel $panel): bool
    {
        return str_ends_with($this->role, 'admin') || str_ends_with($this->role, 'agent');
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
