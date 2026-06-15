"use client";

import { useEffect, useState } from "react";
import { getSettings } from "@/lib/api";

const BG = "#01030D";
const GRADIENT = "linear-gradient(90deg, #2DD4BF 0%, #34D399 100%)";
const CYAN = "#2DD4BF";

const defaultFooter = {
  companyName: "KeeTech",
  description:
    "Penyedia solusi IT komprehensif yang mengedepankan kualitas, transparansi, dan inovasi masa depan untuk bisnis Indonesia.",
  copyright: `© ${new Date().getFullYear()} KeeTech Professional IT Services. All rights reserved.`,
  social: {
    instagram: "https://instagram.com/keetech",
    facebook: "https://facebook.com/keetech",
    linkedin: "https://linkedin.com/company/keetech",
    whatsapp: "https://wa.me/6281234567890",
  },
};

const socialLinks = (social: typeof defaultFooter.social) => [
  {
    label: "Instagram",
    href: social.instagram,
    icon: (
      <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
      </svg>
    ),
  },
  {
    label: "Facebook",
    href: social.facebook,
    icon: (
      <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
      </svg>
    ),
  },
  {
    label: "LinkedIn",
    href: social.linkedin,
    icon: (
      <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
      </svg>
    ),
  },
  {
    label: "WhatsApp",
    href: social.whatsapp,
    icon: (
      <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
      </svg>
    ),
  },
];

export default function Footer({ initialData }: { initialData?: any }) {
  const [footer, setFooter] = useState(() => {
    if (initialData) {
      return {
        companyName:
          initialData.general?.company_name || defaultFooter.companyName,
        description:
          initialData.footer?.footer_description ||
          initialData.general?.company_description ||
          defaultFooter.description,
        copyright:
          initialData.footer?.footer_copyright || defaultFooter.copyright,
        social: {
          instagram:
            initialData.social?.social_instagram ||
            defaultFooter.social.instagram,
          facebook:
            initialData.social?.social_facebook ||
            defaultFooter.social.facebook,
          linkedin:
            initialData.social?.social_linkedin ||
            defaultFooter.social.linkedin,
          whatsapp:
            initialData.social?.social_whatsapp ||
            defaultFooter.social.whatsapp,
        },
      };
    }
    return defaultFooter;
  });

  useEffect(() => {
    if (!initialData) {
      async function fetchData() {
        try {
          const settings = await getSettings();
          if (settings) {
            setFooter({
              companyName:
                settings.general?.company_name || defaultFooter.companyName,
              description:
                settings.footer?.footer_description ||
                settings.general?.company_description ||
                defaultFooter.description,
              copyright:
                settings.footer?.footer_copyright || defaultFooter.copyright,
              social: {
                instagram:
                  settings.social?.social_instagram ||
                  defaultFooter.social.instagram,
                facebook:
                  settings.social?.social_facebook ||
                  defaultFooter.social.facebook,
                linkedin:
                  settings.social?.social_linkedin ||
                  defaultFooter.social.linkedin,
                whatsapp:
                  settings.social?.social_whatsapp ||
                  defaultFooter.social.whatsapp,
              },
            });
          }
        } catch (error) {}
      }
      fetchData();
    }
  }, [initialData]);

  const socials = socialLinks(footer.social);

  return (
    <footer
      className="relative w-full overflow-hidden"
      style={{ background: BG }}
    >
      {/* Top separator glow */}
      <div
        className="absolute top-0 left-0 right-0 h-px"
        style={{
          background:
            "linear-gradient(90deg, transparent 0%, rgba(45,212,191,0.4) 30%, rgba(52,211,153,0.4) 70%, transparent 100%)",
        }}
      />

      {/* Subtle background dot grid */}
      <div
        className="pointer-events-none absolute inset-0"
        aria-hidden
        style={{
          backgroundImage:
            "radial-gradient(circle, rgba(45,212,191,0.06) 1px, transparent 1px)",
          backgroundSize: "32px 32px",
        }}
      />

      {/* Glow blob top-center */}
      <div
        className="pointer-events-none absolute top-0 left-1/2 -translate-x-1/2"
        aria-hidden
        style={{
          width: "60%",
          height: "180px",
          background:
            "radial-gradient(ellipse at top, rgba(45,212,191,0.07) 0%, transparent 70%)",
        }}
      />

      <div className="relative z-10 mx-auto w-full max-w-7xl px-6 sm:px-8 pt-16 pb-8">
        {/* Main footer grid */}
        <div className="grid grid-cols-1 md:grid-cols-12 gap-10 md:gap-8 pb-12 border-b border-white/[0.06]">
          {/* Brand column */}
          <div className="md:col-span-4">
            {/* Logo mark */}
            <div className="flex items-center gap-3 mb-5">
              <div
                className="flex shrink-0 h-9 w-9 items-center justify-center rounded-xl font-black text-[#01030D] text-base"
                style={{
                  background: GRADIENT,
                  boxShadow: "0 0 20px rgba(45,212,191,0.35)",
                }}
              >
                K
              </div>
              <span
                className="text-xl font-black text-white tracking-tight"
              >
                {footer.companyName}
              </span>
            </div>

            <p
              className="text-sm leading-relaxed mb-6 max-w-[300px]"
              style={{ color: "rgba(255,255,255,0.45)" }}
            >
              {footer.description}
            </p>

            {/* Social icons */}
            <div className="flex gap-3">
              {socials.map(({ label, href, icon }) => (
                <a
                  key={label}
                  href={href}
                  target="_blank"
                  rel="noopener noreferrer"
                  aria-label={label}
                  className="group flex h-9 w-9 items-center justify-center rounded-xl transition-all duration-300"
                  style={{
                    background: "rgba(255,255,255,0.04)",
                    border: "1px solid rgba(255,255,255,0.08)",
                    color: "rgba(255,255,255,0.45)",
                  }}
                  onMouseEnter={(e) => {
                    e.currentTarget.style.background = "rgba(45,212,191,0.12)";
                    e.currentTarget.style.borderColor = "rgba(45,212,191,0.3)";
                    e.currentTarget.style.color = CYAN;
                  }}
                  onMouseLeave={(e) => {
                    e.currentTarget.style.background = "rgba(255,255,255,0.04)";
                    e.currentTarget.style.borderColor = "rgba(255,255,255,0.08)";
                    e.currentTarget.style.color = "rgba(255,255,255,0.45)";
                  }}
                >
                  {icon}
                </a>
              ))}
            </div>
          </div>

          {/* Spacer */}
          <div className="hidden md:block md:col-span-1" />

          {/* Menu Utama */}
          <div className="md:col-span-2">
            <h4
              className="text-xs font-bold uppercase tracking-[0.16em] mb-5"
              style={{ color: CYAN }}
            >
              Menu Utama
            </h4>
            <ul className="space-y-3">
              {[
                { label: "Beranda", href: "#beranda" },
                { label: "Layanan", href: "#layanan" },
                { label: "Tentang Kami", href: "#tentangkami" },
                { label: "Portofolio", href: "#portofolio" },
                { label: "Kontak", href: "#kontak" },
              ].map(({ label, href }) => (
                <li key={label}>
                  <a
                    href={href}
                    className="text-sm transition-all duration-200 flex items-center gap-1.5 group"
                    style={{ color: "rgba(255,255,255,0.45)" }}
                    onMouseEnter={(e) => {
                      e.currentTarget.style.color = "#fff";
                    }}
                    onMouseLeave={(e) => {
                      e.currentTarget.style.color = "rgba(255,255,255,0.45)";
                    }}
                  >
                    <span
                      className="w-0 group-hover:w-2 h-px rounded-full transition-all duration-200 shrink-0"
                      style={{ background: CYAN }}
                    />
                    {label}
                  </a>
                </li>
              ))}
            </ul>
          </div>

          {/* Dukungan */}
          <div className="md:col-span-2">
            <h4
              className="text-xs font-bold uppercase tracking-[0.16em] mb-5"
              style={{ color: CYAN }}
            >
              Dukungan
            </h4>
            <ul className="space-y-3">
              {[
                { label: "Kebijakan Privasi", href: "#" },
                { label: "Syarat & Ketentuan", href: "#" },
                { label: "Hubungi Kami", href: "#kontak" },
                { label: "WhatsApp Langsung", href: footer.social.whatsapp, external: true },
              ].map(({ label, href, external }) => (
                <li key={label}>
                  <a
                    href={href}
                    target={external ? "_blank" : undefined}
                    rel={external ? "noopener noreferrer" : undefined}
                    className="text-sm transition-all duration-200 flex items-center gap-1.5 group"
                    style={{ color: "rgba(255,255,255,0.45)" }}
                    onMouseEnter={(e) => {
                      e.currentTarget.style.color = "#fff";
                    }}
                    onMouseLeave={(e) => {
                      e.currentTarget.style.color = "rgba(255,255,255,0.45)";
                    }}
                  >
                    <span
                      className="w-0 group-hover:w-2 h-px rounded-full transition-all duration-200 shrink-0"
                      style={{ background: CYAN }}
                    />
                    {label}
                  </a>
                </li>
              ))}
            </ul>
          </div>

          {/* CTA */}
          <div className="md:col-span-3">
            <h4
              className="text-xs font-bold uppercase tracking-[0.16em] mb-5"
              style={{ color: CYAN }}
            >
              Mulai Sekarang
            </h4>
            <p
              className="text-sm mb-5 leading-relaxed"
              style={{ color: "rgba(255,255,255,0.45)" }}
            >
              Butuh solusi IT untuk bisnis Anda? Tim kami siap membantu.
            </p>
            <a
              href={footer.social.whatsapp}
              target="_blank"
              rel="noopener noreferrer"
              className="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 hover:-translate-y-0.5"
              style={{
                background: GRADIENT,
                color: "#01030D",
                boxShadow: "0 0 20px rgba(45,212,191,0.3)",
              }}
            >
              <span className="material-symbols-outlined" style={{ fontSize: 16 }}>
                chat
              </span>
              Konsultasi Gratis
            </a>
          </div>
        </div>

        {/* Bottom bar */}
        <div className="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
          <p
            className="text-xs"
            style={{ color: "rgba(255,255,255,0.25)" }}
          >
            {footer.copyright}
          </p>
          <div className="flex items-center gap-1.5">
            <span
              className="inline-block h-1.5 w-1.5 rounded-full"
              style={{ background: CYAN }}
            />
            <span
              className="text-xs"
              style={{ color: "rgba(255,255,255,0.25)" }}
            >
              Dibuat dengan ❤️ di Indonesia
            </span>
          </div>
        </div>
      </div>
    </footer>
  );
}
