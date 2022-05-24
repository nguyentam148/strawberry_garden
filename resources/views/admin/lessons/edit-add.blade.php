@extends('admin.layouts.master')

@section('pageTitle', __('custom.label.' . ($isEdit ? 'update_a_row' : 'create_a_row'), [
    'name' => __('custom.module.lessons.title')]))

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <!-- form start -->
        <form method="post"
              action="{{ $isEdit ? route('admin.lessons.update', $row->getKey()) : route('admin.lessons.store') }}">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Tên</label>
                            <input type="text" id="name" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $row->name) }}"
                                   placeholder="Tên khoá học">
                            @error('name')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="course_id">Khoá học</label>
                        <select class="form-control @error('course_id') is-invalid @enderror" id="course_id"
                                name="course_id">
                            @foreach($courses as $course)
                                <option
                                    value="{{ $course->getKey() }}"
                                    @if($course->getKey() === old('course_id', $row->course_id)) selected @endif>
                                    {{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="video_path">Video</label>
                            <input type="text" id="video_path" name="video_path"
                                   class="form-control @error('video_path') is-invalid @enderror"
                                   value="{{ old('video_path', $row->video_path) }}"
                                   placeholder="Video">
                            @error('video_path')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer text-right">
                <a href="{{ route('admin.lessons.list') }}" class="btn btn-default"
                   title="{{ __('custom.button.back') }}">{{ __('custom.button.back') }}</a>
                <button type="submit" class="btn btn-success"
                        title="{{ __('custom.button.save') }}">{{ __('custom.button.save') }}</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@stop
