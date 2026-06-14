const API_BASE_URL = process.env.NEXT_PUBLIC_API_URL || "http://localhost:8000/api/v1";

export async function getServices() {
  const res = await fetch(`${API_BASE_URL}/services`, { next: { revalidate: 10 } });
  if (!res.ok) return [];
  const json = await jsonPromise(res);
  return json.data || [];
}

export async function getPortfolios() {
  const res = await fetch(`${API_BASE_URL}/portfolios`, { next: { revalidate: 10 } });
  if (!res.ok) return [];
  const json = await jsonPromise(res);
  return json.data || [];
}

export async function getTestimonials() {
  const res = await fetch(`${API_BASE_URL}/testimonials`, { next: { revalidate: 10 } });
  if (!res.ok) return [];
  const json = await jsonPromise(res);
  return json.data || [];
}

export async function getSettings() {
  const res = await fetch(`${API_BASE_URL}/settings`, { next: { revalidate: 10 } });
  if (!res.ok) return null;
  const json = await jsonPromise(res);
  return json.data || null;
}

export async function submitContact(data: any) {
  const res = await fetch(`${API_BASE_URL}/contacts`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data),
  });
  return res.ok;
}

// Helper to handle potential empty responses
async function jsonPromise(res: Response) {
  try {
    return await res.json();
  } catch (e) {
    return {};
  }
}
