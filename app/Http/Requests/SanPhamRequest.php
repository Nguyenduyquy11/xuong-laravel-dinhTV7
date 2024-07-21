<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SanPhamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $sanphamId = $this->route('id');
        return [
            'ma_san_pham' => 'required|unique:san_phams,ma_san_pham,' . $sanphamId,
            'ten_san_pham' => 'required|max:255',
            'danh_muc_id' => 'required|',
            'gia_san_pham' => 'required|max:8',
            'gia_khuyen_mai' => 'required|max:8',
            'so_luong' => 'required|max:999',
            'ngay_nhap' => 'required',
            'is_type' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'ma_san_pham.required' => 'Không được để trống',
            'ma_san_pham.unique' => 'Mã sản phẩm phải là duy nhất',
            'ten_san_pham.required' => 'Không được để trống',
            'ten_san_pham.max:255' => 'Không được vượt quá 255 ký tự',
            'danh_muc_id.required' => 'Chọn danh mục',
            'gia_san_pham.required' => 'Không được bỏ trống',
            'gia_san_pham.max:8' => 'Giá phải nhỏ hơn 99.999.999',
            'gia_khuyen_mai.required' => 'Không được bỏ trống',
            'gia_khuyen_mai.max:8' => 'Giá phải nhỏ hơn 99.999.999',
            'so_luong.required' => 'Không được bỏ trống',
            'so_luong.max:999' => 'Số lượng tối đa là 999',
            'ngay_nhap.required' => 'Không được bỏ trống',
            'is_type.required' => 'Chọn trạng thái sản phẩm',
        ];
    }
}
