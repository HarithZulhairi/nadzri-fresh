@extends('layouts/headerFooter')

@section('content')

<style>
    /* Edit Waste Product Styles */
    .waste-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
    }

    .edit-form-container {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 2rem;
        margin-top: 1.5rem;
        display: flex;
        gap: 2rem;
        flex-direction: column;
    }

    .image-section {
        flex: 0 0 200px;
    }

    .form-content {
        flex: 1;
    }

    .product-image {
        width: 100%;
        height: 200px;
        background-color: #eee;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        margin-bottom: 1rem;
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .form-section h2 {
        color: black;
        margin-bottom: 0.5rem;
        font-size: 1.2rem;
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 1em;
    }
    
    .buttons {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }

    .edit-btn {
        background-color: #8D8F55;
        color: white;
        border: none;
        padding: 1rem 4rem;
        border-radius: 20px;
        font-size: 20px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s;
        display: block;
        margin: 0rem auto 0;
        text-align: center;
    }

    .back-btn {
        background-color:rgb(139, 7, 7);
        color: white;
        border: none;
        padding: 1rem 4rem;
        border-radius: 20px;
        font-size: 20px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s;
        display: block;
        margin: 0rem auto 0;
        text-align: center;
        text-decoration: none;
    }

    .edit-btn:hover {
        background-color: #247348;
    }

    .back-btn:hover {
        background-color:rgb(228, 0, 0);
    }

    .divider {
        border-top: 1px solid #ddd;
        margin: 2rem 0;
    }

    @media (max-width: 768px) {
        .edit-form-container {
            flex-direction: column;
        }
        
        .image-section {
            flex: 0 0 auto;
            margin-bottom: 1.5rem;
        }
    }
</style>

<div class="waste-container">
    <h1>Edit Status of Waste Product</h1>
    
    <div class="edit-form-container">
        <div class="image-section">
            <div class="product-image">
                [Product Image]
            </div>
        </div>

        <div class="form-content">
            <div class="form-section">
                <h2>Product Name</h2>
                <div class="form-group">
                    <input type="text" class="form-control" value="Red Spinach" readonly>
                </div>
            </div>

            <div class="form-section">
                <h2>New Status</h2>
                <div class="form-group">
                    <!-- <select class="form-control">
                        <option value="">Choose status options</option>
                        <option value="expired">Expired</option>
                        <option value="damaged">Damaged</option>
                        <option value="almost_expired">Almost Expired</option>
                        <option value="good">Good Condition</option>
                    </select> -->
                    <input type="text" class="form-control" value="Red Spinach" >
                </div>
            </div>

            <div class="form-section">
                <h2>New Expired Date</h2>
                <div class="form-group">
                    <input type="date" class="form-control" readonly>
                </div>
            </div>

            <div class="divider"></div>
            <div class="buttons">
                <a href="{{ route('manage_waste.viewWaste') }}" style="text-decoration: none;"><button class="edit-btn">Edit</button></a>
                <a href="{{ route('manage_waste.viewWaste') }}" style="text-decoration: none;"><button class="back-btn">Back</button></a>
            </div>

        </div>
        
    </div>
    
</div>
@endsection