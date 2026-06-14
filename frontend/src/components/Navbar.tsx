"use client";

import { motion } from "framer-motion";
import { useState, useEffect } from "react";

export default function Navbar({ initialData }: { initialData?: any }) {
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const [activeHash, setActiveHash] = useState("");
  const [companyName, setCompanyName] = useState(initialData?.general?.company_name || "KeeTech");

  useEffect(() => {
    setActiveHash(window.location.hash);
    const handleHashChange = () => setActiveHash(window.location.hash);
    window.addEventListener("hashchange", handleHashChange);
    
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

    return () => window.removeEventListener("hashchange", handleHashChange);
  }, [initialData]);

  const menuItems = ["Beranda", "Layanan", "Tentang", "Portofolio", "Kontak"];

  return (
    <>
      <nav className="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md shadow-lg shadow-black/5">
        <div className="flex justify-between items-center px-4 md:px-8 py-4 max-w-7xl mx-auto">
          <motion.div 
            whileHover={{ scale: 1.05 }} 
            className="text-2xl font-black text-[#800020] tracking-tighter cursor-pointer"
            onClick={() => { window.scrollTo({ top: 0, behavior: 'smooth' }); window.location.hash = ''; }}
          >
            {companyName}
          </motion.div>
          
          <div className="hidden md:flex items-center gap-8">
            {menuItems.map((tab) => {
              const tabHash = tab === "Beranda" ? "" : `#${tab.toLowerCase()}`;
              const isActive = activeHash === tabHash || (tab === "Beranda" && activeHash === "#");
              
              return (
                <a 
                  key={tab}
                  href={tab === "Beranda" ? "#" : tabHash}
                  className={`relative pb-1 font-semibold tracking-tight transition-colors duration-300 ${
                    isActive ? "text-[#800020]" : "text-slate-600 hover:text-[#800020]"
                  }`}
                  onClick={() => setActiveHash(tabHash)}
                >
                  {tab}
                  {isActive && (
                    <motion.div
                      layoutId="nav-underline"
                      className="absolute bottom-0 left-0 right-0 h-[2px] bg-[#800020]"
                      transition={{ type: "spring", bounce: 0.2, duration: 0.6 }}
                    />
                  )}
                </a>
              );
            })}
          </div>
          
          <button className="hidden md:block bg-[#800020] text-white px-6 py-2.5 rounded-full font-bold hover:opacity-80 transition-all duration-300 scale-95 active:scale-90">
            Hubungi Kami
          </button>

          <button 
            className="md:hidden text-primary p-2"
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
          className="fixed top-[72px] left-0 w-full min-h-screen bg-white/95 backdrop-blur-xl z-40 md:hidden flex flex-col px-6 pt-8 pb-32 border-t border-slate-200 shadow-2xl"
        >
          <div className="flex flex-col gap-6">
            {menuItems.map((tab) => (
              <a 
                key={tab}
                className="text-2xl font-bold text-slate-800 hover:text-[#800020] border-b border-slate-100 pb-4" 
                href={tab === "Beranda" ? "#" : `#${tab.toLowerCase()}`}
                onClick={() => setIsMenuOpen(false)}
              >
                {tab}
              </a>
            ))}
          </div>
          <button 
            className="bg-[#800020] text-white w-full py-4 mt-12 rounded-2xl font-bold text-lg shadow-xl shadow-primary/20" 
            onClick={() => setIsMenuOpen(false)}
          >
            Hubungi Kami
          </button>
        </motion.div>
      )}
    </>
  );
}
