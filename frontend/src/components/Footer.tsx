"use client";

import { useEffect, useState } from "react";
import { getSettings } from "@/lib/api";

const defaultFooter = {
  companyName: "KeeTech",
  description: "Penyedia solusi IT komprehensif yang mengedepankan kualitas, transparansi, dan inovasi masa depan untuk bisnis Indonesia.",
  copyright: "© 2024 KeeTech Professional IT Services. All rights reserved.",
  social: {
    instagram: "https://instagram.com/keetech",
    facebook: "https://facebook.com/keetech",
    linkedin: "https://linkedin.com/company/keetech",
    whatsapp: "https://wa.me/6281234567890",
  },
};

export default function Footer({ initialData }: { initialData?: any }) {
  const [footer, setFooter] = useState(() => {
    if (initialData) {
      return {
        companyName: initialData.general?.company_name || defaultFooter.companyName,
        description: initialData.footer?.footer_description || initialData.general?.company_description || defaultFooter.description,
        copyright: initialData.footer?.footer_copyright || defaultFooter.copyright,
        social: {
          instagram: initialData.social?.social_instagram || defaultFooter.social.instagram,
          facebook: initialData.social?.social_facebook || defaultFooter.social.facebook,
          linkedin: initialData.social?.social_linkedin || defaultFooter.social.linkedin,
          whatsapp: initialData.social?.social_whatsapp || defaultFooter.social.whatsapp,
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
              companyName: settings.general?.company_name || defaultFooter.companyName,
              description: settings.footer?.footer_description || settings.general?.company_description || defaultFooter.description,
              copyright: settings.footer?.footer_copyright || defaultFooter.copyright,
              social: {
                instagram: settings.social?.social_instagram || defaultFooter.social.instagram,
                facebook: settings.social?.social_facebook || defaultFooter.social.facebook,
                linkedin: settings.social?.social_linkedin || defaultFooter.social.linkedin,
                whatsapp: settings.social?.social_whatsapp || defaultFooter.social.whatsapp,
              },
            });
          }
        } catch (error) {}
      }
      fetchData();
    }
  }, [initialData]);

  return (
    <footer className="bg-[#1A1A2E] dark:bg-[#0D0D1A] w-full pt-16 sm:pt-20 pb-8 sm:pb-10">
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 sm:gap-12 px-6 sm:px-8 max-w-7xl mx-auto">
        <div className="sm:col-span-2 lg:col-span-1">
          <div className="text-2xl sm:text-3xl font-black text-white mb-4">{footer.companyName}</div>
          <p className="font-['Inter'] leading-relaxed text-slate-300 text-xs sm:text-sm">
            {footer.description}
          </p>
        </div>
        <div>
          <h4 className="text-[#FED65B] font-bold mb-4 sm:mb-6 text-sm sm:text-base">Menu Utama</h4>
          <ul className="space-y-3 sm:space-y-4 text-sm">
            <li><a className="text-slate-400 hover:text-white transition-colors hover:translate-x-1 inline-block" href="#">Beranda</a></li>
            <li><a className="text-slate-400 hover:text-white transition-colors hover:translate-x-1 inline-block" href="#layanan">Layanan</a></li>
            <li><a className="text-slate-400 hover:text-white transition-colors hover:translate-x-1 inline-block" href="#tentangkami">Tentang</a></li>
            <li><a className="text-slate-400 hover:text-white transition-colors hover:translate-x-1 inline-block" href="#portofolio">Portofolio</a></li>
          </ul>
        </div>
        <div>
          <h4 className="text-[#FED65B] font-bold mb-4 sm:mb-6 text-sm sm:text-base">Dukungan</h4>
          <ul className="space-y-3 sm:space-y-4 text-sm">
            <li><a className="text-slate-400 hover:text-white transition-colors hover:translate-x-1 inline-block" href="#">Pusat Bantuan</a></li>
            <li><a className="text-slate-400 hover:text-white transition-colors hover:translate-x-1 inline-block" href="#">Kebijakan Privasi</a></li>
            <li><a className="text-slate-400 hover:text-white transition-colors hover:translate-x-1 inline-block" href="#">Syarat & Ketentuan</a></li>
            <li><a className="text-slate-400 hover:text-white transition-colors hover:translate-x-1 inline-block" href={footer.social.whatsapp} target="_blank" rel="noopener noreferrer">Hubungi WA</a></li>
          </ul>
        </div>
        <div>
          <h4 className="text-[#FED65B] font-bold mb-4 sm:mb-6 text-sm sm:text-base">Media Sosial</h4>
          <div className="flex flex-wrap gap-4">
            <a className="text-slate-400 hover:text-white transition-colors text-sm" href={footer.social.instagram} target="_blank" rel="noopener noreferrer">Instagram</a>
            <a className="text-slate-400 hover:text-white transition-colors text-sm" href={footer.social.facebook} target="_blank" rel="noopener noreferrer">Facebook</a>
            <a className="text-slate-400 hover:text-white transition-colors text-sm" href={footer.social.linkedin} target="_blank" rel="noopener noreferrer">LinkedIn</a>
            <a className="text-slate-400 hover:text-white transition-colors text-sm" href={footer.social.whatsapp} target="_blank" rel="noopener noreferrer">WhatsApp</a>
          </div>
        </div>
      </div>
      <div className="max-w-7xl mx-auto px-6 sm:px-8 pt-10 sm:pt-16 border-t border-white/5 mt-10 sm:mt-16 text-center">
        <p className="text-slate-500 text-xs">{footer.copyright}</p>
      </div>
    </footer>
  );
}
