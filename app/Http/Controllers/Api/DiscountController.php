<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DiscountResource;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return new DiscountResource(true, 'Data Discount Berhasil Ditemukan!', $discounts);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'number' => 'required',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $discount = Discount::create([
            'code' => $request->code,
            'number' => $request->number,
        ]);

        return new DiscountResource(true, 'Data Discount Berhasil Ditambahkan!', $discount);
    }

    public function show($id)
    {
        $discount = Discount::find($id);
        if (!$discount) {
            return response()->json(['message' => 'Discount not found.'], 404);
        }
        return response()->json($discount);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'number' => 'required',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $discount = Discount::find($id);
        if (!$discount) {
            return response()->json(['message' => 'Discount not found.'], 404);
        }

        $discount->code = $request->code;
        $discount->number = $request->number;
        $discount->save();

        return new DiscountResource(true, 'Data Discount Berhasil Diubah!', $discount);
    }

    public function destroy($id)
    {
        $discount = Discount::find($id);
        if (!$discount) {
            return response()->json(['message' => 'Discount not found.'], 404);
        }
        $discount->delete();
        return new DiscountResource(true, 'Data Discount Berhasil Dihapus!', $discount);
    }
}
