<!doctype html>
<html lang="en" class="h-full">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SmartBiz - Business Intelligence Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="/_sdk/element_sdk.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&amp;family=Space+Grotesk:wght@300..700&amp;display=swap" rel="stylesheet">
  <style>
    body {
      box-sizing: border-box;
    }
    * {
      font-family: 'DM Sans', sans-serif;
    }
    .heading-font {
      font-family: 'Space Grotesk', sans-serif;
    }
    html, body {
      height: 100%;
    }
    .app-wrapper {
      width: 100%;
      height: 100%;
      overflow-y: auto;
    }
    /* Hero animations */
    .hero-gradient {
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 25%, #e2e8f0 50%, #f0f4f8 75%, #f8fafc 100%);
      animation: gradientShift 15s ease infinite;
      background-size: 200% 200%;
    }
    @keyframes gradientShift {
      0%, 100% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
    }
    .floating {
      animation: floating 6s ease-in-out infinite;
    }
    @keyframes floating {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-20px); }
    }
    .floating-delayed {
      animation-delay: 2s;
    }
    .floating-delayed-2 {
      animation-delay: 4s;
    }
    .glow-card {
      transition: all 0.3s ease;
      border: 1px solid rgba(16, 185, 129, 0.1);
    }
    .glow-card:hover {
      border-color: rgba(16, 185, 129, 0.3);
      box-shadow: 0 0 30px rgba(16, 185, 129, 0.15);
      transform: translateY(-8px);
    }
    .stat-number {
      animation: countUp 2s ease forwards;
    }
    @keyframes countUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .hero-title {
      animation: slideInDown 0.8s ease forwards;
    }
    @keyframes slideInDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .hero-content {
      animation: slideInUp 0.8s ease forwards;
      animation-delay: 0.2s;
    }
    @keyframes slideInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .feature-card {
      animation: fadeInScale 0.6s ease forwards;
    }
    @keyframes fadeInScale {
      from {
        opacity: 0;
        transform: scale(0.95);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }
    .feature-card:nth-child(1) { animation-delay: 0.1s; }
    .feature-card:nth-child(2) { animation-delay: 0.2s; }
    .feature-card:nth-child(3) { animation-delay: 0.3s; }
    .feature-card:nth-child(4) { animation-delay: 0.4s; }
    .feature-card:nth-child(5) { animation-delay: 0.5s; }
    .feature-card:nth-child(6) { animation-delay: 0.6s; }
    .cta-button {
      position: relative;
      overflow: hidden;
      transition: all 0.3s ease;
    }
    .cta-button::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.2);
      transition: left 0.3s ease;
    }
    .cta-button:hover::before {
      left: 100%;
    }
    .gradient-text {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .scroll-reveal {
      opacity: 0;
      transform: translateY(40px);
      transition: all 0.7s ease;
    }
    .scroll-reveal.visible {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
 </head>
 <body class="h-full bg-slate-50">
 
  <div class="app-wrapper bg-white"><!-- Navigation Bar -->
   <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
     <div class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center">
       <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
       </svg>
      </div><span id="nav-brand" class="heading-font text-xl font-bold text-slate-900">SmartBiz</span>
     </div>
     <div class="hidden md:flex items-center gap-8"><a href="#features" class="text-slate-600 hover:text-emerald-600 font-medium transition-colors">Features</a> <a href="#how-it-works" class="text-slate-600 hover:text-emerald-600 font-medium transition-colors">How It Works</a> <a href="#pricing" class="text-slate-600 hover:text-emerald-600 font-medium transition-colors">Pricing</a> <a href="#contact" class="text-slate-600 hover:text-emerald-600 font-medium transition-colors">Contact</a>
     </div><button class="hidden md:block px-6 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors font-medium"> @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
            </button>
    </div>
   </nav><!-- Hero Section -->
   <section class="hero-gradient relative overflow-hidden px-6 py-20 md:py-32">
    <div class="absolute inset-0 opacity-30">
     <div class="absolute top-20 right-10 w-96 h-96 bg-emerald-400 rounded-full mix-blend-multiply filter blur-3xl floating"></div>
     <div class="absolute top-40 left-20 w-80 h-80 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl floating floating-delayed"></div>
     <div class="absolute bottom-20 right-40 w-72 h-72 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl floating floating-delayed-2"></div>
    </div>
    <div class="max-w-7xl mx-auto relative z-10">
     <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center"><!-- Left Content -->
      <div class="hero-content">
       <h1 id="hero-title" class="heading-font text-5xl md:text-7xl font-bold text-slate-900 mb-6 leading-tight">Manage Your Business,<br><span class="gradient-text">Effortlessly</span></h1>
       <p id="hero-subtitle" class="text-xl text-slate-600 mb-8 leading-relaxed">SmartBiz is the all-in-one dashboard designed for freelancers and small businesses. Track projects, manage invoices, and grow your business with powerful analytics.</p>
       <div class="flex flex-col sm:flex-row gap-4"><button id="cta-button" onclick="openTrialModal()" class="cta-button px-8 py-4 bg-emerald-500 text-white rounded-xl font-bold text-lg hover:bg-emerald-600 transition-all shadow-lg hover:shadow-xl"> Start Free Trial </button> <button onclick="openDemoModal()" class="px-8 py-4 border-2 border-slate-300 text-slate-900 rounded-xl font-bold text-lg hover:border-emerald-500 hover:text-emerald-600 transition-colors"> Watch Demo </button>
       </div>
       <p class="text-sm text-slate-500 mt-6">✓ No credit card required • ✓ 14 days free • ✓ Cancel anytime</p>
      </div><!-- Right Visual -->
      <div class="relative h-96 md:h-full hidden lg:block">
       <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/20 to-teal-500/20 rounded-3xl backdrop-blur-sm"></div>
       <div class="absolute inset-4 bg-white rounded-2xl shadow-2xl border border-emerald-100 overflow-hidden">
        <div class="h-full bg-gradient-to-br from-slate-50 to-slate-100 p-6 flex flex-col justify-between">
         <div class="space-y-4">
          <div class="h-4 bg-slate-300 rounded-full w-3/4"></div>
          <div class="h-3 bg-slate-200 rounded-full w-1/2"></div>
         </div>
         <div class="grid grid-cols-2 gap-4">
          <div class="p-4 bg-emerald-100 rounded-lg"></div>
          <div class="p-4 bg-blue-100 rounded-lg"></div>
          <div class="p-4 bg-purple-100 rounded-lg"></div>
          <div class="p-4 bg-amber-100 rounded-lg"></div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </section><!-- Stats Section -->
   <section class="py-16 md:py-24 px-6 bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto">
     <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
      <div class="text-center">
       <p class="stat-number heading-font text-4xl md:text-5xl font-bold text-emerald-600 mb-2">5,000+</p>
       <p class="text-slate-600 font-medium">Active Users</p>
      </div>
      <div class="text-center">
       <p class="stat-number heading-font text-4xl md:text-5xl font-bold text-blue-600 mb-2">$2.5M+</p>
       <p class="text-slate-600 font-medium">Revenue Managed</p>
      </div>
      <div class="text-center">
       <p class="stat-number heading-font text-4xl md:text-5xl font-bold text-purple-600 mb-2">99.9%</p>
       <p class="text-slate-600 font-medium">Uptime</p>
      </div>
      <div class="text-center">
       <p class="stat-number heading-font text-4xl md:text-5xl font-bold text-amber-600 mb-2">24/7</p>
       <p class="text-slate-600 font-medium">Support</p>
      </div>
     </div>
    </div>
   </section><!-- Features Section -->
   <section id="features" class="py-20 md:py-32 px-6 bg-gradient-to-b from-slate-50 to-white">
    <div class="max-w-7xl mx-auto">
     <div class="text-center mb-16">
      <h2 class="heading-font text-4xl md:text-5xl font-bold text-slate-900 mb-4">Powerful Features for Your Success</h2>
      <p class="text-xl text-slate-600 max-w-2xl mx-auto">Everything you need to manage your business, all in one place</p>
     </div>
     <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"><!-- Feature 1 -->
      <div class="feature-card glow-card bg-white rounded-2xl p-8 border border-slate-200">
       <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center mb-6">
        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
        </svg>
       </div>
       <h3 class="heading-font text-xl font-bold text-slate-900 mb-3">Analytics Dashboard</h3>
       <p class="text-slate-600 leading-relaxed">Get real-time insights into your business performance with beautiful, actionable dashboards and reports.</p>
      </div><!-- Feature 2 -->
      <div class="feature-card glow-card bg-white rounded-2xl p-8 border border-slate-200">
       <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center mb-6">
        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
       </div>
       <h3 class="heading-font text-xl font-bold text-slate-900 mb-3">Invoice Management</h3>
       <p class="text-slate-600 leading-relaxed">Create, send, and track invoices with automated reminders and multiple payment options.</p>
      </div><!-- Feature 3 -->
      <div class="feature-card glow-card bg-white rounded-2xl p-8 border border-slate-200">
       <div class="w-14 h-14 rounded-xl bg-purple-100 flex items-center justify-center mb-6">
        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
        </svg>
       </div>
       <h3 class="heading-font text-xl font-bold text-slate-900 mb-3">Project Tracking</h3>
       <p class="text-slate-600 leading-relaxed">Track project progress with task management, milestone tracking, and team collaboration tools.</p>
      </div><!-- Feature 4 -->
      <div class="feature-card glow-card bg-white rounded-2xl p-8 border border-slate-200">
       <div class="w-14 h-14 rounded-xl bg-amber-100 flex items-center justify-center mb-6">
        <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
       </div>
       <h3 class="heading-font text-xl font-bold text-slate-900 mb-3">Time Tracking</h3>
       <p class="text-slate-600 leading-relaxed">Track billable hours with precision timers and generate accurate time reports for clients.</p>
      </div><!-- Feature 5 -->
      <div class="feature-card glow-card bg-white rounded-2xl p-8 border border-slate-200">
       <div class="w-14 h-14 rounded-xl bg-rose-100 flex items-center justify-center mb-6">
        <svg class="w-7 h-7 text-rose-600" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
       </div>
       <h3 class="heading-font text-xl font-bold text-slate-900 mb-3">Client Management</h3>
       <p class="text-slate-600 leading-relaxed">Organize and manage all client information, contracts, and communication in one place.</p>
      </div><!-- Feature 6 -->
      <div class="feature-card glow-card bg-white rounded-2xl p-8 border border-slate-200">
       <div class="w-14 h-14 rounded-xl bg-indigo-100 flex items-center justify-center mb-6">
        <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
        </svg>
       </div>
       <h3 class="heading-font text-xl font-bold text-slate-900 mb-3">Smart Automation</h3>
       <p class="text-slate-600 leading-relaxed">Automate repetitive tasks and workflows to save time and focus on growing your business.</p>
      </div>
     </div>
    </div>
   </section><!-- How It Works -->
   <section id="how-it-works" class="py-20 md:py-32 px-6 bg-white">
    <div class="max-w-7xl mx-auto">
     <div class="text-center mb-16">
      <h2 class="heading-font text-4xl md:text-5xl font-bold text-slate-900 mb-4">How It Works</h2>
      <p class="text-xl text-slate-600 max-w-2xl mx-auto">Get started in minutes and see results immediately</p>
     </div>
     <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
      <div class="text-center">
       <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-6 heading-font text-2xl font-bold text-emerald-600">
        1
       </div>
       <h3 class="text-xl font-bold text-slate-900 mb-3">Sign Up</h3>
       <p class="text-slate-600">Create your account in seconds with just an email address.</p>
      </div>
      <div class="text-center">
       <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-6 heading-font text-2xl font-bold text-blue-600">
        2
       </div>
       <h3 class="text-xl font-bold text-slate-900 mb-3">Set Up</h3>
       <p class="text-slate-600">Configure your business details and preferences in minutes.</p>
      </div>
      <div class="text-center">
       <div class="w-16 h-16 rounded-full bg-purple-100 flex items-center justify-center mx-auto mb-6 heading-font text-2xl font-bold text-purple-600">
        3
       </div>
       <h3 class="text-xl font-bold text-slate-900 mb-3">Start Working</h3>
       <p class="text-slate-600">Manage projects, clients, and invoices with our intuitive tools.</p>
      </div>
      <div class="text-center">
       <div class="w-16 h-16 rounded-full bg-amber-100 flex items-center justify-center mx-auto mb-6 heading-font text-2xl font-bold text-amber-600">
        4
       </div>
       <h3 class="text-xl font-bold text-slate-900 mb-3">Grow</h3>
       <p class="text-slate-600">Use analytics and insights to scale your business faster.</p>
      </div>
     </div>
    </div>
   </section><!-- Pricing Section -->
   <section id="pricing" class="py-20 md:py-32 px-6 bg-gradient-to-b from-white to-slate-50">
    <div class="max-w-7xl mx-auto">
     <div class="text-center mb-16">
      <h2 class="heading-font text-4xl md:text-5xl font-bold text-slate-900 mb-4">Simple, Transparent Pricing</h2>
      <p class="text-xl text-slate-600 max-w-2xl mx-auto">Choose the plan that fits your business needs</p>
     </div>
     <div class="grid grid-cols-1 md:grid-cols-3 gap-8"><!-- Starter Plan -->
      <div class="glow-card bg-white rounded-2xl p-8 border border-slate-200">
       <h3 class="heading-font text-2xl font-bold text-slate-900 mb-2">Starter</h3>
       <p class="text-slate-600 mb-6">For freelancers just starting out</p>
       <div class="mb-6"><span class="heading-font text-4xl font-bold text-slate-900">$29</span> <span class="text-slate-600">/month</span>
       </div><button class="w-full px-6 py-3 border-2 border-slate-300 text-slate-900 rounded-lg font-bold hover:border-emerald-500 hover:text-emerald-600 transition-colors mb-8"> Get Started </button>
       <ul class="space-y-4 text-slate-600">
        <li class="flex items-center gap-3">
         <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewbox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
         </svg> Up to 5 projects</li>
        <li class="flex items-center gap-3">
         <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewbox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
         </svg> Basic invoicing</li>
        <li class="flex items-center gap-3">
         <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewbox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
         </svg> Email support</li>
       </ul>
      </div><!-- Pro Plan (Featured) -->
      <div class="glow-card bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-8 border border-emerald-400 relative transform scale-105 shadow-2xl">
       <div class="absolute top-0 right-0 bg-amber-400 text-slate-900 px-4 py-2 rounded-bl-xl rounded-tr-2xl text-sm font-bold">
        MOST POPULAR
       </div>
       <h3 class="heading-font text-2xl font-bold text-white mb-2 mt-4">Professional</h3>
       <p class="text-emerald-100 mb-6">For growing businesses</p>
       <div class="mb-6"><span class="heading-font text-4xl font-bold text-white">$79</span> <span class="text-emerald-100">/month</span>
       </div><button class="w-full px-6 py-3 bg-white text-emerald-600 rounded-lg font-bold hover:bg-emerald-50 transition-colors mb-8"> Start Free Trial </button>
       <ul class="space-y-4 text-white">
        <li class="flex items-center gap-3">
         <svg class="w-5 h-5 text-amber-300" fill="currentColor" viewbox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
         </svg> Unlimited projects</li>
        <li class="flex items-center gap-3">
         <svg class="w-5 h-5 text-amber-300" fill="currentColor" viewbox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
         </svg> Advanced invoicing</li>
        <li class="flex items-center gap-3">
         <svg class="w-5 h-5 text-amber-300" fill="currentColor" viewbox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
         </svg> Time tracking</li>
        <li class="flex items-center gap-3">
         <svg class="w-5 h-5 text-amber-300" fill="currentColor" viewbox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
         </svg> Priority support</li>
       </ul>
      </div><!-- Enterprise Plan -->
      <div class="glow-card bg-white rounded-2xl p-8 border border-slate-200">
       <h3 class="heading-font text-2xl font-bold text-slate-900 mb-2">Enterprise</h3>
       <p class="text-slate-600 mb-6">For large teams</p>
       <div class="mb-6"><span class="heading-font text-4xl font-bold text-slate-900">Custom</span> <span class="text-slate-600">/month</span>
       </div><button class="w-full px-6 py-3 bg-slate-800 text-white rounded-lg font-bold hover:bg-slate-900 transition-colors mb-8"> Contact Sales </button>
       <ul class="space-y-4 text-slate-600">
        <li class="flex items-center gap-3">
         <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewbox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
         </svg> Everything in Pro</li>
        <li class="flex items-center gap-3">
         <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewbox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
         </svg> Team collaboration</li>
        <li class="flex items-center gap-3">
         <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewbox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
         </svg> Custom integrations</li>
        <li class="flex items-center gap-3">
         <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewbox="0 0 20 20">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
         </svg> Dedicated support</li>
       </ul>
      </div>
     </div>
    </div>
   </section><!-- Testimonials Section -->
   <section class="py-20 md:py-32 px-6 bg-white">
    <div class="max-w-7xl mx-auto">
     <div class="text-center mb-16">
      <h2 class="heading-font text-4xl md:text-5xl font-bold text-slate-900 mb-4">Loved by Business Owners</h2>
      <p class="text-xl text-slate-600 max-w-2xl mx-auto">See what our customers have to say about SmartBiz</p>
     </div>
     <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-slate-50 rounded-2xl p-8 border border-slate-200">
       <div class="flex gap-1 mb-4">
        ${[...Array(5)].map(() =&gt; '
        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewbox="0 0 20 20">
         <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
        </svg>').join('')}
       </div>
       <p class="text-slate-600 mb-6">"SmartBiz has transformed how I manage my freelance business. The dashboard is intuitive and saves me hours every month."</p>
       <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-emerald-200 flex items-center justify-center text-emerald-700 font-bold heading-font">
         S
        </div>
        <div>
         <p class="font-bold text-slate-900">Sarah Martinez</p>
         <p class="text-sm text-slate-600">Web Designer</p>
        </div>
       </div>
      </div>
      <div class="bg-slate-50 rounded-2xl p-8 border border-slate-200">
       <div class="flex gap-1 mb-4">
        ${[...Array(5)].map(() =&gt; '
        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewbox="0 0 20 20">
         <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
        </svg>').join('')}
       </div>
       <p class="text-slate-600 mb-6">"The invoice tracking and time management features alone have helped me increase my revenue by 30%. Highly recommend!"</p>
       <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-blue-200 flex items-center justify-center text-blue-700 font-bold heading-font">
         J
        </div>
        <div>
         <p class="font-bold text-slate-900">James Wilson</p>
         <p class="text-sm text-slate-600">Software Developer</p>
        </div>
       </div>
      </div>
      <div class="bg-slate-50 rounded-2xl p-8 border border-slate-200">
       <div class="flex gap-1 mb-4">
        ${[...Array(5)].map(() =&gt; '
        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewbox="0 0 20 20">
         <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
        </svg>').join('')}
       </div>
       <p class="text-slate-600 mb-6">"Outstanding support and continuous improvements. The team really listens to user feedback. Worth every penny!"</p>
       <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-purple-200 flex items-center justify-center text-purple-700 font-bold heading-font">
         E
        </div>
        <div>
         <p class="font-bold text-slate-900">Emma Thompson</p>
         <p class="text-sm text-slate-600">Consultant</p>
        </div>
       </div>
      </div>
     </div>
    </div>
   </section><!-- Contact Section -->
   <section id="contact" class="py-20 md:py-32 px-6 bg-gradient-to-br from-slate-900 to-slate-800">
    <div class="max-w-7xl mx-auto">
     <div class="text-center mb-16">
      <h2 class="heading-font text-4xl md:text-5xl font-bold text-white mb-4">Get In Touch</h2>
      <p class="text-xl text-slate-300 max-w-2xl mx-auto">Have questions? We'd love to hear from you. Our team is here to help.</p>
     </div>
     <div class="grid grid-cols-1 md:grid-cols-2 gap-12"><!-- Contact Form -->
      <div class="bg-white rounded-2xl p-8">
       <form class="space-y-6" onsubmit="handleContactSubmit(event)">
        <div><label for="name" class="block text-sm font-medium text-slate-700 mb-2">Full Name</label> <input type="text" id="name" required class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>
        <div><label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email Address</label> <input type="email" id="email" required class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>
        <div><label for="company" class="block text-sm font-medium text-slate-700 mb-2">Company</label> <input type="text" id="company" class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>
        <div><label for="message" class="block text-sm font-medium text-slate-700 mb-2">Message</label> <textarea id="message" rows="5" required class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"></textarea>
        </div><button type="submit" class="w-full px-6 py-3 bg-emerald-500 text-white rounded-lg font-bold hover:bg-emerald-600 transition-colors"> Send Message </button>
       </form>
       <div id="form-message" class="mt-4 text-center text-sm hidden"></div>
      </div><!-- Contact Info -->
      <div class="space-y-8">
       <div class="flex gap-6">
        <div class="w-14 h-14 rounded-xl bg-emerald-500/20 flex items-center justify-center flex-shrink-0">
         <svg class="w-7 h-7 text-emerald-400" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
         </svg>
        </div>
        <div>
         <h3 class="text-lg font-bold text-white mb-2">Email</h3>
         <p class="text-slate-300">hello@smartbiz.io</p>
         <p class="text-slate-400 text-sm">We'll respond within 24 hours</p>
        </div>
       </div>
       <div class="flex gap-6">
        <div class="w-14 h-14 rounded-xl bg-blue-500/20 flex items-center justify-center flex-shrink-0">
         <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 00.948.684l1.498 4.493a1 1 0 00.502.756l2.048 1.029a2 2 0 002.063-3.356A10.02 10.02 0 003 12c0 1 0 7 10 13" />
         </svg>
        </div>
        <div>
         <h3 class="text-lg font-bold text-white mb-2">Phone</h3>
         <p class="text-slate-300">+1 (555) 123-4567</p>
         <p class="text-slate-400 text-sm">Monday to Friday, 9am to 6pm EST</p>
        </div>
       </div>
       <div class="flex gap-6">
        <div class="w-14 h-14 rounded-xl bg-purple-500/20 flex items-center justify-center flex-shrink-0">
         <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
         </svg>
        </div>
        <div>
         <h3 class="text-lg font-bold text-white mb-2">Address</h3>
         <p class="text-slate-300">123 Business Ave, Suite 100</p>
         <p class="text-slate-400 text-sm">San Francisco, CA 94107</p>
        </div>
       </div>
       <div class="pt-8 border-t border-slate-700">
        <h3 class="text-lg font-bold text-white mb-4">Follow Us</h3>
        <div class="flex gap-4"><a href="#" class="w-12 h-12 rounded-lg bg-slate-700 hover:bg-emerald-500 flex items-center justify-center transition-colors">
          <svg class="w-6 h-6 text-white" fill="currentColor" viewbox="0 0 24 24">
           <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
          </svg></a> <a href="#" class="w-12 h-12 rounded-lg bg-slate-700 hover:bg-emerald-500 flex items-center justify-center transition-colors">
          <svg class="w-6 h-6 text-white" fill="currentColor" viewbox="0 0 24 24">
           <path d="M23.953 4.57a10 10 0 02-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
          </svg></a> <a href="#" class="w-12 h-12 rounded-lg bg-slate-700 hover:bg-emerald-500 flex items-center justify-center transition-colors">
          <svg class="w-6 h-6 text-white" fill="currentColor" viewbox="0 0 24 24">
           <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.475-2.236-1.986-2.236-1.081 0-1.722.722-2.006 1.419-.103.249-.129.597-.129.946v5.44h-3.562s.05-8.846 0-9.764h3.554v1.391c.435-.671 1.217-1.627 2.966-1.627 2.164 0 3.787 1.414 3.787 4.455v5.545zM5.337 9.433c-1.144 0-1.915-.758-1.915-1.704 0-.951.767-1.703 1.96-1.703 1.188 0 1.914.75 1.939 1.703 0 .946-.751 1.704-1.984 1.704zm1.582 11.019H3.771V9.668h3.148v10.784zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.225 0z" />
          </svg></a>
        </div>
       </div>
      </div>
     </div>
    </div>
   </section><!-- CTA Section -->
   <section class="py-20 md:py-32 px-6 bg-gradient-to-r from-emerald-500 to-teal-600 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
     <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-multiply filter blur-3xl floating"></div>
    </div>
    <div class="max-w-4xl mx-auto text-center relative z-10">
     <h2 class="heading-font text-4xl md:text-5xl font-bold text-white mb-6">Ready to Transform Your Business?</h2>
     <p class="text-xl text-emerald-100 mb-10">Join thousands of successful freelancers and business owners using SmartBiz</p>
     <div class="flex flex-col sm:flex-row gap-4 justify-center"><button onclick="openTrialModal()" class="cta-button px-10 py-4 bg-white text-emerald-600 rounded-xl font-bold text-lg hover:bg-emerald-50 transition-all shadow-lg"> Start Your Free Trial </button> <button onclick="openDemoModal()" class="px-10 py-4 border-2 border-white text-white rounded-xl font-bold text-lg hover:bg-white/10 transition-colors"> Schedule a Demo </button>
     </div>
    </div>
   </section><!-- Footer -->
   <footer class="bg-slate-900 text-slate-300 py-16 px-6">
    <div class="max-w-7xl mx-auto">
     <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
      <div>
       <div class="flex items-center gap-2 mb-4">
        <div class="w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center">
         <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
         </svg>
        </div><span class="heading-font text-lg font-bold text-white">SmartBiz</span>
       </div>
       <p class="text-sm text-slate-400">Manage your business with confidence.</p>
      </div>
      <div>
       <h3 class="font-bold text-white mb-4">Product</h3>
       <ul class="space-y-2 text-sm">
        <li><a href="#features" class="hover:text-emerald-400 transition-colors">Features</a></li>
        <li><a href="#pricing" class="hover:text-emerald-400 transition-colors">Pricing</a></li>
        <li><a href="#" class="hover:text-emerald-400 transition-colors">Security</a></li>
        <li><a href="#" class="hover:text-emerald-400 transition-colors">Roadmap</a></li>
       </ul>
      </div>
      <div>
       <h3 class="font-bold text-white mb-4">Company</h3>
       <ul class="space-y-2 text-sm">
        <li><a href="#" class="hover:text-emerald-400 transition-colors">About</a></li>
        <li><a href="#" class="hover:text-emerald-400 transition-colors">Blog</a></li>
        <li><a href="#" class="hover:text-emerald-400 transition-colors">Careers</a></li>
        <li><a href="#" class="hover:text-emerald-400 transition-colors">Press</a></li>
       </ul>
      </div>
      <div>
       <h3 class="font-bold text-white mb-4">Legal</h3>
       <ul class="space-y-2 text-sm">
        <li><a href="#" class="hover:text-emerald-400 transition-colors">Privacy</a></li>
        <li><a href="#" class="hover:text-emerald-400 transition-colors">Terms</a></li>
        <li><a href="#" class="hover:text-emerald-400 transition-colors">Cookie Policy</a></li>
        <li><a href="#" class="hover:text-emerald-400 transition-colors">Contact</a></li>
       </ul>
      </div>
     </div>
     <div class="border-t border-slate-800 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-slate-400">
      <p>© 2024 SmartBiz. All rights reserved.</p>
      <div class="flex gap-6"><a href="#" class="hover:text-emerald-400 transition-colors">Privacy Policy</a> <a href="#" class="hover:text-emerald-400 transition-colors">Terms of Service</a> <a href="#" class="hover:text-emerald-400 transition-colors">Cookies</a>
      </div>
     </div>
    </div>
   </footer>
  </div><!-- Free Trial Modal -->
  <div id="trial-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
   <div class="modal-content bg-white rounded-2xl max-w-md w-full p-8 max-h-[90vh] overflow-y-auto">
    <div class="flex items-center justify-between mb-6">
     <h2 class="heading-font text-2xl font-bold text-slate-900">Start Your 14-Day Free Trial</h2><button onclick="closeTrialModal()" class="text-slate-400 hover:text-slate-600">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg></button>
    </div>
    <form onsubmit="handleTrialSignup(event)" class="space-y-4">
     <div><label for="trial-name" class="block text-sm font-medium text-slate-700 mb-1">Full Name</label> <input type="text" id="trial-name" required class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
     </div>
     <div><label for="trial-email" class="block text-sm font-medium text-slate-700 mb-1">Email Address</label> <input type="email" id="trial-email" required class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
     </div>
     <div><label for="trial-password" class="block text-sm font-medium text-slate-700 mb-1">Password</label> <input type="password" id="trial-password" required class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
     </div>
     <div><label for="trial-company" class="block text-sm font-medium text-slate-700 mb-1">Company Name</label> <input type="text" id="trial-company" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
     </div>
     <div class="flex items-center gap-2"><input type="checkbox" id="trial-terms" required class="w-4 h-4 rounded border-slate-300 text-emerald-500"> <label for="trial-terms" class="text-sm text-slate-600">I agree to the Terms of Service</label>
     </div><button type="submit" class="w-full px-4 py-3 bg-emerald-500 text-white rounded-lg font-bold hover:bg-emerald-600 transition-colors"> Start Free Trial </button>
     <p class="text-xs text-slate-500 text-center">✓ No credit card required • ✓ 14 days free • ✓ Cancel anytime</p>
    </form>
    <div id="trial-success" class="hidden text-center py-8">
     <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-4">
      <svg class="w-8 h-8 text-emerald-600" fill="currentColor" viewbox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
      </svg>
     </div>
     <h3 class="heading-font text-xl font-bold text-slate-900 mb-2">Welcome to SmartBiz!</h3>
     <p class="text-slate-600 mb-6">Check your email to confirm your account and get started.</p><button onclick="closeTrialModal()" class="px-6 py-2 bg-emerald-500 text-white rounded-lg font-medium hover:bg-emerald-600 transition-colors"> Close </button>
    </div>
   </div>
  </div><!-- Demo Video Modal -->
  <div id="demo-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
   <div class="modal-content bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
    <div class="flex items-center justify-between p-6 border-b border-slate-200">
     <h2 class="heading-font text-2xl font-bold text-slate-900">Watch a Demo</h2><button onclick="closeDemoModal()" class="text-slate-400 hover:text-slate-600">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg></button>
    </div>
    <div class="p-6">
     <div class="relative w-full pb-[56.25%] bg-slate-900 rounded-lg overflow-hidden mb-6">
      <div class="absolute inset-0 flex items-center justify-center"><button onclick="playVideo()" class="flex items-center justify-center w-20 h-20 rounded-full bg-emerald-500 hover:bg-emerald-600 transition-colors shadow-lg">
        <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewbox="0 0 24 24"><path d="M8 5v14l11-7z" />
        </svg></button>
      </div>
      <div id="video-placeholder" class="absolute inset-0 bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center">
       <div class="text-center">
        <svg class="w-16 h-16 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <p class="text-slate-400 text-sm">8 minute product demo</p>
       </div>
      </div>
     </div>
     <div class="space-y-4">
      <h3 class="heading-font text-lg font-bold text-slate-900">In this demo, you'll learn:</h3>
      <ul class="space-y-2 text-slate-600">
       <li class="flex items-start gap-3">
        <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewbox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg><span>How to set up your business profile and connect your first client</span></li>
       <li class="flex items-start gap-3">
        <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewbox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg><span>Creating and sending invoices with automated reminders</span></li>
       <li class="flex items-start gap-3">
        <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewbox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg><span>Tracking project progress and managing your time effectively</span></li>
       <li class="flex items-start gap-3">
        <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewbox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg><span>Accessing powerful analytics and reports to grow your business</span></li>
      </ul>
     </div>
     <div class="mt-6 p-4 bg-emerald-50 rounded-lg border border-emerald-200">
      <p class="text-sm text-slate-600"><span class="font-semibold text-slate-900">Ready to get started?</span> Click the button below to start your free 14-day trial with no credit card required.</p>
     </div><button onclick="closeDemoModal(); openTrialModal();" class="w-full mt-6 px-6 py-3 bg-emerald-500 text-white rounded-lg font-bold hover:bg-emerald-600 transition-colors"> Start Free Trial Now </button>
    </div>
   </div>
  </div>
  <script>
    const defaultConfig = {
      hero_title: 'Manage Your Business, Effortlessly',
      hero_subtitle: 'SmartBiz is the all-in-one dashboard designed for freelancers and small businesses. Track projects, manage invoices, and grow your business with powerful analytics.',
      cta_text: 'Start Free Trial',
      company_name: 'SmartBiz',
      background_color: '#ffffff',
      primary_action_color: '#10b981',
      secondary_action_color: '#6366f1',
      text_color: '#1e293b',
      font_family: 'DM Sans',
      font_size: 16
    };

    let config = { ...defaultConfig };

    // Modal functions
    function openTrialModal() {
      const modal = document.getElementById('trial-modal');
      modal.classList.remove('hidden');
      document.getElementById('trial-success').classList.add('hidden');
      document.querySelector('#trial-modal form').style.display = 'block';
    }

    function closeTrialModal() {
      document.getElementById('trial-modal').classList.add('hidden');
    }

    function openDemoModal() {
      document.getElementById('demo-modal').classList.remove('hidden');
    }

    function closeDemoModal() {
      document.getElementById('demo-modal').classList.add('hidden');
    }

    function playVideo() {
      const placeholder = document.getElementById('video-placeholder');
      const videoContainer = placeholder.parentElement;
      
      placeholder.innerHTML = `
        <iframe
          class="absolute inset-0 w-full h-full"
          src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen>
        </iframe>
      `;
    }

    function handleTrialSignup(event) {
      event.preventDefault();
      
      const name = document.getElementById('trial-name').value;
      const email = document.getElementById('trial-email').value;
      const company = document.getElementById('trial-company').value;
      
      // Show success message
      document.querySelector('#trial-modal form').style.display = 'none';
      document.getElementById('trial-success').classList.remove('hidden');
    }

    function handleContactSubmit(event) {
      event.preventDefault();
      const name = document.getElementById('name').value;
      const email = document.getElementById('email').value;
      const company = document.getElementById('company').value;
      const message = document.getElementById('message').value;

      const formMessage = document.getElementById('form-message');
      formMessage.classList.remove('hidden');
      formMessage.classList.add('text-emerald-600');
      formMessage.textContent = '✓ Thank you! We\'ll get back to you shortly.';

      event.target.reset();
      setTimeout(() => formMessage.classList.add('hidden'), 5000);
    }

    async function onConfigChange(newConfig) {
      config = { ...config, ...newConfig };

      // Update hero title
      const heroTitle = document.getElementById('hero-title');
      if (heroTitle && newConfig.hero_title) {
        heroTitle.textContent = newConfig.hero_title;
      }

      // Update hero subtitle
      const heroSubtitle = document.getElementById('hero-subtitle');
      if (heroSubtitle && newConfig.hero_subtitle) {
        heroSubtitle.textContent = newConfig.hero_subtitle;
      }

      // Update CTA button text
      const ctaButton = document.getElementById('cta-button');
      if (ctaButton && newConfig.cta_text) {
        ctaButton.textContent = newConfig.cta_text;
      }

      // Update brand name
      const navBrand = document.getElementById('nav-brand');
      if (navBrand && newConfig.company_name) {
        navBrand.textContent = newConfig.company_name;
      }

      // Apply colors
      if (newConfig.primary_action_color) {
        const primaryColor = newConfig.primary_action_color;
        document.documentElement.style.setProperty('--primary-color', primaryColor);
      }

      // Apply font
      if (newConfig.font_family) {
        const customFont = newConfig.font_family;
        document.body.style.fontFamily = `${customFont}, Arial, sans-serif`;
      }

      // Apply font size
      if (newConfig.font_size) {
        const baseSize = newConfig.font_size;
        document.documentElement.style.fontSize = `${baseSize}px`;
      }
    }

    function mapToCapabilities(config) {
      return {
        recolorables: [
          {
            get: () => config.primary_action_color || defaultConfig.primary_action_color,
            set: (value) => {
              config.primary_action_color = value;
              window.elementSdk.setConfig({ primary_action_color: value });
            }
          }
        ],
        borderables: [],
        fontEditable: {
          get: () => config.font_family || defaultConfig.font_family,
          set: (value) => {
            config.font_family = value;
            window.elementSdk.setConfig({ font_family: value });
          }
        },
        fontSizeable: {
          get: () => config.font_size || defaultConfig.font_size,
          set: (value) => {
            config.font_size = value;
            window.elementSdk.setConfig({ font_size: value });
          }
        }
      };
    }

    function mapToEditPanelValues(config) {
      return new Map([
        ['hero_title', config.hero_title || defaultConfig.hero_title],
        ['hero_subtitle', config.hero_subtitle || defaultConfig.hero_subtitle],
        ['cta_text', config.cta_text || defaultConfig.cta_text],
        ['company_name', config.company_name || defaultConfig.company_name]
      ]);
    }

    if (window.elementSdk) {
      window.elementSdk.init({
        defaultConfig,
        onConfigChange,
        mapToCapabilities,
        mapToEditPanelValues
      });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href === '#') return;
        e.preventDefault();
        const element = document.querySelector(href);
        if (element) {
          element.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    });

    // Close modals when clicking outside
    document.getElementById('trial-modal').addEventListener('click', function(e) {
      if (e.target === this) closeTrialModal();
    });

    document.getElementById('demo-modal').addEventListener('click', function(e) {
      if (e.target === this) closeDemoModal();
    });

    // Close modals on escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeTrialModal();
        closeDemoModal();
      }
    });
  </script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9c788e63907111bc',t:'MTc3MDAyMzQzNS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>