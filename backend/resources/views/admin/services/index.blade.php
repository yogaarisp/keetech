@extends('admin.layouts.app')

@section('title', 'Digital Services')

@section('content')
<div class="glass-card overflow-hidden">
    <div class="px-8 py-8 border-b border-outline-variant/10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 md:gap-0 bg-surface-container-lowest/50">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-primary-container/10 text-primary flex items-center justify-center">
                <span class="material-symbols-outlined">settings_suggest</span>
            </div>
            <div>
                <h3 class="font-bold text-lg text-on-surface tracking-tight">Service Catalog</h3>
                <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">Digital Infrastructure Management</p>
            </div>
        </div>
        <a href="{{ route('admin.services.create') }}" class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-3 rounded-2xl font-bold hover:brightness-110 transition-all shadow-xl shadow-primary/20">
            <span class="material-symbols-outlined text-sm">add_circle</span>
            CREATE NEW
        </a>
    </div>

    <div class="overflow-x-auto p-4 lg:p-8">
        <table class="w-full text-left border-separate border-spacing-y-4">
            <thead>
                <tr class="text-[10px] font-black text-on-surface-variant/50 uppercase tracking-[0.2em]">
                    <th class="px-6 pb-2">Icon</th>
                    <th class="px-6 pb-2">Service Identity</th>
                    <th class="px-6 pb-2 text-center">Order</th>
                    <th class="px-6 pb-2">Status</th>
                    <th class="px-6 pb-2 text-right">Operational</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr class="group bg-surface-container-lowest border border-outline-variant/10 shadow-sm hover:shadow-md transition-all">
                        <td class="px-6 py-5 rounded-l-2xl border-y border-l border-outline-variant/10">
                            <div class="w-12 h-12 bg-surface-container text-primary rounded-2xl flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined">{{ $service->icon }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5 border-y border-outline-variant/10">
                            <p class="font-bold text-on-surface text-sm tracking-tight">{{ $service->title }}</p>
                            <p class="text-[10px] text-on-surface-variant/70 font-bold uppercase tracking-widest mt-1 line-clamp-1">{{ $service->description ?? 'Secure systematic integration data.' }}</p>
                        </td>
                        <td class="px-6 py-5 text-center border-y border-outline-variant/10">
                            <span class="px-3 py-1 bg-surface-container-high text-on-surface-variant rounded-lg text-xs font-black">{{ $service->sort_order }}</span>
                        </td>
                        <td class="px-6 py-5 border-y border-outline-variant/10">
                            @if($service->is_active)
                                <span class="px-3 py-1 bg-green-500/10 text-green-600 rounded-lg text-[10px] font-black uppercase tracking-widest flex items-center gap-1 w-max">
                                    <div class="w-1 h-1 bg-green-500 rounded-full animate-pulse"></div> Active
                                </span>
                            @else
                                <span class="px-3 py-1 bg-surface-container text-on-surface-variant/40 rounded-lg text-[10px] font-black uppercase tracking-widest w-max flex items-center gap-1">
                                    <div class="w-1 h-1 bg-on-surface-variant/40 rounded-full"></div> Draft
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-right rounded-r-2xl border-y border-r border-outline-variant/10">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.services.edit', $service) }}" class="w-10 h-10 flex items-center justify-center bg-surface-container-low text-on-surface-variant rounded-xl hover:bg-secondary-container hover:text-on-secondary-container transition-all shadow-sm">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                </a>
                                <form id="delete-form-{{ $service->id }}" action="{{ route('admin.services.destroy', $service) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" 
                                    data-destroy
                                    data-form-id="delete-form-{{ $service->id }}"
                                    data-confirm="Terminate this service protocol?"
                                    class="w-10 h-10 flex items-center justify-center bg-surface-container-low text-on-surface-variant rounded-xl hover:bg-error hover:text-on-error transition-all shadow-sm cursor-pointer">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


