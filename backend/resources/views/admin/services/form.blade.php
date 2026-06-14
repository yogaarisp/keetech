@extends('admin.layouts.app')

@section('title', isset($service) ? 'Modify System' : 'Deploy Service')

@section('content')
<div class="glass-card overflow-hidden">
    <div class="px-10 py-8 border-b border-slate-200 dark:border-white/5 bg-white dark:bg-white/[0.02] flex items-center gap-4">
        <div class="w-12 h-12 rounded-2xl bg-gold-500/10 border border-gold-500/20 flex items-center justify-center text-gold-500">
            <span class="material-symbols-outlined">{{ isset($service) ? 'edit_square' : 'add_task' }}</span>
        </div>
        <div>
            <h3 class="font-outfit font-bold text-lg text-slate-900 dark:text-white tracking-widest uppercase">{{ isset($service) ? 'Service Configuration' : 'Service Initiation' }}</h3>
            <p class="text-[10px] text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider mt-1">Entity Engine: Layanan Utama IT</p>
        </div>
    </div>
    
    <form action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" method="POST" class="p-10 space-y-10">
        @csrf
        @if(isset($service)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="space-y-3">
                <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Operational Title</label>
                <input type="text" name="title" value="{{ old('title', $service->title ?? '') }}" required
                    class="w-full px-6 py-4 bg-white border-slate-200 shadow-sm dark:bg-white/[0.03] dark:border-slate-200 dark:border-white/5 dark:shadow-none border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-bold text-slate-900 dark:text-white placeholder:text-slate-700"
                    placeholder="e.g. Cyber Security Protocol">
                @error('title') <p class="text-rose-500 text-[10px] mt-2 font-bold uppercase tracking-widest">{{ $message }}</p> @enderror
            </div>
            <div class="space-y-3">
                <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Material Identity (Icon)</label>
                <div class="relative">
                    <input type="text" name="icon" value="{{ old('icon', $service->icon ?? 'dns') }}" required
                        class="w-full px-6 py-4 bg-white border-slate-200 shadow-sm dark:bg-white/[0.03] dark:border-slate-200 dark:border-white/5 dark:shadow-none border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-bold text-slate-900 dark:text-white uppercase tracking-widest">
                    <a href="https://fonts.google.com/icons" target="_blank" class="absolute right-6 top-1/2 -translate-y-1/2 text-gold-500 text-[10px] font-bold uppercase tracking-widest hover:text-slate-900 dark:text-white transition-colors">Find Icon</a>
                </div>
            </div>
        </div>

        <div class="space-y-3">
            <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Core Brief / Description</label>
            <textarea name="description" rows="4" required
                class="w-full px-6 py-4 bg-white border-slate-200 shadow-sm dark:bg-white/[0.03] dark:border-slate-200 dark:border-white/5 dark:shadow-none border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-medium text-slate-600 dark:text-slate-400 placeholder:text-slate-700 resize-none">{{ old('description', $service->description ?? '') }}</textarea>
        </div>

        <div class="space-y-6">
            <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Service High-Performance Features</label>
            <div id="features-container" class="space-y-4">
                @php
                    $features = old('features', $service->features ?? ['']);
                    if (!is_array($features) || empty($features)) $features = [''];
                @endphp
                @foreach($features as $index => $feature)
                    <div class="flex gap-3 animate-in fade-in duration-500">
                        <input type="text" name="features[]" value="{{ $feature }}" 
                            class="flex-1 px-6 py-4 bg-white border-slate-200 shadow-sm dark:bg-white/[0.03] dark:border-slate-200 dark:border-white/5 dark:shadow-none border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-bold text-slate-900 dark:text-white placeholder:text-slate-700"
                            placeholder="Data Protection & Encryption">
                    </div>
                @endforeach
            </div>
            <button type="button" onclick="addFeatureField()" class="text-[10px] font-bold text-gold-500 hover:text-slate-900 dark:text-white flex items-center gap-2 transition-all uppercase tracking-widest">
                <span class="material-symbols-outlined text-sm">add_circle</span> Add Feature Line
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 pt-10 border-t border-slate-200 dark:border-white/5">
            <div class="space-y-3">
                <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Priority Rank</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}" required
                    class="w-full px-6 py-4 bg-white border-slate-200 shadow-sm dark:bg-white/[0.03] dark:border-slate-200 dark:border-white/5 dark:shadow-none border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-bold text-slate-900 dark:text-white text-center text-lg">
            </div>
            <div class="flex items-center pt-8">
                <label class="flex items-center gap-4 cursor-pointer group px-8 py-4 bg-white dark:bg-white/[0.02] border border-slate-200 dark:border-white/5 rounded-2xl hover:bg-slate-100 dark:bg-white/5 transition-all w-full">
                    <div class="relative w-6 h-6">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}
                            class="peer absolute opacity-0 w-full h-full cursor-pointer z-10">
                        <div class="w-6 h-6 bg-slate-100 dark:bg-white/5 border border-slate-300 dark:border-white/10 rounded-lg group-hover:border-maroon-500 transition-all peer-checked:bg-maroon-700 peer-checked:border-maroon-700 flex items-center justify-center text-slate-900 dark:text-white">
                            <span class="material-symbols-outlined text-sm scale-0 peer-checked:scale-100 transition-transform">check</span>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest group-hover:text-slate-900 dark:text-white transition-colors">Broadcast to Public</span>
                </label>
            </div>
        </div>

        <div class="flex flex-wrap gap-4 pt-10 pb-4">
            <button type="submit" class="bg-slate-900 text-white dark:bg-white dark:text-black font-bold px-12 py-5 rounded-[24px] hover:bg-gold-500 transition-all shadow-2xl shadow-black/50 uppercase tracking-widest text-xs">
                Commit Changes
            </button>
            <a href="{{ route('admin.services.index') }}" class="bg-slate-100 dark:bg-white/5 text-slate-500 dark:text-slate-400 font-bold px-12 py-5 rounded-[24px] hover:bg-slate-200 dark:bg-white/10 hover:text-slate-900 dark:text-white transition-all uppercase tracking-widest text-xs border border-slate-200 dark:border-white/5">
                Abort
            </a>
        </div>
    </form>
</div>

<script>
    function addFeatureField() {
        const container = document.getElementById('features-container');
        const div = document.createElement('div');
        div.className = 'flex gap-3 animate-in slide-in-from-top-2 fade-in duration-300';
        div.innerHTML = `
            <input type="text" name="features[]" class="flex-1 px-6 py-4 bg-white border-slate-200 shadow-sm dark:bg-white/[0.03] dark:border-slate-200 dark:border-white/5 dark:shadow-none border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-bold text-slate-900 dark:text-white text-sm" placeholder="...">
            <button type="button" onclick="this.parentElement.remove()" class="w-14 h-14 bg-slate-100 dark:bg-white/5 text-rose-500 rounded-2xl flex items-center justify-center hover:bg-rose-600 hover:text-slate-900 dark:text-white transition-all">
                <span class="material-symbols-outlined">delete</span>
            </button>
        `;
        container.appendChild(div);
    }
</script>
@endsection


