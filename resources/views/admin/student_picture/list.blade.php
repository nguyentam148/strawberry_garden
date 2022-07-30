@extends('admin.layouts.master')

@section('pageTitle', "Tranh vẽ của học sinh")

@section('content')
    <div class="card">
        <div class="card-body">
            @if($rows->isNotEmpty())
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 10px">#</th>
                        <th class="text-center">Tên bài học</th>
                        <th class="text-center">Tên học sinh</th>
                        <th class="text-center">Tranh vẽ</th>
                        <th class="text-center">Điểm</th>
                        <th class="text-center">Nhận xét</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rows as $row)
                        <tr>
                            <td>{{ $row->getKey() }}</td>
                            <td>{{ $row->lesson->name }}</td>
                            <td>{{ $row->student->first_name . " " . $row->student->last_name }}</td>
                            <td><img src="{{ asset( "storage/" . $row->picture)  }}" alt="" style="width: 100px"></td>
                            <td>{{ $row->scores }}</td>
                            <td>{{ $row->comment }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.student_picture.edit', $row->getKey()) }}"
                                   title="{{ __('custom.button.edit') }}">{{ __('custom.button.edit') }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @else
                <p class="text-center">
                    {{ __('custom.message.no_row_to_display', ['name' => __('custom.module.student_picture.title')]) }}
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
