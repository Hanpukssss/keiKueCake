<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuickOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuickOrderController extends Controller
{
    public function index(): JsonResponse
    {
        $orders = QuickOrder::query()->latest()->paginate(15);
        return response()->json($orders);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'product' => ['required', 'string', 'max:255'],
            'qty' => ['required', 'integer', 'min:1'],
            'date_required' => ['nullable', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $order = QuickOrder::create($data + ['status' => 'pending']);

        return response()->json([
            'message' => 'Permintaan diterima, kami akan hubungi Anda.',
            'data' => $order,
        ], 201);
    }
}
