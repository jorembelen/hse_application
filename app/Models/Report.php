<?php

namespace App\Models;

use App\Traits\IncidentTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Report extends Model
{
    use HasFactory, IncidentTraits;

    public $incrementing = false;
    protected $dates = ['safety'];

    public $fillable = [
        'incident_id',
        'user_id',
        'employee_id',
        'location_id',
        'safety',
        'proof_training',
        'proof',
        'inc_img',
        'mgr_name',
        'sup_name',
        'inc_loc',
        'nature',
        'other',
        'description',
        'details',
        'aid',
        'aider',
        'hosp',
        'hospital',
        'hos_addr',
        'med_leave',
       'leave_days',
        'prop_dam',
        'est_dam',
        'est_amt',
        'property',
        'prop_loc',
        'prop_manuf',
        'prop_model',
        'prop_plate',
        'prop_reg',
        'prop_rte',
        'toolbox',
        'ppe',
        'remarks',
        'ppe_equip',
        'emp_doing',
        'emp_machine',
        'emp_material',
        'imm_cause',
        'rootcause_id',
        'recommendation_id',
        'witness',
        'wit_type',
        'wit_details',
        'wit_statement',
        'docs'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function incident()
    {
        return $this->belongsTo(Incident::class, 'incident_id')->withDefault();
    }

    public function officer()
    {
        return $this->belongsTo(Employee::class, 'employee_id')->withDefault();
    }
    public function manager()
    {
        return $this->belongsTo(Employee::class, 'mgr_name')->withDefault();
    }
    public function supervisor()
    {
        return $this->belongsTo(Employee::class, 'sup_name')->withDefault();
    }
    public function nurse()
    {
        return $this->belongsTo(Employee::class, 'aider')->withDefault();
    }
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id')->withDefault();
    }

    public function rootcause()
    {
        return $this->hasMany(RootCause::class);
    }

    public function remark()
    {
        return $this->hasMany(Remark::class);
    }

    public function review()
    {
        return $this->remark->map(function ($i) {
            return $i;
        });
    }

    public function name()
    {
        return $this->rootcause->map(function ($i) {
            return $i;
        });
    }




    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'reports', 'length' => 7, 'prefix' =>'IIR-']);
        });
    }
}
