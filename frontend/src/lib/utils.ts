export function getImageUrl(path: string | null | undefined, placeholder: string = "https://placehold.co/600x400/1A1A2E/FFFFFF?text=Image") {
  if (!path) return placeholder;
  if (path.startsWith('http')) return path;
  
  // Try BACKEND_URL first, then derive from API_URL, then default to localhost
  let baseUrl = process.env.NEXT_PUBLIC_BACKEND_URL;
  
  if (!baseUrl && process.env.NEXT_PUBLIC_API_URL) {
    baseUrl = process.env.NEXT_PUBLIC_API_URL.replace(/\/api\/v1\/?$/, '');
  }
  
  if (!baseUrl) {
    baseUrl = "http://localhost:8000";
  }

  // Ensure no trailing slash on baseUrl
  baseUrl = baseUrl.replace(/\/$/, '');
  
  // If path already starts with /storage or storage, don't prepend it again
  const cleanPath = path.startsWith('/') ? path.substring(1) : path;
  if (cleanPath.startsWith('storage/')) {
    return `${baseUrl}/${cleanPath}`;
  }
  
  return `${baseUrl}/storage/${cleanPath}`;
}
