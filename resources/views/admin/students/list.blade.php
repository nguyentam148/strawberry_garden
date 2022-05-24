@extends('admin.layouts.master')

@section('pageTitle', __('custom.module.students.title'))

@section('content')
    <div class="card">
        <div class="card-body">
            @if($rows->isNotEmpty())
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Email</th>
                        <th>Tên</th>
                        <th>Số diện thoại</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rows as $row)
                        <tr>
                            <td>{{ $row->getKey() }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->first_name . ' ' . $row->last_name }}</td>
                            <td>{{ $row->phone_number }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @else
                <p class="text-center"><p class="text-center">
                    {{ __('custom.message.no_row_to_display', ['name' => __('custom.module.students.title')]) }}
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
