<div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('system.action') }}</button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
        <a class="dropdown-item" href="{{ route('employees.edit', $data->id) }}">{{ trans('system.edit') }}</a>
        <a class="dropdown-item delete-record" href="#" data-route="{{ route('employees.destroy', $data->id) }}" data-id="{{ $data->id }}">{{ trans('system.delete') }}</a>
    </div>
</div>
