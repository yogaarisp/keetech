"use client";

import { motion, Variants } from "framer-motion";
import { useEffect, useState } from "react";
import { getSettings } from "@/lib/api";
import { getImageUrl } from "@/lib/utils";

const fadeUp: Variants = {
  hidden: { opacity: 0, y: 30 },
  show: { opacity: 1, y: 0, transition: { duration: 0.6, ease: "easeOut" } }
};

const staggerContainer: Variants = {
  hidden: { opacity: 0 },
  show: {
    opacity: 1,
    transition: {
      staggerChildren: 0.15
    }
  }
};

const defaultHero = {
  hero_badge: "Solusi Digital untuk Bisnis Anda",
  hero_title: "Solusi Digital <span>Terpadu</span><br/>untuk Bisnis Anda",
  hero_description: "Kami menyediakan layanan IT lengkap — mulai dari perbaikan hardware, infrastruktur jaringan, hingga pengembangan software dan pengadaan perangkat IT.",
  hero_image: "https://keetech.my.id/storage/settings/o3TGJ3jMXm1q39V267yDKHcYp5XrWISqvqWPCJ4L.png",
  hero_cta_primary_text: "Konsultasi Gratis",
  hero_cta_primary_link: "#kontak",
  hero_cta_secondary_text: "Lihat Layanan",
  hero_cta_secondary_link: "#layanan",
};

export default function Hero({ initialData }: { initialData?: any }) {
  const [hero, setHero] = useState(initialData || defaultHero);

  useEffect(() => {
    if (!initialData) {
      async function fetchData() {
        try {
          const settings = await getSettings();
          if (settings?.hero) {
            setHero({
              hero_badge: settings.hero.hero_badge || defaultHero.hero_badge,
              hero_title: settings.hero.hero_title || defaultHero.hero_title,
              hero_description: settings.hero.hero_description || defaultHero.hero_description,
              hero_image: settings.hero.hero_image || defaultHero.hero_image,
              hero_cta_primary_text: settings.hero.hero_cta_primary_text || defaultHero.hero_cta_primary_text,
              hero_cta_primary_link: settings.hero.hero_cta_primary_link || defaultHero.hero_cta_primary_link,
              hero_cta_secondary_text: settings.hero.hero_cta_secondary_text || defaultHero.hero_cta_secondary_text,
              hero_cta_secondary_link: settings.hero.hero_cta_secondary_link || defaultHero.hero_cta_secondary_link,
            });
          }
        } catch (error) {}
      }
      fetchData();
    }
  }, [initialData]);

  const renderTitle = (title: string) => {
    // Check if the title has <span>
    if (!title.includes('<span>')) {
      return <span>{title}</span>;
    }
    const parts = title.split(/(<span>.*?<\/span>|<br\s*\/?>)/i);
    return parts.map((part, idx) => {
      if (part.toLowerCase().startsWith('<span>')) {
        return <span key={idx} className="text-gradient-primary">{part.replace(/<\/?span>/gi, '')}</span>;
      }
      if (part.toLowerCase().startsWith('<br')) {
        return <br key={idx} />;
      }
      return <span key={idx}>{part}</span>;
    });
  };

  return (
    <header className="relative min-h-[90vh] lg:min-h-screen flex items-center overflow-hidden bg-background" id="hero">
      
      {/* === Absolute Hero Image Background === */}
      <div className="absolute inset-0 z-0 pointer-events-none">
        <img 
          alt="KeeTech Hero" 
          className="w-full h-full object-cover object-right mix-blend-lighten opacity-95" 
          src={getImageUrl(hero.hero_image, defaultHero.hero_image)}
        />
        {/* Dark overlay on the left to ensure text is highly readable over the grid */}
        <div className="absolute inset-y-0 left-0 w-full lg:w-[60%] bg-gradient-to-r from-background via-background/90 to-transparent"></div>
        {/* Top/Bottom gradient fades */}
        <div className="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-background to-transparent"></div>
        <div className="absolute inset-x-0 top-0 h-32 bg-gradient-to-b from-background via-background/50 to-transparent"></div>
      </div>

      {/* === Text Content Container (Left Aligned) === */}
      <div className="relative z-10 max-w-7xl mx-auto px-4 md:px-8 w-full pt-32 pb-20 lg:py-0">
        <motion.div 
          variants={staggerContainer} 
          initial="hidden"
          animate="show" 
          className="max-w-xl lg:max-w-[650px] flex flex-col items-start text-left"
        >
          <motion.div variants={fadeUp} className="inline-flex items-center px-4 py-2 rounded-full border border-outline-variant bg-surface/30 backdrop-blur-md text-on-surface-variant text-xs sm:text-sm font-medium tracking-wide mb-6 gap-2">
            <span className="w-2 h-2 rounded-full bg-secondary shadow-[0_0_8px_var(--color-secondary)]"></span>
            {hero.hero_badge}
          </motion.div>
          
          <motion.h1 variants={fadeUp} className="text-4xl sm:text-5xl lg:text-6xl font-bold text-on-background leading-[1.15] mb-6 sm:mb-8 tracking-tight">
            {renderTitle(hero.hero_title)}
          </motion.h1>
          
          <motion.p variants={fadeUp} className="text-on-surface-variant leading-relaxed max-w-lg mb-10 text-base sm:text-lg">
            {hero.hero_description}
          </motion.p>
          
          <motion.div variants={fadeUp} className="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
            <a href={hero.hero_cta_primary_link} className="bg-gradient-primary text-background px-8 py-4 rounded-lg font-bold text-base sm:text-lg shadow-[0_4px_24px_rgba(0,191,255,0.3)] flex items-center justify-center gap-2 transition-transform hover:-translate-y-1">
              {hero.hero_cta_primary_text}
              <span className="material-symbols-outlined text-xl">arrow_forward</span>
            </a>
            <a href={hero.hero_cta_secondary_link} className="border border-outline hover:border-primary/50 text-on-background px-8 py-4 rounded-lg font-medium text-base sm:text-lg flex items-center justify-center gap-2 hover:bg-surface/50 backdrop-blur-sm transition-colors">
              {hero.hero_cta_secondary_text}
            </a>
          </motion.div>
          
          <motion.div variants={fadeUp} className="flex flex-wrap items-center gap-3 sm:gap-5 text-xs sm:text-sm text-on-surface-variant mt-10 bg-surface/30 px-6 py-3 rounded-full backdrop-blur-md border border-outline-variant">
            <div className="flex items-center gap-2">
              <span className="material-symbols-outlined text-secondary text-base">verified_user</span> Solusi Aman
            </div>
            <span className="text-outline hidden sm:block">•</span>
            <div className="flex items-center gap-2">
              <span className="material-symbols-outlined text-secondary text-base">verified_user</span> Terpercaya
            </div>
            <span className="text-outline hidden sm:block">•</span>
            <div className="flex items-center gap-2">
              <span className="material-symbols-outlined text-secondary text-base">verified_user</span> Profesional
            </div>
          </motion.div>
        </motion.div>
      </div>
      
    </header>
  );
}

