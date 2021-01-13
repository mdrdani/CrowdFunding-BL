<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD

class OtpCode extends Model
{
    //
}
=======
use Illuminate\Support\Str;

class OtpCode extends Model
{
    public function user(){
        return $this->belongsTo("App\User");
    }
    //
    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    /**
     * The "booting" function of model
     *
     * @return void
     */
    protected static function boot() {
        static::creating(function ($model) {
            if ( ! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
>>>>>>> 5aeecad1696bc254717c55663a3dddecefb170d4
