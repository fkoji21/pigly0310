# Pigly - 体重管理システム

Pigly は、ユーザーが自身の体重データを記録・管理できる **Laravel** 製の体重管理システムです。

## 🚀 主な機能

- **ユーザー登録 & ログイン** (Laravel Fortify)
- **目標体重の設定**
- **日々の体重記録 (Weight Logs)**
- **カロリー & 運動時間の記録**
- **日付検索**

---

## 🛠️ 使用技術

- **PHP:** 7.4.9（開発環境）
- **Laravel:** 8.83.29
- **MySQL:** 8.0.x
- **Docker / Docker Compose**
- **HTML / CSS（Bootstrap 5 使用）**

---

## 📦 セットアップ手順

### 1️⃣ クローン & `.env` 設定

```bash
git clone https://github.com/fkoji21/pigly0310.git
cd pigly0310
cp .env.example .env
```

### 2️⃣ コンテナを起動

```bash
docker compose up -d --build
```

### 3️⃣ PHPコンテナに入る

```bash
docker compose exec php bash
```

### 4️⃣ 依存関係インストール（コンテナの中で実行）

```bash
composer install
npm install && npm run dev
```

### 5️⃣ アプリキー生成 & キャッシュクリア

```bash
php artisan key:generate
php artisan cache:clear
php artisan config:clear
```

### 6️⃣ データベースマイグレーション & シーダー

```bash
php artisan migrate --seed
```

### 7️⃣ブラウザで確認

```bash
http://localhost/
```

## 📂 ディレクトリ構成

```
📦 pigly
├── 📂 app
│   ├── 📂 Http
│   │   ├── 📂 Controllers
│   │   │   ├── AuthController.php
│   │   │   ├── WeightLogController.php
│   │   │   ├── WeightTargetController.php
│   ├── 📂 Models
│   │   ├── User.php
│   │   ├── WeightLog.php
│   │   ├── WeightTarget.php
│   ├── 📂 Requests
│   │   ├── WeightLogRequest.php
│   │   ├── WeightTargetRequest.php
│
├── 📂 resources
│   ├── 📂 views
│   │   ├── 📂 auth
│   │   ├── 📂 weight_logs
│   │   ├── layouts
│   │   ├── register.blade.php
│   │   ├── register_step2.blade.php
│   ├── 📂 css
│   │   ├── weight_logs.css
│   │   ├── common.css
│
├── 📂 public
│   ├── edit-icon.png
│   ├── css/
│
├── 📂 database
│   ├── 📂 migrations
│   │   ├── 2024_xx_xx_create_users_table.php
│   │   ├── 2024_xx_xx_create_weight_logs_table.php
│   │   ├── 2024_xx_xx_create_weight_targets_table.php
│
├── .env
├── routes/web.php
├── composer.json
├── README.md
```
## 📌 ER図

![ER図](pigly.drawio.png)

---

## 📊 データベース構造

### **users テーブル**

| カラム名   | 型              | NOT NULL | PRIMARY KEY | 備考     |
| ---------- | --------------- | -------- | ----------- | -------- |
| id         | bigint unsigned | ○        | ○           |          |
| name       | varchar(255)    | ○        |             |          |
| email      | varchar(255)    | ○        |             | ユニーク |
| password   | varchar(255)    | ○        |             |          |
| created_at | timestamp       |          |             |          |
| updated_at | timestamp       |          |             |          |

### **weight_targets テーブル** (目標体重)

| カラム名      | 型              | NOT NULL | PRIMARY KEY | FOREIGN KEY | 備考 |
| ------------- | --------------- | -------- | ----------- | ----------- | ---- |
| id            | bigint unsigned | ○        | ○           |             |      |
| user_id       | bigint unsigned | ○        |             | users(id)   |      |
| target_weight | decimal(4,1)    | ○        |             |             |      |
| created_at    | timestamp       |          |             |             |      |
| updated_at    | timestamp       |          |             |             |      |

### **weight_logs テーブル** (体重ログ)

| カラム名         | 型              | NOT NULL | PRIMARY KEY | FOREIGN KEY | 備考 |
| ---------------- | --------------- | -------- | ----------- | ----------- | ---- |
| id               | bigint unsigned | ○        | ○           |             |      |
| user_id          | bigint unsigned | ○        |             | users(id)   |      |
| date             | date            | ○        |             |             |      |
| weight           | decimal(4,1)    | ○        |             |             |      |
| calories         | int             |          |             |             |      |
| exercise_time    | time            |          |             |             |      |
| exercise_content | text            |          |             |             |      |
| created_at       | timestamp       |          |             |             |      |
| updated_at       | timestamp       |          |             |             |      |

---

## 🎯 今後のアップデート予定

- 体重推移のグラフ機能追加
- モバイル対応の強化
- ユーザーインターフェース改善

---

## 📝 ライセンス

このプロジェクトは **MIT ライセンス** のもとで公開されています。自由にご利用・改変してください。