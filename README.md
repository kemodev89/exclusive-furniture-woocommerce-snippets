# Exclusive Furniture WooCommerce Snippets

Custom WooCommerce PHP functions and optimizations created for **Exclusive Furniture** (Houston, TX) — a high-traffic store with **10K+ products**.  
These snippets were designed to improve **performance, automation, and user experience** in a large-scale e-commerce environment.

---

## ✨ Features
- **Dynamic SKU Display** – shows SKU on product pages and updates dynamically for variations.  
- **Store Locator Integration** – retrieves store locations with Google Geocoding API, displays them by product store IDs.  
- **Badge Management** – hides "SALE" badges when "Clearance" is present, ensures proper labeling.  
- **Price Customization** – adjusts labels, shipping tiers, and discount rules.  
- **Database Maintenance** – safe cleanup scripts for unused images, orphaned variations, and large tables (`wp_actionscheduler_*`, `wp_wsal_metadata`).  

---

## 🛠️ Tech Stack
- **CMS:** WordPress / WooCommerce  
- **Backend:** PHP 7/8  
- **Database:** MySQL (large tables, optimized queries)  
- **Other Tools:** Google Maps API, Cron jobs for background scripts  

---

## 📂 Repo Contents
- `snippets/sku-display.php` – SKU display logic  
- `snippets/store-locator.php` – store locator integration  
- `snippets/price-badges.php` – sale/clearance badge handling  
- `snippets/db-cleanup.php` – safe DB cleanup scripts  

---

## 📸 Screenshots
![Product Page SKU](screenshots/sku-display.png)  
![Store Locator](screenshots/store-locator.png)  

---

## 🔗 Related Work
- 🌐 [Exclusive Furniture Website](https://exclusivefurniture.com)  

---

## ⚖️ License
This repo includes **sanitized code samples** only (no production secrets). Licensed under MIT.
