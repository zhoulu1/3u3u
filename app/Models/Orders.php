<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'recycler_id', 'category_id', 'weight', 'total_amount', 'weight_desc', 'integral', 'appointment_time', 'remark', 'address', 'status'
    ];

    const STATUS_PENDING    = 'pending';
    const STATUS_DELIVERING = 'delivering';
    const STATUS_CANCLE     = 'cancle';
    const STATUS_FINISHED   = 'finished';

    public static $statusMap = [
        self::STATUS_PENDING    => '待取件',
        self::STATUS_DELIVERING => '上门中',
        self::STATUS_CANCLE     => '已取消',
        self::STATUS_FINISHED   => '已完成',
    ];

    protected $casts = [
        'address'   => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
