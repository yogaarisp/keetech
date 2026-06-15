"use client";
import { motion } from "framer-motion";

export default function Hero({ initialData }: { initialData?: any }) {
  const settings = initialData || {};

  return (
    <section className="relative min-h-screen w-full flex items-center bg-black overflow-hidden pt-20">
      <div className="absolute inset-0 opacity-20 pointer-events-none" style={{ backgroundImage: "radial-gradient(#00BFFF 1px, transparent 1px)", backgroundSize: "32px 32px" }} />
      <div className="absolute top-[-10%] right-[-10%] w-[600px] h-[600px] bg-[#00BFFF]/10 blur-[120px] rounded-full pointer-events-none" />
      <div className="absolute bottom-[-10%] left-[-10%] w-[400px] h-[400px] bg-[#32CD32]/10 blur-[100px] rounded-full pointer-events-none" />

      <div className="relative z-10 max-w-7xl mx-auto px-6 w-full grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        
        <motion.div initial={{ opacity: 0, x: -30 }} animate={{ opacity: 1, x: 0 }} transition={{ duration: 0.8 }}>
          <div className="inline-block px-4 py-1.5 mb-6 border border-[#00BFFF]/30 bg-[#00BFFF]/5 rounded-full">
            <span className="text-[10px] font-bold text-[#00BFFF] tracking-[0.2em] uppercase">IT Service and Software Developer Profesional</span>
          </div>

          <h1 className="text-5xl lg:text-7xl font-black text-white leading-[1.1] mb-6 tracking-tight">
            Solusi Digital <span className="text-transparent bg-clip-text bg-gradient-to-r from-[#00BFFF] to-[#32CD32]">Terpadu</span> untuk Bisnis Anda
          </h1>
          
          <p className="text-gray-400 text-lg mb-10 max-w-lg leading-relaxed">
            {settings.hero_description || "Kami menyediakan layanan IT lengkap mulai dari hardware repair, infrastruktur jaringan, hingga pengembangan software kustom."}
          </p>
          
          <div className="flex flex-wrap gap-4 mb-12">
            <a href="#kontak" className="px-8 py-4 rounded-xl font-bold text-black bg-gradient-to-r from-[#00BFFF] to-[#32CD32] shadow-[0_0_20px_rgba(0,191,255,0.3)] hover:scale-105 transition-all">
              KONSULTASI GRATIS
            </a>
            <a href="#layanan" className="px-8 py-4 rounded-xl font-bold text-white border border-white/10 bg-white/5 backdrop-blur-md hover:bg-white/10 transition-all">
              LIHAT LAYANAN
            </a>
          </div>

          <div className="flex items-center gap-6">
            {["Solusi Aman", "Terpercaya", "Profesional"].map((item) => (
              <div key={item} className="flex items-center gap-2">
                <span className="material-symbols-outlined text-[#32CD32] text-sm">verified_user</span>
                <span className="text-xs font-bold text-gray-500 uppercase tracking-widest">{item}</span>
              </div>
            ))}
          </div>
        </motion.div>

        <div className="relative flex justify-center items-center">
          <motion.img 
            initial={{ opacity: 0, scale: 0.8 }} 
            animate={{ opacity: 1, scale: 1 }} 
            transition={{ duration: 1 }}
            src={settings.hero_image || "https://keetech.my.id/storage/settings/o3TGJ3jMXm1q39V267yDKHcYp5XrWISqvqWPCJ4L.png"} 
            alt="Laptop" 
            className="w-full max-w-2xl z-10 relative"
          />

          <FloatingIcon icon="storage" label="DATABASE" color="#00BFFF" top="10%" left="0%" delay={0} />
          <FloatingIcon icon="code" label="" color="#00BFFF" top="-10%" left="20%" delay={0.2} />
          <FloatingIcon icon="cloud" label="CLOUD" color="#00BFFF" top="-5%" right="10%" delay={0.4} />
          <FloatingIcon icon="shield" label="SECURITY" color="#32CD32" bottom="15%" right="0%" delay={0.6} />
        </div>
      </div>
    </section>
  );
}

function FloatingIcon({ icon, label, color, top, left, right, bottom, delay }: any) {
  return (
    <motion.div 
      initial={{ y: 0 }}
      animate={{ y: [0, -20, 0] }}
      transition={{ duration: 5, repeat: Infinity, ease: "easeInOut", delay }}
      className="absolute z-20 flex flex-col items-center gap-2"
      style={{ top, left, right, bottom }}
    >
      <div className="p-4 rounded-2xl border bg-black/80 backdrop-blur-xl shadow-2xl flex items-center justify-center" 
           style={{ borderColor: color + "44", boxShadow: "0 0 30px " + color + "22" }}>
        <span className="material-symbols-outlined" style={{ color, fontSize: 32 }}>{icon}</span>
      </div>
      {label && <span className="text-[10px] font-black tracking-[0.3em]" style={{ color }}>{label}</span>}
    </motion.div>
  );
}
