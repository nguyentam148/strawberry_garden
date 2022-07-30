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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Tên</label>
                            <input type="text" id="name" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $row->name) }}"
                                   placeholder="Tên bài học">
                            @error('name')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image_1">Ảnh mẫu 1  <code>(*)</code></label>
                            <input type="file" id="js_image_input_1">
                            <input type="hidden" id="image_1" name="image_1" value="{{ old('image_1', $sample_picture[0]) }}"
                                   accept=".png,.jpg,.jepg">

                            <div class="js_image_render_1"
                                 data-image="{{ old('image_1', $sample_picture[0]) ?
                                    \Illuminate\Support\Facades\Storage::url(old('image_1', $sample_picture[0])) : ''}}"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image_2">Ảnh mẫu 2</label>
                            <input type="file" id="js_image_input_2">
                            <input type="hidden" id="image_2" name="image_2" value="{{ old('image_2', $sample_picture[1]) }}"
                                   accept=".png,.jpg,.jepg">

                            <div class="js_image_render_2"
                                 data-image="{{ old('image_2', $sample_picture[1]) ?
                                    \Illuminate\Support\Facades\Storage::url(old('image_2', $sample_picture[1])) : ''}}"></div>
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
@section('js')
    <script>
        function renderImage1() {
            const renderElement1 = $('.js_image_render_1');
            const url1 = renderElement1.attr('data-image');

            renderElement1.html(url1.length ?
                '<img src="' + url1 + '" alt="Ảnh đại diện 1" title="Ảnh đại diện1" style = "max-height: 200px;" >'
                : '');
        }

        function renderImage2() {
            const renderElement2 = $('.js_image_render_2');
            const url2 = renderElement2.attr('data-image');

            renderElement2.html(url2.length ?
                '<img src="' + url2 + '" alt="Ảnh đại diện 2" title="Ảnh đại diện2" style = "max-height: 200px;" >'
                : '');
        }

        window.onload = function () {
            renderImage1();
            renderImage2();
        };

        $(document).on('change', '#js_image_input_1', function () {
            const file = $(this)[0].files[0];

            if (!file) {
                return;
            }

            const formData = new FormData();

            formData.append("file", file, file.name);
            formData.append("path", 'lesson/image');

            $.ajax({
                type: "POST",
                url: "{{ route('admin.upload') }}",
                data: formData,
                success: function (data) {
                    if (data.status) {
                        $('.js_image_render_1').attr('data-image', data.data.url);
                        $('#image_1').val(data.data.path);
                        renderImage1();
                        appHelpers.fireMessage(data.message, 'success');
                    } else {
                        appHelpers.fireMessage(data.message + ': ' + data.error, 'error');
                    }
                },
                error: function (error) {
                    appHelpers.fireMessage('Something went wrong!!', 'error');
                },
                async: true,
                cache: false,
                contentType: false,
                processData: false,
            });
        });

        $(document).on('change', '#js_image_input_2', function () {
            const file = $(this)[0].files[0];

            if (!file) {
                return;
            }

            const formData = new FormData();

            formData.append("file", file, file.name);
            formData.append("path", 'lesson/image');

            $.ajax({
                type: "POST",
                url: "{{ route('admin.upload') }}",
                data: formData,
                success: function (data) {
                    if (data.status) {
                        $('.js_image_render_2').attr('data-image', data.data.url);
                        $('#image_2').val(data.data.path);
                        renderImage2();
                        appHelpers.fireMessage(data.message, 'success');
                    } else {
                        appHelpers.fireMessage(data.message + ': ' + data.error, 'error');
                    }
                },
                error: function (error) {
                    appHelpers.fireMessage('Something went wrong!!', 'error');
                },
                async: true,
                cache: false,
                contentType: false,
                processData: false,
            });
        });
    </script>
@stop
