@extends('admin.layouts.master')

@section('pageTitle', __('custom.module.course_student.title'))

@section('content')
    <div class="card">
        <div class="card-body">
            @if($rows->isNotEmpty())
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 10px">#</th>
                        <th class="text-center">Email học viên</th>
                        <th class="text-center">SĐT học viên</th>
                        <th class="text-center">Tên học viên</th>
                        <th class="text-center">Tên khoá học</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rows as $row)
                        <tr>
                            <td>{{ $row->getKey() }}</td>
                            <td>{{ $row->student->email }}</td>
                            <td>{{ $row->student->phone_number }}</td>
                            <td>{{ $row->student->getFullName() }}</td>
                            <td>{{ $row->course->name }}</td>
                            <td class="text-center">
                                <span
                                    class="badge bg-{{ $row->getStatusHtmlClass() }}">{{ $row->getStatusText() }}</span>
                            </td>
                            <td class="text-center">
                                @if(!$row->isAccepted())
                                    <a href="{{ route('admin.course_student.accept', $row->getKey()) }}"
                                       class="text-success"
                                       onclick="return confirm('{{ __('custom.message.confirm_accept_course_student',
                                        ['student' => $row->student->getFullName(), 'course' => $row->course->name]) }}');"
                                       title="{{ __('custom.button.accept_course_student') }}">
                                        <i class="nav-icon fas fa-check"></i>
                                    </a>
                                @endif

                                @if(!$row->isDenied())
                                    <a href="{{ route('admin.course_student.deny', $row->getKey()) }}"
                                       style="margin-left: 20px;"
                                       class="text-danger"
                                       onclick="return confirm('{{ __('custom.message.confirm_deny_course_student',
                                        ['student' => $row->student->getFullName(), 'course' => $row->course->name]) }}');"
                                       title="{{ __('custom.button.deny_course_student') }}">
                                        <i class="nav-icon fas fa-times"></i>
                                    </a>
                                @endif

                                {{--                                @if(!$row->isCancelled())--}}
                                {{--                                    <a href=""--}}
                                {{--                                       onclick="return confirm('{{ __('custom.message.confirm_cancel_course_student',--}}
                                {{--                                        ['student' => $row->student->getFullName(), 'course' => $row->course->name]) }}');"--}}
                                {{--                                       title="{{ __('custom.button.cancel_course_student') }}"--}}
                                {{--                                       class="text-danger"--}}
                                {{--                                       style="margin-left: 5px;">{{ __('custom.button.cancel_course_student') }}</a>--}}
                                {{--                                @endif--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @else
                <p class="text-center">
                    {{ __('custom.message.no_row_to_display', ['name' => __('custom.module.course_student.title')]) }}
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
