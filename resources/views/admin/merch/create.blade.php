@extends('layouts.master')
@section('main-content')
    <div class="d-flex justify-content-between mb-2">
        <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-primary">Back to the list of products</a>
    </div>
    <div class="card ">
        <div class="card-header">
            Add Product
        </div>
        <div class="card-body">
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" class="form-control" required placeholder="Name of Product">
                </div>
                <div class="form-group" x-data="{
                    checkValue(){
                        let val = this.$refs.input.value;
                        if(val <= 0){
                            this.$refs.input.value = 1;
                        }
                    }
                }">
                    <input type="number" x-on:input="checkValue()" x-ref="input" min="1" name="price" class="form-control" required placeholder="Price of Product">
                </div>
                <div class="form-group">
                    <textarea name="desc" id="" cols="30" rows="10" required></textarea>
                </div>
                <div class="form-group">
                    <label for="">Image of product ( preferably in white background )</label>
                    <input type="file" name="picture" required class="d-block">
                </div>
                <button class="btn btn-primary">
                    Submit
                </button>
            </form>
        </div>
    </div>
@endsection


@section('top') 
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('bottom')
   <script src="/vendor/ckeditor/ckeditor.js"></script>
   <script>
       CKEDITOR.replace('desc')
   </script>
@endsection