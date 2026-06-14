@extends('admin.layouts.app')

@section('title', isset($portfolioCategory) ? 'Modify System Category' : 'Provision New Category')

@section('content')
<div class="glass-card overflow-hidden">
    <div class="px-10 py-8 border-b border-slate-200 dark:border-white/5 bg-white dark:bg-white/[0.02] flex items-center gap-4">
        <div class="w-12 h-12 rounded-2xl bg-gold-500/10 border border-gold-500/20 flex items-center justify-center text-gold-500">
            <span class="material-symbols-outlined">{{ isset($portfolioCategory) ? 'settings_input_component' : 'schema' }}</span>
        </div>
        <div>
            <h3 class="font-outfit font-bold text-lg text-slate-900 dark:text-white tracking-widest uppercase">{{ isset($portfolioCategory) ? 'Category Configuration' : 'Category Creation' }}</h3>
            <p class="text-[10px] text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider mt-1">Entity Engine: Klasifikasi Portofolio</p>
        </div>
    </div>
    
    <form action="{{ isset($portfolioCategory) ? route('admin.portfolio-categories.update', $portfolioCategory) : route('admin.portfolio-categories.store') }}" method="POST" class="p-10 space-y-10">
        @csrf
        @if(isset($portfolioCategory)) @method('PUT') @endif

        <div class="bg-maroon-700/5 border border-maroon-700/10 p-6 rounded-2xl flex items-start gap-4">
            <span class="material-symbols-outlined text-maroon-500 mt-0.5">info</span>
            <div>
                <p class="text-[11px] font-bold text-maroon-400 uppercase tracking-widest">Slug Protocol</p>
                <p class="text-xs font-medium text-slate-600 dark:text-slate-400 mt-1">Sistem akan secara otomatis me-generate SLUG URL berdasarkan nama kategori yang Anda inputkan untuk keperluan SEO Routing.</p>
            </div>
        </div>

        <div>
            <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-3 uppercase tracking-wider">Operational Category Name</label>
            <input type="text" name="name" value="{{ old('name', $portfolioCategory->name ?? '') }}" required
                class="w-full px-6 py-5 bg-white border-slate-200 shadow-sm dark:bg-white/[0.03] dark:border-slate-200 dark:border-white/5 dark:shadow-none border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-bold text-slate-900 dark:text-white text-base tracking-tight placeholder:text-slate-700"
                placeholder="e.g. Enterprise Solutions">
            @error('name')
                <p class="text-rose-500 text-[10px] mt-2 font-bold uppercase tracking-widest">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-wrap gap-4 pt-10 pb-4 border-t border-slate-200 dark:border-white/5">
            <button type="submit" class="bg-slate-900 text-white dark:bg-white dark:text-black font-bold px-12 py-5 rounded-[24px] hover:bg-gold-500 transition-all shadow-2xl shadow-black/50 uppercase tracking-widest text-xs">
                Sync Category
            </button>
            <a href="{{ route('admin.portfolio-categories.index') }}" class="bg-slate-100 dark:bg-white/5 text-slate-500 dark:text-slate-400 font-bold px-12 py-5 rounded-[24px] hover:bg-slate-200 dark:bg-white/10 hover:text-slate-900 dark:text-white transition-all uppercase tracking-widest text-xs border border-slate-200 dark:border-white/5">
                Abort
            </a>
        </div>
    </form>
</div>
@endsection


