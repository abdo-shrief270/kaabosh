# Web Frontend — Implementation Specification
## Company Website & Product Portfolio

> **Layer:** Web Frontend (Desktop + Mobile Browser)
> **Version:** 1.0 · 2025 · Pre-Launch Edition
> **Audience:** Frontend engineers and AI implementation agents building the web UI
> **Depends on:** Backend API Specification (see `backend.md`)
> **Related:** Mobile Frontend Specification (see `frontend-mobile.md`)

---

## How to Use This Document

This document is the **single source of truth** for everything the web frontend must render, handle, and behave. It covers every page, every component, every interaction, and every constraint. Read it fully before writing any code.

**What this document contains:**
- Every page and its required sections
- Every interactive feature and its exact behaviour
- All component data requirements (what to fetch and render)
- Internationalisation, RTL, and localisation rules
- SEO metadata requirements per page
- Performance, accessibility, and responsive design standards
- Complete API contract summary (what endpoints to call)

**What this document does not contain:**
- Technology stack choice — that is the implementor's decision
- Visual design, colours, fonts, or spacing — handled by the design system
- Backend logic — covered in `backend.md`
- Mobile app screens — covered in `frontend-mobile.md`

---

## Table of Contents

1. [Project Overview](#1-project-overview)
2. [Site Architecture & Routing](#2-site-architecture--routing)
3. [Shared Layout Components](#3-shared-layout-components)
4. [Page Specifications](#4-page-specifications)
5. [Feature Component Specifications](#5-feature-component-specifications)
6. [Internationalisation & RTL](#6-internationalisation--rtl)
7. [SEO Implementation](#7-seo-implementation)
8. [Performance Requirements](#8-performance-requirements)
9. [Accessibility Requirements](#9-accessibility-requirements)
10. [Responsive & Mobile-Browser Behaviour](#10-responsive--mobile-browser-behaviour)
11. [API Integration Contract](#11-api-integration-contract)
12. [State Management](#12-state-management)
13. [Error Handling & Empty States](#13-error-handling--empty-states)
14. [Analytics & Event Tracking](#14-analytics--event-tracking)
15. [Security Requirements](#15-security-requirements)

---

## 1. Project Overview

### 1.1 What Is Being Built

A public-facing **marketing and portfolio website** for a company that sells 4–6 independent SaaS products. The website is not an application — it does not authenticate users or manage product data. Its sole purpose is to:

1. Communicate the company's products clearly to four audience types
2. Capture leads, waitlist signups, and contact enquiries
3. Route visitors to the appropriate external SaaS product application
4. Rank in search engines for product-category keywords

### 1.2 The Visitor Journey

```
Visitor lands on site
       ↓
Understands what the company offers (homepage / product page)
       ↓
Takes one of four actions:
  → Clicks "Start Free Trial"     → external: app.[product].com/signup
  → Clicks "Join Waitlist"        → email capture form (handled by backend)
  → Clicks "View Full Docs"       → external: docs.[product].com
  → Clicks "Contact Sales"        → contact form (handled by backend)
```

The frontend never authenticates users, never loads product application data, and never handles payments.

### 1.3 Target Audiences

| Audience | Primary Need | Key Pages |
|---|---|---|
| Developers | Technical credibility, API signals, docs | Product page, Docs overview, Changelog |
| SMBs | Pricing clarity, outcomes, free trial | Product page, Pricing |
| Enterprise | Security, SLA, contact sales | Product page, Contact, Security |
| Consumers | Simple explanation, free tier | Homepage, Product page |

### 1.4 External Links Map

The frontend links out to separate systems — it never embeds or wraps them:

| Link Label | Destination Pattern |
|---|---|
| "Start Free Trial" / "Get Started" | `https://app.[product-slug].[domain].com/signup` |
| "View Full Documentation" | `https://docs.[product-slug].[domain].com` |
| "Go to App" (existing users) | `https://app.[product-slug].[domain].com` |
| "System Status" | `https://status.[domain].com` |

---

## 2. Site Architecture & Routing

### 2.1 Route Table

Every route must be implemented as a distinct page with its own layout, metadata, and content.

| Route | Page | Layout | Rendering |
|---|---|---|---|
| `/` | Homepage | Default | Static (prerender) |
| `/products` | Product Portfolio | Default | Static (prerender) |
| `/products/[slug]` | Product Landing | Product | Static (prerender) |
| `/products/[slug]/docs` | Docs Overview | Docs | Static (prerender) |
| `/pricing` | Pricing | Default | Static (prerender) |
| `/about` | About / Team | Default | Static (prerender) |
| `/contact` | Contact | Default | Static (prerender) |
| `/blog` | Blog Index | Default | ISR (revalidate on publish) |
| `/blog/[slug]` | Blog Post | Blog | ISR (revalidate on publish) |
| `/changelog` | Changelog | Default | ISR (revalidate on publish) |
| `/for-developers` | Developer Use-Case | Default | Static (prerender) |
| `/for-enterprise` | Enterprise Use-Case | Default | Static (prerender) |
| `/for-agencies` | Agency Use-Case | Default | Static (prerender) |
| `/integrations` | Integrations Directory | Default | Static (prerender) |
| `/integrations/[slug]` | Integration Detail | Default | Static (prerender) |
| `/compare/[slug]` | Comparison Page | Default | Static (prerender) |
| `/security` | Security & Compliance | Default | Static (prerender) |
| `/careers` | Careers | Default | ISR (revalidate on job change) |
| `/careers/[slug]` | Job Role | Default | ISR (revalidate on job change) |
| `/press` | Press / Media Kit | Default | Static (prerender) |
| `/privacy-policy` | Privacy Policy | Legal | Static (prerender) |
| `/terms-of-service` | Terms of Service | Legal | Static (prerender) |
| `/cookie-policy` | Cookie Policy | Legal | Static (prerender) |
| `/sitemap` | HTML Sitemap | Default | Static (prerender) |
| `*` | 404 Not Found | Default | Static |

### 2.2 Locale Routing

All routes above exist for every supported locale. The URL strategy is **prefix except default**:

| Locale | URL Example |
|---|---|
| English (default) | `/products/crm` |
| Arabic | `/ar/products/crm` |
| French | `/fr/products/crm` |

- Visiting any non-prefixed URL always serves English
- Language switcher rewrites the current path to the locale-prefixed equivalent
- If a translated page does not exist, fall back to English — never show a 404
- The locale prefix applies to all routes including blog, careers, and legal pages

### 2.3 Layouts

**Default Layout**
- Announcement bar (conditionally shown)
- Global sticky navigation
- Page content slot
- Footer

**Product Layout**
- Inherits Default Layout
- Injects per-product CSS variable: `--product-accent: [hex]`
- Product-scoped secondary navigation bar below global nav

**Docs Layout**
- Inherits Default Layout
- Left-side docs navigation sidebar
- Right-side table of contents (TOC)
- Main content area

**Blog Layout**
- Inherits Default Layout
- Reading progress bar at top of viewport
- Author sidebar or inline author block
- Related posts section appended to content

**Legal Layout**
- Inherits Default Layout
- Simplified single-column narrow content area
- Last updated date displayed

---

## 3. Shared Layout Components

### 3.1 Announcement Bar

**Behaviour:**
- Rendered at the very top of every page above the navigation
- Conditionally shown — only render if CMS returns `announcementBar.isActive === true`
- Contains: text content, optional CTA link, dismiss (×) button
- On dismiss: hide for the rest of the session (sessionStorage flag)
- On re-visit in a new session: show again unless CMS disables it

**Data source:** `GET /api/v1/site/announcement-bar`

**Fields rendered:**
```
message       string    — body text (may include emoji)
ctaLabel      string?   — button/link label (optional)
ctaUrl        string?   — destination URL (optional)
bgColor       string    — hex background colour
textColor     string    — hex text colour
```

### 3.2 Global Navigation

**Desktop behaviour:**
- Sticky — fixed to top of viewport on scroll
- Logo (links to `/`)
- "Products" item opens a mega-menu dropdown on hover/click showing all products
- Nav items: Products, Pricing, Blog, About, Contact
- Right side: Language switcher, Dark mode toggle, "Get Started" primary CTA button, Search trigger icon

**Mobile behaviour (≤ 767px):**
- Logo + hamburger icon only
- Hamburger opens full-screen overlay with all nav items
- Products expands inline accordion within overlay
- Language switcher and CTA visible at bottom of overlay
- Overlay closed by ×, Escape key, or tapping outside

**Mega-menu (Products dropdown):**
- Triggered by hover on desktop, click on mobile
- Shows a card per product: logo, name, one-line description
- Footer of mega-menu: "View all products →" link to `/products`
- Keyboard accessible: Tab through items, Escape to close

**Active state:** Current route's nav item highlighted. Product pages highlight "Products".

**Data source:** `GET /api/v1/site/navigation` — returns product list for mega-menu

**Accessibility:** Skip-to-content link as first focusable element on every page.

### 3.3 Footer

**Columns:**
1. Company — logo, tagline, social links (LinkedIn, Twitter/X, GitHub)
2. Products — one link per product to its landing page
3. Company — About, Blog, Careers, Press, Contact
4. Legal — Privacy Policy, Terms of Service, Cookie Policy, Accessibility Statement

**Bottom row:** Copyright notice, language switcher, cookie preferences re-open link

**Data source:** `GET /api/v1/site/navigation` — same as nav, includes footer links

### 3.4 Cookie Consent Banner

**Behaviour:**
- Shown on first visit before any non-essential cookies are set
- Three options: **Accept All**, **Reject All**, **Manage Preferences**
- "Manage Preferences" opens a modal with three category toggles:
  - Necessary (locked on, cannot be toggled)
  - Analytics (default off)
  - Marketing (default off)
- On any choice: store consent in a first-party cookie (`consent_preferences`) for 12 months
- Never set analytics or marketing scripts until consent is granted
- Re-open via "Cookie Preferences" link in footer

### 3.5 Search Modal

**Trigger:** Search icon in nav OR keyboard shortcut `Cmd+K` / `Ctrl+K`

**Behaviour:**
- Opens as full-overlay modal — does not navigate away
- Auto-focuses the input field on open
- Escape key or clicking backdrop closes it
- Minimum 3 characters typed before results appear
- Results grouped by type: **Pages**, **Products**, **Blog Posts**, **Docs**
- Each result shows: title, type badge, short excerpt
- Arrow keys navigate between results; Enter opens the selected result
- Empty state: "No results for '[query]'" + 3–5 suggested popular links
- Debounce input: wait 300ms after last keystroke before querying

**Data source:** `GET /api/v1/search?q=[query]&locale=[locale]`

### 3.6 Dark Mode Toggle

- Reads `prefers-color-scheme` on first load and applies accordingly
- Manual toggle in nav overrides system preference
- Persists preference in `localStorage` as `color-scheme`
- Applies `data-theme="dark"` or `data-theme="light"` on `<html>`
- All colours defined as CSS variables that respond to `data-theme`

---

## 4. Page Specifications

### 4.1 Homepage ( `/` )

**Data sources:**
- `GET /api/v1/site/homepage` — hero, stats, testimonials, products grid, newsletter config
- `GET /api/v1/products` — product list for grid

**Sections — in render order:**

#### Hero
- `headline` — large outcome-focused headline
- `subheadline` — supporting sentence
- Two CTA buttons: primary (`primaryCtaLabel` → `primaryCtaUrl`) and secondary (`secondaryCtaLabel` → `secondaryCtaUrl`)
- One trust signal below CTAs: stat string (e.g. "Trusted by 10,000+ teams") or badge

#### Trust Bar (Logo Marquee)
- Horizontally scrolling marquee of customer logos
- Minimum 6 logos; duplicate set for seamless infinite scroll
- Logos sourced from: `GET /api/v1/social-proof/logos`
- Pause scroll on hover

#### Product Grid
- Render one `ProductCard` per product from `GET /api/v1/products`
- `ProductCard` fields: logo, name, tagline, audience tags (array), top 3 module names, status badge, CTA button → `/products/[slug]`
- If `status === 'coming-soon'`: show "Coming Soon" badge, disable CTA

#### Why Choose Us
- 3–4 differentiator items from CMS
- Each: icon name, title, body text (1–2 sentences)

#### Audience Selector
- Tab or card switcher: For Developers / For Businesses / For Enterprise / For Everyone
- Each tab shows: headline, body, 2–3 benefit bullets, CTA button
- Default active tab: first tab
- Switching tabs updates displayed content without page reload

#### Testimonials
- Minimum 3 testimonials from `GET /api/v1/social-proof/testimonials?page=homepage`
- Each: quote text, customer name, job title, company, photo URL, product used
- Carousel or grid layout (design decision)

#### Stats Strip
- 3–5 stat items: number + label (e.g. "10,000+ Users", "99.9% Uptime")
- Data from homepage CMS content

#### Waitlist / Newsletter Capture
- Headline, single email input, submit button
- Privacy micro-copy with link to Privacy Policy
- On submit: `POST /api/v1/leads/waitlist` — see §11 for payload
- Success state: replace form with confirmation message
- Error state: show inline error message

#### Footer
- See §3.3

---

### 4.2 Product Portfolio ( `/products` )

**Data source:** `GET /api/v1/products?locale=[locale]`

**Sections:**

#### Page Header
- Static title and subheadline from CMS or hardcoded

#### Filter Bar
- Filter chips: All, Developers, SMBs, Enterprise, Consumers (audience type)
- Filter chips: All, [category per product] (product category)
- Text search input — filters cards client-side
- Active filters shown as removable tags
- Result count: "Showing X of Y products"
- "Clear all" button when any filter is active
- **Filtering is client-side** — no API calls on filter change

#### Product Cards Grid
- One card per product
- Each card: logo, name, tagline, audience tags, top 3 module names listed, status badge, "Learn More" CTA → `/products/[slug]`
- Cards filtered client-side based on audience type, category, and search text

#### Comparison CTA
- Static CTA strip at bottom: "Compare pricing across all products →" → `/pricing`

---

### 4.3 Product Landing Page ( `/products/[slug]` )

**Data sources:**
- `GET /api/v1/products/[slug]?locale=[locale]`
- `GET /api/v1/social-proof/testimonials?product=[slug]`

**Layout:** Product Layout (injects `--product-accent` CSS variable from `product.accentColor`)

**Sections — in render order:**

#### Product Navigation Bar
- Product logo + name
- Anchor links: Features, Modules, Pricing, Docs, Changelog
- Primary CTA button: "Start Free Trial" → `app.[slug].[domain].com/signup`
- Sticky on scroll (below global nav)

#### Product Hero
- `headline` — outcome-focused, not feature-focused
- `subheadline`
- Primary CTA: "Start Free Trial" / "Join Waitlist" (depends on `product.status`)
- Secondary CTA: "Watch Demo" (opens video modal) or "View Docs" → `/products/[slug]/docs`
- Hero visual: product screenshot or embedded video (autoplay muted, or poster frame with play button)

#### Social Proof Bar
- Product-specific: customer logos OR user count stat
- Data: `GET /api/v1/social-proof/logos?product=[slug]`

#### Problem Statement
- Three pain-point cards/items
- Each: icon, problem headline, 1-sentence description
- Data from product CMS content

#### Feature Highlights
- 3–6 feature items
- Each: icon, feature name, 2–3 sentence description, supporting visual (image or illustration)
- Alternating left-right layout on desktop, stacked on mobile

#### Module Overview
- Grid of module cards
- Each module card: icon, name, one-sentence description
- Data from `product.modules[]`
- No links — modules are sections of this page, not separate pages

#### How It Works
- 3-step process
- Each step: step number, title, description
- Visual connector between steps on desktop

#### Screenshots / Demo
- Lightbox gallery of minimum 3 screenshots
- OR embedded video player (if `product.demoVideoUrl` exists)
- Video: no autoplay, shows poster image, click-to-play

#### Pricing Preview
- Brief 3-plan overview: Free / Pro / Enterprise
- Each: plan name, price or "Contact us", 3-bullet highlight features
- "See full pricing →" link → `/pricing?product=[slug]`

#### Testimonials
- 2–3 testimonials specific to this product
- Source: `GET /api/v1/social-proof/testimonials?product=[slug]`

#### Security & Compliance Strip
- 4 trust badges/items: GDPR Compliant, SSO Available, Data Export, [Hosting Region]
- Static content per product from CMS

#### FAQ Accordion
- 6–10 questions
- Accordion: one item open at a time
- Click to expand/collapse
- On open: smooth height animation
- Data from `product.faq[]`
- `FAQPage` schema injected (see §7)

#### Final CTA Section
- Bold headline
- Primary CTA: "Start Free Trial" / "Join Waitlist"
- Secondary CTA: "Talk to Sales" → `/contact?product=[slug]`

---

### 4.4 Pricing Page ( `/pricing` )

**Data source:** `GET /api/v1/pricing?locale=[locale]`

**Sections:**

#### Page Header + Billing Toggle
- Title and subheadline
- Monthly / Annual toggle — switching recalculates all displayed prices
- When Annual selected: show "Save X%" badge on each plan

#### Product Selector
- Tab per product
- Switching tab loads that product's pricing tiers — client-side from already-fetched data

#### Pricing Tiers
- 3–4 plan cards per product
- Each card: plan name, price (with interval), 1-sentence description, feature list (checkmarks), primary CTA button
- Most popular plan: visually highlighted, "Most Popular" badge
- Enterprise plan: shows "Contact Us" button → `/contact?inquiry=enterprise&product=[slug]`

#### Feature Comparison Table
- Collapsible by feature group
- Rows: feature names; Columns: plan names
- Cells: ✓ (included), ✗ (not included), or limit string (e.g. "Up to 5 users")
- Sticky header on scroll

#### FAQ Accordion
- 6–8 billing-specific questions
- `FAQPage` schema injected

#### Trust Strip
- "No credit card required", "Cancel anytime", "30-day money-back guarantee"
- Secure payment badge

---

### 4.5 About Page ( `/about` )

**Data source:** `GET /api/v1/site/about?locale=[locale]`

**Sections:** Mission Statement, Company Story, Team Section (grid of team member cards), Values (3–5 items), Milestones/Timeline, Investors *(if data exists)*, CTA strip linking to Careers and Contact.

**Team member card fields:** `photo`, `name`, `title`, `bio` (2–3 sentences), `linkedinUrl`

---

### 4.6 Contact Page ( `/contact` )

**Data source:** None (static page with form)
**Form submissions:** `POST /api/v1/contact` and `POST /api/v1/contact/sales`

**Sections:**

#### General Contact Form
Fields: `name`, `email`, `subject` (dropdown: Sales / Support / Press / Partnership / Other), `message`

Validation:
- `name`: required, min 2 chars
- `email`: required, valid email format
- `subject`: required, must select from options
- `message`: required, min 20 chars

Behaviour: Submit → POST to `/api/v1/contact` → show success or error state

#### Sales / Enterprise Form
Fields: `name`, `email`, `company`, `teamSize` (dropdown), `productInterest` (multi-select), `message`

Submit → `POST /api/v1/contact/sales`

#### Support Routing Notice
- Static text directing existing customers to product support portals
- Not a form — purely informational

#### Response Time
- Static: "We respond within 1 business day"

#### Location + Social
- Static company location
- Social links: LinkedIn, Twitter/X, GitHub

---

### 4.7 Blog Index ( `/blog` )

**Data source:** `GET /api/v1/blog?locale=[locale]&page=[n]&category=[cat]&tag=[tag]`

**Sections:**

#### Filter Bar
- Category filter tabs: All, Product Updates, Tutorials, Company News, Industry Insights
- Tag cloud or tag dropdown
- Switching filter: updates URL query params and re-fetches

#### Post Grid
- Post card fields: `featuredImage`, `title`, `excerpt`, `author.name`, `author.photo`, `publishedAt`, `category`, `readingTime`, `slug`
- Clicking card → `/blog/[slug]`

#### Pagination
- Page-based pagination OR infinite scroll (design decision)
- If page-based: show page numbers, prev/next buttons

---

### 4.8 Blog Post ( `/blog/[slug]` )

**Data source:** `GET /api/v1/blog/[slug]?locale=[locale]`

**Layout:** Blog Layout

**Sections:**

#### Post Header
- `title`, `publishedAt`, `readingTime`, `category` badge, author info

#### Reading Progress Bar
- Fixed at top of viewport
- Width % = (scrollY / (document.body.scrollHeight - window.innerHeight)) × 100

#### Post Body
- Rich text / MDX content rendered with proper heading styles
- Inline newsletter CTA block after 3rd or 4th section (from CMS)
- Code blocks with syntax highlighting if present

#### Author Block
- Photo, name, bio, link to author page (all posts by this author)

#### Social Sharing
- Share buttons: LinkedIn, Twitter/X, Copy Link
- Copy Link copies current URL to clipboard, shows "Copied!" tooltip for 2s

#### Related Posts
- 3 posts from same category
- Source: `GET /api/v1/blog?category=[category]&exclude=[currentSlug]&limit=3`

---

### 4.9 Changelog ( `/changelog` )

**Data source:** `GET /api/v1/changelog?locale=[locale]&product=[slug]`

**Sections:**

#### Product Filter
- Tabs or dropdown: All Products, [Product Name] per product
- Filter updates URL query param and re-fetches

#### Entries List
- Reverse-chronological
- Each entry: `date`, `productName`, `version` (optional), `category` badge (`New` / `Improved` / `Fixed`), `title`, `description`
- `New` = green badge, `Improved` = blue badge, `Fixed` = amber badge

#### Subscribe Strip
- "Get notified of updates" email input
- Submit → `POST /api/v1/leads/changelog-subscribe`

---

### 4.10 Careers Page ( `/careers` )

**Data source:** `GET /api/v1/careers?locale=[locale]`

**Sections:** Hero, Mission & Culture (rich text), Why Join Us (4–6 benefit cards), Values in Practice (accordion or grid), Benefits & Perks (structured list), Team (photo grid), Life at the Company (photo gallery or video), Hiring Process Overview (numbered steps), Open Roles section (see below), D&I Statement.

#### Open Roles List
- Filter bar: Department, Location/Work Type, Employment Type, Experience Level, text search
- Each role card: `title`, `department` badge, `location`, `workType`, `employmentType`, `postedAt`, `salaryRange` (if present), `shortDescription`, "Apply Now" → `/careers/[slug]`, Share button
- Empty state: "No current openings matching your filters" + general interest form
- If zero roles total: show general interest form with message about future openings

**General Interest Form:** `name`, `email`, `area` (dropdown of departments), `message` → `POST /api/v1/careers/interest`

---

### 4.11 Job Role Page ( `/careers/[slug]` )

**Data source:** `GET /api/v1/careers/[slug]?locale=[locale]`

**Sections:** Role header (title, metadata, apply CTA), Role Summary, About the Team, What You Will Do (bullet list), What We Are Looking For (Required + Nice to Have lists), What We Offer, Hiring Process (numbered steps), Application Form (see §5.8), Related Roles (2–3 cards).

---

### 4.12 Product Docs Overview ( `/products/[slug]/docs` )

**Data source:** `GET /api/v1/products/[slug]/docs-overview?locale=[locale]`

**Layout:** Docs Layout (with sidebar and TOC)

**Sections:** Docs header, Quick Start (numbered steps), Docs category grid (6–8 category cards, each linking to external docs site), Popular Articles (5–8 links), "View Full Documentation" CTA → external docs site.

**Note:** This page does NOT render actual documentation content. It is a marketing/overview page only. All links to detailed docs go to the external docs site for that product.

---

### 4.13 Security Page ( `/security` )

**Data source:** `GET /api/v1/site/security?locale=[locale]`

**Sections:** Overview statement, Compliance certifications grid (GDPR, SOC 2, ISO 27001 etc. — show only what's true), Data Handling practices (bulleted list), Security features per product (table), Contact for security inquiries.

---

### 4.14 Use-Case Landing Pages ( `/for-developers`, `/for-enterprise`, `/for-agencies` )

Each is a focused landing page with audience-specific messaging. Same structure:

**Sections:** Hero (audience-specific headline + CTA), Pain Points (3 items), How the products help (product cards subset), Testimonial from that audience type, CTA strip.

**Data source:** `GET /api/v1/site/use-case/[audience]?locale=[locale]`

---

### 4.15 Legal Pages ( `/privacy-policy`, `/terms-of-service`, `/cookie-policy` )

**Data source:** `GET /api/v1/site/legal/[type]?locale=[locale]`

**Layout:** Legal Layout

**Sections:**
- Page title + last updated date
- Table of contents (auto-generated from H2 headings)
- Rich text body content (from CMS)
- Contact address for legal inquiries

---

## 5. Feature Component Specifications

### 5.1 Email Capture / Waitlist Form

Used on: Homepage, Product pages, Changelog, Footer (newsletter)

**Fields:** `email` (required), `firstName` (optional), `productInterest` (optional dropdown)

**Behaviour:**
- Validate email format before enabling submit
- On submit: `POST /api/v1/leads/waitlist`
- Loading state: disable button, show spinner
- Success: replace form with "You're on the list! Check your email." message
- Error (API): show "Something went wrong. Please try again." inline
- Error (duplicate): show "You're already signed up!" inline

**GDPR:** Show micro-copy: "By signing up you agree to our [Privacy Policy]. Unsubscribe anytime." Link goes to `/privacy-policy`.

---

### 5.2 FAQ Accordion

Used on: Product pages, Pricing page

**Behaviour:**
- Default: all items collapsed
- Click item header: expand that item, collapse previously open item
- Smooth height transition on expand/collapse (CSS transition or animation)
- Keyboard: Enter/Space on focused header toggles it
- ARIA: `aria-expanded`, `aria-controls`, `role="region"` on answer panel

---

### 5.3 Video / Demo Player

Used on: Product pages

**Behaviour:**
- Shows poster image by default (no autoplay with sound)
- Autoplay muted is acceptable if the design calls for it
- Play button overlay on poster image
- On play: show native or custom video controls
- If `product.demoVideoUrl` is not set: render screenshot gallery instead

---

### 5.4 Testimonials Component

Used on: Homepage, Product pages

**Behaviour:**
- Desktop: 2–3 column grid
- Mobile: single column or horizontal scroll carousel
- Each card: quote marks, quote text, customer photo, name, title, company, product badge
- Photo: circular crop, 48×48px min

---

### 5.5 Product Card

Used on: Homepage grid, Product portfolio page, Mega-menu

**Variants:**
- `large` (homepage + portfolio): logo, name, tagline, audience tags, 3 module names, status badge, CTA
- `small` (mega-menu): logo, name, one-line description

**Status badge logic:**
- `live` → no badge (or "Available" badge in green)
- `beta` → "Beta" badge in amber
- `coming-soon` → "Coming Soon" badge in grey + disable CTA

---

### 5.6 Live Chat Widget

Injected globally on: Product pages, Pricing page, Contact page

**Behaviour:**
- Renders a chat bubble in the bottom-right corner
- On click: opens chat panel
- When offline: show "Leave us a message" form with `name`, `email`, `message`
- Offline form submits to `POST /api/v1/contact/chat-offline`
- Widget must not overlap page CTAs on mobile — position must be checked per page
- Must not render until cookie consent for Marketing is granted (or use a consent-free option)

---

### 5.7 Announcement Bar

See §3.1 — full spec already defined.

---

### 5.8 Job Application Form

Used on: `/careers/[slug]`

**Fields:**

| Field | Type | Required | Condition |
|---|---|---|---|
| `fullName` | text | Yes | Always |
| `email` | email | Yes | Always |
| `phone` | tel | No | Always |
| `country` | select | Yes | Always |
| `cvFile` | file upload | Yes | Always — PDF or .docx, max 5 MB |
| `linkedinUrl` | url | No | Always |
| `portfolioUrl` | url | Conditional | Required for Design, Engineering, Content roles — driven by `role.requiresPortfolio` flag |
| `coverLetter` | textarea or file | No | Always |
| `referralSource` | select | No | Options: LinkedIn, Job board, Referral, Website, Social, Other |
| `referralName` | text | Conditional | Shown only when `referralSource === 'Referral'` |
| `diversityGender` | select | No | Optional — with explanatory note |
| `diversityEthnicity` | select | No | Optional — with explanatory note |
| `diversityDisability` | select | No | Optional — with explanatory note |

**Behaviour:**
- Auto-save to `sessionStorage` on every field blur — restore on page reload
- Inline validation per field on blur
- File upload: validate type and size client-side before upload; show filename + size after selection; allow removal
- Submit button disabled until all required fields are valid
- Show diversity questions in a clearly separated, optional section with explanatory copy
- On submit: `POST /api/v1/careers/[slug]/apply` (multipart/form-data for file upload)
- Loading: disable form, show progress indicator
- Success: replace form with confirmation card showing role title, reference number, expected timeline
- Error: show error message, keep form data intact

---

## 6. Internationalisation & RTL

### 6.1 Locale Configuration

| Locale | Code | Direction | Number Format | Date Format |
|---|---|---|---|---|
| English | `en` | LTR | 1,000.00 | Jan 1, 2025 |
| Arabic | `ar` | RTL | ١٬٠٠٠٫٠٠ | ١ يناير ٢٠٢٥ |
| French | `fr` | LTR | 1 000,00 | 1 janv. 2025 |

### 6.2 Translation Key Convention

All user-visible strings are loaded from locale translation files — no hardcoded English strings in component templates.

```
nav.products           → "Products" / "المنتجات" / "Produits"
cta.start_free         → "Start Free" / "ابدأ مجاناً" / "Commencer gratuitement"
product.[slug].tagline → loaded from CMS per locale
```

Translation files loaded lazily per locale — do not bundle all locales upfront.

### 6.3 RTL Implementation

When `locale === 'ar'`:

- Set `dir="rtl"` on the `<html>` element
- Use CSS logical properties throughout:
  - `margin-inline-start` not `margin-left`
  - `padding-inline-end` not `padding-right`
  - `border-inline-start` not `border-left`
  - `inset-inline-start` not `left`
- Directional icons (arrows, chevrons) must flip — use `transform: scaleX(-1)` or swap icon variants
- Navigation item order reverses
- Form labels align right
- Text alignment: `start` (not `left`) throughout

### 6.4 Language Switcher

- Located in both global nav and footer
- Shows current locale label (e.g. "EN", "العربية", "FR")
- On select: navigate to locale-prefixed equivalent of current page
- If translated page does not exist: navigate to locale-prefixed homepage

### 6.5 Locale Fallback

- If a translation key is missing for `ar` or `fr`: display the English string silently
- If an entire page is not translated: render English content with the locale-prefix URL still active
- Do not show a 404 or error for missing translations

---

## 7. SEO Implementation

### 7.1 Per-Page Metadata Requirements

Every page must render the following in `<head>`:

```html
<title>{page.title} — {company.name}</title>
<meta name="description" content="{page.description}" />
<link rel="canonical" href="{page.canonicalUrl}" />

<!-- Open Graph -->
<meta property="og:title" content="{page.title}" />
<meta property="og:description" content="{page.description}" />
<meta property="og:image" content="{page.ogImage}" />
<meta property="og:url" content="{page.canonicalUrl}" />
<meta property="og:type" content="website" />

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="{page.title}" />
<meta name="twitter:description" content="{page.description}" />
<meta name="twitter:image" content="{page.ogImage}" />

<!-- Hreflang (all supported locales) -->
<link rel="alternate" hreflang="en" href="https://yourcompany.com{page.path}" />
<link rel="alternate" hreflang="ar" href="https://yourcompany.com/ar{page.path}" />
<link rel="alternate" hreflang="fr" href="https://yourcompany.com/fr{page.path}" />
<link rel="alternate" hreflang="x-default" href="https://yourcompany.com{page.path}" />
```

Title max length: **60 characters**. Description: **140–160 characters**.

### 7.2 Structured Data (JSON-LD) per Page Type

**Homepage:**
```json
{
  "@type": "Organization",
  "name": "[Company Name]",
  "url": "https://yourcompany.com",
  "logo": "https://yourcompany.com/logo.png",
  "sameAs": ["[LinkedIn URL]", "[Twitter URL]"]
}
```

**Product page:**
```json
{
  "@type": "SoftwareApplication",
  "name": "[Product Name]",
  "applicationCategory": "[Category]",
  "description": "[Product description]",
  "offers": { "@type": "Offer", "price": "[Starting price]" },
  "operatingSystem": "Web"
}
```

**Blog post:**
```json
{
  "@type": "BlogPosting",
  "headline": "[Post title]",
  "datePublished": "[ISO date]",
  "dateModified": "[ISO date]",
  "author": { "@type": "Person", "name": "[Author name]" },
  "image": "[Featured image URL]"
}
```

**FAQ sections** (product pages, pricing page):
```json
{
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "[Question text]",
      "acceptedAnswer": { "@type": "Answer", "text": "[Answer text]" }
    }
  ]
}
```

**Job role page:**
```json
{
  "@type": "JobPosting",
  "title": "[Role title]",
  "description": "[Role description]",
  "datePosted": "[ISO date]",
  "validThrough": "[ISO date]",
  "employmentType": "[FULL_TIME|PART_TIME|CONTRACTOR|INTERN]",
  "hiringOrganization": { "@type": "Organization", "name": "[Company]" },
  "applicantLocationRequirements": { "@type": "Country", "name": "Worldwide" }
}
```

**All pages:** BreadcrumbList schema.

### 7.3 Sitemap

- Auto-generated XML sitemap at `/sitemap.xml`
- Per-locale sitemaps: `/sitemap-en.xml`, `/sitemap-ar.xml`, `/sitemap-fr.xml`
- Index sitemap at `/sitemap.xml` references the per-locale sitemaps
- Excludes: `noindex` pages, `/api/*`, archived job role pages
- Updates automatically when content is published or changed

### 7.4 robots.txt

```
User-agent: *
Allow: /
Disallow: /api/
Disallow: /admin/
Sitemap: https://yourcompany.com/sitemap.xml
```

### 7.5 Page Title Lengths

- Homepage: `{Company Name} — {Tagline}` (max 60 chars)
- Product page: `{Product Name} — {Company Name}` (max 60 chars)
- Blog post: `{Post Title} — {Company Name}` (max 60 chars)
- Job role: `{Role Title} at {Company Name} — {Location}` (max 60 chars)
- Legal page: `{Page Title} — {Company Name}` (max 60 chars)

---

## 8. Performance Requirements

### 8.1 Core Web Vitals Targets

| Metric | Target | Applies To |
|---|---|---|
| LCP (Largest Contentful Paint) | < 2.5s | All pages |
| INP (Interaction to Next Paint) | < 200ms | All interactive pages |
| CLS (Cumulative Layout Shift) | < 0.1 | All pages |

### 8.2 Rendering Strategy Per Route

| Route Pattern | Strategy | Rationale |
|---|---|---|
| `/`, `/products`, `/products/[slug]`, `/pricing`, `/about`, `/contact` | Static prerender | Maximum performance, content changes infrequently |
| `/blog/[slug]`, `/changelog` | ISR — revalidate on publish | Fresh content without full rebuild |
| `/careers`, `/careers/[slug]` | ISR — revalidate on job change | Jobs change frequently but not constantly |
| `/api/*` | Server-rendered | Dynamic, cannot be cached |

### 8.3 Image Requirements

- Serve modern formats: **WebP** primary, JPEG/PNG fallback via `<picture>` element
- Always use `width` and `height` attributes to prevent CLS
- Lazy load all images below the fold (`loading="lazy"`)
- Eager load hero images (`loading="eager"`, `fetchpriority="high"`)
- Responsive images: `srcset` with multiple sizes — at minimum 400w, 800w, 1200w
- Never serve an image wider than its CSS display width
- Customer logos in trust bar: max 120×40px render size

### 8.4 Font Loading

- Fonts loaded with `font-display: swap` to prevent invisible text during load
- Preload the primary heading font: `<link rel="preload" as="font">`
- Subset fonts to used characters where possible

### 8.5 Third-Party Scripts

- Analytics script: load after user consent, `async`
- Live chat widget: load after user consent, deferred
- Video embeds: use facade pattern — show poster image until user clicks play
- No third-party script may block the main thread on page load

---

## 9. Accessibility Requirements

### 9.1 Standard

**WCAG 2.1 Level AA** minimum compliance on all pages and components.

### 9.2 Implementation Requirements

| Area | Requirement |
|---|---|
| Colour contrast | Body text: minimum 4.5:1 ratio. Large text / UI components: minimum 3:1. |
| Keyboard navigation | All interactive elements reachable via Tab. Logical tab order. No keyboard traps. |
| Focus indicators | Visible focus ring on all interactive elements. Must not rely on colour alone. |
| Screen readers | All interactive elements have accessible names. Icons have `aria-label`. Images have `alt`. |
| Forms | Every input has an associated `<label>`. Error messages are linked via `aria-describedby`. |
| Modals | On open: focus moves into modal. Escape closes modal. Focus returns to trigger on close. |
| Skip link | First focusable element on every page: visually hidden "Skip to main content" link. |
| Headings | One `<h1>` per page. No heading levels skipped. |
| Animations | All animations respect `prefers-reduced-motion: reduce`. |
| Touch targets | Minimum 44×44 CSS pixels for all interactive elements on touch screens. |
| Language | `lang` attribute on `<html>`, updated per locale. `dir` attribute updated for RTL. |
| Video | Captions or transcript available for all video content. |

---

## 10. Responsive & Mobile-Browser Behaviour

### 10.1 Breakpoints

| Name | Min Width | Max Width |
|---|---|---|
| mobile-sm | 320px | 374px |
| mobile | 375px | 767px |
| tablet | 768px | 1023px |
| desktop | 1024px | 1279px |
| wide | 1280px | — |

### 10.2 Layout Rules per Breakpoint

| Component | mobile | tablet | desktop |
|---|---|---|---|
| Navigation | Hamburger menu | Hamburger or condensed | Full nav visible |
| Product grid | 1 column | 2 columns | 3 columns |
| Feature highlights | Stacked single column | Stacked or 2-col | Alternating L/R |
| Pricing tiers | Stacked | 2 columns | 3–4 columns |
| Blog grid | 1 column | 2 columns | 3 columns |
| Team grid | 1–2 columns | 3 columns | 4 columns |
| Footer | Single column stacked | 2 columns | 4 columns |

### 10.3 Mobile-Specific Requirements

- No horizontal overflow at any viewport width — test at 320px
- Font size minimum 16px on mobile inputs (prevents iOS auto-zoom)
- Tables: scroll horizontally with `-webkit-overflow-scrolling: touch` or reflow to stacked layout
- Live chat bubble must not cover CTAs — test on 375px width
- Videos never overflow container
- All touch targets minimum 44×44px

### 10.4 Max Content Width

- Content container: max-width **1440px**, centred with auto margins
- Text content blocks (blog, legal): max-width **720px** for readability

---

## 11. API Integration Contract

The web frontend communicates exclusively with the backend REST API. This section defines every endpoint the frontend calls, its expected request and response shape.

### 11.1 Base URL

```
https://api.yourcompany.com/v1
```

All requests include:
```
Accept-Language: [locale]    (e.g. "en", "ar", "fr")
```

### 11.2 Endpoints Used by Web Frontend

#### Site-level

| Method | Endpoint | Used By | Response |
|---|---|---|---|
| GET | `/site/announcement-bar` | All pages (layout) | `{ isActive, message, ctaLabel?, ctaUrl?, bgColor, textColor }` |
| GET | `/site/navigation` | Nav + Footer | `{ products[], footerLinks{} }` |
| GET | `/site/homepage` | Homepage | `{ hero{}, whyChooseUs[], audiences[], stats[], waitlistConfig{} }` |
| GET | `/site/about` | About page | `{ mission, story, team[], values[], milestones[], investors[]? }` |
| GET | `/site/security` | Security page | `{ overview, certifications[], practices[], perProductFeatures[] }` |
| GET | `/site/use-case/[audience]` | Use-case pages | `{ hero{}, painPoints[], productsSubset[], testimonial{}, cta{} }` |
| GET | `/site/legal/[type]` | Legal pages | `{ title, lastUpdated, body (rich text) }` |

#### Products

| Method | Endpoint | Used By | Response |
|---|---|---|---|
| GET | `/products` | Portfolio, Nav | `Product[]` |
| GET | `/products/[slug]` | Product page | `Product` (full) |
| GET | `/products/[slug]/docs-overview` | Docs overview | `{ header{}, quickStart[], categories[], popularArticles[] }` |

`Product` full shape:
```json
{
  "id": "string",
  "slug": "string",
  "name": "string",
  "tagline": "string",
  "description": "string",
  "accentColor": "#hex",
  "logo": "url",
  "status": "live|beta|coming-soon",
  "audiences": ["developers","smb","enterprise","consumers"],
  "modules": [{ "icon": "string", "name": "string", "description": "string" }],
  "features": [{ "icon": "string", "name": "string", "description": "string", "visual": "url?" }],
  "howItWorks": [{ "step": 1, "title": "string", "description": "string" }],
  "screenshots": ["url"],
  "demoVideoUrl": "url?",
  "pricing": { "plans": [{ "name", "price", "interval", "features", "isPopular" }] },
  "faq": [{ "question": "string", "answer": "string" }],
  "seo": { "title": "string", "description": "string", "ogImage": "url" }
}
```

#### Blog

| Method | Endpoint | Used By | Response |
|---|---|---|---|
| GET | `/blog` | Blog index | `{ posts: Post[], total, page, pageSize }` |
| GET | `/blog/[slug]` | Blog post | `Post` (full with body) |

Query params for `/blog`: `locale`, `page`, `pageSize`, `category`, `tag`, `exclude`

#### Pricing

| Method | Endpoint | Used By | Response |
|---|---|---|---|
| GET | `/pricing` | Pricing page | `{ products: [{ slug, plans[], comparisonTable{} }] }` |

#### Social Proof

| Method | Endpoint | Used By | Response |
|---|---|---|---|
| GET | `/social-proof/logos` | Homepage, Product pages | `{ logos: [{ name, imageUrl, altText }] }` |
| GET | `/social-proof/testimonials` | Homepage, Product pages | `{ testimonials: [{ quote, name, title, company, photo, product }] }` |

Query params: `page` (homepage/product), `product` (filter by product slug)

#### Changelog

| Method | Endpoint | Used By | Response |
|---|---|---|---|
| GET | `/changelog` | Changelog page | `{ entries: ChangelogEntry[] }` |

Query params: `product`, `locale`

#### Careers

| Method | Endpoint | Used By | Response |
|---|---|---|---|
| GET | `/careers` | Careers page | `{ culture{}, roles: JobRole[] }` |
| GET | `/careers/[slug]` | Job role page | `JobRole` (full) |

#### Search

| Method | Endpoint | Used By | Response |
|---|---|---|---|
| GET | `/search` | Search modal | `{ results: { pages[], products[], blog[], docs[] } }` |

Query params: `q` (required), `locale`

### 11.3 Mutation Endpoints (POST)

| Method | Endpoint | Payload | Used By |
|---|---|---|---|
| POST | `/leads/waitlist` | `{ email, firstName?, productInterest? }` | Waitlist form |
| POST | `/leads/changelog-subscribe` | `{ email }` | Changelog subscribe |
| POST | `/contact` | `{ name, email, subject, message }` | Contact form |
| POST | `/contact/sales` | `{ name, email, company, teamSize, productInterest, message }` | Sales form |
| POST | `/contact/chat-offline` | `{ name, email, message }` | Offline chat form |
| POST | `/careers/interest` | `{ name, email, area, message }` | General interest form |
| POST | `/careers/[slug]/apply` | `multipart/form-data` (see §5.8) | Job application form |

### 11.4 Error Handling

All API errors return:
```json
{ "error": { "code": "string", "message": "string" } }
```

Frontend must handle:
- `400` — show field-level validation error from `error.message`
- `429` — show "Too many requests. Please wait and try again."
- `500` / network failure — show generic "Something went wrong. Please try again."
- Never expose raw API error messages to the user

---

## 12. State Management

### 12.1 Global State (persisted across navigation)

| State | Storage | Description |
|---|---|---|
| `locale` | URL prefix + cookie | Current active locale |
| `colorScheme` | `localStorage` | `'light'` \| `'dark'` |
| `consentPreferences` | first-party cookie | `{ necessary, analytics, marketing }` |
| `announcementDismissed` | `sessionStorage` | Boolean — hide announcement bar for session |

### 12.2 Page-Level State (not persisted)

| State | Lives In | Description |
|---|---|---|
| Active product tab (pricing) | Component state | Which product's pricing is shown |
| Billing interval toggle | Component state | `'monthly'` \| `'annual'` |
| Active audience tab (homepage) | Component state | Which audience tab is selected |
| Open FAQ item | Component state | Index of open accordion item |
| Search query + results | Component state | Cleared on modal close |
| Form field values | Component state + sessionStorage | Application form auto-saved |

### 12.3 Server State (cached fetch data)

Product list, blog posts, pricing — cached in memory for the duration of the page session. Do not re-fetch on every render. Invalidate on navigation where appropriate.

---

## 13. Error Handling & Empty States

### 13.1 Page-Level Errors

| Scenario | Behaviour |
|---|---|
| Page not found (404) | Render `/404` page: friendly message, search input, links to homepage and products |
| Server error (500) | Render error page: "Something went wrong" message, link to homepage |
| Product slug not found | Redirect to `/products` with a 301 |
| Job role not found / filled | Render "This role is no longer available" page with related roles and general interest form |
| Blog post not found | Render 404 page |

### 13.2 Component-Level Empty States

| Component | Empty State |
|---|---|
| Product grid (0 results after filter) | "No products match your filters." + "Clear filters" button |
| Blog index (0 posts) | "No posts yet. Check back soon." |
| Job listings (0 roles) | "No open roles right now." + general interest form |
| Testimonials (0 items) | Render nothing — don't show an empty testimonials section |
| Changelog (0 entries) | "No updates yet." |
| Search (0 results) | "No results for '[query]'" + suggested links |

---

## 14. Analytics & Event Tracking

All tracking events must only fire after the user has granted `analytics` consent via the cookie consent banner.

### 14.1 Page View Events

Fire on every route change:
```
event: page_view
properties: { path, title, locale, referrer }
```

### 14.2 CTA Click Events

Fire on every primary and secondary CTA click:
```
event: cta_click
properties: { label, destination, page, position, product? }
```

`position` values: `hero`, `nav`, `pricing`, `final_cta`, `product_card`

### 14.3 Form Events

```
event: form_start          — on first field focus
event: form_submit         — on successful submission
event: form_error          — on failed submission (include error type)
properties: { formId, page, product? }
```

`formId` values: `waitlist`, `contact`, `contact_sales`, `job_application`, `careers_interest`, `changelog_subscribe`

### 14.4 Scroll Depth Events

Fire at 25%, 50%, 75%, 100% scroll depth on product pages and blog posts:
```
event: scroll_depth
properties: { depth_percent, page, product? }
```

### 14.5 Video Events

```
event: video_play
event: video_progress      — at 25%, 50%, 75%, 100%
event: video_complete
properties: { product, videoUrl }
```

### 14.6 Search Events

```
event: search_query        — on query submitted (≥3 chars)
event: search_result_click — on result selected
properties: { query, resultsCount?, selectedTitle?, selectedType? }
```

### 14.7 Outbound Link Events

Fire on any link to an external domain:
```
event: outbound_click
properties: { destination, label, page }
```

---

## 15. Security Requirements

- All API calls over HTTPS only — reject HTTP
- Form submissions include CSRF protection token from API
- No sensitive data in URL query parameters
- User input sanitised before render — prevent XSS
- `Content-Security-Policy` header respected — do not inject inline scripts that violate CSP
- Cookie `consent_preferences` set as `SameSite=Strict; Secure`
- No third-party scripts loaded before consent granted
- File uploads (job applications): validate type and size client-side AND confirm backend validation
- Do not log or expose personal data in client-side error reporting

---

*Web Frontend Specification · Company Website & Product Portfolio · v1.0 · 2025*
