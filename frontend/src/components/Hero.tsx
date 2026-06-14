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
  hero_title: "Bangun Solusi Digital Inovatif Bersama <span>KEETECH</span>",
  hero_description: "Kami membantu bisnis Anda tumbuh dengan teknologi modern, solusi custom, dan tim profesional yang berpengalaman.",
  hero_image: "https://lh3.googleusercontent.com/aida-public/AB6AXuCIl5hoAzy8INzWtmGt1XM4TFquA9MKQYaREd-_R7ui-3DK_1nRJPEsfOHiG8mZNGpR6DZusQb3tez5Dvt3NtDhXcSrlmEqiQ3_p17TmNiTqtL_1hO_tuGt75tvr2TWnzZtPQdjYTjzkhaZPwMEw1VqDeiVliRUkIZjXVpXStNJMSf4MQ_qRa3MwFs8AMFGsUAFK1Fo-dmdmd7pzihHJk-AUeVzSfKY2NHo9FmM1LjFauySW0hrii9Xv-Wk9NlgFbv_CQyuWc0IIwhi",
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
    const parts = title.split(/<span>|<\/span>/);
    return parts.map((part, idx) =>
      idx % 2 === 1 ? (
        <span key={idx} className="text-gradient-primary">{part}</span>
      ) : (
        <span key={idx}>{part}</span>
      )
    );
  };

  return (
    <header className="relative min-h-[90vh] lg:min-h-screen flex items-center overflow-hidden bg-background" id="hero">
      
      {/* === Absolute Hero Image (Seamless Integration) === */}
      <div className="absolute inset-0 z-0 pointer-events-none">
        <img 
          alt="KeeTech Hero" 
          className="absolute top-1/2 -translate-y-1/2 right-0 w-[150%] md:w-[100%] lg:w-[75%] xl:w-[65%] h-auto max-h-[130vh] object-contain object-right" 
          src={getImageUrl(hero.hero_image, defaultHero.hero_image)}
        />
        {/* Gradients to blend the image seamlessly into the #0A0E1A background */}
        <div className="absolute inset-y-0 left-0 w-full lg:w-[55%] bg-gradient-to-r from-background via-background/95 to-transparent"></div>
        <div className="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-background to-transparent"></div>
        <div className="absolute inset-x-0 top-0 h-32 bg-gradient-to-b from-background via-background/50 to-transparent"></div>
      </div>

      {/* === Text Content Container (Perfectly Aligned with Navbar) === */}
      <div className="relative z-10 max-w-7xl mx-auto px-4 md:px-8 w-full pt-32 pb-20 lg:py-0">
        <motion.div 
          variants={staggerContainer} 
          initial="hidden"
          animate="show" 
          className="max-w-xl lg:max-w-[600px] xl:max-w-[700px]"
        >
          <motion.div variants={fadeUp} className="inline-flex items-center px-4 py-2 rounded-full border border-outline bg-surface/50 backdrop-blur-md text-on-surface-variant text-xs sm:text-sm font-medium tracking-wide mb-6 gap-2">
            <span className="w-2 h-2 rounded-full bg-secondary shadow-[0_0_8px_var(--color-secondary)]"></span>
            {hero.hero_badge}
          </motion.div>
          
          <motion.h1 variants={fadeUp} className="text-4xl sm:text-5xl lg:text-6xl font-bold text-on-background leading-[1.15] mb-6 sm:mb-8 tracking-tight">
            {renderTitle(hero.hero_title)}
          </motion.h1>
          
          <motion.p variants={fadeUp} className="text-on-surface-variant leading-relaxed max-w-lg mb-10 text-base sm:text-lg">
            {hero.hero_description}
          </motion.p>
          
          <motion.div variants={fadeUp} className="flex flex-col sm:flex-row gap-4">
            <a href={hero.hero_cta_primary_link} className="bg-gradient-primary text-background px-8 py-4 rounded-lg font-bold text-base sm:text-lg shadow-[0_4px_24px_rgba(0,191,255,0.3)] flex items-center justify-center gap-2 transition-transform hover:-translate-y-1">
              {hero.hero_cta_primary_text}
              <span className="material-symbols-outlined text-xl">arrow_forward</span>
            </a>
            <a href={hero.hero_cta_secondary_link} className="border border-outline hover:border-primary/50 text-on-background px-8 py-4 rounded-lg font-medium text-base sm:text-lg flex items-center justify-center gap-2 hover:bg-primary/5 transition-colors">
              {hero.hero_cta_secondary_text}
            </a>
          </motion.div>
          
          <motion.div variants={fadeUp} className="flex flex-wrap items-center gap-3 sm:gap-4 text-xs sm:text-sm text-on-surface-variant mt-10">
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

