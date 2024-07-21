<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanPhamRequest;
use App\Models\DanhMuc;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listSanPham = SanPham::orderByDesc('is_type')->get();
        $title = "Danh sách sản phẩm";
        return view('admins.sanpham.index', compact('title','listSanPham'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listDanhMuc = DanhMuc::query()->get();
        $title = "Danh sách sản phẩm";
        return view('admins.sanpham.create', compact('title', 'listDanhMuc'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SanPhamRequest $request)
    {
        if($request->isMethod('POST')){
            $params = $request->except('_token');
            if($request->hasFile('anh_san_pham')){
                $fileName = $request->file('anh_san_pham')->store('uploads/sanpham', 'public');
            }else{
                $fileName = null;
            }
            $params['anh_san_pham'] = $fileName;
            SanPham::create($params);
            return redirect()->route('admins.sanpham.index')->with('msg', 'Thêm sản phẩm thành công');
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
        $getDetailSanPham = SanPham::findOrFail($id);
        $listDanhMuc = DanhMuc::query()->get();
        $title = "Danh sách sản phẩm";
        return view('admins.sanpham.update', compact('title', 'listDanhMuc', 'getDetailSanPham'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SanPhamRequest $request, string $id)
    {
        if($request->isMethod('PUT')){
            $params = $request->except('_token', '_method');
            $sanpham = SanPham::findOrFail($id);
            if($request->hasFile('anh_san_pham')){
                if($sanpham->anh_san_pham){
                    Storage::disk('public')->delete($sanpham->anh_san_pham);
                }
                $params['anh_san_pham'] = $request->file('anh_san_pham')->store('uploads/sanpham', 'public');
            }else{
                $params['anh_san_pham'] = $sanpham->anh_san_pham;
            }
            $sanpham->update($params);
            return redirect()->route('admins.sanpham.index')->with('msg', 'Chỉnh sửa sản phẩm thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if($request->isMethod('DELETE')){
            $sanpham = SanPham::findOrFail($id);
            $sanpham->delete($id);
            if($sanpham->anh_san_pham && Storage::disk('public')->exists($sanpham->anh_san_pham)){
                Storage::disk('public')->delete($sanpham->anh_san_pham);
            }
            return redirect()->route('admins.sanpham.index')->with('msg', 'Xóa thành công');
        }
    }
}
