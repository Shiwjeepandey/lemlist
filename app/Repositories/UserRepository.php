<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class UserRepository extends BaseRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    public function getAll($extraParams = array()){
        $users = $this->_model->with('roles');
        $users->orderBy('id','desc')->get();
		
        return $users;
    }
    public function genrateUserResponseCollection($user){
        $inc = 1;
        $data = array();
        if(!empty($user)){
            foreach($user as $usr){
                $editPath = route('admin.subadmin.edit',['id'=>$usr->id]);
                $edit = '<a href="'.$editPath.'"><i class="la la-edit edit"></i></a>';
                $rPath = route('admin.subadmin.remove',['id'=>$usr->id]);
                $remove = '<a href="'.$rPath.'"><i class="la la-close delete"></i></a>';
                //$status =<span style="width:100px;"><span class="badge-text badge-text-small info">Paid</span></span>
                $data[]= array(
                    'inc'=>$inc++,
                    'name'=>$usr->name,
                    'phone'=>$usr->phone,
                    'email'=>$usr->email,
                    'role' =>$usr->roles->name,
                    'status'=>$usr->status,
                    'action'=>$edit.' '.$remove
                );
               
            }
        }
        return $data;
    }
    public function getAllUsers($notFewUsers=[],$order=""){
		$users = $this->_model;
        if(!empty($notFewUsers)){
            $users = $this->_model->whereNotIn('email',$notFewUsers);
        }
        if(!empty($order)){
            $usersData = $users->orderBy($order,'asc')->get();
        }else{
            $usersData = $users->orderBy('id','desc')->get();
        }
		return array('total'=>$users->count(),'data'=>$usersData);
	}

}