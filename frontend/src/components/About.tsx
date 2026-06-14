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

const defaultReasons = [
  { title: "Harga Transparan", desc: "Tidak ada biaya tersembunyi. Semua estimasi diberikan secara jujur dan detail." },
  { title: "Dukungan 24/7", desc: "Tim teknis kami selalu siap siaga membantu operasional bisnis Anda kapanpun." },
  { title: "Garansi Layanan", desc: "Kami menjamin kualitas setiap pekerjaan dengan perlindungan garansi resmi." }
];

const defaultStats = [
  { val: "50+", label: "Klien Aktif" },
  { val: "200+", label: "Proyek Selesai" },
  { val: "99%", label: "Kepuasan Klien" },
  { val: "24/7", label: "Support Siaga" }
];

const defaultAbout = {
  heading: "Mengapa Memilih KeeTech?",
  image: "https://lh3.googleusercontent.com/aida-public/AB6AXuBHqP99601yHucGH8xXrprN4LmD7jXf2SaupqYmYuWkLS40cqrr6UDo-0PEOvTsALGh1RxtVCJoq8pOAwBSIrEhOCbNNpKre9nGULK9g4Q3TUoB2JHrJILCYOqwaKJothu6hmkNG9UVTfApp21w3fPux3nzpIkWIINAg88pCBl9oOnLqISX-wTkPf0am3TbIq1Jq8-C9U_e30Jzvo3b54aB1h4zn3eZU7nKkJ_IvutrE-Y_K_RuB6MvtQRI6PHFtAzNDxQ4ES4vdkF0",
  experienceYears: "5+",
};

export default function About({ initialData }: { initialData?: any }) {
  const [stats, setStats] = useState<any[]>(() => {
    if (initialData?.stats) {
      const s = initialData.stats;
      return [
        { val: s.stat_clients || defaultStats[0].val, label: "Klien Aktif" },
        { val: s.stat_projects || defaultStats[1].val, label: "Proyek Selesai" },
        { val: s.stat_satisfaction || defaultStats[2].val, label: "Kepuasan Klien" },
        { val: s.stat_support || defaultStats[3].val, label: "Support Siaga" }
      ];
    }
    return defaultStats;
  });

  const [reasons, setReasons] = useState<any[]>(() => {
    if (initialData?.features) {
      const f = initialData.features;
      return [
        { title: f.why_title_1 || defaultReasons[0].title, desc: f.why_desc_1 || defaultReasons[0].desc },
        { title: f.why_title_2 || defaultReasons[1].title, desc: f.why_desc_2 || defaultReasons[1].desc },
        { title: f.why_title_3 || defaultReasons[2].title, desc: f.why_desc_3 || defaultReasons[2].desc },
      ];
    }
    return defaultReasons;
  });

  const [about, setAbout] = useState(() => {
    if (initialData?.about) {
      return {
        heading: initialData.about.about_heading || defaultAbout.heading,
        image: initialData.about.about_image || defaultAbout.image,
        experienceYears: initialData.about.about_experience_years || defaultAbout.experienceYears,
      };
    }
    return defaultAbout;
  });

  useEffect(() => {
    if (!initialData) {
      async function fetchData() {
        try {
          const settings = await getSettings();
          if (settings?.stats) {
            const s = settings.stats;
            setStats([
              { val: s.stat_clients || "50+", label: "Klien Aktif" },
              { val: s.stat_projects || "200+", label: "Proyek Selesai" },
              { val: s.stat_satisfaction || "99%", label: "Kepuasan Klien" },
              { val: s.stat_support || "24/7", label: "Support Siaga" }
            ]);
          }
          if (settings?.features) {
            const f = settings.features;
            setReasons([
              { title: f.why_title_1 || defaultReasons[0].title, desc: f.why_desc_1 || defaultReasons[0].desc },
              { title: f.why_title_2 || defaultReasons[1].title, desc: f.why_desc_2 || defaultReasons[1].desc },
              { title: f.why_title_3 || defaultReasons[2].title, desc: f.why_desc_3 || defaultReasons[2].desc },
            ]);
          }
          if (settings?.about) {
            setAbout({
              heading: settings.about.about_heading || defaultAbout.heading,
              image: settings.about.about_image || defaultAbout.image,
              experienceYears: settings.about.about_experience_years || defaultAbout.experienceYears,
            });
          }
        } catch (error) {}
      }
      fetchData();
    }
  }, [initialData]);

  return (
    <section className="py-20 md:py-24 bg-surface" id="tentang">
      <div className="max-w-7xl mx-auto px-4 sm:px-8">
        <div className="grid lg:grid-cols-2 gap-12 sm:gap-16 items-center mb-16 sm:mb-20">
          <motion.div 
            initial={false}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.6 }}
            className="relative order-2 lg:order-1"
          >
            <div className="aspect-square rounded-3xl overflow-hidden shadow-2xl">
              <img 
                alt={`${about.heading} - KeeTech Professional IT Team`} 
                className="w-full h-full object-cover" 
                src={getImageUrl(about.image, defaultAbout.image)}
              />
            </div>
            <div className="absolute -right-4 -top-6 sm:-right-6 sm:-top-6 w-28 h-28 sm:w-40 sm:h-40 bg-secondary-container rounded-2xl p-4 sm:p-5 flex flex-col justify-end text-primary shadow-xl border border-white/20">
              <span className="text-2xl sm:text-4xl font-black">{about.experienceYears}</span>
              <span className="font-bold text-[10px] sm:text-xs leading-tight">Tahun Pengalaman</span>
            </div>
          </motion.div>
          
          <motion.div
            initial={false}
            whileInView="show"
            viewport={{ once: true }}
            variants={staggerContainer}
            className="order-1 lg:order-2"
          >
            <motion.h2 variants={fadeUp} className="text-3xl sm:text-4xl font-black mb-6 sm:mb-8 leading-tight tracking-tight text-slate-800">
              {about.heading}
            </motion.h2>
            <ul className="space-y-4 sm:space-y-6">
              {reasons.map((item, idx) => (
                <motion.li variants={fadeUp} key={idx} className="flex gap-3 sm:gap-4">
                  <div className="flex-shrink-0 w-6 h-6 sm:w-8 sm:h-8 bg-primary text-on-primary rounded-full flex items-center justify-center mt-1">
                    <span className="material-symbols-outlined text-xs sm:text-base">check</span>
                  </div>
                  <div>
                    <p className="font-bold text-base sm:text-lg text-slate-800">{item.title}</p>
                    <p className="text-on-surface-variant text-sm mt-1">{item.desc}</p>
                  </div>
                </motion.li>
              ))}
            </ul>
          </motion.div>
        </div>
        
        {/* Stats Bar */}
        <motion.div 
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
          className="bg-primary-container rounded-3xl p-6 sm:p-12 grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 text-on-primary text-center"
        >
          {stats.map((stat, idx) => (
            <div key={idx} className="flex flex-col items-center">
              <div className="text-3xl sm:text-4xl font-black mb-1">{stat.val}</div>
              <div className="text-on-primary-container text-xs sm:text-sm font-medium uppercase tracking-widest">{stat.label}</div>
            </div>
          ))}
        </motion.div>
      </div>
    </section>
  );
}
