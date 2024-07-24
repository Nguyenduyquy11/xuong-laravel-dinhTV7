@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('css')
    <link href="{{ asset('assets/admins/libs/quill/quill.core.js') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admins/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admins/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">{{ $title }}</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <form action="{{ route('admins.sanpham.update',  $getDetailSanPham->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="mb-3">
                                    <label for="ma_san_pham" class="form-label">Mã sản phẩm</label>
                                    <input type="text" id="ma_san_pham" name="ma_san_pham"
                                        class="form-control @error('ma_san_pham') is-invalid @enderror"
                                        value="{{ $getDetailSanPham->ma_san_pham}}">
                                    @error('ma_san_pham')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="ten_san_pham" class="form-label">Tên sản phẩm</label>
                                    <input type="text" id="ten_san_pham" name="ten_san_pham"
                                        class="form-control @error('ten_san_pham') is-invalid @enderror"
                                        value="{{ $getDetailSanPham->ten_san_pham }}">
                                    @error('ten_san_pham')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="danh_muc_id" class="form-label">Danh mục sản phẩm</label>
                                    <select name="danh_muc_id" id="" class="form-control @error('danh_muc_id') is-invalid @enderror">
                                        @foreach ($listDanhMuc as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $getDetailSanPham->danh_muc_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->ten_danh_muc }}</option>
                                        @endforeach
                                    </select>
                                    @error('danh_muc_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="gia_san_pham" class="form-label">Giá sản phẩm</label>
                                    <input type="number" min="1" id="gia_san_pham" name="gia_san_pham"
                                        class="form-control @error('gia_san_pham') is-invalid @enderror"
                                        value="{{ $getDetailSanPham->gia_san_pham }}">
                                    @error('gia_san_pham')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="gia_khuyen_mai" class="form-label">Giá khuyến mãi</label>
                                    <input type="number" min="1" id="gia_khuyen_mai" name="gia_khuyen_mai"
                                        class="form-control @error('gia_khuyen_mai') is-invalid @enderror"
                                        value="{{ $getDetailSanPham->gia_khuyen_mai }}">
                                    @error('gia_khuyen_mai')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="so_luong" class="form-label">Số lượng</label>
                                    <input type="number" min="1" id="so_luong" name="so_luong"
                                        class="form-control @error('so_luong') is-invalid @enderror"
                                        value="{{ $getDetailSanPham->so_luong }}">
                                    @error('so_luong')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="ngay_nhap" class="form-label">Ngày nhập</label>
                                    <input type="date" id="ngay_nhap" name="ngay_nhap"
                                        class="form-control @error('ngay_nhap') is-invalid @enderror"
                                        value="{{ $getDetailSanPham->ngay_nhap }}">
                                    @error('ngay_nhap')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="mo_ta_ngan" class="form-label">Mô tả ngắn </label>
                                    <textarea name="mo_ta_ngan" rows="3"
                                        class="form-control 
                                @error('mo_ta_ngan') is-invalid @enderror">{{ $getDetailSanPham->mo_ta_ngan }}</textarea>
                                    @error('mo_ta_ngan')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="is_type" class="form-label">Trạng thái</label>
                                    <select name="is_type" id="" class="form-control @error('is_type') is-invalid @enderror">                                    
                                        <option value="0" {{ $getDetailSanPham->is_type == 0 ? 'selected' : '' }}>Ẩn</option>
                                        <option value="1" {{ $getDetailSanPham->is_type == 1 ? 'selected' : '' }}>Hiển thị</option>
                                    </select>
                                    @error('is_type')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <label for="is_type" class="form-label">Tùy chỉnh khác</label>
                                <div class="form-switch mb-2 ps-3 d-flex justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input " type="checkbox" id="is_new"
                                            name="is_new" {{ $getDetailSanPham->is_new == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_new">New</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input " type="checkbox" id="is_hot"
                                            name="is_hot" {{ $getDetailSanPham->is_hot == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_hot">Hot</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input " type="checkbox" id="is_hot_deal"
                                            name="is_hot_deal" {{ $getDetailSanPham->is_hot_deal == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_hot_deal">Hot deal</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input " type="checkbox" id="is_show_home"
                                            name="is_show_home" {{ $getDetailSanPham->is_show_home == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_show_home">Show home</label>
                                    </div>
                                </div>


                        </div>

                        <div class="col-lg-8">
                            <div class="mb-3" id="chart">
                                <label class="form-check-label" for="is_show_home">Mô tả chi tiết sản phẩm</label>
                                <div id="quill-editor" style="height: 400px;">
                                    <h1>Nhập mô tả chi tiết sản phẩm</h1>
                                </div>
                                <textarea name="noi_dung" id="noi_dung_content" class="d-none"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="anh_san_pham" class="form-label">Ảnh sản phẩm</label>
                                <input type="file" id="anh_san_pham" name="anh_san_pham" class="form-control">
                                <br><img src="{{ Storage::url($getDetailSanPham->anh_san_pham) }}" alt="" width="150px">
                            </div>
                            <div class="mb-3">
                                <label for="anh_san_pham" class="form-label">Album hình ảnh</label>
                                <i id="add-row" class="mdi mdi-plus text-muted fs-18 rounded-2 border ms-3 p-1"
                                    style="cursor:pointer"></i>
                                <table class="table align-middle table-nowrap mb-0">
                                    <tbody id="image-table-body">
                                        @foreach ($getDetailSanPham->hinhAnhSanPham as $index => $hinhAnh)
                                            <tr>
                                                <td class="d-flex align-item-center">
                                                    <img id="preview_{{ $index }}"
                                                        src="{{ Storage::url($hinhAnh->hinh_anh) }}"
                                                        alt="Hình ảnh sản phẩm" style="width: 50px;" class="me-3">
                                                    <input type="file" id="anh_san_pham" name="list_hinh_anh[{{ $hinhAnh->id }}]"
                                                        class="form-control" onchange="previewImage(this, {{ $index }})">
                                                        <input type="hidden" name="list_hinh_anh[{{ $hinhAnh->id }}]" value="{{ $hinhAnh->id }}">
                                                </td>
                                                <td>
                                                    <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"
                                                        style="cursor:pointer" onclick="removeRow(this)"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-outline-success">Cập nhật</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/admins/libs/quill/quill.core.js') }}"></script>
    <script src="{{ asset('assets/admins/libs/quill/quill.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Quill editor initialization
            var quill = new Quill("#quill-editor", {
                theme: "snow",
            });

            // Hiển thị nội dung cũ
            var old_content = `{!! $getDetailSanPham->noi_dung !!}`;
            quill.root.innerHTML = old_content;

            // Cập nhật lại textarea ẩn khi nội dung của quill-editor thay đổi
            quill.on('text-change', function() {
                var html = quill.root.innerHTML;
                document.getElementById('noi_dung_content').value = html;
            });
        });
    </script>
    {{-- Thêm album ảnh --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rowCount = {{ count($getDetailSanPham->hinhAnhSanPham) }};
            document.getElementById('add-row').addEventListener('click', function() {
                var tableBody = document.getElementById('image-table-body')
                var newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td class="d-flex align-item-center">
                        <img id="preview_${rowCount}"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0Wr3oWsq6KobkPqznhl09Wum9ujEihaUT4Q&s"
                            alt="Hình ảnh sản phẩm" style="width: 50px;" class="me-3">
                        <input type="file" id="anh_san_pham" name="list_hinh_anh[id_${rowCount}]"
                            class="form-control" onchange="previewImage(this, ${rowCount})">
                    </td>
                    <td>
                        <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"
                            style="cursor:pointer" onclick="removeRow(this)"></i>
                    </td>
                `;
                tableBody.appendChild(newRow);
                rowCount++;

            })
        });

        function previewImage(input, rowIndex) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById(`preview_${rowIndex}`).setAttraibute('src', e.target.result)

                }

                reader.readAsDataURL(input.files[0])
            }
        }

        function removeRow(item){
            var row = item.closest('tr');
            row.remove();
        }
    </script>
@endsection
