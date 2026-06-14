import { Metadata } from "next";
import Navbar from "@/components/Navbar";
import Hero from "@/components/Hero";
import Services from "@/components/Services";
import About from "@/components/About";
import Portfolio from "@/components/Portfolio";
import Testimonials from "@/components/Testimonials";
import Contact from "@/components/Contact";
import Footer from "@/components/Footer";
import { getSettings, getServices, getPortfolios, getTestimonials } from "@/lib/api";

export async function generateMetadata(): Promise<Metadata> {
  const settings = await getSettings();
  const companyName = settings?.general?.company_name || "KeeTech";
  const tagline = settings?.general?.company_tagline || "Solusi Digital Terpadu";
  const description = settings?.general?.company_description || "Penyedia layanan IT komprehensif.";

  return {
    title: `${companyName} | ${tagline}`,
    description: description,
    openGraph: {
      title: `${companyName} | ${tagline}`,
      description: description,
      siteName: companyName,
      locale: "id_ID",
      type: "website",
      images: [
        {
          url: settings?.hero?.hero_image || "/og-image.png", // Fallback to a default if needed
          width: 1200,
          height: 630,
          alt: companyName,
        },
      ],
    },
    twitter: {
      card: "summary_large_image",
      title: `${companyName} | ${tagline}`,
      description: description,
    },
  };
}

export default async function Page() {
  // Fetch everything in parallel on the server
  const [settings, services, portfolios, testimonials] = await Promise.all([
    getSettings(),
    getServices(),
    getPortfolios(),
    getTestimonials(),
  ]);

  const jsonLd = {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": settings?.general?.company_name || "KeeTech",
    "image": settings?.hero?.hero_image || "",
    "description": settings?.general?.company_description || "",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": settings?.contact?.company_address || "Jakarta, Indonesia",
      "addressLocality": "Jakarta",
      "addressCountry": "ID"
    },
    "telephone": settings?.contact?.company_phone || "",
    "email": settings?.contact?.company_email || "",
    "url": "https://keetech.id"
  };

  return (
    <>
      <script
        type="application/ld+json"
        dangerouslySetInnerHTML={{ __html: JSON.stringify(jsonLd) }}
      />
      <Navbar initialData={settings} />
      <main>
        <Hero initialData={settings?.hero} />
        <Services initialData={services} />
        <About initialData={settings} />
        <Portfolio initialData={portfolios} />
        <Testimonials initialData={testimonials} />
        <Contact />
      </main>
      <Footer initialData={settings} />
    </>
  );
}
