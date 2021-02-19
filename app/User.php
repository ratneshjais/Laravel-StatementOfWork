<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use App\Models\Workflow;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function workflows()
    {
        return $this->hasMany('App\Models\Workflow',  'user_id' , 'id');
    }

    public static function getSidebarCount($user_id): array {   


        $creator = DB::table('sow')
        ->select('status', DB::raw('count(distinct id) as total'))
        ->where('creator_id' , $user_id)
        ->groupBy('status')
        ->pluck('total','status');
        
        $reviwerRoles = Role::findByName('reviewer');
        $reviwerrole_id = $reviwerRoles->id; 
       
        $action = DB::table('sow')
        ->join('workflows', 'sow.project_type_id', '=', 'workflows.project_type_id')
        ->join('roles', 'workflows.role_id', '=', 'roles.id')
        ->select('sow.status', DB::raw('count(distinct sow.id) as total'))
        ->where('workflows.user_id' , $user_id)
        ->whereRaw(DB::raw("roles.name = case when sow.status = 'sent_to_reviewer' then 'reviewer'
                                              when sow.status = 'sent_to_approver' then 'approver' 
                                         end"))
                                         ->where(function($query) use ($reviwerrole_id, $user_id)
                                            {
                                                foreach(Auth::user()->getRoleNames() as $v){
                                                if( 'reviewer' == $v ) {                                   
                                                    $query->whereRaw("sow.id in (select sow_id from sow_authorizations where user_id = $user_id and role_id = $reviwerrole_id and sow_authorizations.status = 'Pending')");
                                                }
                                            }
                                        })
        ->whereIn('sow.status' , array('sent_to_reviewer' , 'sent_to_approver'))
        ->groupBy('sow.status')
        ->pluck('total','status');
        return array('creator' => $creator,'action' => $action) ;
    }

    public static function topmostrole()
    {
        $all_role = Auth::user()->getRoleNames();
        $role_arr = array(0 => "super-admin",1 => "approver",2 => "reviewer",3 => "creator");
        $temp = array();
        foreach($all_role as $role){
            $key = array_search($role, $role_arr);
            $temp[$key] = $role;
        }
        $role_id = min(array_keys($temp));
        return ucfirst($role_arr[$role_id]);
    }
}   