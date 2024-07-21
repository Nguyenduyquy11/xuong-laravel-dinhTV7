<?php

namespace App\Http\Controllers\Admins;

use App\Models\DanhMuc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DanhMucRequest;
use Illuminate\Support\Facades\Storage;

class DanhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Danh mục sản phẩm";
        $listDanhMuc = DanhMuc::orderByDesc('trang_thai')->get();
        return view('admins.danhmuc.index', compact('title', 'listDanhMuc'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm mới danh mục sản phẩm";
        return view('admins.danhmuc.create', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DanhMucRequest $request)
    {
        if ($request->isMethod('POST')) {
            $params =  $request->except('_token');
            if ($request->hasFile('hinh_anh')) {
                $fileName = $request->file('hinh_anh')->store('uploads/danhmuc', 'public');
            } else {
                $fileName = null;
            }
            $params['hinh_anh'] = $fileName;
            DanhMuc::create($params);
            return redirect()->route('admins.danhmuc.index')->with('msg', 'Thêm mới thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Chỉnh sửa danh mục sản phẩm";
        $getDetailDanhMuc = DanhMuc::findOrFail($id);
        return view('admins.danhmuc.update', compact('title', 'getDetailDanhMuc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DanhMucRequest $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');
            $danhmuc = DanhMuc::findOrFail($id);
            if ($request->hasFile('hinh_anh')) {
                if ($danhmuc->hinh_anh) {
                    Storage::disk('public')->delete($danhmuc->hinh_anh);
                }
                $params['hinh_anh'] = $request->file('hinh_anh')->store('uploads/danhmuc', 'public');
            } else {
                $params['hinh_anh'] = $danhmuc->hinh_anh;
            }
            $danhmuc->update($params);
            return redirect()->route('admins.danhmuc.index')->with('msg', 'Cập nhật thông tin thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if ($request->isMethod('DELETE')) {
            $danhmuc = DanhMuc::findOrFail($id);
            $danhmuc->delete($danhmuc);
            if ($danhmuc->hinh_anh && Storage::disk('public')->exists($danhmuc->hinh_anh)) {
                Storage::disk('public')->delete($danhmuc->hinh_anh);
            }
            return redirect()->route('admins.danhmuc.index')->with('msg', 'Xóa thành công');
        }
    }
}
