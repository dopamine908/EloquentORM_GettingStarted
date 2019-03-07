<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Scope\DemoScope;
//use PhpParser\Builder;
use Illuminate\Database\Eloquent\Builder;

class ScopeFlight extends Model
{
    /**
     * The connection name for the model.
     * 為模型選擇連線名稱。
     * database.php 裡面 connections 的 key 可決定要連接的資料庫
     *
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * The table associated with the model.
     * 與模型關聯的資料表。
     *
     * @var string
     */
    protected $table = 'Flight';

    /**
     * The primary key for the model.
     * 設定表Id
     *
     * @var string
     */
    protected $primaryKey = 'FlightId';

    /**
     * The name of the "created at" column.
     * 新增時間欄位名稱
     *
     * @var string
     */
    const CREATED_AT = 'NewTime';

    /**
     * The name of the "updated at" column.
     * 更新時間欄位名稱
     *
     * @var string
     */
    const UPDATED_AT = 'UpdateTime';

    /**
     * 該模型的「啟動」方法。
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * 全域Scope
         */
        static::addGlobalScope(new DemoScope);

        /**
         * 匿名全域Scope
         */
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('Active', '=', 1);
        });
    }
}
