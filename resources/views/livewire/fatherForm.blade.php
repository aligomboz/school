@if($currentStep != 1)
<div style="display: none" class="row setup-content" id="step-1">
    @endif
    <div class="col-xs-12">
        <div class="col-md-12">
            <br>
            <div class="form-row">
                <div class="col">
                    <label for="title">{{__('Email')}}</label>
                    <input type="email" wire:model="Email" class="form-control @error('Email') is-invalid @enderror">
                    @error('Email') <span class="error text-danger">{{ $message }}</span> @enderror
                    {{-- @error('Email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror --}}
            </div>
            <div class="col">
                <label for="title">{{__('Password')}}</label>
                <input type="password" wire:model="Password"
                    class="form-control @error('Password') is-invalid @enderror">
                @error('Password') <span class="error text-danger">{{ $message }}</span> @enderror
                {{-- @error('Password')
                    <div class="alert alert-danger">{{ $message }}</div>
            @enderror --}}
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <label for="title">{{__('Name_Father')}}</label>
            <input type="text" wire:model="NameFather" class="form-control">
            @error('NameFather')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col">
            <label for="title">{{__('Name_Father_en')}}</label>
            <input type="text" wire:model="NameFather_en" class="form-control">
            @error('NameFather_en')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-3">
            <label for="title">{{__('Job_Father')}}</label>
            <input type="text" wire:model="JobFather" class="form-control">
            @error('JobFather')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-3">
            <label for="title">{{__('Job_Father_en')}}</label>
            <input type="text" wire:model="JobFather_en" class="form-control">
            @error('JobFather_en')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col">
            <label for="title">{{__('National_ID_Father')}}</label>
            <input type="text" wire:model="NationalIDFather" class="form-control">
            @error('NationalIDFather')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col">
            <label for="title">{{__('Passport_ID_Father')}}</label>
            <input type="text" wire:model="PassportIDFather" class="form-control">
            @error('PassportIDFather')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col">
            <label for="title">{{__('Phone_Father')}}</label>
            <input type="text" wire:model="PhoneFather" class="form-control">
            @error('PhoneFather')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

    </div>


    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputCity">{{__('Nationality_Father_id')}}</label>
            <select class="custom-select my-1 mr-sm-2" wire:model="NationalityFather_id">
                <option selected>{{__('Choose')}}...</option>
                @foreach($nationalities as $National)
                <option value="{{$National->id}}">{{$National->name}}</option>
                @endforeach
            </select>
            @error('NationalityFather_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col">
            <label for="inputState">{{__('Blood_Type_Father_id')}}</label>
            <select class="custom-select my-1 mr-sm-2" wire:model="BloodTypeFather_id">
                <option selected>{{__('Choose')}}...</option>
                @foreach($typeBloods as $Type_Blood)
                <option value="{{$Type_Blood->id}}">{{$Type_Blood->name}}</option>
                @endforeach
            </select>
            @error('BloodTypeFather_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col">
            <label for="inputZip">{{__('Religion_Father_id')}}</label>
            <select class="custom-select my-1 mr-sm-2" wire:model="ReligionFather_id">
                <option selected>{{__('Choose')}}...</option>
                @foreach($religions as $Religion)
                <option value="{{$Religion->id}}">{{$Religion->name}}</option>
                @endforeach
            </select>
            @error('ReligionFather_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>


    <div class="form-group">
        <label for="exampleFormControlTextarea1">{{__('Address_Father')}}</label>
        <textarea class="form-control" wire:model="AddressFather" id="exampleFormControlTextarea1" rows="4"></textarea>
        @error('Address_Father')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit"
        type="button">{{__('Next')}}
    </button>

</div>
</div>
</div>
