"use client";

import { motion, Variants } from "framer-motion";
import { useEffect, useState } from "react";
import { getSettings } from "@/lib/api";
import { getImageUrl } from "@/lib/utils";
import { NAV_H } from "./Navbar";

/* ─── animation variants ─── */
const fadeUp: Variants = {
  hidden: { opacity: 0, y: 22 },
  show:   { opacity: 1, y: 0, transition: { duration: 0.5, ease: "easeOut" } },
};
const stagger: Variants = {
  hidden: { opacity: 0 },
  show:   { opacity: 1, transition: { staggerChildren: 0.1 } },
};

/* ─── default content ─── */
const defaultHero = {
  hero_badge:             "IT SERVICE & SOFTWARE DEVELOPER PROFESIONAL",
  hero_title:             "Solusi Digital <span>Terpadu</span><br/>untuk Bisnis Anda",
  hero_description:       "Kami menyediakan layanan IT lengkap — mulai dari perbaikan hardware, infrastruktur jaringan, hingga pengembangan software dan pengadaan perangkat IT.",
  hero_image:             "https://keetech.my.id/storage/settings/o3TGJ3jMXm1q39V267yDKHcYp5XrWISqvqWPCJ4L.png",
  hero_cta_primary_text:  "Konsultasi Gratis",
  hero_cta_primary_link:  "#kontak",
  hero_cta_secondary_text:"Lihat Layanan",
  hero_cta_secondary_link:"#layanan",
};

/* ─── gradient text helper ─── */
function GradientText({ children }: { children: React.ReactNode }) {
  return (
    <span style={{
      background: "linear-gradient(90deg,#00BFFF 0%,#32CD32 100%)",
      WebkitBackgroundClip: "text",
      WebkitTextFillColor: "transparent",
      backgroundClip: "text",
    }}>
      {children}
    </span>
  );
}

/* ─── title renderer ─── */
function RenderTitle({ raw }: { raw: string }) {
  if (!raw.includes("<span>")) return <>{raw}</>;
  const parts = raw.split(/(<span>.*?<\/span>|<br\s*\/?>)/i);
  return (
    <>
      {parts.map((p, i) => {
        if (p.toLowerCase().startsWith("<span>"))
          return <GradientText key={i}>{p.replace(/<\/?span>/gi, "")}</GradientText>;
        if (p.toLowerCase().startsWith("<br"))
          return <br key={i} />;
        return <span key={i}>{p}</span>;
      })}
    </>
  );
}

/* ══════════════════════════════════════════════════════════════
   HERO COMPONENT
══════════════════════════════════════════════════════════════ */
export default function Hero({ initialData }: { initialData?: any }) {
  const [hero, setHero] = useState(initialData || defaultHero);

  useEffect(() => {
    if (!initialData) {
      (async () => {
        try {
          const s = await getSettings();
          if (s?.hero) {
            setHero({
              hero_badge:              s.hero.hero_badge              || defaultHero.hero_badge,
              hero_title:              s.hero.hero_title              || defaultHero.hero_title,
              hero_description:        s.hero.hero_description        || defaultHero.hero_description,
              hero_image:              s.hero.hero_image              || defaultHero.hero_image,
              hero_cta_primary_text:   s.hero.hero_cta_primary_text   || defaultHero.hero_cta_primary_text,
              hero_cta_primary_link:   s.hero.hero_cta_primary_link   || defaultHero.hero_cta_primary_link,
              hero_cta_secondary_text: s.hero.hero_cta_secondary_text || defaultHero.hero_cta_secondary_text,
              hero_cta_secondary_link: s.hero.hero_cta_secondary_link || defaultHero.hero_cta_secondary_link,
            });
          }
        } catch {}
      })();
    }
  }, [initialData]);

  return (
    <section
      id="hero"
      className="relative w-full overflow-hidden"
      style={{
        marginTop: NAV_H,
        height: `calc(100vh - ${NAV_H}px)`,
        minHeight: 560,
        /* Dark navy background — matches screenshot exactly */
        background: "#08091A",
      }}
    >

      {/* ── 1. Dot-particle field (whole canvas) ── */}
      <div
        aria-hidden
        className="absolute inset-0 pointer-events-none"
        style={{
          backgroundImage:
            "radial-gradient(circle, rgba(100,200,255,0.18) 1px, transparent 1px)",
          backgroundSize: "28px 28px",
        }}
      />

      {/* ── 2. Coloured glow blobs ── */}
      <div aria-hidden className="absolute inset-0 pointer-events-none overflow-hidden">
        {/* cyan — centre-right, behind laptop */}
        <div style={{ position:"absolute", width:900, height:700, top:"-10%", right:"-8%",
          background:"radial-gradient(ellipse,rgba(0,191,255,0.18) 0%,transparent 70%)", filter:"blur(0px)" }} />
        {/* teal — bottom right */}
        <div style={{ position:"absolute", width:500, height:500, bottom:"-15%", right:"10%",
          background:"radial-gradient(circle,rgba(14,165,138,0.14) 0%,transparent 70%)" }} />
        {/* indigo — top left */}
        <div style={{ position:"absolute", width:600, height:600, top:"-25%", left:"-8%",
          background:"radial-gradient(circle,rgba(45,27,176,0.18) 0%,transparent 70%)" }} />
      </div>

      {/* ── 3. TWO-COLUMN LAYOUT ── */}
      <div className="relative z-10 flex h-full w-full">

        {/* ════ LEFT COLUMN  (42 % width) ════ */}
        <div
          className="flex-none flex items-center"
          style={{ width: "42%", paddingLeft: 72, paddingRight: 32 }}
        >
          <motion.div
            variants={stagger}
            initial="hidden"
            animate="show"
            className="flex flex-col items-start w-full"
          >

            {/* — Badge — */}
            <motion.div
              variants={fadeUp}
              className="inline-flex items-center gap-2 mb-7"
              style={{
                padding: "5px 14px",
                borderRadius: 999,
                border: "1px solid rgba(255,255,255,0.13)",
                background: "rgba(255,255,255,0.04)",
              }}
            >
              <span style={{ fontSize:9, color:"rgba(255,255,255,0.55)" }}>✦</span>
              <span style={{
                fontSize: 10,
                fontWeight: 500,
                letterSpacing: "0.15em",
                color: "rgba(255,255,255,0.52)",
                textTransform: "uppercase",
              }}>
                {hero.hero_badge}
              </span>
              <span style={{ fontSize:9, color:"rgba(255,255,255,0.55)" }}>✦</span>
            </motion.div>

            {/* — Headline — */}
            <motion.h1
              variants={fadeUp}
              className="font-black text-white"
              style={{
                fontSize: "clamp(2.2rem, 3.5vw, 3.25rem)",
                lineHeight: 1.08,
                letterSpacing: "-0.02em",
                marginBottom: 18,
              }}
            >
              <RenderTitle raw={hero.hero_title} />
            </motion.h1>

            {/* — Description — */}
            <motion.p
              variants={fadeUp}
              style={{
                fontSize: "0.88rem",
                color: "rgba(255,255,255,0.46)",
                lineHeight: 1.72,
                maxWidth: 360,
                marginBottom: 30,
              }}
            >
              {hero.hero_description}
            </motion.p>

            {/* — Buttons — */}
            <motion.div variants={fadeUp} className="flex items-center gap-3 mb-9 flex-wrap">
              {/* Primary */}
              <a
                href={hero.hero_cta_primary_link}
                className="inline-flex items-center gap-2 font-bold"
                style={{
                  padding: "12px 24px",
                  borderRadius: 8,
                  fontSize: "0.88rem",
                  color: "#07090F",
                  background: "linear-gradient(90deg,#00BFFF,#32CD32)",
                  boxShadow: "0 0 22px rgba(0,191,255,0.42)",
                  transition: "box-shadow .2s",
                }}
                onMouseEnter={e => e.currentTarget.style.boxShadow = "0 0 36px rgba(0,191,255,0.65)"}
                onMouseLeave={e => e.currentTarget.style.boxShadow = "0 0 22px rgba(0,191,255,0.42)"}
              >
                {hero.hero_cta_primary_text}
                <span className="material-symbols-outlined" style={{ fontSize:17 }}>arrow_forward</span>
              </a>
              {/* Secondary */}
              <a
                href={hero.hero_cta_secondary_link}
                className="inline-flex items-center font-semibold"
                style={{
                  padding: "12px 24px",
                  borderRadius: 8,
                  fontSize: "0.88rem",
                  color: "#fff",
                  border: "1.5px solid rgba(255,255,255,0.24)",
                  background: "rgba(0,0,0,0.55)",
                  transition: "border-color .2s",
                }}
                onMouseEnter={e => e.currentTarget.style.borderColor = "rgba(0,191,255,0.5)"}
                onMouseLeave={e => e.currentTarget.style.borderColor = "rgba(255,255,255,0.24)"}
              >
                {hero.hero_cta_secondary_text}
              </a>
            </motion.div>

            {/* — Trust badges — */}
            <motion.div
              variants={fadeUp}
              className="inline-flex items-center"
              style={{
                padding: "8px 18px",
                borderRadius: 999,
                border: "1px solid rgba(255,255,255,0.1)",
                background: "rgba(0,0,0,0.38)",
                backdropFilter: "blur(8px)",
                gap: 0,
              }}
            >
              {[
                { label: "Solusi Aman" },
                { label: "Terpercaya" },
                { label: "Profesional" },
              ].map((item, i) => (
                <span key={item.label} className="inline-flex items-center">
                  {i > 0 && (
                    <span style={{
                      margin: "0 10px",
                      color: "rgba(255,255,255,0.28)",
                      fontSize: 13,
                    }}>•</span>
                  )}
                  <span
                    className="material-symbols-outlined"
                    style={{ fontSize: 13, color: "#129E92", marginRight: 4 }}
                  >
                    verified_user
                  </span>
                  <span style={{ fontSize: 12, color: "rgba(255,255,255,0.65)", fontWeight: 500 }}>
                    {item.label}
                  </span>
                </span>
              ))}
            </motion.div>

          </motion.div>
        </div>

        {/* ════ RIGHT COLUMN  (58 % width) ════ */}
        <div className="flex-1 relative overflow-hidden">
          <motion.div
            initial={{ opacity: 0, x: 56, scale: 0.93 }}
            animate={{ opacity: 1, x: 0, scale: 1 }}
            transition={{ duration: 1.05, ease: [0.22, 1, 0.36, 1], delay: 0.08 }}
            className="absolute inset-0 flex items-center justify-center"
          >
            <img
              src={getImageUrl(hero.hero_image, defaultHero.hero_image)}
              alt="KeeTech Hero"
              className="select-none pointer-events-none"
              style={{
                width: "100%",
                height: "100%",
                objectFit: "contain",
                objectPosition: "center",
                mixBlendMode: "lighten",
                /* fade gently on the left edge only — no clipping top/bottom */
                WebkitMaskImage:
                  "linear-gradient(to right, transparent 0%, rgba(0,0,0,0.6) 8%, black 22%)",
                maskImage:
                  "linear-gradient(to right, transparent 0%, rgba(0,0,0,0.6) 8%, black 22%)",
              }}
            />
          </motion.div>
        </div>

      </div>
    </section>
  );
}
