<!-- resources/views/components/total-actif-users.blade.php -->

@props(['totalActif'])

    <div class="flex items-center justify-between">
            <p class="mt-2 text-3xl font-extrabold text-gray-900 dark:text-white">
                {{ $totalActif }}
            </p>
        
    </div>
