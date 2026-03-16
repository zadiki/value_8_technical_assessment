@extends('layouts.app')

@section('content')
 <div class="max-w-6xl mx-auto">
        
        <div class="flex justify-between items-center mb-6">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition shadow-sm flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create New Order
            </button>
        </div></div>

<div id="order-table-container"   class="">

</div>
@endsection

@push('scripts')
    <script>
      $(document).ready(function(){
        $.get('/api/order/all-orders', function(data) {
                 console.log(data);
                 renderOrderTable(data);
                  $('#order-name').text(data.name);
         }).fail(function() {
                 alert('Could not fetch data.');
        });
      });  



      function renderOrderTable(response) {
        const orders = response.data;
       let tableHtml = `
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left text-gray-500">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th class="px-6 py-3">LPO Number</th>
                        <th class="px-6 py-3">Order Type</th>
                        <th class="px-6 py-3">Location</th>
                        <th class="px-6 py-3">User</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody id="order-rows" class="bg-white divide-y divide-gray-200">
                </tbody>
            </table>
        </div>
    `;

    $('#order-table-container').html(tableHtml);

    orders.forEach(order => {
        // Handle logic for badge colors
        const typeBadgeClass = order.order_type === 'Branch Order' 
            ? 'bg-blue-100 text-blue-800' 
            : 'bg-purple-100 text-purple-800';

        let row = `
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 font-semibold text-indigo-600">
                    ${order.lpo_number}
                </td>
                <td class="px-6 py-4">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium ${typeBadgeClass}">
                        ${order.order_type}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="text-gray-900">${order.store_name}</div>
                    <div class="text-xs text-gray-400">${order.branch_name ?? 'Main Warehouse'}</div>
                </td>
                <td class="px-6 py-4">${order.user_name}</td>
                <td class="px-6 py-4">${order.created_at}</td>
                <td class="px-6 py-4 text-right space-x-3">
                    <button onclick="handleAction(${order.id}, 'view')" class="text-indigo-600 hover:underline">View</button>
                    <button onclick="handleAction(${order.id}, 'edit')" class="text-gray-400 hover:text-gray-700">Edit</button>
                </td>
            </tr>
        `;
        $('#order-rows').append(row);
    });
}
    </script>
@endpush