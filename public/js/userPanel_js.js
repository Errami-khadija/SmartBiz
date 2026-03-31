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

// sweetAlert for deleting project
document.addEventListener('submit', function (e) {
    if (e.target.classList.contains('delete-project-form')) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "This project will be permanently deleted.",
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

// Edit Client Modal functions
  window.openEditModal = function() {
    document.getElementById('editClientModal').classList.remove('hidden')
    document.getElementById('editClientModal').classList.add('flex')
  }

  window.closeEditModal = function() {
    document.getElementById('editClientModal').classList.add('hidden')
    document.getElementById('editClientModal').classList.remove('flex')
  }

// Edit Project Modal functions
  window.openEditProjectModal = function() {
    document.getElementById('editProjectModal').classList.remove('hidden')
    document.getElementById('editProjectModal').classList.add('flex')
  }
  window.closeEditProjectModal = function() {
    document.getElementById('editProjectModal').classList.add('hidden')
    document.getElementById('editProjectModal').classList.remove('flex')
  }


  //Task Modal functions
    let taskIndex = 1;

   window.addTaskRow = function () {
    const container = document.getElementById('tasks-container');

    const row = document.createElement('div');
    row.className = 'flex items-center gap-3 task-row';

    row.innerHTML = `
        <input type="text"
               name="tasks[${taskIndex}][title]"
               placeholder="Task title"
               class="flex-1 px-4 py-2 border border-slate-200 rounded-lg">

        <button type="button"
                onclick="removeTaskRow(this)"
                class="text-rose-500 hover:text-rose-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                         </svg>
        </button>
    `;

    container.appendChild(row);
    taskIndex++;
};
 window.removeTaskRow = function (button) {
    button.closest('.task-row').remove();
};

window.toggleTaskStatus = function(taskId, checked) {
    fetch(`/tasks/${taskId}/toggle`, {
        method: 'PATCH',
        headers: {
    'X-CSRF-TOKEN': document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content'),
    'Accept': 'application/json'
}
    })
    .then(res => {
        if (!res.ok) throw new Error('Request failed');
        return res.json();
    })
    .then(() => {
        //  Refresh page so status & progress update
        window.location.reload();
    })
    .catch(err => {
        console.error(err);
        alert('Failed to update task');
    });
}

window.addTaskRowToShowPage = function () {
    const container = document.getElementById('tasks-container');
     if (!container) return;

    const row = document.createElement('div');
    row.className = 'flex items-center gap-3 task-row';

    row.innerHTML = `
        <input
            type="text"
            placeholder="Task title"
            class="flex-1 px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500"
            onkeydown="saveTaskOnEnter(event, this)"
        >

        <button
            type="button"
            onclick="removeTaskRow(this)"
            class="text-rose-500 hover:text-rose-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </button>
    `;

    container.appendChild(row);
    row.querySelector('input').focus();
}

window.saveTaskOnEnter = function (event, input) {
    if (event.key !== 'Enter') return;

    event.preventDefault();

    const title = input.value.trim();
    if (!title) return;

     const container = input.closest('[data-project-id]');
    const projectId = container ? container.dataset.projectId : null;

    if (!projectId) {
        alert('Project not found for this task.');
        return;
    }

    fetch(`/projects/${projectId}/tasks`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ title })
    })
    .then(res => {
        if (!res.ok) throw new Error();
        return res.json();
    })
    .then(() => {
        // ✅ Reload so task appears in list + progress works
        window.location.reload();
    })
    .catch(() => {
        alert('Failed to save task');
    });
};
    // SweetAlert for deleting invoice
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-invoice-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Delete invoice?',
                    text: "This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48', // rose-600
                    cancelButtonColor: '#6b7280',  // gray-500
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });

      // SweetAlert for deleting expense
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-expense-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Delete expense?',
                    text: "This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48', // rose-600
                    cancelButtonColor: '#6b7280',  // gray-500
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });


    
   
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
