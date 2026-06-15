import { BG, BG_RGB } from "@/lib/theme";

type GlowPosition = "left" | "right" | "center";

export function GradientText({ children }: { children: React.ReactNode }) {
  return (
    <span className="text-gradient-primary">{children}</span>
  );
}

export function SectionBadge({ children }: { children: React.ReactNode }) {
  return (
    <div
      className="mb-4 inline-flex items-center gap-2"
      style={{
        padding: "5px 14px",
        borderRadius: 999,
        border: "1px solid rgba(255,255,255,0.14)",
        background: "rgba(255,255,255,0.03)",
      }}
    >
      <span style={{ fontSize: 8, color: "rgba(255,255,255,0.45)" }}>✦</span>
      <span
        style={{
          fontSize: 9.5,
          fontWeight: 500,
          letterSpacing: "0.16em",
          color: "rgba(255,255,255,0.5)",
          textTransform: "uppercase",
        }}
      >
        {children}
      </span>
      <span style={{ fontSize: 8, color: "rgba(255,255,255,0.45)" }}>✦</span>
    </div>
  );
}

export function SectionBackground({ glow = "right" }: { glow?: GlowPosition }) {
  const glowStyles: Record<GlowPosition, React.CSSProperties> = {
    right: {
      position: "absolute",
      width: "50%",
      height: "80%",
      top: "-10%",
      right: "-8%",
      background:
        "radial-gradient(ellipse at 65% 45%, rgba(45,212,191,0.1) 0%, transparent 62%)",
    },
    left: {
      position: "absolute",
      width: "45%",
      height: "75%",
      bottom: "-5%",
      left: "-8%",
      background:
        "radial-gradient(ellipse at 30% 60%, rgba(45,212,191,0.08) 0%, transparent 65%)",
    },
    center: {
      position: "absolute",
      width: "60%",
      height: "50%",
      top: "50%",
      left: "50%",
      transform: "translate(-50%, -50%)",
      background:
        "radial-gradient(ellipse at center, rgba(45,212,191,0.07) 0%, transparent 70%)",
    },
  };

  return (
    <>
      <div
        aria-hidden
        className="pointer-events-none absolute inset-0"
        style={{
          backgroundImage:
            "radial-gradient(circle, rgba(45,212,191,0.13) 1px, transparent 1px)",
          backgroundSize: "26px 26px",
        }}
      />
      <div aria-hidden className="pointer-events-none absolute inset-0 overflow-hidden">
        <div style={glowStyles[glow]} />
        <div
          style={{
            position: "absolute",
            width: "30%",
            height: "40%",
            bottom: 0,
            right: glow === "left" ? "5%" : "15%",
            background:
              "radial-gradient(ellipse at bottom, rgba(52,211,153,0.05) 0%, transparent 70%)",
          }}
        />
      </div>
    </>
  );
}

export function SectionShell({
  id,
  children,
  glow = "right",
  className = "",
}: {
  id: string;
  children: React.ReactNode;
  glow?: GlowPosition;
  className?: string;
}) {
  return (
    <section
      id={id}
      className={`relative overflow-hidden py-20 md:py-28 ${className}`}
      style={{ background: BG }}
    >
      <SectionBackground glow={glow} />
      <div className="relative z-10 mx-auto w-full max-w-7xl px-4 sm:px-8">
        {children}
      </div>
    </section>
  );
}
