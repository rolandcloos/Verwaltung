<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
    ];

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
    ];



    /**
     * Get the Role.Name of the UserID.
     *
     * 
     */
    public static function getRole($id) {
        $roles = User::leftjoin('roles', 'roles.id', '=', 'users.roleID')
                            ->select('roles.name')
                            ->where('users.id', $id)
                            //->get();
                            ->pluck('name');
        return $roles[0];
    }

    /**
     * get the Team under UserID.
     *
     * 
     */
    public static function getTeam($id) {
        $team = User::select('users.id', 'users.firstName', 'users.lastName')
                            ->where('users.teamID', $id)
                            ->get();
                            //->pluck('name');
        return $team;
    }
}
