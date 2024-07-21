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
                        <form action="{{ route('admins.sanpham.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="ma_san_pham" class="form-label">Mã sản phẩm</label>
                                <input type="text" id="ma_san_pham" name="ma_san_pham" class="form-control @error('ma_san_pham') is-invalid @enderror" 
                                    value="{{ old('ma_san_pham') }}" placeholder="Nhập mã sản phẩm">
                                @error('ma_san_pham')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="ten_san_pham" class="form-label">Tên sản phẩm</label>
                                <input type="text" id="ten_san_pham" name="ten_san_pham" class="form-control @error('ten_san_pham') is-invalid @enderror"
                                    value="{{ old('ten_san_pham') }}"  placeholder="Nhập tên sản phẩm">
                                @error('ten_san_pham')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="danh_muc_id" class="form-label">Danh mục sản phẩm</label>
                                <select name="danh_muc_id" id="" class="form-control">
                                    <option value="" selected>Chọn danh mục</option>
                                    @foreach ($listDanhMuc as $item)
                                        <option value="{{ $item->id }}">{{ $item->ten_danh_muc }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="anh_san_pham" class="form-label">Ảnh sản phẩm</label>
                                <input type="file" id="anh_san_pham" name="anh_san_pham" class="form-control @error('anh_san_pham') is-invalid @enderror">
                                @error('anh_san_pham')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="gia_san_pham" class="form-label">Giá sản phẩm</label>
                                <input type="number" min="1" id="gia_san_pham" name="gia_san_pham" class="form-control @error('gia_san_pham') is-invalid @enderror" 
                                    value="{{ old('gia_san_pham') }}"  placeholder="Nhập giá sản phẩm">
                                @error('gia_san_pham')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="gia_khuyen_mai" class="form-label">Giá khuyến mãi</label>
                                <input type="number" min="1" id="gia_khuyen_mai" name="gia_khuyen_mai" class="form-control @error('gia_khuyen_mai') is-invalid @enderror" 
                                    value="{{ old('gia_khuyen_mai') }}" placeholder="Nhập giá khuyến mãi">
                                @error('gia_khuyen_mai')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="so_luong" class="form-label">Số lượng</label>
                                <input type="number" min="1" id="so_luong" name="so_luong" class="form-control @error('so_luong') is-invalid @enderror" 
                                    value="{{ old('so_luong') }}"  placeholder="Nhập số lượng">
                                @error('so_luong')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="ngay_nhap" class="form-label">Ngày nhập</label>
                                <input type="date" id="ngay_nhap" name="ngay_nhap" class="form-control @error('ngay_nhap') is-invalid @enderror" 
                                    value="{{ old('ngay_nhap') }}" placeholder="Nhập số lượng">
                                @error('ngay_nhap')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="is_type" class="form-label">Trạng thái</label>
                                <select name="is_type" id="" class="form-control">
                                    <option value="" selected>Chọn trạng thái</option>
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