@extends('admin.layouts.app')

@section('title', 'Category Architecture')

@section('content')
<div class="glass-card overflow-hidden">
    <div class="px-8 py-8 border-b border-outline-variant/10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 md:gap-0 bg-white/50 dark:bg-slate-900/50">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-primary-container/10 text-primary flex items-center justify-center">
                <span class="material-symbols-outlined">grid_view</span>
            </div>
            <div>
                <h3 class="font-bold text-lg text-on-surface tracking-tight">Classification Engine</h3>
                <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">Sovereign Data Taxonomy</p>
            </div>
        </div>
        <a href="{{ route('admin.portfolio-categories.create') }}" class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-3 rounded-2xl font-bold hover:brightness-110 transition-all shadow-xl shadow-primary/20">
            <span class="material-symbols-outlined text-sm">add_circle</span>
            CREATE NEW
        </a>
    </div>

    <div class="overflow-x-auto p-4 lg:p-8">
        <table class="w-full text-left border-separate border-spacing-y-4">
            <thead>
                <tr class="text-[10px] font-black text-on-surface-variant/50 uppercase tracking-[0.2em]">
                    <th class="px-6 pb-2 whitespace-nowrap">Media</th>
                    <th class="px-6 pb-2 whitespace-nowrap">Category Identity</th>
                    <th class="px-6 pb-2 whitespace-nowrap text-center">System Slug</th>
                    <th class="px-6 pb-2 text-center whitespace-nowrap">Asset Count</th>
                    <th class="px-6 pb-2 text-right">Operational</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr class="group bg-surface-container-lowest border border-outline-variant/10 shadow-sm hover:shadow-md transition-all">
                        <td class="px-6 py-5 rounded-l-2xl border-y border-l border-outline-variant/10">
                            @if($category->image)
                                <div class="relative w-16 h-12 overflow-hidden rounded-xl border border-outline-variant/20 shadow-inner">
                                    <img src="{{ $category->image }}" alt="{{ $category->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                            @else
                                <div class="w-16 h-12 bg-surface-container rounded-xl flex items-center justify-center border border-outline-variant/10 text-on-surface-variant/50">
                                    <span class="material-symbols-outlined text-sm">image_not_supported</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-5 border-y border-outline-variant/10">
                            <p class="font-bold text-on-surface text-sm tracking-tight">{{ $category->name }}</p>
                            <p class="text-[10px] text-on-surface-variant/70 font-bold uppercase tracking-widest mt-1 line-clamp-1">{{ $category->description ?? 'Confidential integration classification.' }}</p>
                        </td>
                        <td class="px-6 py-5 border-y border-outline-variant/10 text-center">
                            <span class="px-3 py-1 bg-surface-container-high text-on-surface-variant rounded-lg text-[10px] font-black tracking-widest uppercase">{{ $category->slug }}</span>
                        </td>
                        <td class="px-6 py-5 border-y border-outline-variant/10">
                            <div class="flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-primary text-sm">inventory_2</span>
                                <span class="font-black text-on-surface text-xs">{{ $category->portfolios->count() }} Projects</span>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-right rounded-r-2xl border-y border-r border-outline-variant/10">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.portfolio-categories.edit', $category) }}" class="w-10 h-10 flex items-center justify-center bg-surface-container-low text-on-surface-variant rounded-xl hover:bg-secondary-container hover:text-on-secondary-container transition-all shadow-sm">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                </a>
                                <form id="delete-form-{{ $category->id }}" action="{{ route('admin.portfolio-categories.destroy', $category) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" 
                                    data-destroy
                                    data-form-id="delete-form-{{ $category->id }}"
                                    data-confirm="Terminate this category protocol?"
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


