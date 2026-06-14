"use client";

import { motion } from "framer-motion";
import { useState, useEffect } from "react";

const NAV_H = 68; // px — single source of truth for navbar height

export default function Navbar({ initialData }: { initialData?: any }) {
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const [activeHash, setActiveHash] = useState("");
  const [companyName, setCompanyName] = useState(
    initialData?.general?.company_name || "KeeTech"
  );

  useEffect(() => {
    setActiveHash(window.location.hash || "#beranda");
    const onHash = () => setActiveHash(window.location.hash || "#beranda");
    window.addEventListener("hashchange", onHash);

    if (!initialData) {
      (async () => {
        try {
          const { getSettings } = await import("@/lib/api");
          const s = await getSettings();
          if (s?.general?.company_name) setCompanyName(s.general.company_name);
        } catch {}
      })();
    }
    return () => window.removeEventListener("hashchange", onHash);
  }, [initialData]);

  const links = [
    { label: "Beranda",     hash: "#beranda" },
    { label: "Layanan",     hash: "#layanan" },
    { label: "Tentang Kami",hash: "#tentangkami" },
    { label: "Portofolio",  hash: "#portofolio" },
    { label: "Kontak",      hash: "#kontak" },
  ];

  return (
    <>
      {/* ── NAVBAR ── */}
      <nav
        className="fixed top-0 left-0 w-full z-50"
        style={{
          height: NAV_H,
          background: "rgba(6,9,20,0.92)",
          backdropFilter: "blur(12px)",
          WebkitBackdropFilter: "blur(12px)",
          borderBottom: "1px solid rgba(255,255,255,0.05)",
        }}
      >
        <div
          className="flex items-center justify-between h-full w-full"
          style={{ padding: "0 40px" }}
        >
          {/* Logo */}
          <motion.div
            whileHover={{ scale: 1.04 }}
            className="flex items-center gap-2.5 cursor-pointer select-none"
            onClick={() => {
              window.scrollTo({ top: 0, behavior: "smooth" });
              setActiveHash("#beranda");
            }}
          >
            <div
              className="flex items-center justify-center font-black text-[#060914] text-lg"
              style={{
                width: 36, height: 36,
                borderRadius: 10,
                background: "linear-gradient(135deg,#00BFFF,#32CD32)",
                boxShadow: "0 0 14px rgba(0,191,255,0.45)",
                flexShrink: 0,
              }}
            >
              K
            </div>
            <span className="text-xl font-black text-white tracking-tight">
              Kee<span style={{
                background: "linear-gradient(90deg,#00BFFF,#32CD32)",
                WebkitBackgroundClip: "text",
                WebkitTextFillColor: "transparent",
                backgroundClip: "text",
              }}>Tech</span>
            </span>
          </motion.div>

          {/* Desktop nav links */}
          <div className="hidden md:flex items-center gap-8">
            {links.map(({ label, hash }) => {
              const active = activeHash === hash;
              return (
                <a
                  key={hash}
                  href={hash}
                  onClick={() => setActiveHash(hash)}
                  className="relative pb-[3px] text-sm font-medium transition-colors duration-200"
                  style={{ color: active ? "#00BFFF" : "rgba(255,255,255,0.68)" }}
                  onMouseEnter={e => { if (!active) e.currentTarget.style.color = "#fff"; }}
                  onMouseLeave={e => { if (!active) e.currentTarget.style.color = "rgba(255,255,255,0.68)"; }}
                >
                  {label}
                  {active && (
                    <motion.span
                      layoutId="nav-line"
                      className="absolute bottom-0 left-0 right-0"
                      style={{ height: 2, background: "#00BFFF", borderRadius: 2 }}
                      transition={{ type: "spring", stiffness: 380, damping: 36 }}
                    />
                  )}
                </a>
              );
            })}
          </div>

          {/* CTA button */}
          <a
            href="#kontak"
            className="hidden md:inline-flex items-center gap-1.5 font-bold text-sm transition-all"
            style={{
              padding: "10px 22px",
              borderRadius: 999,
              color: "#060914",
              background: "linear-gradient(90deg,#00BFFF,#32CD32)",
              boxShadow: "0 0 18px rgba(0,191,255,0.35)",
            }}
            onMouseEnter={e => { e.currentTarget.style.boxShadow = "0 0 28px rgba(0,191,255,0.55)"; }}
            onMouseLeave={e => { e.currentTarget.style.boxShadow = "0 0 18px rgba(0,191,255,0.35)"; }}
          >
            Konsultasi Gratis
            <span className="material-symbols-outlined" style={{ fontSize: 16 }}>arrow_forward</span>
          </a>

          {/* Mobile burger */}
          <button
            className="md:hidden text-white p-2"
            onClick={() => setIsMenuOpen(!isMenuOpen)}
            aria-label="Toggle menu"
          >
            <span className="material-symbols-outlined text-3xl">
              {isMenuOpen ? "close" : "menu"}
            </span>
          </button>
        </div>
      </nav>

      {/* ── MOBILE MENU ── */}
      {isMenuOpen && (
        <motion.div
          initial={{ opacity: 0, y: -16 }}
          animate={{ opacity: 1, y: 0 }}
          className="fixed left-0 w-full z-40 md:hidden flex flex-col"
          style={{
            top: NAV_H,
            minHeight: `calc(100vh - ${NAV_H}px)`,
            background: "rgba(6,9,20,0.97)",
            backdropFilter: "blur(16px)",
            padding: "32px 24px 48px",
            borderTop: "1px solid rgba(255,255,255,0.06)",
          }}
        >
          <div className="flex flex-col gap-1 mb-10">
            {links.map(({ label, hash }) => (
              <a
                key={hash}
                href={hash}
                className="text-xl font-bold text-white py-4 border-b"
                style={{ borderColor: "rgba(255,255,255,0.06)" }}
                onClick={() => { setIsMenuOpen(false); setActiveHash(hash); }}
              >
                {label}
              </a>
            ))}
          </div>
          <a
            href="#kontak"
            className="text-center font-bold text-base text-[#060914] py-4 rounded-2xl"
            style={{ background: "linear-gradient(90deg,#00BFFF,#32CD32)" }}
            onClick={() => setIsMenuOpen(false)}
          >
            Konsultasi Gratis
          </a>
        </motion.div>
      )}
    </>
  );
}

// Export navbar height so Hero can consume it
export { NAV_H };
