@extends('admin.layouts.master')

@section('pageTitle', "Hoạ cụ")

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="text-right">
                <a href="{{ route('admin.tool.create') }}" title="{{ __('custom.button.create') }}"
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
                        <th style="width: 10px">#</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Mô tả</th>
                        <th>Khoá học</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rows as $row)
                        <tr>
                            <td>{{ $row->getKey() }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->price }}</td>
                            <td>{{ $row->description }}</td>
                            <td>{{ implode(", ", $row->course->pluck("name")->toArray()) }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.tool.edit', $row->getKey()) }}"
                                   title="{{ __('custom.button.edit') }}">{{ __('custom.button.edit') }}</a>
                                <a href="{{ route('admin.tool.destroy', $row->getKey()) }}"
                                   onclick="return confirm('{{ __('custom.message.confirm_delete_a_row', ['name' => __('custom.module.tools.title')]) }}');"
                                   title="{{ __('custom.button.destroy') }}"
                                   class="text-danger"
                                   style="margin-left: 5px;">{{ __('custom.button.destroy') }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @else
                <p class="text-center"><p class="text-center">
                    {{ __('custom.message.no_row_to_display', ['name' => "hoạ cụ"]) }}
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
