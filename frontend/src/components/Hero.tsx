"use client";

import { motion, Variants } from "framer-motion";
import { useEffect, useState } from "react";
import { getSettings } from "@/lib/api";
import { getImageUrl } from "@/lib/utils";

const NAV_H = 72;
const NAV_H_FLOAT = 58;
const SCROLL_THRESHOLD = 80;
const GRADIENT = "linear-gradient(90deg, #2DD4BF 0%, #34D399 100%)";
const BG = "#01030D";
const BG_RGB = "1, 3, 13";

const fadeUp: Variants = {
  hidden: { opacity: 1, y: 14 },
  show: { opacity: 1, y: 0, transition: { duration: 0.5, ease: "easeOut" } },
};
const stagger: Variants = {
  hidden: {},
  show: { transition: { staggerChildren: 0.09 } },
};

const defaultHero = {
  hero_badge: "IT SERVICE & SOFTWARE DEVELOPER PROFESIONAL",
  hero_title: "Solusi Digital<br/><span>Terpadu</span><br/>untuk Bisnis Anda",
  hero_description:
    "Kami menyediakan layanan IT lengkap ΓÇö mulai dari perbaikan hardware, infrastruktur jaringan, hingga pengembangan software dan pengadaan perangkat IT.",
  hero_image:
    "https://keetech.my.id/storage/settings/o3TGJ3jMXm1q39V267yDKHcYp5XrWISqvqWPCJ4L.png",
  hero_cta_primary_text: "Konsultasi Gratis",
  hero_cta_primary_link: "#kontak",
  hero_cta_secondary_text: "Lihat Layanan",
  hero_cta_secondary_link: "#layanan",
};

const navLinks = [
  { label: "Beranda", hash: "#beranda" },
  { label: "Layanan", hash: "#layanan" },
  { label: "Tentang Kami", hash: "#tentangkami" },
  { label: "Portofolio", hash: "#portofolio" },
  { label: "Kontak", hash: "#kontak" },
];

function mergeHero(data?: Partial<typeof defaultHero>) {
  const merged = { ...defaultHero, ...(data || {}) };
  merged.hero_title = normalizeTitle(merged.hero_title);
  return merged;
}

function normalizeTitle(title: string) {
  if (title.includes("<br")) return title;
  if (title.includes("<span>")) {
    return title
      .replace(/<span>/i, "<br/><span>")
      .replace(/<\/span>/i, "</span><br/>")
      .replace(/<br\/>\s*$/, "");
  }
  return title;
}

function GradientText({ children }: { children: React.ReactNode }) {
  return (
    <span
      style={{
        background: GRADIENT,
        WebkitBackgroundClip: "text",
        WebkitTextFillColor: "transparent",
        backgroundClip: "text",
      }}
    >
      {children}
    </span>
  );
}

function RenderTitle({ raw }: { raw: string }) {
  const parts = raw.split(/(<span>.*?<\/span>|<br\s*\/?>)/i);
  return (
    <>
      {parts.map((p, i) => {
        if (p.toLowerCase().startsWith("<span>"))
          return (
            <GradientText key={i}>{p.replace(/<\/?span>/gi, "")}</GradientText>
          );
        if (p.toLowerCase().startsWith("<br")) return <br key={i} />;
        if (p) return <span key={i}>{p}</span>;
        return null;
      })}
    </>
  );
}

function HeroBackground({ imageSrc }: { imageSrc: string }) {
  return (
    <>
      {/* Scene laptop ΓÇö background kanan, menyatu dengan header */}
      <div
        aria-hidden
        className="pointer-events-none absolute inset-0 overflow-hidden flex justify-center"
        style={{ background: BG }}
      >
        <div className="relative w-full max-w-[1440px] h-full">
          <img
            src={imageSrc}
            alt=""
            fetchPriority="high"
            className="absolute top-1/2 -translate-y-1/2 select-none object-contain object-right
              right-[-4%] h-[72%] w-auto min-w-[95%] max-w-none opacity-70
              sm:right-0 sm:h-[80%] sm:min-w-[80%] sm:opacity-85
              lg:right-[clamp(24px,4vw,56px)] lg:h-[108%] lg:min-w-[58%] lg:max-w-[76%] lg:opacity-100"
          />
        </div>
        {/* Gradasi kiri ΓÇö transisi halus ke area teks, plus atas/bawah/kanan agar blend dengan header/footer */}
        <div
          className="absolute inset-0"
          style={{
            background: `
              linear-gradient(102deg, ${BG} 0%, ${BG} 26%, rgba(${BG_RGB}, 0.98) 36%, rgba(${BG_RGB}, 0.72) 48%, rgba(${BG_RGB}, 0.28) 60%, transparent 76%),
              linear-gradient(to bottom, ${BG} 0%, rgba(${BG_RGB}, 0.8) 10%, transparent 25%, transparent 75%, rgba(${BG_RGB}, 0.8) 90%, ${BG} 100%),
              linear-gradient(to left, ${BG} -5%, transparent 20%)
            `
          }}
        />
      </div>

      {/* Dot grid ΓÇö satu pola di seluruh header + hero */}
      <div
        aria-hidden
        className="pointer-events-none absolute inset-0"
        style={{
          backgroundImage:
            "radial-gradient(circle, rgba(45,212,191,0.13) 1px, transparent 1px)",
          backgroundSize: "26px 26px",
        }}
      />

      {/* Glow cyan ΓÇö match atmosfer gambar laptop */}
      <div aria-hidden className="pointer-events-none absolute inset-0 overflow-hidden">
        <div
          style={{
            position: "absolute",
            width: "55%",
            height: "85%",
            top: "-5%",
            right: "-5%",
            background:
              "radial-gradient(ellipse at 65% 45%, rgba(45,212,191,0.12) 0%, transparent 62%)",
          }}
        />
        <div
          style={{
            position: "absolute",
            width: "35%",
            height: "45%",
            bottom: 0,
            right: "8%",
            background:
              "radial-gradient(ellipse at bottom, rgba(45,212,191,0.08) 0%, transparent 70%)",
          }}
        />
      </div>
    </>
  );
}

const getBaseUrl = () => {
  return process.env.NEXT_PUBLIC_BACKEND_URL || (process.env.NEXT_PUBLIC_API_URL || "").replace(/\/api\/v1\/?$/, "") || "http://localhost:8000";
};

export default function Hero({ initialData }: { initialData?: any }) {
  const [hero, setHero] = useState(() => mergeHero(initialData?.hero));
  const [companyName, setCompanyName] = useState(
    initialData?.general?.company_name || "KeeTech"
  );
  const [companyLogo, setCompanyLogo] = useState<string | null>(
    initialData?.general?.company_logo
      ? (initialData.general.company_logo.startsWith("http")
          ? initialData.general.company_logo
          : `${getBaseUrl()}/storage/${initialData.general.company_logo}`)
      : null
  );
  const [scrolled, setScrolled] = useState(false);
  const [menuOpen, setMenuOpen] = useState(false);
  const [activeHash, setActiveHash] = useState("#beranda");
  const [mounted, setMounted] = useState(false);

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > SCROLL_THRESHOLD);
    const onHash = () => setActiveHash(window.location.hash || "#beranda");

    onScroll();
    onHash();
    setMounted(true);
    window.addEventListener("scroll", onScroll, { passive: true });
    window.addEventListener("hashchange", onHash);

    if (!initialData) {
      (async () => {
        try {
          const s = await getSettings();
          if (s?.hero) setHero(mergeHero(s.hero));
          if (s?.general?.company_name) setCompanyName(s.general.company_name);
          if (s?.general?.company_logo) {
            const logo = s.general.company_logo;
            setCompanyLogo(logo.startsWith("http") ? logo : `${getBaseUrl()}/storage/${logo}`);
          }
        } catch { }
      })();
    }

    return () => {
      window.removeEventListener("scroll", onScroll);
      window.removeEventListener("hashchange", onHash);
    };
  }, [initialData]);

  return (
    <>
      {/* ΓöÇΓöÇ Unified header + hero ΓÇö satu canvas ΓöÇΓöÇ */}
      <section
        id="beranda"
        className="relative w-full overflow-hidden"
        style={{ background: BG }}
      >
        <HeroBackground
          imageSrc={getImageUrl(hero.hero_image, defaultHero.hero_image)}
        />

        {/* Navbar ΓÇö transparan di atas, jadi floating pill saat scroll */}
        <header
          className="fixed left-0 right-0 z-50 flex justify-center transition-[padding] duration-500 ease-out"
          style={{
            top: 0,
            padding: scrolled ? "14px 20px 0" : "0",
          }}
        >
          <motion.div
            layout
            className="relative flex w-full items-center"
            initial={false}
            animate={{
              maxWidth: scrolled ? 920 : 1440,
              height: scrolled ? NAV_H_FLOAT : NAV_H,
              borderRadius: scrolled ? 999 : 0,
            }}
            transition={{ duration: 0.48, ease: [0.22, 1, 0.36, 1] }}
            style={{
              padding: scrolled ? "0 22px" : "0 clamp(24px, 4vw, 56px)",
              background: scrolled ? `rgba(${BG_RGB}, 0.78)` : "transparent",
              backdropFilter: scrolled ? "blur(20px) saturate(1.4)" : "none",
              WebkitBackdropFilter: scrolled ? "blur(20px) saturate(1.4)" : "none",
              border: scrolled
                ? "1px solid rgba(255,255,255,0.1)"
                : "1px solid transparent",
              boxShadow: scrolled
                ? "0 10px 40px rgba(0,0,0,0.42), 0 0 0 1px rgba(255,255,255,0.04), inset 0 1px 0 rgba(255,255,255,0.06)"
                : "none",
            }}
          >
            <motion.a
              href="#beranda"
              className="z-10 flex items-center gap-2.5"
              onClick={() => setActiveHash("#beranda")}
              animate={{ scale: scrolled ? 0.94 : 1 }}
              transition={{ duration: 0.35 }}
            >
              {companyLogo ? (
                <div
                  className="flex shrink-0 items-center justify-center rounded-full overflow-hidden"
                  style={{
                    width: scrolled ? 32 : 36,
                    height: scrolled ? 32 : 36,
                    boxShadow: scrolled
                      ? "0 0 12px rgba(45,212,191,0.35)"
                      : "0 0 16px rgba(45,212,191,0.5)",
                    transition: "all 0.35s ease",
                  }}
                >
                  <img src={companyLogo} alt={companyName} className="w-full h-full object-contain" fetchPriority="high" />
                </div>
              ) : (
                <div
                  className="flex shrink-0 items-center justify-center rounded-full font-black text-white"
                  style={{
                    width: scrolled ? 32 : 36,
                    height: scrolled ? 32 : 36,
                    background: GRADIENT,
                    boxShadow: scrolled
                      ? "0 0 12px rgba(45,212,191,0.35)"
                      : "0 0 16px rgba(45,212,191,0.5)",
                    fontSize: scrolled ? "0.9rem" : "1rem",
                    transition: "all 0.35s ease",
                  }}
                >
                  K
                </div>
              )}
              <span
                className="font-black tracking-tight text-white"
                style={{
                  fontSize: scrolled ? "1.05rem" : "1.15rem",
                  transition: "font-size 0.35s ease",
                }}
              >
                {companyName}
              </span>
            </motion.a>

            <nav className="absolute left-1/2 hidden -translate-x-1/2 items-center gap-8 md:flex">
              {navLinks.map(({ label, hash }) => {
                const active = activeHash === hash;
                return (
                  <a
                    key={hash}
                    href={hash}
                    onClick={() => setActiveHash(hash)}
                    className="relative pb-0.5 text-[0.875rem] font-medium transition-colors duration-300"
                    style={{
                      color: scrolled
                        ? active
                          ? "#fff"
                          : "rgba(255,255,255,0.55)"
                        : active
                          ? "#fff"
                          : "rgba(255,255,255,0.8)",
                    }}
                    onMouseEnter={(e) => {
                      e.currentTarget.style.color = "#fff";
                    }}
                    onMouseLeave={(e) => {
                      if (!active)
                        e.currentTarget.style.color = scrolled
                          ? "rgba(255,255,255,0.55)"
                          : "rgba(255,255,255,0.8)";
                    }}
                  >
                    {label}
                    {active && mounted && (
                      <motion.span
                        layoutId="hero-nav-line"
                        className="absolute -bottom-0.5 left-0 right-0 h-0.5 rounded-full"
                        style={{ background: "#2DD4BF" }}
                        transition={{ type: "spring", stiffness: 380, damping: 32 }}
                      />
                    )}
                  </a>
                );
              })}
            </nav>

            <div className="z-10 ml-auto flex items-center gap-2">
              <motion.a
                href="#kontak"
                className="hidden items-center gap-1.5 text-[0.875rem] font-bold md:inline-flex"
                animate={{
                  boxShadow: scrolled
                    ? "0 2px 12px rgba(45,212,191,0.25)"
                    : "0 0 22px rgba(45,212,191,0.4)",
                }}
                transition={{ duration: 0.35 }}
                style={{
                  padding: scrolled ? "8px 18px" : "9px 20px",
                  borderRadius: 999,
                  color: BG,
                  background: GRADIENT,
                }}
              >
                Konsultasi Gratis
                <span className="material-symbols-outlined" style={{ fontSize: 15 }}>
                  arrow_forward
                </span>
              </motion.a>
              <button
                className="p-1.5 text-white md:hidden"
                onClick={() => setMenuOpen(!menuOpen)}
                aria-label="Menu"
              >
                <span className="material-symbols-outlined text-[1.75rem]">
                  {menuOpen ? "close" : "menu"}
                </span>
              </button>
            </div>
          </motion.div>
        </header>

        {/* Mobile menu */}
        {menuOpen && (
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            className="fixed inset-0 z-40 flex flex-col md:hidden"
            style={{
              background: `rgba(${BG_RGB}, 0.97)`,
              paddingTop: scrolled ? NAV_H_FLOAT + 28 : NAV_H,
            }}
          >
            <div className="flex flex-col px-6 py-4">
              {navLinks.map(({ label, hash }) => (
                <a
                  key={hash}
                  href={hash}
                  className="border-b border-white/5 py-4 text-lg font-semibold text-white"
                  onClick={() => {
                    setMenuOpen(false);
                    setActiveHash(hash);
                  }}
                >
                  {label}
                </a>
              ))}
              <a
                href="#kontak"
                className="mt-6 rounded-full py-3.5 text-center font-bold"
                style={{ background: GRADIENT, color: BG }}
                onClick={() => setMenuOpen(false)}
              >
                Konsultasi Gratis
              </a>
            </div>
          </motion.div>
        )}

        {/* Hero content ΓÇö teks di kiri, visual dari background */}
        <div
          className="relative z-10 mx-auto w-full max-w-[1440px]"
          style={{
            marginTop: NAV_H,
            padding: "16px clamp(24px, 4vw, 56px) 28px",
          }}
        >
          <motion.div
            variants={stagger}
            initial="hidden"
            animate="show"
            className="w-full lg:w-[46%] lg:max-w-[500px]"
          >
            <motion.div
              variants={fadeUp}
              className="mb-4 inline-flex items-center gap-2"
              style={{
                padding: "5px 14px",
                borderRadius: 999,
                border: "1px solid rgba(255,255,255,0.14)",
                background: "rgba(255,255,255,0.03)",
              }}
            >
              <span style={{ fontSize: 8, color: "rgba(255,255,255,0.45)" }}>Γ£ª</span>
              <span
                style={{
                  fontSize: 9.5,
                  fontWeight: 500,
                  letterSpacing: "0.16em",
                  color: "rgba(255,255,255,0.5)",
                  textTransform: "uppercase",
                }}
              >
                {(hero.hero_badge || "").replace(/Γ£ª/g, "").trim()}
              </span>
              <span style={{ fontSize: 8, color: "rgba(255,255,255,0.45)" }}>Γ£ª</span>
            </motion.div>

            <motion.h1
              variants={fadeUp}
              className="mb-3 font-black leading-[1.08] tracking-[-0.02em] text-white"
              style={{ fontSize: "clamp(2rem, 4vw, 3.25rem)" }}
            >
              <RenderTitle raw={hero.hero_title} />
            </motion.h1>

            <motion.p
              variants={fadeUp}
              className="mb-5 max-w-[400px] leading-[1.7]"
              style={{
                fontSize: "0.9rem",
                color: "rgba(255,255,255,0.48)",
              }}
            >
              {hero.hero_description}
            </motion.p>
            <motion.div variants={fadeUp} className="mb-5 flex flex-row gap-3">
              <a
                href={hero.hero_cta_primary_link}
                className="inline-flex items-center justify-center gap-2 font-bold"
                style={{
                  padding: "12px 24px",
                  borderRadius: 10,
                  fontSize: "0.875rem",
                  color: BG,
                  background: GRADIENT,
                  boxShadow: "0 0 28px rgba(45,212,191,0.45)",
                }}
              >
                {hero.hero_cta_primary_text}
                <span className="material-symbols-outlined" style={{ fontSize: 16 }}>
                  arrow_forward
                </span>
              </a>
              <a
                href={hero.hero_cta_secondary_link}
                className="inline-flex items-center justify-center gap-2 font-bold"
                style={{
                  padding: "12px 24px",
                  borderRadius: 10,
                  fontSize: "0.875rem",
                  color: "rgba(255,255,255,0.7)",
                  border: "1px solid rgba(255,255,255,0.1)",
                }}
              >
                {hero.hero_cta_secondary_text}
                <span className="material-symbols-outlined" style={{ fontSize: 16 }}>
                  east
                </span>
              </a>
            </motion.div>

            <motion.div
              variants={fadeUp}
              className="inline-flex flex-wrap items-center"
              style={{
                padding: "8px 18px",
                borderRadius: 999,
                border: "1px solid rgba(255,255,255,0.09)",
                background: "rgba(0,0,0,0.35)",
              }}
            >
              {["Solusi Aman", "Terpercaya", "Profesional"].map((label, i) => (
                <span key={label} className="inline-flex items-center">
                  {i > 0 && (
                    <span className="mx-2.5 text-white/25 text-[13px]"></span>
                  )}
                  <span
                    className="material-symbols-outlined mr-1"
                    style={{ fontSize: 13, color: "#129E92" }}
                  >
                    verified_user
                  </span>
                  <span
                    className="text-[12px] font-medium"
                    style={{ color: "rgba(255,255,255,0.62)" }}
                  >
                    {label}
                  </span>
                </span>
              ))}
            </motion.div>
          </motion.div>
        </div>
      </section>
    </>
  );
}

export { NAV_H };
