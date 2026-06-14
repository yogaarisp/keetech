import type { Metadata } from "next";
import { Inter } from "next/font/google";
import "./globals.css";
import { getSettings } from "@/lib/api";

const inter = Inter({ subsets: ["latin"] });

export async function generateMetadata(): Promise<Metadata> {
  const settings = await getSettings();
  
  const companyName = settings?.general?.company_name || "KeeTech";
  const companyTagline = settings?.general?.company_tagline || "Solusi Digital Terpadu";
  const companyDescription = settings?.general?.company_description || "Kami menyediakan layanan IT lengkap.";
  
  // Favicon handling
  const favicon = settings?.general?.company_favicon;
  
  let baseUrl = process.env.NEXT_PUBLIC_BACKEND_URL;
  if (!baseUrl && process.env.NEXT_PUBLIC_API_URL) {
    baseUrl = process.env.NEXT_PUBLIC_API_URL.replace(/\/api\/v1\/?$/, '');
  }
  if (!baseUrl) {
    baseUrl = 'http://localhost:8000';
  }
  baseUrl = baseUrl.replace(/\/$/, '');

  const iconUrl = favicon 
    ? (favicon.startsWith('http') ? favicon : `${baseUrl}/storage/${favicon.startsWith('/') ? favicon.substring(1) : favicon}`) 
    : '/favicon.ico';

  return {
    metadataBase: new URL(process.env.NEXT_PUBLIC_SITE_URL || 'http://localhost:3000'),
    title: `${companyName} | ${companyTagline}`,
    description: companyDescription,
    icons: {
      icon: iconUrl,
    },
  };
}

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="id" className="scroll-smooth">
      <head>
        <link
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
          rel="stylesheet"
        />
      </head>
      <body className={`${inter.className}`}>
        {children}
      </body>
    </html>
  );
}
