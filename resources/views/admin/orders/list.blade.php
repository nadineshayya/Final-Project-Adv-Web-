@extends('admin.layouts.app')

@section('content')
    <section class="section-11">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-3">
                    <!-- Date Picker Form -->
                    <form action="{{ route('orders.order') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Orders</th>
                                            <th>Date Purchased</th>
                                            <th>Coupon Code</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($orders->isNotEmpty())
                                            @foreach($orders as $order)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('front.account.order-details', $order->id) }}">
                                                            {{ $order->id }}
                                                        </a>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</td>
                                                    <td>
                                                        <span class="badge bg-success">{{ $order->coupon_code }}</span>
                                                    </td>
                                                    <td>${{ $order->grand_total }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    Orders not found
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection