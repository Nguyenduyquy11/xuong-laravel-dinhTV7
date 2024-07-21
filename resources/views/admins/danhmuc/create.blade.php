@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('css')
    
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">{{ $title}}</h5>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route('admins.danhmuc.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="hinh_anh" class="form-label">Hình ảnh</label>
                                <input type="file" id="hinh_anh" name="hinh_anh" class="form-control @error('hinh_anh') is-invalid @enderror">
                                @error('hinh_anh')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                                <div class="mb-3">
                                <label for="ten_danh_muc" class="form-label">Tên danh mục</label>
                                <input type="text" id="ten_danh_muc" name="ten_danh_muc" class="form-control @error('ten_danh_muc') is-invalid @enderror" placeholder="Nhập tên danh mục">
                                @error('ten_danh_muc')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="trang_thai" class="form-label">Trạng thái</label>
                                <select name="trang_thai" id="" class="form-control">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                            </div>
                            <div>
                                <button class="btn btn-outline-success">Thêm mới</button>
                            </div>

                        </form>
                    </div>

            
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js')
    
@endsection