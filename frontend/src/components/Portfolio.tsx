"use client";

import { motion, Variants } from "framer-motion";
import { useEffect, useState, useRef } from "react";
import { getPortfolios } from "@/lib/api";
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

const placeholderProjects = [
  { 
    image: "https://lh3.googleusercontent.com/aida-public/AB6AXuA_vGlGCWiMgF914N4TyTAXZNyezWksgrjsmtL3UhUOHBgPV5cHhuc_p40WYVWB4PXkNZlA7JxtmYzn4kAY1lkratGS65be1G6yW5ZkUltTh36wSTd3782DHcnyKC-dTEyKEjy47uuDL3b0SOSOuldqv1fUqbpTi9s5W09taCbP3gA7VeUi9Wy2iWJXLAZSv5WteAT8qgoKpw9fiMYXRJ_QX0FOcjEcJ2DvCEKSbigY8E1yFuXYWTJfT-iwvDmfcsebjdGe4WpqxVTR", 
    category: { name: "Software Dev" }, 
    title: "Web POS System Cloud", 
    description: "Sistem kasir berbasis cloud dengan integrasi stok inventaris real-time untuk jaringan ritel." 
  },
  { 
    image: "https://lh3.googleusercontent.com/aida-public/AB6AXuBJd8NHp_u9BiqV24Zzu-wPetN2LWM0Zc6Z47DsExfi_sP0JKYOGFl9Ab6PlfC9c0u-xofW1zi4vZYmpdXH96Wa4W9KfDRAQ4dfUmAInsgyVP9d0C60bFDlGW-n8okIG6IPYckuip_N5Nm_l7n6K_wY8ky0_Ece3w7pPeE3AJMwIgLJAXdFTgqCZhpqgfTXaudG9dKsZQm8OLrDhVcbD8F_atbH6c5SemsizXHYbqOmEqGpvq-jTqCFOjnooIw-NXnH-wMEPj7OE5zF", 
    category: { name: "IT Infra" }, 
    title: "Enterprise CCTV System", 
    description: "Instalasi keamanan terintegrasi dengan akses remote via mobile untuk gedung perkantoran." 
  },
  { 
    image: "https://lh3.googleusercontent.com/aida-public/AB6AXuCugpEwQKmtTpsr7SGwTVztQgWurf97olzWK-v-Oz6V-Kb_nnG9fbSHaLfSbs6dRapEzrGQAGWo3-tTHUy048t3vYhINIkovtNokJF3LQhs7WKJ3QA8Tz-A95jHQTegHVy445AjssSvQo-86wfVYaEENuUs_HfrjU5chvnwYWIlSSKA7CQOgA7ixIMKyEMAKvCf5SJ0dTIPmegtJTHbqGLNR99AmqZ0Fv1AMSwrKGKrmYiLMt5Ha6DzlJ53ERISd95NAqLOx7807HLJ", 
    category: { name: "Web Design" }, 
    title: "Premium Company Profile", 
    description: "Website profil perusahaan berstandar internasional dengan performa SEO terbaik." 
  }
];

export default function Portfolio({ initialData }: { initialData?: any[] }) {
  const [projects, setProjects] = useState<any[]>(initialData && initialData.length > 0 ? initialData : []);
  const [isLoading, setIsLoading] = useState(!initialData || initialData.length === 0);
  const [activeIndex, setActiveIndex] = useState(0);
  const scrollRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    if (!initialData || initialData.length === 0) {
      async function fetchData() {
        try {
          const data = await getPortfolios();
          if (Array.isArray(data) && data.length > 0) {
            setProjects(data);
          } else {
            setProjects(placeholderProjects);
          }
        } catch (error) {
          setProjects(placeholderProjects);
        } finally {
          setIsLoading(false);
        }
      }
      fetchData();
    }
  }, [initialData]);

  // Auto slide every 10 seconds for mobile
  useEffect(() => {
    if (isLoading || projects.length <= 1) return;

    const interval = setInterval(() => {
      if (window.innerWidth >= 640) return; // Only auto-slide on mobile

      const nextIndex = (activeIndex + 1) % projects.length;
      scrollToIndex(nextIndex);
    }, 10000);

    return () => clearInterval(interval);
  }, [activeIndex, isLoading, projects.length]);

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
    <section className="py-20 md:py-24 bg-[#1A1A2E] text-white overflow-hidden relative" id="portofolio">
      <div className="max-w-7xl mx-auto px-4 sm:px-8 relative z-10">
        <motion.div 
          initial={false}
          whileInView="show"
          viewport={{ once: true }}
          variants={staggerContainer}
          className="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 sm:mb-16 gap-6 sm:gap-8"
        >
          <div>
            <motion.h2 variants={fadeUp} className="text-3xl sm:text-4xl lg:text-5xl font-black mb-3 sm:mb-4 tracking-tight">Portofolio Kami</motion.h2>
            <motion.p variants={fadeUp} className="text-slate-400 max-w-xl text-sm sm:text-base">Inovasi digital yang telah kami bangun untuk mendefinisikan ulang efisiensi operasional.</motion.p>
          </div>
          <motion.button variants={fadeUp} className="bg-white/10 hover:bg-white/20 px-6 py-3 rounded-full font-bold transition-colors w-full md:w-auto text-center">
            Lihat Semua Proyek
          </motion.button>
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
              {projects.map((proj, idx) => (
                <motion.div 
                  key={proj.id || idx} 
                  variants={fadeUp} 
                  className="flex-none w-[85vw] sm:w-auto glass-card p-5 sm:p-6 rounded-3xl group snap-center"
                >
                  <div className="rounded-2xl overflow-hidden mb-4 sm:mb-6 aspect-video relative">
                    <img 
                      alt={proj.title} 
                      className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                      src={getImageUrl(proj.image || proj.img, "https://placehold.co/600x400/1A1A2E/FFFFFF?text=" + encodeURIComponent(proj.title || 'Portfolio'))} 
                    />
                  </div>
                  <div className="flex items-center gap-2 mb-3">
                    <span className="px-3 py-1 bg-secondary-container text-primary text-[10px] font-bold uppercase rounded-full">
                      {proj.category?.name || "Uncategorized"}
                    </span>
                  </div>
                  <h3 className="text-lg sm:text-xl font-bold mb-2">{proj.title}</h3>
                  <p className="text-slate-400 text-xs sm:text-sm leading-relaxed mb-4">{proj.description}</p>
                </motion.div>
              ))}
            </motion.div>

            {/* Dots for mobile */}
            <div className="flex justify-center gap-2 mt-6 sm:hidden">
              {projects.map((_, i) => (
                <button
                  key={i}
                  onClick={() => scrollToIndex(i)}
                  className={`w-2 h-2 rounded-full transition-all duration-300 ${activeIndex === i ? 'w-6 bg-primary' : 'bg-white/20'}`}
                  aria-label={`Go to slide ${i + 1}`}
                />
              ))}
            </div>
          </div>
        )}
      </div>
      
      {/* Decorative Glows */}
      <div className="absolute -top-40 -right-40 w-80 h-80 bg-primary/20 blur-[100px] rounded-full hidden md:block"></div>
      <div className="absolute -bottom-40 -left-40 w-80 h-80 bg-secondary/10 blur-[100px] rounded-full hidden md:block"></div>
    </section>
  );
}
