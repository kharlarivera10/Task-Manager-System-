<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Task Management System</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-blue-50 min-h-screen flex flex-col font-sans text-gray-800">
  
  <!-- Header -->
  <header class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg sticky top-0 z-50">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-2xl font-extrabold tracking-tight">Task Management System</h1>
      <nav>
        <ul class="flex space-x-6 text-sm font-medium">
          <li>
            <a href="/" class="hover:text-blue-200 transition-colors duration-200">Home</a>
          </li>
          <li>
            <a href="/tasks" class="hover:text-blue-200 transition-colors duration-200">Tasks</a>
          </li>
          <li>
            <a href="/profile" class="hover:text-blue-200 transition-colors duration-200">Profile</a>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="flex-1 flex items-center justify-center px-4 py-12">
    <div id="app" 
         class="w-full max-w-3xl p-8 bg-white rounded-2xl shadow-xl border border-gray-100 
                transition hover:shadow-2xl">
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-100 text-gray-600 text-center py-6 border-t border-gray-200">
    <p class="text-sm">&copy; {{ date('Y') }} 
      <span class="font-semibold text-gray-700">Task Management System</span>. 
      All rights reserved.
    </p>
  </footer>
</body>
</html>
