"use client";
import { useState, useEffect } from "react";

export default function Navbar({ initialData }: { initialData?: any }) {
  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    const handleScroll = () => setScrolled(window.scrollY > 20);
    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  const links = [
    { name: "Beranda", href: "#beranda" },
    { name: "Layanan", href: "#layanan" },
    { name: "Tentang Kami", href: "#tentangkami" },
    { name: "Portofolio", href: "#portofolio" },
    { name: "Kontak", href: "#kontak" },
  ];

  return (
    <nav className={`fixed top-0 left-0 w-full z-50 transition-all duration-300 ${scrolled ? "bg-black/80 backdrop-blur-lg border-b border-white/5 py-4" : "bg-transparent py-6"}`}>
      <div className="max-w-7xl mx-auto px-6 flex items-center justify-between">
        
        <div className="flex items-center gap-3 cursor-pointer" onClick={() => window.scrollTo(0,0)}>
          <div className="w-10 h-10 rounded-full bg-[#129E92] flex items-center justify-center shadow-[0_0_15px_rgba(18,158,146,0.5)]">
            <span className="text-black font-black text-xl">K</span>
          </div>
          <span className="text-2xl font-bold text-white tracking-tighter">
            Kee<span className="text-[#129E92]">Tech</span>
          </span>
        </div>

        <div className="hidden md:flex items-center gap-8">
          {links.map((link) => (
            <a key={link.name} href={link.href} className="text-sm font-medium text-gray-300 hover:text-[#00BFFF] transition-colors uppercase tracking-widest">
              {link.name}
            </a>
          ))}
        </div>

        <a href="#kontak" className="hidden md:block px-6 py-2.5 rounded-full text-xs font-bold text-black bg-gradient-to-r from-[#00BFFF] to-[#32CD32] hover:shadow-[0_0_20px_rgba(0,191,255,0.4)] transition-all">
          KONSULTASI GRATIS
        </a>
      </div>
    </nav>
  );
}
