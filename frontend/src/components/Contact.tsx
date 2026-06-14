"use client";

import { motion } from "framer-motion";
import { useState, useEffect } from "react";
import { submitContact, getSettings } from "@/lib/api";

export default function Contact() {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    service_type: "IT Service & Maintenance",
    message: ""
  });
  const [status, setStatus] = useState<'idle' | 'loading' | 'success' | 'error'>('idle');
  const [contactInfo, setContactInfo] = useState({
    address: "Jl. Teknologi Raya No. 42, Jakarta Selatan, Indonesia",
    phone: "+62 812-3456-7890",
    email: "hello@keetech.co.id"
  });

  useEffect(() => {
    async function fetchContact() {
      try {
        const settings = await getSettings();
        if (settings?.contact) {
          setContactInfo({
            address: settings.contact.company_address || contactInfo.address,
            phone: settings.contact.company_phone || settings.contact.company_whatsapp || contactInfo.phone,
            email: settings.contact.company_email || contactInfo.email
          });
        }
      } catch (e) {}
    }
    fetchContact();
  }, []);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setStatus('loading');
    try {
      const success = await submitContact(formData);
      if (success) {
        setStatus('success');
        setFormData({ name: "", email: "", service_type: "IT Service & Maintenance", message: "" });
      } else {
        setStatus('error');
      }
    } catch (error) {
      setStatus('error');
    }
  };

  return (
    <section className="py-20 md:py-24 bg-gradient-to-br from-[#800020] to-[#1A1A2E] text-white" id="kontak">
      <div className="max-w-7xl mx-auto px-4 sm:px-8">
        <div className="grid lg:grid-cols-2 gap-12 sm:gap-16 items-start">
          <motion.div 
            initial={{ opacity: 0, x: -30 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.6 }}
          >
            <h2 className="text-3xl sm:text-4xl md:text-5xl font-black mb-4 sm:mb-8 tracking-tight">Siap Memulai Proyek Anda?</h2>
            <p className="text-primary-fixed-dim text-base sm:text-lg mb-8 sm:mb-12">Konsultasikan kebutuhan IT Anda sekarang dan dapatkan penawaran spesial.</p>
            <div className="space-y-6 sm:space-y-8">
              <div className="flex items-start gap-4">
                <div className="w-10 h-10 sm:w-12 sm:h-12 glass-card rounded-lg flex items-center justify-center flex-shrink-0">
                  <span className="material-symbols-outlined text-secondary-container">location_on</span>
                </div>
                <div>
                  <p className="font-bold mb-1 text-sm sm:text-base">Alamat Kantor</p>
                  <p className="text-slate-300 text-xs sm:text-sm leading-relaxed">{contactInfo.address}</p>
                </div>
              </div>
              <div className="flex items-start gap-4">
                <div className="w-10 h-10 sm:w-12 sm:h-12 glass-card rounded-lg flex items-center justify-center flex-shrink-0">
                  <span className="material-symbols-outlined text-secondary-container">call</span>
                </div>
                <div>
                  <p className="font-bold mb-1 text-sm sm:text-base">WhatsApp</p>
                  <p className="text-slate-300 text-xs sm:text-sm">{contactInfo.phone}</p>
                </div>
              </div>
              <div className="flex items-start gap-4">
                <div className="w-10 h-10 sm:w-12 sm:h-12 glass-card rounded-lg flex items-center justify-center flex-shrink-0">
                  <span className="material-symbols-outlined text-secondary-container">mail</span>
                </div>
                <div>
                  <p className="font-bold mb-1 text-sm sm:text-base">Email</p>
                  <p className="text-slate-300 text-xs sm:text-sm">{contactInfo.email}</p>
                </div>
              </div>
            </div>
          </motion.div>
          
          <motion.div 
            initial={{ opacity: 0, x: 30 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.6 }}
            className="glass-card p-6 sm:p-10 rounded-2xl sm:rounded-3xl mt-8 lg:mt-0"
          >
            {status === 'success' ? (
              <div className="text-center py-10">
                <div className="w-20 h-20 bg-green-500/20 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                  <span className="material-symbols-outlined text-4xl">check_circle</span>
                </div>
                <h3 className="text-2xl font-bold mb-4">Pesan Terkirim!</h3>
                <p className="text-slate-300 mb-8">Terima kasih telah menghubungi kami. Tim kami akan segera merespon pesan Anda.</p>
                <button 
                  onClick={() => setStatus('idle')}
                  className="bg-white/10 hover:bg-white/20 px-8 py-3 rounded-full font-bold transition-all"
                >
                  Kirim Pesan Lain
                </button>
              </div>
            ) : (
              <form onSubmit={handleSubmit} className="space-y-4 sm:space-y-6">
                <div className="grid sm:grid-cols-2 gap-4 sm:gap-6">
                  <div>
                    <label className="block text-xs sm:text-sm font-bold mb-2 text-slate-200">Nama Lengkap</label>
                    <input 
                      required
                      value={formData.name}
                      onChange={(e) => setFormData({...formData, name: e.target.value})}
                      className="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 focus:ring-2 focus:ring-secondary-container text-white placeholder:text-slate-500 text-sm outline-none" 
                      placeholder="John Doe" 
                      type="text"
                    />
                  </div>
                  <div>
                    <label className="block text-xs sm:text-sm font-bold mb-2 text-slate-200">Email</label>
                    <input 
                      required
                      value={formData.email}
                      onChange={(e) => setFormData({...formData, email: e.target.value})}
                      className="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 focus:ring-2 focus:ring-secondary-container text-white placeholder:text-slate-500 text-sm outline-none" 
                      placeholder="john@example.com" 
                      type="email"
                    />
                  </div>
                </div>
                <div>
                  <label className="block text-xs sm:text-sm font-bold mb-2 text-slate-200">Layanan yang Dibutuhkan</label>
                  <select 
                    value={formData.service_type}
                    onChange={(e) => setFormData({...formData, service_type: e.target.value})}
                    className="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 focus:ring-2 focus:ring-secondary-container text-slate-300 text-sm outline-none appearance-none"
                  >
                    <option className="bg-[#1A1A2E]">IT Service & Maintenance</option>
                    <option className="bg-[#1A1A2E]">Infrastruktur & Jaringan</option>
                    <option className="bg-[#1A1A2E]">Software Development</option>
                    <option className="bg-[#1A1A2E]">IT Procurement</option>
                  </select>
                </div>
                <div>
                  <label className="block text-xs sm:text-sm font-bold mb-2 text-slate-200">Pesan</label>
                  <textarea 
                    required
                    value={formData.message}
                    onChange={(e) => setFormData({...formData, message: e.target.value})}
                    className="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 focus:ring-2 focus:ring-secondary-container text-white placeholder:text-slate-500 text-sm outline-none" 
                    placeholder="Ceritakan kebutuhan Anda..." 
                    rows={4}
                  ></textarea>
                </div>
                {status === 'error' && <p className="text-red-400 text-sm italic">Gagal mengirim pesan. Silakan coba lagi nanti.</p>}
                <button 
                  disabled={status === 'loading'}
                  type="submit" 
                  className="w-full bg-secondary-container text-primary font-black py-4 rounded-xl sm:rounded-2xl hover:brightness-110 transition-all shadow-lg shadow-black/20 text-sm sm:text-base mt-2 disabled:opacity-50"
                >
                  {status === 'loading' ? 'MENGIRIM...' : 'KIRIM PESAN'}
                </button>
              </form>
            )}
          </motion.div>
        </div>
      </div>
    </section>
  );
}
