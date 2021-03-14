<?php

namespace App\Http\Livewire;

use App\MyParent;
use App\Nationalitie;
use App\ParentAttachment;
use App\Religion;
use App\TypeBlod;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads;

    public $currentStep = 1 , $show_table = true,

        // Father_INPUTS
        $Email, $Password,
        $NameFather, $NameFather_en,
        $NationalIDFather, $PassportIDFather,
        $PhoneFather, $JobFather, $JobFather_en,
        $NationalityFather_id, $BloodTypeFather_id,
        $AddressFather, $ReligionFather_id,

        // Mother_INPUTS
        $NameMother, $NameMother_en,
        $NationalIDMother, $PassportIDMother,
        $PhoneMother, $JobMother, $JobMother_en,
        $NationalityMother_id, $BloodTypeMother_id,
        $AddressMother, $ReligionMother_id,$photos,$parent_id,
        $updateMode = false ;
    public $catchError = '';
    public $successMessage = '';

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'Email' => 'required|email',
            'NationalIDFather' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'PassportIDFather' => 'min:10|max:10',
            'PhoneFather' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'NationalIDMother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'PassportIDMother' => 'min:10|max:10',
            'PhoneMother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }

    public function render()
    {
        return view('livewire.add-parent', [
            'nationalities' => Nationalitie::get(),
            'typeBloods' => TypeBlod::get(),
            'religions' => Religion::get(),
            'my_parents' => MyParent::get(),
        ]);    
    }
    //firstStepSubmit
    public function firstStepSubmit()
    {
       $this->validate([
        'Email' => 'required|unique:my_parents,email,'.$this->id,
        'Password' => 'required',
        'NameFather' => 'required',
        'NameFather_en' => 'required',
        'JobFather' => 'required',
        'JobFather_en' => 'required',
        'NationalIDFather' => 'required|unique:my_parents,NationalIDFather,' . $this->id,
        'PassportIDFather' => 'required|unique:my_parents,PassportIDFather,' . $this->id,
        'PhoneFather' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'NationalityFather_id' => 'required',
        'BloodTypeFather_id' => 'required',
        'ReligionFather_id' => 'required',
        'AddressFather' => 'required',
    ]);
        $this->currentStep = 2;
    }

    //secondStepSubmit
    public function secondStepSubmit()
    {
        $this->validate([
            'NameMother' => 'required',
            'NameMother_en' => 'required',
            'NationalIDMother' => 'required|unique:my_parents,NationalIDMother,' . $this->id,
            'PassportIDMother' => 'required|unique:my_parents,PassportIDMother,' . $this->id,
            'PhoneMother' => 'required',
            'JobMother' => 'required',
            'JobMother_en' => 'required',
            'NationalityMother_id' => 'required',
            'BloodTypeMother_id' => 'required',
            'ReligionMother_id' => 'required',
            'AddressMother' => 'required',
        ]);
        $this->currentStep = 3;
    }

    public function submitForm(){

        try {
            $My_Parent = new MyParent();
            // Father_INPUTS
            $My_Parent->Email = $this->Email;
            $My_Parent->Password = Hash::make($this->Password);
            $My_Parent->NameFather = ['en' => $this->NameFather_en, 'ar' => $this->NameFather];
            $My_Parent->NationalIDFather = $this->NationalIDFather;
            $My_Parent->PassportIDFather = $this->PassportIDFather;
            $My_Parent->PhoneFather = $this->PhoneFather;
            $My_Parent->JobFather = ['en' => $this->JobFather_en, 'ar' => $this->JobFather];
            $My_Parent->PassportIDFather = $this->PassportIDFather;
            $My_Parent->NationalityFather_id = $this->NationalityFather_id;
            $My_Parent->BloodTypeFather_id = $this->BloodTypeFather_id;
            $My_Parent->ReligionFather_id = $this->ReligionFather_id;
            $My_Parent->AddressFather = $this->AddressFather;

            // Mother_INPUTS
            $My_Parent->NameMother = ['en' => $this->NameMother_en, 'ar' => $this->NameMother];
            $My_Parent->NationalIDMother = $this->NationalIDMother;
            $My_Parent->PassportIDMother = $this->PassportIDMother;
            $My_Parent->PhoneMother = $this->PhoneMother;
            $My_Parent->JobMother = ['en' => $this->JobMother_en, 'ar' => $this->JobMother];
            $My_Parent->PassportIDMother = $this->PassportIDMother;
            $My_Parent->NationalityMother_id = $this->NationalityMother_id;
            $My_Parent->BloodTypeMother_id = $this->BloodTypeMother_id;
            $My_Parent->ReligionMother_id = $this->ReligionMother_id;
            $My_Parent->AddressMother = $this->AddressMother;
            $My_Parent->save();
            if (!empty($this->photos)){
                foreach ($this->photos as $photo) {
                    $photo->storeAs($this->NationalIDFather, $photo->getClientOriginalName(), $disk = 'parentAttachments');
                    ParentAttachment::create([
                        'fileName' => $photo->getClientOriginalName(),
                        'parent_id' => $My_Parent->id,
                        // 'parent_id' => MyParent::latest()->first()->id,
                    ]);
                }
            }
            $this->successMessage = __('The data has been saved successfully');
            $this->clearForm();
            $this->currentStep = 1;
        }

        catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };

    }

    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $My_Parent = MyParent::where('id',$id)->first();
        $this->parent_id = $id;
        $this->Email = $My_Parent->Email;
        $this->Password = $My_Parent->Password;
        $this->NameFather = $My_Parent->getTranslation('NameFather', 'ar');
        $this->NameFather_en = $My_Parent->getTranslation('NameFather', 'en');
        $this->JobFather = $My_Parent->getTranslation('JobFather', 'ar');;
        $this->JobFather_en = $My_Parent->getTranslation('JobFather', 'en');
        $this->NationalIDFather =$My_Parent->NationalIDFather;
        $this->PassportIDFather = $My_Parent->PassportIDFather;
        $this->PhoneFather = $My_Parent->PhoneFather;
        $this->NationalityFather_id = $My_Parent->NationalityFather_id;
        $this->BloodTypeFather_id = $My_Parent->BloodTypeFather_id;
        $this->AddressFather =$My_Parent->AddressFather;
        $this->ReligionFatherid =$My_Parent->ReligionFather_id;

        $this->NameMother = $My_Parent->getTranslation('NameMother', 'ar');
        $this->NameMother_en = $My_Parent->getTranslation('NameFather', 'en');
        $this->JobMother = $My_Parent->getTranslation('JobMother', 'ar');;
        $this->JobMother_en = $My_Parent->getTranslation('JobMother', 'en');
        $this->NationalIDMother =$My_Parent->NationalIDMother;
        $this->PassportIDMother = $My_Parent->PassportIDMother;
        $this->PhoneMother = $My_Parent->PhoneMother;
        $this->NationalityMother_id = $My_Parent->NationalityMother_id;
        $this->BloodTypeMother_id = $My_Parent->BloodTypeMother_id;
        $this->AddressMother =$My_Parent->AddressMother;
        $this->ReligionMother_id =$My_Parent->ReligionMother_id;
    }

    public function clearForm()
    {
        $this->Email = '';
        $this->Password = '';
        $this->NameFather = '';
        $this->JobFather = '';
        $this->JobFather_en = '';
        $this->NameFather_en = '';
        $this->NationalIDFather ='';
        $this->PassportIDFather = '';
        $this->PhoneFather = '';
        $this->NationalityFather_id = '';
        $this->BloodTypeFather_id = '';
        $this->AddressFather ='';
        $this->ReligionFather_id ='';

        $this->NameMother = '';
        $this->JobMother = '';
        $this->JobMother_en = '';
        $this->NameMother_en = '';
        $this->NationalIDMother ='';
        $this->PassportIDMother = '';
        $this->PhoneMother = '';
        $this->NationalityMother_id = '';
        $this->BloodTypeMother_id = '';
        $this->AddressMother ='';
        $this->ReligionMother_id ='';

    }

    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function showFormAdd(){
        $this->show_table = false;
    }
}
