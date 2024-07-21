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
                    <h4 class="fs-18 fw-semibold m-0">Quản lý danh mục sản phẩm</h4>
                     @if (session('msg'))
                        <br><div class="alert alert-success">
                                {{ session('msg') }}
                        </div>
                    @endif
                    <div>
                        <br><a href="{{ route('admins.danhmuc.create') }}"><button class="btn btn-outline-success">Thêm mới</button></a>
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
                                    <th>Hình ảnh danh mục</th>
                                    <th>Tên danh mục</th>
                                    <th>Trạng thái</th>
                                    <th colspan="2">Thao tác</th>
                                </tr>
                            </thead>
                                @foreach ($listDanhMuc as $index => $item)
                                    
                                    <tr>
                                        <td>
                                            <a href="javascript:void(0);" class="text-reset">{{ $index +1 }}</a>
                                        </td>
                                        <td class="d-flex align-items-center">
                                            <img src="{{ Storage::url($item->hinh_anh) }}" alt="" width="100px" height="100px">
                                            {{-- <p class="mb-0 fw-medium">{{ }}</p> --}}
                                        </td>
                                        <td>
                                            <p class="mb-0">{{ $item->ten_danh_muc}}</p>
                                        </td>
                                        <td class="{{ $item->trang_thai ==true ? 'text-success' : 'text-danger'}}">
                                            <p class="mb-0">{{ $item->trang_thai ==true ? 'Hiển thị' : 'Ẩn'}}</p>
                                        </td>
                                        <td>
                                            <a href="{{ route('admins.danhmuc.edit', $item->id) }}"><i
                                                    class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                            <form action="{{ route('admins.danhmuc.destroy', $item->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Bạn có muốn xóa không?')">
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
