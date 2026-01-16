    const defaultConfig = {
      app_title: 'SmartBiz',
      welcome_message: 'Welcome back',
      user_name: 'Alex',
      background_color: '#f8fafc',
      sidebar_color: '#0f172a',
      text_color: '#1e293b',
      primary_action_color: '#10b981',
      secondary_action_color: '#6366f1',
      font_family: 'DM Sans',
      font_size: 16
    };
    
    // Data storage
    let projects = [
      {id: 1, name: 'E-commerce Redesign', client: 'TechStart Inc.', budget: '$4,500', progress: 75, status: 'In Progress', color: 'from-pink-400 to-rose-500', initial: 'E'},
      {id: 2, name: 'Mobile App Development', client: 'HealthPlus', budget: '$8,200', progress: 45, status: 'In Progress', color: 'from-blue-400 to-indigo-500', initial: 'M'},
      {id: 3, name: 'Brand Identity Package', client: 'Cafe Sunrise', budget: '$2,800', progress: 90, status: 'Almost Done', color: 'from-amber-400 to-orange-500', initial: 'B'}
    ];
    
    let clients = [
      {id: 1, name: 'TechStart Inc.', contact: 'john@techstart.com', projects: 2, value: '$6,750', status: 'Active'},
      {id: 2, name: 'HealthPlus', contact: 'sarah@healthplus.io', projects: 1, value: '$8,200', status: 'Active'},
      {id: 3, name: 'Cafe Sunrise', contact: 'mike@cafesunrise.com', projects: 1, value: '$2,800', status: 'Active'}
    ];
    
    let invoices = [
      {id: 1, invoiceId: 'INV-2024-001', client: 'TechStart Inc.', date: 'Dec 15, 2024', amount: '$2,250', status: 'Paid', statusColor: 'emerald'},
      {id: 2, invoiceId: 'INV-2024-002', client: 'HealthPlus', date: 'Dec 18, 2024', amount: '$4,100', status: 'Pending', statusColor: 'amber'},
      {id: 3, invoiceId: 'INV-2024-003', client: 'Cafe Sunrise', date: 'Dec 10, 2024', amount: '$1,400', status: 'Overdue', statusColor: 'rose'}
    ];
    
    let expenses = [
      {id: 1, category: 'Software', item: 'Adobe Creative Cloud', date: 'Dec 20, 2024', amount: '$52.99'},
      {id: 2, category: 'Office', item: 'Desk Chair', date: 'Dec 18, 2024', amount: '$245.00'},
      {id: 3, category: 'Marketing', item: 'Google Ads Campaign', date: 'Dec 15, 2024', amount: '$380.00'}
    ];
    
    let timeEntries = [
      {id: 1, project: 'E-commerce Redesign', task: 'Homepage layout design', duration: '2h 30m', date: 'Today', status: 'Completed'},
      {id: 2, project: 'Mobile App Development', task: 'Backend API integration', duration: '3h 15m', date: 'Today', status: 'Completed'}
    ];
    
    let nextProjectId = 4;
    let nextClientId = 4;
    let nextInvoiceId = 4;
    let nextExpenseId = 4;
    let nextTimeId = 3;
    
    // Modal functions
    function showModal(modalId) {
      const modal = document.getElementById(modalId);
      if (modal) {
        modal.classList.remove('hidden');
      }
    }
    
    function hideModal(modalId) {
      const modal = document.getElementById(modalId);
      if (modal) {
        modal.classList.add('hidden');
      }
    }
    
    
    // Project CRUD functions
  
    
   
    
    function handleProjectSubmit(e) {
      e.preventDefault();
      const name = document.getElementById('project-name').value;
      const client = document.getElementById('project-client').value;
      const budget = document.getElementById('project-budget').value;
      const status = document.getElementById('project-status').value;
      
      const colors = ['from-pink-400 to-rose-500', 'from-blue-400 to-indigo-500', 'from-amber-400 to-orange-500', 'from-emerald-400 to-teal-500', 'from-purple-400 to-pink-500'];
      const randomColor = colors[Math.floor(Math.random() * colors.length)];
      
      projects.push({
        id: nextProjectId++,
        name,
        client,
        budget,
        progress: 0,
        status,
        color: randomColor,
        initial: name.charAt(0).toUpperCase()
      });
      
      toggleProjectForm();
      showPage('projects');
    }
    
    function deleteProject(id) {
      projects = projects.filter(p => p.id !== id);
      showPage('projects');
    }
    
   // sweetAlert for deleting client
document.addEventListener('submit', function (e) {
    if (e.target.classList.contains('delete-client-form')) {
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "This client will be permanently deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, delete it',
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        });
    }
});


    
   
    
   
    
    // Invoice CRUD functions
    function toggleInvoiceForm() {
      const form = document.getElementById('invoice-form-container');
      if (form.classList.contains('hidden')) {
        form.classList.remove('hidden');
      } else {
        form.classList.add('hidden');
        document.getElementById('invoice-form').reset();
      }
    }
    
    function viewInvoice(id) {
      const invoice = invoices.find(i => i.id === id);
      if (!invoice) return;
      
      const modalContent = `
        <div id="invoice-view-modal" class="modal-backdrop fixed inset-0 bg-black/50 flex items-center justify-center z-50">
          <div class="modal-content bg-white rounded-2xl p-8 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-start justify-between mb-6">
              <div>
                <h2 class="heading-font text-2xl font-bold text-slate-800">${invoice.invoiceId}</h2>
                <p class="text-slate-500">${invoice.client}</p>
              </div>
              <button onclick="hideModal('invoice-view-modal')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
              </button>
            </div>
            
            <div class="space-y-6">
              <div class="grid grid-cols-3 gap-4">
                <div class="bg-slate-50 rounded-xl p-4">
                  <p class="text-sm text-slate-600 mb-1">Amount</p>
                  <p class="heading-font text-2xl font-bold text-slate-800">${invoice.amount}</p>
                </div>
                <div class="bg-slate-50 rounded-xl p-4">
                  <p class="text-sm text-slate-600 mb-1">Status</p>
                  <span class="inline-block text-sm font-medium text-${invoice.statusColor}-600 bg-${invoice.statusColor}-100 px-3 py-1 rounded-full">${invoice.status}</span>
                </div>
                <div class="bg-slate-50 rounded-xl p-4">
                  <p class="text-sm text-slate-600 mb-1">Date</p>
                  <p class="font-medium text-slate-800">${invoice.date}</p>
                </div>
              </div>
              
              <div class="border-t pt-6">
                <h3 class="font-bold text-slate-800 mb-4">Invoice Details</h3>
                <div class="space-y-3">
                  <div class="flex justify-between">
                    <span class="text-slate-600">Invoice ID</span>
                    <span class="font-medium text-slate-800">${invoice.invoiceId}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-slate-600">Client</span>
                    <span class="font-medium text-slate-800">${invoice.client}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-slate-600">Issue Date</span>
                    <span class="font-medium text-slate-800">${invoice.date}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-slate-600">Due Date</span>
                    <span class="font-medium text-slate-800">Dec 30, 2024</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-slate-600">Payment Terms</span>
                    <span class="font-medium text-slate-800">Net 30</span>
                  </div>
                </div>
              </div>
              
              <div class="border-t pt-6">
                <h3 class="font-bold text-slate-800 mb-4">Line Items</h3>
                <div class="space-y-2">
                  <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg">
                    <div>
                      <p class="font-medium text-slate-800">Design Services</p>
                      <p class="text-sm text-slate-500">40 hours × $50/hr</p>
                    </div>
                    <span class="font-bold text-slate-800">$2,000</span>
                  </div>
                  <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg">
                    <div>
                      <p class="font-medium text-slate-800">Development Work</p>
                      <p class="text-sm text-slate-500">30 hours × $75/hr</p>
                    </div>
                    <span class="font-bold text-slate-800">$2,250</span>
                  </div>
                  <div class="flex justify-between items-center p-4 bg-emerald-50 rounded-lg border-2 border-emerald-200">
                    <span class="font-bold text-slate-800">Total</span>
                    <span class="heading-font text-2xl font-bold text-emerald-600">${invoice.amount}</span>
                  </div>
                </div>
              </div>
              
              <div class="flex gap-3 pt-4">
                <button onclick="hideModal('invoice-view-modal')" class="flex-1 px-6 py-3 bg-slate-100 text-slate-700 rounded-xl font-medium hover:bg-slate-200 transition-colors">Close</button>
                <button class="px-6 py-3 bg-blue-500 text-white rounded-xl font-medium hover:bg-blue-600 transition-colors">Download PDF</button>
                <button class="px-6 py-3 bg-emerald-500 text-white rounded-xl font-medium hover:bg-emerald-600 transition-colors">Send Email</button>
              </div>
            </div>
          </div>
        </div>
      `;
      
      document.body.insertAdjacentHTML('beforeend', modalContent);
    }
    
    function handleInvoiceSubmit(e) {
      e.preventDefault();
      const client = document.getElementById('invoice-client').value;
      const amount = document.getElementById('invoice-amount').value;
      const status = document.getElementById('invoice-status').value;
      
      const statusColors = {
        'Paid': 'emerald',
        'Pending': 'amber',
        'Overdue': 'rose'
      };
      
      const today = new Date();
      const dateStr = today.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
      
      invoices.push({
        id: nextInvoiceId,
        invoiceId: `INV-2024-${String(nextInvoiceId).padStart(3, '0')}`,
        client,
        date: dateStr,
        amount,
        status,
        statusColor: statusColors[status]
      });
      nextInvoiceId++;
      
      toggleInvoiceForm();
      showPage('invoices');
    }
    
    function deleteInvoice(id) {
      invoices = invoices.filter(i => i.id !== id);
      showPage('invoices');
    }
    
    // Expense CRUD functions
    function toggleExpenseForm() {
      const form = document.getElementById('expense-form-container');
      if (form.classList.contains('hidden')) {
        form.classList.remove('hidden');
      } else {
        form.classList.add('hidden');
        document.getElementById('expense-form').reset();
      }
    }
    
    function viewExpense(id) {
      const expense = expenses.find(e => e.id === id);
      if (!expense) return;
      
      const modalContent = `
        <div id="expense-view-modal" class="modal-backdrop fixed inset-0 bg-black/50 flex items-center justify-center z-50">
          <div class="modal-content bg-white rounded-2xl p-8 max-w-xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-start justify-between mb-6">
              <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl bg-slate-100 flex items-center justify-center">
                  <svg class="w-7 h-7 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                </div>
                <div>
                  <h2 class="heading-font text-2xl font-bold text-slate-800">${expense.item}</h2>
                  <p class="text-slate-500">${expense.category}</p>
                </div>
              </div>
              <button onclick="hideModal('expense-view-modal')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
              </button>
            </div>
            
            <div class="space-y-6">
              <div class="grid grid-cols-2 gap-4">
                <div class="bg-slate-50 rounded-xl p-4">
                  <p class="text-sm text-slate-600 mb-1">Amount</p>
                  <p class="heading-font text-2xl font-bold text-slate-800">${expense.amount}</p>
                </div>
                <div class="bg-slate-50 rounded-xl p-4">
                  <p class="text-sm text-slate-600 mb-1">Date</p>
                  <p class="font-medium text-slate-800">${expense.date}</p>
                </div>
              </div>
              
              <div class="border-t pt-6">
                <h3 class="font-bold text-slate-800 mb-4">Expense Details</h3>
                <div class="space-y-3">
                  <div class="flex justify-between">
                    <span class="text-slate-600">Description</span>
                    <span class="font-medium text-slate-800">${expense.item}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-slate-600">Category</span>
                    <span class="font-medium text-slate-800">${expense.category}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-slate-600">Expense ID</span>
                    <span class="font-medium text-slate-800">#EXP-${String(expense.id).padStart(4, '0')}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-slate-600">Payment Method</span>
                    <span class="font-medium text-slate-800">Business Credit Card</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-slate-600">Vendor</span>
                    <span class="font-medium text-slate-800">Adobe Inc.</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-slate-600">Tax Deductible</span>
                    <span class="font-medium text-emerald-600">Yes</span>
                  </div>
                </div>
              </div>
              
              <div class="border-t pt-6">
                <h3 class="font-bold text-slate-800 mb-3">Notes</h3>
                <div class="bg-slate-50 rounded-lg p-4">
                  <p class="text-slate-600 text-sm">Monthly subscription for design tools and creative software. Essential for client projects.</p>
                </div>
              </div>
              
              <div class="flex gap-3 pt-4">
                <button onclick="hideModal('expense-view-modal')" class="flex-1 px-6 py-3 bg-slate-100 text-slate-700 rounded-xl font-medium hover:bg-slate-200 transition-colors">Close</button>
                <button class="flex-1 px-6 py-3 bg-emerald-500 text-white rounded-xl font-medium hover:bg-emerald-600 transition-colors">Edit Expense</button>
              </div>
            </div>
          </div>
        </div>
      `;
      
      document.body.insertAdjacentHTML('beforeend', modalContent);
    }
    
    function handleExpenseSubmit(e) {
      e.preventDefault();
      const category = document.getElementById('expense-category').value;
      const item = document.getElementById('expense-item').value;
      const amount = document.getElementById('expense-amount').value;
      
      const today = new Date();
      const dateStr = today.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
      
      expenses.push({
        id: nextExpenseId++,
        category,
        item,
        date: dateStr,
        amount
      });
      
      toggleExpenseForm();
      showPage('expenses');
    }
    
    function deleteExpense(id) {
      expenses = expenses.filter(e => e.id !== id);
      showPage('expenses');
    }
    
    // Time tracking CRUD functions
    function toggleTimeForm() {
      const form = document.getElementById('time-form-container');
      if (form.classList.contains('hidden')) {
        form.classList.remove('hidden');
      } else {
        form.classList.add('hidden');
        document.getElementById('time-form').reset();
      }
    }
    
    function viewTimeEntry(id) {
      const entry = timeEntries.find(t => t.id === id);
      if (!entry) return;
      
      const modalContent = `
        <div id="time-view-modal" class="modal-backdrop fixed inset-0 bg-black/50 flex items-center justify-center z-50">
          <div class="modal-content bg-white rounded-2xl p-8 max-w-xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-start justify-between mb-6">
              <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center">
                  <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                </div>
                <div>
                  <h2 class="heading-font text-2xl font-bold text-slate-800">${entry.task}</h2>
                  <p class="text-slate-500">${entry.project}</p>
                </div>
              </div>
              <button onclick="hideModal('time-view-modal')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
              </button>
            </div>
            
            <div class="space-y-6">
              <div class="grid grid-cols-3 gap-4">
                <div class="bg-slate-50 rounded-xl p-4">
                  <p class="text-sm text-slate-600 mb-1">Duration</p>
                  <p class="heading-font text-2xl font-bold text-slate-800">${entry.duration}</p>
                </div>
                <div class="bg-slate-50 rounded-xl p-4">
                  <p class="text-sm text-slate-600 mb-1">Date</p>
                  <p class="font-medium text-slate-800">${entry.date}</p>
                </div>
                <div class="bg-slate-50 rounded-xl p-4">
                  <p class="text-sm text-slate-600 mb-1">Status</p>
                  <span class="inline-block text-sm font-medium text-emerald-600 bg-emerald-100 px-3 py-1 rounded-full">${entry.status}</span>
                </div>
              </div>
              
              <div class="border-t pt-6">
                <h3 class="font-bold text-slate-800 mb-4">Time Entry Details</h3>
                <div class="space-y-3">
                  <div class="flex justify-between">
                    <span class="text-slate-600">Project</span>
                    <span class="font-medium text-slate-800">${entry.project}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-slate-600">Task</span>
                    <span class="font-medium text-slate-800">${entry.task}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-slate-600">Entry ID</span>
                    <span class="font-medium text-slate-800">#TIME-${String(entry.id).padStart(4, '0')}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-slate-600">Billable</span>
                    <span class="font-medium text-emerald-600">Yes</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-slate-600">Hourly Rate</span>
                    <span class="font-medium text-slate-800">$50/hr</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-slate-600">Total Value</span>
                    <span class="heading-font text-xl font-bold text-emerald-600">$125</span>
                  </div>
                </div>
              </div>
              
              <div class="border-t pt-6">
                <h3 class="font-bold text-slate-800 mb-3">Activity Log</h3>
                <div class="space-y-2">
                  <div class="flex gap-3 p-3 bg-slate-50 rounded-lg">
                    <div class="w-2 h-2 rounded-full bg-emerald-500 mt-1.5"></div>
                    <div class="flex-1">
                      <p class="text-sm font-medium text-slate-800">Timer started</p>
                      <p class="text-xs text-slate-500">10:00 AM</p>
                    </div>
                  </div>
                  <div class="flex gap-3 p-3 bg-slate-50 rounded-lg">
                    <div class="w-2 h-2 rounded-full bg-blue-500 mt-1.5"></div>
                    <div class="flex-1">
                      <p class="text-sm font-medium text-slate-800">Timer stopped</p>
                      <p class="text-xs text-slate-500">12:30 PM</p>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="flex gap-3 pt-4">
                <button onclick="hideModal('time-view-modal')" class="flex-1 px-6 py-3 bg-slate-100 text-slate-700 rounded-xl font-medium hover:bg-slate-200 transition-colors">Close</button>
                <button class="flex-1 px-6 py-3 bg-emerald-500 text-white rounded-xl font-medium hover:bg-emerald-600 transition-colors">Edit Entry</button>
              </div>
            </div>
          </div>
        </div>
      `;
      
      document.body.insertAdjacentHTML('beforeend', modalContent);
    }
    
    function handleTimeSubmit(e) {
      e.preventDefault();
      const project = document.getElementById('time-project').value;
      const task = document.getElementById('time-task').value;
      const duration = document.getElementById('time-duration').value;
      
      timeEntries.push({
        id: nextTimeId++,
        project,
        task,
        duration,
        date: 'Today',
        status: 'Completed'
      });
      
      toggleTimeForm();
      showPage('time-tracking');
    }
    
    function deleteTimeEntry(id) {
      timeEntries = timeEntries.filter(t => t.id !== id);
      showPage('time-tracking');
    }
    
    function getPageContent(pageName) {
      const pages = {
        dashboard: getDashboardContent(),
        projects: getProjectsContent(),
        clients: getClientsContent(),
        invoices: getInvoicesContent(),
        expenses: getExpensesContent(),
        'time-tracking': getTimeTrackingContent(),
        reports: getReportsContent(),
        settings: getSettingsContent()
      };
      
      return pages[pageName] || pages.dashboard;
    }
    
    function getDashboardContent() {
      return `
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <!-- Revenue Card -->
          <div class="stat-card card-hover bg-white rounded-2xl p-6 border border-slate-100">
            <div class="flex items-center justify-between mb-4">
              <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <span class="text-xs font-medium text-emerald-600 bg-emerald-100 px-2 py-1 rounded-full">+12.5%</span>
            </div>
            <h3 class="text-slate-500 text-sm font-medium">Total Revenue</h3>
            <p class="heading-font text-3xl font-bold text-slate-800 mt-1">$24,580</p>
            <p class="text-xs text-slate-400 mt-2">vs $21,850 last month</p>
          </div>
          
          <!-- Projects Card -->
          <div class="stat-card card-hover bg-white rounded-2xl p-6 border border-slate-100">
            <div class="flex items-center justify-between mb-4">
              <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
              </div>
              <span class="text-xs font-medium text-blue-600 bg-blue-100 px-2 py-1 rounded-full">+3 new</span>
            </div>
            <h3 class="text-slate-500 text-sm font-medium">Active Projects</h3>
            <p class="heading-font text-3xl font-bold text-slate-800 mt-1">${projects.length}</p>
            <p class="text-xs text-slate-400 mt-2">4 due this week</p>
          </div>
          
          <!-- Clients Card -->
          <div class="stat-card card-hover bg-white rounded-2xl p-6 border border-slate-100">
            <div class="flex items-center justify-between mb-4">
              <div class="w-12 h-12 rounded-xl bg-violet-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </div>
              <span class="text-xs font-medium text-violet-600 bg-violet-100 px-2 py-1 rounded-full">+2 new</span>
            </div>
            <h3 class="text-slate-500 text-sm font-medium">Total Clients</h3>
            <p class="heading-font text-3xl font-bold text-slate-800 mt-1">${clients.length}</p>
            <p class="text-xs text-slate-400 mt-2">5 returning clients</p>
          </div>
          
          <!-- Hours Card -->
          <div class="stat-card card-hover bg-white rounded-2xl p-6 border border-slate-100">
            <div class="flex items-center justify-between mb-4">
              <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <span class="text-xs font-medium text-amber-600 bg-amber-100 px-2 py-1 rounded-full">On track</span>
            </div>
            <h3 class="text-slate-500 text-sm font-medium">Hours This Month</h3>
            <p class="heading-font text-3xl font-bold text-slate-800 mt-1">142h</p>
            <p class="text-xs text-slate-400 mt-2">Target: 160h</p>
          </div>
        </div>
        
        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <!-- Recent Projects -->
          <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
              <h2 class="heading-font text-lg font-bold text-slate-800">Recent Projects</h2>
              <button onclick="showPage('projects')" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">View All</button>
            </div>
            <div class="divide-y divide-slate-100">
              ${projects.slice(0, 3).map(project => `
                <div class="px-6 py-4 hover:bg-slate-50 transition-colors">
                  <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br ${project.color} flex items-center justify-center text-white font-bold">${project.initial}</div>
                    <div class="flex-1 min-w-0">
                      <h3 class="font-medium text-slate-800">${project.name}</h3>
                      <p class="text-sm text-slate-500">${project.client}</p>
                    </div>
                    <div class="text-right">
                      <p class="font-medium text-slate-800">${project.budget}</p>
                      <div class="flex items-center gap-2 mt-1">
                        <div class="w-24 h-1.5 bg-slate-200 rounded-full overflow-hidden">
                          <div class="progress-bar h-full bg-emerald-500 rounded-full" style="width: ${project.progress}%"></div>
                        </div>
                        <span class="text-xs text-slate-500">${project.progress}%</span>
                      </div>
                    </div>
                  </div>
                </div>
              `).join('')}
            </div>
          </div>
          
          <!-- Upcoming Tasks -->
          <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
              <h2 class="heading-font text-lg font-bold text-slate-800">Upcoming Tasks</h2>
            </div>
            <div class="p-4 space-y-3">
              <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                <div class="flex items-start gap-3">
                  <input type="checkbox" class="mt-1 w-4 h-4 rounded border-slate-300 text-emerald-500 focus:ring-emerald-500">
                  <div class="flex-1">
                    <p class="font-medium text-slate-800 text-sm">Finalize homepage mockups</p>
                    <p class="text-xs text-slate-500 mt-1">E-commerce Redesign</p>
                  </div>
                  <span class="text-xs font-medium text-rose-600 bg-rose-100 px-2 py-1 rounded-full">Today</span>
                </div>
              </div>
              <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                <div class="flex items-start gap-3">
                  <input type="checkbox" class="mt-1 w-4 h-4 rounded border-slate-300 text-emerald-500 focus:ring-emerald-500">
                  <div class="flex-1">
                    <p class="font-medium text-slate-800 text-sm">Client call - project review</p>
                    <p class="text-xs text-slate-500 mt-1">HealthPlus</p>
                  </div>
                  <span class="text-xs font-medium text-amber-600 bg-amber-100 px-2 py-1 rounded-full">Tomorrow</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Bottom Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
          <!-- Recent Invoices -->
          <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
              <h2 class="heading-font text-lg font-bold text-slate-800">Recent Invoices</h2>
              <button onclick="showPage('invoices')" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">View All</button>
            </div>
            <div class="divide-y divide-slate-100">
              ${invoices.slice(0, 2).map(invoice => `
                <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                  <div>
                    <p class="font-medium text-slate-800">${invoice.invoiceId}</p>
                    <p class="text-sm text-slate-500">${invoice.client}</p>
                  </div>
                  <div class="text-right">
                    <p class="font-medium text-slate-800">${invoice.amount}</p>
                    <span class="text-xs font-medium text-${invoice.statusColor}-600 bg-${invoice.statusColor}-100 px-2 py-1 rounded-full">${invoice.status}</span>
                  </div>
                </div>
              `).join('')}
            </div>
          </div>
          
          <!-- Quick Actions -->
          <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-6 text-white">
            <h2 class="heading-font text-lg font-bold mb-4">Quick Actions</h2>
            <div class="grid grid-cols-2 gap-4">
              <button onclick="showPage('invoices')" class="flex flex-col items-center gap-3 p-4 rounded-xl bg-white/10 hover:bg-white/20 transition-colors">
                <div class="w-12 h-12 rounded-full bg-emerald-500 flex items-center justify-center">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                  </svg>
                </div>
                <span class="font-medium text-sm">New Invoice</span>
              </button>
              <button onclick="showPage('clients')" class="flex flex-col items-center gap-3 p-4 rounded-xl bg-white/10 hover:bg-white/20 transition-colors">
                <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                  </svg>
                </div>
                <span class="font-medium text-sm">Add Client</span>
              </button>
              <button onclick="showPage('time-tracking')" class="flex flex-col items-center gap-3 p-4 rounded-xl bg-white/10 hover:bg-white/20 transition-colors">
                <div class="w-12 h-12 rounded-full bg-violet-500 flex items-center justify-center">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                </div>
                <span class="font-medium text-sm">Start Timer</span>
              </button>
              <button onclick="showPage('reports')" class="flex flex-col items-center gap-3 p-4 rounded-xl bg-white/10 hover:bg-white/20 transition-colors">
                <div class="w-12 h-12 rounded-full bg-amber-500 flex items-center justify-center">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                  </svg>
                </div>
                <span class="font-medium text-sm">Export Report</span>
              </button>
            </div>
          </div>
        </div>
      `;
    }
    


    
    function getInvoicesContent() {
      return `
        <div class="mb-6 flex items-center justify-between">
          <div>
            <h1 class="heading-font text-3xl font-bold text-slate-800">Invoices</h1>
            <p class="text-slate-500 mt-1">Track and manage your invoices</p>
          </div>
          <button onclick="toggleInvoiceForm()" class="flex items-center gap-2 px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create Invoice
          </button>
        </div>
        
        <!-- Add Invoice Form -->
        <div id="invoice-form-container" class="hidden mb-6 bg-white rounded-2xl border border-slate-100 p-6">
          <h2 class="heading-font text-xl font-bold text-slate-800 mb-4">Create New Invoice</h2>
          <form id="invoice-form" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label for="invoice-client" class="block text-sm font-medium text-slate-700 mb-2">Client Name</label>
                <input type="text" id="invoice-client" required class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
              </div>
              <div>
                <label for="invoice-amount" class="block text-sm font-medium text-slate-700 mb-2">Amount</label>
                <input type="text" id="invoice-amount" required placeholder="$0.00" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
              </div>
              <div>
                <label for="invoice-status" class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                <select id="invoice-status" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                  <option>Pending</option>
                  <option>Paid</option>
                  <option>Overdue</option>
                </select>
              </div>
            </div>
            <div class="flex gap-3">
              <button type="submit" class="px-6 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors font-medium">Create Invoice</button>
              <button type="button" onclick="toggleInvoiceForm()" class="px-6 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors font-medium">Cancel</button>
            </div>
          </form>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          <div class="bg-white rounded-2xl p-6 border border-slate-100">
            <div class="flex items-center gap-3 mb-3">
              <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <span class="text-sm font-medium text-slate-600">Paid</span>
            </div>
            <p class="heading-font text-3xl font-bold text-slate-800">$12,450</p>
            <p class="text-sm text-slate-500 mt-1">${invoices.filter(i => i.status === 'Paid').length} invoices</p>
          </div>
          <div class="bg-white rounded-2xl p-6 border border-slate-100">
            <div class="flex items-center gap-3 mb-3">
              <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <span class="text-sm font-medium text-slate-600">Pending</span>
            </div>
            <p class="heading-font text-3xl font-bold text-slate-800">$8,730</p>
            <p class="text-sm text-slate-500 mt-1">${invoices.filter(i => i.status === 'Pending').length} invoices</p>
          </div>
          <div class="bg-white rounded-2xl p-6 border border-slate-100">
            <div class="flex items-center gap-3 mb-3">
              <div class="w-10 h-10 rounded-lg bg-rose-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <span class="text-sm font-medium text-slate-600">Overdue</span>
            </div>
            <p class="heading-font text-3xl font-bold text-slate-800">$3,400</p>
            <p class="text-sm text-slate-500 mt-1">${invoices.filter(i => i.status === 'Overdue').length} invoices</p>
          </div>
        </div>
        
        <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
          <div class="divide-y divide-slate-100">
            ${invoices.map(invoice => `
              <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                <div class="flex-1">
                  <p class="font-bold text-slate-800">${invoice.invoiceId}</p>
                  <p class="text-sm text-slate-500 mt-1">${invoice.client}</p>
                </div>
                <div class="flex-1 text-center">
                  <p class="text-sm text-slate-600">${invoice.date}</p>
                </div>
                <div class="flex-1 text-center">
                  <p class="font-bold text-slate-800">${invoice.amount}</p>
                </div>
                <div class="flex-1 flex items-center justify-center">
                  <span class="text-xs font-medium text-${invoice.statusColor}-600 bg-${invoice.statusColor}-100 px-3 py-1 rounded-full">${invoice.status}</span>
                </div>
                <div class="flex gap-2">
                  <button onclick="viewInvoice(${invoice.id})" class="px-3 py-2 text-sm bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition-colors">View</button>
                  <button onclick="deleteInvoice(${invoice.id})" class="px-3 py-2 text-sm bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-100 transition-colors">Delete</button>
                </div>
              </div>
            `).join('')}
          </div>
        </div>
      `;
    }
    
    function getExpensesContent() {
      return `
        <div class="mb-6 flex items-center justify-between">
          <div>
            <h1 class="heading-font text-3xl font-bold text-slate-800">Expenses</h1>
            <p class="text-slate-500 mt-1">Track your business expenses</p>
          </div>
          <button onclick="toggleExpenseForm()" class="flex items-center gap-2 px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Expense
          </button>
        </div>
        
        <!-- Add Expense Form -->
        <div id="expense-form-container" class="hidden mb-6 bg-white rounded-2xl border border-slate-100 p-6">
          <h2 class="heading-font text-xl font-bold text-slate-800 mb-4">Add New Expense</h2>
          <form id="expense-form" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label for="expense-category" class="block text-sm font-medium text-slate-700 mb-2">Category</label>
                <select id="expense-category" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                  <option>Software</option>
                  <option>Office</option>
                  <option>Marketing</option>
                  <option>Internet</option>
                  <option>Travel</option>
                  <option>Other</option>
                </select>
              </div>
              <div>
                <label for="expense-item" class="block text-sm font-medium text-slate-700 mb-2">Description</label>
                <input type="text" id="expense-item" required class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
              </div>
              <div>
                <label for="expense-amount" class="block text-sm font-medium text-slate-700 mb-2">Amount</label>
                <input type="text" id="expense-amount" required placeholder="$0.00" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
              </div>
            </div>
            <div class="flex gap-3">
              <button type="submit" class="px-6 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors font-medium">Add Expense</button>
              <button type="button" onclick="toggleExpenseForm()" class="px-6 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors font-medium">Cancel</button>
            </div>
          </form>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
          <div class="bg-white rounded-2xl p-6 border border-slate-100">
            <p class="text-sm font-medium text-slate-600 mb-2">This Month</p>
            <p class="heading-font text-3xl font-bold text-slate-800">$3,842</p>
          </div>
          <div class="bg-white rounded-2xl p-6 border border-slate-100">
            <p class="text-sm font-medium text-slate-600 mb-2">Last Month</p>
            <p class="heading-font text-3xl font-bold text-slate-800">$4,125</p>
          </div>
          <div class="bg-white rounded-2xl p-6 border border-slate-100">
            <p class="text-sm font-medium text-slate-600 mb-2">This Year</p>
            <p class="heading-font text-3xl font-bold text-slate-800">$42,380</p>
          </div>
          <div class="bg-white rounded-2xl p-6 border border-slate-100">
            <p class="text-sm font-medium text-slate-600 mb-2">Average</p>
            <p class="heading-font text-3xl font-bold text-slate-800">$3,532</p>
          </div>
        </div>
        
        <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
          <div class="px-6 py-4 border-b border-slate-100">
            <h2 class="heading-font text-lg font-bold text-slate-800">Recent Expenses</h2>
          </div>
          <div class="divide-y divide-slate-100">
            ${expenses.map(expense => `
              <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-4 flex-1">
                  <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                  </div>
                  <div>
                    <p class="font-medium text-slate-800">${expense.item}</p>
                    <p class="text-sm text-slate-500">${expense.category}</p>
                  </div>
                </div>
                <div class="text-center flex-1">
                  <p class="text-sm text-slate-600">${expense.date}</p>
                </div>
                <div class="text-right flex-1">
                  <p class="font-bold text-slate-800">${expense.amount}</p>
                </div>
                <div class="ml-4 flex gap-2">
                  <button onclick="viewExpense(${expense.id})" class="text-emerald-600 hover:text-emerald-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                  </button>
                  <button onclick="deleteExpense(${expense.id})" class="text-rose-600 hover:text-rose-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                  </button>
                </div>
              </div>
            `).join('')}
          </div>
        </div>
      `;
    }
    
    function getTimeTrackingContent() {
      return `
        <div class="mb-6 flex items-center justify-between">
          <div>
            <h1 class="heading-font text-3xl font-bold text-slate-800">Time Tracking</h1>
            <p class="text-slate-500 mt-1">Track time spent on projects</p>
          </div>
          <button onclick="toggleTimeForm()" class="flex items-center gap-2 px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Time Entry
          </button>
        </div>
        
        <!-- Add Time Entry Form -->
        <div id="time-form-container" class="hidden mb-6 bg-white rounded-2xl border border-slate-100 p-6">
          <h2 class="heading-font text-xl font-bold text-slate-800 mb-4">Add Time Entry</h2>
          <form id="time-form" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label for="time-project" class="block text-sm font-medium text-slate-700 mb-2">Project</label>
                <input type="text" id="time-project" required class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
              </div>
              <div>
                <label for="time-task" class="block text-sm font-medium text-slate-700 mb-2">Task Description</label>
                <input type="text" id="time-task" required class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
              </div>
              <div>
                <label for="time-duration" class="block text-sm font-medium text-slate-700 mb-2">Duration</label>
                <input type="text" id="time-duration" required placeholder="2h 30m" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
              </div>
            </div>
            <div class="flex gap-3">
              <button type="submit" class="px-6 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors font-medium">Add Entry</button>
              <button type="button" onclick="toggleTimeForm()" class="px-6 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors font-medium">Cancel</button>
            </div>
          </form>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
          <div class="bg-white rounded-2xl p-6 border border-slate-100">
            <p class="text-sm font-medium text-slate-600 mb-2">Today</p>
            <p class="heading-font text-3xl font-bold text-slate-800">4.5h</p>
          </div>
          <div class="bg-white rounded-2xl p-6 border border-slate-100">
            <p class="text-sm font-medium text-slate-600 mb-2">This Week</p>
            <p class="heading-font text-3xl font-bold text-slate-800">28h</p>
          </div>
          <div class="bg-white rounded-2xl p-6 border border-slate-100">
            <p class="text-sm font-medium text-slate-600 mb-2">This Month</p>
            <p class="heading-font text-3xl font-bold text-slate-800">142h</p>
          </div>
          <div class="bg-white rounded-2xl p-6 border border-slate-100">
            <p class="text-sm font-medium text-slate-600 mb-2">Billable</p>
            <p class="heading-font text-3xl font-bold text-slate-800">$7,100</p>
          </div>
        </div>
        
        <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
          <div class="px-6 py-4 border-b border-slate-100">
            <h2 class="heading-font text-lg font-bold text-slate-800">Recent Time Entries</h2>
          </div>
          <div class="divide-y divide-slate-100">
            ${timeEntries.map(entry => `
              <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                <div class="flex-1">
                  <p class="font-medium text-slate-800">${entry.task}</p>
                  <p class="text-sm text-slate-500 mt-1">${entry.project}</p>
                </div>
                <div class="flex-1 text-center">
                  <p class="text-sm text-slate-600">${entry.date}</p>
                </div>
                <div class="flex-1 text-center">
                  <p class="font-bold text-slate-800">${entry.duration}</p>
                </div>
                <div class="flex-1 flex items-center justify-center">
                  <span class="text-xs font-medium text-emerald-600 bg-emerald-100 px-3 py-1 rounded-full">${entry.status}</span>
                </div>
                <div class="flex gap-2">
                  <button onclick="viewTimeEntry(${entry.id})" class="px-3 py-2 text-sm bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-200 transition-colors">View</button>
                  <button onclick="deleteTimeEntry(${entry.id})" class="px-3 py-2 text-sm bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-100 transition-colors">Delete</button>
                </div>
              </div>
            `).join('')}
          </div>
        </div>
      `;
    }
    
    function getReportsContent() {
      return `
        <div class="mb-6">
          <h1 class="heading-font text-3xl font-bold text-slate-800">Reports & Analytics</h1>
          <p class="text-slate-500 mt-1">View insights about your business performance</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
          <div class="bg-white rounded-2xl p-6 border border-slate-100">
            <h2 class="heading-font text-lg font-bold text-slate-800 mb-4">Revenue Overview</h2>
            <div class="space-y-4">
              ${[
                {month: 'December', amount: '$24,580', change: '+12.5%', positive: true},
                {month: 'November', amount: '$21,850', change: '+8.3%', positive: true},
                {month: 'October', amount: '$20,150', change: '-2.1%', positive: false},
                {month: 'September', amount: '$20,580', change: '+15.7%', positive: true}
              ].map(data => `
                <div class="flex items-center justify-between">
                  <span class="text-slate-600">${data.month}</span>
                  <div class="flex items-center gap-3">
                    <span class="font-bold text-slate-800">${data.amount}</span>
                    <span class="text-sm font-medium ${data.positive ? 'text-emerald-600' : 'text-rose-600'}">${data.change}</span>
                  </div>
                </div>
              `).join('')}
            </div>
          </div>
          
          <div class="bg-white rounded-2xl p-6 border border-slate-100">
            <h2 class="heading-font text-lg font-bold text-slate-800 mb-4">Top Clients by Revenue</h2>
            <div class="space-y-4">
              ${[
                {name: 'HealthPlus', revenue: '$8,200', percentage: 33},
                {name: 'TechStart Inc.', revenue: '$6,750', percentage: 27},
                {name: 'DataFlow Systems', revenue: '$3,100', percentage: 13},
                {name: 'Cafe Sunrise', revenue: '$2,800', percentage: 11}
              ].map(client => `
                <div>
                  <div class="flex items-center justify-between mb-2">
                    <span class="font-medium text-slate-800">${client.name}</span>
                    <span class="font-bold text-slate-800">${client.revenue}</span>
                  </div>
                  <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-500 rounded-full" style="width: ${client.percentage}%"></div>
                  </div>
                </div>
              `).join('')}
            </div>
          </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <div class="bg-white rounded-2xl p-6 border border-slate-100">
            <h3 class="heading-font font-bold text-slate-800 mb-4">Project Status</h3>
            <div class="space-y-3">
              <div class="flex items-center justify-between">
                <span class="text-slate-600">Active</span>
                <span class="font-bold text-emerald-600">${projects.length}</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-slate-600">Completed</span>
                <span class="font-bold text-blue-600">45</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-slate-600">On Hold</span>
                <span class="font-bold text-amber-600">3</span>
              </div>
            </div>
          </div>
          
          <div class="bg-white rounded-2xl p-6 border border-slate-100">
            <h3 class="heading-font font-bold text-slate-800 mb-4">Payment Status</h3>
            <div class="space-y-3">
              <div class="flex items-center justify-between">
                <span class="text-slate-600">Paid</span>
                <span class="font-bold text-emerald-600">$12,450</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-slate-600">Pending</span>
                <span class="font-bold text-amber-600">$8,730</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-slate-600">Overdue</span>
                <span class="font-bold text-rose-600">$3,400</span>
              </div>
            </div>
          </div>
          
          <div class="bg-white rounded-2xl p-6 border border-slate-100">
            <h3 class="heading-font font-bold text-slate-800 mb-4">Time Breakdown</h3>
            <div class="space-y-3">
              <div class="flex items-center justify-between">
                <span class="text-slate-600">Billable</span>
                <span class="font-bold text-emerald-600">128h</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-slate-600">Non-billable</span>
                <span class="font-bold text-slate-600">14h</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-slate-600">Total</span>
                <span class="font-bold text-slate-800">142h</span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="mt-6 flex gap-4">
          <button class="flex-1 px-6 py-3 bg-emerald-500 text-white rounded-xl font-medium hover:bg-emerald-600 transition-colors">Export PDF Report</button>
          <button class="flex-1 px-6 py-3 bg-slate-100 text-slate-700 rounded-xl font-medium hover:bg-slate-200 transition-colors">Export CSV Data</button>
        </div>
      `;
    }
    
    function getSettingsContent() {
      return `
        <div class="mb-6">
          <h1 class="heading-font text-3xl font-bold text-slate-800">Settings</h1>
          <p class="text-slate-500 mt-1">Manage your account and preferences</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <div class="lg:col-span-1 bg-white rounded-2xl border border-slate-100 p-4">
            <nav class="space-y-1">
              <button onclick="showSettingsTab('profile')" data-settings-tab="profile" class="settings-tab-link w-full text-left px-4 py-3 rounded-xl bg-emerald-50 text-emerald-600 font-medium">
                Profile Settings
              </button>
              <button onclick="showSettingsTab('business')" data-settings-tab="business" class="settings-tab-link w-full text-left px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 font-medium">
                Business Info
              </button>
              <button onclick="showSettingsTab('billing')" data-settings-tab="billing" class="settings-tab-link w-full text-left px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 font-medium">
                Billing & Plans
              </button>
              <button onclick="showSettingsTab('notifications')" data-settings-tab="notifications" class="settings-tab-link w-full text-left px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 font-medium">
                Notifications
              </button>
              <button onclick="showSettingsTab('security')" data-settings-tab="security" class="settings-tab-link w-full text-left px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 font-medium">
                Security
              </button>
            </nav>
          </div>
          
          <div id="settings-content" class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 p-6">
            ${getProfileSettingsContent()}
          </div>
        </div>
      `;
    }
    
    function getProfileSettingsContent() {
      return `
        <h2 class="heading-font text-xl font-bold text-slate-800 mb-6">Profile Settings</h2>
        <form class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="first-name" class="block text-sm font-medium text-slate-700 mb-2">First Name</label>
              <input type="text" id="first-name" value="Alex" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>
            <div>
              <label for="last-name" class="block text-sm font-medium text-slate-700 mb-2">Last Name</label>
              <input type="text" id="last-name" value="Chen" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>
          </div>
          <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email Address</label>
            <input type="email" id="email" value="alex@example.com" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
          </div>
          <div>
            <label for="job-title" class="block text-sm font-medium text-slate-700 mb-2">Job Title</label>
            <input type="text" id="job-title" value="Freelance Developer" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
          </div>
          <div>
            <label for="bio" class="block text-sm font-medium text-slate-700 mb-2">Bio</label>
            <textarea id="bio" rows="4" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">Full-stack developer specializing in web applications and mobile apps.</textarea>
          </div>
          <div class="flex gap-4">
            <button type="submit" class="px-6 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors font-medium">Save Changes</button>
            <button type="button" class="px-6 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors font-medium">Cancel</button>
          </div>
        </form>
      `;
    }
    
    window.showSettingsTab = function(tabName) {
      document.querySelectorAll('.settings-tab-link').forEach(link => {
        if (link.dataset.settingsTab === tabName) {
          link.classList.remove('text-slate-600', 'hover:bg-slate-50');
          link.classList.add('bg-emerald-50', 'text-emerald-600');
        } else {
          link.classList.remove('bg-emerald-50', 'text-emerald-600');
          link.classList.add('text-slate-600', 'hover:bg-slate-50');
        }
      });
      
      document.getElementById('settings-content').innerHTML = getProfileSettingsContent();
    };
    
    // Initialize page on load
    document.addEventListener('DOMContentLoaded', () => {
      showPage('dashboard');
    });
    
    async function onConfigChange(config) {
      // Update app title
      const appTitle = document.getElementById('app-title');
      if (appTitle) {
        appTitle.textContent = config.app_title || defaultConfig.app_title;
      }
      
      // Update welcome message
      const welcomeText = document.getElementById('welcome-text');
      if (welcomeText) {
        const userName = config.user_name || defaultConfig.user_name;
        const welcomeMsg = config.welcome_message || defaultConfig.welcome_message;
        welcomeText.textContent = `${welcomeMsg}, ${userName}! 👋`;
      }
      
      // Update sidebar user name
      const sidebarUser = document.getElementById('sidebar-user');
      if (sidebarUser) {
        sidebarUser.textContent = `${config.user_name || defaultConfig.user_name} Chen`;
      }
      
      // Apply colors
      const bgColor = config.background_color || defaultConfig.background_color;
      const sidebarColor = config.sidebar_color || defaultConfig.sidebar_color;
      const textColor = config.text_color || defaultConfig.text_color;
      const primaryColor = config.primary_action_color || defaultConfig.primary_action_color;
      const secondaryColor = config.secondary_action_color || defaultConfig.secondary_action_color;
      
      document.body.style.backgroundColor = bgColor;
      
      const sidebar = document.getElementById('sidebar');
      if (sidebar) {
        sidebar.style.backgroundColor = sidebarColor;
      }
      
      // Apply font
      const customFont = config.font_family || defaultConfig.font_family;
      const baseFontStack = 'Arial, sans-serif';
      document.body.style.fontFamily = `${customFont}, ${baseFontStack}`;
      
      // Apply font size scaling
      const baseSize = config.font_size || defaultConfig.font_size;
      document.documentElement.style.fontSize = `${baseSize}px`;
    }
    
    function mapToCapabilities(config) {
      return {
        recolorables: [
          {
            get: () => config.background_color || defaultConfig.background_color,
            set: (value) => {
              config.background_color = value;
              window.elementSdk.setConfig({ background_color: value });
            }
          },
          {
            get: () => config.sidebar_color || defaultConfig.sidebar_color,
            set: (value) => {
              config.sidebar_color = value;
              window.elementSdk.setConfig({ sidebar_color: value });
            }
          },
          {
            get: () => config.text_color || defaultConfig.text_color,
            set: (value) => {
              config.text_color = value;
              window.elementSdk.setConfig({ text_color: value });
            }
          },
          {
            get: () => config.primary_action_color || defaultConfig.primary_action_color,
            set: (value) => {
              config.primary_action_color = value;
              window.elementSdk.setConfig({ primary_action_color: value });
            }
          },
          {
            get: () => config.secondary_action_color || defaultConfig.secondary_action_color,
            set: (value) => {
              config.secondary_action_color = value;
              window.elementSdk.setConfig({ secondary_action_color: value });
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
        ['app_title', config.app_title || defaultConfig.app_title],
        ['welcome_message', config.welcome_message || defaultConfig.welcome_message],
        ['user_name', config.user_name || defaultConfig.user_name]
      ]);
    }
    
    // Initialize SDK
    if (window.elementSdk) {
      window.elementSdk.init({
        defaultConfig,
        onConfigChange,
        mapToCapabilities,
        mapToEditPanelValues
      });
    }
  (function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9bde0c3b42ea1f90',t:'MTc2ODQwMzI5Ni4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();
