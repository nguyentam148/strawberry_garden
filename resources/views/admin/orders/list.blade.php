@extends('admin.layouts.master')

@section('pageTitle', "Đơn hàng")

@section('content')
    <div class="card">
        <div class="card-body">
            @if($rows->isNotEmpty())
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Học sinh</th>
                        <th>Tổng tiền</th>
                        <th>Địa chỉ</th>
                        <th>Hoạ cụ mua</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rows as $row)
                        <tr>
                            <td>{{ $row->getKey() }}</td>
                            <td>{{ $row->student->first_name .  $row->student->last_name}}</td>
                            <td>{{ $row->total_price }}</td>
                            <td>{{ $row->address }}</td>
                            <td>
                                @foreach($row->order_item as $item)
                                    <p>{{ $item->painting_tool->name }}</p>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @else
                <p class="text-center"><p class="text-center">
                    {{ __('custom.message.no_row_to_display', ['name' => "đơn hàng"]) }}
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
