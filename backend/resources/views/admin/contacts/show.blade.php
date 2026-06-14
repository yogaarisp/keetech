@extends('admin.layouts.app')

@section('title', 'Signal Intelligence')

@section('content')
<div class="space-y-10">
    <div class="glass-card overflow-hidden flex flex-col">
        <div class="px-10 py-8 border-b border-outline-variant/10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 md:gap-0 bg-white/50 dark:bg-slate-900/50">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-primary-container/10 border border-primary-container/20 flex items-center justify-center text-primary shadow-lg shadow-primary/5">
                    <span class="material-symbols-outlined">{{ !$contact->is_read ? 'notifications_active' : 'mark_chat_read' }}</span>
                </div>
                <div>
                    <h3 class="font-bold text-lg text-on-surface tracking-tight">Signal Decryption</h3>
                    <p class="text-[10px] text-on-surface-variant/60 font-bold uppercase tracking-[0.2em] mt-1">Intercepted Payload Header</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest bg-surface-container-high px-4 py-2 border border-outline-variant/10 rounded-xl">ID: #{{ $contact->id }}</span>
                @if(!$contact->is_read)
                    <span class="px-4 py-2 bg-primary text-on-primary rounded-xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-primary/30 animate-pulse">Unread Signal</span>
                @endif
            </div>
        </div>
        
        <div class="p-10 lg:p-14">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-14">
                <!-- Source Entity Info -->
                <div class="lg:col-span-4 space-y-8">
                    <div class="bg-surface-container-lowest border border-outline-variant/10 p-10 rounded-[40px] flex flex-col items-center text-center shadow-xl relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-b from-primary/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                        
                        <div class="w-24 h-24 rounded-full bg-surface-container border border-outline-variant/10 flex items-center justify-center text-primary text-4xl font-black shadow-inner mb-8 relative z-10 transition-transform group-hover:scale-110">
                            {{ substr($contact->name, 0, 1) }}
                        </div>
                        
                        <div class="relative z-10 w-full">
                            <h4 class="text-xl font-bold text-on-surface tracking-tight leading-none mb-2">{{ $contact->name }}</h4>
                            <p class="text-[10px] font-black text-secondary uppercase tracking-[0.2em] mb-10">{{ $contact->email }}</p>
                            
                            <div class="pt-10 border-t border-outline-variant/10 w-full space-y-6">
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest">Inquiry Focus</span>
                                    <span class="text-xs font-black text-on-surface-variant bg-surface-container px-3 py-1 rounded-lg">{{ $contact->service_type }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest">Intercept Date</span>
                                    <span class="text-xs font-black text-on-surface">{{ $contact->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-black text-on-surface-variant/40 uppercase tracking-widest">Timestamp</span>
                                    <span class="text-xs font-black text-on-surface">{{ $contact->created_at->format('H:i') }} WIB</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Signal Payloads -->
                <div class="lg:col-span-8 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-3 mb-8">
                            <span class="material-symbols-outlined text-primary text-[20px]">terminal</span>
                            <p class="text-[11px] font-black text-on-surface-variant/60 uppercase tracking-[0.2em]">Signal Transcript Data</p>
                        </div>
                        
                        <div class="bg-surface-container-high p-10 lg:p-12 border border-outline-variant/20 rounded-[40px] relative overflow-hidden group/message shadow-inner">
                            <span class="material-symbols-outlined absolute -top-10 -right-10 text-[200px] text-on-surface-variant/5 group-hover/message:text-primary/10 transition-colors duration-1000">quick_phrases</span>
                            
                            <div class="relative z-10">
                                <p class="text-on-surface-variant leading-[2.2] text-lg font-medium italic whitespace-pre-wrap">"{{ $contact->message }}"</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 flex flex-wrap gap-4">
                        <a href="mailto:{{ $contact->email }}" class="flex-1 bg-primary text-on-primary font-black py-5 rounded-[30px] text-center hover:brightness-110 shadow-xl shadow-primary/20 flex items-center justify-center gap-4 group uppercase text-[10px] tracking-[0.2em] transition-all">
                            <span class="material-symbols-outlined group-hover:-translate-y-1 group-hover:translate-x-1 transition-transform">send</span>
                            Communicate Reply
                        </a>
                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Execute permanent deletion of shard #{{ $contact->id }}?')" class="w-max">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-20 h-full bg-surface-container-low text-error border border-outline-variant/10 rounded-[30px] hover:bg-error hover:text-on-error transition-all flex items-center justify-center group shadow-sm">
                                <span class="material-symbols-outlined group-hover:rotate-12 transition-transform">delete_forever</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-center py-6">
        <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center gap-3 text-on-surface-variant/40 hover:text-primary font-black transition-all group uppercase text-[10px] tracking-[0.2em]">
            <span class="material-symbols-outlined text-sm group-hover:-translate-x-2 transition-transform">keyboard_double_arrow_left</span>
            Operational Intelligence HQ
        </a>
    </div>
</div>
@endsection


