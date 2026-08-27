# Tutorly — Multi-Branch Coaching Center Management Platform

Tutorly is a high-performance, multi-branch SaaS-shaped coaching center management platform built with **Laravel 11**, **Livewire 3**, **Alpine.js**, **Tailwind CSS**, **Laravel Reverb (WebSockets)**, and **Google Gemini AI**.

```
                        ┌─────────────────────┐
                        │   Load Balancer/    │
                        │   Nginx (VPS)       │
                        └──────────┬──────────┘
                                   │
                ┌──────────────────┴───────────────────┐
                │           Laravel 11 App              │
                │  ┌────────────┐  ┌─────────────────┐  │
                │  │  Blade +   │  │  REST API       │  │
                │  │  Livewire 3│  │  (Sanctum)      │  │
                │  │  (Web UI)  │  │  (mobile-ready) │  │
                │  └────────────┘  └─────────────────┘  │
                │  ┌────────────────────────────────┐   │
                │  │  Laravel Reverb (WebSockets)   │   │
                │  └────────────────────────────────┘   │
                └───────┬───────────┬──────────┬────────┘
                        │           │          │
                ┌───────▼───┐  ┌────▼────┐ ┌───▼────────┐
                │  MySQL 8   │  │  Redis  │ │  Queue     │
                │  (primary  │  │ (cache, │ │  Workers   │
                │  data)     │  │  queues)│ │  (jobs)    │
                └────────────┘  └─────────┘ └────────────┘
                        │
                ┌───────▼────────────┐
                │  External Services │
                │  - SSLCommerz      │
                │  - Gemini API (AI) │
                │  - WhatsApp API    │
                └────────────────────┘
```

---

## Key Features

1. **Multi-Branch Tenant Scoping (`BelongsToBranch`)**: Automatic tenant data isolation at the ORM global scope layer for every branch entity. Super Admin role can view aggregate analytics.
2. **Real-time Live Attendance Board (Laravel Reverb)**: Broadcasts attendance updates to admin dashboards instantly without page reloads.
3. **AI-Powered At-Risk Student Detection & Insights**: Integrates Google Gemini API to analyze student attendance trends, payment histories, and grade performance. Includes rule-based fallback when offline.
4. **Auto-Generated Report Card Remarks**: Assists teachers by generating initial drafts of student performance feedback.
5. **Grounded Parent Q&A Assistant**: Intelligent query system allowing parents to ask natural language questions about their child's academic metrics.
6. **Local Gateway & WhatsApp Notifications**: SSLCommerz Sandbox integration and custom WhatsApp notification channel for automated parent updates.
7. **Bilingual Support**: Real-time Bangla (`bn`) and English (`en`) UI switcher.

---

## Tech Stack

- **Backend Framework**: Laravel 11 (PHP 8.3)
- **Frontend Stack**: Blade + Livewire 3 + Alpine.js + Tailwind CSS
- **Real-Time WebSockets**: Laravel Reverb
- **Security & RBAC**: Spatie Laravel Permission, Laravel Fortify / Sanctum
- **Audit Logging**: Spatie Activitylog
- **Payment Gateway**: SSLCommerz
- **AI Integration**: Google Gemini API

---

## Local Setup Instructions

```bash
# 1. Clone & Copy Environment File
cp .env.example .env

# 2. Install PHP & Node Dependencies
composer install
npm install

# 3. Build Frontend Assets
npm run dev

# 4. Generate Key & Run Migrations + Seeders
php artisan key:generate
php artisan migrate --seed

# 5. Start Reverb Server & Local Dev Server
php artisan reverb:start
php artisan serve
```
