"use client";

import { motion } from "framer-motion";
import { useState, useEffect } from "react";
import { submitContact, getSettings } from "@/lib/api";
import { SectionShell, SectionBadge, GradientText } from "@/components/SectionBackground";
import { BG, GRADIENT, TEAL, TEXT_MUTED, BORDER_SUBTLE, CARD_BG } from "@/lib/theme";

const inputClass =
  "w-full rounded-lg border bg-white/5 px-4 py-3 text-sm text-white outline-none placeholder:text-white/30 transition-colors focus:border-cyan-400/40 focus:ring-2 focus:ring-cyan-400/20";

export default function Contact() {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    service_type: "IT Service & Maintenance",
    message: "",
  });
  const [status, setStatus] = useState<"idle" | "loading" | "success" | "error">("idle");
  const [contactInfo, setContactInfo] = useState({
    address: "Jl. Teknologi Raya No. 42, Jakarta Selatan, Indonesia",
    phone: "+62 812-3456-7890",
    email: "hello@keetech.co.id",
  });

  useEffect(() => {
    async function fetchContact() {
      try {
        const settings = await getSettings();
        if (settings?.contact) {
          setContactInfo({
            address: settings.contact.company_address || contactInfo.address,
            phone:
              settings.contact.company_phone ||
              settings.contact.company_whatsapp ||
              contactInfo.phone,
            email: settings.contact.company_email || contactInfo.email,
          });
        }
      } catch {}
    }
    fetchContact();
  }, []);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setStatus("loading");
    try {
      const success = await submitContact(formData);
      if (success) {
        setStatus("success");
        setFormData({
          name: "",
          email: "",
          service_type: "IT Service & Maintenance",
          message: "",
        });
      } else {
        setStatus("error");
      }
    } catch {
      setStatus("error");
    }
  };

  const contactItems = [
    { icon: "location_on", label: "Alamat Kantor", value: contactInfo.address },
    { icon: "call", label: "WhatsApp", value: contactInfo.phone },
    { icon: "mail", label: "Email", value: contactInfo.email },
  ];

  return (
    <SectionShell id="kontak" glow="left">
      <div className="grid items-start gap-12 sm:gap-16 lg:grid-cols-2">
        <motion.div
          initial={{ opacity: 0, x: -24 }}
          whileInView={{ opacity: 1, x: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
        >
          <SectionBadge>Hubungi Kami</SectionBadge>
          <h2 className="mb-4 text-3xl font-black tracking-tight text-white sm:mb-6 sm:text-4xl md:text-5xl">
            Siap Memulai{" "}
            <GradientText>Proyek</GradientText> Anda?
          </h2>
          <p className="mb-8 text-base sm:mb-12 sm:text-lg" style={{ color: TEXT_MUTED }}>
            Konsultasikan kebutuhan IT Anda sekarang dan dapatkan penawaran spesial.
          </p>
          <div className="space-y-6 sm:space-y-8">
            {contactItems.map((item) => (
              <div key={item.label} className="flex items-start gap-4">
                <div
                  className="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg sm:h-12 sm:w-12"
                  style={{
                    background: CARD_BG,
                    border: `1px solid ${BORDER_SUBTLE}`,
                  }}
                >
                  <span className="material-symbols-outlined" style={{ color: TEAL }}>
                    {item.icon}
                  </span>
                </div>
                <div>
                  <p className="mb-1 text-sm font-bold text-white sm:text-base">{item.label}</p>
                  <p className="text-xs leading-relaxed sm:text-sm" style={{ color: TEXT_MUTED }}>
                    {item.value}
                  </p>
                </div>
              </div>
            ))}
          </div>
        </motion.div>

        <motion.div
          initial={{ opacity: 0, x: 24 }}
          whileInView={{ opacity: 1, x: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
          className="mt-8 rounded-2xl p-6 sm:rounded-3xl sm:p-10 lg:mt-0"
          style={{
            background: CARD_BG,
            border: `1px solid ${BORDER_SUBTLE}`,
            backdropFilter: "blur(16px)",
          }}
        >
          {status === "success" ? (
            <div className="py-10 text-center">
              <div
                className="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full"
                style={{ background: "rgba(38,255,92,0.15)", color: "#26FF5C" }}
              >
                <span className="material-symbols-outlined text-4xl">check_circle</span>
              </div>
              <h3 className="mb-4 text-2xl font-bold text-white">Pesan Terkirim!</h3>
              <p className="mb-8" style={{ color: TEXT_MUTED }}>
                Terima kasih telah menghubungi kami. Tim kami akan segera merespon pesan Anda.
              </p>
              <button
                onClick={() => setStatus("idle")}
                className="rounded-full px-8 py-3 text-sm font-bold text-white transition-all"
                style={{
                  border: "1.5px solid rgba(255,255,255,0.2)",
                  background: "rgba(0,0,0,0.5)",
                }}
              >
                Kirim Pesan Lain
              </button>
            </div>
          ) : (
            <form onSubmit={handleSubmit} className="space-y-4 sm:space-y-6">
              <div className="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div>
                  <label className="mb-2 block text-xs font-bold text-white/80 sm:text-sm">
                    Nama Lengkap
                  </label>
                  <input
                    required
                    value={formData.name}
                    onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                    className={inputClass}
                    style={{ borderColor: BORDER_SUBTLE }}
                    placeholder="John Doe"
                    type="text"
                  />
                </div>
                <div>
                  <label className="mb-2 block text-xs font-bold text-white/80 sm:text-sm">
                    Email
                  </label>
                  <input
                    required
                    value={formData.email}
                    onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                    className={inputClass}
                    style={{ borderColor: BORDER_SUBTLE }}
                    placeholder="john@example.com"
                    type="email"
                  />
                </div>
              </div>
              <div>
                <label className="mb-2 block text-xs font-bold text-white/80 sm:text-sm">
                  Layanan yang Dibutuhkan
                </label>
                <select
                  value={formData.service_type}
                  onChange={(e) => setFormData({ ...formData, service_type: e.target.value })}
                  className={`${inputClass} appearance-none`}
                  style={{ borderColor: BORDER_SUBTLE, color: "rgba(255,255,255,0.7)" }}
                >
                  <option className="bg-[#040B12]">IT Service & Maintenance</option>
                  <option className="bg-[#040B12]">Infrastruktur & Jaringan</option>
                  <option className="bg-[#040B12]">Software Development</option>
                  <option className="bg-[#040B12]">IT Procurement</option>
                </select>
              </div>
              <div>
                <label className="mb-2 block text-xs font-bold text-white/80 sm:text-sm">
                  Pesan
                </label>
                <textarea
                  required
                  value={formData.message}
                  onChange={(e) => setFormData({ ...formData, message: e.target.value })}
                  className={inputClass}
                  style={{ borderColor: BORDER_SUBTLE }}
                  placeholder="Ceritakan kebutuhan Anda..."
                  rows={4}
                />
              </div>
              {status === "error" && (
                <p className="text-sm italic text-red-400">
                  Gagal mengirim pesan. Silakan coba lagi nanti.
                </p>
              )}
              <button
                disabled={status === "loading"}
                type="submit"
                className="mt-2 w-full rounded-xl py-4 text-sm font-black transition-all disabled:opacity-50 sm:rounded-2xl sm:text-base"
                style={{
                  color: BG,
                  background: GRADIENT,
                  boxShadow: "0 0 28px rgba(0,229,255,0.35)",
                }}
              >
                {status === "loading" ? "MENGIRIM..." : "KIRIM PESAN"}
              </button>
            </form>
          )}
        </motion.div>
      </div>
    </SectionShell>
  );
}
