@extends('admin.layouts.master')

@section('pageTitle', __('custom.label.' . ($isEdit ? 'update_a_row' : 'create_a_row'), [
    'name' => __('custom.module.tools.title')]))

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <!-- form start -->
        <form method="post"
              action="{{ $isEdit ? route('admin.tool.update', $row->getKey()) : route('admin.tool.store') }}">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Tên <code>(*)</code></label>
                            <input type="text" id="name" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $row->name) }}"
                                   placeholder="Tên hoạ cụ">
                            @error('name')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="course_id">Khoá học <code>(*)</code></label>
                        <select class="form-control @error('course_id') is-invalid @enderror" id="course_id"
                                name="course_id[]" multiple>
                            @foreach($courses as $course)
                                <option
                                    value="{{ $course->getKey() }}"
                                    @if(in_array($course->getKey(), old('course_id', $row->course->pluck("id")->toArray()))) selected @endif>
                                    {{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">Giá <code>(*)</code></label>
                            <input type="number" id="price" name="price"
                                   class="form-control @error('price') is-invalid @enderror"
                                   value="{{ old('price', $row->price) }}"
                                   placeholder="Giá hoạ cụ">
                            @error('price')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Mô tả <code>(*)</code></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                      name="description" rows="3"
                                      placeholder="Mô tả">{{ old('description', $row->description) }}</textarea>
                            @error('description')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer text-right">
                <a href="{{ route('admin.tool.list') }}" class="btn btn-default"
                   title="{{ __('custom.button.back') }}">{{ __('custom.button.back') }}</a>
                <button type="submit" class="btn btn-success"
                        title="{{ __('custom.button.save') }}">{{ __('custom.button.save') }}</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@stop
