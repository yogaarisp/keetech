@extends('admin.layouts.app')

@section('title', 'Intelligence Inbox')

@section('content')
<div class="glass-card overflow-hidden">
    <div class="px-8 py-8 border-b border-outline-variant/10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 md:gap-0 bg-white/50 dark:bg-slate-900/50">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-primary-container/10 text-primary flex items-center justify-center">
                <span class="material-symbols-outlined">mail</span>
            </div>
            <div>
                <h3 class="font-bold text-lg text-on-surface tracking-tight">Signal Ledger</h3>
                <p class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest">Global Communication Proxy</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest bg-surface-container-high px-4 py-2 rounded-xl border border-outline-variant/10">
                ACTIVE LOAD: {{ $contacts->total() }} Signals
            </span>
        </div>
    </div>

    <div class="overflow-x-auto p-4 lg:p-8">
        <table class="w-full text-left border-separate border-spacing-y-4">
            <thead>
                <tr class="text-[10px] font-black text-on-surface-variant/50 uppercase tracking-[0.2em]">
                    <th class="px-6 pb-2">Source / Sender</th>
                    <th class="px-6 pb-2">Inquiry Focus</th>
                    <th class="px-6 pb-2">Timestamp</th>
                    <th class="px-6 pb-2">Status</th>
                    <th class="px-6 pb-2 text-right">Operational</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr class="group transition-all duration-500 rounded-2xl border border-outline-variant/10 {{ !$contact->is_read ? 'bg-primary-container/5 shadow-xl shadow-primary/5 ring-1 ring-primary-container/20' : 'bg-surface-container-lowest shadow-sm hover:shadow-md border border-outline-variant/10' }}">
                        <td class="px-6 py-5 rounded-l-2xl border-y border-l border-outline-variant/10">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center font-black text-lg transition-transform group-hover:scale-110 {{ !$contact->is_read ? 'bg-primary text-on-primary shadow-xl shadow-primary/30' : 'bg-surface-container text-on-surface-variant/40 border border-outline-variant/10' }}">
                                    {{ substr($contact->name, 0, 1) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-on-surface text-sm tracking-tight flex items-center gap-2">
                                        {{ $contact->name }}
                                        @if(!$contact->is_read)
                                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 bg-primary-container text-on-primary-container rounded-full text-[8px] font-black uppercase tracking-widest">
                                                New
                                            </span>
                                        @endif
                                    </p>
                                    <p class="text-[10px] text-on-surface-variant/70 font-bold uppercase tracking-widest mt-0.5 truncate">{{ $contact->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5 border-y border-outline-variant/10">
                            <span class="px-3 py-1 bg-secondary-container/10 text-on-secondary-container border border-secondary-container/20 rounded-lg text-[10px] font-black uppercase tracking-widest whitespace-nowrap">{{ $contact->service_type }}</span>
                        </td>
                        <td class="px-6 py-5 border-y border-outline-variant/10 whitespace-nowrap">
                            <div class="flex flex-col">
                                <span class="text-xs font-black text-on-surface uppercase tracking-tight">{{ $contact->created_at->format('d M Y') }}</span>
                                <span class="text-[10px] font-bold text-on-surface-variant/50 uppercase tracking-tight">{{ $contact->created_at->format('H:i') }} WIB</span>
                            </div>
                        </td>
                        <td class="px-6 py-5 border-y border-outline-variant/10 whitespace-nowrap">
                            @if(!$contact->is_read)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-primary/10 text-primary border border-primary/20 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm">
                                    <div class="w-1 h-1 bg-primary rounded-full animate-pulse"></div> Intercepted
                                </span>
                            @else
                                <span class="px-3 py-1 bg-surface-container text-on-surface-variant/40 rounded-lg text-[10px] font-black uppercase tracking-widest flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[12px]">archive</span> Archived
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-right rounded-r-2xl border-y border-r border-outline-variant/10">
                            <div class="flex items-center justify-end gap-2 text-right">
                                <a href="{{ route('admin.contacts.show', $contact) }}" class="w-10 h-10 flex items-center justify-center bg-surface-container-low text-on-surface-variant rounded-xl hover:bg-primary-container hover:text-on-primary-container transition-all shadow-sm">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                <form id="delete-form-{{ $contact->id }}" action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" 
                                    data-destroy
                                    data-form-id="delete-form-{{ $contact->id }}"
                                    data-confirm="Terminate this internal communication signal?"
                                    class="w-10 h-10 flex items-center justify-center bg-surface-container-low text-on-surface-variant rounded-xl hover:bg-error hover:text-on-error transition-all shadow-sm cursor-pointer border border-transparent">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-32 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-24 h-24 bg-surface-container rounded-3xl flex items-center justify-center mb-6 border border-outline-variant/10 shadow-inner">
                                    <span class="material-symbols-outlined text-5xl text-on-surface-variant/20">mail_outline</span>
                                </div>
                                <h4 class="font-black text-xl text-on-surface uppercase tracking-widest">Isolation Active</h4>
                                <p class="text-xs font-bold text-on-surface-variant/50 mt-2 uppercase tracking-[0.2em]">Intercepted Signal Bank is Currently Clear</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($contacts->hasPages())
        <div class="px-8 py-8 border-t border-outline-variant/10 bg-surface/50">
            {{ $contacts->links() }}
        </div>
    @endif
</div>
@endsection


