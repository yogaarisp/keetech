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
    
    <form action="{{ isset($portfolioCategory) ? route('admin.portfolio-categories.update', $portfolioCategory) : route('admin.portfolio-categories.store') }}" method="POST" enctype="multipart/form-data" class="p-10 space-y-10">
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

        <div>
            <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-3 uppercase tracking-wider">Category Description</label>
            <textarea name="description" rows="4"
                class="w-full px-6 py-5 bg-white border-slate-200 shadow-sm dark:bg-white/[0.03] dark:border-slate-200 dark:border-white/5 dark:shadow-none border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-medium text-slate-900 dark:text-white text-sm tracking-tight placeholder:text-slate-700"
                placeholder="Deskripsi singkat mengenai kategori bisnis/teknologi ini...">{{ old('description', $portfolioCategory->description ?? '') }}</textarea>
            @error('description')
                <p class="text-rose-500 text-[10px] mt-2 font-bold uppercase tracking-widest">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-3 uppercase tracking-wider">Upload Local Image (Drag & Drop)</label>
                <div class="relative group">
                    <input type="file" name="image" accept="image/*"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div class="w-full px-6 py-8 border-2 border-dashed border-slate-300 dark:border-white/10 rounded-2xl bg-white dark:bg-white/[0.02] flex flex-col items-center justify-center text-center group-hover:border-maroon-500/50 group-hover:bg-maroon-500/5 transition-all">
                        <span class="material-symbols-outlined text-3xl text-slate-500 dark:text-slate-400 group-hover:text-maroon-400 mb-2">cloud_upload</span>
                        <p class="text-xs font-bold text-slate-900 dark:text-white mb-1">Click or drag image to upload</p>
                        <p class="text-[10px] uppercase tracking-wider text-slate-500 dark:text-slate-400">SVG, PNG, JPG or WEBP</p>
                    </div>
                </div>
                @error('image')
                    <p class="text-rose-500 text-[10px] mt-2 font-bold uppercase tracking-widest">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-3 uppercase tracking-wider">OR External Image URL</label>
                <input type="text" name="image_url" value="{{ old('image_url') }}"
                    class="w-full px-6 py-5 bg-white border-slate-200 shadow-sm dark:bg-white/[0.03] dark:border-slate-200 dark:border-white/5 dark:shadow-none border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-medium text-slate-900 dark:text-white text-sm tracking-tight placeholder:text-slate-700 mb-4"
                    placeholder="https://example.com/image.png">
                
                @if(isset($portfolioCategory) && $portfolioCategory->image)
                <div class="mt-4 p-4 rounded-xl bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/5 flex items-center gap-4">
                    <div class="w-16 h-16 rounded-lg overflow-hidden bg-black/50 shrink-0">
                        <img src="{{ Str::startsWith($portfolioCategory->image, 'http') ? $portfolioCategory->image : asset('storage/' . $portfolioCategory->image) }}" class="w-full h-full object-cover" alt="Current Image">
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-[10px] uppercase tracking-widest text-emerald-400 font-bold mb-1">Current Active Image</p>
                        <p class="text-xs text-slate-600 dark:text-slate-400 truncate">{{ $portfolioCategory->image }}</p>
                    </div>
                </div>
                @endif
            </div>
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


