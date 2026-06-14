<form action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="p-10 space-y-10">
    @csrf
    @if(isset($testimonial)) @method('PUT') @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <div class="space-y-3">
            <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Client/Subject Name</label>
            <input type="text" name="client_name" value="{{ old('client_name', $testimonial->client_name ?? '') }}" required
                class="w-full px-6 py-5 bg-white border-slate-200 shadow-sm dark:bg-white/[0.03] dark:border-slate-200 dark:border-white/5 dark:shadow-none border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-bold text-slate-900 dark:text-white text-sm tracking-tight placeholder:text-slate-700"
                placeholder="e.g. John Wick">
            @error('client_name') <p class="text-rose-500 text-[10px] mt-2 font-bold uppercase tracking-widest">{{ $message }}</p> @enderror
        </div>
        <div class="space-y-3">
            <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Organization/Position</label>
            <input type="text" name="client_role" value="{{ old('client_role', $testimonial->client_role ?? '') }}"
                class="w-full px-6 py-5 bg-white border-slate-200 shadow-sm dark:bg-white/[0.03] dark:border-slate-200 dark:border-white/5 dark:shadow-none border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-bold text-slate-900 dark:text-white text-sm tracking-tight placeholder:text-slate-700"
                placeholder="e.g. CEO of Continental">
            @error('client_role') <p class="text-rose-500 text-[10px] mt-2 font-bold uppercase tracking-widest">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="space-y-3">
        <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Review Content Transcript</label>
        <textarea name="content" rows="5" required
            class="w-full px-6 py-5 bg-white border-slate-200 shadow-sm dark:bg-white/[0.03] dark:border-slate-200 dark:border-white/5 dark:shadow-none border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-medium text-slate-600 dark:text-slate-400 text-sm placeholder:text-slate-700 resize-none"
            placeholder="The service provided was exceptional...">{{ old('content', $testimonial->content ?? '') }}</textarea>
        @error('content') <p class="text-rose-500 text-[10px] mt-2 font-bold uppercase tracking-widest">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <div class="bg-white/[0.01] p-8 rounded-[32px] border border-slate-200 dark:border-white/5 space-y-4">
            <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Client Avatar Asset</label>
            
            <!-- Drag and Drop Zone -->
            <div id="drop-zone" class="relative group cursor-pointer">
                <input type="file" name="client_photo_file" id="client_photo_file" class="hidden" accept="image/*">
                <div class="border-2 border-dashed border-slate-200 dark:border-white/10 rounded-[28px] p-6 transition-all group-hover:border-maroon-700 drag-over:bg-maroon-700/5 drag-over:border-maroon-700 flex flex-col items-center justify-center min-h-[160px] text-center">
                    
                    <div id="preview-container" class="{{ isset($testimonial) && $testimonial->client_photo ? '' : 'hidden' }} absolute inset-0 rounded-[28px] overflow-hidden bg-slate-900">
                        <img id="image-preview" src="{{ isset($testimonial) && $testimonial->client_photo ? (str_starts_with($testimonial->client_photo, 'http') ? $testimonial->client_photo : asset('storage/' . $testimonial->client_photo)) : '#' }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="bg-white text-slate-900 font-bold px-4 py-2 rounded-xl text-[10px] uppercase">Ganti Foto</span>
                        </div>
                    </div>

                    <div id="drop-text" class="{{ isset($testimonial) && $testimonial->client_photo ? 'hidden' : '' }} space-y-2">
                        <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-white/5 flex items-center justify-center mx-auto text-slate-400 group-hover:text-maroon-500 transition-colors">
                            <span class="material-symbols-outlined text-2xl">account_circle</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-700 dark:text-white uppercase tracking-widest">Upload Foto</p>
                            <p class="text-[8px] font-bold text-slate-500 uppercase tracking-tighter mt-1 italic">Tarik atau klik disini</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative mt-4">
                <span class="absolute left-6 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-700 scale-75">link</span>
                <input type="text" name="client_photo" id="client_photo_url" value="{{ old('client_photo', $testimonial->client_photo ?? '') }}"
                    class="w-full pl-14 pr-6 py-4 bg-black/20 border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-bold text-slate-900 dark:text-white text-[10px]"
                    placeholder="ATAU MASUKKAN URL FOTO EKSTERNAL...">
            </div>
            @error('client_photo_file') <p class="text-rose-500 text-[10px] mt-2 font-bold uppercase tracking-widest">{{ $message }}</p> @enderror
        </div>
        
        <div class="grid grid-cols-2 gap-6">
            <div class="space-y-3">
                <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Rating (1-5)</label>
                <input type="number" name="rating" min="1" max="5" value="{{ old('rating', $testimonial->rating ?? 5) }}" required
                    class="w-full px-6 py-5 bg-white border-slate-200 shadow-sm dark:bg-white/[0.03] dark:border-slate-200 dark:border-white/5 dark:shadow-none border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-bold text-slate-900 dark:text-white text-center text-xl">
            </div>
            <div class="space-y-3">
                <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Sort Seq.</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}" required
                    class="w-full px-6 py-5 bg-white border-slate-200 shadow-sm dark:bg-white/[0.03] dark:border-slate-200 dark:border-white/5 dark:shadow-none border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-bold text-slate-900 dark:text-white text-center text-xl">
            </div>
        </div>
    </div>

    <div class="pt-10 border-t border-slate-200 dark:border-white/5 flex flex-wrap gap-6">
        <label class="flex items-center gap-4 cursor-pointer group px-8 py-5 bg-white dark:bg-white/[0.02] border border-slate-200 dark:border-white/5 rounded-2xl hover:bg-slate-100 dark:bg-white/5 transition-all w-max">
            <div class="relative w-6 h-6">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}
                    class="peer absolute opacity-0 w-full h-full cursor-pointer z-10">
                <div class="w-6 h-6 bg-slate-100 dark:bg-white/5 border border-slate-300 dark:border-white/10 rounded-lg group-hover:border-maroon-500 transition-all peer-checked:bg-maroon-700 peer-checked:border-maroon-700 flex items-center justify-center text-slate-900 dark:text-white">
                    <span class="material-symbols-outlined text-sm scale-0 peer-checked:scale-100 transition-transform">check</span>
                </div>
            </div>
            <span class="text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest group-hover:text-slate-900 dark:text-white transition-colors">Broadcast to Main Landing</span>
        </label>

        <label class="flex items-center gap-4 cursor-pointer group px-8 py-5 bg-white dark:bg-white/[0.02] border border-slate-200 dark:border-white/5 rounded-2xl hover:bg-slate-100 dark:bg-white/5 transition-all w-max">
            <div class="relative w-6 h-6">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $testimonial->is_featured ?? false) ? 'checked' : '' }}
                    class="peer absolute opacity-0 w-full h-full cursor-pointer z-10">
                <div class="w-6 h-6 bg-slate-100 dark:bg-white/5 border border-slate-300 dark:border-white/10 rounded-lg group-hover:border-maroon-500 transition-all peer-checked:bg-blue-600 peer-checked:border-blue-600 flex items-center justify-center text-slate-900 dark:text-white">
                    <span class="material-symbols-outlined text-sm scale-0 peer-checked:scale-100 transition-transform">star</span>
                </div>
            </div>
            <span class="text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest group-hover:text-slate-900 dark:text-white transition-colors">Featured Review</span>
        </label>
    </div>

    <div class="flex flex-wrap gap-4 pt-10 pb-4">
        <button type="submit" class="bg-maroon-700 text-white font-bold px-12 py-5 rounded-[24px] hover:bg-gold-500 hover:text-maroon-900 transition-all shadow-2xl shadow-maroon-700/20 uppercase tracking-widest text-xs">
            Commit Review
        </button>
        <a href="{{ route('admin.testimonials.index') }}" class="bg-slate-100 dark:bg-white/5 text-slate-500 dark:text-slate-400 font-bold px-12 py-5 rounded-[24px] hover:bg-slate-200 dark:bg-white/10 hover:text-slate-900 dark:text-white transition-all uppercase tracking-widest text-xs border border-slate-200 dark:border-white/5">
            Abort
        </a>
    </div>
</form>

<script>
    const dropZone = document.getElementById('drop-zone');
    const imageInput = document.getElementById('client_photo_file');
    const imagePreview = document.getElementById('image-preview');
    const previewContainer = document.getElementById('preview-container');
    const dropText = document.getElementById('drop-text');
    const imageUrlInput = document.getElementById('client_photo_url');

    dropZone.addEventListener('click', () => imageInput.click());

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, e => {
            e.preventDefault();
            e.stopPropagation();
        });
    });

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => dropZone.classList.add('drag-over'));
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => dropZone.classList.remove('drag-over'));
    });

    dropZone.addEventListener('drop', e => {
        const files = e.dataTransfer.files;
        if (files.length) {
            imageInput.files = files;
            handlePreview(files[0]);
        }
    });

    imageInput.addEventListener('change', e => {
        if (e.target.files.length) {
            handlePreview(e.target.files[0]);
        }
    });

    function handlePreview(file) {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => {
                imagePreview.src = e.target.result;
                previewContainer.classList.remove('hidden');
                dropText.classList.add('hidden');
                imageUrlInput.value = '';
            };
            reader.readAsDataURL(file);
        }
    }

    imageUrlInput.addEventListener('input', (e) => {
        if (e.target.value.startsWith('http')) {
            imagePreview.src = e.target.value;
            previewContainer.classList.remove('hidden');
            dropText.classList.add('hidden');
            imageInput.value = '';
        }
    });
</script>


