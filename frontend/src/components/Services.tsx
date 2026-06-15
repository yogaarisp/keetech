"use client";

import { motion, Variants } from "framer-motion";
import { useEffect, useState, useRef } from "react";
import { getServices } from "@/lib/api";
import { SectionShell, SectionBadge, GradientText } from "@/components/SectionBackground";
import { BG, CYAN, GRADIENT, TEAL, TEXT_MUTED, BORDER_SUBTLE, CARD_BG } from "@/lib/theme";

const fadeUp: Variants = {
  hidden: { opacity: 0, y: 24 },
  show: { opacity: 1, y: 0, transition: { duration: 0.5, ease: "easeOut" } },
};

const staggerContainer: Variants = {
  hidden: { opacity: 0 },
  show: { opacity: 1, transition: { staggerChildren: 0.12 } },
};

const placeholderServices = [
  { icon: "desktop_windows", title: "IT Service", features: ["Hardware Repair", "Maintenance", "OS Installation"] },
  { icon: "lan", title: "IT Infra", features: ["CCTV System", "Networking", "Server Setup"] },
  { icon: "code", title: "IT Programmer", features: ["Web & App Dev", "SaaS Solution", "Custom Softwares"] },
  { icon: "inventory_2", title: "Procurement", features: ["Hardware Supply", "Device Lifecycle", "IT Sourcing"] },
];

export default function Services({ initialData }: { initialData?: any[] }) {
  const [services, setServices] = useState<any[]>(initialData && initialData.length > 0 ? initialData : []);
  const [isLoading, setIsLoading] = useState(!initialData || initialData.length === 0);
  const [activeIndex, setActiveIndex] = useState(0);
  const scrollRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    if (!initialData || initialData.length === 0) {
      async function fetchData() {
        try {
          const data = await getServices();
          if (Array.isArray(data) && data.length > 0) {
            setServices(data);
          } else {
            setServices(placeholderServices);
          }
        } catch {
          setServices(placeholderServices);
        } finally {
          setIsLoading(false);
        }
      }
      fetchData();
    }
  }, [initialData]);

  useEffect(() => {
    if (isLoading || services.length <= 1) return;

    const interval = setInterval(() => {
      if (window.innerWidth >= 640) return;
      scrollToIndex((activeIndex + 1) % services.length);
    }, 10000);

    return () => clearInterval(interval);
  }, [activeIndex, isLoading, services.length]);

  const scrollToIndex = (index: number) => {
    if (scrollRef.current) {
      const container = scrollRef.current;
      const cardWidth = container.offsetWidth * 0.8;
      const gap = 24;
      container.scrollTo({ left: index * (cardWidth + gap), behavior: "smooth" });
      setActiveIndex(index);
    }
  };

  const handleScroll = () => {
    if (scrollRef.current && window.innerWidth < 640) {
      const container = scrollRef.current;
      const cardWidth = container.offsetWidth * 0.8;
      const gap = 24;
      const newIndex = Math.round(container.scrollLeft / (cardWidth + gap));
      if (newIndex !== activeIndex) setActiveIndex(newIndex);
    }
  };

  return (
    <SectionShell id="layanan" glow="right" className="!py-12 md:!py-16">
      <motion.div
        initial="hidden"
        whileInView="show"
        viewport={{ once: true, margin: "-80px" }}
        variants={staggerContainer}
        className="mb-12 text-center sm:mb-16"
      >
        <motion.div variants={fadeUp} className="flex justify-center">
          <SectionBadge>Layanan Profesional</SectionBadge>
        </motion.div>
        <motion.h2
          variants={fadeUp}
          className="mb-4 text-3xl font-black tracking-tight text-white sm:text-4xl lg:text-5xl"
        >
          <GradientText>Layanan</GradientText> Kami
        </motion.h2>
        <motion.p
          variants={fadeUp}
          className="mx-auto max-w-2xl px-2 text-sm sm:text-base"
          style={{ color: TEXT_MUTED }}
        >
          Kami menghadirkan spektrum layanan IT yang luas untuk mendukung transformasi digital bisnis Anda secara menyeluruh.
        </motion.p>
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
          <div
            ref={scrollRef}
            onScroll={handleScroll}
            className="hide-scrollbar flex snap-x snap-mandatory scroll-smooth gap-6 overflow-x-auto pb-8 sm:grid sm:grid-cols-2 sm:overflow-visible sm:pb-0 lg:grid-cols-4"
          >
            {services.map((service, idx) => (
              <div
                key={service.id || idx}
                className="group flex-none snap-center w-[80vw] sm:w-auto"
              >
                <div
                  className="h-full rounded-2xl p-6 transition-all duration-300 sm:p-8 group-hover:-translate-y-1"
                  style={{
                    background: CARD_BG,
                    border: `1px solid ${BORDER_SUBTLE}`,
                    boxShadow: "0 0 0 0 rgba(45,212,191,0)",
                  }}
                  onMouseEnter={(e) => {
                    e.currentTarget.style.borderColor = "rgba(45,212,191,0.25)";
                    e.currentTarget.style.boxShadow = "0 8px 32px rgba(45,212,191,0.08)";
                  }}
                  onMouseLeave={(e) => {
                    e.currentTarget.style.borderColor = BORDER_SUBTLE;
                    e.currentTarget.style.boxShadow = "0 0 0 0 rgba(45,212,191,0)";
                  }}
                >
                  <div
                    className="mb-6 flex h-12 w-12 items-center justify-center rounded-xl sm:h-14 sm:w-14"
                    style={{
                      background: GRADIENT,
                      boxShadow: "0 0 20px rgba(45,212,191,0.3)",
                    }}
                  >
                    <span
                      className="material-symbols-outlined text-2xl sm:text-3xl"
                      style={{ color: BG }}
                    >
                      {service.icon}
                    </span>
                  </div>
                  <h3 className="mb-4 text-lg font-bold text-white sm:text-xl">{service.title}</h3>
                  <ul className="space-y-3 text-sm" style={{ color: TEXT_MUTED }}>
                    {(Array.isArray(service.features) ? service.features : []).map(
                      (feature: string, fIdx: number) => (
                        <li key={fIdx} className="flex items-center gap-2">
                          <span
                            className="material-symbols-outlined text-sm"
                            style={{ color: TEAL }}
                          >
                            check_circle
                          </span>
                          {feature}
                        </li>
                      )
                    )}
                  </ul>
                </div>
              </div>
            ))}
          </div>

          <div className="mt-4 flex justify-center gap-2 sm:hidden">
            {services.map((_, i) => (
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
