@extends('admin.layouts.app')

@section('title', 'Configure Credibility')

@section('content')
<div class="glass-card overflow-hidden">
    <div class="px-10 py-8 border-b border-slate-200 dark:border-white/5 bg-white dark:bg-white/[0.02] flex items-center gap-4">
        <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-500">
            <span class="material-symbols-outlined">verified_user</span>
        </div>
        <div>
            <h3 class="font-outfit font-bold text-lg text-slate-900 dark:text-white tracking-widest uppercase">Record Configuration</h3>
            <p class="text-[10px] text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wider mt-1">Entity Engine: Testimoni Pelanggan</p>
        </div>
    </div>
    
    @include('admin.testimonials.form')
</div>
@endsection
