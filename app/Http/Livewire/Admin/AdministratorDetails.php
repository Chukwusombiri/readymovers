<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdministratorDetails extends Component
{
    Use WithFileUploads;

    public $admin;
    public $name = '';
    public $email ='';
    public $phone ='';
    public $newPhoto;
    public $admin_role ='';
    public $address ='';
    public $nationality ='';
    public $city ='';
    public $country ='';
    public $marital_status ='';
    public $age ='';
    public $gender ='';
    public $cv;
    public $bio ='';
    public $spoken_languages =[];
    public $isSuspended =false;
    public $roles = [
        'Super Admin'=>'super_admin',
        'Operation manager'=>'operation_manager',
        'Moderator'=>'moderator',
        'Content manager'=>'content_manager',
        'Support assistance'=>'support_assistance'
    ];
    public $validLanguages = ['English','French','Spanish','Portugese','Chinese','Arabic','Hindu',];
    public $otherLang = '';
    public $maritalStatuses = ['married','single','divorced','widowed',];
    public $genders = ['male','female','others'];

    protected $listeners = [
        'savedLanguages' => '$refresh',
        'savedUserDetails' => '$refresh',
        'savedBioData'=>'$refresh',
    ];

    public function mount(Admin $sentAdmin){
        if($sentAdmin->exists()){
            $this->admin = $sentAdmin;
            $this->name = $sentAdmin->name;
            $this->email =$sentAdmin->email;
            $this->phone =$sentAdmin->phone ?? '';                       
            $this->admin_role =$sentAdmin->admin_role;
            $this->address =$sentAdmin->address ?? '';
            $this->nationality =$sentAdmin->nationality ?? '';
            $this->city =$sentAdmin->city ?? '';
            $this->country =$sentAdmin->country ?? '';
            $this->marital_status =$sentAdmin->marital_status ?? '';
            $this->age =$sentAdmin->age ?? '';
            $this->gender =$sentAdmin->gender ?? '';
            $this->bio =$sentAdmin->bio ?? '';
            if($sentAdmin->spoken_languages){
                $languages = json_decode($sentAdmin->spoken_languages,true);
                foreach ($languages as $key => $language) {
                    $this->spoken_languages[]=$language;
                }
            }
            $this->isSuspended =$sentAdmin->isSuspended;
        }
    }

    public function addLanguage(){
        $this->validate([
            'otherLang' => 'required|string',
        ],[
            'otherLang' => 'Other Language'
        ],[
            'otherLang.required' => 'Other language is required before you click "add".'
        ]);
        if (strpos($this->otherLang, ',') !== false) {            
            $dataArray = explode(',', $this->otherLang);            
            // Trim each array element to remove any leading/trailing whitespace
            $dataArray = array_map('trim', $dataArray);     
            foreach($dataArray as $key => $value) {
                $this->spoken_languages[] = $value;
            }
        }else{
            $this->spoken_languages[] = $this->otherLang;
        }        
        $this->otherLang = '';
        session()->flash('otherLang','Added to spoken Languages, Go ahead to save section');
    }

    public function removeLanguage($index){               
        unset($this->spoken_languages[$index]);     
        $this->spoken_languages = array_values($this->spoken_languages);     
    }

    public function saveLanguage(){
        $this->validate([
            'spoken_languages' => 'required|array',
            'spoken_languages.*' => 'required|string',
        ],[
            'spoken_languages' => 'Spoken Languages',
            'spoken_languages.*' => 'Selected Spoken Languages',
        ]);

        $this->admin->spoken_languages = json_encode($this->spoken_languages);
        $this->admin->save();
        $this->emit('savedLanguages');
    }

    public function saveUserDetails(){
        $this->validate([
            'name' => 'required|string|max:225',
            'email' => 'required|email',
            'phone' => [Rule::excludeIf($this->phone==''),'regex:/^(\+[0-9] ?+|[0-9] ?+){6,14}[0-9]$/'],
            'admin_role' => ['required','string',Rule::in(array_values($this->roles))],            
            'newPhoto' => [Rule::excludeIf(!$this->newPhoto),'image','max:2034'],
        ],[],[
            'newPhoto' => 'New profile photo',
            'admin_role' => 'Admin role',
        ]);

        try{
            $this->admin->name = $this->name;
            $this->admin->email = $this->email;
            $this->admin->phone = $this->phone;
            $this->admin->admin_role = $this->admin_role;
            if($this->newPhoto){
                if($this->admin->profile_photo_path){
                    Storage::disk('public')->delete($this->admin->profile_photo_path);
                }                
                $this->admin->profile_photo_path = $this->newPhoto->store('profile-photos','public');
            }
            $this->admin->save();
            $this->emit('savedUserDetails');
        }catch(\Throwable $th){
            Log::error('Unable to save user details: '.$th->getMessage());
            $this->emit('saveUserDetailFailed');
        }        
    }

    public function saveOtherDetails(){
        $this->validate([
            'age' => [Rule::excludeIf($this->age===''),'numeric','integer'],
            'bio' => [Rule::excludeIf($this->bio===''),'string',],
            'gender' => [Rule::excludeIf($this->gender===''),'string',Rule::in($this->genders)],
            'marital_status' => [Rule::excludeIf($this->marital_status===''),'string',Rule::in($this->maritalStatuses)],
            'country' => [Rule::excludeIf($this->country===''),'string',],
            'city' => [Rule::excludeIf($this->city===''),'string',],
            'nationality' => [Rule::excludeIf($this->nationality===''),'string',],
            'address' => [Rule::excludeIf($this->address===''),'string',],
            'isSuspended' => ['required','boolean',],
            'cv' => [Rule::excludeIf(!$this->cv),'file','mimes:pdf,doc,docx'],
        ],[],[
            'marital_status' => 'Marital status',
        ]);

        try {
            $this->admin->isSuspended = $this->isSuspended;
            if($this->age!==''){
                $this->admin->age = $this->age;
            }
            if($this->gender!==''){
                $this->admin->gender = $this->gender;
            }
            if($this->marital_status!==''){
                $this->admin->marital_status = $this->marital_status;
            }
            if($this->city!==''){
                $this->admin->city = $this->city;
            }
            if($this->address!==''){
                $this->admin->address = $this->address;
            }
            if($this->country!==''){
                $this->admin->country = $this->country;
            }
            if($this->nationality!==''){
                $this->admin->nationality = $this->nationality;
            }
            if($this->bio!==''){
                $this->admin->bio = $this->bio;
            }

            if($this->cv!==null){
                if($this->admin->cv_path!==null){
                    Storage::disk('public')->delete($this->admin->cv_path);
                }
                $this->admin->cv_path = $this->cv->store('CVs','public');
            }
            
            $this->admin->save();
            $this->emit('savedBioData');
        } catch (\Throwable $th) {  
            throw $th;          
            $this->emit('saveBioDataFailed');
        }
    }

    public function viewCv(){
        $pathToFile = storage_path('app/public/'.$this->admin->cv_path);
        $name = 'Curriculum Vitae';
        $headers = [
            'Content-Type' => 'application/pdf',    
            'Content-Disposition' => 'inline',    
        ];
        return response()->file($pathToFile, $headers);
    }
    
    public function render()
    {
        return view('livewire.admin.administrator-details');
    }
}
