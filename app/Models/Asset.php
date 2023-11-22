<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\User;

class Asset extends Model
{
    protected $fillable = [
        'name',
        'employee_id',
        'purchase_date',
        'supported_date',
        'amount',
        'description',
        'created_by',
    ];
    public function users($users)
{
    $userArr = explode(',', $users);
    $resultUsers = [];

    foreach ($userArr as $user) {
        $emp = Employee::find($user);

        if ($emp) {
            $userObject = User::where('id', $emp->user_id)->first();
            if ($userObject) {
                $resultUsers[] = $userObject;
            }
        }
    }

    return $resultUsers;
}

}
