# Test Task

This project is a test assignment using **Laravel (backend)** and **Vue 3 (frontend)** in a **Dockerized** environment.

---

## 📦 Tech Stack

- **Backend**: Laravel 12+
- **Frontend**: Vue 3 + Vite
- **Database**: PostgreSQL
- **Docker**: Docker + Docker Compose

---

## 🚀 Quick Start

### 🔧 Requirements

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

---

## ⚙️ Installation & Run

### 1. Clone the repository

```bash
git clone https://github.com/ViarlUA/TeskTaskNuxgame.git
cd TeskTaskNuxgame
```

### 2. Copy `.env.example` to `.env`

```bash
cp .env.example .env
```

### 3. Start the containers

```bash
docker compose up -d
```
This will automatically start Laravel, PostgreSQL, and the Vue 3 (Vite) frontend.

#### 3.1 Enter the container

```bash
docker compose exec app bash
```

### 4. Install dependencies

```bash
composer install
```

### 5. Generate the application key and run migrations and storage links

```bash
php artisan key:generate
php artisan storage:link
php artisan migrate
```

### 🌐 Access the App

Open [http://localhost](http://localhost) in your browser.