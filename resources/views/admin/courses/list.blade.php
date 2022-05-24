@extends('admin.layouts.master')

@section('pageTitle', __('custom.module.courses.title'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="text-right">
                <a href="{{ route('admin.courses.create') }}" title="{{ __('custom.button.create') }}"
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
                        <th class="text-center">Ảnh đại diện</th>
                        <th class="text-center">Tên khoá học</th>
                        {{--<th class="text-center">Slug</th>--}}
                        {{--<th class="text-center">Giáo viên</th>--}}
                        <th class="text-center">Đối tượng</th>
                        <th class="text-center">Giá học</th>
                        {{--<th class="text-center">Giảm giá</th>--}}
                        <th class="text-center">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rows as $row)
                        <tr>
                            <td>{{ $row->getKey() }}</td>
                            <td class="text-center" style="width: 50px; overflow: hidden">
                                <img style="max-height: 50px;" src="{{ $row->getImageUrl() }}" alt="{{ $row->name }}"/>
                            </td>
                            <td>{{ $row->name }}</td>
                            {{--<td>{{ $row->slug }}</td>--}}
                            {{--<td>{{ $row->teacher_name }}</td>--}}
                            <td class="text-center">{{ $row->getPeopleTypeText() }}</td>
                            <td class="text-center">{{ $row->learn_price }}</td>
                            {{--<td class="text-center">{{ $row->learn_price_discount }}</td>--}}
                            <td class="text-center">
                                <a href="{{ route('admin.courses.edit', $row->getKey()) }}"
                                   title="{{ __('custom.button.edit') }}">{{ __('custom.button.edit') }}</a>
                                <a href="{{ route('admin.courses.destroy', $row->getKey()) }}"
                                   onclick="return confirm('{{ __('custom.message.confirm_delete_a_row', ['name' => __('custom.module.courses.title')]) }}');"
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
                    {{ __('custom.message.no_row_to_display', ['name' => __('custom.module.courses.title')]) }}
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
