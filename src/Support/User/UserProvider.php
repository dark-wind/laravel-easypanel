<?php

namespace EasyPanel\Support\User;

class UserProvider
{

    public function makeAdmin($id)
    {
        $user = $this->findUser($id);
        $modelInstance = app()->make(config('easy_panel.user_model'));
        if(in_array(config('easy_panel.column'), $modelInstance->getFillable())) {
            $user->update([
                config('easy_panel.column') => 1
            ]);
            return true;
        }

        return false;
    }

    public function getAdmins()
    {
        $users = config('easy_panel.user_model')::query()->where(config('easy_panel.column'), true)->get();

        return $users;
    }

    public function findUser($id)
    {
        return config('easy_panel.user_model')::query()->findOrFail($id);
    }

    public function deleteAdmin($id)
    {
        $user = $this->findUser($id);
        $user->update([
            config('easy_panel.column') => false
        ]);
    }

}
