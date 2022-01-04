@extends('layout.master')
@section('content')
<div class="card">
<div class="p-4  bg-light ">                   
<div class="jumbotron">
  <h1 class="display-4">FACTURA !</h1>
  <p class="lead">En el cual podremos generar factura <i class="mdi mdi-cloud-print"></i></p>
  <hr class="my-4">    
</div>      
</div>
    <div class="card-body">
    <created-invoice></created-invoice>       
    </div>  
    </div>  
@endsection
@push('style')
<style type="text/css">
.card-border-outset{
    background:#fdfdee;padding:7px;border:outset;border-color:bisque;
}
</style>
@endpush