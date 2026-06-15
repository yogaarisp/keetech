"use client";

import { motion, Variants } from "framer-motion";
import { useEffect, useState } from "react";
import { getSettings } from "@/lib/api";
import { getImageUrl } from "@/lib/utils";
import { SectionShell, SectionBadge, GradientText } from "@/components/SectionBackground";
import { BG, GRADIENT, TEXT_MUTED, BORDER_SUBTLE, CARD_BG } from "@/lib/theme";

const fadeUp: Variants = {
  hidden: { opacity: 0, y: 24 },
  show: { opacity: 1, y: 0, transition: { duration: 0.5, ease: "easeOut" } },
};

const staggerContainer: Variants = {
  hidden: { opacity: 0 },
  show: { opacity: 1, transition: { staggerChildren: 0.12 } },
};

const defaultReasons = [
  { title: "Harga Transparan", desc: "Tidak ada biaya tersembunyi. Semua estimasi diberikan secara jujur dan detail." },
  { title: "Dukungan 24/7", desc: "Tim teknis kami selalu siap siaga membantu operasional bisnis Anda kapanpun." },
  { title: "Garansi Layanan", desc: "Kami menjamin kualitas setiap pekerjaan dengan perlindungan garansi resmi." },
];

const defaultStats = [
  { val: "50+", label: "Klien Aktif" },
  { val: "200+", label: "Proyek Selesai" },
  { val: "99%", label: "Kepuasan Klien" },
  { val: "24/7", label: "Support Siaga" },
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
        { val: s.stat_support || defaultStats[3].val, label: "Support Siaga" },
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
              { val: s.stat_support || "24/7", label: "Support Siaga" },
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
        } catch {}
      }
      fetchData();
    }
  }, [initialData]);

  return (
    <SectionShell id="tentangkami" glow="left">
      <div className="mb-16 grid items-center gap-12 sm:mb-20 sm:gap-16 lg:grid-cols-2">
        <motion.div
          initial={{ opacity: 0, x: -24 }}
          whileInView={{ opacity: 1, x: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
          className="relative order-2 lg:order-1"
        >
          <div
            className="aspect-square overflow-hidden rounded-2xl"
            style={{
              border: `1px solid ${BORDER_SUBTLE}`,
              boxShadow: "0 24px 48px rgba(0,0,0,0.4), 0 0 40px rgba(0,229,255,0.06)",
            }}
          >
            <img
              alt={`${about.heading} - KeeTech Professional IT Team`}
              className="h-full w-full object-cover"
              src={getImageUrl(about.image, defaultAbout.image)}
            />
          </div>
          <div
            className="absolute -right-4 -top-6 flex flex-col justify-end rounded-xl p-4 sm:-right-6 sm:-top-6 sm:p-5"
            style={{
              width: "7rem",
              height: "7rem",
              background: GRADIENT,
              boxShadow: "0 8px 32px rgba(0,229,255,0.35)",
            }}
          >
            <span className="text-2xl font-black sm:text-4xl" style={{ color: BG }}>
              {about.experienceYears}
            </span>
            <span className="text-[10px] font-bold leading-tight sm:text-xs" style={{ color: BG }}>
              Tahun Pengalaman
            </span>
          </div>
        </motion.div>

        <motion.div
          initial="hidden"
          whileInView="show"
          viewport={{ once: true }}
          variants={staggerContainer}
          className="order-1 lg:order-2"
        >
          <motion.div variants={fadeUp}>
            <SectionBadge>Tentang Kami</SectionBadge>
          </motion.div>
          <motion.h2
            variants={fadeUp}
            className="mb-6 text-3xl font-black leading-tight tracking-tight text-white sm:mb-8 sm:text-4xl"
          >
            {about.heading.includes("KeeTech") ? (
              <>
                {about.heading.split("KeeTech")[0]}
                <GradientText>KeeTech</GradientText>
                {about.heading.split("KeeTech")[1]}
              </>
            ) : (
              about.heading
            )}
          </motion.h2>
          <ul className="space-y-4 sm:space-y-6">
            {reasons.map((item, idx) => (
              <motion.li variants={fadeUp} key={idx} className="flex gap-3 sm:gap-4">
                <div
                  className="mt-1 flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-full sm:h-8 sm:w-8"
                  style={{ background: GRADIENT }}
                >
                  <span className="material-symbols-outlined text-xs sm:text-base" style={{ color: BG }}>
                    check
                  </span>
                </div>
                <div>
                  <p className="text-base font-bold text-white sm:text-lg">{item.title}</p>
                  <p className="mt-1 text-sm" style={{ color: TEXT_MUTED }}>
                    {item.desc}
                  </p>
                </div>
              </motion.li>
            ))}
          </ul>
        </motion.div>
      </div>

      <motion.div
        initial={{ opacity: 0, y: 24 }}
        whileInView={{ opacity: 1, y: 0 }}
        viewport={{ once: true }}
        transition={{ duration: 0.6 }}
        className="grid grid-cols-2 gap-6 rounded-2xl p-6 sm:gap-8 sm:p-12 md:grid-cols-4"
        style={{
          background: CARD_BG,
          border: `1px solid ${BORDER_SUBTLE}`,
          backdropFilter: "blur(16px)",
        }}
      >
        {stats.map((stat, idx) => (
          <div key={idx} className="flex flex-col items-center text-center">
            <div className="mb-1 text-3xl font-black sm:text-4xl">
              <GradientText>{stat.val}</GradientText>
            </div>
            <div
              className="text-xs font-medium uppercase tracking-widest sm:text-sm"
              style={{ color: TEXT_MUTED }}
            >
              {stat.label}
            </div>
          </div>
        ))}
      </motion.div>
    </SectionShell>
  );
}
