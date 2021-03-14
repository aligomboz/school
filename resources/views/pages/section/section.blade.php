@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
{{ trans('Sections_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('Sections_trans.title_page') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                    {{ __('Add a section') }}</a>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="accordion gray plus-icon round">

                        @foreach ($grades as $Grade)

                        <div class="acd-group">
                            <a href="#" class="acd-heading">{{ $Grade->name }}</a>
                            <div class="acd-des">

                                <div class="row">
                                    <div class="col-xl-12 mb-30">
                                        <div class="card card-statistics h-100">
                                            <div class="card-body">
                                                <div class="d-block d-md-flex justify-content-between">
                                                    <div class="d-block">
                                                    </div>
                                                </div>
                                                <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0">
                                                        <thead>
                                                            <tr class="text-dark">
                                                                <th>#</th>
                                                                <th>{{ __('Department Name') }}
                                                                </th>
                                                                <th>{{ __('Class name') }}</th>
                                                                <th>{{ __('Status') }}</th>
                                                                <th>{{ __('Processes') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i = 0; ?>

                                                            @foreach ($Grade->sections as $list_Sections)
                                                            <tr>
                                                                <?php $i++; ?>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $list_Sections->name_section }}</td>
                                                                <td>{{ $list_Sections->My_classs->NameClass }}
                                                                </td>
                                                                <td>
                                                                    @if ($list_Sections->status === 1)
                                                                    <label
                                                                        class="badge badge-success">{{ __('active') }}</label>
                                                                    @else
                                                                    <label
                                                                        class="badge badge-danger">{{ __('Inactive') }}</label>
                                                                    @endif

                                                                </td>
                                                                <td>

                                                                    <a href="#" class="btn btn-outline-info btn-sm"
                                                                        data-toggle="modal"
                                                                        data-target="#edit{{ $list_Sections->id }}">{{ __('Edit') }}</a>
                                                                    <a href="#" class="btn btn-outline-danger btn-sm"
                                                                        data-toggle="modal"
                                                                        data-target="#delete{{ $list_Sections->id }}">{{ __('Delete') }}</a>
                                                                </td>
                                                            </tr>


                                                            <!--تعديل قسم جديد -->
                                                            <div class="modal fade" id="edit{{ $list_Sections->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                style="font-family: 'Cairo', sans-serif;"
                                                                                id="exampleModalLabel">
                                                                                {{ __('Section modification') }}
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <form
                                                                                action="{{ route('sections.update', $list_Sections->id) }}"
                                                                                method="POST">
                                                                                {{ method_field('patch') }}
                                                                                {{ csrf_field() }}
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <input type="text"
                                                                                            name="name_section_Ar"
                                                                                            class="form-control"
                                                                                            value="{{ $list_Sections->getTranslation('name_section', 'ar') }}">
                                                                                    </div>

                                                                                    <div class="col">
                                                                                        <input type="text"
                                                                                            name="name_section_En"
                                                                                            class="form-control"
                                                                                            value="{{ $list_Sections->getTranslation('name_section', 'en') }}">
                                                                                        <input id="id" type="hidden"
                                                                                            name="id"
                                                                                            class="form-control"
                                                                                            value="{{ $list_Sections->id }}">
                                                                                    </div>

                                                                                </div>
                                                                                <br>


                                                                                <div class="col">
                                                                                    <label for="inputName"
                                                                                        class="control-label">{{ __('Stage name') }}</label>
                                                                                    <select name="grade_id"
                                                                                        class="custom-select"
                                                                                        onclick="console.log($(this).val())">
                                                                                        <!--placeholder-->
                                                                                        <option
                                                                                            value="{{ $Grade->id }}">
                                                                                            {{ $Grade->name }}
                                                                                        </option>
                                                                                        @foreach ($list_Grades as $list_Grade)
                                                                                        <option
                                                                                            value="{{ $list_Grade->id }}">
                                                                                            {{ $list_Grade->name }}
                                                                                        </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <br>

                                                                                <div class="col">
                                                                                    <label for="inputName"
                                                                                        class="control-label">{{ __('Class name') }}</label>
                                                                                    <select name="class_id"
                                                                                        class="custom-select">
                                                                                        <option
                                                                                            value="{{ $list_Sections->My_classs->id }}">
                                                                                            {{ $list_Sections->My_classs->NameClass }}
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                                <br>

                                                                                <div class="col">
                                                                                    <div class="form-check">

                                                                                        @if ($list_Sections->status === 1)
                                                                                        <input type="checkbox" checked
                                                                                            class="form-check-input"
                                                                                            name="Status"
                                                                                            id="exampleCheck1">
                                                                                        @else
                                                                                        <input type="checkbox"
                                                                                            class="form-check-input"
                                                                                            name="status"
                                                                                            id="exampleCheck1">
                                                                                        @endif
                                                                                        <label class="form-check-label"
                                                                                            for="exampleCheck1">{{ __('Status') }}</label>
                                                                                    </div>
                                                                                </div>


                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">{{ __('Close') }}</button>
                                                                            <button type="submit"
                                                                                class="btn btn-danger">{{ __('submit') }}</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <!-- delete_modal_Grade -->
                                                            <div class="modal fade" id="delete{{ $list_Sections->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                class="modal-title"
                                                                                id="exampleModalLabel">
                                                                                {{ __('Delete section') }}
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form
                                                                                action="{{ route('sections.destroy',$list_Sections->id ) }}"
                                                                                method="post">
                                                                                {{ method_field('Delete') }}
                                                                                @csrf
                                                                                {{ __('are sure of the deleting process ?') }}
                                                                                <input id="id" type="hidden" name="id"
                                                                                    class="form-control"
                                                                                    value="{{ $list_Sections->id }}">
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
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
                            @endforeach
                        </div>
                    </div>
                </div>

                <!--اضافة قسم جديد -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;"
                                    id="exampleModalLabel">
                                    {{ __('Add a section') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('sections.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="name_section_Ar" class="form-control"
                                                placeholder="{{ __('Section_name_ar') }}">
                                        </div>

                                        <div class="col">
                                            <input type="text" name="name_section_En" class="form-control"
                                                placeholder="{{ __('Section_name_en') }}">
                                        </div>

                                    </div>
                                    <br>


                                    <div class="col">
                                        <label for="inputName" class="control-label">{{ __('Stage name') }}</label>
                                        <select name="grade_id" class="custom-select"
                                            onchange="console.log($(this).val())">
                                            <!--placeholder-->
                                            <option value="" selected disabled>
                                                {{ __('Select the stage') }}
                                            </option>
                                            @foreach ($list_Grades as $list_Grade)
                                            <option value="{{ $list_Grade->id }}"> {{ $list_Grade->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>

                                    <div class="col">
                                        <label for="inputName" class="control-label">{{ __('Class name') }}</label>
                                        <select name="class_id" class="custom-select">

                                        </select>
                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ __('Close') }}</button>
                                <button type="submit" class="btn btn-danger">{{ __('submit') }}</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- row closed -->
    @endsection
    @section('js')
    @toastr_js
    @toastr_render
    <script>
        $(document).ready(function () {
            $('select[name="grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('classes') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="class_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="class_id"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });

    </script>

    @endsection
