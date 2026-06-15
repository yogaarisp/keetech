"use client";

import { motion, Variants } from "framer-motion";
import { useEffect, useState, useRef } from "react";
import { getPortfolios } from "@/lib/api";
import { getImageUrl } from "@/lib/utils";
import { SectionShell, SectionBadge, GradientText } from "@/components/SectionBackground";
import { BG, CYAN, GRADIENT, TEXT_MUTED, BORDER_SUBTLE, CARD_BG } from "@/lib/theme";

const fadeUp: Variants = {
  hidden: { opacity: 0, y: 24 },
  show: { opacity: 1, y: 0, transition: { duration: 0.5, ease: "easeOut" } },
};

const staggerContainer: Variants = {
  hidden: { opacity: 0 },
  show: { opacity: 1, transition: { staggerChildren: 0.12 } },
};

const placeholderProjects = [
  {
    image: "https://lh3.googleusercontent.com/aida-public/AB6AXuA_vGlGCWiMgF914N4TyTAXZNyezWksgrjsmtL3UhUOHBgPV5cHhuc_p40WYVWB4PXkNZlA7JxtmYzn4kAY1lkratGS65be1G6yW5ZkUltTh36wSTd3782DHcnyKC-dTEyKEjy47uuDL3b0SOSOuldqv1fUqbpTi9s5W09taCbP3gA7VeUi9Wy2iWJXLAZSv5WteAT8qgoKpw9fiMYXRJ_QX0FOcjEcJ2DvCEKSbigY8E1yFuXYWTJfT-iwvDmfcsebjdGe4WpqxVTR",
    category: { name: "Software Dev" },
    title: "Web POS System Cloud",
    description: "Sistem kasir berbasis cloud dengan integrasi stok inventaris real-time untuk jaringan ritel.",
  },
  {
    image: "https://lh3.googleusercontent.com/aida-public/AB6AXuBJd8NHp_u9BiqV24Zzu-wPetN2LWM0Zc6Z47DsExfi_sP0JKYOGFl9Ab6PlfC9c0u-xofW1zi4vZYmpdXH96Wa4W9KfDRAQ4dfUmAInsgyVP9d0C60bFDlGW-n8okIG6IPYckuip_N5Nm_l7n6K_wY8ky0_Ece3w7pPeE3AJMwIgLJAXdFTgqCZhpqgfTXaudG9dKsZQm8OLrDhVcbD8F_atbH6c5SemsizXHYbqOmEqGpvq-jTqCFOjnooIw-NXnH-wMEPj7OE5zF",
    category: { name: "IT Infra" },
    title: "Enterprise CCTV System",
    description: "Instalasi keamanan terintegrasi dengan akses remote via mobile untuk gedung perkantoran.",
  },
  {
    image: "https://lh3.googleusercontent.com/aida-public/AB6AXuCugpEwQKmtTpsr7SGwTVztQgWurf97olzWK-v-Oz6V-Kb_nnG9fbSHaLfSbs6dRapEzrGQAGWo3-tTHUy048t3vYhINIkovtNokJF3LQhs7WKJ3QA8Tz-A95jHQTegHVy445AjssSvQo-86wfVYaEENuUs_HfrjU5chvnwYWIlSSKA7CQOgA7ixIMKyEMAKvCf5SJ0dTIPmegtJTHbqGLNR99AmqZ0Fv1AMSwrKGKrmYiLMt5Ha6DzlJ53ERISd95NAqLOx7807HLJ",
    category: { name: "Web Design" },
    title: "Premium Company Profile",
    description: "Website profil perusahaan berstandar internasional dengan performa SEO terbaik.",
  },
];

export default function Portfolio({ initialData }: { initialData?: any[] }) {
  const [projects, setProjects] = useState<any[]>(initialData && initialData.length > 0 ? initialData : []);
  const [isLoading, setIsLoading] = useState(!initialData || initialData.length === 0);
  const [activeIndex, setActiveIndex] = useState(0);
  const scrollRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    if (!initialData || initialData.length === 0) {
      async function fetchData() {
        try {
          const data = await getPortfolios();
          if (Array.isArray(data) && data.length > 0) {
            setProjects(data);
          } else {
            setProjects(placeholderProjects);
          }
        } catch {
          setProjects(placeholderProjects);
        } finally {
          setIsLoading(false);
        }
      }
      fetchData();
    }
  }, [initialData]);

  useEffect(() => {
    if (isLoading || projects.length <= 1) return;

    const interval = setInterval(() => {
      if (window.innerWidth >= 640) return;
      scrollToIndex((activeIndex + 1) % projects.length);
    }, 10000);

    return () => clearInterval(interval);
  }, [activeIndex, isLoading, projects.length]);

  const scrollToIndex = (index: number) => {
    if (scrollRef.current) {
      const container = scrollRef.current;
      const cardWidth = container.offsetWidth * 0.85;
      const gap = 24;
      container.scrollTo({ left: index * (cardWidth + gap), behavior: "smooth" });
      setActiveIndex(index);
    }
  };

  const handleScroll = () => {
    if (scrollRef.current && window.innerWidth < 640) {
      const container = scrollRef.current;
      const cardWidth = container.offsetWidth * 0.85;
      const gap = 24;
      const newIndex = Math.round(container.scrollLeft / (cardWidth + gap));
      if (newIndex !== activeIndex) setActiveIndex(newIndex);
    }
  };

  return (
    <SectionShell id="portofolio" glow="center">
      <motion.div
        initial="hidden"
        whileInView="show"
        viewport={{ once: true, margin: "-80px" }}
        variants={staggerContainer}
        className="mb-12 flex flex-col items-start justify-between gap-6 sm:mb-16 md:flex-row md:items-end md:gap-8"
      >
        <div>
          <motion.div variants={fadeUp}>
            <SectionBadge>Portofolio</SectionBadge>
          </motion.div>
          <motion.h2
            variants={fadeUp}
            className="mb-3 text-3xl font-black tracking-tight text-white sm:mb-4 sm:text-4xl lg:text-5xl"
          >
            <GradientText>Portofolio</GradientText> Kami
          </motion.h2>
          <motion.p
            variants={fadeUp}
            className="max-w-xl text-sm sm:text-base"
            style={{ color: TEXT_MUTED }}
          >
            Inovasi digital yang telah kami bangun untuk mendefinisikan ulang efisiensi operasional.
          </motion.p>
        </div>
        <motion.a
          variants={fadeUp}
          href="#kontak"
          className="inline-flex w-full items-center justify-center gap-1.5 rounded-full px-6 py-3 text-center text-sm font-bold md:w-auto"
          style={{
            color: BG,
            background: GRADIENT,
            boxShadow: "0 0 22px rgba(0,229,255,0.35)",
          }}
        >
          Mulai Proyek
          <span className="material-symbols-outlined" style={{ fontSize: 16 }}>
            arrow_forward
          </span>
        </motion.a>
      </motion.div>

      {isLoading ? (
        <div className="flex justify-center py-20">
          <div
            className="h-12 w-12 animate-spin rounded-full border-4 border-t-transparent"
            style={{ borderColor: CYAN, borderTopColor: "transparent" }}
          />
        </div>
      ) : (
        <div className="relative">
          <motion.div
            ref={scrollRef}
            onScroll={handleScroll}
            initial="hidden"
            whileInView="show"
            viewport={{ once: true }}
            variants={staggerContainer}
            className="hide-scrollbar flex snap-x snap-mandatory scroll-smooth gap-6 overflow-x-auto pb-8 sm:grid sm:grid-cols-2 sm:overflow-visible sm:pb-0 lg:grid-cols-3 lg:gap-8"
          >
            {projects.map((proj, idx) => (
              <motion.div
                key={proj.id || idx}
                variants={fadeUp}
                className="group flex-none snap-center sm:w-auto"
                style={{ width: "85vw" }}
              >
                <div
                  className="h-full rounded-2xl p-5 transition-all duration-300 sm:p-6 group-hover:-translate-y-1"
                  style={{
                    background: CARD_BG,
                    border: `1px solid ${BORDER_SUBTLE}`,
                  }}
                  onMouseEnter={(e) => {
                    e.currentTarget.style.borderColor = "rgba(0,229,255,0.25)";
                    e.currentTarget.style.boxShadow = "0 8px 32px rgba(0,229,255,0.08)";
                  }}
                  onMouseLeave={(e) => {
                    e.currentTarget.style.borderColor = BORDER_SUBTLE;
                    e.currentTarget.style.boxShadow = "none";
                  }}
                >
                  <div className="relative mb-4 aspect-video overflow-hidden rounded-xl sm:mb-6">
                    <img
                      alt={proj.title}
                      className="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                      src={getImageUrl(
                        proj.image || proj.img,
                        "https://placehold.co/600x400/040B12/00E5FF?text=" +
                          encodeURIComponent(proj.title || "Portfolio")
                      )}
                    />
                    <div
                      className="absolute inset-0 opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                      style={{
                        background:
                          "linear-gradient(to top, rgba(4,11,18,0.7) 0%, transparent 50%)",
                      }}
                    />
                  </div>
                  <div className="mb-3 flex items-center gap-2">
                    <span
                      className="rounded-full px-3 py-1 text-[10px] font-bold uppercase"
                      style={{
                        background: "rgba(0,229,255,0.1)",
                        color: CYAN,
                        border: "1px solid rgba(0,229,255,0.2)",
                      }}
                    >
                      {proj.category?.name || "Uncategorized"}
                    </span>
                  </div>
                  <h3 className="mb-2 text-lg font-bold text-white sm:text-xl">{proj.title}</h3>
                  <p className="text-xs leading-relaxed sm:text-sm" style={{ color: TEXT_MUTED }}>
                    {proj.description}
                  </p>
                </div>
              </motion.div>
            ))}
          </motion.div>

          <div className="mt-6 flex justify-center gap-2 sm:hidden">
            {projects.map((_, i) => (
              <button
                key={i}
                onClick={() => scrollToIndex(i)}
                className="h-2 rounded-full transition-all duration-300"
                style={{
                  width: activeIndex === i ? 24 : 8,
                  background: activeIndex === i ? CYAN : "rgba(255,255,255,0.15)",
                }}
                aria-label={`Go to slide ${i + 1}`}
              />
            ))}
          </div>
        </div>
      )}
    </SectionShell>
  );
}
