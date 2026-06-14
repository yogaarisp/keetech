export function getImageUrl(path: string | null | undefined, placeholder: string = "https://placehold.co/600x400/1A1A2E/FFFFFF?text=Image") {
  if (!path) return placeholder;
  if (path.startsWith('http')) return path;
  
  const baseUrl = process.env.NEXT_PUBLIC_BACKEND_URL || "http://localhost:8000";
  return `${baseUrl}/storage/${path}`;
}
