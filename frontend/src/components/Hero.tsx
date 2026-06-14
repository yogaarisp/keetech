"use client";

import { motion, Variants } from "framer-motion";
import { useEffect, useState } from "react";
import { getSettings } from "@/lib/api";
import { getImageUrl } from "@/lib/utils";
import WaveDivider from "./WaveDivider";

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
  hero_badge: "✦ IT SERVICE & SOFTWARE DEVELOPER PROFESIONAL ✦",
  hero_title: "Solusi Digital <span>Terpadu</span> untuk Bisnis Anda",
  hero_description: "Kami menyediakan layanan IT lengkap — mulai dari perbaikan hardware, infrastruktur jaringan, hingga pengembangan software dan pengadaan perangkat IT.",
  hero_image: "https://lh3.googleusercontent.com/aida-public/AB6AXuCIl5hoAzy8INzWtmGt1XM4TFquA9MKQYaREd-_R7ui-3DK_1nRJPEsfOHiG8mZNGpR6DZusQb3tez5Dvt3NtDhXcSrlmEqiQ3_p17TmNiTqtL_1hO_tuGt75tvr2TWnzZtPQdjYTjzkhaZPwMEw1VqDeiVliRUkIZjXVpXStNJMSf4MQ_qRa3MwFs8AMFGsUAFK1Fo-dmdmd7pzihHJk-AUeVzSfKY2NHo9FmM1LjFauySW0hrii9Xv-Wk9NlgFbv_CQyuWc0IIwhi",
  hero_cta_primary_text: "Konsultasi Gratis",
  hero_cta_primary_link: "#kontak",
  hero_cta_secondary_text: "Lihat Layanan",
  hero_cta_secondary_link: "#layanan",
  hero_floating_title: "Terpercaya",
  hero_floating_subtitle: "ISO 27001 Certified",
};

export default function Hero({ initialData }: { initialData?: any }) {
  const [hero, setHero] = useState(initialData || defaultHero);

  useEffect(() => {
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
            hero_floating_title: settings.hero.hero_floating_title || defaultHero.hero_floating_title,
            hero_floating_subtitle: settings.hero.hero_floating_subtitle || defaultHero.hero_floating_subtitle,
          });
        }
      } catch (error) {}
    }
    fetchData();
  }, []);

  // Parse title to handle <span> tags for styling
  const renderTitle = (title: string) => {
    const parts = title.split(/<span>|<\/span>/);
    return parts.map((part, idx) =>
      idx % 2 === 1 ? (
        <span key={idx} className="text-primary-container">{part}</span>
      ) : (
        <span key={idx}>{part}</span>
      )
    );
  };

  return (
    <header className="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden hero-gradient" id="hero">
      <div className="max-w-7xl mx-auto px-4 sm:px-8 relative z-10">
        <div className="grid lg:grid-cols-12 gap-12 items-center">
          <motion.div 
            variants={staggerContainer} 
            initial={false}
            animate="show" 
            className="lg:col-span-7"
          >
            <motion.span className="inline-flex items-center px-4 py-1.5 rounded-full bg-primary-fixed text-on-primary-fixed text-xs sm:text-sm font-bold tracking-wider mb-6">
              {hero.hero_badge}
            </motion.span>
            <motion.h1 className="text-4xl sm:text-5xl lg:text-7xl font-black text-on-background leading-[1.1] mb-6 sm:mb-8 tracking-tight">
              {renderTitle(hero.hero_title)}
            </motion.h1>
            <motion.p className="text-on-surface-variant leading-relaxed max-w-xl mb-10 text-base sm:text-lg">
              {hero.hero_description}
            </motion.p>
            <motion.div className="flex flex-col sm:flex-row gap-4">
              <a href={hero.hero_cta_primary_link} className="bg-gradient-to-r from-primary-container to-primary text-on-primary px-8 py-4 rounded-lg font-bold text-base sm:text-lg shadow-xl shadow-primary/20 flex items-center justify-center gap-2 transition-transform hover:-translate-y-1">
                <span className="material-symbols-outlined">rocket_launch</span>
                {hero.hero_cta_primary_text}
              </a>
              <a href={hero.hero_cta_secondary_link} className="border-2 border-outline-variant text-primary px-8 py-4 rounded-lg font-bold text-base sm:text-lg flex items-center justify-center gap-2 hover:bg-surface-container-low transition-colors">
                <span className="material-symbols-outlined">list_alt</span>
                {hero.hero_cta_secondary_text}
              </a>
            </motion.div>
          </motion.div>
          
          <motion.div 
            initial={{ opacity: 0, scale: 0.9 }}
            animate={{ opacity: 1, scale: 1 }}
            transition={{ duration: 0.8, ease: "easeOut" }}
            className="lg:col-span-5 relative mt-8 lg:mt-0"
          >
            <div className="relative w-full aspect-square rounded-3xl overflow-hidden shadow-2xl">
              <img 
                alt={`${hero.hero_title} - KeeTech IT Services`} 
                className="w-full h-full object-cover" 
                src={getImageUrl(hero.hero_image, defaultHero.hero_image)}
              />
              <div className="absolute inset-0 bg-gradient-to-t from-primary/30 to-transparent"></div>
            </div>
            {/* Floating Element 1 */}
            <motion.div 
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: 0.8, duration: 0.6 }}
              className="absolute -bottom-6 left-1/2 -translate-x-1/2 sm:left-auto sm:-translate-x-0 sm:-bottom-6 sm:-left-6 w-max max-w-full bg-white p-4 sm:p-6 rounded-2xl shadow-xl border border-outline-variant/10 flex items-center gap-4"
            >
              <div className="w-10 h-10 sm:w-12 sm:h-12 bg-secondary-container rounded-full flex items-center justify-center text-primary flex-shrink-0">
                <span className="material-symbols-outlined">verified</span>
              </div>
              <div>
                <p className="text-sm font-bold text-slate-800">{hero.hero_floating_title}</p>
                <p className="text-xs text-slate-500">{hero.hero_floating_subtitle}</p>
              </div>
            </motion.div>
          </motion.div>
        </div>
      </div>
      <WaveDivider fill="fill-surface-container-low" flip={true} />
    </header>
  );
}
