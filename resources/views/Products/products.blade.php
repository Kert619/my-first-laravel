@extends("layout")

@section("title", "Products")

@section("content")
<div class="row m-0 g-3 align-items-center justify-content-end">
    <div class="col-md-8 col-xl-6">
        <form action="{{ route('products.search') }}" method="GET">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control shadow-none" placeholder="Search any product here" name="search"
                    autocomplete="off" autofocus>
                <button type="submit" class="btn btn-success d-inline-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                    <span>Search</span>
                </button>
            </div>
        </form>
    </div>
    <div class="col-auto">
        <button class="btn btn-sm btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#products-modal"
            data-url="{{ route('products.save') }}">Add
            Product</button>
    </div>
</div>

@if(count($products) > 0)
<div class="container-fluid mt-3">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr class="text-bg-success">
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stocks</th>
                    <th scole="col" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $count = 1
                @endphp
                @foreach ($products as $product)
                <tr>
                    <th scope="row">{{ $count++ }}</th>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->category_name }}</td>
                    <td>{{ number_format($product->product_price, 2) }}</td>
                    <td>{{ number_format($product->product_stocks) }}</td>
                    <td class="text-end text-nowrap">
                        <a class="btn btn-sm btn-warning d-inline-flex align-items-center gap-1 edit-product"
                            data-url="{{ route('products.get', ['id' => $product->id]) }}" data-bs-toggle="modal" ,
                            data-bs-target="#products-modal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                            <span>Edit</span>
                        </a>

                        <button type="button"
                            class="btn btn-sm btn-danger d-inline-flex align-items-center gap-1 delete-product"
                            data-url="{{ route('products.delete', ['id' => $product->id]) }}" data-bs-toggle="modal"
                            data-bs-target="#delete-modal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-archive-fill" viewBox="0 0 16 16">
                                <path
                                    d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z" />
                            </svg>
                            <span>Delete</span>
                        </button>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <nav>
        <ul class="pagination justify-content-end">
            <li class="page-item"><a class="page-link shadow-none" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link shadow-none" href="#">Next</a></li>
        </ul>
    </nav>
</div>

@else
<h1 class="text-center mt-5 text-danger">NO RESULTS FOUND</h1>
@endif
<div class="modal fade" tabIndex="-1" id="products-modal" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control form-control-sm shadow-none" id="product-name" required
                            name="product_name" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select shadow-none" aria-label="Default select example" id='category'
                            name="category_id" required>
                            <option value="" selected>--Select Category--</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Price</label>
                        <input type="number" class="form-control form-control-sm shadow-none" id='product-price'
                            required name="product_price">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Stocks</label>
                        <input type="number" class="form-control form-control-sm shadow-none" id='product-stocks'
                            required name="product_stocks">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary btn-action">Save Product</button>
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@php

$delete_title = 'DELETE PRODUCT';
$delete_message = 'Do you want to delete this product?';

@endphp

@include('../delete-modal')
<script src="{{ asset('js/pages/products.js') }}"></script>
@endsection