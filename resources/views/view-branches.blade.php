@extends('layouts.app')

@section('content')
<div class="">
<div class="p-6 bg-slate-50 min-h-screen">
    <div class="max-w-6xl mx-auto">
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Branch Management</h1>
                <p class="text-sm text-slate-500">Manage your physical locations and contact details.</p>
            </div>
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition shadow-sm flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Branch
            </button>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Branch Name</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Address</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Phone</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">email</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Manager</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($branches as $branch)
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="px-6 py-4 text-sm text-slate-400">
                                {{ $branches->firstItem() + $loop->index }}
                            </td>
                           
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-slate-600 font-medium">{{ $branch->name ?? 'Unassigned' }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                <div>{{ $branch->address }}</div>
                            
                            </td>
                             <td class="px-6 py-4 text-sm text-slate-600">
                                <div>{{ $branch->phone }}</div>
                            
                            </td>

                             <td class="px-6 py-4 text-sm text-slate-600">
                                <div>{{ $branch->email }}</div>
                            
                            </td>
                             <td class="px-6 py-4 text-sm text-slate-600">
                                <div></div>
                            
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $branch->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $branch->is_active ? 'Online' : 'Closed' }}
                                </span>
                            </td>
                             <td class="px-6 py-4 text-right text-sm font-medium">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <button class="text-red-500 hover:text-red-700">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="h-12 w-12 text-slate-200 mb-3">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-width="1"/></svg>
                                    </div>
                                    <span class="text-slate-400 font-medium">No branches registered yet.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                {{ $branches->links() }}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scripts')
    <script></script>
@endpush