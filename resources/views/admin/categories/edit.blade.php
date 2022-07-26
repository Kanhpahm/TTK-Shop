@extends('admin.admin-master')

@section('title', 'Cập nhật ' . $category->name)

@section('content-title', 'Edit Category')
@section('danh-muc', 'Edit Category')
@section('content')

       
    <form action="{{route('category-update', $category->id)}}" method="POST" enctype="multipart/form-data">
       
       {{-- @method('PUT') <br> --}}
        @csrf
        @include('admin.alert')
        <div class="form-outline">
            @if ($errors->any())
                 <h5 style="color: red"> {{ $errors }}</h5>
            @endif
        </div>
        <input type="hidden" name="id" value="{{$category->id}}">
        <div class="row mb-4">
            <div class="col">
                <div class="form-outline">
                    <label class="form-label" for="form3Example1">Tên Danh Mục</label>
                    <input type="text" id="form3Example1" value="{{ $category->name}}"
                     name="name" class="form-control" />
                    @error('name')
                        <h6 style="color: rgb(255, 0, 0)">{{ $message }} </h6>
                    @enderror
                </div>
            </div>

        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Mô Tả Ngắn</label>
            <input type="text" id="form3Example3" value="{{$category->description}}" name="description" class="form-control" />
            @error('description')
                        <h6 style="color: rgb(255, 0, 0)">{{ $message }} </h6>
                    @enderror
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Image</label>
            <input type="file" value=""  id="form3Example3" name="image" class="form-control" />
            <img src="{{asset($category->image) }}" width="150" alt="">
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Kích Hoạt</label>
            <br>
            <input type="radio" id="form3Example3" name="active" value="1" {{$category->active == 1 ? 'checked="Publish"':''}}  /> Publish
            <input type="radio" id="form3Example3" name="active" value="0" {{$category->active == 0 ? 'checked="Private"':''}} /> Private
        </div>
        <button type="submit" class="btn btn-danger btn-block mb-4">Cập Nhật</button>
        <!-- Register buttons -->
        <button type="reset" class="btn btn-warning btn-block mb-4">Nhập lại</button>

    </form>
@endsection
