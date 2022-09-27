<?php

namespace App\Codes\Models;

use App\Codes\Models\V1\LogActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Settings extends Model
{
    protected $table = 'setting';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'key',
        'value',
        'type'
    ];

    protected $appends = [
        'value_full',
    ];

    public function getValueFullAttribute()
    {
        if (strlen($this->value) > 0) {
            return env('OSS_URL').'/'.$this->value;
        }
        return asset('assets/cms/images/no-img.png');
    }

    public static function boot()
    {
        parent::boot();

        self::created(function($model){
            if (session()->get('admin_id')) {
                LogActivity::create([
                    'admin_id' => session()->get('admin_id'),
                    'admin_name' => session()->get('admin_name'),
                    'module' => 'setting',
                    'action' => 'store',
                    'module_id' => $model->id,
                    'new_data' => json_encode($model->toArray())
                ]);
            }
        });

        self::updated(function($model){
            Cache::forget('settings');
            if (session()->get('admin_id')) {
                $oldData = $model->toArray();
                $dataDifference1 = [];
                $dataDifference2 = [];
                foreach ($model->getOriginal() as $key => $value) {
                    if ($value != $oldData[$key]) {
                        $dataDifference1[$key] = $value;
                        $dataDifference2[$key] = $oldData[$key];
                    }
                }
                LogActivity::create([
                    'admin_id' => session()->get('admin_id'),
                    'admin_name' => session()->get('admin_name'),
                    'module' => 'setting',
                    'action' => 'update',
                    'module_id' => $model->id,
                    'old_data' => json_encode($dataDifference1),
                    'new_data' => json_encode($dataDifference2)
                ]);
            }
        });

        self::deleting(function($model){
            Cache::forget('settings');
            if (session()->get('admin_id')) {
                LogActivity::create([
                    'admin_id' => session()->get('admin_id'),
                    'admin_name' => session()->get('admin_name'),
                    'module' => 'setting',
                    'action' => 'destroy',
                    'module_id' => $model->id,
                    'old_data' => json_encode($model->toArray())
                ]);
            }
        });
    }

}
