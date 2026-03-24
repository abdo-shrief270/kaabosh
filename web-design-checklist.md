# Web Frontend — Design & Pages Checklist
## Company Website & Product Portfolio

> **Reference spec:** `frontend-web.md`
> **Purpose:** Track every design and page required for the web frontend implementation
> **How to use:** Check off each item as it is designed, reviewed, and approved before handoff to development

---

## Progress Summary

| Category | Total Items | Done |
|---|---|---|
| Layouts | 5 | 5 |
| Shared Components | 12 | 12 |
| Pages — Phase 1 (Launch) | 13 | 13 |
| Pages — Phase 2 (Growth) | 4 | — |
| Pages — Phase 3 (Scale) | 8 | — |
| Page Sections | 87 | 72 |
| Feature Components | 8 | 8 |
| UI States | 32 | 20 |
| Responsive Variants | 7 | 5 |
| Special / System Screens | 3 | 2 |

---

## Table of Contents

1. [Layouts](#1-layouts)
2. [Shared Global Components](#2-shared-global-components)
3. [Phase 1 — Launch Pages](#3-phase-1--launch-pages)
4. [Phase 2 — Growth Pages](#4-phase-2--growth-pages)
5. [Phase 3 — Scale Pages](#5-phase-3--scale-pages)
6. [Reusable Feature Components](#6-reusable-feature-components)
7. [UI States & Feedback](#7-ui-states--feedback)
8. [Responsive Design Variants](#8-responsive-design-variants)
9. [Special & System Screens](#9-special--system-screens)
10. [Design Tokens & System](#10-design-tokens--system)
11. [Non-Visual Implementation Checklist](#11-non-visual-implementation-checklist)

---

## 1. Layouts

Layouts are the structural shells that wrap all pages. Design these first — every page depends on them.

### 1.1 Default Layout
- [x] Announcement bar slot (top of page, collapsible)
- [x] Global sticky navigation
- [x] Main content slot
- [x] Footer
- [x] Cookie consent banner overlay

### 1.2 Product Layout
- [x] Inherits Default Layout
- [x] Product-scoped secondary navigation bar (below global nav, sticky on scroll)
- [x] Per-product accent colour CSS variable (`--product-accent`) injected at layout level
- [x] Product nav: logo + name, anchor links (Features, Modules, Pricing, Docs, Changelog), CTA button

### 1.3 Docs Layout
- [x] Inherits Default Layout
- [x] Left sidebar: docs navigation tree
- [x] Right sidebar: table of contents (TOC) from page headings
- [x] Main content area (centred, max-width 720px)
- [x] Mobile: sidebars collapse into toggleable drawers

### 1.4 Blog Layout
- [x] Inherits Default Layout
- [x] Reading progress bar fixed at very top of viewport
- [x] Author block (inline below title or in sidebar)
- [x] Related posts section appended to content

### 1.5 Legal Layout
- [x] Inherits Default Layout
- [x] Single narrow column (max-width ~720px), centred
- [x] "Last updated" date shown below title
- [x] Auto-generated table of contents from H2 headings

---

## 2. Shared Global Components

These components appear across multiple pages and must be designed once as reusable, themeable units.

### 2.1 Announcement Bar
- [x] Text content area (supports emoji)
- [x] Optional CTA link/button
- [x] Dismiss (×) button — right-aligned
- [x] Configurable background colour and text colour
- [x] Dismissed state (hidden)
- [x] Mobile variant (text wraps, CTA below or inline)

### 2.2 Global Navigation — Desktop
- [x] Logo (left-aligned, links to `/`)
- [x] Nav items: Products, Pricing, Blog, About, Contact
- [x] "Products" item — hover/click trigger state
- [x] Products mega-menu dropdown
  - [x] Product card grid (logo, name, one-line description per product)
  - [x] "View all products →" footer link
  - [x] Open state
  - [x] Closed state
- [x] Right-side controls: Language switcher, Dark mode toggle, Search icon, "Get Started" CTA button
- [x] Active/current page state on nav items
- [x] Sticky (background changes or shadow appears on scroll)

### 2.3 Global Navigation — Mobile (≤ 767px)
- [x] Logo + hamburger icon only (collapsed state)
- [x] Full-screen overlay (open state)
  - [x] All nav items listed vertically
  - [x] Products item — inline accordion (expand/collapse)
  - [x] Language switcher
  - [x] "Get Started" CTA button
  - [x] Close (×) button
- [x] Transition animation (slide in / fade in)

### 2.4 Footer
- [x] Column 1: company logo, tagline, social links (LinkedIn, Twitter/X, GitHub)
- [x] Column 2: Products — link list (one per product)
- [x] Column 3: Company — About, Blog, Careers, Press, Contact
- [x] Column 4: Legal — Privacy Policy, Terms of Service, Cookie Policy, Accessibility
- [x] Bottom row: copyright notice, language switcher, "Cookie Preferences" re-open link
- [x] Mobile: columns stack vertically, each collapsible accordion (optional)
- [x] Tablet: 2-column grid

### 2.5 Cookie Consent Banner
- [x] Banner (bottom of screen or modal): message text, "Accept All", "Reject All", "Manage Preferences" buttons
- [x] Preferences modal:
  - [x] Necessary toggle (locked on, non-interactive)
  - [x] Analytics toggle (default off)
  - [x] Marketing toggle (default off)
  - [x] "Save preferences" button
  - [x] Close (×) button
- [x] Mobile: bottom sheet or full-width banner

### 2.6 Search Modal
- [x] Full-screen overlay (backdrop + centred modal)
- [x] Search input (auto-focused, with search icon and clear button)
- [x] Loading / spinner state (while querying)
- [x] Results list:
  - [x] Results grouped by type with section labels: Pages, Products, Blog Posts, Docs
  - [x] Each result: type badge, title, short excerpt
  - [x] Hover + keyboard-active highlight state
- [x] Empty state: "No results for '[query]'" + 3–5 suggested popular links
- [x] Keyboard hint: `Cmd+K` / `Ctrl+K` shown in nav search icon tooltip
- [x] Mobile: full-screen takeover

### 2.7 Dark Mode Toggle
- [x] Icon-only toggle (sun / moon)
- [x] Active state per mode
- [x] Smooth transition between modes (CSS variables update)
- [x] Tooltip: "Switch to dark mode" / "Switch to light mode"

### 2.8 Language Switcher
- [x] Compact dropdown or button group: EN / AR / FR
- [x] Current locale highlighted
- [x] Dropdown open state with locale options
- [ ] RTL-aware positioning (right-to-left layout mirrors this component)

### 2.9 Skip to Content Link
- [x] Visually hidden by default
- [x] Visible on keyboard focus (appears at top-left of screen)
- [x] Links to `#main-content` anchor

### 2.10 Breadcrumb
- [x] Breadcrumb trail: Home > Section > Current Page
- [x] Separator between items (chevron or `/`)
- [x] Last item: current page (non-linked, bold or muted)
- [x] Mobile: may truncate to show only parent + current

### 2.11 Live Chat Bubble
- [x] Chat bubble button (bottom-right corner)
- [x] Online state (accent colour)
- [x] Offline state (grey)
- [x] Open state: chat panel slides in
- [x] Offline fallback form: name, email, message, submit
- [x] Mobile: bubble must not overlap CTAs — check per page

### 2.12 Notification / Toast
- [x] Success toast (green)
- [x] Error toast (red)
- [x] Info toast (blue)
- [x] Auto-dismiss after 3 seconds
- [x] Manual close (×) button
- [x] Position: top-centre or top-right

---

## 3. Phase 1 — Launch Pages

These pages must be complete before public launch.

---

### 3.1 Homepage ( `/` )

- [x] **Page — overall layout** (section order, spacing, max-width)

#### Sections
- [x] **Hero**
  - Headline (large, outcome-focused)
  - Subheadline
  - Primary CTA button
  - Secondary CTA button
  - Trust signal / stat below CTAs

- [x] **Trust Bar — Logo Marquee**
  - Horizontally scrolling infinite marquee
  - Customer logos (min 6) — grayscale or colour variant
  - Pause on hover behaviour

- [x] **Product Grid**
  - Section heading
  - Product Card (large variant) × per product — see §6.1
  - Grid: 1 col mobile / 2 col tablet / 3 col desktop

- [x] **Why Choose Us**
  - Section heading + subheading
  - 3–4 differentiator items: icon, title, 1–2 sentence description
  - Layout: horizontal row on desktop, stacked on mobile

- [x] **Audience Selector**
  - Tab bar: For Developers / For Businesses / For Enterprise / For Everyone
  - Tab active state
  - Content panel per tab: headline, body, 2–3 benefit bullets, CTA button
  - Tab switching animation

- [x] **Testimonials**
  - Section heading
  - Testimonial Card × min 3 — see §6.6
  - Layout: carousel or grid (design decision — specify which)

- [x] **Stats Strip**
  - 3–5 stat items: large number + label
  - Horizontal strip layout

- [x] **Waitlist / Newsletter Capture**
  - Section heading + subheadline
  - Email input + submit button (inline or stacked)
  - Privacy micro-copy with Privacy Policy link
  - Success state (form replaced by confirmation)
  - Error state (inline error message)

---

### 3.2 Product Portfolio Page ( `/products` )

- [x] **Page — overall layout**

#### Sections
- [x] **Page Header**
  - Page title
  - Subheadline

- [x] **Filter Bar**
  - Audience filter chips: All / Developers / SMBs / Enterprise / Consumers
  - Category filter chips
  - Text search input
  - Active filter tags (removable)
  - Result count: "Showing X of Y products"
  - "Clear all" button (shown when filters active)

- [x] **Product Cards Grid**
  - Product Card (large variant) per product — see §6.1
  - Filtered/empty state: "No products match your filters" + Clear filters button

- [x] **Comparison CTA Strip**
  - "Compare pricing across all products →" banner/strip

---

### 3.3 Product Landing Page ( `/products/[slug]` )
*One design template used for all 4–6 products — content swaps, layout stays the same*

- [x] **Page — overall layout** (Product Layout)
- [x] **Per-product accent colour theming** applied throughout

#### Sections
- [x] **Product Navigation Bar** (sticky, below global nav)
  - Product logo + name
  - Anchor links: Features, Modules, Pricing, Docs, Changelog
  - Primary CTA button
  - Scroll behaviour (fades in or stays solid)

- [x] **Product Hero**
  - Outcome-focused headline
  - Subheadline
  - Primary CTA (Start Free Trial / Join Waitlist — conditional)
  - Secondary CTA (Watch Demo / View Docs)
  - Hero visual: screenshot or video poster with play button

- [x] **Social Proof Bar**
  - Logo marquee (product-specific) OR user count stat
  - Compact, single-row strip

- [x] **Problem Statement**
  - Section heading
  - 3 pain-point cards: icon, headline, 1-sentence description

- [x] **Feature Highlights**
  - Section heading
  - 3–6 feature items: icon, name, 2–3 sentence description, supporting visual
  - Alternating left-right layout on desktop
  - Stacked on mobile

- [x] **Module Overview**
  - Section heading
  - Module Card grid: icon, name, one-sentence description
  - Grid layout

- [x] **How It Works**
  - Section heading
  - 3-step process: step number badge, title, description
  - Visual connector between steps on desktop

- [x] **Screenshots / Demo Gallery**
  - Screenshot gallery (lightbox on click) — min 3 images
  - OR video player with poster image (if demo video exists)
  - Lightbox overlay design (navigation arrows, close button, background dim)

- [x] **Pricing Preview**
  - Section heading
  - 3 plan cards: Free / Pro / Enterprise
  - Each: name, price (or "Contact us"), 3 feature highlights
  - "See full pricing →" link

- [x] **Testimonials**
  - Testimonial Card × 2–3 (product-specific) — see §6.6

- [x] **Security & Compliance Strip**
  - 4 trust badge items: GDPR, SSO, Data Export, Hosting Region

- [x] **FAQ Accordion**
  - Section heading
  - 6–10 Q&A items — see §6.2
  - One open at a time

- [x] **Final CTA Section**
  - Bold headline
  - Primary CTA button
  - Secondary CTA (Talk to Sales)

---

### 3.4 Pricing Page ( `/pricing` )

- [x] **Page — overall layout**

#### Sections
- [x] **Page Header**
  - Title + subheadline
  - Monthly / Annual billing toggle
  - "Save X%" badge on Annual option

- [x] **Product Selector Tabs**
  - Tab per product
  - Active tab state
  - Tab switching (client-side, no page reload)

- [x] **Pricing Tier Cards**
  - 3–4 cards per product
  - Each card: plan name, price, billing interval, 1-sentence description, feature list (checkmarks), CTA button
  - Most Popular badge + visual highlight on one card
  - Enterprise card: "Contact Us" CTA variant
  - Monthly ↔ Annual price toggle (prices update without reload)

- [x] **Feature Comparison Table**
  - Sticky column headers on scroll
  - Feature group rows (collapsible groups)
  - Cells: ✓ / ✗ / text limit
  - Mobile: horizontal scroll or reflow to stacked layout

- [x] **FAQ Accordion**
  - 6–8 billing questions — see §6.2

- [x] **Trust Strip**
  - "No credit card required" / "Cancel anytime" / "30-day money-back"
  - Secure payment badge(s)

---

### 3.5 About Page ( `/about` )

- [x] **Page — overall layout**

#### Sections
- [x] **Mission Statement**
  - Heading + 2–3 paragraphs of body text

- [x] **Company Story**
  - Narrative text block
  - Optional supporting image

- [x] **Team Section**
  - Section heading
  - Team member card × per member: photo (circular), name, title, 2–3 sentence bio, LinkedIn link
  - Grid: 1 col mobile / 2 col tablet / 4 col desktop

- [x] **Values**
  - Section heading
  - 3–5 value items: title + 1-paragraph explanation
  - Cards or alternating layout

- [x] **Milestones / Timeline**
  - Chronological list or visual timeline
  - Each milestone: date + title + brief description

- [ ] **Investors / Backers** *(conditional — shown only if data exists)*
  - Investor logo grid

- [x] **CTA Strip**
  - Links to Careers + Contact

---

### 3.6 Contact Page ( `/contact` )

- [x] **Page — overall layout**

#### Sections
- [x] **General Contact Form**
  - Fields: name, email, subject (dropdown), message
  - Validation states per field (error, valid)
  - Submit button (idle, loading, disabled)
  - Success state (form replaced by confirmation message)
  - Error state (inline error)

- [x] **Sales / Enterprise Form**
  - Fields: name, email, company, team size (dropdown), product interest (multi-select), message
  - Same validation and state design as general form
  - Visually distinct section or tab from general form

- [x] **Support Routing Notice**
  - Static informational block — not a form

- [x] **Response Time Expectation**
  - "We respond within 1 business day" note

- [x] **Location + Social Links**
  - Company city/country
  - LinkedIn, Twitter/X, GitHub icon links

---

### 3.7 Product Docs Overview ( `/products/[slug]/docs` )
*One template used for all products*

- [x] **Page — overall layout** (Docs Layout)

#### Sections
- [x] **Docs Header**
  - Product name + "Documentation" label
  - Brief description

- [x] **Quick Start Card**
  - 3–4 numbered steps
  - CTA button: "View full guide →" (external)

- [x] **Docs Category Grid**
  - 6–8 category cards: icon, category name
  - Each card links to external docs site
  - Grid: 2 col mobile / 3 col desktop

- [x] **Popular Articles List**
  - 5–8 linked article titles
  - Each: title + short description (optional)
  - Links to external docs site

- [x] **"View Full Documentation" CTA**
  - Prominent button → external docs site

---

### 3.8 Legal Pages — Privacy Policy ( `/privacy-policy` )

- [x] **Page — overall layout** (Legal Layout)
- [x] Title + last updated date
- [x] Auto-generated table of contents (from H2 headings)
- [x] Rich text content area (proper typography for long-form text)
- [x] Contact address for legal inquiries

---

### 3.9 Legal Pages — Terms of Service ( `/terms-of-service` )

- [x] Same template as Privacy Policy — see §3.8
- [x] Distinct content

---

### 3.10 Legal Pages — Cookie Policy ( `/cookie-policy` )

- [x] Same template as Privacy Policy — see §3.8
- [x] Distinct content

---

### 3.11 HTML Sitemap ( `/sitemap` )

- [x] Page title + brief description
- [x] Grouped link list: Core Pages, Products, Blog, Careers, Legal
- [x] Clean readable link layout (not a raw URL dump)

---

### 3.12 404 Not Found Page

- [x] Friendly error message
- [x] Search input (site-wide search trigger)
- [x] Links to Homepage and Products
- [ ] Illustration or graphic (optional but recommended)

---

### 3.13 500 Server Error Page

- [x] Friendly error message ("Something went wrong")
- [x] Link to homepage
- [x] Retry button (optional)

---

## 4. Phase 2 — Growth Pages

Add these after launch once early traction and content are in place.

---

### 4.1 Blog Index ( `/blog` )

- [ ] **Page — overall layout**

#### Sections
- [ ] **Category Filter Tabs**
  - All / Product Updates / Tutorials / Company News / Industry Insights
  - Active tab state
  - Tag filter (dropdown or tag cloud)

- [ ] **Post Grid**
  - Blog Post Card × per post — see §6.5
  - Grid: 1 col mobile / 2 col tablet / 3 col desktop

- [ ] **Pagination**
  - Page numbers + Prev / Next buttons
  - OR infinite scroll trigger (design decision — specify which)

---

### 4.2 Blog Post ( `/blog/[slug]` )

- [ ] **Page — overall layout** (Blog Layout)

#### Sections
- [ ] **Post Header**
  - Title (large)
  - Author photo + name + date + reading time
  - Category badge

- [ ] **Reading Progress Bar**
  - Thin fixed bar at very top of viewport
  - Fills left-to-right as user scrolls
  - Accent colour

- [ ] **Post Body**
  - Rich text typography (headings H2–H4, body, lists, blockquotes, code blocks)
  - Code blocks: syntax highlighting, copy button
  - Inline Newsletter CTA block (appears mid-article)

- [ ] **Author Block**
  - Photo, name, bio, "View all posts by [author]" link

- [ ] **Social Sharing**
  - LinkedIn share button
  - Twitter/X share button
  - Copy Link button — with "Copied!" tooltip (2s)

- [ ] **Related Posts**
  - 3 blog post cards (compact variant) — see §6.5

---

### 4.3 Changelog ( `/changelog` )

- [ ] **Page — overall layout**

#### Sections
- [ ] **Product Filter**
  - Tabs or dropdown: All Products, [Product Name] per product
  - Active state

- [ ] **Entries List**
  - Reverse-chronological grouping (by month or date)
  - Changelog Entry per item: date, product badge, category badge (New = green / Improved = blue / Fixed = amber), title, description
  - Expandable description if long

- [ ] **Subscribe Strip**
  - "Get notified of updates" — email input + button
  - Same behaviour as waitlist form (success / error states)

---

### 4.4 Security & Compliance Page ( `/security` )

- [ ] **Page — overall layout**

#### Sections
- [ ] Overview / intro statement
- [ ] Compliance certifications grid (badge/logo + name per certification)
- [ ] Data handling practices (bulleted list)
- [ ] Security features per product (table)
- [ ] Contact for security inquiries (email or form link)

---

## 5. Phase 3 — Scale Pages

Add these when growth milestones are reached.

---

### 5.1 Developer Use-Case Page ( `/for-developers` )

- [ ] Hero (developer-specific headline + CTA)
- [ ] 3 pain points (developer-specific)
- [ ] Product cards subset (most developer-relevant products)
- [ ] Developer testimonial(s)
- [ ] CTA strip

---

### 5.2 Enterprise Use-Case Page ( `/for-enterprise` )

- [ ] Hero (enterprise-specific headline + CTA)
- [ ] 3 pain points (enterprise-specific)
- [ ] Product cards subset
- [ ] Enterprise testimonial
- [ ] Security/compliance trust signals (prominent)
- [ ] "Talk to Sales" CTA

---

### 5.3 Agencies Use-Case Page ( `/for-agencies` )

- [ ] Hero (agency-specific headline + CTA)
- [ ] 3 pain points
- [ ] Product cards subset
- [ ] Agency testimonial
- [ ] CTA strip

---

### 5.4 Integrations Directory ( `/integrations` )

- [ ] Page header
- [ ] Filter/search bar
- [ ] Integration cards grid: logo, name, short description, category badge
- [ ] Each card links to `/integrations/[slug]`

---

### 5.5 Integration Detail Page ( `/integrations/[slug]` )

- [ ] Integration logo + name header
- [ ] Description
- [ ] Connected products
- [ ] Setup steps
- [ ] CTA to product page or external integration docs

---

### 5.6 Competitor Comparison Page ( `/compare/[slug]` )

- [ ] Hero: "Us vs [Competitor]" headline
- [ ] Side-by-side comparison table
- [ ] Key differentiators section
- [ ] Testimonial (from a customer who switched)
- [ ] CTA: "Try [Company] free"

---

### 5.7 Careers Page ( `/careers` )

- [ ] **Page — overall layout**

#### Sections
- [ ] **Hero**
  - Team photo or culture image
  - Mission headline + subheadline
  - "View Open Roles" CTA

- [ ] **Mission & Culture Statement**
  - Rich text block

- [ ] **Why Join Us**
  - 4–6 benefit cards: icon, title, description (honest, specific — no generic claims)

- [ ] **Company Values in Practice**
  - Accordion or grid: value title + concrete example

- [ ] **Benefits & Perks**
  - Structured list with icons

- [ ] **Team Section**
  - Photo grid: photo, name, title, one sentence on why they joined

- [ ] **Life at the Company**
  - Photo gallery or embedded video

- [ ] **Hiring Process Overview**
  - Numbered steps

- [ ] **Open Roles Section**
  - Filter bar: Department, Location/Work Type, Employment Type, Experience Level, text search
  - Role Card × per open role: title, department badge, work type badge, location, salary range (if shown), short description, "Apply Now" CTA, share button
  - Empty state: "No roles match your filters" + Clear filters
  - Zero roles state: general interest form with message

- [ ] **General Interest Form**
  - Name, email, area (dropdown), message
  - Submit state (loading / success / error)

- [ ] **Diversity & Inclusion Statement**
  - Short paragraph

---

### 5.8 Job Role Page ( `/careers/[slug]` )

- [ ] **Page — overall layout**

#### Sections
- [ ] **Role Header**
  - Role title (large)
  - Department badge + work type badge + location
  - Employment type + experience level
  - Posted date
  - Salary range (if shown)
  - "Apply Now" primary CTA button
  - Share button

- [ ] **Role Summary**
  - 3–5 sentence overview paragraph

- [ ] **About the Team**
  - Short paragraph

- [ ] **What You Will Do**
  - Bullet list (6–10 items)

- [ ] **What We Are Looking For**
  - "Required" group (bullet list)
  - "Nice to Have" group (bullet list, visually differentiated)

- [ ] **What We Offer**
  - Bullet list (salary, equity, perks)

- [ ] **Hiring Process**
  - Numbered steps: stage name + description

- [ ] **Job Application Form** (embedded on page — see §6.8)

- [ ] **Related Roles**
  - 2–3 role cards (compact variant)

---

### 5.9 Press / Media Kit Page ( `/press` )

- [ ] Page header
- [ ] Company overview paragraph
- [ ] Downloadable brand assets section (logos, colours)
- [ ] Press contact details
- [ ] Press mentions list (chronological)
- [ ] Boilerplate company description

---

## 6. Reusable Feature Components

Components shared across multiple pages — design once, use everywhere.

### 6.1 Product Card
- [x] **Large variant** (Homepage grid, Portfolio page)
  - Product logo
  - Product name
  - Tagline
  - Audience tags (pill badges): Developers / SMBs / Enterprise / Consumers
  - 3 module names listed
  - Status badge: live (green "Available") / beta (amber "Beta") / coming-soon (grey "Coming Soon")
  - CTA button (disabled + "Coming Soon" when status is `coming-soon`)
- [x] **Small variant** (Mega-menu)
  - Product logo + name + one-line description
  - No badges, no CTA

### 6.2 FAQ Accordion
- [x] Item: question header (clickable) + answer panel
- [x] Collapsed state (default for all items)
- [x] Expanded state (smooth height animation)
- [x] One-item-open-at-a-time behaviour
- [x] Keyboard: Enter/Space toggles focused item
- [x] ARIA: `aria-expanded`, `role="region"` on answer

### 6.3 Video / Demo Player
- [x] Poster image with play button overlay
- [x] Click-to-play (no autoplay with sound)
- [x] Native video controls on play
- [x] Fullscreen support
- [x] Fallback: screenshot gallery if no video URL

### 6.4 Image Lightbox
- [x] Overlay / backdrop (dark, semi-transparent)
- [x] Image centred, responsive
- [x] Previous / next navigation arrows
- [x] Close button (×) + Escape key dismiss
- [x] Image counter: "2 / 5"
- [x] Keyboard navigable (left/right arrows)
- [ ] Mobile: swipe left/right to navigate

### 6.5 Blog Post Card
- [x] **Feed variant** (Blog index)
  - Featured image (16:9 aspect ratio)
  - Category badge
  - Title
  - Excerpt (2–3 lines, truncated)
  - Author photo + name
  - Publish date + reading time
  - Hover state (lift or overlay)
- [x] **Compact variant** (Related posts, Homepage)
  - Smaller image or no image
  - Title + author + date only

### 6.6 Testimonial Card
- [x] Opening quote marks (decorative)
- [x] Quote text (2–4 lines)
- [x] Customer photo (circular, 48×48px minimum)
- [x] Customer name (bold)
- [x] Job title + company
- [x] Product badge (which product they use)
- [x] Grid layout: 2–3 columns desktop / 1 column mobile

### 6.7 Email Capture / Waitlist Form
- [x] Inline variant (used in sections — email + button on one line)
- [x] Stacked variant (used standalone — label, email field, button stacked)
- [x] Privacy micro-copy beneath form
- [x] Loading state: spinner on button, fields disabled
- [x] Success state: form replaced by confirmation message
- [x] Error state (API error): inline error message below button
- [x] Error state (duplicate email): "You're already signed up!" message

### 6.8 Job Application Form
- [ ] Field: Full name (text)
- [ ] Field: Email (email input)
- [ ] Field: Phone (tel input, optional)
- [ ] Field: Country (dropdown/select)
- [ ] Field: CV / Resume (file upload — shows filename + size after selection, remove button)
- [ ] Field: LinkedIn URL (url input, optional)
- [ ] Field: Portfolio URL (url input, conditional — shown when `role.requiresPortfolio`)
- [ ] Field: Cover letter (textarea or file upload, optional)
- [ ] Field: Referral source (dropdown, optional)
- [ ] Field: Referral name (text input — shown only when Referral selected)
- [ ] Diversity section (clearly separated, labelled "Optional")
  - [ ] Gender identity (select, optional)
  - [ ] Ethnicity (select, optional)
  - [ ] Disability (select, optional)
  - [ ] Explanatory note (why asked, how used)
- [ ] Inline validation per field (on blur)
- [ ] Submit button (disabled until required fields valid)
- [ ] Loading state (disable form, show progress indicator)
- [ ] Success state (form replaced by confirmation card: role title, reference number, expected timeline)
- [ ] Error state (inline error, form data preserved)

---

## 7. UI States & Feedback

Every interactive component needs all its states designed — not just the default.

### 7.1 Button States
- [x] Primary button: default, hover, active/pressed, disabled, loading (with spinner)
- [x] Secondary button: default, hover, active, disabled
- [x] Ghost/outline button: default, hover, active, disabled
- [x] Destructive button: default, hover, active
- [x] Link button (text only): default, hover, active

### 7.2 Form Field States
- [x] Default (empty, unfocused)
- [x] Focused (border highlight)
- [x] Filled (has value)
- [ ] Valid (optional green checkmark)
- [x] Error (red border + error message below)
- [x] Disabled (greyed out)
- [ ] Read-only

### 7.3 Form Feedback States
- [x] Loading / submitting (spinner on button, fields disabled)
- [x] Success (inline confirmation message or form replaced)
- [x] Error — API failure (generic error message)
- [x] Error — validation (field-level messages)
- [ ] Error — rate limited (friendly "try again" message)
- [x] Error — duplicate entry (e.g. "already subscribed")

### 7.4 Page Loading States
- [x] Skeleton placeholder for product cards (shimmer effect)
- [x] Skeleton placeholder for blog post cards
- [x] Skeleton placeholder for testimonials
- [ ] Full-page spinner (used sparingly — only for initial heavy loads)

### 7.5 Empty States
- [x] Product grid: 0 results after filter — illustration/icon + message + "Clear filters" button
- [ ] Blog index: 0 posts — message
- [ ] Job listings: 0 roles matching filters — message + Clear filters
- [ ] Job listings: 0 roles total — general interest form card
- [ ] Changelog: 0 entries — message
- [x] Search: 0 results — message + suggested links
- [x] Testimonials: 0 items — render nothing (hide section entirely)

### 7.6 Interactive States
- [x] Accordion item: collapsed / expanded (with transition)
- [x] Tab: inactive / active / hover
- [x] Filter chip: unselected / selected / hover
- [x] Dropdown: closed / open
- [x] Toggle (billing): monthly / annual
- [x] Modal: open / closed (with backdrop fade)
- [ ] Tooltip: hidden / visible

---

## 8. Responsive Design Variants

Each of these components must be explicitly designed for mobile, tablet, and desktop — not just "it scales".

### 8.1 Navigation
- [x] Mobile: hamburger + full-screen overlay
- [x] Tablet: condensed or hamburger
- [x] Desktop: full horizontal nav with mega-menu

### 8.2 Product Grid
- [x] Mobile: 1 column
- [x] Tablet: 2 columns
- [x] Desktop: 3 columns

### 8.3 Pricing Tiers
- [x] Mobile: stacked single column (horizontal scroll optional)
- [x] Tablet: 2 columns
- [x] Desktop: 3–4 columns side by side

### 8.4 Feature Highlights (Product Page)
- [x] Mobile: stacked (image above text)
- [x] Desktop: alternating left-right (image + text side by side)

### 8.5 Blog Grid
- [ ] Mobile: 1 column
- [ ] Tablet: 2 columns
- [ ] Desktop: 3 columns

### 8.6 Team Grid (About Page)
- [x] Mobile: 1–2 columns
- [x] Tablet: 3 columns
- [x] Desktop: 4 columns

### 8.7 Footer
- [x] Mobile: single column, stacked vertically
- [x] Tablet: 2-column grid
- [x] Desktop: 4-column grid

---

## 9. Special & System Screens

### 9.1 404 Not Found
- [ ] Illustration or graphic
- [x] "Page not found" headline
- [x] Brief explanation
- [x] Search input (triggers site-wide search)
- [x] "Back to homepage" + "Browse products" links

### 9.2 500 Server Error
- [x] "Something went wrong" headline
- [x] Friendly explanation (not a technical error message)
- [x] "Try again" button
- [x] "Back to homepage" link

### 9.3 Role No Longer Available ( `/careers/[slug]` — filled/cancelled role )
- [ ] "This role is no longer available" headline
- [ ] Brief message
- [ ] Related roles section (2–3 open roles)
- [ ] General interest form (in case they want to stay in touch)

---

## 10. Design Tokens & System

These must be defined before any page design begins — they are the foundation everything else uses.

### 10.1 Colour System
- [x] Primary brand colours (light + dark mode variants)
- [x] Neutral / grey scale
- [x] Semantic colours: success (green), warning (amber), error (red), info (blue)
- [x] Product accent colour system (each of the 4–6 products has its own `--product-accent` variable)
- [x] Background colours (page, card, elevated surface) — light + dark
- [x] Border colours — light + dark
- [x] Text colours (primary, secondary, muted, inverse) — light + dark

### 10.2 Typography
- [x] Typeface selection (heading font + body font)
- [x] Type scale: xs, sm, base, lg, xl, 2xl, 3xl, 4xl, 5xl (with px values)
- [x] Line height per scale step
- [x] Font weight: regular (400), medium (500), semibold (600), bold (700)
- [x] Letter spacing for headings
- [x] Maximum line length for body text (60–75 characters)

### 10.3 Spacing System
- [x] Base spacing unit (4px or 8px grid)
- [x] Spacing scale: 0, 1, 2, 3, 4, 5, 6, 8, 10, 12, 16, 20, 24, 32, 40, 48, 64 (× base unit)
- [x] Section vertical padding (consistent across all pages)
- [x] Content container max-width (1440px) + padding

### 10.4 Border & Radius
- [x] Border radius scale: none, sm, md, lg, xl, full (pill)
- [x] Border widths: 1px, 2px
- [x] Border colours (see §10.1)

### 10.5 Shadows / Elevation
- [x] Shadow scale: none, sm (subtle card), md (dropdown), lg (modal)
- [x] Dark mode shadow adjustment

### 10.6 Icons
- [x] Icon library selection (or custom)
- [x] Standard icon sizes: 16px, 20px, 24px, 32px
- [x] Icon colour usage rules (matches text colour vs accent colour)
- [ ] Directional icons with RTL flip behaviour

### 10.7 Motion & Animation
- [x] Transition duration scale: instant (0ms), fast (100ms), normal (200ms), slow (300ms)
- [x] Easing curves: ease-in, ease-out, ease-in-out
- [x] Specific animations: accordion expand, modal fade, tab switch, tooltip appear, skeleton shimmer
- [ ] `prefers-reduced-motion` reduced variants for all animations

---

## 11. Non-Visual Implementation Checklist

These don't produce design deliverables but must be verified before launch.

### 11.1 SEO — Per Page
- [x] Unique `<title>` tag (max 60 chars) on all pages
- [x] Unique `<meta name="description">` (140–160 chars) on all pages
- [ ] `<link rel="canonical">` on all pages
- [ ] Open Graph tags (`og:title`, `og:description`, `og:image`, `og:url`) on all pages
- [ ] Twitter Card tags on all pages
- [ ] Hreflang tags (en, ar, fr, x-default) on all pages
- [ ] `robots.txt` present and correct
- [ ] XML sitemaps: `/sitemap.xml`, `/sitemap-en.xml`, `/sitemap-ar.xml`, `/sitemap-fr.xml`

### 11.2 SEO — Structured Data (JSON-LD)
- [ ] `Organization` schema — Homepage
- [ ] `SoftwareApplication` schema — Product pages
- [ ] `BlogPosting` schema — Blog post pages
- [ ] `FAQPage` schema — Product pages, Pricing page
- [ ] `JobPosting` schema — Job role pages
- [ ] `BreadcrumbList` schema — All pages

### 11.3 Accessibility
- [x] Skip-to-content link on every page
- [x] One `<h1>` per page (no skipped heading levels)
- [ ] All images have `alt` text (or `alt=""` for decorative)
- [x] All form inputs have associated `<label>`
- [ ] Error messages linked to fields via `aria-describedby`
- [x] All modals trap focus (Escape closes, focus returns to trigger)
- [x] All interactive elements keyboard-reachable (Tab order logical)
- [ ] Colour contrast minimum 4.5:1 body text / 3:1 large text & UI
- [ ] `lang` attribute on `<html>` updated per locale
- [ ] `dir="rtl"` on `<html>` when Arabic is active
- [ ] `prefers-reduced-motion` respected by all animations
- [ ] Touch targets minimum 44×44 CSS pixels

### 11.4 Internationalisation
- [ ] No hardcoded English strings in templates — all use translation keys
- [ ] RTL layout mirrors correctly for Arabic (CSS logical properties)
- [ ] Directional icons flip in RTL
- [ ] Dates formatted per locale (EN / AR / FR)
- [ ] Numbers formatted per locale
- [ ] Language switcher in nav and footer
- [ ] Locale fallback to English when translation missing (no 404)

### 11.5 Performance
- [ ] Hero images: `loading="eager"` + `fetchpriority="high"`
- [ ] All below-fold images: `loading="lazy"`
- [ ] All images use `<picture>` with WebP primary and JPEG/PNG fallback
- [ ] All images have `width` + `height` attributes (prevent CLS)
- [ ] Fonts loaded with `font-display: swap`
- [ ] Primary heading font preloaded via `<link rel="preload">`
- [ ] Analytics script loaded `async` after consent
- [ ] Live chat deferred until after consent
- [ ] Video embeds use facade pattern (poster image until click-to-play)
- [ ] No third-party script blocks main thread on load

### 11.6 Analytics Events
- [ ] `page_view` fires on every route change
- [ ] `cta_click` fires on every primary + secondary CTA
- [ ] `form_start` fires on first field focus (all forms)
- [ ] `form_submit` fires on successful form submission
- [ ] `form_error` fires on form submission failure
- [ ] `scroll_depth` fires at 25% / 50% / 75% / 100% on product + blog pages
- [ ] `video_play`, `video_progress`, `video_complete` fire on demo videos
- [ ] `search_query` fires when search query submitted
- [ ] `search_result_click` fires on result selected
- [ ] `outbound_click` fires on any external link
- [ ] All tracking disabled until analytics consent given

### 11.7 Security
- [ ] All API calls over HTTPS
- [ ] CSRF token included with form submissions
- [ ] No sensitive data in URL query params
- [ ] User input sanitised before render (XSS prevention)
- [ ] `consent_preferences` cookie set as `SameSite=Strict; Secure`
- [ ] File upload: client-side type + size validation before send
- [ ] No personal data logged in client-side error reporting

---

*Web Frontend Design & Pages Checklist · Company Website & Product Portfolio · v1.0 · 2025*
*Reference: `frontend-web.md` for full specifications*
