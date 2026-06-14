@extends('admin.layouts.app')

@section('title', 'Client Credibility')

@section('content')
<div class="glass-card overflow-hidden">
    <div class="px-8 py-8 border-b border-outline-variant/10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 md:gap-0 bg-surface-container-lowest/50">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-primary-container/10 text-primary flex items-center justify-center">
                <span class="material-symbols-outlined">reviews</span>
            </div>
            <div>
                <h3 class="font-bold text-lg text-on-surface tracking-tight">Testimonial Ledger</h3>
                <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">Public Credibility Records</p>
            </div>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-3 rounded-2xl font-bold hover:brightness-110 transition-all shadow-xl shadow-primary/20">
            <span class="material-symbols-outlined text-sm">add_circle</span>
            CREATE NEW
        </a>
    </div>

    <div class="overflow-x-auto p-4 lg:p-8">
        <table class="w-full text-left border-separate border-spacing-y-4">
            <thead>
                <tr class="text-[10px] font-black text-on-surface-variant/50 uppercase tracking-[0.2em]">
                    <th class="px-6 pb-2 text-center">Identity</th>
                    <th class="px-6 pb-2">Client Entity</th>
                    <th class="px-6 pb-2">System Review</th>
                    <th class="px-6 pb-2 text-center">Status</th>
                    <th class="px-6 pb-2 text-right">Operational</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testimonials as $testimonial)
                    <tr class="group bg-surface-container-lowest border border-outline-variant/10 shadow-sm hover:shadow-md transition-all">
                        <td class="px-6 py-5 rounded-l-2xl border-y border-l border-outline-variant/10">
                            <div class="flex items-center justify-center">
                                @if($testimonial->client_photo)
                                    <img src="{{ str_starts_with($testimonial->client_photo, 'http') ? $testimonial->client_photo : asset('storage/' . $testimonial->client_photo) }}" alt="{{ $testimonial->client_name }}" class="w-12 h-12 object-cover rounded-full border border-outline-variant/20 shadow-md">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-surface-container border border-outline-variant/10 flex items-center justify-center text-primary font-bold text-lg shadow-inner">
                                        {{ substr($testimonial->client_name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-5 border-y border-outline-variant/10">
                            <p class="font-bold text-on-surface text-sm tracking-tight">{{ $testimonial->client_name }}</p>
                            <div class="flex items-center gap-1.5 mt-1">
                                <span class="material-symbols-outlined text-[10px] text-secondary">star_half</span>
                                <p class="text-[10px] text-on-surface-variant/70 font-bold uppercase tracking-widest">{{ $testimonial->client_role ?? 'Validated Client' }} ({{ $testimonial->rating }} Stars)</p>
                            </div>
                        </td>
                        <td class="px-6 py-5 border-y border-outline-variant/10">
                            <p class="text-xs text-on-surface-variant font-medium italic leading-relaxed line-clamp-2">"{{ $testimonial->content }}"</p>
                        </td>
                        <td class="px-6 py-5 border-y border-outline-variant/10 text-center whitespace-nowrap">
                            @if($testimonial->is_active)
                                <span class="px-3 py-1 bg-green-500/10 text-green-600 rounded-lg text-[10px] font-black uppercase tracking-widest flex items-center gap-1 mx-auto w-max">
                                    <div class="w-1 h-1 bg-green-500 rounded-full"></div> Public
                                </span>
                            @else
                                <span class="px-3 py-1 bg-surface-container text-on-surface-variant/40 rounded-lg text-[10px] font-black uppercase tracking-widest w-max flex items-center gap-1 mx-auto">
                                    <div class="w-1 h-1 bg-on-surface-variant/40 rounded-full"></div> Internal
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-right rounded-r-2xl border-y border-r border-outline-variant/10">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="w-10 h-10 flex items-center justify-center bg-surface-container-low text-on-surface-variant rounded-xl hover:bg-secondary-container hover:text-on-secondary-container transition-all shadow-sm">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                </a>
                                <form id="delete-form-{{ $testimonial->id }}" action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" 
                                    data-destroy
                                    data-form-id="delete-form-{{ $testimonial->id }}"
                                    data-confirm="Archive this client review record?"
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


