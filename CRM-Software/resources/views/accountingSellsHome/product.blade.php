@extends('layout')
@section('content')
@include('partials.navbar')
@include('partials.accountingSells_sidebar')

<div class="main-container">
    <div>
        <a class="btn btn-outline-primary" href="{{ route('accountingSellsHome.product.create') }}" role="button">Create Product</a>
	</div>
    <hr>
	<h2 align=center>Product Information</h2>
    <br>
    <div>
		<select class="form-control mr-sm-2" id="searchBy">
			<option selected hidden>Search By</option>
			<option value="productCode">Product Code</option>
			<option value="productName">Product Number</option>
            <option value="productVendor">Product Vendor</option>
            <option value="quantityInStock">Quantity In Stock</option>
			<option value="buyPrice">Buy Price</option>
            <option value="sellPrice">Sell Pricer</option>
            <option value="productDescription">Product Description</option>
		</select>
        <input class="form-control mr-sm-2" type="text" name="search" id="search" placeholder="Search Product" aria-label="Search Product">
	</div>
	<script type="text/javascript">
		
		$(document).ready(function(){
		$('#search').on('keyup',function(){
			var search = $("#search").val();
			var searchBy = $("#searchBy").val();
			$.ajax({
				url: "{{ route('accountingSellsHome.product.search') }}",
				method: 'get',
				datatype : 'json',
				data : {'search':search,
						'searchBy':searchBy},
				success:function(response){
						var tableBody="<tr><td>#</td><td>Product Code</td><td>Product Number</td><td>Product Vendor</td><td>Quantity In Stock</td><td>Buy Price</td><td>Buy Price</td><td>Product Description</td><td>Action</td></tr>";
						response.forEach(element => {
							var tableRow="";
							tableRow+="<td>"+element.id+"</td>";
							tableRow+="<td>"+element.productCode+"</td>";
							tableRow+="<td>"+element.productName+"</td>";
                            tableRow+="<td>"+element.productVendor+"</td>";
                            tableRow+="<td>"+element.quantityInStock+"</td>";
							tableRow+="<td>"+element.buyPrice+"</td>";
                            tableRow+="<td>"+element.sellPrice+"</td>";
							tableRow+="<td>"+element.productDescription+"</td>";
							tableRow+="<td><a href='../accountingSellsHome/Product/edit/"+element.id+"'>Edit</a> | <a href='../accountingSellsHome/Product/delete/"+element.id+"'>Delete</a></td>";
							tableBody=tableBody+"<tr>"+tableRow+"</tr>";
						});
						$('#table').html(tableBody);
				},
				error:function(response){
					alert('server error');
				}
			});
		});
	});
	</script>
    <div class="card-box mb-30">
        <div class="pb-20">
		<table class="table hover multiple-select-row data-table-export nowrap" id="table">
			<tr>
				<th>#</td>
				<th>Product Code</td>
				<th>Product Number</td>
				<th>Product Vendor</td>
                <th>Quantity In Stock</td>
                <th>Buy Price</td>
                <th>Sell Price</td>
                <th>Product Description</td>
                <th>Action</td>
			</tr>
	
			@for($i=0; $i< count($productList); $i++ )
			<tr>
				<td>{{$productList[$i]['id']}}</td>
				<td>{{$productList[$i]['productCode']}}</td>
				<td>{{$productList[$i]['productName']}}</td>
                <td>{{$productList[$i]['productVendor']}}</td>
                <td>{{$productList[$i]['quantityInStock']}}</td>
				<td>{{$productList[$i]['buyPrice']}}</td>
				<td>{{$productList[$i]['sellPrice']}}</td>
                <td>{{$productList[$i]['productDescription']}}</td>
				<td>
                    <a href="{{ route('accountingSellsHome.product.edit', $productList[$i]['id']) }}">Edit</a><br>
                    <a href="{{ route('accountingSellsHome.product.delete', $productList[$i]['id']) }}">Delete</a>
				</td>
			</tr>
			@endfor
        </table>
        </div>	
    </div>				
</div>
 
@endsection