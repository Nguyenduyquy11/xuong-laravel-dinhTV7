@extends('layouts.admin')
@section('title')
    {{ $title }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lý sản phẩm</h4>
                    @if (session('msg'))
                        <br>
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                    @endif
                    <div>
                        <br><a href="{{ route('admins.sanpham.create') }}"><button class="btn btn-outline-success">Thêm
                                mới</button></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-traffic mb-0">

                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Danh mục sản phẩm</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th>Giá sản phẩm</th>
                                    <th>Giá khuyến mại</th>
                                    <th>Số lượng</th>
                                    <th>Trạng thái</th>
                                    <th colspan="2">Thao tác</th>
                                </tr>
                            </thead>
                            @foreach ($listSanPham as $index => $item)
                                <tr>
                                    <td><a href="javascript:void(0);" class="text-reset">{{ $index +1 }}</a></td>
                                    <td>{{ $item->ma_san_pham }}</td>
                                    <td>{{ $item->ten_san_pham }}</td> 
                                    <td>{{ $item->danhMuc->ten_danh_muc }}</td>
                                    <td class="d-flex align-items-center">
                                        <img src="{{ Storage::url($item->danhMuc->hinh_anh) }}" alt="" width="100px" height="100px">
                                    </td>
                                    <td>{{ $item->gia_san_pham }}</td>
                                    <td>{{ $item->gia_khuyen_mai }}</td>
                                    <td>{{ $item->so_luong }}</td>
                                    <td class="{{ $item->is_type == true ? 'text-success' : 'text-danger'}} ">
                                        {{ $item->is_type == true ? 'Hiển thị' : 'Ẩn'}} 
                                    </td>
                                    <td>
                                        <a href="{{ route('admins.sanpham.edit', $item->id) }}"><i
                                                class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                        <form action="{{ route('admins.sanpham.destroy', $item->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Bạn có muốn xóa không')">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="border-0 bg-white"> 
                                                <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i>
                                            </button>     
                                        </form>                                       
                                    </td>
                                </tr>
                                
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>


        </div> <!-- container-fluid -->
    </div> <!-- content -->
@endsection
@section('js')
@endsection
