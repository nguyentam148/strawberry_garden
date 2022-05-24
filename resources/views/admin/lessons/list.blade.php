@extends('admin.layouts.master')

@section('pageTitle', __('custom.module.lessons.title'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="text-right">
                <a href="{{ route('admin.lessons.create') }}" title="{{ __('custom.button.create') }}"
                   class="btn bg-gradient-success">
                    {{ __('custom.button.create') }}
                </a>
            </div>
        </div>

        <div class="card-body">
            @if($rows->isNotEmpty())
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 10px">#</th>
                        <th class="text-center">Tên bài học</th>
                        <th class="text-center">Khoá học</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rows as $row)
                        <tr>
                            <td>{{ $row->getKey() }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->course->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.lessons.edit', $row->getKey()) }}"
                                   title="{{ __('custom.button.edit') }}">{{ __('custom.button.edit') }}</a>
                                <a href="{{ route('admin.lessons.destroy', $row->getKey()) }}"
                                   onclick="return confirm('{{ __('custom.message.confirm_delete_a_row', ['name' => __('custom.module.lessons.title')]) }}');"
                                   title="{{ __('custom.button.destroy') }}"
                                   class="text-danger"
                                   style="margin-left: 5px;">{{ __('custom.button.destroy') }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @else
                <p class="text-center">
                    {{ __('custom.message.no_row_to_display', ['name' => __('custom.module.lessons.title')]) }}
                </p>
            @endif
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $rows->links() }}
        </div>
    </div>
    <!-- /.card -->
@stop
