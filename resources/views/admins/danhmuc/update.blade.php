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
                        <form action="{{ route('admins.danhmuc.update', $getDetailDanhMuc->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="hinh_anh" class="form-label">Hình ảnh</label>
                                <input type="file" id="hinh_anh" name="hinh_anh" class="form-control @error('hinh_anh') is-invalid @enderror"
                                value="{{ $getDetailDanhMuc->hinh_anh }}">
                                <br><img src="{{ Storage::url($getDetailDanhMuc->hinh_anh) }}" alt="" width="100px" height="100px">
                                @error('hinh_anh')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                                <div class="mb-3">
                                <label for="ten_danh_muc" class="form-label">Tên danh mục</label>
                                <input type="text" id="ten_danh_muc" name="ten_danh_muc" class="form-control @error('ten_danh_muc') is-invalid @enderror" placeholder="Nhập tên danh mục"
                                value="{{ $getDetailDanhMuc->ten_danh_muc }}">
                                @error('ten_danh_muc')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="trang_thai" class="form-label">Trạng thái</label>
                                <select name="trang_thai" id="" class="form-control">
                                    <option value="0" {{ $getDetailDanhMuc->trang_thai == 0 ? 'selected' : '' }}>Ẩn</option>
                                    <option value="1" {{ $getDetailDanhMuc->trang_thai == 1 ? 'selected' : '' }}>Hiển thị</option>                                </select>
                            </div>
                            <div>
                                <button class="btn btn-outline-info">Chỉnh sửa</button>
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