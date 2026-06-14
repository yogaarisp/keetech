"use client";

import { motion } from "framer-motion";
import { useState, useEffect } from "react";

export default function Navbar({ initialData }: { initialData?: any }) {
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const [activeHash, setActiveHash] = useState("");
  const [companyName, setCompanyName] = useState(initialData?.general?.company_name || "KEETECH");

  useEffect(() => {
    setActiveHash(window.location.hash);
    const handleHashChange = () => setActiveHash(window.location.hash);
    window.addEventListener("hashchange", handleHashChange);
    
    if (!initialData) {
      async function fetchSettings() {
        try {
          const { getSettings } = await import("@/lib/api");
          const settings = await getSettings();
          if (settings?.general?.company_name) {
            setCompanyName(settings.general.company_name);
          }
        } catch (e) {}
      }
      fetchSettings();
    }

    return () => window.removeEventListener("hashchange", handleHashChange);
  }, [initialData]);

  const menuItems = ["Beranda", "Layanan", "Tentang Kami", "Portofolio", "Kontak"];

  return (
    <>
      <nav className="fixed top-0 w-full z-50 bg-background/80 backdrop-blur-md">
        <div className="flex justify-between items-center px-4 md:px-8 py-4 max-w-7xl mx-auto">
          <motion.div 
            whileHover={{ scale: 1.05 }} 
            className="text-2xl font-black text-on-background tracking-tighter cursor-pointer flex items-center gap-2"
            onClick={() => { window.scrollTo({ top: 0, behavior: 'smooth' }); window.location.hash = ''; }}
          >
            {/* Minimalist Logo Icon representation */}
            <div className="w-8 h-8 rounded-lg bg-gradient-primary flex items-center justify-center text-background font-black text-lg">
              K
            </div>
            {companyName}
          </motion.div>
          
          <div className="hidden md:flex items-center gap-8">
            {menuItems.map((tab) => {
              const tabHash = tab === "Beranda" ? "" : `#${tab.toLowerCase().replace(" ", "")}`;
              const isActive = activeHash === tabHash || (tab === "Beranda" && activeHash === "#");
              
              return (
                <a 
                  key={tab}
                  href={tab === "Beranda" ? "#" : tabHash}
                  className={`relative pb-1 font-semibold tracking-tight transition-colors duration-300 ${
                    isActive ? "text-primary" : "text-on-surface-variant hover:text-on-background"
                  }`}
                  onClick={() => setActiveHash(tabHash)}
                >
                  {tab}
                  {isActive && (
                    <motion.div
                      layoutId="nav-underline"
                      className="absolute bottom-0 left-0 right-0 h-[2px] bg-primary"
                      transition={{ type: "spring", bounce: 0.2, duration: 0.6 }}
                    />
                  )}
                </a>
              );
            })}
          </div>
          
          <a href="#kontak" className="hidden md:flex bg-gradient-primary text-background px-6 py-2.5 rounded-full font-bold hover:opacity-90 transition-all duration-300 scale-95 active:scale-90 items-center gap-1 shadow-[0_0_15px_rgba(0,191,255,0.2)]">
            Konsultasi Gratis <span className="material-symbols-outlined text-sm">arrow_forward</span>
          </a>

          <button 
            className="md:hidden text-on-background p-2"
            onClick={() => setIsMenuOpen(!isMenuOpen)}
            aria-label="Toggle Menu"
          >
            <span className="material-symbols-outlined text-3xl">
              {isMenuOpen ? "close" : "menu"}
            </span>
          </button>
        </div>
      </nav>

      {isMenuOpen && (
        <motion.div 
          initial={{ opacity: 0, y: -20 }}
          animate={{ opacity: 1, y: 0 }}
          className="fixed top-[72px] left-0 w-full min-h-screen bg-surface/95 backdrop-blur-xl z-40 md:hidden flex flex-col px-6 pt-8 pb-32 border-t border-outline-variant shadow-2xl"
        >
          <div className="flex flex-col gap-6">
            {menuItems.map((tab) => (
              <a 
                key={tab}
                className="text-2xl font-bold text-on-background hover:text-primary border-b border-outline-variant pb-4" 
                href={tab === "Beranda" ? "#" : `#${tab.toLowerCase().replace(" ", "")}`}
                onClick={() => setIsMenuOpen(false)}
              >
                {tab}
              </a>
            ))}
          </div>
          <a href="#kontak"
            className="bg-gradient-primary text-background text-center w-full py-4 mt-12 rounded-2xl font-bold text-lg shadow-[0_4px_24px_rgba(0,191,255,0.3)]" 
            onClick={() => setIsMenuOpen(false)}
          >
            Konsultasi Gratis
          </a>
        </motion.div>
      )}
    </>
  );
}

