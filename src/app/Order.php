<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * @var string
     */
    protected $table = 'orders';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'date',
        'total',
        'Shipping',
        'total_shipping',
        'user_discount',
        'grand_total',
        'note',
        'validation'
    ];


    /**
     * An Order can have many products
     *
     * @return $this
     */
    public function orderItems() {
        return $this->belongsToMany('App\Product')->withPivot('qty', 'price', 'reduced_price', 'total', 'total_reduced');
    }

    /**
     * One Product can have one Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user() {
        return $this->hasOne('App\User', 'id','user_id');
    }

}