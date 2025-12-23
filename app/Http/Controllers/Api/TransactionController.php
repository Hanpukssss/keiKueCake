<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $transactions = Transaction::query()
            ->with('product')
            ->latest()
            ->paginate(10);

        return response()->json($transactions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'product_uuid' => ['required', 'exists:products,uuid'],
            'qty' => ['required', 'integer', 'min:1'],
            'status' => ['nullable', 'string'],
        ]);

        $transaction = DB::transaction(function () use ($data) {
            $product = Product::where('uuid', $data['product_uuid'])->lockForUpdate()->first();

            if (!$product) {
                abort(response()->json(['message' => 'Produk tidak ditemukan'], 404));
            }

            if ($product->stock < $data['qty']) {
                abort(response()->json(['message' => 'Stok tidak mencukupi'], 422));
            }

            $product->decrement('stock', $data['qty']);

            return Transaction::create([
                'product_id' => $product->id,
                'qty' => $data['qty'],
                'total_price' => $data['qty'] * $product->price,
                'status' => $data['status'] ?? 'paid',
            ]);
        });

        return response()->json($transaction->load('product'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction): JsonResponse
    {
        return response()->json($transaction->load('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction): JsonResponse
    {
        $data = $request->validate([
            'qty' => ['sometimes', 'required', 'integer', 'min:1'],
            'status' => ['sometimes', 'string'],
        ]);

        $transaction = DB::transaction(function () use ($transaction, $data) {
            $product = Product::where('id', $transaction->product_id)->lockForUpdate()->first();

            if (isset($data['qty'])) {
                $diff = $data['qty'] - $transaction->qty;
                if ($diff > 0 && $product->stock < $diff) {
                    abort(response()->json(['message' => 'Stok tidak mencukupi untuk perubahan qty'], 422));
                }

                if ($diff !== 0) {
                    if ($diff > 0) {
                        $product->decrement('stock', $diff);
                    } else {
                        $product->increment('stock', abs($diff));
                    }
                    $transaction->qty = $data['qty'];
                    $transaction->total_price = $transaction->qty * $product->price;
                }
            }

            if (isset($data['status'])) {
                $transaction->status = $data['status'];
            }

            $transaction->save();

            return $transaction;
        });

        return response()->json($transaction->load('product'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction): JsonResponse
    {
        DB::transaction(function () use ($transaction) {
            $transaction->product()->increment('stock', $transaction->qty);
            $transaction->delete();
        });

        return response()->json(['message' => 'Transaksi dihapus']);
    }
}
