"use client";

import { motion, Variants } from "framer-motion";
import { useEffect, useState, useRef } from "react";
import { getTestimonials } from "@/lib/api";
import { getImageUrl } from "@/lib/utils";

const fadeUp: Variants = {
  hidden: { opacity: 0, y: 30 },
  show: { opacity: 1, y: 0, transition: { duration: 0.6, ease: "easeOut" } }
};

const staggerContainer: Variants = {
  hidden: { opacity: 0 },
  show: {
    opacity: 1,
    transition: {
      staggerChildren: 0.15
    }
  }
};

const placeholderTestimonials = [
  { 
    content: "\"KeeTech membantu kami melakukan migrasi server dengan sangat lancar. Tidak ada downtime berarti, dan tim mereka sangat responsif.\"", 
    name: "Andi Pratama", 
    role: "CTO, Jaya Retail Group", 
    image: "https://lh3.googleusercontent.com/aida-public/AB6AXuC2m4w3to0e2AGf5zSa_3eopJHf_cdVU-1vWwSq1SSRmcNRYs2mIHFPOU3UDz-sskjKtNNFvtwX8zzGxsQuGmsX9tza6f4LS-yK32GMS2t9IKySbDd5Q8mTz1_cUcqYd7ePCBgkZ3D4z1unuXpuMQCrse04gS0Xs9QciEBXf27iidU8VdPtGLS9m1AV0-M2wfRvUrwnc7VH18kYUvg5DRwECzGgj7L-9RzM8sapbJnN7iLLfeWZpC8TqlRI5-zo8Umx8vhtPZT9ydBJ",
    rating: 5
  },
  { 
    content: "\"Sistem POS yang dibuat KeeTech sangat user-friendly. Karyawan kami bisa langsung menggunakannya tanpa perlu training lama.\"", 
    name: "Sari Wijaya", 
    role: "Owner, Coffee House JKT", 
    image: "https://lh3.googleusercontent.com/aida-public/AB6AXuA6-9ibvl-35x5YAB_Vls4-38Q4zfeIxdzab7YhPVwPsav-pMvmTSl5woaYQlOPTc8UBeIDlPamUYDvsteWAVrL7mULaxbUga3vxKGaY4qo-2k0q1hzDUQ2-2iOncLfBW-Llm-kWMuINoLpDbLOw7omeqkj8eyDgEUMKMsk0yApbxbK6hwWcTBoNb6Hy8aBcuty_h1it_fxTyZfX5rS3eSfMFUFFyA8rR3ZPremjZ9v5pWMnYw6Hp_55LxQlapQ42lS3gd75sbpI-lc",
    rating: 5
  },
  { 
    content: "\"Layanan maintenance hardware berkala dari KeeTech membuat operasional kantor kami jauh lebih stabil dan produktif.\"", 
    name: "Budi Santoso", 
    role: "Ops Manager, Logistik Maju", 
    image: "https://lh3.googleusercontent.com/aida-public/AB6AXuBtLe-qEl2P5RwdYo1MHKsYJ58tr4sECPS5UCHuwOGKWBTB1Wy_TR03NDGd0ceWX0vxHs-LfIb0B3DEpbyW98_kqFBocU17Ohe6t-IZp_n_u51cxnOUINUj2vo6WZhkOCwf6m9QPkyhGJexL9rI_4UKfhsxfSF-1sWglqWC37-FGONYGlqCDjbASEW0vYNVzQXTe9Gpu8hoN-AUdowlLN5mNT35qUBdch_OO3EuHYVzSgndLbV-65jnfY56dR4xOFYpXBKMD7h7eQOS",
    rating: 5
  }
];

export default function Testimonials({ initialData }: { initialData?: any[] }) {
  const [testimonials, setTestimonials] = useState<any[]>(initialData && initialData.length > 0 ? initialData : []);
  const [isLoading, setIsLoading] = useState(!initialData || initialData.length === 0);
  const [activeIndex, setActiveIndex] = useState(0);
  const scrollRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    if (!initialData || initialData.length === 0) {
      async function fetchData() {
        try {
          const data = await getTestimonials();
          if (Array.isArray(data) && data.length > 0) {
            setTestimonials(data);
          } else {
            setTestimonials(placeholderTestimonials);
          }
        } catch (error) {
          setTestimonials(placeholderTestimonials);
        } finally {
          setIsLoading(false);
        }
      }
      fetchData();
    }
  }, [initialData]);

  // Auto slide every 10 seconds for mobile
  useEffect(() => {
    if (isLoading || testimonials.length <= 1) return;

    const interval = setInterval(() => {
      if (window.innerWidth >= 640) return; // Only auto-slide on mobile

      const nextIndex = (activeIndex + 1) % testimonials.length;
      scrollToIndex(nextIndex);
    }, 10000);

    return () => clearInterval(interval);
  }, [activeIndex, isLoading, testimonials.length]);

  const scrollToIndex = (index: number) => {
    if (scrollRef.current) {
      const container = scrollRef.current;
      const cardWidth = container.offsetWidth * 0.85; // matching w-[85vw]
      const gap = 24; // gap-6
      container.scrollTo({
        left: index * (cardWidth + gap),
        behavior: 'smooth'
      });
      setActiveIndex(index);
    }
  };

  const handleScroll = () => {
    if (scrollRef.current && window.innerWidth < 640) {
      const container = scrollRef.current;
      const cardWidth = container.offsetWidth * 0.85;
      const gap = 24;
      const newIndex = Math.round(container.scrollLeft / (cardWidth + gap));
      if (newIndex !== activeIndex) {
        setActiveIndex(newIndex);
      }
    }
  };

  return (
    <section className="py-20 md:py-24 bg-surface-container-low" id="testimoni">
      <div className="max-w-7xl mx-auto px-4 sm:px-8">
        <motion.div 
          initial={false}
          whileInView="show"
          viewport={{ once: true }}
          variants={staggerContainer}
          className="text-center mb-12 sm:mb-16"
        >
          <motion.h2 variants={fadeUp} className="text-3xl sm:text-4xl lg:text-5xl font-black mb-4 tracking-tight">Apa Kata Klien Kami</motion.h2>
          <motion.p variants={fadeUp} className="text-on-surface-variant max-w-2xl mx-auto px-2 text-sm sm:text-base">
            Kepercayaan Anda adalah prioritas kami. Berikut adalah testimoni dari mitra bisnis kami.
          </motion.p>
        </motion.div>
        
        {isLoading ? (
             <div className="flex justify-center py-20">
                <div className="w-12 h-12 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
             </div>
        ) : (
          <div className="relative">
            <motion.div 
              ref={scrollRef}
              onScroll={handleScroll}
              initial={false}
              whileInView="show"
              viewport={{ once: true }}
              variants={staggerContainer}
              className="flex sm:grid sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 overflow-x-auto pb-8 sm:pb-0 snap-x snap-mandatory scroll-smooth hide-scrollbar"
            >
              {testimonials.map((testi, idx) => (
                  <motion.div 
                    key={testi.id || idx} 
                    variants={fadeUp} 
                    className={`flex-none w-[85vw] sm:w-auto bg-surface-container-lowest p-6 sm:p-10 rounded-3xl shadow-sm border border-outline-variant/10 snap-center ${idx % 3 === 1 ? 'sm:border-primary' : ''}`}
                  >
                  <div className="flex text-secondary-container mb-4 sm:mb-6">
                      {Array.from({length: testi.rating || 5}).map((_, i) => (
                      <span key={i} className="material-symbols-outlined" style={{fontVariationSettings: "'FILL' 1"}}>star</span>
                      ))}
                  </div>
                  <p className="italic text-on-surface-variant mb-6 sm:mb-8 font-medium leading-relaxed text-sm sm:text-base">
                      {testi.content}
                  </p>
                  <div className="flex items-center gap-4">
                      <div className="w-10 h-10 sm:w-12 sm:h-12 bg-surface-container rounded-full overflow-hidden flex-shrink-0 border border-outline-variant/10">
                      <img 
                          alt={testi.name} 
                          src={getImageUrl(testi.image, `https://ui-avatars.com/api/?name=${encodeURIComponent(testi.name || 'User')}&background=random&color=fff&size=150`)} 
                          className="w-full h-full object-cover" 
                      />
                      </div>
                      <div>
                      <p className="font-bold text-sm text-on-surface">{testi.name}</p>
                      <p className="text-xs text-on-surface-variant/60">{testi.role}</p>
                      </div>
                  </div>
                  </motion.div>
              ))}
            </motion.div>

            {/* Dots for mobile */}
            <div className="flex justify-center gap-2 mt-4 sm:hidden">
              {testimonials.map((_, i) => (
                <button
                  key={i}
                  onClick={() => scrollToIndex(i)}
                  className={`w-2 h-2 rounded-full transition-all duration-300 ${activeIndex === i ? 'w-6 bg-primary' : 'bg-outline-variant'}`}
                  aria-label={`Go to slide ${i + 1}`}
                />
              ))}
            </div>
          </div>
        )}
      </div>
    </section>
  );
}
