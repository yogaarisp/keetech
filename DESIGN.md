```markdown
# Design System Specification: Editorial Excellence for KeeTech

## 1. Overview & Creative North Star
### The Creative North Star: "The Sovereign Future"
This design system rejects the "template" aesthetic of modern IT services in favor of a high-end, editorial experience. We are not just presenting data; we are curating a digital headquarters that feels expensive, secure, and technologically advanced. 

The visual language balances the heritage and authority of deep maroons and golds with the "Futuristic" sleekness of glassmorphism and organic, curved geometry. By breaking the rigid 12-column grid with intentional asymmetry—such as overlapping elements and varying typographic scales—we create a sense of bespoke craftsmanship. Every pixel should feel intentional, moving away from "standard UI" toward a signature brand presence.

---

## 2. Colors & Tonal Architecture
The palette is rooted in a "Luxury-Tech" aesthetic. We utilize high-contrast pairings of deep primary tones against warm, creamy neutrals to ensure the interface feels approachable yet authoritative.

### Tonal Strategy
- **Primary Surface Hierarchy:** Use `surface` (#FCF8FF) as the base canvas. To define zones, transition to `surface_container_low` (#F5F2FF) or `surface_container` (#EFECFF). 
- **The "No-Line" Rule:** Explicitly prohibit the use of 1px solid borders for sectioning or containment. Boundaries must be defined solely through background color shifts. For example, a "Services" card should sit as a `surface_container_lowest` (#FFFFFF) element on a `surface_container_low` background.
- **Surface Hierarchy & Nesting:** Treat the UI as physical layers of fine paper and frosted glass. Use `surface_container_highest` (#E2E0FC) only for the most critical interactive elements to provide a natural, elevation-based focus.
- **The "Glass & Gradient" Rule:** For components appearing over dark backgrounds (using `on_background` #1A1A2E), employ Glassmorphism. Use semi-transparent `surface` colors with a `backdrop-blur` of 12px–20px. 
- **Signature Textures:** Incorporate subtle gradients for primary CTAs, transitioning from `primary_container` (#800020) to `primary` (#570013). This provides a "soul" and depth that flat color cannot replicate.

---

## 3. Typography: Editorial Authority
We utilize **Inter** exclusively, but we manipulate weight and scale to create a "Newsroom-meets-Lab" hierarchy.

- **Display & Headlines:** Use `display-lg` and `headline-lg` with tight letter-spacing (-0.02em) and bold weights. These are your "statement" pieces. They should command the page.
- **Body & Content:** `body-lg` is your workhorse. Ensure generous line-height (1.6) to provide breathing room and a premium reading experience.
- **Functional Labels:** Use `label-md` in all-caps with increased letter-spacing (+0.05em) for category tags or small metadata. This creates a technical, precise feel.

The contrast between the massive `display` sizes and the refined `body` text establishes the brand's professional maturity.

---

## 4. Elevation & Depth
In this design system, depth is a product of light and layering, not artificial outlines.

- **The Layering Principle:** Stacking surface tiers is the primary method of organization. A `surface_container_lowest` card placed on a `surface_container_low` section creates a soft, natural lift.
- **Ambient Shadows:** For floating elements (like dropdowns or active modals), use extra-diffused shadows. 
    - *Shadow Color:* A 6% opacity version of `on_surface` (#1A1A2E).
    - *Blur:* 32px to 64px.
- **The "Ghost Border" Fallback:** If a container requires further definition for accessibility, use a "Ghost Border": the `outline_variant` token (#E0BFBF) at 15% opacity. Never use 100% opaque borders.
- **Geometric Transitions:** Use SVG wave dividers to transition between high-contrast sections (e.g., transitioning from a Cream `surface` to a Dark `on_background` footer). These waves should be organic and "slow," not jagged.

---

## 5. Components

### Buttons
- **Primary:** Background: Gradient (`primary_container` to `primary`). Text: `on_primary`. Radius: `md` (1.5rem/16px).
- **Secondary (Gold):** Background: `secondary_container` (#FED65B). Text: `on_secondary_container`. Radius: `md`.
- **Tertiary/Ghost:** No background. Text: `primary`. Use a subtle `surface_variant` hover state.

### Cards & Containers
- **Standard Card:** Background: `surface_container_lowest`. Radius: `lg` (2rem/24px). 
- **Guideline:** Forbid horizontal divider lines within cards. Use `spacing-md` or `spacing-lg` (vertical white space) to separate header from body.

### Chips & Tags
- **Selection Chips:** Use `secondary_fixed` (#FFE088) for the background to inject the "Gold" brand accent. Radius: `full`.

### Input Fields
- **Styling:** Use `surface_container_high` for the field background. 
- **States:** On focus, transition the background to `surface_container_highest` and apply a "Ghost Border" using the `surface_tint` color at 30% opacity.

### Glass Navigation
- **Top Nav:** Fixed position. Background: `surface` at 70% opacity with a 15px backdrop-blur. This ensures the "Futuristic" aspect of the brand is always visible as the user scrolls through the content.

---

## 6. Do’s and Don’ts

### Do:
- **Do** use asymmetric layouts. If you have a 2-column grid, try a 60/40 split to create a more custom, editorial feel.
- **Do** lean into the "Curved UI." Ensure that even small elements like tooltips or checkboxes carry the rounded DNA of the system.
- **Do** use the "Cream" background (`surface`) as your primary breathing space; avoid stark #FFFFFF backgrounds unless they are "cards" sitting on top of the cream.

### Don’t:
- **Don’t** use 1px solid lines to separate content. Use color-blocking and whitespace.
- **Don’t** use standard "Drop Shadows." Only use the wide, ambient, tinted shadows described in the Elevation section.
- **Don’t** use high-saturation reds. Stick to the sophisticated Maroon and Gold tokens provided to maintain the "Trustworthy" and "Premium" brand pillars.
- **Don’t** cram content. If in doubt, add 16px of extra padding. Premium brands are defined by the space they are willing to "waste."```