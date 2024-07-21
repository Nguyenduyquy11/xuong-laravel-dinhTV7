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
                        <br><a href="{{ route('admins.danhmuc.create') }}"><button class="btn btn-outline-success">Thêm
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
                                    <th>Ảnh sản phẩm</th>
                                    <th>Giá sản phẩm</th>
                                    <th>Giá khuyến mại</th>
                                    <th>Mô tả ngắn</th>
                                    <th>Nội dung</th>
                                    <th>Số lượng</th>
                                    <th>Lượt xem</th>
                                    <th>Ngày nhập</th>
                                    <th>Danh mục sản phẩm</th>
                                    <th>Trạng thái</th>
                                    <th>Sản phẩm mới</th>
                                    <th>Sản phẩm hot</th>
                                    <th>Sản phẩm hot deal</th>
                                    <th>Sản phẩm show home</th>
                                    <th colspan="2">Thao tác</th>
                                </tr>
                            </thead>
                                <tr>
                                    <td>
                                        <a href="javascript:void(0);" class="text-reset">1</a>
                                    </td>
                                    <td>
                                        Đây là mã sản phẩm
                                    </td>
                                    <td>
                                        Đây là tên sản phẩm
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <img src="" alt="" width="100px"
                                            height="100px">
                                        {{-- <p class="mb-0 fw-medium">{{ }}</p> --}}
                                    </td>
                                    <td>
                                        Giá sản phẩm
                                    </td>
                                    <td>
                                        Giá khuyến mại
                                    </td>
                                    <td>
                                        Mô tả ngắn
                                    </td>
                                    <td>
                                        Nội dung
                                    </td>
                                    <td>
                                        Số lượng
                                    </td>
                                    <td>
                                        Lượt xem
                                    </td>
                                    <td>
                                        Ngày nhập
                                    </td>
                                    <td>
                                        Danh mục sản phẩm
                                    </td>
                                    <td>
                                        Trạng thái
                                    </td>
                                    <td>
                                        Sản phẩm mới
                                    </td>
                                    <td>
                                        Sản phẩm hot
                                    </td>
                                    <td>
                                        Sản phẩm hot deal
                                    </td>
                                    <td>
                                        Sản phẩm show home
                                    </td>
                                    <td>
                                        <a href=""><i
                                                class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                        <a href=""><i                                                   
                                                 class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i></a>                                        
                                    </td>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>


        </div> <!-- container-fluid -->
    </div> <!-- content -->
@endsection
@section('js')
@endsection
