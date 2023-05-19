<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
        'address'   => 'json'
    ];

    protected $appends = [
        'status_text',
    ];

    public function getStatusTextAttribute()
    {
        return $this::$statusMap[$this->status];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recycler(){
        return $this->belongsTo(User::class, 'recycler_id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    protected function appointmentTime(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('Y-m-d H:i', $value),
            set: fn ($value) => strtotime($value),
        );
    }

    public static function boot() 
    {
        parent::boot();
        // 监听模型创建事件，在写入数据库之前触发
        static::creating(function ($model) {
            // 如果模型的 no 字段为空
            if(!$model->order_no){
                // 调用 findAvailableNo 生成订单流水号
                $model->order_no = static::findAvailableNo();
                // 如果生成失败，则终止创建订单
                if(!$model->order_no){
                    return false;
                }
            }
        });
    }

    public static function findAvailableNo()
    {
        // 订单流水号前缀
        $prefix = date('Y');
        for ($i = 0; $i < 10; $i++) { 
            // 随机生成 6 位数字
            $order_no = $prefix.str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            // 判断是否已经存在
            if(!static::query()->where('order_no', $order_no)->exists()) {
                return $order_no;
            }
        }
        // \Log::warning('find order no failed');
        return false;
    }
}
