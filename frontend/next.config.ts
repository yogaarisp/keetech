import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  output: 'export',
  // Build menghasilkan folder 'out/' berisi file statis (seperti Vue/Vite)
  // Tidak perlu Node.js server untuk production
  images: {
    unoptimized: true, // Required untuk static export
  },
};

export default nextConfig;
