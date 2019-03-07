<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ScopeFlight_dynamic extends Model
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
     * 可以帶參數查詢的 Scope。
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfActive($query, $type) {
        return $query->where('Active', '=', $type);
    }
}
