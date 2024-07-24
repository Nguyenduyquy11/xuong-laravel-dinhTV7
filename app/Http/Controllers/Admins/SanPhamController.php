<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanPhamRequest;
use App\Models\DanhMuc;
use App\Models\HinhAnhSanPham;
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
            // Chuyển đổi giá trị checkbox thành boolean
            $params['is_new'] = $request->has('is_new') ? 1 : 0;
            $params['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
            $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;
            if($request->hasFile('anh_san_pham')){
                $params['anh_san_pham'] = $request->file('anh_san_pham')->store('uploads/sanpham', 'public');
            }else{
                $params['anh_san_pham'] = null;
            }
            //Thêm sản phẩm
            $sanPham = SanPham::query()->create($params);
            //Lấy id sản phẩm vưa thêm để thêm được album
            $sanPhamId = $sanPham->id;

            //Xử lý thêm album
            if($request->hasFile('list_hinh_anh')){
                foreach ($request->file('list_hinh_anh') as $image){
                    if($image){
                        $path = $image->store('uploads/hinhanhsanpham/id_' . $sanPhamId, 'public');
                        $sanPham->hinhAnhSanPham()->create([
                            'san_pham_id' => $sanPhamId,
                            'hinh_anh' => $path,
                        ]);
                    }
                }
            }
            // $params['anh_san_pham'] = $fileName;
            // SanPham::create($params);
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
        $title = "Cập nhật sản phẩm";
        return view('admins.sanpham.update', compact('title', 'listDanhMuc', 'getDetailSanPham'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SanPhamRequest $request, string $id)
    {
        if($request->isMethod('PUT')){
            $params = $request->except('_token', '_method');
            // Chuyển đổi giá trị checkbox thành boolean
            $params['is_new'] = $request->has('is_new') ? 1 : 0;
            $params['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
            $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;
            $sanPham = SanPham::query()->findOrFail($id);
            if($request->hasFile('anh_san_pham')){
                if($sanPham->anh_san_pham && Storage::disk('public')->exists($sanPham->anh_san_pham)){
                    Storage::disk('public')->delete($sanPham->anh_san_pham);
                }
                $params['anh_san_pham'] = $request->file('anh_san_pham')->store('uploads/sanpham', 'public');
            }else{
                $params['anh_san_pham'] = $sanPham->anh_san_pham;
            }
            //Xử lý album ảnh
            if($request->hasFile('list_hinh_anh')){
                $currentImage = $sanPham->hinhAnhSanPham->pluck('id')->toArray();
                $arrayCombine = array_combine($currentImage, $currentImage);
                //Trường hợp xóa ảnh
                foreach ($arrayCombine as $key => $value) {
                    //Tìm kiếm id hình anh trong mảng hình ảnh mới đẩy lên 
                    //Nếu không tồn tại id thì tức là người dùng đã xóa hình ảnh đó
                    if(!array_key_exists($key, $request->list_hinh_anh)){
                        $hinhAnhSanPham = HinhAnhSanPham::query()->find($key);
                        //Xóa hình ảnh
                        if($hinhAnhSanPham && Storage::disk('public')->exists($hinhAnhSanPham->hinh_anh)){
                            Storage::disk('public')->delete($hinhAnhSanPham->hinh_anh);
                            $hinhAnhSanPham->delete();
                        }
                    }
                }
                //Trường hợp thêm hoặc sửa
                foreach ($request->list_hinh_anh as $key => $image) {
                    if(!array_key_exists($key, $arrayCombine)){
                        if($request->hasFile("list_hinh_anh.$key")){
                            $path = $image->store('uploads/hinhanhsanpham/id_' . $id, 'public');
                            $sanPham->hinhAnhSanPham()->create([
                                'san_pham_id' => $id,
                                'hinh_anh' => $path,
                            ]);
                        }
                    } else if(is_file($image) && $request->hasFile("list_hinh_anh.$key")){
                        //Trường hợp thay đổi hình ảnh 
                        $hinhAnhSanPham = HinhAnhSanPham::query()->find($key);
                        if($hinhAnhSanPham &&  Storage::disk('public')->exists($hinhAnhSanPham->hinh_anh)){
                            Storage::disk('public')->delete($hinhAnhSanPham->hinh_anh);
                        }
                        $path = $image->store('uploads/hinhanhsanpham/id_' . $id, 'public');
                        $hinhAnhSanPham->update([                            
                            'hinh_anh' => $path,
                        ]);
                    }
                }

            }
            $sanPham->update($params);
            return redirect()->route('admins.sanpham.index')->with('msg', 'Cập nhật sản phẩm thành công');
            
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        
            $sanpham = SanPham::findOrFail($id);
            
            //Xóa hình ảnh đại diện của sản phẩm
            if($sanpham->anh_san_pham && Storage::disk('public')->exists($sanpham->anh_san_pham)){
                Storage::disk('public')->delete($sanpham->anh_san_pham);
            }
           
            //Xóa album
            $sanpham->hinhAnhSanPham()->delete();
            //Xóa toàn bộ hình ảnh trong thư mục
            $path = 'uploads/hinhanhsanpham/id_' . $id;
            if($sanpham->anh_san_pham && Storage::disk('public')->exists($path)){
                Storage::disk('public')->deleteDirectory($path);
            }
            //Xóa sản phẩm
            $sanpham->delete();
             return redirect()->route('admins.sanpham.index')->with('msg', 'Xóa thành công');

    }
}
