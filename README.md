# 🛒 ShopZone — Full-Stack E-Commerce Website

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![Responsive](https://img.shields.io/badge/Fully_Responsive-✓-1A56DB?style=for-the-badge)

> A fully responsive, professional e-commerce web application built with **Native PHP 8**, **Tailwind CSS**, and **Vanilla JavaScript** — no frameworks, no SQL database, no build tools required.

---

## 🌐 Live Demo

**[🔗 View Live Site →](https://your-site.infinityfree.net)**

---

## 📸 Screenshots

| Home Page | Products Page |
|---|---|
| ![Home](https://via.placeholder.com/500x300/1A56DB/ffffff?text=Home+Page) | ![Products](https://via.placeholder.com/500x300/1A56DB/ffffff?text=Products+Page) |

| Cart Page | Checkout Page |
|---|---|
| ![Cart](https://via.placeholder.com/500x300/1A56DB/ffffff?text=Cart+Page) | ![Checkout](https://via.placeholder.com/500x300/1A56DB/ffffff?text=Checkout+Page) |

---

## 📱 Fully Responsive Design

ShopZone is built **mobile-first** and tested across all screen sizes:

| Device | Breakpoint | Layout |
|---|---|---|
| 📱 Mobile | `< 640px` | Single column, hamburger menu |
| 📟 Tablet | `640px – 1024px` | 2-column product grid |
| 🖥️ Desktop | `> 1024px` | 3-column product grid, full navbar |

- ✅ Tested on Chrome, Firefox, Safari, Edge
- ✅ Tested on iOS and Android browsers
- ✅ Touch-friendly buttons and inputs
- ✅ Hamburger menu with smooth open/close animation
- ✅ Images use `loading="lazy"` for performance

---

## ✨ Features

### 🏠 Home Page
- Sticky navbar with live cart count badge
- Full-width hero section with CTA buttons
- Featured products grid (dynamic from JSON)
- Free shipping promotional banner
- Trust badges: Secure Payment · Free Returns · 24/7 Support · Fast Delivery

### 🛍️ Products Page
- Responsive product grid (1 / 2 / 3 columns)
- **Live search** — filters in real-time as you type (no page reload)
- **Category filter** — All / Electronics / Accessories / Clothing / Home (no page reload)
- Out-of-stock badge with disabled Add to Cart button
- AJAX Add to Cart with toast notification

### 📦 Product Detail Page
- Large product image with full description
- Dynamic stock indicator (In Stock / Low Stock / Out of Stock)
- Quantity selector (+/– buttons, max 10)
- AJAX Add to Cart — no page reload
- Breadcrumb navigation
- Related products section (same category)

### 🛒 Cart Page
- Full cart table: image · name · price · quantity · subtotal · remove
- AJAX quantity update with live subtotal recalculation
- AJAX remove item — row removed from DOM instantly
- Order summary: subtotal · shipping · tax (10%) · grand total
- Free shipping automatically applied on orders over $50
- Empty cart state with "Start Shopping" button

### 💳 Checkout Page
- Two-column layout: form + order summary
- JavaScript validation (inline error messages, red borders)
- PHP server-side validation fallback
- No real payment required — demo mode

### ✅ Order Success Page
- Unique order reference number (PHP `uniqid()`)
- Order summary display
- Cart session cleared automatically

### ℹ️ About & Contact Pages
- Team section, stats, mission cards
- Contact form with JS validation and success message

---

## 🔧 Tech Stack

| Layer | Technology | Purpose |
|---|---|---|
| Structure | HTML5 | Semantic markup |
| Styling | CSS3 + Tailwind CSS (CDN) | Mobile-first responsive design |
| Interactivity | Vanilla JavaScript ES6+ | AJAX, DOM manipulation, validation |
| Backend | Native PHP 8 | Sessions, routing, form handling |
| Data | JSON file | Product database (no SQL needed) |
| State | PHP Sessions | Cart persistence across pages |

---

## 📁 Folder Structure

```
shopzone/
├── index.php                  # Home page
├── products.php               # Products listing
├── product-detail.php         # Single product detail
├── cart.php                   # Shopping cart
├── checkout.php               # Checkout form
├── order-success.php          # Order confirmation
├── about.php                  # About Us
├── contact.php                # Contact Us
│
├── includes/
│   ├── header.php             # Shared navigation
│   ├── footer.php             # Shared footer
│   └── cart-handler.php       # Cart session functions
│
├── api/
│   ├── add-to-cart.php        # POST → add item to cart
│   ├── update-cart.php        # POST → update item quantity
│   └── remove-from-cart.php   # POST → remove item
│
├── data/
│   └── products.json          # 12 products, 4 categories
│
└── assets/
    ├── css/
    │   └── custom.css         # Animations & custom styles
    ├── js/
    │   ├── main.js            # Mobile menu, toast notifications
    │   ├── cart.js            # Cart AJAX logic
    │   └── checkout.js        # Form validation
    └── images/
```

---

## 🚀 Getting Started

### Prerequisites
- PHP 8.0 or higher
- Apache web server (XAMPP / WAMP / Laragon recommended for local dev)
- A modern browser

### Local Setup

```bash
# 1. Clone the repository
git clone https://github.com/your-username/shopzone.git

# 2. Move to your server's web root
# Windows (XAMPP):
cp -r shopzone C:/xampp/htdocs/shopzone

# macOS/Linux:
cp -r shopzone /var/www/html/shopzone

# 3. Start Apache from XAMPP Control Panel

# 4. Open in browser
# http://localhost/shopzone
```

> ✅ No database setup needed. No composer install. No npm install. Just copy and run.

---

## 🌍 Deployment (InfinityFree — Free Hosting)

1. Create a free account at [infinityfree.net](https://infinityfree.net)
2. Create a new hosting account and note your **FTP credentials**
3. Connect via **FileZilla** (FTP client)
4. Upload all project files to the `htdocs/` directory
5. Visit your subdomain — the site is live!

---

## 📦 Products Data Structure

Products are stored in `data/products.json`:

```json
{
  "products": [
    {
      "id": 1,
      "name": "Wireless Noise-Cancelling Headphones",
      "category": "electronics",
      "price": 79.99,
      "description": "Premium over-ear headphones with 30-hour battery life.",
      "image": "https://picsum.photos/seed/prod1/400/400",
      "stock": 25,
      "rating": 4.5,
      "reviews": 128,
      "featured": true
    }
  ]
}
```

**12 products** across **4 categories**: Electronics · Accessories · Clothing · Home

---

## 🔐 Security

- All output uses `htmlspecialchars()` — XSS protection
- All `$_GET` / `$_POST` values checked with `isset()` before use
- `session_start()` called before any output
- API endpoints return proper `Content-Type: application/json` headers

---

## 👤 Author

**Ahmed Hassan**
- GitHub: [@your-username](https://github.com/your-username)

---

## 📄 License

This project is built for educational purposes as part of a full-stack web development course.

---

<p align="center">Built with ❤️ using PHP · Tailwind CSS · Vanilla JavaScript</p>
