@extends('layouts.app')

@section('content')
<div>
<div id="product-table-container"   class="">

</div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $.get('/api/products/active', function(data) {
                 console.log(data);
                 renderProductsTable(data);
                  $('#order-name').text(data.name);
         }).fail(function() {
                 alert('Could not fetch data.');
        });
      }); 
      function renderProductsTable(response) {
        let products=response.data;
          let tableHtml = `<div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left text-gray-500">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th class="px-6 py-3">Product Name</th>
                        <th class="px-6 py-3">Product Type</th>
                        <th class="px-6 py-3">Product Code</th>
                        <th class="px-6 py-3">BarCode</th>
                        <th class="px-6 py-3">Market Unit cost</th>
                        <th class="px-6 py-3">Brand</th>
                        <th class="px-6 py-3">Manufaturer</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody id="product-rows" class="bg-white divide-y divide-gray-200">
                </tbody>
                </table>
            </div>
          `;

          $('#product-table-container').html(tableHtml);
          products.forEach(product => {
            // Handle logic for badge colors'
               let row = `
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 font-semibold text-indigo-600">
                    ${product.product_name}
                </td>
                <td class="px-6 py-4 font-semibold text-indigo-600">
                    ${product.product_type}
                </td>
                 <td class="px-6 py-4 font-semibold text-indigo-600">
                    ${product.product_code}
                </td>
                 <td class="px-6 py-4 font-semibold text-indigo-600">
                    ${product.bar_code}
                </td>
                 <td class="px-6 py-4 font-semibold text-indigo-600">
                    ${product.market_unit_cost}
                </td>
                 <td class="px-6 py-4 font-semibold text-indigo-600">
                    ${product.brand}
                </td>
                 <td class="px-6 py-4 font-semibold text-indigo-600">
                    ${product.manufacturer}
                </td>
                <td class="px-6 py-4 text-right space-x-3">
                    <button onclick="handleAction(${product.id}, 'view')" class="text-indigo-600 hover:underline">View</button>
                    <button onclick="handleAction(${product.id}, 'edit')" class="text-gray-400 hover:text-gray-700">Edit</button>
                </td>
            </tr>
        `;
        $('#product-rows').append(row);
        });
      }
    </script>
@endpush