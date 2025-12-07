<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class NewAdministrator extends Component
{
    public $username = '';
    public $email = '';
    public $password = '';
    public $admin_role = '';
    public $password_confirmation = '';
    public $roles = [
        'Super Admin'=>'super_admin',
        'Operation manager'=>'operation_manager',
        'Moderator'=>'moderator',
        'Content manager'=>'content_manager',
        'Support assistance'=>'support_assistance'
    ];

    protected function rules(){
        return  [
            'username' => ['required','string'],
            'email' => ['required','email'],
            'password' => ['required','string','confirmed'],
            'admin_role' => ['required','string',Rule::in(array_values($this->roles))]
        ];
    }

    protected $validationAttributes = [
        'admin_role' => 'Admin role',
    ];

    public function save(){
        $this->validate();

        $admin = new Admin();
        $admin->name = $this->username;
        $admin->email = $this->email;
        $admin->password = Hash::make($this->password);
        $admin->admin_role = $this->admin_role;
        $admin->save();

        session()->flash('success','Successful! New administrator account created.');
        $this->reset();
    }
    public function render()
    {
        return view('livewire.admin.new-administrator');
    }
}
