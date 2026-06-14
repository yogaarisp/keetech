@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Welcome Section -->
<section class="mb-10 flex flex-col lg:flex-row lg:justify-between lg:items-end gap-6">
    <div>
        <p class="text-sm font-bold text-primary tracking-widest uppercase mb-1">System Overview</p>
        <h2 class="text-4xl font-extrabold tracking-tight text-on-surface">Welcome back, {{ explode(' ', auth()->user()->name)[0] }}</h2>
        <p class="text-on-surface-variant mt-2 text-lg">Your sovereign IT infrastructure is operating at peak performance.</p>
    </div>
    <div class="flex gap-4">
        <a href="{{ route('admin.services.create') }}" class="px-6 py-3 bg-surface-container-highest lg:bg-surface-variant rounded-xl font-bold text-sm text-primary flex items-center gap-2 hover:bg-surface-variant transition-colors">
            <span class="material-symbols-outlined text-lg">add_circle</span> New Service
        </a>
        <a href="{{ route('admin.portfolios.create') }}" class="px-6 py-3 bg-gradient-to-r from-primary-container to-primary text-on-primary rounded-xl font-bold text-sm shadow-xl flex items-center gap-2 hover:scale-[1.02] active:scale-95 transition-all">
            <span class="material-symbols-outlined text-lg">add</span> New Project
        </a>
    </div>
</section>

<!-- Bento Grid: Stats Cards -->
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Card 1: Services -->
    <div class="bg-surface-container-lowest p-6 rounded-3xl shadow-sm group hover:shadow-xl transition-all duration-500 relative overflow-hidden border border-outline-variant/20">
        <div class="relative z-10">
            <div class="w-12 h-12 bg-primary-container/10 rounded-2xl flex items-center justify-center mb-4 text-primary">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">dns</span>
            </div>
            <h3 class="text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">Active Services</h3>
            <div class="flex items-baseline gap-2">
                <span class="text-4xl font-extrabold text-on-surface">{{ $stats['services'] }}</span>
                <span class="text-xs font-bold text-green-600 bg-green-100 px-2 py-0.5 rounded-full">Live</span>
            </div>
        </div>
        <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition-opacity">
            <span class="material-symbols-outlined text-9xl">dns</span>
        </div>
    </div>

    <!-- Card 2: Messages -->
    <div class="bg-surface-container-lowest p-6 rounded-3xl shadow-sm group hover:shadow-xl transition-all duration-500 relative overflow-hidden border border-outline-variant/20">
        <div class="relative z-10">
            <div class="w-12 h-12 bg-secondary-container/20 rounded-2xl flex items-center justify-center mb-4 text-secondary">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">chat_bubble</span>
            </div>
            <h3 class="text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">New Messages</h3>
            <div class="flex items-baseline gap-2">
                <span class="text-4xl font-extrabold text-on-surface">{{ $stats['unread_contacts'] }}</span>
                @if($stats['unread_contacts'] > 0)
                <span class="text-xs font-bold text-secondary bg-secondary-fixed/30 px-2 py-0.5 rounded-full">Urgent</span>
                @else
                <span class="text-xs font-bold text-on-surface-variant bg-surface-variant px-2 py-0.5 rounded-full">Clear</span>
                @endif
            </div>
        </div>
        <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition-opacity">
            <span class="material-symbols-outlined text-9xl">chat_bubble</span>
        </div>
    </div>

    <!-- Card 3: Portfolio -->
    <div class="bg-surface-container-lowest p-6 rounded-3xl shadow-sm group hover:shadow-xl transition-all duration-500 relative overflow-hidden border border-outline-variant/20">
        <div class="relative z-10">
            <div class="w-12 h-12 bg-surface-variant/40 rounded-2xl flex items-center justify-center mb-4 text-on-surface-variant">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
            </div>
            <h3 class="text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">Portfolio Items</h3>
            <div class="flex items-baseline gap-2">
                <span class="text-4xl font-extrabold text-on-surface">{{ $stats['portfolios'] }}</span>
                <span class="text-[10px] font-bold text-on-surface-variant/50 tracking-tighter">PUBLISHED</span>
            </div>
        </div>
        <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition-opacity">
            <span class="material-symbols-outlined text-9xl">auto_awesome</span>
        </div>
    </div>

    <!-- Card 4: Testimonials -->
    <div class="bg-[#800020] p-6 rounded-3xl shadow-2xl shadow-primary-container/20 group hover:scale-[1.02] transition-all duration-500 relative overflow-hidden">
        <div class="relative z-10">
            <div class="w-12 h-12 bg-secondary-container rounded-2xl flex items-center justify-center mb-4 text-on-secondary-container shadow-lg">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">reviews</span>
            </div>
            <h3 class="text-xs font-bold text-secondary-container/80 uppercase tracking-wider mb-1">Client Reviews</h3>
            <div class="flex items-baseline gap-2">
                <span class="text-4xl font-extrabold text-white">{{ $stats['testimonials'] }}</span>
                <span class="text-xs font-bold text-secondary-container bg-white/10 px-2 py-0.5 rounded-full">↑ Plus</span>
            </div>
        </div>
        <div class="absolute right-0 top-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16 blur-2xl"></div>
    </div>
</section>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
    <!-- Recent Inquiries Table -->
    <section class="xl:col-span-2 bg-surface-container-lowest rounded-[32px] p-8 shadow-sm border border-outline-variant/20">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-xl font-bold tracking-tight text-on-surface">Recent Inquiries</h3>
            <a class="text-sm font-bold text-primary hover:underline bg-surface-container py-2 px-4 rounded-xl" href="{{ route('admin.contacts.index') }}">View all requests</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-outline-variant/10">
                        <th class="pb-4 text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant">Name</th>
                        <th class="pb-4 text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant">Service Type</th>
                        <th class="pb-4 text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant">Date</th>
                        <th class="pb-4 text-[10px] font-extrabold uppercase tracking-widest text-on-surface-variant text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/5">
                    @forelse($recent_contacts as $contact)
                    <tr class="group hover:bg-surface-container-low transition-colors">
                        <td class="py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center text-on-primary-fixed text-xs font-bold shadow-sm">
                                    {{ substr($contact->name, 0, 2) }}
                                </div>
                                <div>
                                    <p class="font-bold text-sm text-on-surface">{{ $contact->name }}</p>
                                    <p class="text-[10px] font-medium tracking-tight text-on-surface-variant">{{ $contact->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-5 font-bold text-sm text-on-surface-variant text-primary-container">
                            {{ $contact->service_type }}
                        </td>
                        <td class="py-5 text-xs font-semibold text-on-surface-variant tracking-tight">{{ $contact->created_at->format('M d, Y') }}</td>
                        <td class="py-5 text-right">
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="inline-block px-4 py-2 rounded-xl bg-surface-variant text-on-surface-variant text-[10px] font-extrabold uppercase tracking-widest hover:bg-primary-container hover:text-white transition-colors">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center text-on-surface-variant font-bold uppercase tracking-widest text-xs">Inbox is Completely Empty</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <!-- Project Progress Sidebar -->
    <section class="bg-surface-container-low rounded-[32px] p-8 border border-outline-variant/10 shadow-sm transition-all duration-300">
        <h3 class="text-xl font-bold tracking-tight mb-8 text-on-surface">Project Progress</h3>
        <div class="space-y-8">
            <!-- Progress Item 1 -->
            <div>
                <div class="flex justify-between items-end mb-2">
                    <div>
                        <p class="text-sm font-bold text-on-surface">Sovereign Cloud Setup</p>
                        <p class="text-[10px] text-on-surface-variant font-medium">Fintech Solutions Ltd.</p>
                    </div>
                    <span class="text-sm font-extrabold text-primary">85%</span>
                </div>
                <div class="h-2 w-full bg-surface-container-high rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-primary-container to-primary w-[85%] rounded-full shadow-lg shadow-primary/20"></div>
                </div>
            </div>
            <!-- Progress Item 2 -->
            <div>
                <div class="flex justify-between items-end mb-2">
                    <div>
                        <p class="text-sm font-bold text-on-surface">AI Integration Phase II</p>
                        <p class="text-[10px] text-on-surface-variant font-medium">Global Logistics</p>
                    </div>
                    <span class="text-sm font-extrabold text-primary">42%</span>
                </div>
                <div class="h-2 w-full bg-surface-container-high rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-primary-container to-primary w-[42%] rounded-full shadow-lg shadow-primary/20"></div>
                </div>
            </div>
            <!-- Progress Item 3 -->
            <div>
                <div class="flex justify-between items-end mb-2">
                    <div>
                        <p class="text-sm font-bold text-on-surface">Mobile App Core V3</p>
                        <p class="text-[10px] text-on-surface-variant font-medium">KeeTech Labs</p>
                    </div>
                    <span class="text-sm font-extrabold text-primary">92%</span>
                </div>
                <div class="h-2 w-full bg-surface-container-high rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-primary-container to-primary w-[92%] rounded-full shadow-lg shadow-primary/20"></div>
                </div>
            </div>

            <!-- CTA for Projects -->
            <div class="mt-10 p-6 bg-surface-container-lowest rounded-2xl border-2 border-dashed border-outline-variant/30 text-center group hover:border-primary/50 transition-all duration-300">
                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mx-auto mb-3 text-primary group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-outline-variant">add_task</span>
                </div>
                <p class="text-[10px] font-extrabold text-on-surface-variant uppercase tracking-widest mb-4">Assign New Task</p>
                <a href="{{ route('admin.portfolios.create') }}" class="block w-full py-3 bg-secondary-container text-on-secondary-container rounded-xl text-xs font-extrabold shadow-md hover:shadow-lg hover:brightness-105 active:scale-[0.98] transition-all uppercase tracking-widest">
                    Browse Team
                </a>
            </div>
        </div>
    </section>
</div>
@endsection


