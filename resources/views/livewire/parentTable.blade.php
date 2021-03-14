<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showFormAdd" type="button">{{ __('add_parent') }}</button><br><br>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Name_Father') }}</th>
            <th>{{ __('National_ID_Father') }}</th>
            <th>{{ __('Passport_ID_Father') }}</th>
            <th>{{ __('Phone_Father') }}</th>
            <th>{{ __('Job_Father') }}</th>
            <th>{{ __('Processes') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
        @foreach ($my_parents as $my_parent)
            <tr>
                <?php $i++; ?>
                <td>{{ $i }}</td>
                <td>{{ $my_parent->Email }}</td>
                <td>{{ $my_parent->NameFather }}</td>
                <td>{{ $my_parent->NameFather_en }}</td>
                <td>{{ $my_parent->NationalIDFather }}</td>
                <td>{{ $my_parent->PassportIDFather }}</td>
                <td>{{ $my_parent->PhoneFather }}</td>
                <td>{{ $my_parent->JobFather }}</td>
                <td>
                    <button wire:click="edit({{ $my_parent->id }})" title="{{ __('Edit') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $my_parent->id }})" title="{{ __('Delete') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </table>
</div>