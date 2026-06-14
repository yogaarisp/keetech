<form action="{{ isset($portfolio) ? route('admin.portfolios.update', $portfolio) : route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data" class="p-10 space-y-10">
        @csrf
        @if(isset($portfolio)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="space-y-3">
                <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Project Title</label>
                <input type="text" name="title" value="{{ old('title', $portfolio->title ?? '') }}" required
                    class="w-full px-6 py-4 bg-white border-slate-200 shadow-sm dark:bg-white/[0.03] dark:border-slate-200 dark:border-white/5 dark:shadow-none border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-bold text-slate-900 dark:text-white placeholder:text-slate-700">
                @error('title') <p class="text-rose-500 text-[10px] mt-2 font-bold uppercase tracking-widest">{{ $message }}</p> @enderror
            </div>
            <div class="space-y-3">
                <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Project Classification</label>
                <select name="portfolio_category_id" required
                    class="w-full px-6 py-4 bg-white border-slate-200 shadow-sm dark:bg-white/[0.03] dark:border-slate-200 dark:border-white/5 dark:shadow-none border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-bold text-slate-600 dark:text-slate-400 appearance-none cursor-pointer">
                    <option value="" disabled {{ old('portfolio_category_id', $portfolio->portfolio_category_id ?? '') == '' ? 'selected' : '' }}>-- Select Classification --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('portfolio_category_id', $portfolio->portfolio_category_id ?? '') == $category->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('portfolio_category_id') <p class="text-rose-500 text-[10px] mt-2 font-bold uppercase tracking-widest">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="space-y-3">
            <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Executive Summary</label>
            <textarea name="description" rows="4" required
                class="w-full px-6 py-4 bg-white border-slate-200 shadow-sm dark:bg-white/[0.03] dark:border-slate-200 dark:border-white/5 dark:shadow-none border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-medium text-slate-600 dark:text-slate-400 placeholder:text-slate-700 resize-none"
                placeholder="Detail technical specifications...">{{ old('description', $portfolio->description ?? '') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="bg-white/[0.01] p-8 rounded-[32px] border border-slate-200 dark:border-white/5 space-y-4">
                <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Asset Media</label>
                
                <!-- Drag and Drop Zone -->
                <div id="drop-zone" class="relative group cursor-pointer">
                    <input type="file" name="image_file" id="image_file" class="hidden" accept="image/*">
                    <div class="border-2 border-dashed border-slate-200 dark:border-white/10 rounded-[28px] p-8 transition-all group-hover:border-maroon-700 drag-over:bg-maroon-700/5 drag-over:border-maroon-700 flex flex-col items-center justify-center min-h-[220px] text-center">
                        
                        <div id="preview-container" class="{{ isset($portfolio) && $portfolio->image ? '' : 'hidden' }} absolute inset-0 rounded-[28px] overflow-hidden bg-slate-900">
                            <img id="image-preview" src="{{ isset($portfolio) && $portfolio->image ? (str_starts_with($portfolio->image, 'http') ? $portfolio->image : asset('storage/' . $portfolio->image)) : '#' }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="bg-white text-slate-900 font-bold px-4 py-2 rounded-xl text-[10px] uppercase">Ganti Gambar</span>
                            </div>
                        </div>

                        <div id="drop-text" class="{{ isset($portfolio) && $portfolio->image ? 'hidden' : '' }} space-y-3">
                            <div class="w-16 h-16 rounded-full bg-slate-100 dark:bg-white/5 flex items-center justify-center mx-auto text-slate-400 group-hover:text-maroon-500 transition-colors">
                                <span class="material-symbols-outlined text-3xl">cloud_upload</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-700 dark:text-white uppercase tracking-widest">Tarik Gambar Kesini</p>
                                <p class="text-[8px] font-bold text-slate-500 uppercase tracking-tighter mt-1 italic">atau klik untuk memilih file manual</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative mt-4">
                    <span class="absolute left-6 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-700 scale-75">link</span>
                    <input type="text" name="image" id="image_url" value="{{ old('image', $portfolio->image ?? '') }}"
                        class="w-full pl-14 pr-6 py-4 bg-black/20 border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-bold text-slate-900 dark:text-white text-[10px]"
                        placeholder="ATAU MASUKKAN URL MEDIA EKSTERNAL...">
                </div>
                @error('image_file') <p class="text-rose-500 text-[10px] mt-2 font-bold uppercase tracking-widest">{{ $message }}</p> @enderror
            </div>

            <div class="bg-white/[0.01] p-8 rounded-[32px] border border-slate-200 dark:border-white/5 space-y-6">
                <div>
                    <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Client Entity</label>
                    <input type="text" name="client_name" value="{{ old('client_name', $portfolio->client_name ?? '') }}"
                        class="w-full px-6 py-4 bg-black/20 border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-bold text-slate-900 dark:text-white text-sm"
                        placeholder="PT. Example International">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Deployment URL</label>
                    <input type="url" name="project_url" value="{{ old('project_url', $portfolio->project_url ?? '') }}"
                        class="w-full px-6 py-4 bg-black/20 border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-bold text-slate-900 dark:text-white text-sm"
                        placeholder="https://project.keetech.id">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 pt-10 border-t border-slate-200 dark:border-white/5">
            <div class="space-y-3">
                <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 mb-2 uppercase tracking-wider">Display Priority</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $portfolio->sort_order ?? 0) }}" required
                    class="w-full px-6 py-4 bg-white border-slate-200 shadow-sm dark:bg-white/[0.03] dark:border-slate-200 dark:border-white/5 dark:shadow-none border border-slate-200 dark:border-white/5 rounded-2xl focus:ring-4 focus:ring-maroon-700/20 focus:border-maroon-700 outline-none transition-all font-bold text-slate-900 dark:text-white text-center text-xl">
            </div>
            <div class="flex items-center pt-8">
                <label class="flex items-center gap-4 cursor-pointer group px-8 py-4 bg-white dark:bg-white/[0.02] border border-slate-200 dark:border-white/5 rounded-2xl hover:bg-slate-100 dark:bg-white/5 transition-all w-full">
                    <div class="relative w-6 h-6">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $portfolio->is_active ?? true) ? 'checked' : '' }}
                            class="peer absolute opacity-0 w-full h-full cursor-pointer z-10">
                        <div class="w-6 h-6 bg-slate-100 dark:bg-white/5 border border-slate-300 dark:border-white/10 rounded-lg group-hover:border-maroon-500 transition-all peer-checked:bg-maroon-700 peer-checked:border-maroon-700 flex items-center justify-center text-slate-900 dark:text-white">
                            <span class="material-symbols-outlined text-sm scale-0 peer-checked:scale-100 transition-transform">check</span>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest group-hover:text-slate-900 dark:text-white transition-colors">Publish to Showcase</span>
                </label>
            </div>
        </div>

        <div class="flex flex-wrap gap-4 pt-10 pb-4">
            <button type="submit" class="bg-slate-900 text-white dark:bg-white dark:text-black font-bold px-12 py-5 rounded-[24px] hover:bg-gold-500 transition-all shadow-2xl shadow-black/50 uppercase tracking-widest text-xs">
                Sync Asset
            </button>
            <a href="{{ route('admin.portfolios.index') }}" class="bg-slate-100 dark:bg-white/5 text-slate-500 dark:text-slate-400 font-bold px-12 py-5 rounded-[24px] hover:bg-slate-200 dark:bg-white/10 hover:text-slate-900 dark:text-white transition-all uppercase tracking-widest text-xs border border-slate-200 dark:border-white/5">
                Cancel
            </a>
        </div>
    </form>

<script>
    const dropZone = document.getElementById('drop-zone');
    const imageInput = document.getElementById('image_file');
    const imagePreview = document.getElementById('image-preview');
    const previewContainer = document.getElementById('preview-container');
    const dropText = document.getElementById('drop-text');
    const imageUrlInput = document.getElementById('image_url');

    // Click to select
    dropZone.addEventListener('click', () => imageInput.click());

    // Drag events
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

    // Handle dropped files
    dropZone.addEventListener('drop', e => {
        const files = e.dataTransfer.files;
        if (files.length) {
            imageInput.files = files;
            handlePreview(files[0]);
        }
    });

    // Handle selected files
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
                // Clear URL input when a file is chosen to avoid confusion
                imageUrlInput.value = '';
            };
            reader.readAsDataURL(file);
        }
    }

    // sync URL input preview (optional)
    imageUrlInput.addEventListener('input', (e) => {
        if (e.target.value.startsWith('http')) {
            imagePreview.src = e.target.value;
            previewContainer.classList.remove('hidden');
            dropText.classList.add('hidden');
            // Clear file input
            imageInput.value = '';
        }
    });
</script>
