# Masons Au Pair: Digital Ecosystem Modernization

**Production Environment:** [masons-aupair.com](https://masons-aupair.com/)

## Executive Summary

I was approached by Masons Au Pair to architect and implement a complete digital overhaul. The legacy infrastructure was a monolithic WordPress site coupled with manual data entry points (Google Forms). I transformed this into a high-availability, decoupled ecosystem that integrates modern web technologies with physical IoT security hardware.

---

## Technical Deep Dive

### 1. Decoupled Micro-Architecture
The platform is built on a "headless" philosophy. 
- **Backend (Laravel 11)**: Operates as a purely stateless RESTful API. It utilizes **API Resources** for strict data transformation and **Form Requests** for multi-layered validation. The core logic handles a complex 10-step matching algorithm and secure document orchestration.
- **Frontend (Nuxt 3)**: Leverages **Server-Side Rendering (SSR)** to ensure sub-second page loads and optimal SEO indexing—critical for the agency's organic growth. State management is handled via **Pinia**, ensuring reactive and consistent data flow across the portal.

### 2. Event-Driven IoT Integration
One of the project's most sophisticated features is the real-time hardware synchronization layer.
- **Protocol**: MQTT (Message Queuing Telemetry Transport) over TLS/SSL.
- **Logic**: I developed a custom `MqttService` that bridges physical hardware events with Laravel's internal Event System. When a hardware trigger is received, it dispatches an asynchronous **HardwareEventReceived** event, allowing for decoupled processing such as instant notification triggers or status updates.

### 3. Reliability Engineering & Self-Healing
To guarantee 99.9% uptime, I implemented a custom "Watchdog" monitoring suite in Python.
- **Service Monitoring**: The tool validates the health of PHP-FPM, Nginx, and the MQTT Broker every 30 seconds.
- **Automated Recovery**: Upon detecting a service failure, the script initiates an automated recovery sequence (Self-healing).
- **Log Watchdog**: Real-time tailing of application logs to identify and report `CRITICAL` or `FATAL` errors via Webhooks before users encounter issues.

### 4. Cloud Ops & Security Hardening
The infrastructure is fully defined as code (IaC) using **Terraform** and deployed on **AWS**.
- **Orchestration**: AWS ECS (Fargate) for serverless container management, ensuring cost-efficiency and auto-scaling capabilities.
- **Database**: Amazon RDS (Multi-AZ) providing automated failover and point-in-time recovery.
- **Networking**: Tiered VPC architecture where the database and application layers are isolated in private subnets, only reachable via an Application Load Balancer (ALB).
- **CI/CD**: A fully automated pipeline using GitHub Actions that handles multi-stage Docker builds, image scanning, and zero-downtime deployment to ECS.

---

## Engineering Philosophy
The project emphasizes **Separation of Concerns**, **Security by Design**, and **Observability**. By replacing manual processes with an event-driven digital core, I reduced the agency's operational overhead by approximately 70% while providing a scalable foundation for global expansion.

---

# Masons Au Pair: Dijital Ekosistem Modernizasyonu

**Canlı Ortam:** [masons-aupair.com](https://masons-aupair.com/)

## Teknik Derin Bakış

### 1. Ayrıştırılmış (Decoupled) Mikro Mimari
Platform, tamamen "headless" bir felsefe üzerine inşa edilmiştir.
- **Backend (Laravel 11)**: Tamamen stateless bir RESTful API olarak çalışır. Veri dönüşümü için **API Resources**, çok katmanlı doğrulama için **Form Requests** kullanır. 
- **Frontend (Nuxt 3)**: Sayfa yükleme sürelerini optimize etmek ve SEO performansını en üst düzeye çıkarmak için **SSR (Server-Side Rendering)** kullanır. **Pinia** ile yönetilen reaktif state yapısı, portal genelinde veri tutarlılığını garanti eder.

### 2. Olay Güdümlü (Event-Driven) IoT Entegrasyonu
Projenin en gelişmiş özelliklerinden biri, fiziksel donanım senkronizasyon katmanıdır.
- **Protokol**: TLS/SSL üzerinden MQTT.
- **Mantık**: Fiziksel donanım olaylarını Laravel'in iç Event sistemine bağlayan özel bir `MqttService` geliştirdim. Bir donanım tetikleyicisi alındığında, sistem asenkron bir olay başlatarak anlık bildirimler veya durum güncellemeleri gibi işlemlerin decoupled olarak yürütülmesini sağlar.

### 3. Güvenilirlik Mühendisliği ve Kendi Kendini İyileştirme
%99.9 çalışma süresini garanti etmek için Python ile özel bir "Watchdog" izleme seti uyguladım.
- **Servis İzleme**: PHP-FPM, Nginx ve MQTT Broker sağlığını her 30 saniyede bir doğrular.
- **Otomatik Kurtarma**: Bir servis hatası tespit edildiğinde, script otomatik bir kurtarma dizisi (Self-healing) başlatır.
- **Log Watchdog**: Uygulama loglarını gerçek zamanlı tarayarak kritik hataları kullanıcılar fark etmeden önce raporlar.

### 4. Bulut Operasyonları ve Güvenlik Sıkılaştırma
Altyapı, **Terraform** kullanılarak kod olarak tanımlanmış ve **AWS** üzerinde yayına alınmıştır.
- **Orchestration**: AWS ECS (Fargate) ile sunucusuz konteyner yönetimi ve otomatik ölçeklendirme.
- **Veritabanı**: Amazon RDS (Multi-AZ) ile otomatik failover ve zamanlanmış yedekleme.
- **Güvenlik**: Veritabanı ve uygulama katmanlarının özel subnet'lerde izole edildiği, sadece ALB üzerinden erişilebilen katmanlı bir VPC mimarisi.
