@extends('admin.layouts.master')

@section('pageTitle', __('custom.label.' . ($isEdit ? 'update_a_row' : 'create_a_row'), [
    'name' => __('custom.module.student_picture.title')]))

@section('content')
    <!-- general form elements -->
    <div class="card card-primary">
        <!-- form start -->
        <form method="post"
              action="{{ $isEdit ? route('admin.student_picture.update', $row->getKey()) : route('admin.student_picture.store') }}">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset( "storage/" . $row->picture)  }}" alt="" style="width: 100%">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="scores">Điểm <code>(*)</code></label>
                            <input type="number" id="scores" name="scores"
                                   class="form-control @error('scores') is-invalid @enderror"
                                   value="{{ old('scores', $row->scores) }}"
                                   placeholder="Điểm số" min="0" max="10" step="0.5">
                            @error('scores')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="scores">Nhận xét <code>(*)</code></label>
                            <input type="text" id="comment" name="comment"
                                   class="form-control @error('comment') is-invalid @enderror"
                                   value="{{ old('comment', $row->comment) }}"
                                   placeholder="Nhận xét">
                            @error('comment')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer text-right">
                <a href="{{ route('admin.student_picture.list') }}" class="btn btn-default"
                   title="{{ __('custom.button.back') }}">{{ __('custom.button.back') }}</a>
                <button type="submit" class="btn btn-success"
                        title="{{ __('custom.button.save') }}">{{ __('custom.button.save') }}</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@stop
