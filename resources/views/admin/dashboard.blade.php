<x-dashboard-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-blue-100 p-4 rounded-lg shadow">
            <h3 class="font-bold text-lg">Total Interns</h3>
            <p class="text-3xl">{{ $totalInterns }}</p>
        </div>
        <div class="bg-red-100 p-4 rounded-lg shadow">
            <h3 class="font-bold text-lg">Total Admins</h3>
            <p class="text-3xl">{{ $totalAdmins }}</p>
        </div>
        <div class="bg-green-100 p-4 rounded-lg shadow">
            <h3 class="font-bold text-lg">Total Tasks</h3>
            <p class="text-3xl">{{ $totalTasks }}</p>
        </div>
        <div class="bg-yellow-100 p-4 rounded-lg shadow">
            <h3 class="font-bold text-lg">Total Completed Tasks</h3>
            <p class="text-3xl">{{ $totalCompletedTasks }}</p>
        </div>
        <div class="bg-purple-100 p-4 rounded-lg shadow">
            <h3 class="font-bold text-lg">Total In Progress Tasks</h3>
            <p class="text-3xl">{{ $totalInProgressTasks }}</p> 
        </div>
        <div class="bg-gray-100 p-4 rounded-lg shadow">
            <h3 class="font-bold text-lg">Total Pending Tasks</h3>
            <p class="text-3xl">{{ $totalPendingTasks }}</p>
        </div>
    </div>
</x-dashboard-layout>