@extends('admin.layouts.master')

@section('pageTitle', __('custom.label.' . ($isEdit ? 'update_a_row' : 'create_a_row'), [
    'name' => __('custom.module.courses.title')]))

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <!-- form start -->
        <form method="post"
              action="{{ $isEdit ? route('admin.courses.update', $row->getKey()) : route('admin.courses.store') }}">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Tên <code>(*)</code></label>
                            <input type="text" id="name" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $row->name) }}"
                                   placeholder="Tên khoá học">
                            @error('name')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        {{--<div class="form-group">
                            <label for="teacher_name">Tên giáo viên</label>
                            <input type="text" id="teacher_name" name="teacher_name"
                                   class="form-control @error('teacher_name') is-invalid @enderror"
                                   value="{{ old('teacher_name', $row->teacher_name) }}"
                                   placeholder="Tên giáo viên">
                            @error('teacher_name')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>--}}
                        <div class="form-group">
                            <label for="excerpt">Mô tả ngắn</label>
                            <textarea class="form-control @error('excerpt') is-invalid @enderror" id="excerpt"
                                      name="excerpt" rows="3"
                                      placeholder="Mô tả ngắn">{{ old('excerpt', $row->excerpt) }}</textarea>
                            @error('excerpt')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Ảnh đại diện</label>
                            <input type="file" id="js_image_input">
                            <input type="hidden" id="image" name="image" value="{{ old('image', $row->image) }}"
                                   accept=".png,.jpg,.jepg">

                            <div class="js_image_render"
                                 data-image="{{ old('image', $row->image) ?
                                    \Illuminate\Support\Facades\Storage::url(old('image', $row->image)) : ''}}"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description_1">Mô tả dài</label>
                            <textarea class="form-control @error('description_1') is-invalid @enderror"
                                      id="description_1" name="description_1"
                                      placeholder="Mô tả dài">{{ old('description_1', $row->description_1) }}</textarea>
                            @error('description_1')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{--<div class="col-md-12">
                        <div class="form-group">
                            <label for="description_2">Chương trình học</label>
                            <textarea class="form-control @error('description_2') is-invalid @enderror"
                                      id="description_2" name="description_2"
                                      placeholder="Chương trình học">{{ old('description_2', $row->description_2) }}</textarea>
                            @error('description_2')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>--}}

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="people_type">Đối tượng <code>(*)</code></label>
                            <select class="form-control @error('people_type') is-invalid @enderror" id="people_type"
                                    name="people_type">
                                @foreach($peopleTypes as $peopleType => $peopleTypeDetail)
                                    <option
                                        value="{{ $peopleType }}"
                                        @if($peopleType === old('people_type', $row->people_type)) selected @endif>
                                        {{ $peopleTypeDetail['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('people_type')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{--<div class="col-md-4">
                        <div class="form-group">
                            <label for="age_range">Độ tuổi</label>
                            <input type="text" id="age_range" name="age_range"
                                   class="form-control @error('age_range') is-invalid @enderror"
                                   value="{{ old('age_range', $row->age_range) }}"
                                   placeholder="VD: 4-6,...">
                            @error('age_range')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>--}}
                    {{--<div class="col-md-4">
                        <div class="form-group">
                            <label for="learn_time">Thời gian học</label>
                            <input type="text" id="learn_time" name="learn_time"
                                   class="form-control @error('learn_time') is-invalid @enderror"
                                   value="{{ old('learn_time', $row->learn_time) }}"
                                   placeholder="VD: 30 phút,...">
                            @error('learn_time')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>--}}

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="learn_price">Học phí</label>
                            <input type="text" id="learn_price" name="learn_price"
                                   class="form-control @error('learn_price') is-invalid @enderror"
                                   value="{{ old('learn_price', $row->learn_price) }}"
                                   placeholder="Học phí">
                            @error('learn_price')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{--<div class="col-md-4">
                        <div class="form-group">
                            <label for="learn_price_discount">Khuyến mại</label>
                            <input type="text" id="learn_price_discount" name="learn_price_discount"
                                   class="form-control @error('learn_price_discount') is-invalid @enderror"
                                   value="{{ old('learn_price_discount', $row->learn_price_discount) }}"
                                   placeholder="Khuyến mại">
                            @error('learn_price_discount')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>--}}
                    {{--<div class="col-md-4">
                        <div class="form-group">
                            <label for="learn_price_for_tools">Hoạ cụ</label>
                            <input type="text" id="learn_price_for_tools" name="learn_price_for_tools"
                                   class="form-control @error('learn_price_for_tools') is-invalid @enderror"
                                   value="{{ old('learn_price_for_tools', $row->learn_price_for_tools) }}"
                                   placeholder="Hoạ cụ">
                            @error('learn_price_for_tools')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>--}}

                    {{--<div class="col-md-4">
                        <div class="form-group">
                            <label for="learn_type">Loại hình <code>(*)</code></label>
                            <select class="form-control @error('learn_type') is-invalid @enderror" id="learn_type"
                                    name="learn_type">
                                @foreach($learnTypes as $learnType => $learnTypeDetail)
                                    <option
                                        value="{{ $learnType }}"
                                        @if($learnType === old('learn_type', $row->learn_type)) selected @endif>
                                        {{ $learnTypeDetail['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('learn_type')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>--}}
                    {{--<div class="col-md-4">
                        <div class="form-group">
                            <label for="paper_type">Chất liệu giấy <code>(*)</code></label>
                            <select class="form-control @error('paper_type') is-invalid @enderror" id="paper_type"
                                    name="paper_type">
                                @foreach($paperTypes as $paperyType => $paperTypeDetail)
                                    <option
                                        value="{{ $paperyType }}"
                                        @if($paperyType === old('paper_type', $row->paper_type)) selected @endif>
                                        {{ $paperTypeDetail['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('paper_type')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>--}}
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer text-right">
                <a href="{{ route('admin.courses.list') }}" class="btn btn-default"
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
        function renderImage() {
            const renderElement = $('.js_image_render');
            const url = renderElement.attr('data-image');

            renderElement.html(url.length ?
                '<img src="' + url + '" alt="Ảnh đại diện" title="Ảnh đại diện" style = "max-height: 200px;" >'
                : '');
        }


        window.onload = function () {
            appHelpers.initEditor('#description_1');
            // appHelpers.initEditor('#description_2');

            renderImage();
        };

        $(document).on('change', '#js_image_input', function () {
            const file = $(this)[0].files[0];

            if (!file) {
                return;
            }

            const formData = new FormData();

            formData.append("file", file, file.name);
            formData.append("path", 'course/image');

            $.ajax({
                type: "POST",
                url: "{{ route('admin.upload') }}",
                data: formData,
                success: function (data) {
                    if (data.status) {
                        $('.js_image_render').attr('data-image', data.data.url);
                        $('#image').val(data.data.path);
                        renderImage();
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
