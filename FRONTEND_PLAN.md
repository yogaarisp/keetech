# KeeTech IT Services — Frontend Implementation Plan

## Referensi Visual

![Landing Page Wireframe Concept](C:\Users\Kee\.gemini\antigravity\brain\365e6405-674c-4624-be5f-a07d1f506bbf\landing_page_wireframe_1775743887773.png)

---

## Overview

Membangun **single-page landing page** profesional untuk jasa IT Freelance yang menyatukan 4 lini layanan: IT Service, IT Infra, IT Programmer, dan Procurement. Desain mengutamakan kesan *premium*, *futuristic*, dan *trustworthy* dengan Curved UI dan skema warna Maroon-Gold-Cream.

---

## Tech Stack

| Layer | Technology | Alasan |
|-------|-----------|--------|
| Framework | **Next.js 14** (App Router) | SSG/SSR untuk SEO optimal |
| Styling | **Tailwind CSS v3** | Utility-first, mudah untuk curved design |
| Animasi | **Framer Motion** | Scroll-triggered animations, smooth transitions |
| Font | **Inter** (Google Fonts) | Clean, profesional, sans-serif |
| Icons | **Lucide React** | Konsisten, ringan, customizable |
| Deployment | **Vercel** | Auto-optimized, edge network |

---

## 1. Design System & Color Palette

### Warna Utama

| Token | Hex | Penggunaan |
|-------|-----|-----------|
| `maroon-900` | `#4A0011` | Text heading utama, deep accent |
| `maroon-700` | `#800020` | Primary buttons, CTA, active states |
| `maroon-500` | `#A0153E` | Hover states, secondary accent |
| `gold-500` | `#D4AF37` | Icon highlights, badge, premium accent |
| `gold-300` | `#E8D48B` | Subtle decorative elements |
| `cream-100` | `#FFF8DC` | Card backgrounds, soft surfaces |
| `cream-50` | `#FFFEF7` | Page background |
| `neutral-900` | `#1A1A2E` | Dark text, footer background |
| `neutral-600` | `#6B7280` | Body text, descriptions |
| `neutral-100` | `#F3F4F6` | Dividers, subtle backgrounds |

### Typography Scale

```
Font Family : "Inter", sans-serif
Hero H1     : 56px / 64px (desktop) → 36px / 44px (mobile)
Section H2  : 40px / 48px (desktop) → 28px / 36px (mobile)
Card H3     : 24px / 32px
Body         : 16px / 28px
Small        : 14px / 22px
```

### Border Radius (Curved UI)

```
Cards        : rounded-3xl  (24px)
Buttons      : rounded-2xl  (16px)
Navbar       : rounded-2xl dengan backdrop-blur
Sections     : SVG wave dividers antar section
Badges       : rounded-full
```

---

## 2. Navigation (Navbar)

### Desain

```
┌─────────────────────────────────────────────────────────────────┐
│  🔷 KeeTech    Beranda  Layanan  Tentang  Portofolio  Kontak  │  ← Glassmorphism
│                                                    [Hubungi]   │  ← CTA Button
└─────────────────────────────────────────────────────────────────┘
```

### Spesifikasi

- **Posisi:** `fixed top-0`, `z-50`
- **Efek Glassmorphism:** `bg-white/70 backdrop-blur-xl border-b border-white/20`
- **Scroll Behavior:** Background opacity meningkat saat scroll ke bawah (0.7 → 0.95)
- **Logo:** "KeeTech" — text-based atau gambar logo kecil
- **Menu Items:** Smooth scroll ke masing-masing section via `id` anchor
- **CTA Button:** "Hubungi Kami" — `bg-maroon-700 text-white rounded-2xl`
- **Mobile:** Hamburger menu → slide-in drawer dari kanan dengan animasi Framer Motion

### Navigation Items & Anchor Targets

| Label | Target Section ID | Deskripsi |
|-------|------------------|-----------|
| Beranda | `#hero` | Scroll to top |
| Layanan | `#layanan` | Section grid 4 services |
| Tentang | `#tentang` | About us / profile |
| Portofolio | `#portofolio` | Past projects showcase |
| Kontak | `#kontak` | Contact form |

### Mobile Navigation

```
┌──────────────┐
│  ✕  KeeTech  │
│──────────────│
│  Beranda     │
│  Layanan     │
│  Tentang     │
│  Portofolio  │
│  Kontak      │
│──────────────│
│ [Hubungi Kami]│
│              │
│  📞 0812-xxx │
│  📧 info@... │
└──────────────┘
```

- Full-screen overlay dengan `bg-neutral-900/95 backdrop-blur-lg`
- Menu items muncul satu per satu (stagger animation)
- Drawer closed otomatis saat klik menu item

---

## 3. Page Sections (Top to Bottom)

### 3.1 — Hero Section (`#hero`)

```
┌──────────────────────────────────────────────────────────────┐
│                                                              │
│      ✦ IT Service & Software Developer Profesional ✦        │  ← Badge/tag kecil
│                                                              │
│           Solusi Digital Terpadu                              │  ← H1 (56px)
│           untuk Bisnis Anda                                  │
│                                                              │
│     Kami menyediakan layanan IT lengkap — mulai dari         │  ← Subtitle
│     perbaikan hardware, infrastruktur jaringan, hingga      │
│     pengembangan software dan pengadaan perangkat IT.        │
│                                                              │
│     [🚀 Konsultasi Gratis]    [📋 Lihat Layanan]            │  ← 2 CTA buttons
│                                                              │
│  ╭────────────────────────────────────────────────╮          │
│  │          Decorative Image / Illustration       │          │  ← AI-generated
│  ╰────────────────────────────────────────────────╯          │
│                                                              │
│  ~~~~~~~~~~~~~ SVG Wave Divider (cream → white) ~~~~~~~~~~~  │
└──────────────────────────────────────────────────────────────┘
```

**Detail Teknis:**
- Background: Gradient `cream-50` → `white` + subtle geometric pattern (SVG)
- Decorative: Floating maroon/gold circles/dots di background (parallax on scroll)
- Primary CTA: `bg-maroon-700 hover:bg-maroon-500 text-white`
- Secondary CTA: `border-2 border-maroon-700 text-maroon-700`
- Animasi entrance: Fade-up stagger untuk setiap elemen
- Stats bar di bawah hero (opsional): "50+ Klien | 200+ Proyek | 5+ Tahun Pengalaman"

---

### 3.2 — Layanan Section (`#layanan`)

```
┌──────────────────────────────────────────────────────────────┐
│                                                              │
│                   Layanan Kami                                │  ← H2
│         Solusi lengkap untuk kebutuhan IT Anda               │  ← Subtitle
│                                                              │
│  ╭──────────────────╮    ╭──────────────────╮                │
│  │  🖥️ IT Service   │    │  🌐 IT Infra     │                │
│  │                  │    │                  │                │
│  │  Perbaikan &     │    │  CCTV &          │                │
│  │  maintenance PC, │    │  Networking      │                │
│  │  laptop, printer │    │  Maintenance     │                │
│  │                  │    │                  │                │
│  │  [Selengkapnya →]│    │  [Selengkapnya →]│                │
│  ╰──────────────────╯    ╰──────────────────╯                │
│                                                              │
│  ╭──────────────────╮    ╭──────────────────╮                │
│  │  💻 IT Programmer│    │  📦 Procurement  │                │
│  │                  │    │                  │                │
│  │  Web & App       │    │  Pengadaan       │                │
│  │  Development,    │    │  perangkat IT    │                │
│  │  SaaS, Custom    │    │  terpercaya      │                │
│  │                  │    │                  │                │
│  │  [Selengkapnya →]│    │  [Selengkapnya →]│                │
│  ╰──────────────────╯    ╰──────────────────╯                │
│                                                              │
│  ~~~~~~~~~~~~~ SVG Wave Divider ~~~~~~~~~~~~                 │
└──────────────────────────────────────────────────────────────┘
```

**Detail Teknis:**
- Grid: `grid-cols-1 md:grid-cols-2 gap-8`
- Card style: `bg-cream-100 rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all`
- Icon: Warna `gold-500`, ukuran besar (48px) di dalam lingkaran `bg-maroon-700/10`
- Hover effect: Card naik sedikit (`hover:-translate-y-2`) + border `gold-500` muncul
- Scroll animation: Cards muncul stagger dari bawah (Framer Motion `whileInView`)

**Sub-layanan per Card:**

| Card | Icon | Items |
|------|------|-------|
| **IT Service** | `Monitor` | Repair PC/Laptop, Maintenance, Install OS, Cleaning |
| **IT Infra** | `Network` | CCTV Install & Maintenance, LAN/WAN Setup, Server Rack |
| **IT Programmer** | `Code` | Website, Mobile App, SaaS, POS System, Custom Software |
| **Procurement** | `Package` | PC/Laptop, Printer, CCTV, Networking Equipment |

---

### 3.3 — Tentang Section (`#tentang`)

```
┌──────────────────────────────────────────────────────────────┐
│                                                              │
│  ╭────────────────────╮     Mengapa Memilih Kami?            │
│  │                    │                                      │
│  │   Foto / Ilustrasi │     KeeTech adalah partner IT       │
│  │   Tim / Personal   │     profesional yang menangani      │
│  │                    │     kebutuhan teknologi dari A-Z..  │
│  │                    │                                      │
│  ╰────────────────────╯     ✅ Berpengalaman 5+ tahun       │
│                             ✅ Harga transparan              │
│                             ✅ Support 24/7                  │
│                             ✅ Garansi layanan               │
│                                                              │
│  ── Stats Counter ──────────────────────────────────────     │
│  │  50+     │   200+    │   99%      │   24/7    │           │
│  │  Klien   │  Proyek   │  Kepuasan  │  Support  │           │
│  ───────────────────────────────────────────────────         │
│                                                              │
└──────────────────────────────────────────────────────────────┘
```

**Detail Teknis:**
- Layout: `grid-cols-1 lg:grid-cols-2 gap-16 items-center`
- Stats: Animated counter (count up saat section visible)
- Gambar: `rounded-3xl` dengan subtle shadow
- Checklist: Custom check icon warna `gold-500`

---

### 3.4 — Portofolio Section (`#portofolio`)

```
┌──────────────────────────────────────────────────────────────┐
│                           bg: neutral-900                    │
│              Proyek yang Telah Kami Kerjakan                  │
│                                                              │
│  ╭──────────╮  ╭──────────╮  ╭──────────╮                   │
│  │ Project  │  │ Project  │  │ Project  │                   │
│  │ Screenshot│  │ Screenshot│  │ Screenshot│                   │
│  │          │  │          │  │          │                   │
│  │ Web POS  │  │ CCTV     │  │ Company  │                   │
│  │ System   │  │ Install  │  │ Profile  │                   │
│  ╰──────────╯  ╰──────────╯  ╰──────────╯                   │
│                                                              │
│                      ● ○ ○                                   │  ← Carousel dots
└──────────────────────────────────────────────────────────────┘
```

**Detail Teknis:**
- Background: `bg-neutral-900` (dark section untuk kontras)
- Cards: `bg-white/10 backdrop-blur rounded-3xl` (glassmorphism on dark)
- Layout: Horizontal scroll / carousel di mobile, grid 3 kolom di desktop
- Hover: Image zoom-in, overlay muncul dengan detail project
- Text warna `cream-100` dan `gold-500`

---

### 3.5 — Testimonial Section (`#testimoni`)

```
┌──────────────────────────────────────────────────────────────┐
│                                                              │
│             Apa Kata Klien Kami                               │
│                                                              │
│     ╭──────────────────────────────────────────╮             │
│     │  ❝                                       │             │
│     │  Pelayanan sangat profesional, respon     │             │
│     │  cepat dan harga transparan.             │             │
│     │                                           │             │
│     │  ⭐⭐⭐⭐⭐                                │             │
│     │  — Budi, PT. Maju Jaya                   │             │
│     ╰──────────────────────────────────────────╯             │
│                                                              │
│                    ← ● ○ ○ →                                 │  ← Carousel
└──────────────────────────────────────────────────────────────┘
```

**Detail Teknis:**
- Auto-play carousel / swipeable di mobile
- Card: `bg-cream-100 rounded-3xl shadow-md`
- Quote icon: `text-gold-500` besar di atas
- Rating stars: `text-gold-500`

---

### 3.6 — Kontak Section (`#kontak`)

```
┌──────────────────────────────────────────────────────────────┐
│             bg: gradient maroon-900 → neutral-900            │
│                                                              │
│     Hubungi Kami                                             │
│     Mari diskusikan kebutuhan IT Anda                        │
│                                                              │
│  ╭─ Info Kontak ────╮    ╭─ Form ──────────────────╮         │
│  │                  │    │                          │         │
│  │  📍 Alamat       │    │  Nama    [____________]  │         │
│  │  Jakarta, ID     │    │  Email   [____________]  │         │
│  │                  │    │  Telp    [____________]  │         │
│  │  📞 0812-xxx-xxx │    │  Layanan [▼ Pilih     ]  │         │
│  │  📧 info@kee..   │    │  Pesan   [____________]  │         │
│  │                  │    │          [____________]  │         │
│  │  🔗 Social Media │    │                          │         │
│  │  IG  FB  LinkedIn│    │  [🚀 Kirim Pesan      ]  │         │
│  │                  │    │                          │         │
│  ╰──────────────────╯    ╰──────────────────────────╯         │
│                                                              │
└──────────────────────────────────────────────────────────────┘
```

**Detail Teknis:**
- Background: Dark gradient `maroon-900` → `neutral-900`
- Form inputs: `bg-white/10 backdrop-blur border border-white/20 rounded-2xl text-white`
- Dropdown layanan: IT Service, IT Infra, IT Programmer, Procurement
- Submit button: `bg-gold-500 text-neutral-900 font-bold rounded-2xl`
- Validasi: Client-side validation dengan error messages
- Social links: Icon buttons dengan hover glow effect

---

### 3.7 — Footer

```
┌──────────────────────────────────────────────────────────────┐
│  bg: neutral-900                                             │
│                                                              │
│  KeeTech            Layanan        Navigasi      Sosial Media│
│  Solusi IT          IT Service     Beranda       Instagram   │
│  Profesional        IT Infra       Layanan       Facebook    │
│                     IT Programmer  Tentang       LinkedIn    │
│                     Procurement    Portofolio    WhatsApp    │
│                                    Kontak                    │
│                                                              │
│  ────────────────────────────────────────────────────────    │
│  © 2026 KeeTech. All rights reserved.                        │
└──────────────────────────────────────────────────────────────┘
```

---

## 4. Responsive Breakpoints

| Breakpoint | Width | Layout Changes |
|-----------|-------|----------------|
| **Mobile** | < 640px | Single column, hamburger menu, stacked cards |
| **Tablet** | 640–1024px | 2-column grids, compact navbar |
| **Desktop** | > 1024px | Full layout, side-by-side hero, 3-col portfolio |

---

## 5. Animasi & Micro-interactions

| Element | Animation | Library |
|---------|-----------|---------|
| Navbar | Background opacity on scroll | Framer Motion |
| Hero elements | Fade-up stagger entrance | Framer Motion |
| Service cards | Slide-up on scroll into view | Framer Motion `whileInView` |
| Stats counter | Count-up animation | Custom hook + Intersection Observer |
| Portfolio cards | Scale on hover, image parallax | CSS + Framer Motion |
| CTA buttons | Subtle pulse / glow on idle | CSS `@keyframes` |
| Section transitions | SVG wave dividers with subtle color shifts | Static SVG |
| Mobile menu | Slide-in + stagger items | Framer Motion |

---

## 6. Dekoratif & Elemen Visual

### SVG Wave Dividers
Setiap section dipisahkan oleh SVG curved divider — bukan garis lurus. Warna wave match dengan section di atas/bawah.

### Background Pattern
- Subtle geometric pattern (hexagons / dots) dengan opacity rendah (~5%)
- Nuansa **batik modern** yang sangat samar di hero section sebagai identitas lokal
- Floating gradient orbs (maroon & gold) dengan blur tinggi di background

### Glassmorphism Elements
- Navbar
- Portfolio cards (dark section)
- Contact form inputs

---

## 7. Struktur File (Next.js App Router)

```
keetech/
├── public/
│   ├── images/              # Logo, hero image, portfolio screenshots
│   ├── fonts/               # Inter font files (optional, bisa dari Google Fonts)
│   └── favicon.ico
├── src/
│   ├── app/
│   │   ├── layout.tsx       # Root layout, metadata, font loading
│   │   ├── page.tsx         # Main landing page (semua sections)
│   │   └── globals.css      # Tailwind directives + custom styles
│   ├── components/
│   │   ├── Navbar.tsx       # Glassmorphism navbar + mobile drawer
│   │   ├── Hero.tsx         # Hero section
│   │   ├── Services.tsx     # 4 service cards grid
│   │   ├── About.tsx        # About + stats counter
│   │   ├── Portfolio.tsx    # Project showcase carousel
│   │   ├── Testimonials.tsx # Client testimonials carousel
│   │   ├── Contact.tsx      # Contact form + info
│   │   ├── Footer.tsx       # Footer links
│   │   ├── WaveDivider.tsx  # Reusable SVG wave component
│   │   └── ui/
│   │       ├── Button.tsx   # Reusable button variants
│   │       ├── Card.tsx     # Reusable card component
│   │       ├── Badge.tsx    # Tag/badge component
│   │       └── Counter.tsx  # Animated counter component
│   ├── lib/
│   │   └── constants.ts     # Service data, navigation items, testimonials
│   └── hooks/
│       └── useScrollSpy.ts  # Active section detection for navbar
├── tailwind.config.ts       # Custom colors, fonts, animations
├── next.config.js
├── package.json
└── tsconfig.json
```

---

## 8. SEO & Metadata

### Head Metadata (layout.tsx)
```typescript
metadata = {
  title: "KeeTech — Jasa IT Service & Software Developer Profesional",
  description: "Solusi IT terpadu: perbaikan hardware, instalasi CCTV & jaringan, pengembangan web & aplikasi, serta pengadaan perangkat IT. Konsultasi gratis!",
  keywords: "jasa IT, service laptop, CCTV, web developer, software developer, pengadaan IT",
  openGraph: { ... },  // Social sharing preview
  twitter: { ... },     // Twitter card
}
```

### Schema Markup (JSON-LD)
- **LocalBusiness** schema dengan nama, alamat, telepon, layanan
- **Service** schema untuk setiap 4 layanan
- **BreadcrumbList** untuk navigasi

### Semantic HTML
- `<header>` → Navbar
- `<main>` → All sections
- `<section>` dengan `aria-label` untuk setiap section
- `<footer>` → Footer
- Satu `<h1>` di Hero, `<h2>` per section, `<h3>` per card

---

## 9. User Review Required

> [!IMPORTANT]
> **Nama Brand**: Apakah "KeeTech" sudah final sebagai nama brand, atau ada nama lain yang ingin digunakan?

> [!IMPORTANT]
> **Konten & Data**: Apakah Anda sudah memiliki:
> - Logo (atau mau text-based dulu)?
> - Daftar portofolio/proyek yang ingin ditampilkan?
> - Testimoni klien?
> - Alamat & kontak yang akan ditampilkan?

> [!WARNING]
> **Form Handling**: Untuk form kontak, apakah cukup menggunakan *client-side only* (kirim via WhatsApp/email link) atau ingin data tersimpan di database (perlu Supabase/API)?

> [!IMPORTANT]
> **Deployment**: Apakah akan di-deploy ke Vercel, atau ke VPS aaPanel yang sudah ada (seperti project WartegKee)?

---

## 10. Open Questions

1. **Bahasa**: Apakah landing page full Bahasa Indonesia, atau bilingual (ID + EN)?
2. **WhatsApp Integration**: Apakah CTA "Konsultasi Gratis" langsung redirect ke WhatsApp?
3. **Batik Pattern**: Seberapa prominent nuansa batik yang diinginkan? Sangat samar (barely visible) atau cukup terlihat?
4. **Portofolio**: Berapa banyak project yang ingin ditampilkan? Apakah termasuk screenshot WartegKee POS?

---

## Verification Plan

### Automated Tests
- Lighthouse audit: Target score ≥ 90 untuk Performance, SEO, Accessibility
- `npx next build` — memastikan 0 error
- Responsive check via browser DevTools (375px, 768px, 1024px, 1440px)

### Visual Verification
- Browser test di desktop dan mobile viewport
- Screenshot perbandingan setiap section
- Smooth scroll navigation check
- Animation performance (no janky animations)

### Manual Verification
- Test form validation (required fields, email format)
- Test semua navigation links (smooth scroll ke section yang benar)
- Test mobile hamburger menu open/close
- Cross-browser check (Chrome, Firefox, Safari)
