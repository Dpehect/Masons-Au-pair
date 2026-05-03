<template>
  <div class="app-container">
    <header class="main-header">
      <nav class="nav-content">
        <div class="logo">MASONS <span>AU PAIR</span></div>
        <div class="nav-links">
          <a href="#">Find an Au Pair</a>
          <a href="#">Become an Au Pair</a>
          <a href="#" class="btn-login">Login</a>
          <a href="#" class="btn-primary">Get Started</a>
        </div>
      </nav>
    </header>

    <main>
      <section class="hero">
        <div class="hero-content">
          <h1>Find Your Perfect <br><span class="gradient-text">Cultural Match</span></h1>
          <p>The premium matching platform for families and au pairs worldwide.</p>
          <div class="hero-cta">
            <button class="btn-primary-large">I am a Family</button>
            <button class="btn-secondary-large">I am an Au Pair</button>
          </div>
        </div>
        <div class="hero-visual">
          <div class="glass-card">
            <h3>10-Step Matching</h3>
            <p>Our rigorous screening process ensures 99% placement success.</p>
          </div>
        </div>
      </section>
    </main>

    <footer class="main-footer">
      <p>&copy; 2024 Masons Au Pair. All rights reserved.</p>
    </footer>
  </div>
</template>

<style>
:root {
  --primary: #1a1a1a;
  --accent: #d4af37; /* Gold */
  --accent-light: #f4e4bc;
  --text-dark: #121212;
  --text-light: #666;
  --bg-light: #f9f9f9;
}

body {
  margin: 0;
  font-family: 'Inter', sans-serif;
  background: var(--bg-light);
  color: var(--text-dark);
}

.main-header {
  padding: 1.5rem 5%;
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(10px);
  position: sticky;
  top: 0;
  z-index: 100;
  border-bottom: 1px solid rgba(0,0,0,0.05);
}

.nav-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.logo {
  font-size: 1.5rem;
  font-weight: 800;
  letter-spacing: -1px;
}

.logo span {
  color: var(--accent);
}

.nav-links {
  display: flex;
  gap: 2rem;
  align-items: center;
}

.nav-links a {
  text-decoration: none;
  color: var(--text-dark);
  font-weight: 500;
  transition: color 0.3s;
}

.nav-links a:hover {
  color: var(--accent);
}

.btn-primary {
  background: var(--primary);
  color: white !important;
  padding: 0.8rem 1.5rem;
  border-radius: 50px;
  font-weight: 600;
}

.hero {
  padding: 8rem 5%;
  display: grid;
  grid-template-columns: 1.2fr 0.8fr;
  align-items: center;
  gap: 4rem;
}

.hero h1 {
  font-size: 4.5rem;
  line-height: 1.1;
  margin-bottom: 1.5rem;
}

.gradient-text {
  background: linear-gradient(45deg, #1a1a1a, var(--accent));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.hero p {
  font-size: 1.2rem;
  color: var(--text-light);
  max-width: 500px;
  margin-bottom: 3rem;
}

.hero-cta {
  display: flex;
  gap: 1rem;
}

.btn-primary-large, .btn-secondary-large {
  padding: 1.2rem 2.5rem;
  border-radius: 50px;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: transform 0.3s, box-shadow 0.3s;
}

.btn-primary-large {
  background: var(--primary);
  color: white;
  border: none;
}

.btn-secondary-large {
  background: transparent;
  color: var(--primary);
  border: 2px solid var(--primary);
}

.btn-primary-large:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.glass-card {
  background: rgba(255, 255, 255, 0.7);
  backdrop-filter: blur(20px);
  padding: 2.5rem;
  border-radius: 24px;
  border: 1px solid rgba(255, 255, 255, 0.3);
  box-shadow: 0 20px 40px rgba(0,0,0,0.05);
}

.main-footer {
  padding: 4rem 5%;
  text-align: center;
  border-top: 1px solid rgba(0,0,0,0.05);
  color: var(--text-light);
}
</style>
