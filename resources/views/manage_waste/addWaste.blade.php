@extends('layouts/headerFooter')

@section('content')
<style>
    /* Waste Management Styles */
    .waste-container {
        max-width: 80%;
        margin: 0 auto;
    }

    .waste-list {
        margin-top: 2rem;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .waste-item {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        background-color: #f9f9f9;
        border: 1px solid black;
        padding: 1rem;
        border-radius: 4px;
    }

    .waste-item-content {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-grow: 1;
    }

    .waste-image-1 {
        width: 60px;
        height: 60px;
        background-color: #ddd;
        border-radius: 4px;
    }

    .description-waste {
        flex-grow: 1;
    }

    .waste-item h3 {
        color: rgb(0, 0, 0);
        font-size: 24px;
        margin-bottom: 0.5rem;
    }

    .waste-item p {
        color: #555;
        margin-bottom: 0.5rem;
        font-size: 20px;
    }

    .button-add-waste {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 1rem;
    }

    .add-waste-btn {
        background-color: #558F55;
        color: white;
        border: none;
        padding: 20px;
        border-radius: 40px;
        cursor: pointer;
        transition: background-color 0.3s;
        white-space: nowrap;
        font-size: 20px;
        font-weight: bold;
    }

    .add-waste-btn:hover {
        background-color: #c0392b;
    }

    /* Status color classes */
    .status-expired {
        color: #F58F00;
        font-weight: bold;
    }
    
    .status-almost-expired {
        color: #B8B200;
        font-weight: bold;
    }
    
    .status-damaged {
        color: #0C00B8;
        font-weight: bold;
    }
    
    .date-expired {
        color: red;
    }
</style>

<div class="waste-container">
    <h1>Waste Product List</h1>
    
    <div class="waste-list">
        @foreach($products as $product)
            @if($product->product_status !== 'Good')
            <div class="waste-item">
                <div class="waste-item-content">
                    <div class="waste-image-1">
                        <img src="{{ asset('storage/' . $product->product_picture_path) }}" alt="{{ $product->product_name }}">
                    </div>
                    <div class="description-waste">
                        <h3>{{ $product->product_name }} 
                            <span style="color: orange;"><i class="fa-solid fa-triangle-exclamation"></i></span>
                        </h3>
                        <p>Status: 
                            <span class="
                                @if($product->product_status == 'Expired') status-expired
                                @elseif($product->product_status == 'Almost Expired') status-almost-expired
                                @elseif($product->product_status == 'Damaged') status-damaged
                                @endif
                            ">
                                {{ $product->product_status }}
                            </span>
                        </p>
                        <p class="date-expired" style="color: red;">
                            {{ \Carbon\Carbon::parse($product->product_expiryDate)->format('d M Y') }}
                        </p>
                    </div>
                </div>
                <div class="button-add-waste">
                    <button class="add-waste-btn">Add to waste</button>
                </div>
            </div>
            @endif
        @endforeach
        
        @if($products->whereIn('product_status', ['Almost Expired', 'Expired', 'Damaged'])->count() == 0)
            <div class="no-products">
                <p>No waste products found.</p>
            </div>
        @endif
    </div>
</div>
@endsection