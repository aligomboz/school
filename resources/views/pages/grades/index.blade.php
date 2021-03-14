@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
index
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{__('grades')}} </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{__('grades')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    @if ($errors->any())
    <div class="error">{{ $errors->first('name') }}</div>
    @endif
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ __('add Grade') }}
                </button>
                <br><br>
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped table-bordered p-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('Name')}}</th>
                                            <th>{{__('Notes')}}</th>
                                            <th> {{__('Processes')}} </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($grades as $grade)
                                        <tr>
                                            <?php $i++; ?>
                                            <td>{{ $i }}</td>
                                            <td>{{ $grade->name }}</td>
                                            <td>{{ $grade->note }}</td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#edit{{ $grade->id }}" title="{{ __('Edit') }}"><i
                                                        class="fa fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete{{ $grade->id }}" title="{{ __('Delete') }}"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <!-- edit_modal_Grade -->
                                        <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;"
                                                            class="modal-title" id="exampleModalLabel">
                                                            {{ __('edit grade') }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- add_form -->
                                                        <form action="{{route('grades.update',$grade->id)}}"
                                                            method="post">
                                                            {{method_field('patch')}}
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="Name"
                                                                        class="mr-sm-2">{{ __('stage_name_ar') }}
                                                                        :</label>
                                                                    <input id="Name" type="text" name="name"
                                                                        class="form-control"
                                                                        value="{{$grade->getTranslation('name', 'ar')}}"
                                                                        required>
                                                                    <input id="id" type="hidden" name="id"
                                                                        class="form-control" value="{{ $grade->id }}">
                                                                </div>
                                                                <div class="col">
                                                                    <label for="Name_en"
                                                                        class="mr-sm-2">{{ __('stage_name_en') }}
                                                                        :</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{$grade->getTranslation('name', 'en')}}"
                                                                        name="name_en" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleFormControlTextarea1">{{ __('Notes') }}
                                                                    :</label>
                                                                <textarea class="form-control" name="note"
                                                                    id="exampleFormControlTextarea1"
                                                                    rows="3">{{ $grade->note }}</textarea>
                                                            </div>
                                                            <br><br>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ __('Close') }}</button>
                                                                <button type="submit"
                                                                    class="btn btn-success">{{ __('submit') }}</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- delete_modal_Grade -->
                                        <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;"
                                                            class="modal-title" id="exampleModalLabel">
                                                            {{ __('delete grade') }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('grades.destroy', $grade->id)}}"
                                                            method="post">
                                                            {{method_field('Delete')}}
                                                            @csrf
                                                            {{ __('are sure of the deleting process ?') }}
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                value="{{ $grade->id }}">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ __('Close') }}</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">{{ __('submit') }}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        @endforeach

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- add_modal_Grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ __('add Grade') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('grades.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="Name" class="mr-sm-2">{{ __('stage_name_ar') }}
                                    :</label>
                                <input id="Name" type="text" name="name" class="form-control">
                            </div>
                            <div class="col">
                                <label for="Name_en" class="mr-sm-2">{{ __('stage_name_en') }}
                                    :</label>
                                <input type="text" class="form-control" name="name_en">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{ __('Notes') }}
                                :</label>
                            <textarea class="form-control" name="note" id="exampleFormControlTextarea1"
                                rows="3"></textarea>
                        </div>
                        <br><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-success">{{ __('submit') }}</button>
                </div>
                </form>

            </div>
        </div>
    </div>

</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
