@if($currentStep != 2)
<div style="display: none" class="row setup-content" id="step-2">
    @endif
    <div class="col-xs-12">
        <div class="col-md-12">
            <br>

            <div class="form-row">
                <div class="col">
                    <label for="title">{{__('Name_Mother')}}</label>
                    <input type="text" wire:model="NameMother" class="form-control">
                    @error('NameMother')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="title">{{__('Name_Mother_en')}}</label>
                    <input type="text" wire:model="NameMother_en" class="form-control">
                    @error('NameMother_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3">
                    <label for="title">{{__('Job_Mother')}}</label>
                    <input type="text" wire:model="JobMother" class="form-control">
                    @error('JobMother')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="title">{{__('Job_Mother_en')}}</label>
                    <input type="text" wire:model="JobMother_en" class="form-control">
                    @error('JobMother_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col">
                    <label for="title">{{__('National_ID_Mother')}}</label>
                    <input type="text" wire:model="NationalIDMother" class="form-control">
                    @error('NationalIDMother')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="title">{{__('Passport_ID_Mother')}}</label>
                    <input type="text" wire:model="PassportIDMother" class="form-control">
                    @error('PassportIDMother')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col">
                    <label for="title">{{__('Phone_Mother')}}</label>
                    <input type="text" wire:model="PhoneMother" class="form-control">
                    @error('PhoneMother')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>


            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">{{__('Nationality_Father_id')}}</label>
                    <select class="custom-select my-1 mr-sm-2" wire:model="NationalityMother_id">
                        <option selected>{{__('Choose')}}...</option>
                        @foreach($nationalities as $National)
                        <option value="{{$National->id}}">{{$National->name}}</option>
                        @endforeach
                    </select>
                    @error('NationalityMother_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="inputState">{{__('Blood_Type_Father_id')}}</label>
                    <select class="custom-select my-1 mr-sm-2" wire:model="BloodTypeMother_id">
                        <option selected>{{__('Choose')}}...</option>
                        @foreach($typeBloods as $Type_Blood)
                        <option value="{{$Type_Blood->id}}">{{$Type_Blood->name}}</option>
                        @endforeach
                    </select>
                    @error('BloodTypeMother_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="inputZip">{{__('Religion_Father_id')}}</label>
                    <select class="custom-select my-1 mr-sm-2" wire:model="ReligionMother_id">
                        <option selected>{{__('Choose')}}...</option>
                        @foreach($religions as $Religion)
                        <option value="{{$Religion->id}}">{{$Religion->name}}</option>
                        @endforeach
                    </select>
                    @error('ReligionMother_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">{{__('Address_Mother')}}</label>
                <textarea class="form-control" wire:model="AddressMother" id="exampleFormControlTextarea1"
                    rows="4"></textarea>
                @error('AddressMother')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button" wire:click="back(1)">
                {{__('Back')}}
            </button>

            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="button"
                wire:click="secondStepSubmit">{{__('Next')}}</button>

        </div>
    </div>
</div>
