# Masons Au Pair: Platform Modernization

**Live Site:** [masons-aupair.com](https://masons-aupair.com/)

## Project Overview

I was commissioned as a Freelance Full-Stack & DevOps Engineer to lead the digital transformation of Masons Au Pair. The primary objective was to replace a manual, legacy WordPress-based system with a high-performance, automated, and scalable digital ecosystem.

### The Challenge
The original platform relied heavily on manual Google Forms and fragmented WordPress plugins, leading to operational bottlenecks in the 10-step au pair matching process. The agency required a secure, centralized portal that could handle complex workflows, document management, and real-time hardware integration for their physical security assets.

### The Solution
I architected and implemented a decoupled system that separates the business logic from the user interface, ensuring high availability and rapid scalability.

- **Backend:** Laravel 11 API serving a JSON:API compliant structure.
- **Frontend:** Nuxt.js (Vue 3) with SSR to maintain SEO rankings while providing an SPA-like user experience.
- **IoT Layer:** An MQTT-based bridge to synchronize physical security hardware with the software platform.
- **Reliability:** Custom Python monitoring tools to ensure 99.9% uptime and automated failover.

---

## Technical Architecture

### Decoupled Core
The separation of concerns between Laravel and Nuxt.js allows the agency to scale individual components independently. The API is stateless, utilizing AWS Cognito/Sanctum for secure authentication.

### IoT & Hardware Integration
A custom MQTT service was developed to handle real-time events from security hardware. This allows the platform to trigger software events (like matching updates or access logs) based on physical hardware signals.

### Infrastructure (IaC)
The entire stack is containerized using Docker and deployed via Terraform on AWS ECS (Fargate). This setup ensures that the platform is cost-efficient while maintaining the capacity to handle traffic spikes.

---

## Getting Started (Local Development)

1. Clone the repository.
2. Ensure Docker is installed.
3. Run `docker-compose up --build`.
4. Access the portal at `http://localhost:3000`.

---

# Masons Au Pair: Platform Modernizasyonu

**Canlı Site:** [masons-aupair.com](https://masons-aupair.com/)

## Proje Özeti

Masons Au Pair'in dijital dönüşümüne liderlik etmek üzere Freelance Full-Stack & DevOps Mühendisi olarak görev aldım. Temel hedef, manuel süreçlere dayalı eski WordPress yapısını yüksek performanslı, otonom ve ölçeklenebilir bir dijital ekosisteme dönüştürmekti.

### Zorluk
Orijinal platform, manuel Google Formları ve parçalanmış WordPress eklentilerine dayanıyordu; bu durum 10 adımlı au-pair eşleştirme sürecinde operasyonel darboğazlara neden oluyordu. Ajansın; karmaşık iş akışlarını, doküman yönetimini ve fiziksel güvenlik donanımlarıyla gerçek zamanlı entegrasyonu yönetebilecek güvenli, merkezi bir portala ihtiyacı vardı.

### Çözüm
İş mantığını kullanıcı arayüzünden ayıran, yüksek erişilebilirlik ve hızlı ölçeklenebilirlik sağlayan "decoupled" bir mimari tasarladım ve uyguladım.

- **Backend:** JSON:API standartlarında Laravel 11 API.
- **Frontend:** SEO sıralamasını korurken SPA (Single Page Application) deneyimi sunan Nuxt.js (Vue 3).
- **IoT Katmanı:** Fiziksel güvenlik donanımlarını yazılım platformuyla senkronize eden MQTT tabanlı köprü.
- **Güvenilirlik:** %99.9 çalışma süresi ve otomatik hata kurtarma sağlayan özel Python izleme araçları.

---

## Teknik Mimari

### Ayrıştırılmış Çekirdek (Decoupled)
Laravel ve Nuxt.js arasındaki sorumlulukların ayrılması, ajansın bileşenleri birbirinden bağımsız olarak ölçeklendirmesine olanak tanır. API tamamen stateless (durumsuz) olup, güvenli kimlik doğrulama için AWS/Sanctum kullanır.

### IoT ve Donanım Entegrasyonu
Güvenlik donanımlarından gelen gerçek zamanlı olayları yönetmek için özel bir MQTT servisi geliştirildi. Bu, fiziksel sinyallere dayalı olarak yazılım olaylarının (eşleşme güncellemeleri veya erişim kayıtları gibi) tetiklenmesini sağlar.

### Kod Olarak Altyapı (IaC)
Tüm teknoloji yığını Docker kullanılarak konteynerize edildi ve Terraform ile AWS ECS (Fargate) üzerinde yayına alındı. Bu yapılandırma, trafik artışlarını karşılama kapasitesini korurken maliyet etkinliği sağlar.
